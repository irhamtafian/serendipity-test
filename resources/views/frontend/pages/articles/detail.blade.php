@extends('frontend.layouts.base')
@section('title', 'Articles')

@section('content')

<section>
    <div class="w-100 position-relative" style="background: linear-gradient(0deg, rgba(11,68,50,1) 0%, rgba(197,160,64,1) 100%);">
        <div class="pg-title-wrap pt-150 pb-40 position-relative w-100 mouse_anim scroll_anim">
            <div class="fixed-bg" style="background-image: url(assets/frontend/images/statis/articles-header.png);"></div>
            <div class="container">
                <div class="pg-title-inner text-center position-relative w-100">
                    <h1>Article Details<i class="btm-ln v2 bg-color27"></i></h1>
                    <ol class="breadcrumb d-inline-flex justify-content-center align-items-center flex-wrap">
                        <li class="breadcrumb-item"><a href="/articles" title="Articles">Articles</a></li>
                        <li class="breadcrumb-item active">Article Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- Page Title Wrap -->
    </div>
</section>

<section>
    <div class="w-100 pt-120 pb-120 position-relative bg-color26">
        <div class="container">
            <div class="blog-wrap blog-wth-sidebar blog-spac position-relative w-100">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-9">
                        <div class="w-100 pb-20 position-relative">
                            <div class="container">
                                <div class="post-detail-wrap position-relative w-100">
                                    <div class="post-detail-img w-100">
                                        <img class="img-fluid w-100" src="{{ asset('storage/'.$article->header_articles) }}" alt="{{ $article->title }}" height="576" width="1024">
                                    </div>
                                    <div class="port-detail-desc  w-100">
                                        <span class="like mt-10 d-block">
                                            <a href="javascript:void(0);" title="">
                                                <i class="flaticon-view"></i>{{ $article->views }} Views</a>
                                            <a href="{{ url('/articles/category/' . $article->category->slug) }}" style="margin-right:10px; margin-left:10px" title="">
                                                <i class="flaticon-label"></i>{{$article->category->name}}</a>
                                            <a href="javascript:void(0);" title="">
                                                <i class="flaticon-calendar"></i>{{$article->created_at->format('F j, Y')}}
                                            </a>
                                        </span>
                                        <h2 class="mb-0 mt-35 ">{{ $article->title }}</h2>
                                        <p class="mb-0">{!!$article->content!!}</p>
                                    </div>
          
                                    <div class="reply-form-wrap w-100 mt-45 mb-60">
                                        <div class="devider bg-color25 mb-45 w-100"></div>
                                        
                                        @if ($article->publish_comments->count() > 0)
                                        <div class="sec-title w-100 position-relative">
                                            <h4 class="mb-0">This Post Has {{$article->publish_comments->count()}} Comments</h4>
                                            <i class="btm-ln bg-color3"></i>
                                        </div><!-- Sec Title -->
                                        <ul class="comment-thread mb-0 list-unstyled w-100">
                                            @foreach ($article->publish_comments as $com)
                                                <li>
                                                    <div class="comment w-100 d-flex flex-wrap align-items-center">
                                                        <img class="img-fluid brd-rd10" src="{{ asset('assets/frontend/images/resources/profile-comments.png') }}" alt="Comment Image 1">
                                                        <div class="comment-info">
                                                            <h4 class="mb-0 d-inline-block">{{ $com->username }}</h4>
                                                            <span class="d-inline-block">{{ $com->created_at->format('F j, Y') }}</span>
                                                            <p class="mb-0">{{ $com->comment }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach	
                                        </ul>
                                        @endif
                                    
                                            <div class="reply-form-wrap mt-45 w-100">
                                                <div class="sec-title w-100 position-relative">
                                                    <h3 class="mb-0">Add a Comment</h3>
                                                    <i class="btm-ln bg-color3"></i>
                                                </div><!-- Sec Title -->
                                                @if (session('success'))
                                                <div class="">
                                                    <div class="alert alertstyle2 mb-30 alert-dismissible d-flex align-items-center flex-wrap fade show brd-rd15">
                                                        <i class="flaticon-check-mark-black-outline"></i>
                                                        <div class="alert-inner-info">
                                                            <h4 class="alert-heading mb-0">Success</h4>
                                                            <p class="mb-0">{{ session('success') }}</p>
                                                        </div>
                                                        <button type="button" class="close rounded-circle" data-bs-dismiss="alert" aria-label="Close"><i class="flaticon-delete"></i></button>
                                                    </div>
                                                </div>
                                                @endif
                    
                                                @if (session('error'))
                                                <div class="">
                                                    <div class="alert alert-danger mb-30 alert-dismissible d-flex align-items-center flex-wrap fade show brd-rd15">
                                                        <i class="flaticon-delete"></i>
                                                        <div class="alert-inner-info">
                                                            <h4 class="alert-heading mb-0">Error Message</h4>
                                                            <p class="mb-0">{{ session('error') }}</p>
                                                        </div>
                                                        <button type="button" class="close rounded-circle" data-dismiss="alert" aria-label="Close"><i class="flaticon-delete"></i></button>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="review-rate w-100">
                                                    <p class="mb-0">Your email address will not be published. Required fields are marked *</p>
                                                </div>
                                                <form id="comment-form" class="w-100" action="{{ url('/comment') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $article->id }}" class="form-control">
                                                    <input type="hidden" name="parent_id" id="parent_id" class="form-control">
                                                    <div class="row mrg20">
                                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                                            <div class="field-box w-100">
                                                                <label>Name <sup class="text-color3">*</sup></label>
                                                                <input type="text" name="username" placeholder="Your Name" required>
                                                                <p class="text-white" style="color: white; font-style: italic; background-color: red; border-radius: 10px; padding: 0 10px; margin-top: 5px;">{{ $errors->first('username') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                                            <div class="field-box w-100">
                                                                <label>Email <sup class="text-color3">*</sup></label>
                                                                <input type="email" name="email" placeholder="Your Email" required>
                                                                <p class="text-white" style="color: white; font-style: italic; background-color: red; border-radius: 10px; padding: 0 10px; margin-top: 5px;">{{ $errors->first('email') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                            <div class="field-box w-100">
                                                                <label>Comment <sup class="text-color3">*</sup></label>
                                                                <textarea name="comment"  placeholder="Your Comment" required></textarea>
                                                                <p class="text-white" style="color: white; font-style: italic; background-color: red; border-radius: 10px; padding: 0 10px; margin-top: 5px;">{{ $errors->first('comment') }}</p>
                                                            </div>
                                                            <div class="field-btn w-100">
                                                               <button id="comment-button" class="thm-btn d-inline-block rounded-pill" type="submit">Submit</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div><!-- Reply Form Wrap -->
                                    </div><!-- Reply Form Wrap -->

                                    <div class="post-nav w-100 d-flex flex-wrap justify-content-between">
                                        @if($prev)
                                            <div class="post-nav-item post-prev">
                                                <a class="d-block" href="{{ url('/articles/' . $prev->slug) }}" title="{{ $prev->title }}">
                                                    <div class="post-nav-item d-flex flex-wrap align-items-center">
                                                        <img class="img-fluid" src="{{ asset('storage/'.$prev->header_articles) }}" alt="Post Prev Image">
                                                        <div class="post-nav-item-info">
                                                            <span>Prev Post</span>
                                                            <h5 class="mb-0">{{ strlen($prev->title) > 40 ? substr($prev->title, 0, 35) . '...' : $prev->title }}</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                        
                                        <div class="flex-grow-1"></div>
                                        
                                        @if($next)
                                            <div class="post-nav-item post-next">
                                                <a class="d-block" href="{{ url('/articles/' . $next->slug) }}" title="{{ $next->title }}">
                                                    <div class="post-nav-item d-flex flex-wrap align-items-center">
                                                        <div class="post-nav-item-info">
                                                            <span>Next Post</span>
                                                            <h5 class="mb-0">{{ strlen($next->title) > 40 ? substr($next->title, 0, 35) . '...' : $next->title }}</h5>
                                                        </div>
                                                        <img class="img-fluid" src="{{ asset('storage/'.$next->header_articles) }}" alt="Post Next Image">
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    </div><!-- Post Navigation -->
                                    
                                    
                                    
                                </div><!-- Post Detail Wrap -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-3">
                        <div class="leftside">
                            <div class="theiaStickySidebar">
                                <aside class="sidebar-wrap w-100 position-relative">
                                    <div class="widget w-100">
                                        <form action="{{ route('front.article') }}" method="get" class="searchform position-relative w-100">
                                            <input type="text" name="q" type="text" placeholder="Search..." value="{{Request::get('q')}}">
                                            <button type="submit"><i class="flaticon-magnifying-glass"></i></button>
                                        </form>
                                    </div>
                                    <div class="widget v2 w-100 bg-color11">
                                        <h3>Must Read Posts</h3>
                                        <div class="recentposts-wrap w-100">
                                            @foreach($random as $rand)
                                            <div class="recentpost-box d-flex flex-wrap align-items-center w-100">
                                                <div class="recentpost-img"><a href="{{ url('/articles/' . $rand->slug) }}" title=""><img class="img-fluid w-100" src="{{ asset('storage/'.$rand->header_articles) }}" alt="{{ $rand->title }}"></a></div>
                                                <div class="recentpost-info">
                                                    <h5 class="mb-0"><a href="{{ url('/articles/' . $rand->slug) }}" title="">{{ strlen($rand->title) > 40 ? substr($rand->title, 0, 24) . '...' : $rand->title }}</a></h5>
                                                    <span class="d-block"><font color="white"><a href="javascript:void(0);" title="">{{$rand->created_at->format('F j, Y')}}</a></font></span>
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