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
                                <td>
                                    <?= date('g:ia', $item['start_time']) ?>
                                </td>
                                <td>
                                    <?php if ($auth_level >= 9): //admin required.   ?>
                                        <a href="javascript:void(0)" class="e_item_edit_modal_button" style="font-weight: bold;"><?= $item['title'] ?></a>
                                        <div class="hidden" style="display: none;"><?= json_encode($item) ?></div>
                                    <?php else: ?>
                                        <div style="font-weight: bold;"><?= $item['title'] ?></div>
                                    <?php endif; ?>
                                    <div class="sub header"><?= $item['memo'] ?></div>
                                </td>
                                <td>Blank</td>
                                <?php if ($auth_level >= 9): //admin required.   ?>
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
                            <?php if ($auth_level >= 9): //admin required.   ?>
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
    $this->load->view('modal/event_item_add');
endif;

$this->load->view('template/footer');
