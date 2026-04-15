<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SliderController extends Controller {
    public function index() { return view('admin.sliders.index', ['sliders' => Slider::orderBy('sort_order')->get()]); }
    public function create() { return view('admin.sliders.create'); }

    public function store(Request $request) {
        $data = $request->validate(['title'=>'nullable|string|max:255','image'=>'required|image|max:5120','text_position'=>'in:left,center,right']);
        $data['image'] = ImageService::upload($request->file('image'), 'sliders');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['subtitle'] = $request->subtitle; $data['cta_text'] = $request->cta_text;
        $data['cta_url'] = $request->cta_url; $data['cta_text_2'] = $request->cta_text_2;
        $data['cta_url_2'] = $request->cta_url_2; $data['sort_order'] = $request->sort_order ?? 0;
        Slider::create($data);
        return redirect()->route('admin.sliders.index')->with('success','Slider created!');
    }

    public function edit($id) { return view('admin.sliders.edit', ['slider' => Slider::findOrFail($id)]); }

    public function update(Request $request, $id) {
        $slider = Slider::findOrFail($id);
        $data = $request->validate(['title'=>'nullable|string|max:255','image'=>'nullable|image|max:5120']);
        if($request->hasFile('image')) { ImageService::delete($slider->image); $data['image'] = ImageService::upload($request->file('image'), 'sliders'); } else { unset($data['image']); }
        $data['is_active'] = $request->boolean('is_active', true);
        $data['subtitle'] = $request->subtitle; $data['cta_text'] = $request->cta_text;
        $data['cta_url'] = $request->cta_url; $data['cta_text_2'] = $request->cta_text_2;
        $data['cta_url_2'] = $request->cta_url_2; $data['sort_order'] = $request->sort_order ?? 0;
        $data['text_position'] = $request->text_position ?? 'left';
        $slider->update($data);
        return redirect()->route('admin.sliders.index')->with('success','Slider updated!');
    }

    public function destroy($id) { $s = Slider::findOrFail($id); ImageService::delete($s->image); $s->delete(); return redirect()->route('admin.sliders.index')->with('success','Slider deleted!'); }

    public function reorder(Request $request) {
        foreach($request->order as $item) Slider::where('id',$item['id'])->update(['sort_order'=>$item['order']]);
        return response()->json(['success'=>true]);
    }
}
