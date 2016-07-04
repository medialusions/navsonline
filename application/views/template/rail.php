<!-- left rail -->
<div class="ui left close rail">
    <!-- calendar container -->
    <!-- 
    <div class="ui segment">
        <h4 class="ui horizontal divider header">
            <i class="small calendar icon"></i>
            Calendar
        </h4>
        <div id="calendar"></div>
    </div>
    -->
    <!-- agenda container -->
    <div class="ui segment">
        <h4 class="ui horizontal divider header">
            <i class="small unordered list icon"></i>
            Upcoming
        </h4>
        <?php
        $i = count($upcoming_events);
        foreach ($upcoming_events as $event):
            ?>
            <!-- agenda event -->
            <div class="ui grid">
                <div class="ten wide column">
                    <a href="<?= base_url('event/view/' . $event['id']); ?>">
                        <h5 class="header">
                            <?= $event['name'] ?>
                        </h5>
                    </a>
                    <?= date('M jS', $event['date']) ?>
                </div>
                <div class="six wide column">
                    <button class="ui left attached icon basic button tiny navs_popup <?= matrix_decode($event['users_matrix'], $auth_user_id . '', 'confirmed') == true ? 'green' : 'grey' ?>" data-content="Confirm" data-position="top center">
                        <i class="check icon"></i>
                    </button>
                    <button class="ui right attached icon basic button tiny navs_popup <?= matrix_decode($event['users_matrix'], $auth_user_id . '', 'confirmed') == true ? 'grey' : 'red' ?>" data-content="Deny" data-position="top center">
                        <i class="close icon"></i>
                    </button>
                </div>
            </div>
            <?= !(--$i) ? '' : '<div class="ui divider"></div>' ?>
        <?php endforeach; ?>
    </div>
    <!-- contact container -->
    <div class="ui segment">
        <h4 class="ui horizontal divider header">
            <i class="small user icon"></i>
            Contact
        </h4>
        <!-- contact -->
        <div class="ui grid">
            <div class="ten wide column">
                <a href="#">
                    Collin Stover
                </a>
            </div>
            <div class="six wide column">
                <button class="ui left attached icon basic button tiny navs_popup" data-content="cstover@example.com" data-position="top center">
                    <i class="mail icon"></i>
                </button>
                <button class="ui right attached icon basic button tiny navs_popup" data-content="(303) 549-0491" data-position="top center">
                    <i class="phone icon"></i>
                </button>
            </div>
        </div>
        <!-- divider -->
        <div class="ui divider"></div>
        <!-- contact -->
        <div class="ui grid">
            <div class="ten wide column">
                <a href="#">
                    Zach Smith
                </a>
            </div>
            <div class="six wide column">
                <button class="ui left attached icon basic button tiny navs_popup" data-content="zsmith@example.com" data-position="top center">
                    <i class="mail icon"></i>
                </button>
                <button class="ui right attached icon basic button tiny navs_popup" data-content="(303) 549-0491" data-position="top center">
                    <i class="phone icon"></i>
                </button>
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