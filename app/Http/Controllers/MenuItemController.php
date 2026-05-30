<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuItemController extends Controller
{
    public function index()
    {
        $items = MenuItem::where('user_id', Auth::id())->latest()->paginate(10);
        return view('menu.index', compact('items'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);

        MenuItem::create([
            'user_id'     => Auth::id(),
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'available'   => $request->boolean('available', true),
        ]);

        return redirect()->route('menu-items.index')
            ->with('toast_success', 'Menu item "' . $request->name . '" added successfully!');
    }

    public function edit(MenuItem $menuItem)
    {
        $this->authorizeItem($menuItem);
        return view('menu.edit', compact('menuItem'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $this->authorizeItem($menuItem);

        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);

        $menuItem->update([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'available'   => $request->boolean('available'),
        ]);

        return redirect()->route('menu-items.index')
            ->with('toast_success', 'Menu item "' . $menuItem->name . '" updated successfully!');
    }

    public function destroy(MenuItem $menuItem)
    {
        $this->authorizeItem($menuItem);
        $name = $menuItem->name;
        $menuItem->delete();
        return redirect()->route('menu-items.index')
            ->with('toast_success', 'Menu item "' . $name . '" deleted successfully!');
    }

    private function authorizeItem(MenuItem $item)
    {
        if ($item->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    }
}
