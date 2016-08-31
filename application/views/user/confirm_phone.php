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
                                    identifier: 'confirmation',
                                    rules: [
                                        {
                                            type: 'empty',
                                            prompt: 'Enter confirmation code.'
                                        }
                                    ]
                                }
                            },
                            onSuccess: function(event) {
                                event.preventDefault();
                            }
                        });

                $("#resend_button").api({
                    url: '<?= base_url('ajax/resend-phone-confirmation') ?>',
                    on: 'click',
                    onResponse: function(response) {
                        console.log(response);
                        $("#resend_button").state('flash text', response.message);
                    }
                });
                $("#confirm_button").api({
                    url: '<?= base_url('ajax/confirm-phone-confirmation') ?>',
                    on: 'click',
                    method: 'POST',
                    beforeSend: function(settings) {
                        settings.urlData = {
                            confirmation: $("input[name='confirmation']").val()
                        };
                        return settings;
                    },
                    onResponse: function(response) {
                        if (response.success) {
                            $("#confirm_button").state('flash text', response.message);
                            window.location = '<?= base_url('user/preferences') ?>';
                        } else {
                            $("#confirm_button").state('flash text', response.message);
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
                    Confirm your Phone Number
                    <div class="sub header">Enter the confirmation code from the text sent to your cell phone</div>
                </h1>
                <div class="ui bottom attached segment">
                    <div class="ui large form">
                        <div class="ui error message"></div>
                        <div class="field">
                            <input type="text" maxlength="6" name="confirmation" placeholder="Confirmation #" />
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <button class="ui fluid large red button" id="resend_button">Resend</button>
                            </div>
                            <div class="field">
                                <button class="ui fluid large teal submit button" id="confirm_button">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ui message">
                    Having trouble? Contact your local admin.
                </div>
            </div>
        </div>

    </body>
</html>
