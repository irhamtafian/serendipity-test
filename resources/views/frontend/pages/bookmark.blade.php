@extends('frontend.layouts.base')
@section('title', 'Bookmarks')

@section('content')

<section>
    <div class="w-100 position-relative" style="background: linear-gradient(0deg, rgba(11,68,50,1) 0%, rgba(197,160,64,1) 100%);">
        <div class="pg-title-wrap pt-150 pb-40 position-relative w-100 mouse_anim scroll_anim">
            <div class="fixed-bg" style="background-image: url(assets/frontend/images/statis/bookmarks-header.png);"></div>
            <div class="container">
                <div class="pg-title-inner text-center position-relative w-100">
                    <h1>Your Bookmarked Articles <i class="btm-ln v2 bg-color27"></i></h1>
                    <ol class="breadcrumb d-inline-flex justify-content-center align-items-center flex-wrap">
                        <li class="breadcrumb-item"><a href="/articles" title="Articles">Articles</a></li>
                        <li class="breadcrumb-item active">Bookmarks</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="w-100 pt-120 pb-120 position-relative bg-color26">
        <div class="container">
            <div class="blog-wrap blog-wth-sidebar blog-spac position-relative w-100">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-9">
                        <div class="w-100 pb-120 position-relative">
                            <div class="container">
                                <div class="blog-wrap blog-spac position-relative w-100">
                                    <div class="row mrg30 justify-content-start">
                                        @forelse($articles as $article)  
                                        <div class="col-md-6 col-sm-12 col-lg-6">
                                            <div class="post-box brd-rd15 w-100">
                                                <div class="post-img overflow-hidden position-relative w-100">
                                                    <a href="{{ url('/articles/' . $article->slug) }}" title="">
                                                        <img class="img-fluid w-100" src="{{ asset('storage/'.$article->header_articles) }}" alt="{{ $article->title }}" height="576" width="1024">
                                                    </a>
                                                    <span class="post-date brd-rd15 text-center position-absolute text-uppercase">
                                                        <i><font color="#0b4432">{{ $article->created_at->format('d') }}</font>{{ $article->created_at->format('M') }}</i>
                                                    </span>
                                                </div>
                                                <div class="post-info w-100">
                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <span class="post-cate d-block text-uppercase">
                                                            <a href="javascript:void(0);" title="">{{ $article->category->name }}</a>
                                                        </span>
                                                        <span class="">
                                                            <form action="{{ route('articles.bookmark') }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                                                <button type="submit" title="">
                                                                    Unbookmark
                                                                </button>
                                                            </form>
                                                        </span>
                                                    </div>
                                                    
                                                    <h3 class="mb-0"><a href="{{ url('/articles/' . $article->slug) }}" title="">
                                                        {{ strlen($article->title) > 30 ? substr($article->title, 0, 30) . '...' : $article->title }}
                                                    </a></h3>

                                                    <p class="mb-0">{{ strlen($article->content) > 80 ? substr($article->content, 0, 80) . '...' : $article->content }}</p>
                                                    <a class="simple-link d-inline-block text-uppercase" href="{{ url('/articles/' . $article->slug) }}" title="">Read More <i class="flaticon-right-arrow text-color29"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        @empty      
                                        <div class="col-12 text-center">
                                            <p>No bookmarks available</p>
                                        </div>
                                        @endforelse                                                                           
                                    </div>
                                    
                                </div><!-- Blog Wrap -->
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div><!-- Blog Wrap -->
        </div>
    </div>
</section>
@endsection
