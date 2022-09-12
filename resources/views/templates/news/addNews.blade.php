@extends('templates.master')
@section('content')
    <style type="text/css">
        .comment-respond {
            margin-bottom: 30px;
            background: var(--c-contrast-50);
            padding: 35px 30px;
            padding-bottom:15px;
        }
        input, textarea, select {
            border: 1px solid var(--c-contrast-150);
            padding: 7px 12px;
            outline: 0;
            height: auto;
            font-size: 14px;
            color: var(--c-contrast-500);
            max-width: 100%;
            border-radius: 2px;
            box-shadow: 0 2px 7px -4px rgb(0 0 0 / 10%);
            background: var(--c-input-bg,var(--c-contrast-0));
        }
        .add-news-form input {
            width: 350px;
        }
        #regis-submit {
            width: 70px !important;
        }
        .close:focus, .close:hover {
            color: #000;
            text-decoration: none;
            opacity: .75;
        }
        .alert-dismissible .close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.75rem 1.25rem;
            color: inherit;
        }
        button.close {
            margin-top: -8px !important;
            padding: 0;
            background-color: transparent;
            border: 0;
            -webkit-appearance: none;
        }
        .close {
            float: right;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            opacity: .5;
        }
        .form-group {
            margin-bottom: 10px;
            font-size: 13px;
        }
        .form-group select {
            width: 155px;

        }
        .botton-row {
            margin-bottom: 30px;
        }
        .custom-file-input {
            width: 400px;
        }
    </style>

    <div class="main ts-contain cf right-sidebar">
        <div class="ts-row">
            <div class="col-8 main-content">
                <h1 class="archive-heading"><span>{{ __("messages.MANAGEMENT_POST_NEWS") }}</span></h1>
                <section class="block-wrap block-grid mb-none" data-id="8">
                    <div class="block-content form-body-register">

                        <form class="information_search col-12" id="schedule-full-form" action="" method="post" enctype="multipart/form-data">
                            @if(Session::has('errMsg') && ! Session::has('successMsg'))
                                <div class="alert alert-danger" role="alert">
                                    {{ Session::get('errMsg') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            @if(Session::has('successMsg'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('successMsg') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                            <div id="respond" class="comment-respond">

                            <div class="row mt-2">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{ __("messages.NEWS_TITLE") }}</label>
                                    <div class="col-sm-10">
                                        <select required placeholder="{{ __("messages.NEWS_TITLE") }}" class=" form-control" name="category_id" style="appearance:auto;padding: 8px;">
                                            <option value=""></option>
                                            @foreach($trades_menu as $menu)
                                                <option
                                                        @if(Session::has('category_id') && Session::get('category_id') == $menu->id)  {{ 'selected="selected"' }} @endif
                                                        value="{{ $menu->id }}">@if(Session::get('locale') == 'vi') {{ $menu->name_vn }} @else {{ $menu->name_en }} @endif</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{ __("messages.NEWS_TITLE") }}</label>
                                    <div class="col-sm-10">
                                        <input style="height: 40px" required value="@if(Session::has('title_vn'))  {{ Session::get('title_vn') }} @endif" placeholder="{{ __("messages.NEWS_TITLE") }}" class="input-block-level form-control" name="title_vn" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{ __("messages.NEWS_CONTENT") }}</label>
                                    <div class="col-sm-10">
                                        <textarea name="content_vn" id="content_vn" rows="10" cols="80">
                                             @if(Session::has('content_vn'))  {{ Session::get('content_vn') }} @endif

                                        </textarea>
                                        <script>
                                            CKEDITOR.replace( 'content_vn' );
                                        </script>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{ __("messages.NEWS_IMAGE") }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control custom-file-input" type="file" id="img" name="img">
                                    </div>
                                </div>
                                <div class="form-group row botton-row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"></path>
                                            </svg>
                                            {{ __("messages.ADD_NEW") }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>

            @include("templates.members.memberManagement")
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $('.close').on('click', function () {
                $(this).parent('.alert').hide();
            })
        })
    </script>




@stop