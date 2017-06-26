<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html>
<!--<![endif]-->


<!-- Mirrored from themes.gootoboo.com/boo/v2/login-01.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Mar 2016 13:43:38 GMT -->
<head>
    <meta charset="utf-8">
    <title>Login admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom styles -->
    <style type="text/css">
        .signin-content {
            max-width: 360px;
            margin: 60px auto 20px;
        }
    </style>

    <!-- Le styles -->
    <link href="{{ asset('h-admin/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('h-admin/css/bootstrap-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('h-admin/css/extension.css') }}" rel="stylesheet">
    <link href="{{ asset('h-admin/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('h-admin/css/style.css') }}" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="{{ asset('h-admin/libs/selectivizr/selectivizr-1.0.2/js/selectivizr.min.js') }}"></script>
        <script src="{{ asset('h-admin/libs/pl-visualization/excanvas/js/excanvas.min.js') }}"></script>
    <![endif]-->

    <script src="{{ asset('h-admin/libs/modernizr/modernizr-2.6.2/js/modernizr-2.6.2.js') }}"></script>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="{{ asset('h-admin/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('h-admin/ico/apple-touch-icon-144-precomposed.html') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('h-admin/ico/apple-touch-icon-114-precomposed.html') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('h-admin/ico/apple-touch-icon-72-precomposed.html') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('h-admin/ico/apple-touch-icon-57-precomposed.html') }}">
</head>

<body class="signin signin-vertical">
    <div class="page-container">
        <div id="header-container">
            <div id="header">
                <div class="navbar-inverse navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container"></div>
                    </div>
                </div>
                <!-- // navbar -->

                <div class="header-drawer" style="height: 3px"></div>
                <!-- // breadcrumbs -->
            </div>
            <!-- // drawer -->
        </div>
        <!-- // header-container -->

        <div id="main-container">
            <div id="main-content" class="main-content container">
                <div class="signin-content">
                    <h1 class="welcome text-center">
                        Luxury.com<small> admin panel</small></h1>
                    <div class="well well-black well-impressed">
                        <div class="tab-content overflow">
                            @yield('auth.form')
                        </div>
                    </div>
                    <div class="web-description text-center">
                        <h5>Copyright &copy; 2016 luxury.com</h5>
                        <p>
                            All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Le javascript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Libraries -->
    <script src="{{ asset('h-admin/libs/jquery/jquery-1.9.1/jquery.min.js') }}"></script>
    <script src="{{ asset('h-admin/libs/jquery/jquery.migrate-1.1.1/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('h-admin/libs/jquery/jquery.ui.combined-1.10.2/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('h-admin/libs/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- System -->
    <script src="{{ asset('h-admin/libs/pl-system/jquery.nicescroll/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('h-admin/libs/pl-system/jquery-cookie/js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('h-admin/libs/pl-system/jquery-mousewheel/js/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('h-admin/libs/pl-system/xbreadcrumbs/js/xbreadcrumbs.js') }}"></script>
    <!-- System info -->
    <script src="{{ asset('h-admin/libs/pl-system-info/bootstrapx-clickover/js/bootstrapx-clickover.js') }}"></script>
    <script src="{{ asset('h-admin/libs/pl-system-info/gritter/js/jquery.gritter.min.js') }}"></script>
    <script src="{{ asset('h-admin/libs/pl-system-info/jquery.notyfy/js/jquery.notyfy.js') }}"></script>
    <script src="{{ asset('h-admin/libs/pl-system-info/qtip2/js/jquery.qtip.min.js') }}"></script>
    <!-- Form -->
    <script src="{{ asset('h-admin/libs/pl-form/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('h-admin/libs/pl-form/select2/js/select2.js') }}"></script>
    <script src="{{ asset('h-admin/libs/pl-form/uniform/js/jquery.uniform.min.js') }}"></script>
    <!-- Editors -->
    <!-- Content -->
    <!-- Component -->
    <!-- File -->
    <!-- Gallery -->
    <!-- Tables -->
    <!-- Data Visualization -->
    <!-- Only example -->
    <script src="{{ asset('h-admin/libs/google-code-prettify/js/prettify.js') }}"></script>
    <!-- Main js -->
    <script src="{{ asset('h-admin/js/app/core.js') }}"></script>
    <script src="{{ asset('h-admin/js/app/demo-common.js') }}"></script>

    <script>
        $(document).ready(function () {
            // uniform - checkbox, radio style
            $("input.checkbox, input.radio").uniform({
                radioClass: 'radios' // edited class - the original radio
            });
        });
    </script>
</body>

</html>
