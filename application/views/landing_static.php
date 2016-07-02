<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>NavsOnline | Welcome!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/semantic/dist/semantic.min.css">
        <script src="<?= base_url(); ?>style/semantic/dist/semantic.min.js"></script> 

        <style type="text/css">
            body {
                background-color: #104d79;
            }
            #top_menu .menu .item {
                padding: 23px 20px;
            }
        </style>
    </head>
    <body>

        <div id="top_menu" class="ui inverted segment" style="background: #0b1426;">
            <div class="ui inverted secondary pointing menu">
                <div class="ui image small" style="margin-top: 11px;">
                    <img src="<?= base_url(); ?>logo/navsonline_400x108.png" class="image">
                </div>
                <a class="item active" style="margin-left:25px;">
                    Schedule
                </a>
                <a class="item">
                    Songs
                </a>
                <a class="item">
                    People
                </a>
            </div>
        </div>
    </body>
</html>
