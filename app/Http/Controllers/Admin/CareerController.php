<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Career, CareerApplication};
use Illuminate\Http\Request;

class CareerController extends Controller {
    public function index() { return view('admin.careers.index', ['careers' => Career::latest()->get()]); }
    public function create() { return view('admin.careers.create'); }

    public function store(Request $request) {
        $data = $request->validate(['title'=>'required','department'=>'required','location'=>'required','type'=>'required|in:full_time,part_time,contract,remote','summary'=>'required','description'=>'required','requirements'=>'required']);
        $data['salary_range']=$request->salary_range; $data['deadline']=$request->deadline??null;
        $data['is_active']=$request->boolean('is_active',true);
        Career::create($data);
        return redirect()->route('admin.careers.index')->with('success','Job posted!');
    }

    public function edit($id) { return view('admin.careers.edit', ['career'=>Career::findOrFail($id)]); }

    public function update(Request $request, $id) {
        $career = Career::findOrFail($id);
        $data = $request->validate(['title'=>'required','department'=>'required','location'=>'required','type'=>'required','summary'=>'required','description'=>'required','requirements'=>'required']);
        $data['salary_range']=$request->salary_range; $data['deadline']=$request->deadline??null;
        $data['is_active']=$request->boolean('is_active',true);
        $career->update($data);
        return redirect()->route('admin.careers.index')->with('success','Job updated!');
    }

    public function destroy($id) { Career::findOrFail($id)->delete(); return redirect()->route('admin.careers.index')->with('success','Deleted!'); }

    public function applications(Request $request) {
        $apps = CareerApplication::with('career')->latest();
        if($request->status) $apps->where('status',$request->status);
        return view('admin.careers.applications', ['applications'=>$apps->paginate(20)]);
    }

    public function showApplication($id) {
        $application = CareerApplication::with('career')->findOrFail($id);
        return view('admin.careers.applications', ['application'=>$application, 'applications'=>CareerApplication::with('career')->latest()->paginate(20)]);
    }

    public function updateApplicationStatus(Request $request, $id) {
        $request->validate(['status'=>'required|in:new,reviewed,shortlisted,rejected']);
        CareerApplication::findOrFail($id)->update(['status'=>$request->status]);
        return redirect()->back()->with('success','Application status updated!');
    }
}
