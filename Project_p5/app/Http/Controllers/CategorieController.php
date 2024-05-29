<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::latest()->paginate(5);
        return view('categorie.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form
        $request->validate([
            'name_category' => 'required|min:5',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'url' => 'required|url', // Validasi untuk URL
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('public/categories');
        $imageName = basename($imagePath);

        // Create new category
        $category = new Categorie();
        $category->name_category = $request->name_category;
        $category->image = $imageName;
        $category->url = $request->url; // Simpan URL
        $category->save();

        return redirect()->route('categorie.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categorie::findOrFail($id);
        return view('categorie.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate form
        $request->validate([
            'name_category' => 'required|min:5',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'url' => 'required|url', // Validasi untuk URL
        ]);

        // Find category by id
        $category = Categorie::findOrFail($id);

        // Update category details
        $category->name_category = $request->name_category;
        $category->url = $request->url; // Simpan URL

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            Storage::delete('public/categories/' . $category->image);
            $imagePath = $request->file('image')->store('public/categories');
            $imageName = basename($imagePath);
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('categorie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categorie::findOrFail($id);

        // Delete image from storage
        Storage::delete('public/categories/' . $category->image);

        // Delete category from database
        $category->delete();

        return redirect()->route('categorie.index');
    }

    public function show($id)
    {
        $category = Categorie::findOrFail($id);
        return view('categorie.show', compact('category'));
    }
}