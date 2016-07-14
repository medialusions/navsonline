<?php $this->load->view('template/header'); ?>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
<style>
    .media_new_modal {
        z-index: 1100 !important;
    }
</style>

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
                            <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                                <th class="">Delete</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($arrangements as $arrangement): ?>
                            <tr>
                                <td>
                                    <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                                        <a href="javascript:void(0)" class="arrangement_edit_modal_button"><?= $arrangement['artist'] ?></a>
                                        <div class="hidden" style="display: none;"><?= json_encode($arrangement) ?></div>
                                    <?php else: ?>
                                        <?= $arrangement['artist'] ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= $arrangement['default_key'] ?></td>
                                <td><?= $arrangement['bpm'] ?> bpm</td>
                                <td><?= ($arrangement['length'] - ($arrangement['length'] % 60)) / 60 ?> min <?= $arrangement['length'] % 60 ?> sec</td>
                                <td>
                                    <?php if ($arrangement['video'] != ''): ?>
                                        <a class="ui icon mini button basic red navs_popup" target="_blank" href="<?= $arrangement['video'] ?>" data-content="Video" data-position="top center">
                                            <i class="play icon"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (isset($arrangement['audio']['link'])): ?>
                                        <a class="ui icon mini button basic teal navs_popup" target="_blank" href="<?= base_url() . $arrangement['audio']['link'] ?>" data-content="Audio File" data-position="top center">
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
                                        <a class="ui mini button basic grey navs_popup" target="_blank" href="<?= base_url() . $song_key['media']['link'] ?>" data-content="Chord Chart (<?= $song_key['key'] ?>)" data-position="top center"> 
                                            <?= $song_key['key'] ?>
                                        </a>
                                    <?php endforeach; ?>
                                </td>
                                <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                                    <td>
                                        <a class="ui icon basic red button tiny navs_popup" href="<?= base_url('music/delete-arrangement/' . $arrangement['id']) ?>" data-content="Remove" data-position="top center">
                                            <i class="trash icon"></i>
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <tfoot>
                        <tr><th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                                <th></th>
                            <?php endif; ?>
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
    $this->load->view('modal/media_add');
    $this->load->view('modal/arrangement_add');
    $this->load->view('modal/arrangement_edit');
endif;

$this->load->view('template/footer');
