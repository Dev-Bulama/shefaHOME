<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller {
    public function index(Request $request) {
        $query = Inquiry::with('property')->latest();
        if($request->status) $query->where('status',$request->status);
        if($request->search) $query->where(fn($q) => $q->where('name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%'));
        return view('admin.inquiries.index', ['inquiries' => $query->paginate(20)]);
    }
    public function show($id) {
        $inquiry = Inquiry::with('property')->findOrFail($id);
        if($inquiry->status === 'new') $inquiry->update(['status'=>'read','read_at'=>now()]);
        return view('admin.inquiries.show', compact('inquiry'));
    }
    public function updateStatus(Request $request, $id) {
        Inquiry::findOrFail($id)->update(['status' => $request->validate(['status'=>'required|in:new,read,replied,closed'])['status']]);
        return back()->with('success','Status updated!');
    }
}
