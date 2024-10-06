@extends('frontend.layouts.base')
@section('title', 'Articles')

@section('content')

<section>
    <div class="w-100 position-relative" style="background: linear-gradient(0deg, rgba(11,68,50,1) 0%, rgba(197,160,64,1) 100%);">
        <div class="pg-title-wrap pt-150 pb-40 position-relative w-100 mouse_anim scroll_anim">
            <div class="fixed-bg" style="background-image: url(assets/frontend/images/statis/articles-header.png);"></div>
            <div class="container">
                <div class="pg-title-inner text-center position-relative w-100">
                    <h1>Articles <i class="btm-ln v2 bg-color27"></i></h1>
                    <ol class="breadcrumb d-inline-flex justify-content-center align-items-center flex-wrap">
                        <li class="breadcrumb-item"><a href="/articles" title="Articles">Articles</a></li>
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
                                        @forelse($articles as $row)  
                                        <div class="col-md-6 col-sm-12 col-lg-6">
                                            <div class="post-box brd-rd15 w-100">
                                                <div class="post-img overflow-hidden position-relative w-100">
                                                    <a href="{{ url('/articles/' . $row->slug) }}" title="">
                                                        <img class="img-fluid w-100" src="{{ asset('storage/'.$row->header_articles) }}" alt="{{ $row->title }}" height="576" width="1024">
                                                    </a>
                                                    <span class="post-date brd-rd15 text-center position-absolute text-uppercase">
                                                        <i><font color="#0b4432">{{ $row->created_at->format('d') }}</i>{{ $row->created_at->format('M') }}</font></span>
                                                </div>
                                                <div class="post-info w-100">
                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <span class="post-cate d-block text-uppercase">
                                                            <a href="javascript:void(0);" title="">{{ $row->category->name }}</a>
                                                        </span>
                                                        <span class="">
                                                            <form action="{{ route('articles.bookmark') }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                <input type="hidden" name="article_id" value="{{ $row->id }}">
                                                                <button type="submit" title="">
                                                                    {{ in_array($row->id, session()->get('bookmarks', [])) ? 'Unbookmark' : 'Bookmark' }}
                                                                </button>
                                                            </form>
                                                        </span>
                                                    </div>
                                                    
                                                    @if (str_word_count($row->title) > 2)
                                                    <h3 class="mb-0"><a href="{{ url('/articles/' . $row->slug) }}" title="">
                                                        {{ substr($row->title, 0, strpos($row->title, ' ', 30)) }}... </a>
                                                    </h3>
                                                    @else
                                                    <h3 class="mb-0"><a href="{{ url('/articles/' . $row->slug) }}" title="">
                                                        {{ $row->title }}</a>
                                                    </h3>
                                                    @endif

                                                    @if (str_word_count($row->content) > 20)
                                                        <p class="mb-0">{{ substr($row->content, 0, strpos($row->content, ' ', 81)) }}...</p>
                                                    @else
                                                        <p class="mb-0">{{ $row->content }}</p>
                                                    @endif
                                                    <a class="simple-link d-inline-block text-uppercase" href="{{ url('/articles/' . $row->slug) }}" title="">Read More <i class="flaticon-right-arrow text-color29"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        @empty      
                                        <div class="uk-text-center">
                                            There is no blog data yet
                                        </div>
                                        @endforelse                                                                           
                                    </div>
                                    <div class="d-flex justify-content-center"> 
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination">
                                                @if ($articles->onFirstPage())
                                                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">&laquo;</span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link" href="{{ $articles->previousPageUrl() }}" aria-label="Previous">&laquo;</a></li>
                                                @endif
                                            
                                                @for ($i = 1; $i <= $articles->lastPage(); $i++)
                                                    <li class="page-item {{ ($i == $articles->currentPage()) ? 'active' : '' }}"><a class="page-link" href="{{ $articles->url($i) }}">{{ $i }}</a></li>
                                                @endfor
                                            
                                                @if ($articles->hasMorePages())
                                                    <li class="page-item"><a class="page-link" href="{{ $articles->nextPageUrl() }}" aria-label="Next">&raquo;</a></li>
                                                @else
                                                    <li class="page-item disabled"><span class="page-link" aria-hidden="true">&raquo;</span></li>
                                                @endif
                                            </ul>
                                        </nav>
                                    </div>
                                    
                                </div><!-- Blog Wrap -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-3">
                        <div class="leftside">
                            <div class="theiaStickySidebar">
                                <aside class="sidebar-wrap w-100 position-relative">
                                    <div class="widget w-100">
                                        <form action="{{ route('front.article') }}" method="get" class="searchform position-relative w-100">
                                            <input type="text" name="q" type="text" placeholder="Search..." value="{{ Request::get('q') }}">
                                            <button type="submit"><i class="flaticon-magnifying-glass"></i></button>
                                        </form>
                                    </div>
                                    <div class="widget v2 w-100 bg-color11">
                                        <h3>Must Read Posts</h3>
                                        <div class="recentposts-wrap w-100">
                                            @foreach($random as $rand)
                                            <div class="recentpost-box d-flex flex-wrap align-items-center w-100">
                                                <div class="recentpost-img">
                                                    <a href="{{ url('/articles/' . $rand->slug) }}" title="">
                                                        <img class="img-fluid w-100" src="{{ asset('storage/'.$rand->header_articles) }}" alt="{{ $rand->title }}">
                                                    </a>
                                                </div>
                                                <div class="recentpost-info">
                                                    <h5 class="mb-0">
                                                        <a href="{{ url('/articles/' . $rand->slug) }}" title="">{{ strlen($rand->title) > 40 ? substr($rand->title, 0, 24) . '...' : $rand->title }}</a>
                                                    </h5>
                                                    <span class="d-block">
                                                        <font color="white">
                                                            <a href="javascript:void(0);" title="">{{ $rand->created_at->format('F j, Y') }}</a>
                                                        </font>
                                                    </span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div><!-- Recent Posts Wrap -->
                                    </div>
                                    <div class="widget v2 w-100 bg-color11">
                                        <h3>Categories</h3>
                                        <ul class="mb-0 list-unstyled w-100">
                                            @foreach($categories as $cat)
                                            <li><a href="{{ url('/articles/category/' . $cat->slug) }}" title="">{{ $cat->name }} ({{ $cat->article->count() }})</a></li>
                                            @endforeach
                                        </ul>
                                    </div> 
                                </aside><!-- Sidebar Wrap -->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Blog Wrap -->
        </div>
    </div>
</section>
@endsection
