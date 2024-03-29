@extends('templates.master')
@section('content')
    <style type="text/css">
        .lazyload, .lazyloading {
            opacity: unset !important;
        }
    </style>
    <div class="main ts-contain cf right-sidebar spc-alp-main">
        <div class="ts-row">
            <div class=" @if(count($hot_news) > 0 || count($paid_news) > 0 ) {{ 'col-8 main-content' }} @else {{ 'col-12' }} @endif">
                <h1 class="archive-heading"><span>{{ __("messages.VSG_NEWS_TITLE") }}</span></h1>
                <section class="block-wrap block-grid mb-none" data-id="8">
                    <div class="block-content">
                        @if(count($news))
                            <div class="loop loop-grid loop-grid-base grid  @if(count($hot_news) > 0 || count($paid_news) > 0 ) {{ 'grid-3' }} @else {{ 'grid-4' }} @endif md:grid-2 xs:grid-1">
                                @forelse($news as $new)
                                    <article class="l-post  grid-base-post grid-post">
                                        <div class="media">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#youtubeModal{{$new->id}}" data-toggle="modal" class="image-link media-ratio ratio-16-9" title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                            {{--<span
                                                    data-bgsrc="{{ $new->img }}"
                                                    class="img bg-cover wp-post-image attachment-bunyad-medium size-bunyad-medium lazyload"
                                                    data-bgset="{{ $new->img }}"
                                                    data-sizes="(max-width: 358px) 100vw, 358px"></span>--}}
                                                <img class="img size-bunyad-medium lazyload" src="{{ $new->img }}" title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                            </a>
                                            <div id="youtubeModal{{$new->id}}" class="modal fade modal-video bd-example-modal-lg" data-youtube-url="{{ $new->youtube_url }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <button style="background: #fff;color: #000;font-size: 20px;font-weight: bold;text-align: right;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <div class="modal-body">
                                                            <iframe width="100%" height="300" src="{{ $new->youtube_url }}" title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="post-meta post-meta-a has-below">
                                                <h2
                                                        class="is-title post-title"><a
                                                            href="#" data-bs-toggle="modal" data-bs-target="#youtubeModal{{$new->id}}" data-toggle="modal">@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif</a>
                                                </h2>

                                                <div class="post-meta-items meta-below">
                                                    <span class="meta-item post-author">
                                                        <a href="javascript:void(0)" title="Posts by Shane Doe" rel="author">{{ __("messages.POST_DATE") }}</a>
                                                    </span>
                                                        <span class="meta-item date">
                                                        <span class="date-link">
                                                            <time class="post-date" datetime="{{ date('d/m/Y',strtotime($new->created_at)) }}"> {{ date('d/m/Y',strtotime($new->created_at)) }}</time>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <div class="loop loop-grid loop-grid-base grid grid-2 md:grid-2 xs:grid-1">
                                <p>{{ __("messages.PRODUCT_UPDATING") }}</p>
                            </div>
                        @endif
                        {{ $news->appends($_GET)->links('paginations.admin') }}
                    </div>
                </section>
            </div>

            @include('templates.news.rightBarNews')
        </div>
    </div>

@stop