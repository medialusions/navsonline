<?php
$CI = & get_instance();
if (!isset($CI)) {
    $CI = new CI_Controller();
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>NavsOnline | 404 Page not found</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/semantic/dist/semantic.min.css">
        <script src="<?= base_url(); ?>style/semantic/dist/semantic.min.js"></script> 

        <style type="text/css">
            body {
                background-color: #0b1426;
            }
            body > .grid {
                height: 100%;
            }
            .column {
                max-width: 450px;
            }
        </style>
    </head>
    <body>

        <div class="ui middle aligned center aligned grid">
            <div class="column">
                <a href="<?= base_url(''); ?>">
                    <div class="ui image medium">
                        <img src="<?= base_url(); ?>logo/navsonline_400x108.png" class="image">
                    </div>
                </a>

                <h1 class="ui top attached center aligned header">
                    <?= $heading ?>
                    <div class="sub header"><?= $message ?></div>
                </h1>
                <div class="ui bottom attached segment">
                    <div class="ui error message">
                        Welp... this is a little awkward. I suggest going back <a href="<?= base_url(''); ?>">home</a> and seeing if that helps clear things up.
                    </div>
                </div>
                <div class="ui message">
                    "Not too often do you find all this neatness in one location, that's called Neature. How neat is that?" ~neature walk
                </div>
            </div>
        </div>

    </body>
</html>
