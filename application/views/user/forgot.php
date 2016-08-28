<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>NavsOnline | Forgot Password</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='<?= base_url(); ?>js/jquery/dist/jquery.min.js'></script>
        <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>logo/favicon.png"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/semantic/dist/semantic.min.css">
        <script src="<?= base_url(); ?>style/semantic/dist/semantic.min.js"></script> 
        <script src='<?= base_url(); ?>js/zxcvbn.js'></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
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
                                username: {
                                    identifier: 'username',
                                    rules: [
                                        {
                                            type: 'empty',
                                            prompt: 'Username cannot be empty.'
                                        }
                                    ]
                                }
                            }
                        });
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
                    Password Reset
                    <div class="sub header">Provide your username or email</div>
                </h1>
                <div class="ui bottom attached segment">
                    <?php
                    if (isset($success))
                        echo '<div class="ui success message dismissing_message">Reset email sent! Check your email.</div>';
                    if (isset($errors)):
                        ?>
                        <div class="ui error message">
                            <ul class="list">
                                <li><?= $errors ?></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?= form_open('', ['class' => 'ui large form', 'autocomplete' => 'false']) ?>
                    <div class="ui error message"></div>
                    <div class="field">
                        <div class="ui left icon right labeled input">
                            <i class="user icon"></i>
                            <input type="text" name="username" placeholder="Username or email" value="<?= isset($_POST['username']) ? $this->input->post('username') : '' ?>" autocomplete="off" autocorrect="off" />
                        </div>
                    </div>
                    <div class="field">
                        <div class="g-recaptcha" data-sitekey="6LesrSgTAAAAAE2B71fMi4H0yKpK0KyiRUCiv6pi"></div>
                    </div>
                    <input class="ui fluid large teal submit button" type="submit" value="Submit">
                    <?= form_close() ?>
                </div>

                <div class="ui message">
                    Having trouble? Contact your local admin.
                </div>
            </div>
        </div>

    </body>
</html>
