<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $status = $request->get('status');
        $filterKeyword = $request->get('q') ? $request->get('q') : '';

        $articles = Article::orderBy('created_at', 'ASC')->paginate(1000);
        return view('backend.modules.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('name', 'ASC')->get();
        return view('backend.modules.articles.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    Validator::make($request->all(), [
        "title" => "required|min:1|max:200|unique:articles",
        "header_articles" => "required|image|mimes:jpg,jpeg,png|max:20000",
        "content" => "required|min:1|max:20000",
        "category_id" => "required|exists:categories,id"
    ])->validate();

    $new_article = new Article;

    $new_article->title = $request->get('title');
    $new_article->content = $request->get('content');
    $new_article->status = $request->get('save_action');

    if ($request->file('header_articles')) {
        $header_articles_path = $request->file('header_articles')->store('thumbnail', 'public');
        $new_article->header_articles = $header_articles_path;
    }

    $new_article->slug = $request->get('title');
    $new_article->category_id = $request->get('category_id');
    $new_article->created_by = Auth::user()->name;

    $new_article->save();

    if ($request->get('save_action') == 'PUBLISH') {
        return redirect()->route('articles.index')->with('success', 'Article successfully saved and published!');
    } else {
        return redirect()->route('articles.index')->with('draft', 'Article successfully saved as draft!');
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
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
        $category = Category::orderBy('name', 'ASC')->get();
        return view('backend.modules.articles.edit',compact('article', 'category'));
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
         Validator::make($request->all(), [
             "title" => "required|max:200|unique:articles,title," . $id,
             "header_articles" => "image|mimes:jpg,jpeg,png|max:20000",
             "content" => "required|max:20000",
             "category_id" => "required|exists:categories,id"
         ])->validate();
     
         $article = Article::findOrFail($id);
     
         $isChanged = $article->title != $request->get('title') ||
                      $article->content != $request->get('content') ||
                      $article->category_id != $request->get('category_id') ||
                      $request->file('header_articles') ||
                      $article->status != $request->get('save_action');
     
         if (!$isChanged) {
             return redirect()->route('articles.index')->with('info', 'No changes were made to the articles data');
         }
     
         $article->title = $request->get('title');
         $article->slug = $request->get('title');
         $article->content = $request->get('content');
         $article->category_id = $request->get('category_id');
     
         if ($request->file('header_articles')) {
             if ($article->header_articles && file_exists(storage_path('app/public/' . $article->header_articles))) {
                 Storage::delete('public/' . $article->header_articles);
             }
             $new_header_articles_path = $request->file('header_articles')->store('thumbnail', 'public');
             $article->header_articles = $new_header_articles_path;
         }
     
         $article->updated_by = Auth::user()->name;
         $previousStatus = $article->status;
         $article->status = $request->get('save_action');
         $article->save();
     
         if ($previousStatus != $article->status) {
             if ($article->status == 'PUBLISH') {
                 return redirect()->route('articles.index')->with('success', 'Article successfully updated and published!');
             } else {
                 return redirect()->route('articles.index')->with('draft', 'Article successfully updated and saved as draft!');
             }
         } else {
             return redirect()->route('articles.index')->with('success', 'Article successfully updated!');
         }
     }
     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if($article->header_articles && file_exists(storage_path('app/public/'.$article->header_articles))){
            Storage::delete('public/'.$article->header_articles);
        }

        $comments = $article->comments();

        foreach($comments->get() as $comment){
            $comment->child()->delete();
        }
        
        $article->comments()->delete();
        $article->delete();

        return redirect()->route('articles.index')->with('success','Article has been deleted!');
    }
}