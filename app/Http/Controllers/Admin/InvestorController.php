<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{InvestorProfile, InvestorReturn, InvestorDocument, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvestorController extends Controller {
    public function index(Request $request) {
        $query = InvestorProfile::with('user')->latest();
        if($request->tier) $query->where('tier',$request->tier);
        if($request->search) $query->whereHas('user', fn($q) => $q->where('name','like','%'.$request->search.'%'));
        return view('admin.investors.index', ['investors' => $query->paginate(20)]);
    }

    public function show($id) {
        $investor = InvestorProfile::with('user','returns.property','documents')->findOrFail($id);
        return view('admin.investors.show', compact('investor'));
    }

    public function approve(Request $request, $id) {
        $investor = InvestorProfile::findOrFail($id);
        $investor->update(['is_verified'=>true,'verified_at'=>now(),'tier'=>$request->tier??$investor->tier]);
        $investor->user->update(['is_verified'=>true]);
        return back()->with('success','Investor approved!');
    }

    public function addReturn(Request $request, $id) {
        $data = $request->validate(['property_id'=>'required','amount_invested'=>'required|numeric','return_percentage'=>'required|numeric','investment_date'=>'required|date','status'=>'required']);
        $data['investor_profile_id'] = $id;
        $data['return_amount'] = $data['amount_invested'] * ($data['return_percentage'] / 100);
        $data['reference'] = 'RET-'.strtoupper(substr(md5(uniqid()),0,10));
        $data['maturity_date'] = $request->maturity_date ?? null;
        $data['notes'] = $request->notes;
        InvestorReturn::create($data);
        // Update total invested
        $investor = InvestorProfile::findOrFail($id);
        $investor->update(['total_invested' => $investor->returns()->sum('amount_invested'), 'total_returns' => $investor->returns()->where('status','paid')->sum('return_amount')]);
        return back()->with('success','Return record added!');
    }

    public function uploadDocument(Request $request, $id) {
        $data = $request->validate(['title'=>'required','file'=>'required|file|max:10240','type'=>'required']);
        $path = Storage::disk('public')->put('investor-documents', $request->file('file'));
        InvestorDocument::create(['investor_profile_id'=>$id,'title'=>$data['title'],'file_path'=>$path,'type'=>$data['type'],'uploaded_by'=>auth()->id()]);
        return back()->with('success','Document uploaded!');
    }
}
