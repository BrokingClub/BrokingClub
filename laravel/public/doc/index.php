<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

$dir = '../../doc/';

$f = (isset($_GET['f'])) ? $_GET['f'] : 'srs';
switch($f) {
    case 'docs':
        $file = 'Documentation.md';
        break;
    case 'usecases':
        $file = 'UseCases.md';
        break;
    case 'uc_login':
        $file = 'UseCase_Login.md';
        break;
    case 'uc_exchangestocks':
        $file = 'UseCase_ExchangeStocks.md';
        break;
	case 'uc_changepassword':
		$file = 'UseCase_ChangePassword.md';
		break;
	case 'uc_manageclubs':
		$file = 'UseCase_ManageClubs.md';
		break;
    case 'srs':
    default:
        $file = 'SoftwareRequirementsSpecification.md';
        break;
}


$filePath = $dir . $file;

require_once('Documo.php') ;
$documo = new Triggerdesign\Documo($filePath);

$documo->parseMarkdown();

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Broking Club Documentation</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <link href="/css/documo/documo.jquery.css?v=<?php echo time() ?>" rel="stylesheet" />
        <link href="/css/documo/github-markdown.css" rel="stylesheet" />

        <script src="/js/documo/markdown.js"></script>
        <script src="/js/documo/jquery.viewport.js"></script>
        <script src="/js/documo/documo.jquery.js?v=<?php echo time() ?>"></script>

        <link href="/lib/fancybox/jquery.fancybox.css?v=<?php time() ?>" rel="stylesheet" />
        <script src="/lib/fancybox/jquery.fancybox.js?v=<?php time() ?>"></script>
    </head>
    <body>
        <div class="documentation-container clearfix">
            <div id="markdown-original" style="display: none"><?php $documo->printMarkdown() ?></div>

            <div class="documentation-container-full">
                <div id="documentation-navigation" class="pull-left">
                    <span style="text-align: center;">
                        <img src="/img/logo_250.png"/>
                    </span>
                    <br/>
                    <br/>
                    <b>Documentation</b>
                    <br/>
                    <ul>
                        <li><a href="?f=docs">Information about this documentation</a></li>
                        <li><a href="?f=srs">Software Requirements Specification</a></li>
                        <li><a href="?f=usecases">Use Cases</a></li>
                    </ul>
                </div>

                <div id="markdown-viewer" class="documo-viewer pull-left">
                    MarkDown Here 4
                </div>
            </div>

            <script>
                 jQuery( document ).ready(function( $ ) {
                    $('#markdown-viewer').documo({'markdownContainer' : '#markdown-original'});



                     $('a.lightbox-image').fancybox({
                         theme : 'dark'
                     });

                });

            </script>

        </div>
    </body>

</html>