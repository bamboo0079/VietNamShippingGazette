@extends('layouts.master')
@section('content')

<div class="main ts-contain cf right-sidebar" data-title="Viet Nam Shipping Gazette" data-url="http://www.vietnamshippinggazette.com/" style="transform: none;">
    <div class="ts-row" style="transform: none;">
        <div class="col-8 main-content">
            <div class="the-post-header s-head-modern s-head-modern-a">
                <div class="post-meta post-meta-a post-meta-left post-meta-single has-below">
                    <div class="post-meta-items meta-above">
                        <span class="meta-item cat-labels">
                        @if($news->category_id)
                                <a class="category" rel="category" href="{{ route('the.loai', $news->category_id) }}"><span>@if(Session::get('locale') == 'vi') {{ $news->category->name_vn }} @else {{ $news->category->name_en }} @endif</span></a>
                            @else
                                <a class="category" rel="category" href="{{ route('loai.san.pham', $news->product_category_id) }}"><span>@if(Session::get('locale') == 'vi') {{ $news->productcategory->name_vn }} @else {{ $news->productcategory->name_en }} @endif</span></a>
                            @endif
                        </span>
                        <h1 class="is-title post-title">@if(Session::get('locale') == 'vi') {{ $news->title_vn }} @else {{ $news->title_en }} @endif</h1>
                        <div class="post-meta-items meta-below has-author-img">
                            <div class="post-meta-items meta-below item-margin-booton">
                                <span class="meta-item post-author">
                                    <a href="javascript:void(0)" rel="author">{{ __("messages.POST_DATE") }}</a>
                                </span>
                                                                        <span class="meta-item date">
                                <span class="date-link">
                                <time class="post-date" datetime=""> {{ $news->created_at }}</time>
                                </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <article id="post-298" class="post-298 post type-post status-publish format-standard has-post-thumbnail category-example-1">
            <div class="post-content-wrap has-share-float">
                <div class="post-content cf entry-content content-spacious">
                    @if(Session::get('locale') == 'vi') {!! $news->content_vn !!} @else {!! $news->content_en !!} @endif
                </div>
            </div>
        </article>
            </div>
        </div>
        @include('templates.rightBarNews')
    </div>

    <section class="related-posts @if(count($relate_news) == 0) d-none @endif">
        <div class="block-head block-head-ac block-head-e block-head-e2 is-left">
            @if($news->category_id == 1)
                <h4 class="heading"><span class="color">{{ __("messages.RELATE_EVENT") }}</span></h4>
            @else
                <h4 class="heading"><span class="color">{{ __("messages.RELATE_NEWS") }}</span></h4>
            @endif
        </div>
        <section class="block-wrap block-grid cols-gap-sm mb-none" data-id="7">
            <div class="block-content">
                <div class="loop loop-grid loop-grid-sm grid grid-3 md:grid-2 xs:grid-1">
                    @foreach($relate_news as $new)
                        <article class="l-post  grid-base-post grid-post">
                            <div class="media">
                                <a href="{{ route('tin.tuc', $new->id) }}" class="image-link media-ratio ratio-3-2"
                                   title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                    <span data-bgsrc="{{ $new->img }}"
                                          class="img bg-cover wp-post-image attachment-medium size-medium lazyloaded"
                                          data-bgset="{{ $new->img }}"
                                          data-sizes="(max-width: 358px) 100vw, 358px"
                                          style="background-image: url(&quot;{{ $new->img }}&quot;);">
                                    </span>
                                </a>
                            </div>
                            <div class="content">
                                <div class="post-meta post-meta-a has-below">
                                    <h2 class="is-title post-title limit-lines l-lines-2">
                                        <a href="{{ route('tin.tuc', $new->id) }}">
                                            @if(Session::get('locale') == 'vi')
                                                {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                            @else
                                                {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                            @endif
                                        </a>
                                    </h2>
                                    <div class="post-meta-items meta-below item-margin-booton" >
                                        <span class="meta-item post-author">
                                            <a href="javascript:void(0)" rel="author">{{ __("messages.POST_DATE") }}</a>
                                        </span>
                                        <span class="meta-item date">
                                            <span class="date-link">
                                                <time class="post-date" datetime="{{ $new->created_at }}">{{ $new->created_at }}</time>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="post-meta-items meta-below">
                                        <p style="font-size: 14px">@if(Session::get('locale') == 'vi')
                                                {!! \App\Helpers\Helper::limitCharacters($new->content_vn, \App\ConstApp::NUMBER_CHARACTERS_NEW_CONTENT) !!}
                                            @else {!! \App\Helpers\Helper::limitCharacters($new->content_en, \App\ConstApp::NUMBER_CHARACTERS_NEW_CONTENT) !!} @endif</p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </section>
</div>

@stop

