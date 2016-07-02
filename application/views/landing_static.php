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

                <!-- left rail -->
                <div class="ui left close rail">
                    <!-- calendar container -->
                    <div class="ui segment">
                        <h4 class="ui horizontal divider header">
                            <i class="small calendar icon"></i>
                            Calendar
                        </h4>
                        <div id="calendar"></div>
                    </div>
                    <!-- agenda container -->
                    <div class="ui segment">
                        <h4 class="ui horizontal divider header">
                            <i class="small unordered list icon"></i>
                            Upcoming
                        </h4>
                        <!-- agenda event -->
                        <div class="ui grid">
                            <div class="ten wide column">
                                <h5 class="header">
                                    Nav Night
                                </h5>
                                Aug 14th
                            </div>
                            <div class="six wide column">
                                <button class="ui left attached icon basic green button tiny">
                                    <i class="check icon"></i>
                                </button>
                                <button class="ui right attached icon basic red button tiny">
                                    <i class="close icon"></i>
                                </button>
                            </div>
                        </div>
                        <!-- divider -->
                        <div class="ui divider"></div>
                        <!-- agenda event -->
                        <div class="ui grid">
                            <div class="ten wide column">
                                <h5 class="header">
                                    Nav Night
                                </h5>
                                Aug 14th
                            </div>
                            <div class="six wide column">
                                <button class="ui left attached icon basic green button tiny">
                                    <i class="check icon"></i>
                                </button>
                                <button class="ui right attached icon basic grey button tiny">
                                    <i class="close icon"></i>
                                </button>
                            </div>
                        </div>
                        <!-- divider -->
                        <div class="ui divider"></div>
                        <!-- agenda event -->
                        <div class="ui grid">
                            <div class="ten wide column">
                                <h5 class="header">
                                    Nav Night
                                </h5>
                                Aug 14th
                            </div>
                            <div class="six wide column">
                                <button class="ui left attached icon basic grey button tiny">
                                    <i class="check icon"></i>
                                </button>
                                <button class="ui right attached icon basic red button tiny">
                                    <i class="close icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- contact container -->
                    <div class="ui segment">
                        <h4 class="ui horizontal divider header">
                            <i class="small user icon"></i>
                            Contact
                        </h4>
                        <!-- contact -->
                        <div class="ui grid">
                            <div class="twelve wide column">
                                Collin Stover
                            </div>
                            <div class="four wide column">
                                <i class="mail icon"></i>
                                <i class="phone icon"></i>
                            </div>
                        </div>
                        <!-- divider -->
                        <div class="ui divider"></div>
                        <!-- contact -->
                        <div class="ui grid">
                            <div class="twelve wide column">
                                Zach Smith
                            </div>
                            <div class="four wide column">
                                <i class="mail icon"></i>
                                <i class="phone icon"></i>
                            </div>
                        </div>
                    </div>
                    <!-- blockout container -->
                    <div class="ui segment">
                        <h4 class="ui horizontal divider header">
                            <i class="small close icon"></i>
                            Blockout Dates
                        </h4>
                        <!-- blockout event -->
                        <div class="ui grid">
                            <div class="twelve wide column">
                                <h5 class="header">
                                    May 12th-May 14th
                                </h5>
                                Missing 0 events
                            </div>
                            <div class="four wide column">
                                <button class="ui icon basic red button tiny">
                                    <i class="trash icon"></i>
                                </button>
                            </div>
                        </div>
                        <!-- divider -->
                        <div class="ui divider"></div>
                        <!-- blockout event -->
                        <div class="ui grid">
                            <div class="twelve wide column">
                                <h5 class="header">
                                    Aug 12th-Aug 20th
                                </h5>
                                Missing 1 event
                            </div>
                            <div class="four wide column">
                                <button class="ui icon basic red button tiny">
                                    <i class="trash icon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="ui centered grid">
                            <div class="column">
                                <button class="ui button dark red basic">
                                    <i class="add square icon"></i>
                                    Add blockout date
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- main content -->
                <div id="main_content">
                    <div class="column">
                        Content
                    </div>
                </div>
            </div>
        </div>

        <!-- spacer -->
        <div style="width: 100%; height: 30px; display: block;"></div>
    </body>
</html>
