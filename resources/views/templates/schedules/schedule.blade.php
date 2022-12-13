@extends('templates.master')
@section('content')
    <style>
        .chosen-container-single .chosen-single{
            height:38px;
            line-height: 36px;
        }
        #schedule-full-form{
            border: 1px solid #c3c2c2;
            padding: 15px;
            margin-bottom: 25px;
        }
        .table-bordered, .table-bordered td, .table-bordered th {
            border-bottom: 1px solid #dddddd;
            border-collapse: separate;
            border-collapse: collapse;
            font-size: 12px !important;
        }
        .chosen-container-single .chosen-single div b {
            background-position-y: 10px;
        }
        .chosen-container {
            height: 35px !important;
        }
        .chosen-container a.chosen-single {
            height: 35px !important;
            line-height: 35px;
        }
        .chosen-container a.chosen-single b{
            margin-top: 6px !important;
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
        .error_message {
            display: none;
        }
    </style>
    <div class="main ts-contain cf right-sidebar">
        <div class="ts-row">
            <div class="col-8 main-content" style="width:100%">

                <h1 class="archive-heading"><span> {{ __("messages.SEARCH_SCHEDULE_TITLE") }}</span></h1>
                <section class="block-wrap block-grid mb-none" data-id="8">
                    <div class="alert alert-danger error_message" role="alert">
                        {{ __("messages.SEARCH_REQUIRED_PARAM") }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="block-content">
                        <!--Full form-->
                        <form class="information_search col-12" id="schedule-full-form" action="" method="get">
                            <div class="row top-row">
                                <div class="col-4">
                                    <select id="agent_id" class="chosen-select form-control" name="agent_id" tabindex="-1" aria-hidden="true">
                                        <option value=""> {{ __("messages.AGENT") }}</option>
                                        @foreach($agents as $agent)
                                            @if(Session::get('locale') == 'vi')
                                                <option @if(isset($_GET['agent_id']) && $_GET['agent_id'] == $agent->id) selected @endif  value="{{ $agent->id }}">{{ $agent->agent_nm_vn }}</option>
                                            @else
                                                <option @if(isset($_GET['agent_id']) && $_GET['agent_id'] == $agent->id) selected @endif  value="{{ $agent->id }}">{{ $agent->agent_nm_en }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select id="boss_port_id" class="chosen-select form-control" name="boss_port_id" tabindex="-1" aria-hidden="true">
                                        <option value="">POL</option>
                                        @foreach($list_port as $port)
                                            @if(Session::get('locale') == 'vi')
                                                <option @if(isset($_GET['boss_port_id']) && $_GET['boss_port_id'] == $port->id) selected @endif value="{{ $port->id }}">{{ $port->port_nm_vn }}</option>
                                            @else
                                                <option @if(isset($_GET['boss_port_id']) && $_GET['boss_port_id'] == $port->id) selected @endif value="{{ $port->id }}">{{ $port->port_nm_en }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select id="unloading_port_id" class="chosen-select form-control" name="unloading_port_id" tabindex="-1" aria-hidden="true">
                                        <option value="">POD</option>
                                        @foreach($list_port as $port)
                                            @if(Session::get('locale') == 'vi')
                                                <option @if(isset($_GET['unloading_port_id']) && $_GET['unloading_port_id'] == $port->id) selected @endif value="{{ $port->id }}">{{ $port->port_nm_vn }}</option>
                                            @else
                                                <option @if(isset($_GET['unloading_port_id']) && $_GET['unloading_port_id'] == $port->id) selected @endif value="{{ $port->id }}">{{ $port->port_nm_en }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-4">
                                    <input id="datetimepicker1" value="@if(isset($_GET['departure_day'])){{ $_GET['departure_day'] }}@endif" class="input-block-level form-control input-date" data-date="" data-date-format="DD MMMM YYYY" placeholder="ETD" id="departure_day" data-position="right top" autocomplete="off" name="departure_day" type="text">
                                </div>
                                <div class="col-4">
                                    <input id="datetimepicker2" value="@if(isset($_GET['arrival_date'])){{ $_GET['arrival_date'] }}@endif" class="input-block-level form-control input-date" data-date="" data-date-format="DD MMMM YYYY" placeholder="ETA" id="arrival_date" autocomplete="off" name="arrival_date" type="text">
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary search-schedule">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                        </svg>
                                        {{ __("messages.SEARCH") }}
                                    </button>
                                    <button id="dl" type="button" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M7.646 10.854a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 9.293V5.5a.5.5 0 0 0-1 0v3.793L6.354 8.146a.5.5 0 1 0-.708.708l2 2z"></path>
                                            <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"></path>
                                        </svg>
                                        {{ __("messages.DOWNLOAD") }}
                                    </button>
                                </div>
                            </div>
                        </form>

                            <table id="schedule-table" class="table table-hover table-nomargin table-bordered">
                                <thead>
                                <tr>

                                    <th id="lichtau-grid_cLoadVesselVoyage">Vessel - Voyage</th>
                                    <th id="lichtau-grid_cPOL">POL</th>
                                    <th id="lichtau-grid_cETD">ETD</th>
                                    <th id="lichtau-grid_cPOD">POD</th>
                                    <th id="lichtau-grid_cETA">ETA</th>
                                    <th id="lichtau-grid_cETA">Transit Port</th>
                                    <th id="lichtau-grid_cMaHangTau">Line</th>
                                    <th id="lichtau-grid_cLoadVesselVoyage">Voyage Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($list_scenarios) > 0)
                                        @foreach($list_scenarios as $k => $scenario)
                                            <tr >
                                                <td>{{ $scenario->ship->ship_nm_en }}</td>
                                                <td>{{ $scenario->boss->port_nm_en }}</td>
                                                <td><b>{{ date("d/m/y",strtotime($scenario->departure_day)) }}</b></td>
                                                <td>{{ $scenario->unloading->port_nm_en }}</td>
                                                <td><b>{{ date("d/m/Y",strtotime($scenario->arrival_date)) }}</b></td>
                                                <td>{{ isset($scenario->transit->port_nm_en) ? $scenario->transit->port_nm_en : "" }}</td>
                                                <td>{{ $scenario->agent->agent_nm_en }}</td>
                                                <td>{!! App\Helpers\Helper::substractTwoDate( $scenario->departure_day, $scenario->arrival_date)  !!}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">{{ __("messages.DATA_NOT_FOUND") }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                    </div>

                </section>
            </div>

            <aside class="d-none col-4 main-sidebar has-sep" data-sticky="1">
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
    <script type="text/javascript">
        $(function() {
            $('.close').on('click', function () {
                $(this).parent('.alert').hide();
            });
            $(".search-schedule").on("click",function() {
                $(".error_message").hide();
                var check_search = false;
                var agent_id = $("#agent_id").val();
                if(agent_id != '0' && agent_id != '') {
                   check_search = true;
                }
                var boss_port_id = $("#boss_port_id").val();
                if(boss_port_id != '0' && boss_port_id != '') {
                    check_search = true;
                }
                var unloading_port_id = $("#unloading_port_id").val();
                if(unloading_port_id != '0' && unloading_port_id != '') {
                    check_search = true;
                }
                var datetimepicker1 = $("#datetimepicker1").val();
                if(datetimepicker1 != '0' && datetimepicker1 != '') {
                    check_search = true;
                }
                var datetimepicker2 = $("#datetimepicker2").val();
                if(datetimepicker2 != '0' && datetimepicker2 != '') {
                    check_search = true;
                }

                if(check_search == false) {
                    $(".error_message").show();
                    return false;
                } else {
                    return true;
                }

            });
        })
    </script>
@stop