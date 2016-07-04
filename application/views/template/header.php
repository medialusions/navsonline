<!DOCTYPE html>
<html>
    <head>
        <title>NavsOnline<?= isset($title) ? ' | '.$title : '' ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='<?= base_url(); ?>js/jquery/dist/jquery.min.js'></script>
        <script src='<?= base_url(); ?>js/moment/min/moment.min.js'></script>
        <script src='<?= base_url(); ?>js/fullcalendar/dist/fullcalendar.min.js'></script>
        <script src="<?= base_url(); ?>style/semantic/dist/semantic.min.js"></script> 
        <script src="<?= base_url(); ?>js/jquery-ui/jquery-ui.min.js"></script> 

        <link rel="stylesheet" href="<?= base_url(); ?>js/jquery-ui/jquery-ui.min.css">
        <link rel='stylesheet' href='<?= base_url(); ?>js/fullcalendar/dist/fullcalendar.min.css' />
        <link rel="stylesheet" href="<?= base_url(); ?>style/semantic/dist/semantic.min.css">

        <style type="text/css">
            body {
                background-color: #104d79;
            }
            #top_menu .menu .item {
                padding: 23px 20px;
            }
            #calendar .fc-today {
                font-weight: bold;
                color: #1d2bd5;
            }
            #main_content{
                min-width: 750px;
            }
        </style>

        <script>
            $(document).ready(function() {
                $('#calendar').fullCalendar({
                    header: {
                        left: '',
                        center: '',
                        right: 'today prev,next'
                    },
                    height: 'auto',
                    theme: true
                });

                $('.navs_popup').popup();
            });
        </script>
    </head>
    <body>

        <div id="top_menu" class="ui inverted fixed top segment" style="background: #0b1426;">
            <div class="ui inverted secondary pointing menu">
                <div class="ui image small" style="margin-top: 11px;">
                    <img src="<?= base_url(); ?>logo/navsonline_400x108.png" class="image">
                </div>
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
                <div class="right menu">
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

        <!-- spacer -->
        <div style="width: 100%; height: 30px; display: block;"></div>