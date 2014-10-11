<?php
failfunction();
require_once('Documo.php') ;
$documo = new Triggerdesign\Documo('../../doc/Test.md');

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

        <link href="css/documo.jquery.css" rel="stylesheet" />
        <link href="css/github-markdown.css" rel="stylesheet" />
        <script src="js/markdown.js"></script>
        <script src="js/jquery.viewport.js"></script>
        <script src="js/documo.jquery.js"></script>
    </head>
    <body>
        <div class="container">
            <div id="markdown-original" style="display: none"><?php $documo->printMarkdown() ?></div>

            <div id="markdown-viewer" class="documo-viewer">
                MarkDown Here 2
            </div>

            <script>
                 jQuery( document ).ready(function( $ ) {
                    $('#markdown-viewer').documo({'markdownContainer' : '#markdown-original'});
                });

            </script>

        </div>
    </body>

</html>