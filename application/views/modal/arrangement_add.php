<script>
    $(document).ready(function() {
        $('.ui.arrangement_new_modal')
                .modal({
                    blurring: false
                })
                .modal('attach events', '#arrangement_new_modal', 'show')
                ;

        $('#arrangement_new_modal_form')
                .form({
                    fields: {
                        event_date: 'empty',
                        event_time: 'empty',
                        event_name: 'empty'
                    }
                })
                ;

        $('#arrangement_new_modal_form_submit').click(function() {
            $('#arrangement_new_modal_form').submit();
            if ($('#arrangement_new_modal_form').form('is valid'))
                $('.ui.arrangement_new_modal').model('hide');
        });
    });
</script>
<div class="ui arrangement_new_modal modal">
    <i class="close icon"></i>
    <div class="header">
        New Event
    </div>
    <div class="content">
        <?= form_open('music/add-arrangement', ['class' => 'ui large form', 'id' => 'arrangement_new_modal_form']) ?>
        <div class="ui error message"></div>
        <div class="field">
            <label>Name</label>
            <input type="text" name="event_name" placeholder="Name">
        </div>
        <div class="field">
            <label>Date and Time</label>
            <div class="two fields">
                <div class="field">
                    <input type="text" name="event_date" id="event_new_date" placeholder="Date">
                </div>
                <div class="field">
                    <input type="text" name="event_time" id="event_new_time" placeholder="Time">
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button blue" id="arrangement_new_modal_form_submit">Submit</div>
    </div>
</div>