<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientPayment;
use App\Models\Property;
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
        // Paystack verification
        $reference = $request->reference;
        $profile = auth()->user()->clientProfile()->firstOrFail();
        // In production: call Paystack API to verify payment
        $payment = $profile->payments()->where('status','active')->first();
        if($payment) {
            $payment->update(['amount_paid'=>$payment->amount_paid + $request->amount, 'balance'=>max(0,$payment->balance-$request->amount),'status'=>$payment->balance<=$request->amount?'completed':'active']);
            return response()->json(['success'=>true,'payment_id'=>$payment->id]);
        }
        return response()->json(['success'=>false,'message'=>'Payment not found']);
    }

    public function receipt(int $id) {
        $profile = auth()->user()->clientProfile()->firstOrFail();
        $payment = $profile->payments()->with('property')->findOrFail($id);
        $property = $payment->property;
        return view('client.payments.receipt', compact('profile','payment','property'));
    }
}
