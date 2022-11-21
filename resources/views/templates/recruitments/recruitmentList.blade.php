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
    <div class="main ts-contain cf right-sidebar">
        <div class="elementor-element elementor-element-3d4c96b elementor-widget elementor-widget-smartmag-grid">
            <div class="elementor-widget-container">
                <h1 class="archive-heading"><span>{{ __("messages.RECRUITMENT") }}</span></h1>
                <section class="block-wrap block-grid block-sc s-dark" data-id="12">
                    <div class="block-content">
                        <div class="loop loop-grid loop-grid-base grid grid-6 md:grid-6 xs:grid-1">
                            @forelse($recruitments as $recruitment)
                                <article class="l-post grid-base-post grid-post product-items">
                                    <div class="media product-media" >
                                        <a href="{{ route('tin.tuc', $recruitment->id) }}" title="@if(Session::get('locale') == 'vi') {{ $recruitment->title_vn }} @else {{ $recruitment->title_en }} @endif">
                                            <img class="media-img"  src="{{ $recruitment->img }}">
                                        </a>
                                    </div>
                                    <div class="elementor-widget-container">
                                        <div class="post-meta post-meta-a has-below">
                                            <h2 class="h2_title">
                                                <a href="{{ route('tin.tuc', $recruitment->id) }}">@if(Session::get('locale') == 'vi') {{ $recruitment->title_vn }} @else {{ $recruitment->title_en }} @endif</a>
                                            </h2>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <p>{{ __("messages.UPDATING") }}</p>
                            @endforelse
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>

@stop