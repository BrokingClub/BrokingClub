
<!-- iOS webapp metatags -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<!-- iOS webapp icons -->
<link rel="apple-touch-icon-precomposed" href="assets/images/ios/fickle-logo-72.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/ios/fickle-logo-72.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/ios/fickle-logo-114.png" />


<!-- TODO: Add a favicon -->
<link rel="shortcut icon" href="assets/images/ico/fab.ico">

<title>{{ $headTitle }}</title>

<!--Page loading plugin Start -->
{{ HTML::style('fickle/css/plugins/pace.css') }}

{{ HTML::script('fickle/js/pace.min.js')  }}
<!--Page loading plugin End   -->

<!-- Plugin Css Put Here -->
{{ HTML::style('fickle/css/bootstrap.min.css') }}
{{ HTML::style('fickle/css/plugins/bootstrap-progressbar-3.1.1.css') }}
{{ HTML::style('fickle/css/plugins/jquery-jvectormap.css') }}
{{ HTML::style('fickle/css/plugins/bootstrap-switch.css') }}

<!--AmaranJS Css Start-->
{{ HTML::style('fickle/css/plugins/amaranjs/jquery.amaran.css') }}
{{ HTML::style('fickle/css/plugins/amaranjs/theme/all-themes.css') }}
{{ HTML::style('fickle/css/plugins/amaranjs/theme/awesome.css') }}
{{ HTML::style('fickle/css/plugins/amaranjs/theme/default.css') }}
{{ HTML::style('fickle/css/plugins/amaranjs/theme/blur.css') }}
{{ HTML::style('fickle/css/plugins/amaranjs/theme/user.css') }}
{{ HTML::style('fickle/css/plugins/amaranjs/theme/rounded.css') }}
{{ HTML::style('fickle/css/plugins/amaranjs/theme/readmore.css') }}
{{ HTML::style('fickle/css/plugins/amaranjs/theme/metro.css') }}
<!--AmaranJS Css End -->

<!-- Plugin Css End -->
<!-- Custom styles Style -->
{{ HTML::style('fickle/css/style.css') }}
<!-- Custom styles Style End-->

<!-- Responsive Style For-->
{{ HTML::style('fickle/css/responsive.css') }}
<!-- Responsive Style For-->

{{ HTML::style('css/game.css?t=' . time()) }}

<!-- Custom styles for this template -->


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->