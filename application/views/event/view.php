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
                            <th class="">Name</th>
                            <th class="">Attachments</th>
                            <?php if ($auth_level >= 9): //admin required.   ?>
                                <th class="">Delete</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td>
                                    <?php if ($auth_level >= 9): //admin required.   ?>
                                        <a href="javascript:void(0)" class="e_item_edit_modal_button" class="ui header"><?= $item['name'] ?></a>
                                        <div class="hidden" style="display: none;"><?= json_encode($item) ?></div>
                                    <?php else: ?>
                                        <div class="ui header"><?= $item['name'] ?></div>
                                    <?php endif; ?>
                                    <em><?= $item['memo'] ?></em>
                                </td>
                                <td>TO FILL IN</td>
                                <?php if ($auth_level >= 9): //admin required.   ?>
                                    <td>
                                        <a class="ui icon basic red button tiny navs_popup confirm_api" data-action="event item delete" data-aid="<?= $item['id'] ?>" data-content="Remove" data-position="top center">
                                            <i class="trash icon"></i>
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <tfoot>
                        <tr><th></th>
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
    $this->load->view('modal/media_add');
endif;

$this->load->view('template/footer');
