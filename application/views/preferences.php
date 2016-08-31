<?php $this->load->view('template/header'); ?>

<script src='<?= base_url(); ?>js/zxcvbn.js'></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ui.form')
                .form({
                    fields: {
                        first_name: {
                            identifier: 'first_name',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: 'First name cannot be blank.'
                                }
                            ]
                        },
                        last_name: {
                            identifier: 'last_name',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: 'Last name cannot be blank.'
                                }
                            ]
                        }
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
</script>

<!-- content -->
<div id="main_content" class="ui stackable grid">

    <!-- main content -->
    <div class="ui twelve wide column">

        <div class="ui segment">
            <!-- welcome message -->
            <h1 class="ui header">
                Preferences
                <div class="sub header">If things aren't going the way you want them to, this is the place to change 'em.</div>
            </h1>
            <?php if (isset($form_errors)): ?>
                <div class="ui error message">
                    <ul class="list">
                        <?php foreach ($form_errors as $errors): ?>
                            <li><?= $errors ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?= form_open('user/preferences', ['id' => 'username', 'class' => 'ui form']) ?>
            <!-- GENERAL SECTION -->
            <h2 class="ui dividing header">
                General Preferences
            </h2>
            <!-- name -->
            <div class="two fields">
                <div class="field">
                    <label>First Name</label>
                    <input name="first_name" type="text" value="<?= $user['first_name'] ?>" >
                </div>

                <div class="field">
                    <label>First Name</label>
                    <input name="last_name" type="text" value="<?= $user['last_name'] ?>" >
                </div>
            </div>
            <!-- username -->
            <div class="field">
                <label>Username</label>
                <input name="username" type="text" value="<?= $user['username'] ?>"  disabled="">
                <em>Cannot change username at this time.</em>
            </div>
            <!-- password -->
            <div class="field">
                <label>Current Password</label>
                <input name="passwd" type="password" placeholder="••••••••••">
            </div>
            <div class="two fields">
                <div class="field">
                    <label>New Password</label>
                    <input type="password" name="password" autocomplete="off" autocorrect="off">
                    <input type="hidden" name="strength" id="strength" value="0">
                    <div class="ui tiny progress" id="p_strength" style="display: none;">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                </div>
                <div class="field">
                    <label>Confirm New Password</label>
                    <input name="new_password_repeat" type="password" >
                </div>
            </div>
            <!-- CONTACT SECTION -->
            <h2 class="ui dividing header">
                Contact Preferences
            </h2>
            <div class="two fields">
                <!-- phone number -->
                <div class="field">
                    <label>Phone Number</label>
                    <input name="phone" type="text" class="nav_phone" value="<?= $user['phone'] ?>">
                </div>
                <!-- email -->
                <div class="field">
                    <label>Email Address</label>
                    <input name="phone" type="email"  value="<?= $user['email'] ?>" disabled="">
                    <em>Cannot change email address at this time.</em>
                </div>
            </div>
            <div class="inline fields">
                <label for="type">Preferred form of communication</label>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="comm_preference" value="email" <?= $user['comm_preference'] == 'email' ? 'checked=""' : '' ?> tabindex="0" class="hidden">
                        <label>Email</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="comm_preference" value="phone" <?= $user['comm_preference'] == 'phone' ? 'checked=""' : '' ?> tabindex="0" class="hidden">
                        <label>Phone</label>
                    </div>
                </div>
            </div>
            <input type="submit" class="ui button" value="Save Preferences">
            <?= form_close() ?>
        </div>
    </div>
    <?php $this->load->view('template/sidebar'); ?>
</div>


<?php
//$this->load->view('modal/user_new');

$this->load->view('template/footer');
