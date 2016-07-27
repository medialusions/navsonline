<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>NavsOnline | Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='<?= base_url(); ?>js/jquery/dist/jquery.min.js'></script>
        <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>logo/favicon.png"/>
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
        <script>
            $(document).ready(function() {
                $('.ui.form')
                        .form({
                            fields: {
                                login_string: 'empty',
                                login_pass: 'empty'
                            }
                        });

                setTimeout(function() {
                    $('.dismissing_message')
                            .closest('.message')
                            .transition('fade');
                }, 3000);
            });
        </script>
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
                    Welcome
                    <div class="sub header">Please login</div>
                </h1>
                <div class="ui bottom attached segment">
                    <?php
                    if ($this->input->get('logout'))
                        echo '<div class="ui success message dismissing_message">You have successfully logged out.</div>';
                    if (isset($login_error_mesg))
                        echo '<div class="ui error message">Login Error #' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . '</div>';
                    ?>
                    <?= form_open($login_url, ['class' => 'ui large form']) ?>
                    <div class="ui error message"></div>
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
