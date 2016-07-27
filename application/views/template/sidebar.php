<!-- right sidebar -->
<div class="ui four wide column">
    <div class="ui segment">
        <h4 class="ui horizontal divider header">
            <i class="small university icon"></i>
            Your Campus
        </h4>
        <div class="ui list">
            <div class="item">
                <div class="header">Name</div>
                <?= $_SESSION['organization_data']['name'] ?>
            </div>
            <div class="item">
                <div class="header">Location</div>
                <?= $_SESSION['organization_data']['location'] ?>
            </div>
            <div class="item">
                <div class="header">Timezone</div>
                <?= $_SESSION['organization_data']['timezone'] ?>
            </div>
        </div>
    </div>
    <div class="ui segment">
        <h4 class="ui horizontal divider header">
            <i class="small unordered list icon"></i>
            Upcoming
        </h4>
        <!-- agenda container -->
        <?php
        // useful for displaying the js when not in the schedule page
        if (uri_string() != '' || uri_string() != 'user/schedule'):
            ?>
            <script type="text/javascript">
                $(document).ready(function() {
    <?php
    foreach ($sidebar['upcoming_events'] as $event):
        ?>
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
    <?php endforeach; ?>
                });</script>
        <?php endif; ?>
        <?php
        $i = count($sidebar['upcoming_events']);
        foreach ($sidebar['upcoming_events'] as $event):
            ?>
            <!-- agenda event -->
            <div class="ui grid">
                <div class="ui inverted dimmer event_dimmer_<?= $event['id'] ?>">
                    <div class="ui small loader"></div>
                </div>
                <div class="ten wide column">
                    <a href="<?= base_url('event/view/' . $event['id']); ?>">
                        <h5 class="header">
                            <?= $event['name'] ?>
                        </h5>
                    </a>
                    <?= date('M jS', $event['date']) ?>
                </div>
                <div class="six wide column">
                    <div class="ui icon buttons tiny">
                        <button class="event_confirm_<?= $event['id'] ?> ui basic button tiny navs_popup <?= matrix_decode($event['users_matrix'], $auth_user_id, 'confirmed') == true ? 'green' : 'grey' ?>" data-eid="<?= $event['id'] ?>" data-uid="<?= $auth_user_id ?>" data-content="Confirm" data-position="top center" >
                            <i class="check icon"></i>
                        </button>
                        <button class="event_deny_<?= $event['id'] ?> ui basic button tiny navs_popup <?= matrix_decode($event['users_matrix'], $auth_user_id, 'confirmed') == true ? 'grey' : 'red' ?>" data-eid="<?= $event['id'] ?>" data-uid="<?= $auth_user_id ?>" data-content="Deny" data-position="top center">
                            <i class="close icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?= !( --$i) ? '' : '<div class="ui divider"></div>' //last item check ?>
        <?php endforeach; ?>
        <?php if (count($sidebar['upcoming_events']) == 0): ?>
            <div class="ui message">well my schedule is clear... what do I do with all of this free time?</div>
        <?php endif; ?>
    </div>
    <!-- contact container -->
    <div class="ui segment">
        <h4 class="ui horizontal divider header">
            <i class="small user icon"></i>
            Contact
        </h4>
        <?php
        $i = count($sidebar['contact']);
        foreach ($sidebar['contact'] as $contact):
            ?>
            <!-- contact -->
            <div class="ui grid">
                <div class="ten wide column">
                    <a href="<?= base_url('user/view/' . $contact['user_id']) ?>">
                        <?= $contact['first_name'] . ' ' . $contact['last_name'] ?>
                    </a>
                </div>
                <div class="six wide column">
                    <div class="ui icon buttons tiny">
                        <button class="ui basic button tiny navs_popup" data-content="<?= $contact['email'] ?>" data-position="top center">
                            <i class="mail icon"></i>
                        </button>
                        <?php if ($contact['phone']): ?>
                            <button class="ui basic button tiny navs_popup" data-content="<?= format_phone($contact['phone']) ?>" data-position="top center">
                                <i class="phone icon"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?= !( --$i) ? '' : '<div class="ui divider"></div>' //last item check ?>
        <?php endforeach; ?>
        <?php if (count($sidebar['contact']) == 0): ?>
            <div class="ui error message">"help me obi-wan kenobi. you're my only hope!" ~luke</div>
        <?php endif; ?>
    </div>
    <!-- blockout container -->

    <script type="text/javascript">
        $(document).ready(function() {
<?php
$i = count($sidebar['blockout_dates']);
foreach ($sidebar['blockout_dates'] as $blockout):
    ?>
                $('#blockout_delete_<?= $i ?>')
                        .api({
                            action: 'blockout delete',
                            url: '<?= base_url('/ajax/blockout-delete') . '/' . $auth_user_id . '/' . $blockout['start_date'] . '/' . $blockout['date_end'] ?>',
                            beforeSend: function(settings) {
                                $("#blockout_dimmer_<?= $i ?>").addClass('active');
                                return settings;
                            },
                            onComplete: function(response) {
                                $("#blockout_dimmer_<?= $i ?>").removeClass('active');
                                if (response.success) {
                                    $(".blockout_date_object_<?= $i ?>").remove();
                                }
                            }
                        });
    <?php
    --$i;
endforeach;
?>
        });
    </script>
    <div class="ui segment" id="blockout_container">
        <h4 class="ui horizontal divider header">
            <i class="small close icon"></i>
            Blockout Dates
        </h4>
        <?php
        $i = count($sidebar['blockout_dates']);
        foreach ($sidebar['blockout_dates'] as $blockout):
            ?>
            <!-- blockout event -->
            <div class="ui grid blockout_date_object blockout_date_object_<?= $i ?>">
                <div class="ui inverted dimmer" id="blockout_dimmer_<?= $i ?>">
                    <div class="ui small loader"></div>
                </div>
                <div class="twelve wide column">
                    <h5 class="header">
                        <?= $blockout['start_date'] == $blockout['date_end'] ? date('M jS', $blockout['start_date']) : date('M jS', $blockout['start_date']) . '-' . date('M jS', $blockout['date_end']) ?>
                    </h5>
                    <?= $blockout['reason'] ?>
                </div>
                <div class="four wide column">
                    <button class="ui icon basic red button tiny navs_popup" id="blockout_delete_<?= $i ?>" data-content="Remove" data-position="top center">
                        <i class="trash icon"></i>
                    </button>
                </div>
            </div>
            <?= !( --$i) ? '' : '<div class="ui divider blockout_date_object_' . $i . '" ></div>' //last item check ?>
        <?php endforeach; ?>
        <?php if (count($sidebar['blockout_dates']) == 0): ?>
            <div class="ui message" id="blockout_empty_message">"they may take our lives, but they'll never take our freedom!" ~braveheart</div>
        <?php endif; ?>
        <div class="ui centered grid" id="blockout_new_button">
            <div class="column">
                <button class="ui button dark red basic tiny" id="blockout_new_modal">
                    <i class="add square icon"></i>
                    Add blockout date
                </button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('modal/blockout_add'); ?>