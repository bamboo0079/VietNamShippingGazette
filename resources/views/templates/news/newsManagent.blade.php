@extends('templates.master')
@section('content')
    <style type="text/css">

        @media(min-width:568px){
            .end{
                margin-left: auto;
            }
        }

        @media(max-width:768px){
            #post{
                width: 100%;
            }
        }
        #clicked{
            padding-top: 1px;
            padding-bottom: 1px;
            text-align: center;
            width: 100%;
            background-color: #ecb21f;
            border-color: #a88734 #9c7e31 #846a29;
            color: black;
            border-width: 1px;
            border-style: solid;
            border-radius: 13px;
        }

        #profile{
            background-color: unset;

        }

        #post{
            margin: 10px;
            padding: 6px;
            padding-top: 2px;
            padding-bottom: 2px;
            text-align: center;
            background-color: #ecb21f;
            border-color: #a88734 #9c7e31 #846a29;
            color: black;
            border-width: 1px;
            border-style: solid;
            border-radius: 13px;
            width: 50%;
        }

        .comments{
            margin-top: 5%;
            margin-left: 20px;
        }

        .darker{
            border: 1px solid #ecb21f;
            background-color: black;
            float: right;
            border-radius: 5px;
            padding-left: 40px;
            padding-right: 30px;
            padding-top: 10px;
        }

        .comment{
            border: 1px solid gainsboro;
            background: var(--c-contrast-50);
            float: left;
            border-radius: 5px;
            padding-left: 18px;
            padding-right: 30px;
            padding-top: 15px;
            width: 100%;
        }
        .comment h4,.comment span,.darker h4,.darker span{
            display: inline;
        }

        label{
            color: rgb(212, 208, 208);
        }

        #align-form{
            margin-top: 20px;
        }
        .form-group p a{
            color: white;
        }

        #checkbx{
            background-color: black;
        }

        #darker img{
            margin-right: 15px;
            position: static;
        }

        .form-group input,.form-group textarea{
            background-color: black;
            border: 1px solid rgba(16, 46, 46, 1);
            border-radius: 12px;
        }

        form{
            border: 1px solid rgba(16, 46, 46, 1);
            background-color: rgba(16, 46, 46, 0.973);
            border-radius: 5px;
            padding: 20px;
        }
        .left-comment {
            margin-left: 42px;
            line-height: 25px;
        }
        .span-items {
            font-size: 12px;
        }
        .status-comment {
            color: red;
            line-height: 30px;
        }
        .status-comment p {
            margin-top: 0px;
        }
        .span-items button{
            font-size: 12px !important;
            padding: 2px;
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
        .alert-warning {
            display: none;
        }
        .close:focus, .close:hover {
            color: #000;
            text-decoration: none;
            opacity: .75;
        }
    </style>
    <div class="main ts-contain cf right-sidebar">
        <div class="ts-row" style="margin-bottom: 50px">
            <div class="col-8 main-content">
                <h1 class="archive-heading"><span>{{ __("messages.NEWS_MANAGEMENT") }}</span></h1>

                <section class="block-wrap block-grid mb-none" data-id="8">
                    @if(count($posted))
                        @foreach($posted as $_posted)
                            <div class="comment mt-4 text-justify float-left">
                                <img src="{{ $_posted->img }}" alt="" class="rounded-circle" width="50" height="50" style="margin-bottom: -8px">
                                <h4>{{ $_posted->title_vn }}</h4>
                                <div class="row left-comment span-items">
                                    <span><strong>{{ __("messages.POST_DATE") }}:</strong> {{ date('Y-m-d H:i',strtotime($_posted->created_at)) }}</span>
                                    <span><strong>{{ __("messages.STATUS") }}:</strong>

                                        @if($_posted->approved == 0)
                                        <span style="color: #0a58ca; font-weight: bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                              <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                              <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                            </svg>
                                            {{ __("messages.WAITING") }}
                                        </span>
                                        @endif
                                        @if($_posted->approved == 1)
                                        <span style="color: #198754; font-weight: bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                              <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                            </svg>
                                            {{ __("messages.APPROVED") }}
                                        </span>
                                        @endif
                                        @if($_posted->approved == 2)
                                        <span style="color: red; font-weight: bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-bar-contract" viewBox="0 0 16 16">
                                              <path fill-rule="evenodd" d="M3.646 14.854a.5.5 0 0 0 .708 0L8 11.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708zm0-13.708a.5.5 0 0 1 .708 0L8 4.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zM1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8z"/>
                                            </svg>
                                            {{ __("messages.REJECT") }}
                                        </span>
                                        @endif
                                    </span>
                                </div>
                                <div class="row left-comment">
                                    <p>
                                        {{ strip_tags(html_entity_decode($_posted->content_vn)) }}
                                        @if($_posted->approved == 2 && strlen($_posted->reject_reason) > 0)
                                            <span class="reject_reason" style="color: red; cursor: pointer;font-size: 12px;margin-left: 10px; ">{{ __("messages.REASON") }}...</span>
                                        @endif
                                        @if(strlen($_posted->reject_reason) > 0 && $_posted->approved == 2)
                                        <div class="alert alert-warning" role="alert">
                                            {{ $_posted->reject_reason }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        @endif
                                    </p>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>{{ __("messages.NEWS_EMPTY") }}</p>
                    @endif
                </section>
            </div>
            @include("templates.members.memberManagement")
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('.close').on('click', function () {
                $(this).parent('.alert').hide();
            });
            $(".reject_reason").on("click", function(){
               $(this).parents('.left-comment').first().find(".alert-warning").show();
            });
        })
    </script>
@stop