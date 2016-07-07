<script>
    var blockout_index = 0;
    function add_blockout(data) {
        //break up data
        var arr = data.split('&');
        var data = {};
        $.each(arr, function(key, value) {
            var val_arr = value.split('=');
            if (val_arr[0] === 'db' || val_arr[0] === 'uid' || val_arr[0] === 'de' || val_arr[0] === 'reason')
                data[val_arr[0] + ''] = val_arr[1] + '';
        });
        var formatted_data = data;
        //format the data
        formatted_data.reason = unescape(formatted_data.reason);
        //db
        formatted_data.db = Date.parse(unescape(formatted_data.db));
        var db_obj = new Date(formatted_data.db);
        formatted_data.db_string = $.format.date(db_obj.getUTCFullYear() + '-' + (parseInt(db_obj.getUTCMonth()) + 1) + '-' + db_obj.getUTCDate() + ' 00:00:00.000', "MMM D");
        //de
        formatted_data.de = Date.parse(unescape(formatted_data.de));
        var de_obj = new Date(formatted_data.de);
        formatted_data.de_string = $.format.date(de_obj.getUTCFullYear() + '-' + (parseInt(de_obj.getUTCMonth()) + 1) + '-' + de_obj.getUTCDate() + ' 00:00:00.000', "MMM D");

        //create object
        var htmlObj = [
            ($(".blockout_date_object").length ? '<div class="ui divider blockout_date_object_js' + blockout_index + '"></div>' : ''),
            '<div class="ui grid blockout_date_object blockout_date_object_js' + blockout_index + '">',
            '<div class="ui inverted dimmer" id="blockout_dimmer_js' + blockout_index + '"><div class="ui small loader"></div></div>',
            '<div class="twelve wide column"><h5 class="header">' + formatted_data.db_string + '-' + formatted_data.de_string + '</h5>' + formatted_data.reason + '</div>',
            '<div class="four wide column"><button class="ui icon basic grey button tiny navs_popup disabled" id="blockout_delete_js' + blockout_index + '">',
            '<i class="trash icon"></i>',
            '</button></div></div>'
        ];
        htmlObj = $(htmlObj.join(''));

        //insert before button
        $(htmlObj).insertBefore("#blockout_new_button");

        blockout_index++;
        return true;
    }

    $(document).ready(function() {
        $('.ui.blockout_new_modal')
                .modal('attach events', '#blockout_new_modal', 'show');
        $('#blockout_add_button').click(function() {
            $('#blockout_add_form').api({
                action: 'blockout add',
                serializeForm: true,
                on: 'now',
                beforeSend: function(settings) {
                    //validate and exit if invalid
                    if (!$('#blockout_add_form')
                            .form({fields: {db: 'empty', de: 'empty', reason: 'empty'}})
                            .form('is valid')) {
                        $('#blockout_add_form').form('validate form');
                        return false;
                    }
                    //success
                    if (add_blockout(settings.data)) {
                        $('.ui.blockout_new_modal').modal('hide');
                        $("#blockout_empty_message").remove();
                        return settings;
                    } else {
                        $('#blockout_add_form').form('add errors', 'There was an error creating the blockout. Reloading the page.');
                        location.reload();
                        return false;
                    }
                }
            });
        });
        $('#blockout_period_start').periodpicker({
            end: '#blockout_period_end',
            dayOfWeekStart: 7,
            cells: [1,2],
            formatDate: 'MM/DD/YYYY',
            minDate: '<?= date('m/d/Y') ?>',
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