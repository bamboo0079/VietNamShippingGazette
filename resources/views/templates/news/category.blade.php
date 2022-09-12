@extends('templates.master')
@section('content')

    <div class="main ts-contain cf right-sidebar">
        <div class="ts-row">
            <div class="col-8 main-content">
                <h1 class="archive-heading"><span>@if(Session::get('locale') == 'vi') {{ $category->name_vn }} @else {{ $category->name_en }} @endif</span></h1>
                <section class="block-wrap block-grid mb-none" data-id="8">
                    <div class="block-content">
                        <div class="loop loop-grid loop-grid-base grid grid-2 md:grid-2 xs:grid-1">
                            @forelse($news as $new)
                                @if($new->youtube_url == '')
                                    <article class="l-post  grid-base-post grid-post">
                                        <div class="media">
                                            <a href="{{ route('tin.tuc', $new->id) }}" class="image-link media-ratio ratio-16-9" title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
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
                                                <h2 class="is-title post-title">
                                                    <a href="{{ route('tin.tuc', $new->id) }}">
                                                        @if(Session::get('locale') == 'vi')
                                                            {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                        @else
                                                            {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <div class="post-meta-items meta-below">
                                                    <span class="meta-item post-author">
                                                        <a href="javascript:void(0)" rel="author">{{ __("messages.POST_DATE") }}</a>
                                                    </span>
                                                                                                <span class="meta-item date">
                                                    <span class="date-link">
                                                    <time class="post-date" datetime=""> {{ $new->created_at }}</time>
                                                    </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="excerpt">
                                                <p style="font-size: 14px">
                                                    @if(Session::get('locale') == 'vi')
                                                        {!! \App\Helpers\Helper::limitCharacters($new->content_vn, \App\ConstApp::NUMBER_CHARACTERS_NEW_CONTENT) !!}
                                                    @else {!! \App\Helpers\Helper::limitCharacters($new->content_en, \App\ConstApp::NUMBER_CHARACTERS_NEW_CONTENT) !!} @endif
                                                </p>
                                            </div>
                                        </div>
                                    </article>
                                @else
                                    <article class="l-post  grid-base-post grid-post">
                                        <div class="media">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#youtubeModal{{$new->id}}" data-toggle="modal" class="image-link media-ratio ratio-16-9" title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                            <span
                                                    data-bgsrc="{{ $new->img }}"
                                                    class="img bg-cover wp-post-image attachment-bunyad-medium size-bunyad-medium lazyload"
                                                    data-bgset="{{ $new->img }}"
                                                    data-sizes="(max-width: 358px) 100vw, 358px"></span>
                                            </a>
                                            <div id="youtubeModal{{$new->id}}" class="modal fade modal-video" data-youtube-url="{{ $new->youtube_url }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="modal-body">
                                                            <iframe width="100%" height="300" src="{{ $new->youtube_url }}" title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="post-meta post-meta-a has-below"><h2
                                                        class="is-title post-title"><a
                                                            href="#" data-bs-toggle="modal" data-bs-target="#youtubeModal{{$new->id}}" data-toggle="modal">@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif</a>
                                                </h2>
                                                <div class="post-meta-items meta-below"><time class="post-date" datetime="{{ $new->created_at }}">{{ $new->created_at }}</time>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endif
                            @empty
                                <p>Sản phẩm đang được cập nhật</p>
                            @endforelse

                        </div>
                        {{ $news->appends($_GET)->links('paginations.admin') }}
                    </div>
                </section>
            </div>

            @include('templates.news.rightBarNews')
        </div>
    </div>

@stop