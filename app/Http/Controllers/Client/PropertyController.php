<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;

class PropertyController extends Controller {
    public function index() {
        $profile = auth()->user()->clientProfile()->firstOrFail();
        $properties = $profile->properties()->with(['property','property.propertyType'])->latest()->get();
        return view('client.properties.index', compact('profile','properties'));
    }

    public function show(int $id) {
        $profile = auth()->user()->clientProfile()->firstOrFail();
        $clientProperty = $profile->properties()->with(['property.galleries','property.virtualTours'])->findOrFail($id);
        $payment = $profile->payments()->where('property_id',$clientProperty->property_id)->first();
        return view('client.properties.show', compact('profile','clientProperty','payment'));
    }
}
