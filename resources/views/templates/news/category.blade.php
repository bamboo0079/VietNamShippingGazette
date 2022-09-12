@extends('templates.master')
@section('content')

    <div class="main ts-contain cf right-sidebar">
        <div class="ts-row">
            <div class="col-8 main-content">
                <h1 class="archive-heading"><span>@if(Session::get('locale') == 'vi') {{ $category->name_vn }} @else {{ $category->name_en }} @endif</span></h1>
                <section class="block-wrap block-grid mb-none" data-id="8">
                    <div class="block-content">
                        @if(count($news))
                        <div class="loop loop-grid loop-grid-base grid grid-2 md:grid-2 xs:grid-1">
                            @forelse($news as $new)
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