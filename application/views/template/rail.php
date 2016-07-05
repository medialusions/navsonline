<!-- left rail -->
<div class="ui left close rail">
    <div class="ui segment">
        <h4 class="ui horizontal divider header">
            <i class="small unordered list icon"></i>
            Upcoming
        </h4>
        <!-- agenda container -->
        <script type="text/javascript">
            $(document).ready(function() {
<?php
foreach ($rail['upcoming_events'] as $event):
    ?>
                    $('#event_confirm_<?= $event['id'] ?>')
                            .api({
                                action: 'event confirm',
                                beforeSend: function(settings) {
                                    $("#event_dimmer_<?= $event['id'] ?>").addClass('active');
                                    return settings;
                                },
                                onComplete: function(response) {
                                    $("#event_dimmer_<?= $event['id'] ?>").removeClass('active');
                                    if (response.success) {
                                        $("#event_confirm_<?= $event['id'] ?>").removeClass('grey');
                                        $("#event_confirm_<?= $event['id'] ?>").addClass('green');
                                        //set other as grey
                                        $("#event_deny_<?= $event['id'] ?>").removeClass('red');
                                        $("#event_deny_<?= $event['id'] ?>").addClass('grey');
                                    }
                                }
                            });
                    $('#event_deny_<?= $event['id'] ?>')
                            .api({
                                action: 'event deny',
                                beforeSend: function(settings) {
                                    $("#event_dimmer_<?= $event['id'] ?>").addClass('active');
                                    return settings;
                                },
                                onComplete: function(response) {
                                    $("#event_dimmer_<?= $event['id'] ?>").removeClass('active');
                                    if (response.success) {
                                        //set current as red
                                        $("#event_deny_<?= $event['id'] ?>").removeClass('grey');
                                        $("#event_deny_<?= $event['id'] ?>").addClass('red');
                                        //set other as grey
                                        $("#event_confirm_<?= $event['id'] ?>").removeClass('green');
                                        $("#event_confirm_<?= $event['id'] ?>").addClass('grey');
                                    }
                                }
                            });
<?php endforeach; ?>
            });
        </script>
        <?php
        $i = count($rail['upcoming_events']);
        foreach ($rail['upcoming_events'] as $event):
            ?>
            <!-- agenda event -->
            <div class="ui grid">
                <div class="ui inverted dimmer" id="event_dimmer_<?= $event['id'] ?>">
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
                    <button id="event_confirm_<?= $event['id'] ?>" class="ui left attached icon basic button tiny navs_popup <?= matrix_decode($event['users_matrix'], $auth_user_id, 'confirmed') == true ? 'green' : 'grey' ?>" data-eid="<?= $event['id'] ?>" data-uid="<?= $auth_user_id ?>" data-content="Confirm" data-position="top center" >
                        <i class="check icon"></i>
                    </button>
                    <button id="event_deny_<?= $event['id'] ?>" class="ui right attached icon basic button tiny navs_popup <?= matrix_decode($event['users_matrix'], $auth_user_id, 'confirmed') == true ? 'grey' : 'red' ?>" data-eid="<?= $event['id'] ?>" data-uid="<?= $auth_user_id ?>" data-content="Deny" data-position="top center">
                        <i class="close icon"></i>
                    </button>
                </div>
            </div>
            <?= !( --$i) ? '' : '<div class="ui divider"></div>' //last item check ?>
        <?php endforeach; ?>
        <?php if (count($rail['upcoming_events']) == 0): ?>
            <div class="ui message">Move along, nothing to see here.</div>
        <?php endif; ?>
    </div>
    <!-- contact container -->
    <div class="ui segment">
        <h4 class="ui horizontal divider header">
            <i class="small user icon"></i>
            Contact
        </h4>
        <?php
        $i = count($rail['contact']);
        foreach ($rail['contact'] as $contact):
            ?>
            <!-- contact -->
            <div class="ui grid">
                <div class="ten wide column">
                    <a href="<?= base_url('user/view/' . $contact['user_id']) ?>">
                        <?= $contact['first_name'] . ' ' . $contact['last_name'] ?>
                    </a>
                </div>
                <div class="six wide column">
                    <button class="ui left attached icon basic button tiny navs_popup" data-content="<?= $contact['email'] ?>" data-position="top center">
                        <i class="mail icon"></i>
                    </button>
                    <button class="ui right attached icon basic button tiny navs_popup" data-content="<?= format_phone($contact['phone']) ?>" data-position="top center">
                        <i class="phone icon"></i>
                    </button>
                </div>
            </div>
            <?= !( --$i) ? '' : '<div class="ui divider"></div>' //last item check ?>
        <?php endforeach; ?>
        <?php if (count($rail['contact']) == 0): ?>
            <div class="ui error message">These aren't the droids you're looking for.</div>
        <?php endif; ?>
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
                <button class="ui icon basic red button tiny navs_popup" data-content="Remove" data-position="top center">
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
                <button class="ui icon basic red button tiny navs_popup" data-content="Remove" data-position="top center">
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