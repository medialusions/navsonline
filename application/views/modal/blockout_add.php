<script>
    $(document).ready(function() {
        $('.ui.blockout_new_modal')
                .modal('attach events', '#blockout_new_modal', 'show');

        $('#blockout_add_button').click(function() {
            $('#blockout_add_form').api({
                action: 'blockout add',
                serializeForm: true,
                on: 'now',
                beforeSend: function(settings) {
                    //validate form
                    var valid = $('#blockout_add_form')
                            .form({fields: {db: 'empty', de: 'empty', reason: 'empty'}})
                            .form('is valid');
                    //validate and exit if invalid
                    if (!valid) {
                        $('#blockout_add_form').form('validate form');
                        return false;
                    }
                    //success
                    $('.ui.blockout_new_modal').modal('hide');
                    return settings;
                }

            });

        });

        $('#blockout_period_start').periodpicker({
            end: '#blockout_period_end',
            dayOfWeekStart: 7,
            formatDate: 'MM/DD/YYYY',
            norange: false,
            withoutBottomPanel: true,
            yearsLine: false,
            title: false,
            closeButton: false,
            fullsizeButton: false
        });
    });
</script>
<div class="ui blockout_new_modal modal">
    <i class="close icon"></i>
    <div class="header">
        New Event
    </div>
    <div class="content">
        <?= form_open('ajax/blockout-add', ['class' => 'ui large form', 'id' => 'blockout_add_form']) ?>
        <input type="hidden" name="uid" value="<?= $auth_user_id ?>" >
        <div class="ui error message"></div>
        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label>Date Period</label>
                    <input type="text" name="db" id="blockout_period_start">
                    <input type="text" name="de" id="blockout_period_end">
                </div>
                <div class="field">
                    <label>Reason</label>
                    <input type="text" name="reason" placeholder="Reason">
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button blue" id="blockout_add_button">Submit</div>
    </div>
</div>