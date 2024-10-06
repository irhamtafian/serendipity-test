<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Models\Article;

class RandomComposer
{
    public function compose(View $view)
    {
        $random = Article::with(['category', 'comments'])->inRandomOrder()->where('status', 'PUBLISH')->paginate(3);
        $view->with('random', $random);
    }
}