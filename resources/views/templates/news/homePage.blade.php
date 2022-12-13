@extends('templates.master')
@section('content')
    <style type="text/css">
        .elementor-6 .elementor-element.elementor-element-75af90f:not(.elementor-motion-effects-element-type-background), .elementor-6 .elementor-element.elementor-element-75af90f > .elementor-motion-effects-container > .elementor-motion-effects-layer {
            background-color: #131312;
        }
        .elementor-section.elementor-section-boxed {
            display: flex;
            justify-content: center;
        }
    </style>
    <section style="margin-bottom: 15px" class="has-el-gap el-gap-default elementor-section elementor-top-section elementor-element elementor-element-ac3b37e elementor-section-boxed elementor-section-height-default elementor-section-height-default"
             data-id="ac3b37e" data-element_type="section">
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-column elementor-col-66 elementor-top-column elementor-element elementor-element-fd8591e main-content"
                 data-id="fd8591e" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">

                    @if(count($news))
                        <div class="elementor-element elementor-element-abc4e86 elementor-widget elementor-widget-smartmag-highlights"
                             data-id="abc4e86" data-element_type="widget"
                             data-widget_type="smartmag-highlights.default">
                            <div class="elementor-widget-container">
                                <section class="block-wrap block-highlights block-sc mb-sm" data-id="8" data-block="{&quot;id&quot;:&quot;highlights&quot;,&quot;props&quot;:{&quot;cat_labels&quot;:&quot;&quot;,&quot;cat_labels_pos&quot;:&quot;bot-left&quot;,&quot;reviews&quot;:&quot;radial&quot;,&quot;post_formats_pos&quot;:&quot;center&quot;,&quot;load_more_style&quot;:&quot;a&quot;,&quot;meta_above&quot;:[],&quot;meta_below&quot;:[&quot;author&quot;,&quot;date&quot;],&quot;posts&quot;:6,&quot;space_below&quot;:&quot;sm&quot;,&quot;title_lines&quot;:&quot;2&quot;,&quot;media_ratio&quot;:&quot;3-2&quot;,&quot;container_width&quot;:66,&quot;offset&quot;:2,&quot;heading&quot;:&quot;*Pro* Lifestyle&quot;,&quot;filters&quot;:&quot;category&quot;,&quot;filters_terms&quot;:[&quot;10&quot;,&quot;568&quot;],&quot;cat&quot;:&quot;1&quot;,&quot;heading_colors&quot;:&quot;none&quot;,&quot;pagination_links&quot;:null,&quot;excerpt_length&quot;:15,&quot;query_type&quot;:&quot;custom&quot;,&quot;sort_days&quot;:null,&quot;is_sc_call&quot;:true,&quot;meta_items_default&quot;:true}}">
                                    <div class="block-head block-head-ac block-head-e block-head-e2 is-left">
                                        <h4 class="heading"><span class="color">{{ __("messages.LastNews") }}</span></h4>
                                    </div>
                                    <div class="block-content">
                                        <div>
                                            <div class="loop loop-grid loop-grid-base grid grid-2 md:grid-2 xs:grid-1">
                                                @foreach($news as $k => $new)
                                                    @if($k < 2)
                                                        <article class="l-post  grid-base-post grid-post">
                                                            <div class="media">
                                                                <a href="{{ route('tin.tuc', $new->id) }}" class="image-link media-ratio ratio-3-2"
                                                                   title="@if(Session::get('locale') == 'vi')
                                                                   {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                   @else {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!} @endif">
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
                                                                        <a href="{{ route('tin.tuc', $new->id) }}">@if(Session::get('locale') == 'vi')
                                                                                {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                            @else {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!} @endif</a>
                                                                    </h2>
                                                                    <div class="post-meta-items meta-below">
                                                                        <span class="meta-item post-author">
                                                                            <a href="javascript:void(0)" rel="author">{{ __("messages.POST_DATE") }}</a>
                                                                        </span>
                                                                        <span class="meta-item date">
                                                                        <span class="date-link">
                                                                        <time class="post-date" datetime=""> {{ date('d/m/Y',strtotime($new->created_at)) }}</time>
                                                                        </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="excerpt">
                                                                        <p style="font-size: 14px">
                                                                            @if(Session::get('locale') == 'vi')
                                                                                {!! \App\Helpers\Helper::limitCharacters($new->content_vn, \App\ConstApp::NUMBER_CHARACTERS_NEW_CONTENT) !!}
                                                                            @else {!! \App\Helpers\Helper::limitCharacters($new->content_en, \App\ConstApp::NUMBER_CHARACTERS_NEW_CONTENT) !!} @endif
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="loop loop-small loop-small-a grid grid-2 md:grid-1 sm:grid-1 xs:grid-1">
                                                @foreach($news as $k => $new)
                                                    @if($k < 6 && $k>1)
                                                        <article class="l-post  small-a-post m-pos-left small-post">
                                                            <div class="media">
                                                                <a href="{{ route('tin.tuc', $new->id) }}"
                                                                   class="image-link media-ratio ar-bunyad-thumb"
                                                                   title="@if(Session::get('locale') == 'vi')
                                                                   {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                   @else {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!} @endif">
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
                                                                    <h4 class="is-title post-title limit-lines l-lines-2">
                                                                        <a href="{{ route('tin.tuc', $new->id) }}">@if(Session::get('locale') == 'vi')
                                                                                {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                            @else {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!} @endif</a>
                                                                    </h4>
                                                                    <div class="post-meta-items meta-below item-margin-booton">
                                                                        <span class="meta-item post-author">
                                                                            <a href="javascript:void(0)" rel="author">{{ __("messages.POST_DATE") }}</a>
                                                                        </span>
                                                                        <span class="meta-item date">
                                                                        <span class="date-link">
                                                                        <time class="post-date" datetime=""> {{ date('d/m/Y',strtotime($new->created_at)) }}</time>
                                                                        </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="post-meta-items meta-below">
                                                                        <p style="font-size: 14px">
                                                                            @if(Session::get('locale') == 'vi')
                                                                                {!! \App\Helpers\Helper::limitCharacters($new->content_vn, \App\ConstApp::NUMBER_CHARACTERS_NEW_CONTENT) !!}
                                                                            @else {!! \App\Helpers\Helper::limitCharacters($new->content_en, \App\ConstApp::NUMBER_CHARACTERS_NEW_CONTENT) !!} @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    @endif
                    @if(count($event_news))
                        <div class="elementor-element elementor-element-625e01a elementor-widget elementor-widget-smartmag-postslist"
                             data-id="625e01a" data-element_type="widget"
                             data-widget_type="smartmag-postslist.default">
                            <div class="elementor-widget-container">
                                <section class="block-wrap block-posts-list block-sc mb-none" data-id="11">
                                    <div class="block-head block-head-ac block-head-e block-head-e2 is-left">
                                        <h4 class="heading">
                                            <span class="color">{{ __("messages.EVENTS") }}</span>
                                        </h4>
                                    </div>
                                    <div class="block-content">
                                        <div class="loop loop-list grid grid-1 md:grid-1 sm:grid-1">
                                            @foreach($event_news as $k => $new)
                                                <article class="l-post  m-pos-left list-post">
                                                    <div class="media">
                                                        <a href="{{ route('tin.tuc', $new->id) }}"
                                                           class="image-link media-ratio ratio-3-2"
                                                           title="@if(Session::get('locale') == 'vi')
                                                           {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                           @else {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!} @endif">
                                                        <span data-bgsrc="{{ $new->img }}"
                                                              class="img bg-cover wp-post-image attachment-medium size-medium lazyloaded"
                                                              data-sizes="(max-width: 360px) 100vw, 360px"
                                                              style="background-image: url(&quot;{{ $new->img }}&quot;);">

                                                        </span>
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <div class="post-meta post-meta-a">
                                                            <h2 class="is-title post-title limit-lines l-lines-3">
                                                                <a href="{{ route('tin.tuc', $new->id) }}">@if(Session::get('locale') == 'vi')
                                                                        {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                    @else {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!} @endif
                                                                </a>
                                                            </h2>
                                                            <div class="post-meta-items meta-below item-margin-booton">
                                                                <span class="meta-item post-author">
                                                                    <a href="javascript:void(0)" rel="author">{{ __("messages.POST_DATE") }}</a>
                                                                </span>
                                                                <span class="meta-item date">
                                                                    <span class="date-link">
                                                                        <time class="post-date" datetime="{{ date('d/m/Y',strtotime($new->created_at)) }}">{{ date('d/m/Y',strtotime($new->created_at)) }}</time>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="excerpt">
                                                            <p>@if(Session::get('locale') == 'vi')
                                                                    {!! \App\Helpers\Helper::limitCharacters($new->content_vn, \App\ConstApp::NUMBER_CHARACTERS_NEW_CONTENT) !!}
                                                                @else {!! \App\Helpers\Helper::limitCharacters($new->content_en, \App\ConstApp::NUMBER_CHARACTERS_NEW_CONTENT) !!} @endif</p>
                                                        </div>
                                                    </div>
                                                </article>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-fb04f95 main-sidebar main-sidebar ts-sticky-col"
                 data-id="fb04f95" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-28c3d04 elementor-widget elementor-widget-smartmag-grid"
                         data-id="28c3d04" data-element_type="widget"
                         data-widget_type="smartmag-grid.default">
                        <div class="elementor-widget-container">
                            @if(count($anpham))
                                <section class="block-wrap block-grid block-sc mb-none" data-id="12">
                                    <div class="block-head block-head-ac block-head-e block-head-e2 is-left">
                                        <h4 class="heading"><span class="color">{{ __("messages.LatestPublications") }}</span></h4>
                                    </div>
                                    <div class="block-content">
                                        @foreach($anpham as $item)
                                            <a target="_blank" href="{{ $item->link }}" title="{{ $item->name }}">
                                                <img style="width: 350px" src="{{ $item->img }}">
                                            </a>
                                        @endforeach
                                    </div>
                                </section>
                            @endif
                            <style type="text/css">
                                .ifo-tag-p {
                                    font-size: 13px;
                                    line-height: 2px;
                                    color: #454d55;
                                }
                                .ifo-tag-p-top {
                                    margin-top: 3px !important;
                                }
                                .ifo-tag-p b {
                                    font-weight: bold;
                                    color: #454d55;
                                }

                            </style>
                            <div class="elementor-element elementor-element-8ea91f8 elementor-widget elementor-widget-wp-widget-bunyad-social"
                                 data-id="8ea91f8" data-element_type="widget"
                                 data-widget_type="wp-widget-bunyad-social.default">
                                <div class="elementor-widget-container">
                                    <div class="widget widget-social-b">
                                        @if(count($supports))
                                            <div style="margin-bottom: 15px !important;"  class="widget-title block-head block-head-ac block-head block-head-ac block-head-e block-head-e2 is-left has-style">
                                                <h5 class="heading"><span class="color">{{ __("messages.Onlinesupport") }}</span></h5>
                                            </div>
                                            <div class="loop loop-small loop-small-a loop-sep loop-small-sep grid grid-1 md:grid-1 sm:grid-1 xs:grid-1">
                                                @foreach($supports as $support)
                                                    <article class="l-post small-a-post m-pos-left small-post">
                                                        <div class="media" style="width: 87px">
                                                            <img src="/public/frontend/images/support_member_{{ $support->sex == 0 ? 'women' : 'men' }}.png" style="max-width: 100px">
                                                        </div>
                                                        <div class="content">
                                                            <div class="post-meta post-meta-a post-meta-left has-below">
                                                                <h6 class="is-title post-title" style="margin-top: 9px !important;">{{ $support->name }}</h6>
                                                                <div class="post-meta-items meta-below">
                                                                    <p class="ifo-tag-p ifo-tag-p-top" ><b>Zalo: </b> {{ $support->zalo }}</p>
                                                                    <p class="ifo-tag-p"><b>Skype: </b> {{ $support->skype }}</p>
                                                                    <p class="ifo-tag-p"><b>Phone: </b> {{ $support->phone }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                @endforeach
                                            </div>
                                        @endif
                                        @if(count($hot_news))
                                            <div style="margin-top: 20px"
                                                 class="elementor-element elementor-element-2970e47 elementor-widget elementor-widget-smartmag-postssmall"
                                                 data-id="2970e47" data-element_type="widget"
                                                 data-widget_type="smartmag-postssmall.default">
                                                <div class="elementor-widget-container">
                                                    <div class="widget-title block-head block-head-ac block-head block-head-ac block-head-e block-head-e2 is-left has-style">
                                                        <h5 class="heading">
                                                            <span class="color">{{ __("messages.HotNews") }}</span>
                                                        </h5>
                                                    </div>
                                                    <section class="block-wrap block-posts-small block-sc"
                                                             data-id="21">
                                                        <div class="block-content">
                                                            <div class="loop loop-small loop-small- grid grid-1 md:grid-1 sm:grid-1 xs:grid-1">
                                                                @foreach($hot_news as $k => $new)
                                                                    <article
                                                                            class="l-post  m-pos-left small-post">
                                                                        <div class="media">
                                                                            <a href="{{ route('tin.tuc', $new->id) }}"
                                                                               class="image-link media-ratio ratio-4-3"
                                                                               title="
                                                                    @if(Session::get('locale') == 'vi')
                                                                               {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                               @else
                                                                               {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                               @endif">
                                                                    <span data-bgsrc="{{ $new->img }}"
                                                                          class="img bg-cover wp-post-image attachment-medium size-medium lazyloaded"
                                                                          data-bgset="{{ $new->img }}"
                                                                          data-sizes="(max-width: 116px) 100vw, 116px"
                                                                          style="background-image: url(&quot;{{ $new->img }}&quot;);">
                                                                          </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="content">
                                                                            <div class="post-meta post-meta-a post-meta-left has-below">
                                                                                <h4 class="is-title post-title limit-lines l-lines-2">
                                                                                    <a href="{{ route('tin.tuc', $new->id) }}">
                                                                                        @if(Session::get('locale') == 'vi')
                                                                                            {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                                        @else
                                                                                            {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                                        @endif
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="post-meta-items meta-below">
                                                                                    <span class="meta-item post-author">
                                                                                        <a href="javascript:void(0)" rel="author">{{ __("messages.POST_DATE") }}</a>
                                                                                    </span>
                                                                                    <span class="meta-item date">
                                                                                        <span class="date-link">
                                                                                            <time class="post-date" datetime="{{ date('d/m/Y',strtotime($new->created_at)) }}">{{ date('d/m/Y',strtotime($new->created_at)) }}</time>
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
                                        @endif
                                        @if(count($paid_news))
                                            <div style="margin-top: 20px"
                                                 class="elementor-element elementor-element-2970e47 elementor-widget elementor-widget-smartmag-postssmall"
                                                 data-id="2970e47" data-element_type="widget"
                                                 data-widget_type="smartmag-postssmall.default">
                                                <div class="elementor-widget-container">
                                                    <div class="widget-title block-head block-head-ac block-head block-head-ac block-head-e block-head-e2 is-left has-style">
                                                        <h5 class="heading">
                                                            <span class="color">{{ __("messages.PaidNews") }}</span>
                                                        </h5>
                                                    </div>
                                                    <section class="block-wrap block-posts-small block-sc"
                                                             data-id="21">
                                                        <div class="block-content">
                                                            <div class="loop loop-small loop-small- grid grid-1 md:grid-1 sm:grid-1 xs:grid-1">
                                                                @foreach($paid_news as $k => $new)
                                                                    <article
                                                                            class="l-post  m-pos-left small-post">
                                                                        <div class="content">
                                                                            <div class="post-meta post-meta-a post-meta-left has-below">
                                                                                <h4 class="is-title post-title limit-lines l-lines-2">
                                                                                    <a href="{{ route('tin.tuc', $new->id) }}">
                                                                                        @if(Session::get('locale') == 'vi')
                                                                                            {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                                        @else
                                                                                            {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                                        @endif
                                                                                    </a>
                                                                                </h4>
                                                                                <div class="post-meta-items meta-below">
                                                                                    <span class="meta-item post-author">
                                                                                        <a href="javascript:void(0)" rel="author">{{ __("messages.POST_DATE") }}</a>
                                                                                    </span>
                                                                                    <span class="meta-item date">
                                                                                        <span class="date-link">
                                                                                            <time class="post-date" datetime="{{ date('d/m/Y',strtotime($new->created_at)) }}">{{ date('d/m/Y',strtotime($new->created_at)) }}</time>
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="media">
                                                                            <a href="{{ route('tin.tuc', $new->id) }}"
                                                                               class="image-link media-ratio ratio-4-3"
                                                                               title="
                                                                                @if(Session::get('locale') == 'vi')
                                                                               {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                               @else
                                                                               {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                               @endif ">
                                                                                <span data-bgsrc="{{ $new->img }}"
                                                                                      class="img bg-cover wp-post-image attachment-medium size-medium lazyloaded"
                                                                                      data-bgset="{{ $new->img }}"
                                                                                      data-sizes="(max-width: 116px) 100vw, 116px"
                                                                                      style="background-image: url(&quot;{{ $new->img }}&quot;);">
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </article>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        @endif
                                        @if(count($partners))
                                            <div style="margin-top: 20px"
                                                 class="elementor-element elementor-element-2970e47 elementor-widget elementor-widget-smartmag-postssmall"
                                                 data-id="2970e47" data-element_type="widget"
                                                 data-widget_type="smartmag-postssmall.default">
                                                <div class="elementor-widget-container">
                                                    <div class="widget-title block-head block-head-ac block-head block-head-ac block-head-e block-head-e2 is-left has-style">
                                                        <h5 class="heading">
                                                            <span class="color">{{ __("messages.PARTNER") }}</span>
                                                        </h5>
                                                    </div>
                                                    @if(count($partners))
                                                        <section class="block-wrap block-posts-small block-sc"
                                                                 data-id="21">
                                                            <div class="block-content">
                                                                <div class="loop loop-small loop-small- grid grid-1 md:grid-1 sm:grid-1 xs:grid-1">
                                                                    <script src="/public/js/jquery-3.6.0.min.js" type="text/javascript"></script>
                                                                    <script src="/src/asset/js/frontend/jquery.film_roll.js"></script>
                                                                    <div id="film_roll">
                                                                        @foreach($partners as $partner)
                                                                            <div>
                                                                                <a target="_blank" href="{!! $partner->link  !!}"><img src="{!! $partner->img  !!}"></a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <script>
                                                                        $(function () {
                                                                            fr = new FilmRoll({
                                                                                configure_load: true,
                                                                                container: '#film_roll',
                                                                            });
                                                                            $(".film_roll_pager").remove();
                                                                        });
                                                                    </script>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if(count($vsg_news))
        <section
                class="has-el-gap el-gap-default elementor-section elementor-top-section elementor-element elementor-element-75af90f elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                data-id="75af90f" data-element_type="section"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}"
                style="
            background-color: #131312;
            transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
            margin-top: 0px;
            margin-bottom: 60px;
            padding: 60px 0px 20px 0px;
        ">
            <div class="elementor-container elementor-column-gap-no">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-8af8a1b"
                     data-id="8af8a1b" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-8c27b1f elementor-widget elementor-widget-smartmag-grid"
                             data-id="8c27b1f" data-element_type="widget"
                             data-widget_type="smartmag-grid.default">
                            <div class="elementor-widget-container">
                                <section class="block-wrap block-grid block-sc s-dark mb-sm" data-id="13">
                                    <div class="block-head block-head-ac block-head-e block-head-e2 is-left">
                                        <h4 class="heading">{{ __("messages.VSG_NEWS") }}</h4>
                                    </div>
                                    <div class="block-content">
                                        <div class="loop loop-grid loop-grid-base grid grid-3 md:grid-2 xs:grid-1">
                                            @foreach($vsg_news as $k => $new)
                                                <article class="l-post  grid-base-post grid-post">
                                                    <div class="media">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#youtubeModal{{$new->id}}" data-toggle="modal"
                                                           class="image-link media-ratio ratio-4-3"
                                                           title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                                    <span data-bgsrc="{{ $new->img }}"
                                                          class="img bg-cover wp-post-image attachment-medium size-medium lazyloaded"
                                                          data-bgset="{{ $new->img }}"
                                                          data-sizes="(max-width: 116px) 100vw, 116px"
                                                          style="background-image: url(&quot;{{ $new->img }}&quot;);">
                                                    </span>
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
                                                                    class="is-title post-title"><a href="#" data-bs-toggle="modal" data-bs-target="#youtubeModal{{$new->id}}" data-toggle="modal">@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif</a>
                                                            </h2>
                                                            <div class="post-meta-items meta-below item-margin-booton" >
                                                        <span class="meta-item post-author">
                                                            <a href="javascript:void(0)" rel="author">{{ __("messages.POST_DATE") }}</a>
                                                        </span>
                                                                <span class="meta-item date">
                                                            <span class="date-link">
                                                                <time class="post-date" datetime="{{ date('d/m/Y',strtotime($new->created_at)) }}">{{ date('d/m/Y',strtotime($new->created_at)) }}</time>
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
                </div>
            </div>
        </section>
        <!-- VSG NEWS -->
    @endif
    <!-- Bao Gia -->
    @if(count($req_news) && count($forbuy_news) && count($forsell_news))
        <section
                class="has-el-gap el-gap-default elementor-section elementor-top-section elementor-element elementor-element-8c5b8a1 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                data-id="8c5b8a1" data-element_type="section">
            <div class="elementor-container elementor-column-gap-no">
                <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-ded5d6e"
                     data-id="ded5d6e" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-81e61b8 elementor-widget elementor-widget-smartmag-highlights"
                             data-id="81e61b8" data-element_type="widget"
                             data-widget_type="smartmag-highlights.default">
                            <div class="elementor-widget-container">
                                <section class="block-wrap block-highlights block-sc mb-none" data-id="13">
                                    <div class="block-head block-head-e block-head-e2 is-left term-color-56">
                                        <h4 class="heading">
                                            <span class="color-header">{{ __("messages.RequestAQuote") }}</span>
                                        </h4>
                                    </div>
                                    <div class="block-content">
                                        <div>
                                            <div class="loop loop-small loop-small-a loop-sep loop-small-sep grid grid-1 md:grid-1 sm:grid-1 xs:grid-1">
                                                @foreach($req_news as $k => $new)
                                                    <article class="l-post  small-a-post m-pos-left small-post">
                                                        <div class="media">
                                                            <a href="{{ route('tin.tuc', $new->id) }}"
                                                               class="image-link media-ratio ar-bunyad-thumb"
                                                               title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                                    <span data-bgsrc="{{ $new->img }}"
                                                          class="img bg-cover wp-post-image attachment-medium size-medium lazyloaded"
                                                          data-bgset="{{ $new->img }}"
                                                          data-sizes="(max-width: 110px) 100vw, 110px"
                                                          style="background-image: url(&quot;{{ $new->img }}&quot;);">
                                                    </span>
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <div class="post-meta post-meta-a post-meta-left has-below">
                                                                <h4 class="is-title post-title">
                                                                    <a href="{{ route('tin.tuc', $new->id) }}">  @if(Session::get('locale') == 'vi')
                                                                            {!! \App\Helpers\Helper::limitCharacters($new->title_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                        @else
                                                                            {!! \App\Helpers\Helper::limitCharacters($new->title_en, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) !!}
                                                                        @endif</a>
                                                                </h4>
                                                                <div class="post-meta-items meta-below">
                                                        <span class="meta-item date">
                                                            <span class="date-link">
                                                                <time class="post-date"
                                                                      datetime="{{ date('d/m/Y',strtotime($new->created_at)) }}">{{ date('d/m/Y',strtotime($new->created_at)) }}</time>
                                                            </span>
                                                        </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-ded5d6e"
                     data-id="ded5d6e" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-81e61b8 elementor-widget elementor-widget-smartmag-highlights"
                             data-id="81e61b8" data-element_type="widget"
                             data-widget_type="smartmag-highlights.default">
                            <div class="elementor-widget-container">
                                <section class="block-wrap block-highlights block-sc mb-none" data-id="13">
                                    <div class="block-head block-head-e block-head-e2 is-left term-color-56">
                                        <h4 class="heading"><span class="color-header">{{ __("messages.ForBuy") }}</span></h4>
                                    </div>
                                    <div class="block-content">
                                        <div>
                                            <div class="loop loop-small loop-small-a loop-sep loop-small-sep grid grid-1 md:grid-1 sm:grid-1 xs:grid-1">
                                                @foreach($forbuy_news as $k => $new)
                                                    <article class="l-post  small-a-post m-pos-left small-post">
                                                        <div class="media">
                                                            <a href="{{ route('tin.tuc', $new->id) }}"
                                                               class="image-link media-ratio ar-bunyad-thumb"
                                                               title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                                        <span data-bgsrc="{{ $new->img }}"
                                                              class="img bg-cover wp-post-image attachment-medium size-medium lazyloaded"
                                                              data-bgset="{{ $new->img }}"
                                                              data-sizes="(max-width: 110px) 100vw, 110px"
                                                              style="background-image: url(&quot;{{ $new->img }}&quot;);">
                                                        </span>
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <div class="post-meta post-meta-a post-meta-left has-below">
                                                                <h4 class="is-title post-title">
                                                                    <a href="{{ route('tin.tuc', $new->id) }}">@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif</a>
                                                                </h4>
                                                                <div class="post-meta-items meta-below">
                                                            <span class="meta-item date">
                                                                <span class="date-link">
                                                                    <time class="post-date"
                                                                          datetime="{{ date('d/m/Y',strtotime($new->created_at)) }}">{{ date('d/m/Y',strtotime($new->created_at)) }}</time>
                                                                </span>
                                                            </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-ded5d6e"
                     data-id="ded5d6e" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-81e61b8 elementor-widget elementor-widget-smartmag-highlights"
                             data-id="81e61b8" data-element_type="widget"
                             data-widget_type="smartmag-highlights.default">
                            <div class="elementor-widget-container">
                                <section class="block-wrap block-highlights block-sc mb-none" data-id="13">
                                    <div class="block-head block-head-e block-head-e2 is-left term-color-56">
                                        <h4 class="heading"><span class="color-header">{{ __("messages.ForSell") }}</span></a>
                                        </h4>
                                    </div>
                                    <div class="block-content">
                                        <div>
                                            <div class="loop loop-small loop-small-a loop-sep loop-small-sep grid grid-1 md:grid-1 sm:grid-1 xs:grid-1">
                                                @foreach($forsell_news as $k => $new)
                                                    <article class="l-post  small-a-post m-pos-left small-post">
                                                        <div class="media">
                                                            <a href="{{ route('tin.tuc', $new->id) }}"
                                                               class="image-link media-ratio ar-bunyad-thumb"
                                                               title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                                            <span data-bgsrc="{{ $new->img }}"
                                                                  class="img bg-cover wp-post-image attachment-medium size-medium lazyloaded"
                                                                  data-bgset="{{ $new->img }}"
                                                                  data-sizes="(max-width: 110px) 100vw, 110px"
                                                                  style="background-image: url(&quot;{{ $new->img }}&quot;);">
                                                            </span>
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <div class="post-meta post-meta-a post-meta-left has-below">
                                                                <h4 class="is-title post-title">
                                                                    <a href="{{ route('tin.tuc', $new->id) }}">@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif</a>
                                                                </h4>
                                                                <div class="post-meta-items meta-below">
                                                            <span class="meta-item date">
                                                                <span class="date-link">
                                                                    <time class="post-date"
                                                                          datetime="{{ date('d/m/Y',strtotime($new->created_at)) }}">{{ date('d/m/Y',strtotime($new->created_at)) }}</time>
                                                                </span>
                                                            </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </section>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    @endif
    <!-- Bao Gia -->
    @foreach($categories_menu as $menu)
        @if(count($other[$menu->id]))
            <!-- Duong bo -->
            <section class="has-el-gap el-gap-default elementor-section elementor-top-section elementor-element elementor-element-b168f55 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                     data-id="b168f55" data-element_type="section">
                <div class="elementor-container elementor-column-gap-no">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-2ce19b0"
                         data-id="2ce19b0" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-ba78f64 elementor-widget elementor-widget-smartmag-grid"
                                 data-id="ba78f64" data-element_type="widget"
                                 data-widget_type="smartmag-grid.default">
                                <div class="elementor-widget-container">
                                    <section class="block-wrap block-grid block-sc mb-none" data-id="8">
                                        <div style="margin-top: 20px; !important;"
                                             class="block-head block-head-ac block-head-e block-head-e2 is-left">
                                            <h4 class="heading"><span class="color-header">@if(Session::get('locale') == 'vi') {{ $menu->name_vn }} @else {{ $menu->name_en }} @endif</span>
                                            </h4>
                                        </div>
                                        <div class="block-content">
                                            <div class="loop loop-grid loop-grid-base has-nums has-nums-c grid grid-4 md:grid-2 xs:grid-1">
                                                @foreach($other[$menu->id] as $k => $new)
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- Duong bo -->
    @endforeach
    <style>
        button.close{
            background: #fff;
            color: #000;
            float: right;
            text-align: right;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
@stop