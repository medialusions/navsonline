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
                <a class="item active" style="margin-left:25px;">
                    <i class="unordered list icon"></i>
                    Schedule
                </a>
                <a class="item">
                    <i class="music icon"></i>
                    Songs
                </a>
                <a class="item">
                    <i class="users icon"></i>
                    People
                </a>
                <div class="right menu">
                    <a class="ui item">
                        <i class="setting icon"></i>
                        Settings
                    </a>
                    <a class="ui item">
                        <i class="sign out icon"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>

        <!-- spacer -->
        <div style="width: 100%; height: 30px; display: block;"></div>

        <!-- content -->
        <div class="ui middle aligned center aligned grid">
            <div class="ui segment">

                <?php $this->load->view('template/rail'); ?>

                <!-- main content -->
                <div id="main_content">
                    <div class="column">

                        <!-- welcome message -->
                        <h1 class="ui center aligned header">
                            Welcome, Zach Smith
                            <div class="sub header">Here is the upcoming schedule</div>
                        </h1>

                        <!-- spacer -->
                        <div style="width: 100%; height: 20px; display: block;"></div>

                        <div class="ui grid">
                            <!-- agenda table -->
                            <table class="ui very basic table">
                                <thead>
                                    <tr>
                                        <th class="">Event</th>
                                        <th class="">Date</th>
                                        <th class="">Your Role</th>
                                        <th class="">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- agenda template -->
                                    <tr>
                                        <td>
                                            <a href="#">
                                                Nav Night
                                            </a>
                                        </td>
                                        <td>Aug 14th</td>
                                        <td>Lead Guitar, Vocals</td>
                                        <td>
                                            <div class="ui icon buttons tiny">
                                                <button class="ui button basic blue tiny navs_popup" data-content="View" data-position="top center">
                                                    <i class="unhide icon"></i>
                                                </button>
                                                <button class="ui button basic blue tiny navs_popup" data-content="Edit (admin)" data-position="top center">
                                                    <i class="write icon"></i>
                                                </button>
                                            </div>
                                            <div class="ui icon buttons tiny">
                                                <button class="ui button basic green tiny navs_popup" data-content="Confirm" data-position="top center">
                                                    <i class="check icon"></i>
                                                </button>
                                                <button class="ui button basic red tiny navs_popup" data-content="Deny" data-position="top center">
                                                    <i class="close icon"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- end template -->
                                    <!-- agenda template -->
                                    <tr>
                                        <td>
                                            <a href="#">
                                                Nav Night
                                            </a>
                                        </td>
                                        <td>Aug 14th</td>
                                        <td>Lead Guitar, Vocals</td>
                                        <td>
                                            <div class="ui icon buttons tiny">
                                                <button class="ui button basic blue tiny navs_popup" data-content="View" data-position="top center">
                                                    <i class="unhide icon"></i>
                                                </button>
                                                <button class="ui button basic blue tiny navs_popup" data-content="Edit (admin)" data-position="top center">
                                                    <i class="write icon"></i>
                                                </button>
                                            </div>
                                            <div class="ui icon buttons tiny">
                                                <button class="ui button basic green tiny navs_popup" data-content="Confirm" data-position="top center">
                                                    <i class="check icon"></i>
                                                </button>
                                                <button class="ui button basic red tiny navs_popup" data-content="Deny" data-position="top center">
                                                    <i class="close icon"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- end template -->
                                    <!-- agenda template -->
                                    <tr>
                                        <td>
                                            <a href="#">
                                                Nav Night
                                            </a>
                                        </td>
                                        <td>Aug 14th</td>
                                        <td>Lead Guitar, Vocals</td>
                                        <td>
                                            <div class="ui icon buttons tiny">
                                                <button class="ui button basic blue tiny navs_popup" data-content="View" data-position="top center">
                                                    <i class="unhide icon"></i>
                                                </button>
                                                <button class="ui button basic blue tiny navs_popup" data-content="Edit (admin)" data-position="top center">
                                                    <i class="write icon"></i>
                                                </button>
                                            </div>
                                            <div class="ui icon buttons tiny">
                                                <button class="ui button basic green tiny navs_popup" data-content="Confirm" data-position="top center">
                                                    <i class="check icon"></i>
                                                </button>
                                                <button class="ui button basic red tiny navs_popup" data-content="Deny" data-position="top center">
                                                    <i class="close icon"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- end template -->
                                <tfoot>
                                    <tr><th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- spacer -->
        <div style="width: 100%; height: 30px; display: block;"></div>
    </body>
</html>
