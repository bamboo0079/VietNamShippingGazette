@extends('templates.master')
@section('content')
    <style type="text/css">
        table.news-table tr td {
            font-size: 13px;
        }
        table.news-table tr td a {
            font-weight: bold;
        }
        table.news-table tr th {
            line-height: 50px;
        }
    </style>
    <div class="main ts-contain cf right-sidebar spc-alp-main" style="transform: none;">

        <div class="ts-row" style="transform: none;">
            <div class="col-8 main-content">
                <h1 class="archive-heading"><span>{{ __("messages.ACCOUNT_MANAGEMENT") }}</span></h1>
                @if(count($posts))
                <table class="table table-striped news-table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" width="20%">{{ __("messages.POST_DATE") }}</th>
                        <th scope="col" width="60%">{{ __("messages.CONTENT") }}</th>
                        <th scope="col" width="20%">{{ __("messages.CONTENT") }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $k => $_post)
                    <tr>
                        <td>{{ date("Y/m/d H:is",strtotime($_post->created_at)) }}</td>
                        <td>
                            <a class="newsContent" href="javascript:void(0)">{{ $_post->title_vn }}</a></br>
                            <span>{!! \App\Helpers\Helper::limitCharacters($_post->content_vn, \App\ConstApp::NUMBER_CHARACTERS_LIMIT_NEWS) !!}</span>
                        </td>
                        <td><button type="button" class="btn btn-info">Info</button></td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>
                @endif
            </div>

            @include("templates.members.memberManagement")

        </div>
    </div>
@stop