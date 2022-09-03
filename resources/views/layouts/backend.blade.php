<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="{{ config('const.app_name') }}">
    <meta name="keywords" content="{{ config('const.app_name') }}" />
    <meta name="author" content="{{ config('const.app_name') }}">
    <title>{{ config('const.app_name') }}</title>
    <link rel="apple-touch-icon" sizes="32x32" href="/frontend/images/favicon.png" />
    <link rel="apple-touch-icon" sizes="64x64" href="/frontend/images/favicon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/frontend/images/favicon.png" />
    <link rel="icon" type="image/png" sizes="64x64" href="/frontend/images/favicon.png" />
    <!-- Custom fonts for this template-->
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/css/admin.css') }}?version={{time()}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/custom.css') }}?version={{time()}}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</head>
<body id="page-top">
@if (Auth::check())
    @include('backend.elements.header')
    <!-- Sidebar -->
    @include ('backend.elements.sidebar')
@endif
<!-- End of Sidebar -->
<!-- Page Wrapper -->
    <div @if(Auth::check()) id="wrapper" @else id="login-wrapper" @endif>
        @if (session('status'))
            <div class="container-fluid">
                <div class="card" style="border: none">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        @yield('content')
    </div>
            <!-- End -->
    @if(Auth::check())
        @include('backend.elements.footer')
    @endif
    @section('post-js')
    @show
</body>
</html>

