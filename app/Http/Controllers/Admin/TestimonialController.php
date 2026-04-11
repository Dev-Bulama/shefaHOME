<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\ImageService;
use Illuminate\Http\Request;

class TestimonialController extends Controller {
    public function index() { return view('admin.testimonials.index', ['testimonials' => Testimonial::orderBy('sort_order')->get()]); }
    public function create() { return view('admin.testimonials.create'); }

    public function store(Request $request) {
        $data = $request->validate(['client_name'=>'required','content'=>'required','rating'=>'integer|min:1|max:5']);
        if($request->hasFile('client_photo')) $data['client_photo'] = ImageService::upload($request->file('client_photo'), 'testimonials');
        $data['client_title']=$request->client_title; $data['rating']=$request->rating??5;
        $data['property']=$request->property; $data['video_url']=$request->video_url;
        $data['is_featured']=$request->boolean('is_featured',true); $data['is_active']=$request->boolean('is_active',true);
        $data['sort_order']=$request->sort_order??0;
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success','Testimonial added!');
    }

    public function edit($id) { return view('admin.testimonials.edit', ['testimonial' => Testimonial::findOrFail($id)]); }

    public function update(Request $request, $id) {
        $t = Testimonial::findOrFail($id);
        $data = $request->validate(['client_name'=>'required','content'=>'required']);
        if($request->hasFile('client_photo')) { if($t->client_photo) ImageService::delete($t->client_photo); $data['client_photo'] = ImageService::upload($request->file('client_photo'), 'testimonials'); }
        $data['client_title']=$request->client_title; $data['rating']=$request->rating??5;
        $data['property']=$request->property; $data['video_url']=$request->video_url;
        $data['is_featured']=$request->boolean('is_featured',true); $data['is_active']=$request->boolean('is_active',true);
        $data['sort_order']=$request->sort_order??0;
        $t->update($data);
        return redirect()->route('admin.testimonials.index')->with('success','Updated!');
    }

    public function destroy($id) { Testimonial::findOrFail($id)->delete(); return redirect()->route('admin.testimonials.index')->with('success','Deleted!'); }
}
