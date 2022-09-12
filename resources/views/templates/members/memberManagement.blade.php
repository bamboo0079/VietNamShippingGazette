<aside class="col-4 main-sidebar has-sep" data-sticky="1" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
    <style type="text/css">
        .add-new-bt {
            height: 28px;
            font-size: 8px;
            margin-left: 10px;
        }
    </style>
    <div class="inner theiaStickySidebar" style="margin-top:20px; padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 993.6px;">
        <div id="smartmag-block-posts-small-6" class="widget ts-block-widget smartmag-widget-posts-small">
            <div class="block">
                <section class="block-wrap block-posts-small block-sc mb-none" data-id="11" style="margin-bottom: 50px">
                    <div class="widget-title block-head block-head-ac block-head block-head-ac block-head-e block-head-e2 is-left has-style">
                        <h5 class="heading">{{ __("messages.ACCOUNT_MANAGEMENT") }}</h5>
                    </div>
                    <div class="block-content">
                        <div class="loop loop-small loop-small-a loop-sep loop-small-sep grid grid-1 md:grid-1 sm:grid-1 xs:grid-1">
                            <article class="l-post  small-a-post m-pos-left small-post">
                                <div class="content">
                                    <div class="post-meta post-meta-a post-meta-left has-below">
                                        <div class="post-meta-items meta-below">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                            </svg>
                                            <a class="@if(isset($router_active) && $router_active == 'my_account') active-right-menu @endif" href="{{ route("memberInfo")  }}">{{ __("messages.ACCOUNT_MANAGEMENT_MENU") }}</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="l-post  small-a-post m-pos-left small-post">
                                <div class="content">
                                    <div class="post-meta post-meta-a post-meta-left has-below">
                                        <div class="post-meta-items meta-below @if(isset($router_active) && $router_active == 'news_add') active-right-menu @endif">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-intersect" viewBox="0 0 16 16">
                                                <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm5 10v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-2v5a2 2 0 0 1-2 2H5zm6-8V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2V6a2 2 0 0 1 2-2h5z"/>
                                            </svg>
                                            {{ __("messages.MANAGEMENT_POST_NEWS_MENU") }}
                                            <a href="{{ route('add.news') }}">
                                                <button type="button" class="btn btn-primary add-new-bt">
                                                    {{ __("messages.MANAGEMENT_POST_ADD_NEWS_MENU") }}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                                                    </svg>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="l-post  small-a-post m-pos-left small-post">
                                <div class="content">
                                    <div class="post-meta post-meta-a post-meta-left has-below">
                                        <div class="post-meta-items meta-below">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                            </svg>
                                            <a class="@if(isset($router_active) && $router_active == 'reset_pass') active-right-menu @endif" href="{{ route("reset.password")  }}">{{ __("messages.MANAGEMENT_CHANGE_PASS_MENU") }}</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="l-post  small-a-post m-pos-left small-post">
                                <div class="content">
                                    <div class="post-meta post-meta-a post-meta-left has-below">
                                        <div class="post-meta-items meta-below">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-post-fill" viewBox="0 0 16 16">
                                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-5-.5H7a.5.5 0 0 1 0 1H4.5a.5.5 0 0 1 0-1zm0 3h7a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5z"/>
                                            </svg>
                                            <a class="@if(isset($router_active) && $router_active == 'news_manager') active-right-menu @endif" href="{{ route('news.management') }}">{{ __("messages.MANAGEMENT_POSTED_MENU") }}</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="l-post  small-a-post m-pos-left small-post">
                                <div class="content">
                                    <div class="post-meta post-meta-a post-meta-left has-below">
                                        <div class="post-meta-items meta-below">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                                                <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                            </svg>
                                            <a href="{{ route('logout') }}">{{ __("messages.Logout") }}</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>

</aside>