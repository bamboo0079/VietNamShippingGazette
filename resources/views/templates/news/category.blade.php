@extends('templates.master')
@section('content')

    <style type="text/css">
        .h2_title a {
            padding-top: 0px !important;
            line-height: 1.4em;
            word-break: break-word;
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            min-height: 2.8em;
            max-height: 2.8em;
            font-size: 0.78em;
            color: #333333 !important;
        }
        .product-media{
            height: auto;
        }
        .special-price {
            line-height: 10px;
            font-size: 14px !important;
            color: #C92127;
            font-weight: 600;
        }
        .price-title {
            color: #454d55;

        }
        .product-items {
            border: 2px solid #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            min-height: 200px;
        }
        .product-items:hover {
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            -o-transition: all 1s ease;
            -ms-transition: all 1s ease;
            transition: all 1s ease;
            border: 2px solid #F1FD6D;
            border-radius: 5px;

        }
        .grid-6 {
            --col: 16.5%;
            grid-template-columns: repeat(6, minmax(0, 1fr));
        }
    </style>

    <div class="main ts-contain cf right-sidebar spc-alp-main">
        <div class="ts-row">
            @php
            $class = '';
            $col = 'grid-4 md:grid-4 ';
            if(isset($hot_news) || isset($paid_news) || count($hot_news) || count($paid_news)){
                $class = '';
                $col = 'grid-3 md:grid-3';
            }
            if(isset($giao_thuong) && $giao_thuong == "true") {
                $col = 'grid-6 md:grid-6 ';
            }
            @endphp
            @php
                $data_id = 8;
                $main_content = 'main-content';
                $product_item = '';
                if(isset($giao_thuong) && $giao_thuong == "true") {
                     $data_id = 12;
                     $main_content = "";
                     $product_item = 'product-items';
                }
            @endphp
            <div class="col-{{ $data_id }} {{ $main_content }} {{ $class }}">
                @if($id == 345)
                    <h1 class="archive-heading"><span>{{ __("messages.TRADE") }}</span></h1>
                @elseif($id == 0)
                    <h1 class="archive-heading"><span>{{ __("messages.NEWS") }}</span></h1>
                @else
                    <h1 class="archive-heading"><span>@if(Session::get('locale') == 'vi') {{ $category->name_vn }} @else {{ $category->name_en }} @endif</span></h1>
                @endif

                <section class="block-wrap block-grid mb-none" data-id="{{ $data_id }}" style="margin-bottom: 20px">
                    <div class="block-content">
                        @if(count($news))
                        <div class="loop loop-grid loop-grid-base grid {{ $col }} xs:grid-1">
                            @forelse($news as $new)
                                <article class="l-post  grid-base-post grid-post {{ $product_item }}">
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
                                            <div class="post-meta-items meta-below"><time class="post-date" datetime="{{ date('d/m/Y',strtotime($new->created_at)) }}">{{ date('d/m/Y',strtotime($new->created_at)) }}</time>
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
            @if(!isset($giao_thuong))
                @include('templates.news.rightBarNews')
            @endif
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