<!DOCTYPE html>
<html>
    <head>
        <title>NavsOnline | Print Event</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='<?= base_url(); ?>js/jquery/dist/jquery.min.js'></script>
        <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>logo/favicon.png"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/semantic/dist/semantic.min.css">
        <script src="<?= base_url(); ?>style/semantic/dist/semantic.min.js"></script>
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
        <style>
            @page{
                size: 8.5in 11in;
            }
            #print_area {
                width: 8.5in;
                height: 11in;
                padding: 20mm;
                margin-left: auto;
                margin-right: auto;
            }
            .ui.table td, .ui.table th{
                padding: 2px !important;
            }
            .script{
                width: 8.5in;
                margin: 5px auto;
            }
            #schedule .card .content{
                padding:2px !important;
            }
            @media print {
                #schedule{
                    page-break-after: always;
                }
                #print_area, body{
                    width: auto;
                    height: auto;
                    padding: 0;
                    border: none;
                    margin: 0;
                }
                .script, .page_break{
                    display: none !important;
                }

            }
        </style>
    </head>
    <body>
        <!-- 
        <fieldset class="script">
            <legend><h3>Include</h3></legend>
            <a href="<?= base_url('event/view/' . $event['id']) ?>">&larr; Back</a>
            <div class="ui list">
                <div class="item">
                    <div class="ui checkbox">
                        <input name="sched" type="checkbox" checked="checked">
                        <label>Schedule</label>
                    </div>
                </div>
                <div class="item">
                    <div class="ui master checkbox">
                        <input name="chords" type="checkbox" checked="checked">
                        <label>Chords</label>
                    </div>
                    <div class="list"> 
                        <div class="item">
                            <div class="ui child checkbox">
                                <input type="checkbox" name="open">
                                <label>Prefer Open Chords?</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ui checkbox">
                        <input name="lyrics" type="checkbox">
                        <label>Lyrics</label>
                    </div>
                </div>
            </div>
        </fieldset>
        -->
        <div id="print_area">
            <div id="schedule">
                <h3 class="ui header">
                    <?= $event['name'] ?>
                    <div class="sub header"><?= date('l, F jS', $event['date']) ?></div>
                </h3>
                <?php
                $seconds_since_midnight = (date('g', $event['date']) * 60 + date('i', $event['date'])) * 60;
                ?>
                <table class="ui small basic table">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($items as $item):
                            if ($item['start_time'] >= ($event['date'] - $seconds_since_midnight)):
                                ?>
                                <tr>
                                    <td><?= date('g:i', $item['start_time']) ?></td>
                                    <td>
                                        <strong><?= ($item['type'] == 'simple' ? $item['title'] : $item['song']['title'] . ' - ' . $item['arrangement']['artist'] . ' [' . $item['arrangement_key'] . ']') ?></strong>
                                        <div><?= $item['memo'] ?></div>
                                    </td>
                                </tr>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <div class="ui five cards">
                    <?php foreach ($people as $person): ?>
                        <div class="card">
                            <div class="content">
                                <div class="header"><?= $person['first_name'] . ' ' . $person['last_name'] ?></div>
                                <div class="meta"><?= implode(', ', $person['roles']) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!--
            <div class="ui horizontal divider page_break">page break</div>
            <div id="chords">
            <?php foreach ($items as $item): ?>
                <?php if ($item['type'] == 'song'): ?>
                    <?php // var_dump($item['arrangement']['song_keys'])   ?>
                    <?php foreach ($item['arrangement']['song_keys'] as $key): ?>
                                                <div class="">
                                                    <embed src="<?= base_url() . '/' . $key['media']['link'] ?>#view=FitH">
                                                    <div class="ui horizontal divider page_break">page break</div>
                                                </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            </div>
            <div id="lyrics">

            </div>
            -->
        </div>
    </body>
</html>