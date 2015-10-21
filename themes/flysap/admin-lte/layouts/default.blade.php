<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>adminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset ("/bower_components/jquery-ui/themes/base/jquery-ui.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset ("/bower_components/adminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset ("https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{ asset ("https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset ("/bower_components/adminLTE/dist/css/AdminLTE.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- adminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset ("/bower_components/adminLTE/dist/css/skins/skin-black.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset ("/css/style.css") }}" rel="stylesheet" type="text/css" />


    <script src="{{ asset ("/bower_components/jquery/dist/jquery.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/bower_components/jquery-ui/jquery-ui.min.js") }}" type="text/javascript"></script>


    <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="skin-black sidebar-mini">
<div class="wrapper">

    @include('themes::partials.top_menu')

    @include('themes::partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
    </div><!-- /.content-wrapper -->

    @include('themes::partials.footer')

    @include('themes::partials.top_sidebar')
</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- Bootstrap 3.3.2 JS -->
<script src="/bower_components/adminLTE/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- adminLTE App -->
<script src="/bower_components/adminLTE/dist/js/app.min.js" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
</body>

<script type="text/javascript">
    $(function() {
        if( is_collapsed() )
            $('body').addClass('sidebar-collapse');
        else
            $('body').removeClass('sidebar-collapse');

    });

    /**
     * Switch collapsed panel .
     *
     * @param tag
     */
    function switchCollapsed() {
        if( $('body').hasClass('sidebar-collapse') ) {
            localStorage.removeItem('is_collapsed');
        } else {
            localStorage.setItem('is_collapsed', 'true');
        }

        return false;
    }

    /**
     * Check if panel is collapsed .
     *
     * @returns {boolean}
     */
    function is_collapsed() {
        if( supports_html5_storage() ) {
            if( localStorage['is_collapsed'] ) {
                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * Check if browser support html storage .
     *
     * @returns {boolean}
     */
    function supports_html5_storage() {
        try {
            return 'localStorage' in window && window['localStorage'] !== null;
        } catch (e) {
            return false;
        }
    }
</script>

</html>