<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'publish_comments'])->orderBy('created_at', 'DESC')->where('status', 'PUBLISH')->paginate(6);
        $latest = Article::with(['category', 'publish_comments'])->orderBy('created_at', 'DESC')->where('status', 'PUBLISH')->paginate(3);
        return view('frontend.pages.articles.index', compact('articles', 'latest'));
    }

    public function article()
    {
        $articles = Article::with(['category', 'publish_comments'])
                            ->orderBy('created_at', 'DESC')
                            ->where('status', 'PUBLISH');

        if (request()->q != '') {
            $articles->where('title', 'LIKE', '%' . request()->q . '%');
        }

        $articles = $articles->paginate(10);

        Paginator::useBootstrap();

        return view('frontend.pages.articles.index', compact('articles'));
    }

    public function categoryArticle($slug)
    {

        if (Category::whereSlug($slug)->exists()){
            $articles = Category::where('slug', $slug)->first()->article()->with(['category', 'publish_comments'])->orderBy('created_at', 'DESC')->where('status', 'PUBLISH')->paginate(8);
            return view('frontend.pages.articles.index', compact('articles'));
        }else{
            return redirect()->back();
       }
    }
    
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
    
        if ($article) {
            $article->increment('views');
            $article = Article::with(['category', 'publish_comments', 'publish_comments.publish_child'])
                ->where('slug', $slug)
                ->first();

            $prev = Article::where('id', '<', $article->id)
                ->where('status', 'PUBLISH')
                ->orderBy('id', 'desc')
                ->first();
    
            $next = Article::where('id', '>', $article->id)
                ->where('status', 'PUBLISH')
                ->orderBy('id')
                ->first();
    
            return view('frontend.pages.articles.detail', compact('article', 'prev', 'next'));
        } else {
            return redirect()->back();
        }
    }
    
    public function comment(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:50',
            'email' => 'required|max:50',
            'comment' => 'required|max:500'
        ]);

        Comment::create([
            'article_id' => $request->id,
            'parent_id' => $request->parent_id != '' ? $request->parent_id:NULL,
            'username' => $request->username,
            'email' => $request->email,
            'comment' => $request->comment,
            'status' => 'DRAFT'
        ]);
        
        return redirect()->back()->with(['success' => 'Comment successfully added and will be displayed if approved']);;
    }

    public function bookmark(Request $request)
    {
        $bookmark = session()->get('bookmarks', []);
        $articleId = $request->article_id;
    
        if (in_array($articleId, $bookmark)) {
            $bookmark = array_diff($bookmark, [$articleId]);
            session()->put('bookmarks', $bookmark);
            return redirect()->back()->with('success', 'Artikel berhasil di-unbookmark');
        }
    
        $bookmark[] = $articleId;
        session()->put('bookmarks', $bookmark);
    
        return redirect()->back()->with('success', 'Artikel berhasil ditambahkan ke bookmark');
    }
    
public function viewBookmark()
{
    $bookmarkIds = session()->get('bookmarks', []);
    
    $articles = Article::whereIn('id', $bookmarkIds)->with('category')->get();

    return view('frontend.pages.bookmark', compact('articles'));
}


    
}