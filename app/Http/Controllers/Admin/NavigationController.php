<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationMenu;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index()
    {
        $items = NavigationMenu::with('children')
            ->topLevel()
            ->orderBy('location')
            ->orderBy('sort_order')
            ->get();

        return view('admin.navigation.index', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label'         => 'required|string|max:100',
            'url'           => 'required|string|max:500',
            'location'      => 'required|in:header,footer,both',
            'parent_id'     => 'nullable|exists:navigation_menus,id',
            'opens_new_tab' => 'boolean',
            'is_active'     => 'boolean',
        ]);

        $data['sort_order']     = NavigationMenu::max('sort_order') + 1;
        $data['opens_new_tab']  = $request->boolean('opens_new_tab');
        $data['is_active']      = $request->boolean('is_active', true);

        NavigationMenu::create($data);

        return back()->with('success', 'Menu item added successfully.');
    }

    public function update(Request $request, int $id)
    {
        $item = NavigationMenu::findOrFail($id);

        $data = $request->validate([
            'label'         => 'required|string|max:100',
            'url'           => 'required|string|max:500',
            'location'      => 'required|in:header,footer,both',
            'parent_id'     => 'nullable|exists:navigation_menus,id',
            'opens_new_tab' => 'boolean',
            'is_active'     => 'boolean',
        ]);

        $data['opens_new_tab'] = $request->boolean('opens_new_tab');
        $data['is_active']     = $request->boolean('is_active', true);

        $item->update($data);

        return back()->with('success', 'Menu item updated.');
    }

    public function destroy(int $id)
    {
        $item = NavigationMenu::findOrFail($id);
        // Detach children before deleting
        NavigationMenu::where('parent_id', $id)->update(['parent_id' => null]);
        $item->delete();

        return back()->with('success', 'Menu item deleted.');
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order', []);
        foreach ($order as $index => $id) {
            NavigationMenu::where('id', $id)->update(['sort_order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
