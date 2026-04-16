<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller {
    public function store(Request $request) {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email',
            'phone'       => 'nullable|string|max:20',
            'subject'     => 'nullable|string|max:255',
            'message'     => 'required|string|max:2000',
            'property_id' => 'nullable|exists:properties,id',
        ]);

        // Auto-generate subject for property enquiries that don't supply one
        if (empty($data['subject'])) {
            if (!empty($data['property_id'])) {
                $title = \App\Models\Property::where('id', $data['property_id'])->value('title');
                $data['subject'] = $title ? 'Enquiry: ' . $title : 'Property Enquiry';
            } else {
                $data['subject'] = 'General Enquiry';
            }
        }

        $inquiry = Inquiry::create($data);
        return response()->json(['success'=>true,'message'=>'Inquiry submitted. We will contact you shortly!']);
    }
}
