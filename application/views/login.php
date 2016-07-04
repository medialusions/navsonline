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
                    Welcome
                    <div class="sub header">Please login</div>
                </h1>
                <div class="ui bottom attached segment">
                    <?= validation_errors('<div class="ui error message">', '</div>') ?>
                    <?php
                    if ($this->input->get('logout')) 
                        echo '<div class="ui success message">You have successfully logged out.</div>';
                    if (isset($login_error_mesg))
                        echo '<div class="ui success message">Login Error #' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . '</div>';
                    ?>
                    <?= form_open($login_url, ['class' => 'ui large form']) ?>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="login_string" placeholder="Username or Email Address">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="login_pass" placeholder="Password">
                        </div>
                    </div>
                    <input class="ui fluid large teal submit button" type="submit" value="Login">
                    <?= form_close() ?>
                </div>

                <div class="ui message">
                    Having trouble? Contact your local admin.
                </div>
            </div>
        </div>

    </body>
</html>
