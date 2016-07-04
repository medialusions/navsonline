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
                background-color: #0b1426;
            }
            body > .grid {
                height: 100%;
            }
            .image {
                margin-top: -100px;
            }
            .column {
                max-width: 450px;
            }
        </style>
    </head>
    <body>

        <div class="ui middle aligned center aligned grid">
            <div class="column">
                <h2 class="ui image medium">
                    <img src="<?= base_url(); ?>logo/navsonline_400x108.png" class="image">
                </h2>

                <h1 class="ui top attached center aligned header">
                    Ouch...
                    <div class="sub header">There seems to be a problem.</div>
                </h1>
                <div class="ui bottom attached segment">
                    <div class="ui error message">
                        It appears this IP address and username has been banned.
                    </div>
                </div>
                <div class="ui message">
                    If you think this is an accident, contact your local admin.
                </div>
            </div>
        </div>

    </body>
</html>
