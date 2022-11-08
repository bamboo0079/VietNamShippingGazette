@extends('templates.master')
@section('content')

    <div class="main ts-contain cf right-sidebar spc-alp-main">
        <div class="ts-row">
            @php
            $class = '';
            $col = 'grid-4 md:grid-4 ';
            if(isset($hot_news) && isset($paid_news) && count($hot_news) && count($paid_news)){
                $class = '';
                $col = 'grid-3 md:grid-3';
            }
            @endphp
            <div class="col-8 main-content {{ $class }}">
                @if($id == 345)
                    <h1 class="archive-heading"><span>{{ __("messages.TRADE") }}</span></h1>
                @elseif($id == 0)
                    <h1 class="archive-heading"><span>{{ __("messages.NEWS") }}</span></h1>
                @else
                    <h1 class="archive-heading"><span>@if(Session::get('locale') == 'vi') {{ $category->name_vn }} @else {{ $category->name_en }} @endif</span></h1>
                @endif

                <section class="block-wrap block-grid mb-none" data-id="8">
                    <div class="block-content">
                        @if(count($news))
                        <div class="loop loop-grid loop-grid-base grid {{ $col }} xs:grid-1">
                            @forelse($news as $new)
                                <article class="l-post  grid-base-post grid-post">
                                    <div class="media" style="background-image: url('{{ $new->img }}');">
                                        <a href="{{ route('tin.tuc', $new->id) }}"  title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                            {{--<img src="{{ $new->img }}">--}}
                                        </a>
                                    </div>
                                    <div class="content">
                                        <div class="post-meta post-meta-a has-below"><h2
                                                    class="is-title post-title"><a
                                                        href="{{ route('tin.tuc', $new->id) }}" data-toggle="modal">@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif</a>
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
    <style>
        .grid-post .media{
            display: block;
            padding-top: 100%;
            position: relative;
            -webkit-transform: scale(1);
            transform: scale(1);
            transition: all 300ms ease-in-out;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .l-post img{
            width: 100%;
            height: 100%;
            display: block;
            object-fit: contain;
            object-position: center center;
            position: absolute;
            top: 0px;
            left: 0px;
            padding: 5px;
        }
    </style>
@stop