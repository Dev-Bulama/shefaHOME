<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{ClientProfile, ClientPayment, ClientDocument, User};
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller {
    public function index(Request $request) {
        $query = ClientProfile::with('user')->latest();
        if($request->search) $query->whereHas('user', fn($q) => $q->where('name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%'));
        return view('admin.clients.index', ['clients' => $query->paginate(20)]);
    }

    public function show($id) {
        $client = ClientProfile::with('user','properties.property','payments.property','documents')->findOrFail($id);
        return view('admin.clients.show', compact('client'));
    }

    public function addPayment(Request $request, $id) {
        $client = ClientProfile::findOrFail($id);
        $data = $request->validate(['property_id'=>'required','total_amount'=>'required|numeric','amount_paid'=>'required|numeric','payment_plan'=>'required','status'=>'required']);
        $data['client_profile_id'] = $id;
        $data['balance'] = $data['total_amount'] - $data['amount_paid'];
        $data['reference'] = 'PAY-'.strtoupper(substr(md5(uniqid()),0,10));
        $data['next_due_date'] = $request->next_due_date ?? null;
        ClientPayment::create($data);
        return back()->with('success','Payment record added!');
    }

    public function uploadDocument(Request $request, $id) {
        $data = $request->validate(['title'=>'required','file'=>'required|file|max:10240','type'=>'required']);
        $path = Storage::disk('public')->put('client-documents', $request->file('file'));
        ClientDocument::create(['client_profile_id'=>$id,'title'=>$data['title'],'file_path'=>$path,'type'=>$data['type'],'uploaded_by'=>auth()->id()]);
        return back()->with('success','Document uploaded!');
    }
}
