@extends('layouts.frontend')

@section('content')
    <div class="main-content general-page container">
        <div class="content-page">
            <div class="scrollWrapper">
                <div class="description">
                    <div id="accordion">
                        @forelse($notifies as $notify)
                        <h3 class="accordion-title">
                            <small>{!! date("Y/m/d H:i", strtotime($notify->created_at)) !!}</small>
                            {{ $notify->title }}
                        </h3>
                        <div class="tab-content">
                            <p>{!! nl2br($notify->content) !!}</p>
                        </div>
                        @empty
                            <h3 class="accordion-title">見つかりませんでした</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $("#accordion").accordion({
                active: false,
                collapsible: true,
                heightStyle: "content"
            });
        });
    </script>
@stop