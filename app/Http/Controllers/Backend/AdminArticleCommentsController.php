<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class AdminArticleCommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::with('article')->orderBy('created_at', 'DESC')->paginate(1000);
        return view('backend.modules.articles.comments.index', compact('comments'));
    }

    public function publish($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = "PUBLISH";
        $comment->save();
        return redirect(route('comments.index'))->with(['success' => 'The comment has been successfully displayed on the post!']);;
    }

    public function delete($id)
    {
        $comment = Comment::withCount(['child'])->find($id);
        if ($comment->child_count == 0) {
            $comment->delete();
            return redirect(route('comments.index'))->with(['success' => 'The comment has been removed!']);
        }
        return redirect(route('comments.index'))->with(['error' => 'Comment has child comments!']); 
    }
}