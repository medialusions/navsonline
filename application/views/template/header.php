<!DOCTYPE html>
<html>
    <head>
        <title><?= isset($title) ? $title . ' | ' : '' ?>NavsOnline</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>logo/favicon.png"/>
        <script src='<?= base_url(); ?>js/jquery/dist/jquery.min.js'></script>
        <script src='<?= base_url(); ?>js/jquery/jquery-dateFormat.min.js'></script>
        <script src="<?= base_url(); ?>style/semantic/dist/semantic.min.js"></script> 
        <link rel="stylesheet" href="<?= base_url(); ?>style/semantic/dist/semantic.min.css">

        <style type="text/css">
            body {
                background-color: #104d79;
            }
            #top_menu .menu .item {
                padding: 23px 20px;
            }
            #main_content{
                max-width: 1100px;
                margin: auto auto;
            }
        </style>

        <script>
            $(document).ready(function() {
                $('.navs_popup').popup();
                $('.dropdown').dropdown();
                $('.dropdown.additions').dropdown({
                    allowAdditions: true
                });
                $('.nav_tags').dropdown({
                    allowAdditions: true
                });

                setTimeout(function() {
                    $('.dismissing_message')
                            .closest('.message')
                            .transition('fade');
                }, 3000);
            });

            //API setup
            $.fn.api.settings.api = {
                'event confirm': '<?= base_url('/ajax/event-confirm'); ?>/{eid}/{uid}',
                'event deny': '<?= base_url('/ajax/event-deny'); ?>/{eid}/{uid}',
                'blockout add': '<?= base_url('/ajax/blockout-add'); ?>',
                'blockout delete': '<?= base_url('/ajax/blockout-delete'); ?>/{uid}/{db}/{de}',
                'event delete': '<?= base_url('/ajax/event-delete'); ?>/{eid}'
            };
        </script>
    </head>
    <body>

        <div id="top_menu" class="ui inverted fixed top segment" style="background: #0b1426;">
            <div class="ui inverted secondary stackable pointing menu">
                <a class="ui image small" style="margin-top: 11px;" href="<?= base_url('') ?>">
                    <img src="<?= base_url(); ?>logo/navsonline_400x108.png" class="image">
                </a>
                <a class="item <?= uri_string() == 'user/schedule' || uri_string() == '' ? 'active' : '' ?>" style="margin-left:25px;" href="<?= base_url('user/schedule'); ?>">
                    <i class="unordered list icon"></i>
                    Schedule
                </a>
                <a class="item <?= uri_string() == 'user/music' ? 'active' : '' ?>" href="<?= base_url('user/music'); ?>">
                    <i class="music icon"></i>
                    Songs
                </a>
                <a class="item <?= uri_string() == 'user/people' ? 'active' : '' ?>" href="<?= base_url('user/people'); ?>">
                    <i class="users icon"></i>
                    People
                </a>
                <div class="ui secondary inverted stackable right pointing menu">
                    <a class="ui item <?= uri_string() == 'user/preferences' ? 'active' : '' ?>" href="<?= base_url('user/preferences'); ?>">
                        <i class="setting icon"></i>
                        Settings
                    </a>
                    <a class="ui item <?= uri_string() == 'user/logout' ? 'active' : '' ?>" href="<?= base_url('user/logout'); ?>">
                        <i class="sign out icon"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
