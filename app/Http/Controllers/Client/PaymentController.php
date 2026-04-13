<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientPayment;
use App\Models\Property;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentController extends Controller {
    public function index() {
        $profile = auth()->user()->clientProfile()->firstOrFail();
        $payments = $profile->payments()->with('property')->latest()->paginate(15);
        $totalPaid = $profile->payments()->sum('amount_paid');
        $totalBalance = $profile->payments()->sum('balance');
        $totalPrice = $profile->payments()->sum('total_amount');
        return view('client.payments.index', compact('profile','payments','totalPaid','totalBalance','totalPrice'));
    }

    public function make() {
        $profile = auth()->user()->clientProfile()->firstOrFail();
        $payment = $profile->payments()->where('status','active')->with('property')->first();
        if(!$payment) return redirect()->route('client.payments.index')->with('info','No active payment plan found.');
        $property = $payment->property;
        return view('client.payments.make', compact('profile','payment','property'));
    }

    public function store(Request $request) {
        $profile = auth()->user()->clientProfile()->firstOrFail();
        $data = $request->validate([
            'payment_id' => 'required|exists:client_payments,id',
            'amount' => 'required|numeric|min:1000',
            'proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $payment = $profile->payments()->findOrFail($data['payment_id']);
        $proofPath = null;
        if($request->hasFile('proof')) {
            $proofPath = Storage::disk('public')->put('payment-proofs', $request->file('proof'));
        }

        $newPaid = $payment->amount_paid + $data['amount'];
        $newBalance = max(0, $payment->total_amount - $newPaid);
        $payment->update([
            'amount_paid' => $newPaid,
            'balance' => $newBalance,
            'status' => $newBalance <= 0 ? 'completed' : 'active',
        ]);

        return redirect()->route('client.payments.receipt', $payment->id)->with('success','Payment recorded successfully!');
    }

    public function verify(Request $request) {
        $reference = $request->query('reference');
        $paymentId  = $request->query('payment_id');

        if (!$reference) {
            return redirect()->route('client.payments.index')
                ->with('error', 'Invalid payment reference.');
        }

        // Verify with Paystack API
        $secretKey = config('services.paystack.secret_key');

        try {
            $response = Http::withToken($secretKey)
                ->get(config('services.paystack.payment_url') . '/transaction/verify/' . rawurlencode($reference));

            $body = $response->json();

            if (!$response->successful() || ($body['status'] ?? false) !== true || ($body['data']['status'] ?? '') !== 'success') {
                Log::warning('Paystack verification failed', ['reference' => $reference, 'body' => $body]);
                return redirect()->route('client.payments.index')
                    ->with('error', 'Payment could not be verified. Please contact support with reference: ' . $reference);
            }

            // Amount Paystack confirmed (in kobo → naira)
            $confirmedAmount = ($body['data']['amount'] ?? 0) / 100;

        } catch (\Exception $e) {
            Log::error('Paystack verification exception', ['reference' => $reference, 'error' => $e->getMessage()]);
            return redirect()->route('client.payments.index')
                ->with('error', 'A network error occurred during payment verification. Please contact support with reference: ' . $reference);
        }

        $profile = auth()->user()->clientProfile()->firstOrFail();

        $payment = $paymentId
            ? $profile->payments()->find($paymentId)
            : $profile->payments()->where('status', 'active')->first();

        if (!$payment) {
            return redirect()->route('client.payments.index')
                ->with('error', 'Payment record not found. Please contact support with reference: ' . $reference);
        }

        $newPaid    = $payment->amount_paid + $confirmedAmount;
        $newBalance = max(0, $payment->total_amount - $newPaid);

        $payment->update([
            'amount_paid' => $newPaid,
            'balance'     => $newBalance,
            'status'      => $newBalance <= 0 ? 'completed' : 'active',
        ]);

        return redirect()->route('client.payments.receipt', $payment->id)
            ->with('success', 'Payment of ₦' . number_format($confirmedAmount, 2) . ' verified and recorded successfully!');
    }

    public function receipt(int $id) {
        $profile = auth()->user()->clientProfile()->firstOrFail();
        $payment = $profile->payments()->with('property')->findOrFail($id);
        $property = $payment->property;
        return view('client.payments.receipt', compact('profile','payment','property'));
    }
}
