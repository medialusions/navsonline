<?php $this->load->view('template/header'); ?>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>

<!-- content -->
<div id="main_content" class="ui stackable grid">

    <!-- main content -->
    <div class="ui sixteen wide column">

        <div class="ui segment">
            <!-- welcome message -->
            <div class="ui grid">
                <div class="twelve wide column">
                    <h1 class="ui header">
                        <?= $song['title'] ?>
                        <div class="sub header">Tags: <?= implode(', ', json_decode($song['tags'], TRUE)) ?></div>
                    </h1>
                </div>
                <div class="four wide column">
                    <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                        <button class="ui button green basic tiny" id="arrangement_new_modal">
                            <i class="add square icon"></i>
                            Add arrangement
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- spacer -->
            <div style="width: 100%; height: 30px; display: block;"></div>

            <div class="ui grid">
                <!-- agenda table -->
                <table class="ui very basic table">
                    <thead>
                        <tr>
                            <th class="">Arrangement</th>
                            <th class="">Default Key</th>
                            <th class="">BPM</th>
                            <th class="">Length</th>
                            <th class="">Links</th>
                            <th class="">Keys</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($arrangements as $arrangement): ?>
                            <tr>
                                <td><?= $arrangement['artist'] ?></td>
                                <td><?= $arrangement['default_key'] ?></td>
                                <td><?= $arrangement['bpm'] ?> bpm</td>
                                <td><?= $arrangement['length'] ?> sec</td>
                                <td>
                                    <?php if ($arrangement['video'] != ''): ?>
                                        <a class="ui icon mini button basic red navs_popup" target="_blank" href="<?= $arrangement['video'] ?>" data-content="Video" data-position="top center">
                                            <i class="play icon"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (isset($arrangement['audio']['link'])): ?>
                                        <a class="ui icon mini button basic teal navs_popup" target="_blank" href="<?= $arrangement['video'] ?>" data-content="Audio File" data-position="top center">
                                            <i class="volume up icon"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (isset($arrangement['lyrics']['link'])): ?>
                                        <a class="ui icon mini button basic grey navs_popup" target="_blank" href="<?= base_url() . $arrangement['lyrics']['link'] ?>" data-content="Lyrics" data-position="top center"> 
                                            <i class="align left icon"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php foreach ($arrangement['song_keys'] as $song_key): ?>
                                        <a class="ui mini button basic grey navs_popup" target="_blank" href="<?= base_url() . $song_key['media']['link'] ?>" data-content="Chord Chart" data-position="top center"> 
                                            <?= $song_key['key'] ?>
                                        </a>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <tfoot>
                        <tr><th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <?php //$this->load->view('template/sidebar'); ?>
</div>


<?php
if ($auth_level >= 9):
    $this->load->view('modal/arrangement_add');
    $this->load->view('modal/media_add');
endif;

$this->load->view('template/footer');
