<?php $this->load->view('template/header'); ?>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
<style>

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
                        <?= $title ?>
                    </h1>
                </div>
                <div class="four wide column">
                    <?php if ($auth_level >= 9): //admin required.   ?>
                        <button class="ui button green basic tiny" id="e_item_new_modal">
                            <i class="add square icon"></i>
                            Add item
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
                            <th class="">Time</th>
                            <th class="">Name</th>
                            <th class="">Attachments</th>
                            <?php if ($auth_level >= 9): //admin required.   ?>
                                <th class="">Delete</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <?php if ($item['label']): ?>
                                <tr>
                                    <td>
                                        <div class="ui ribbon <?= $item['start_time'] < $event['date'] && date('d/m/Y', $item['start_time']) != date('d/m/Y', $event['date']) ? 'grey nav_italic' : 'blue' ?> label">
                                            <?= date('l, F jS', $item['start_time']) ?>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <?php if ($auth_level >= 9): //admin required.   ?>
                                        <td></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endif; ?>
                            <tr class="<?= $item['start_time'] < $event['date'] ? 'nav_italic active' : '' ?> ">
                                <!-- time -->
                                <td>
                                    <?= date('g:ia', $item['start_time']) ?>
                                </td>
                                <!-- name -->
                                <td>
                                    <?= $auth_level >= 9 ? '<a href="javascript:void(0)" class="e_item_edit_modal_button" style="font-weight: bold;">' : '<div style="font-weight: bold;">' ?>
                                    <!-- title/song-info -->
                                    <?php if ($item['type'] == 'song'): ?>
                                        <?= $item['song']['title'] . ' - ' . $item['arrangement']['artist'] . ' [' . $item['arrangement_key'] . ']' ?>
                                    <?php else: ?>
                                        <?= $item['title'] ?>
                                    <?php endif; ?>

                                    <?= $auth_level >= 9 ? '</a>' : '</div>' ?>
                                    <?php
                                    if ($auth_level >= 9): //admin required.   
                                        $item['time'] = date('H:i', $item['start_time']);
                                        $item['date'] = date('Y/m/d', $item['start_time']);
                                        ?>
                                        <div class="hidden" style="display: none;"><?= json_encode($item) ?></div>
                                    <?php endif; ?>

                                    <div class="sub header"><?= $item['memo'] ?></div>
                                </td>
                                <!-- attachments -->
                                <td>
                                    <?php if ($item['type'] == 'song'): ?>
                                        <!-- to song page -->
                                        <a class="ui icon mini button teal navs_popup" target="_blank" href="<?= base_url('music/view/' . $item['song']['id']) ?>" data-content="More..." data-position="top center">
                                            <i class="music icon"></i>
                                            <?= $item['song']['title'] ?>
                                        </a>
                                        <?php if ($item['arrangement']['video'] != ''): ?>
                                            <!-- youtube -->
                                            <a class="ui icon mini button basic red navs_popup" target="_blank" href="<?= $item['arrangement']['video'] ?>" data-content="Video" data-position="top center">
                                                <i class="play icon"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (isset($item['arrangement']['audio']['link'])): ?>
                                            <!-- audio file -->
                                            <a class="ui icon mini button basic teal navs_popup" target="_blank" href="<?= base_url() . $item['arrangement']['audio']['link'] ?>" data-content="Audio File" data-position="top center">
                                                <i class="volume up icon"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (isset($item['arrangement']['lyrics']['link'])): ?>
                                            <!-- lyrics -->
                                            <a class="ui icon mini button basic grey navs_popup" target="_blank" href="<?= base_url() . $item['arrangement']['lyrics']['link'] ?>" data-content="Lyrics" data-position="top center"> 
                                                <i class="align left icon"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php foreach ($item['arrangement']['song_keys'] as $song_key): ?>
                                            <!-- chord charts -->
                                            <a class="ui mini button basic grey navs_popup" target="_blank" href="<?= base_url() . $song_key['media']['link'] ?>" data-content="Chord Chart (<?= $song_key['key'] ?>)" data-position="top center"> 
                                                <?= $song_key['key'] ?>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </td>
                                <?php if ($auth_level >= 9): //admin required.    ?>
                                    <!-- delete -->
                                    <td>
                                        <a class="ui icon basic red button tiny navs_popup confirm_api" data-action="event item delete" data-eiid="<?= $item['id'] ?>" data-content="Remove" data-position="top center">
                                            <i class="trash icon"></i>
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <?php if ($auth_level >= 9): //admin required.    ?>
                                <th></th>
                            <?php endif; ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <?php //$this->load->view('template/sidebar');  ?>
</div>


<?php
if ($auth_level >= 9):
    $this->load->view('modal/event_item_add');
    $this->load->view('modal/event_item_edit');
endif;

$this->load->view('template/footer');
