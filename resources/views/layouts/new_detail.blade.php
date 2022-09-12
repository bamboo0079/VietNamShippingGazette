

@include('frontend.elements.header_menu')
  <nav class="breadcrumbs is-full-width breadcrumbs-a" id="breadcrumb">
    <div class="inner ts-contain ">
      <span><a href="/"><span>{{ __("messages.HOME") }}</span></a></span><span class="delim">&raquo;</span>
      @if($news->category_id)
        <span><a href="{{ route('the.loai', $news->category_id) }}"><span>@if(Session::get('locale') == 'vi') {{ $news->category->name_vn }} @else {{ $news->category->name_en }} @endif</span></a></span>
      @else
        <span><a href="{{ route('loai.san.pham', $news->product_category_id) }}"><span>@if(Session::get('locale') == 'vi') {{ $news->productcategory->name_vn }} @else {{ $news->productcategory->name_en }} @endif</span></a></span>
      @endif

      <span class="delim">&raquo;</span>
      <span class="current">@if(Session::get('locale') == 'vi') {{ $news->title_vn }} @else {{ $news->title_en }} @endif</span></div></nav>

  <div class="main ts-contain cf right-sidebar">



    <div class="ts-row">
      <div class="col-8 main-content">

        <div class="the-post-header s-head-modern s-head-modern-a">
          <div class="post-meta post-meta-a post-meta-left post-meta-single has-below"><div class="post-meta-items meta-above">
              <span class="meta-item cat-labels">
@if($news->category_id)
                  <a class="category" rel="category" href="{{ route('the.loai', $news->category_id) }}"><span>@if(Session::get('locale') == 'vi') {{ $news->category->name_vn }} @else {{ $news->category->name_en }} @endif</span></a>
                @else
                  <a class="category" rel="category" href="{{ route('loai.san.pham', $news->product_category_id) }}"><span>@if(Session::get('locale') == 'vi') {{ $news->productcategory->name_vn }} @else {{ $news->productcategory->name_en }} @endif</span></a>
                @endif

					</span>

            </div><h1 class="is-title post-title">@if(Session::get('locale') == 'vi') {{ $news->title_vn }} @else {{ $news->title_en }} @endif</h1>
            </div>

        </div>

        <div class="the-post s-post-modern">

          <article id="post-298" class="post-298 post type-post status-publish format-standard has-post-thumbnail category-example-1">

            <div class="post-content-wrap has-share-float">
              <div class="post-content cf entry-content content-spacious">
                @if(Session::get('locale') == 'vi') {!! $news->content_vn !!} @else {!! $news->content_en !!} @endif
              </div>
            </div>

          </article>





          <section class="related-posts @if(count($relate_news) == 0) d-none @endif">


            <div class="block-head block-head-ac block-head-e block-head-e2 is-left">
              @if($news->category_id == 1)
                <h4 class="heading">{{ __("messages.RELATE_EVENT") }}</h4>
              @else
                <h4 class="heading">{{ __("messages.RELATE_NEWS") }}</h4>
              @endif
            </div>


            <section class="block-wrap block-grid cols-gap-sm mb-none" data-id="7">


              <div class="block-content">

                <div class="loop loop-grid loop-grid-sm grid grid-3 md:grid-2 xs:grid-1">
                  @foreach($relate_news as $new)
                    <article class="l-post  grid-sm-post grid-post">
                    <div class="media">
                      <a href="{{ route('tin.tuc', $new->id) }}" class="image-link media-ratio ratio-16-9" title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                        <span data-bgsrc="{{ $new->img }}" class="img bg-cover wp-post-image attachment-bunyad-medium size-bunyad-medium lazyload" data-bgset="{{ $new->img }}" data-sizes="(max-width: 358px) 100vw, 358px"></span>
                      </a>
                    </div>
                    <div class="content">
                      <div class="post-meta post-meta-a has-below"><h2 class="is-title post-title"><a href="{{ route('tin.tuc', $new->id) }}">@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif</a></h2><div class="post-meta-items meta-below"><span class="meta-item date"><span class="date-link"><time class="post-date" datetime="{{ $new->created_at }}">{{ $new->created_at }}</time></span></span></div></div>
                    </div>


                  </article>
                  @endforeach
                </div>


              </div>

            </section>

          </section>

        </div>
      </div>

      <aside class="col-4 main-sidebar has-sep" data-sticky="1">
        <div class="inner theiaStickySidebar">
          <div id="smartmag-block-posts-small-6" class="widget ts-block-widget smartmag-widget-posts-small">
            <div class="block">
              <section class="block-wrap block-posts-small block-sc mb-none" data-id="12">
                <div class="widget-title block-head block-head-ac block-head block-head-ac block-head-e block-head-e2 is-left has-style">
                  <h5 class="heading">{{ __("messages.HotNews") }}</h5></div>
                <div class="block-content">
                  <div class="loop loop-small loop-small-a loop-sep loop-small-sep grid grid-1 md:grid-1 sm:grid-1 xs:grid-1">
                    @foreach($hot_news as $k => $new)
                      <article class="l-post  small-a-post m-pos-left small-post">
                        <div class="media">
                          <a href="{{ route('tin.tuc', $new->id) }}"
                             class="image-link media-ratio ar-bunyad-thumb"
                             title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                                        <span data-bgsrc="{{ $new->img }}"
                                                              class="img bg-cover wp-post-image attachment-medium size-medium lazyload"
                                                              data-bgset="{{ $new->img }}"
                                                              data-sizes="(max-width: 105px) 100vw, 105px"></span>
                          </a>
                        </div>


                        <div class="content">
                          <div class="post-meta post-meta-a post-meta-left has-below">
                            <h4 class="is-title post-title">
                              <a href="{{ route('tin.tuc', $new->id) }}">@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif</a></h4>
                            <div class="post-meta-items meta-below">
                                                            <span class="meta-item date">
                                                                <span class="date-link">
                                                                    <time class="post-date" datetime="{{ $new->created_at }}">{{ $new->created_at }}</time>
                                                                </span>
                                                            </span>
                            </div>
                          </div>
                        </div>
                      </article>
                    @endforeach
                  </div>
                </div>
              </section>
              <br />
              <br />
              <section class="block-wrap block-posts-small block-sc mb-none" data-id="13">
                <div class="widget-title block-head block-head-ac block-head block-head-ac block-head-e block-head-e2 is-left has-style">
                  <h5 class="heading">{{ __("messages.PaidNews") }}</h5></div>
                <div class="block-content">
                  <div class="loop loop-small loop-small-a loop-sep loop-small-sep grid grid-1 md:grid-1 sm:grid-1 xs:grid-1">
                    @foreach($paid_news as $k => $new)
                      <article class="l-post  small-a-post m-pos-left small-post">
                        <div class="media">
                          <a href="{{ route('tin.tuc', $new->id) }}"
                             class="image-link media-ratio ar-bunyad-thumb"
                             title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                                        <span data-bgsrc="{{ $new->img }}"
                                                              class="img bg-cover wp-post-image attachment-medium size-medium lazyload"
                                                              data-bgset="{{ $new->img }}"
                                                              data-sizes="(max-width: 105px) 100vw, 105px"></span>
                          </a>
                        </div>


                        <div class="content">
                          <div class="post-meta post-meta-a post-meta-left has-below">
                            <h4 class="is-title post-title">
                              <a href="{{ route('tin.tuc', $new->id) }}">@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif</a></h4>
                            <div class="post-meta-items meta-below">
                                                            <span class="meta-item date">
                                                                <span class="date-link">
                                                                    <time class="post-date" datetime="{{ $new->created_at }}">{{ $new->created_at }}</time>
                                                                </span>
                                                            </span>
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
      </aside>

    </div>
  </div>

  @include('frontend.elements.footer')
</div><!-- .main-wrap -->



