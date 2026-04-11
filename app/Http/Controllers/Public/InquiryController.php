<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller {
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'property_id' => 'nullable|exists:properties,id',
        ]);
        $inquiry = Inquiry::create($data);
        return response()->json(['success'=>true,'message'=>'Inquiry submitted. We will contact you shortly!']);
    }
}
