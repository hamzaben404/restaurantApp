<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuStoreRequest $req)
    {
        // dd($req->all());
        $image = $req->file('image')->store('public/menus');
        $menu = Menu::create([
            'name' => $req->name,
            'description' => $req->description,
            'image' => $image,
            'price' => $req->price,
        ]);

        if ($req->has('categories')) {
            $menu->categories()->attach($req->input('categories'));
        }
        return to_route('admin.menus.index')->with('success', 'Menu created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menus.edit', compact(['categories', 'menu']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Menu $menu)
    {
        // dd($req->all());
        $req->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        $image = $menu->image;
        if ($req->hasFile('image')) {
            Storage::delete($menu->image);
            $image = $req->file('image')->store('public/menus');
        }
        $menu->update([
            'name' => $req->name,
            'description' => $req->description,
            'image' => $image,
            'price' => $req->price
        ]);

        if ($req->has('categories')) {
            $menu->categories()->sync($req->input('categories'));
        }

        return to_route('admin.menus.index')->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        Storage::delete($menu->image);
        // $menu->categories()->detach();
        $menu->delete();

        return to_route('admin.menus.index')->with('danger', 'Menu deleted successfully.');
    }
}
