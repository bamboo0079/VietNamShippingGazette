<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
    <title>{{ config('const.app_name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ config('const.app_name') }}">
    <meta name="keyword" content="{{ config('const.app_name') }}">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 2020 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <link rel="apple-touch-icon" sizes="32x32" href="/frontend/images/favicon.svg" />
    <link rel="apple-touch-icon" sizes="64x64" href="/frontend/images/favicon.svg" />
    <link rel="icon" type="image/png" sizes="32x32" href="/frontend/images/favicon.svg" />
    <link rel="icon" type="image/png" sizes="64x64" href="/frontend/images/favicon.svg" />
    <link href="/frontend/assets/css/bootstrap.min.css?v=01" rel="stylesheet" media="screen" />
    <link href="/frontend/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="/frontend/assets/js/jquery/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="/frontend/assets/js/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/frontend/assets/js/plugins/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="/frontend/assets/js/plugins/audio/jquery.audioControls.min.js" type="text/javascript"></script>
    <style>
        .content-page {
            height: 100%;
            position: relative;
            width: 360px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="mainWrappers">
    <div class="content-page">
        <div class="main_wrappers notfound-wrappers">
            <section class="block-error-wrapper">
                <div class="block-error">
                    <h1 class="text-center">404 Not Found</h1>
                    <h3 class="text-center">Trang tìm kiếm không tồn tại</h3>
                    <!--<div class="img-404">
                        <img src="/images/404.svg" />
                    </div>-->
                    <div class="buttons-set bottom text-center">
                        <a href="/" class="btn btn-primary block">Trang chủ</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</body>
</html>