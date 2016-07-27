<?php $this->load->view('template/header'); ?>

<script type="text/javascript">
    $(document).ready(function() {

<?php foreach ($upcoming_events as $event): ?>
    <?php if (matrix_decode($event['users_matrix'], $auth_user_id)): ?>
                $('.event_confirm_<?= $event['id'] ?>')
                        .api({
                            action: 'event confirm',
                            beforeSend: function(settings) {
                                $(".event_dimmer_<?= $event['id'] ?>").addClass('active');
                                return settings;
                            },
                            onComplete: function(response) {
                                $(".event_dimmer_<?= $event['id'] ?>").removeClass('active');
                                if (response.success) {
                                    $(".event_confirm_<?= $event['id'] ?>").removeClass('grey');
                                    $(".event_confirm_<?= $event['id'] ?>").addClass('green');
                                    //set other as grey
                                    $(".event_deny_<?= $event['id'] ?>").removeClass('red');
                                    $(".event_deny_<?= $event['id'] ?>").addClass('grey');
                                }
                            }
                        });
                $('.event_deny_<?= $event['id'] ?>')
                        .api({
                            action: 'event deny',
                            beforeSend: function(settings) {
                                $(".event_dimmer_<?= $event['id'] ?>").addClass('active');
                                return settings;
                            },
                            onComplete: function(response) {
                                $(".event_dimmer_<?= $event['id'] ?>").removeClass('active');
                                if (response.success) {
                                    //set current as red
                                    $(".event_deny_<?= $event['id'] ?>").removeClass('grey');
                                    $(".event_deny_<?= $event['id'] ?>").addClass('red');
                                    //set other as grey
                                    $(".event_confirm_<?= $event['id'] ?>").removeClass('green');
                                    $(".event_confirm_<?= $event['id'] ?>").addClass('grey');
                                }
                            }
                        });
    <?php endif; ?>
<?php endforeach; ?>
    });</script>

<!-- content -->
<div id="main_content" class="ui stackable grid">

    <!-- main content -->
    <div class="ui twelve wide column">

        <div class="ui segment">
            <!-- welcome message -->
            <div class="ui grid">
                <div class="twelve wide column">
                    <h1 class="ui header">
                        Welcome, <?= $user['first_name'] . ' ' . $user['last_name'] ?>
                        <div class="sub header">Here is the upcoming schedule</div>
                    </h1>
                </div>
                <div class="four wide column">
                    <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                        <button class="ui button green basic tiny" id="event_new_modal">
                            <i class="add square icon"></i>
                            Add new event
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
                            <th class="">Title</th>
                            <th class="">Date</th>
                            <th class="">Time</th>
                            <th class="">Your Role(s)</th>
                            <th class="">Availability</th>
                            <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                                <th class="">Delete</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($upcoming_events as $event):
                            ?>
                            <!-- agenda template -->
                            <tr>
                                <td>
                                    <a href="<?= base_url('event/view/' . $event['id']); ?>">
                                        <?= $event['name'] ?>
                                    </a>
                                </td>
                                <td><?= date('M jS', $event['date']) ?></td>
                                <td><?= date('g:ia', $event['date']) ?></td>
                                <td><?= list_roles($event['roles_matrix'], $auth_user_id) ?></td>
                                <td>
                                    <?php if (matrix_decode($event['users_matrix'], $auth_user_id)): ?>
                                        <div class="ui inverted dimmer event_dimmer_<?= $event['id'] ?>">
                                            <div class="ui small loader"></div>
                                        </div>
                                        <div class="ui icon buttons tiny">
                                            <button class="event_confirm_<?= $event['id'] ?> ui basic button tiny navs_popup <?= matrix_decode($event['users_matrix'], $auth_user_id, 'confirmed') == true ? 'green' : 'grey' ?>" data-eid="<?= $event['id'] ?>" data-uid="<?= $auth_user_id ?>" data-content="Confirm" data-position="top center" >
                                                <i class="check icon"></i>
                                            </button>
                                            <button class="event_deny_<?= $event['id'] ?> ui basic button tiny navs_popup <?= matrix_decode($event['users_matrix'], $auth_user_id, 'confirmed') == true ? 'grey' : 'red' ?>" data-eid="<?= $event['id'] ?>" data-uid="<?= $auth_user_id ?>" data-content="Deny" data-position="top center">
                                                <i class="close icon"></i>
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                                    <td>
                                        <button class="ui icon basic red button tiny navs_popup confirm_api" data-action="event delete" data-eid="<?= $event['id'] ?>" data-content="Remove" data-position="top center">
                                            <i class="trash icon"></i>
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        <?php
                        //empty
                        if (count($upcoming_events) == 0):
                            ?>
                            <tr>
                                <td colspan="<?= $auth_level >= 9 ? 6 : 5 ?>">
                                    <div class="ui message">
                                        There are no upcoming events scheduled for you. if you want, you can view all of the upcoming events by clicking <?= anchor('user/schedule/?v=all', 'here') ?>.
                                    </div>
                                </td>
                            </tr>
                            <?php
                        endif;
                        ?>
                    <tfoot>
                        <tr><th colspan="<?= $auth_level >= 9 ? 6 : 5 ?>">
                    <div class="ui right floated pagination menu">

                        <?php if ($pagination['prev'] != ''): ?>
                            <a class="icon item" href="<?= base_url('user/schedule/' . $pagination['prev']) ?>">
                                <i class="left chevron icon"></i>
                            </a>
                        <?php endif; ?>
                        <?php foreach ($pagination['pages'] as $page): ?>
                            <a class="item <?= $page == $pagination['current'] ? 'active' : '' ?>" href="<?= base_url('user/schedule/' . $page) ?>"><?= $page ?></a>
                        <?php endforeach; ?>
                        <?php if ($pagination['next'] != ''): ?>
                            <a class="icon item" href="<?= base_url('user/schedule/' . $pagination['next']) ?>">
                                <i class="right chevron icon"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                    </th>
                    </tr></tfoot>
                </table>
            </div>
        </div>
    </div>

    <?php $this->load->view('template/sidebar'); ?>
</div>


<?php
if ($auth_level >= 9):
    $this->load->view('modal/event_new');
endif;

$this->load->view('template/footer');
