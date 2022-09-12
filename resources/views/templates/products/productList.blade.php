@extends('templates.master')
@section('content')

    <div class="main ts-contain cf right-sidebar">
        <div class="elementor-element elementor-element-3d4c96b elementor-widget elementor-widget-smartmag-grid">
            <div class="elementor-widget-container">

                <h1 class="archive-heading"><span>@if(Session::get('locale') == 'vi') {{ $category->name_vn }} @else {{ $category->name_en }} @endif</span></h1>
                <section class="block-wrap block-grid block-sc s-dark" data-id="12">
                    <div class="block-content">

                        <style type="text/css">
                            /*.product-items {
                                width: 33%;
                                border: 1px solid #454d55;
                            }*/
                            .h2_title a {
                                /*width: 33.3333% !important;*/
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
                                /*font-weight: lighter !important;*/
                            }
                            .media-img {
                                max-width: 250px;
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
                                color: #333333;
                            }
                            /*.product-items {
                                border: 1px solid #454d55;
                                padding: 10px;
                            }*/
                            .product-items:hover {
                                -webkit-box-sizing: border-box;
                            }
                        </style>

                        <div class="loop loop-grid loop-grid-base grid grid-4 md:grid-4 xs:grid-1">
                            @forelse($news as $new)
                                <article class="l-post  grid-base-post grid-post product-items">
                                    <div class="media product-media">
                                        <a href="{{ route('tin.tuc', $new->id) }}" class="image-link media-ratio ratio-16-9" title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">

                                        <img class="media-img"  src="{{ $new->img }}">
                                        </a>
                                    </div>
                                    <div class="elementor-widget-container">

                                        <div class="post-meta post-meta-a has-below">
                                            <h2 class="h2_title">
                                                <a href="{{ route('tin.tuc', $new->id) }}">@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif</a>
                                            </h2>
                                            <div class="post-meta-items meta-below">
                                                <span class="meta-item date">
                                                    <span class="date-link">
                                                        <time class="post-date" datetime="{{ $new->created_at }}">{{ $new->created_at }}</time>
                                                    </span>
                                                </span>
                                            </div>
                                            <p class="special-price">
                                                <span class="price-title">Giá: </span>
                                                <span class="price">Liên hệ</span>
                                            </p>
                                        </div>

                                    </div>
                                </article>

                            @empty
                                <p>Sản phẩm đang được cập nhật</p>
                            @endforelse

                        </div>
                        {{ $news->appends($_GET)->links('paginations.admin') }}
                    </div>
                </section>
            </div>

        </div>
    </div>

@stop