<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mengambil semua kategori
        $categories = Categorie::all();
        
        // Mengambil semua pengguna (users)
        $users = User::all();

        // Menampilkan view dengan data kategori dan pengguna
        return view('article.create', compact('categories', 'users'));
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
            'judul' => 'required|min:5',
            'content' => 'required|min:10',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        // Create a new article
        $article = new Article();
        $article->judul = $request->judul;
        $article->content = $request->content;
        $article->category_id = $request->category_id;
        $article->user_id = $request->user_id;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/articles');
            $article->image = basename($imagePath);
        }

        $article->save();

        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
    // Mengambil semua pengguna (users)
    $users = User::all();
    $categories = Categorie::all();
    return view('article.edit', compact('article', 'users','categories'));
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
            'judul' => 'required|min:5',
            'content' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        // Find the article
        $article = Article::findOrFail($id);
        $article->judul = $request->judul;
        $article->content = $request->content;
        $article->category_id = $request->category_id;
        $article->user_id = $request->user_id;

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image
            Storage::delete('public/articles/' . $article->image);
            // Upload new image
            $imagePath = $request->file('image')->store('public/articles');
            $article->image = basename($imagePath);
        }

        $article->save();

        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the article
        $article = Article::findOrFail($id);

        // Delete the image
        Storage::delete('public/articles/' . $article->image);

        // Delete the article
        $article->delete();

        return redirect()->route('article.index');
    }
}