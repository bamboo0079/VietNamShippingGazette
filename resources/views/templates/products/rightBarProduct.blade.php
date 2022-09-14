<style type="text/css">
    .price-p {
        line-height: 10px;
        color: red;
    }
    .price-p span {
        font-weight: bold;
        color: #454d55;
    }
</style>
<aside class="col-4 main-sidebar has-sep" data-sticky="1" style="margin-top:25px; margin-bottom: 40px">
    @if(count($relate_news))
    <div class="inner theiaStickySidebar">
        <div id="smartmag-block-posts-small-6" class="widget ts-block-widget smartmag-widget-posts-small">
            <div class="block">
                <section class="block-wrap block-posts-small block-sc mb-none" data-id="12">
                    <div class="widget-title block-head block-head-ac block-head block-head-ac block-head-e block-head-e2 is-left has-style">
                        <h5 class="heading">{{ __("messages.PRODUCT_RELATION_SHIP") }}</h5></div>
                    <div class="block-content">
                        <div class="loop loop-small loop-small-a loop-sep loop-small-sep grid grid-1 md:grid-1 sm:grid-1 xs:grid-1">
                            @foreach($relate_news as $k => $new)
                                <article class="l-post  small-a-post m-pos-left small-post">
                                    <div class="media">
                                        <a href="{{ route('product.detail', $new->id) }}"
                                           class="image-link media-ratio ar-bunyad-thumb"
                                           title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                                <span data-bgsrc="{{ $new->img }}"
                                                      class="img bg-cover wp-post-image attachment-medium size-medium lazyloaded"
                                                      data-bgset="{{ $new->img }}"
                                                      data-sizes="(max-width: 105px) 100vw, 105px"
                                                      style="background-image: url(&quot;{{ $new->img }}&quot;);">
                                                </span>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <div class="post-meta post-meta-a post-meta-left has-below">
                                            <h4 class="is-title post-title">
                                                <a href="{{ route('product.detail', $new->id) }}">
                                                    @if(Session::get('locale') == 'vi')
                                                        {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                    @else
                                                        {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                    @endif
                                                </a>
                                            </h4>
                                            <div class="post-meta-items meta-below">
                                                <p class="price-p"><span>Giá</span>: Liên hệ</p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>

            </div>

        </div>
    </div>
    @endif
</aside>