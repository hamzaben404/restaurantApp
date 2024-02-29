<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);
        $image = $req->file('image')->store('public/categories');
        Category::create([
            'name' => $req->name,
            'description' => $req->description,
            'image' => $image
        ]);

        return to_route('admin.categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Category $category)
    {
        $req->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $image = $category->image;
        if($req->hasFile('image'))
        {
            Storage::delete($category->image);
            $image = $req->file('image')->store('public/categories');
        }
        $category->update([
            'name' => $req->name,
            'description' => $req->description,
            'image' => $image
        ]);

        return to_route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // dd($category);
        $name = $category->name;
        Storage::delete($category->image);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('danger', 'Category '.$name.' deleted.');
    }

    // private function upload_image(CategoryStoreRequest $req)
    // {
    //     if ($req->hasFile('image')) {
    //         return $req->file('image')->storeAs('publication', $req->file('image')->getClientOriginalName(), 'public');
    //     }
    // }
}
