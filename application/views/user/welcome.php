<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>NavsOnline | Welcome</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='<?= base_url(); ?>js/jquery/dist/jquery.min.js'></script>
        <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>logo/favicon.png"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/semantic/dist/semantic.min.css">
        <script src="<?= base_url(); ?>style/semantic/dist/semantic.min.js"></script> 
        <script src='<?= base_url(); ?>js/zxcvbn.js'></script>

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
                //init hidden
                $("#taken").hide();
                $("#available").hide();
                $("#load").hide();

                $('.ui.form')
                        .form({
                            fields: {
                                strength: {
                                    identifier: 'strength',
                                    rules: [
                                        {
                                            type: 'integer[2..4]',
                                            prompt: 'Password must be stronger. {value}/4'
                                        }
                                    ]
                                },
                                username: {
                                    identifier: 'username',
                                    rules: [
                                        {
                                            type: 'empty',
                                            prompt: 'Username cannot be empty.'
                                        },
                                        {
                                            type: 'minLength[4]',
                                            prompt: 'Username must be at least 4 characters.'
                                        }
                                    ]
                                },
                                password: {
                                    identifier: 'password',
                                    rules: [
                                        {
                                            type: 'empty',
                                            prompt: 'Password must not be empty.'
                                        }
                                    ]
                                },
                                password_2: {
                                    identifier: 'password_2',
                                    rules: [
                                        {
                                            type: 'match[password]',
                                            prompt: 'Passwords must match.'
                                        }
                                    ]
                                }
                            }
                        });

                setTimeout(function() {
                    $('.dismissing_message')
                            .closest('.message')
                            .transition('fade');
                }, 3000);
                //when input is changed  
                $("input[name='username']").on('input', function() {
                    $("#taken").hide();
                    $("#available").hide();
                    $("#load").show();
                    $('#message').html("Checking");
                    //run the character number check  
                    if ($("input[name='username']").val().length < 4) {
                        //if it's bellow the minimum show characters_error text '  
                        $('#message').html("4 character min");
                    } else {
                        //else show the cheking_text and run the function to check
                        check_availability();
                    }
                });
                //find the password strength
                $('#p_strength').progress({total: 10});
                $("input[name='password']").on('input', function() {
                    $("#p_strength").show();
                    $('#p_strength').progress('set label', '')
                            .progress('set active');
                    var passwd = $("input[name='password']").val();
                    if (passwd.length === 0) {
                        $("#p_strength").hide();
                        return;
                    }
                    var strength = zxcvbn(passwd);
                    var score = strength.score;
                    $("#strength").val(score);
                    switch (score) {
                        case 0:
                            $('#p_strength').addClass('red');
                            $('#p_strength').removeClass('orange yellow olive green');
                            $('#p_strength').progress('set progress', 1)
                                    .progress('set label', (strength.feedback.warning === '' ? 'Extremely weak' : strength.feedback.warning));
                            break;
                        case 1:
                            $('#p_strength').addClass('orange');
                            $('#p_strength').removeClass('red yellow olive green');
                            $('#p_strength').progress('set progress', 3)
                                    .progress('set label', (strength.feedback.warning === '' ? 'Weak' : strength.feedback.warning));
                            break;
                        case 2:
                            $('#p_strength').addClass('yellow');
                            $('#p_strength').removeClass('red orange olive green');
                            $('#p_strength').progress('set progress', 5)
                                    .progress('set label', (strength.feedback.warning === '' ? 'Ok' : strength.feedback.warning));
                            break;
                        case 3:
                            $('#p_strength').addClass('olive');
                            $('#p_strength').removeClass('red orange yellow green');
                            $('#p_strength').progress('set progress', 7)
                                    .progress('set label', (strength.feedback.warning === '' ? 'Good password' : strength.feedback.warning));
                            break;
                        case 4:
                            $('#p_strength').addClass('green');
                            $('#p_strength').removeClass('red orange yellow olive');
                            $('#p_strength').progress('set progress', 9)
                                    .progress('set label', 'Great password');
                            break;
                    }
                });
            });

            //function to check username availability  
            function check_availability() {

                //get the username  
                var username = $("input[name='username']").val();

                //use ajax to run the check  
                $.post('<?= base_url('ajax/unique-username') ?>',
                        {username: username})
                        .done(function(result) {
                            result = JSON.parse(result);
                            //if the result is 1  
                            if (result.unique === true) {
                                //show that the username is available  
                                $("#load").hide();
                                $("#available").show();
                            } else {
                                //show that the username is NOT available  
                                $("#load").hide();
                                $("#taken").show();
                            }
                        });

            }
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
                    <div class="sub header">Finish creating your account</div>
                </h1>
                <div class="ui bottom attached segment">
                    <?php if (isset($errors)): ?>
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
                            <input type="text" name="username" placeholder="Desired username" autocomplete="off" autocorrect="off" />
                            <div class="ui small left pointing red basic label" style="display:none;" id="taken">
                                <i class="ban icon"></i>
                                Taken
                            </div>
                            <div class="ui small left pointing green basic label" style="display:none;" id="available">
                                <i class="checkmark icon"></i>
                                Available
                            </div>
                            <div class="ui small left pointing grey basic label" style="display:none;" id="load">
                                <i class="notched circle loading icon"></i>
                                <span id="message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="Password" autocomplete="off" autocorrect="off">
                            <input type="hidden" name="strength" id="strength" value="0">
                        </div>
                        <div class="ui tiny progress" id="p_strength" style="display: none;">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password_2" placeholder="Password confirmed" autocomplete="off" autocorrect="off">
                        </div>
                    </div>
                    <input class="ui fluid large teal submit button" type="submit" value="Save &amp; Login">
                    <?= form_close() ?>
                </div>

                <div class="ui message">
                    Having trouble? Contact your local admin.
                </div>
            </div>
        </div>

    </body>
</html>
