<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Services\ImageService;
use Illuminate\Http\Request;

class TeamController extends Controller {
    public function index() { return view('admin.team.index', ['members' => TeamMember::orderBy('sort_order')->get()]); }
    public function create() { return view('admin.team.create'); }

    public function store(Request $request) {
        $data = $request->validate(['name'=>'required','position'=>'required','photo'=>'required|image|max:5120']);
        $data['photo'] = ImageService::upload($request->file('photo'), 'team');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['department']=$request->department; $data['bio']=$request->bio; $data['email']=$request->email;
        $data['linkedin']=$request->linkedin; $data['twitter']=$request->twitter; $data['sort_order']=$request->sort_order??0;
        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success','Team member added!');
    }

    public function edit($id) { return view('admin.team.edit', ['member' => TeamMember::findOrFail($id)]); }

    public function update(Request $request, $id) {
        $member = TeamMember::findOrFail($id);
        $data = $request->validate(['name'=>'required','position'=>'required','photo'=>'nullable|image|max:5120']);
        if($request->hasFile('photo')) { ImageService::delete($member->photo); $data['photo'] = ImageService::upload($request->file('photo'), 'team'); } else { unset($data['photo']); }
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['department']=$request->department; $data['bio']=$request->bio; $data['email']=$request->email;
        $data['linkedin']=$request->linkedin; $data['twitter']=$request->twitter; $data['sort_order']=$request->sort_order??0;
        $member->update($data);
        return redirect()->route('admin.team.index')->with('success','Team member updated!');
    }

    public function destroy($id) { $m = TeamMember::findOrFail($id); ImageService::delete($m->photo); $m->delete(); return redirect()->route('admin.team.index')->with('success','Deleted!'); }

    public function reorder(Request $request)
    {
        $ids = $request->input('ids', []);
        foreach ($ids as $order => $id) {
            TeamMember::where('id', $id)->update(['sort_order' => $order]);
        }
        return response()->json(['success' => true]);
    }
}
