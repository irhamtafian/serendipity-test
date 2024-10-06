<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Models\Article;

class LatestComposer
{
    public function compose(View $view)
    {
        $newest = Article::with(['category', 'comments'])->orderBy('created_at', 'DESC')->where('status', 'PUBLISH')->paginate(3);
        $view->with('newest', $newest);
    }
}