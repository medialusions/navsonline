<script>
    $(document).ready(function() {
        $('.ui.event_new_modal')
                .modal({
                    blurring: false
                })
                .modal('attach events', '#event_new_modal', 'show')
                ;

        $('#event_new_modal_form')
                .form({
                    fields: {
                        event_date: 'empty',
                        event_time: 'empty',
                        event_name: 'empty'
                    }
                })
                ;

        $('#event_new_modal_form_submit').click(function() {
            $('#event_new_modal_form').submit();
            if ($('#event_new_modal_form').form('is valid'))
                $('.ui.event_new_modal').model('hide');
        });

        $('#event_new_date').periodpicker({
            dayOfWeekStart: 7,
            formatDate: 'MM/DD/YYYY',
            norange: true,
            cells: [1,1],
            withoutBottomPanel: true,
            yearsLine: false,
            title: false,
            closeButton: false,
            fullsizeButton: false,
            hideOnBlur: true,
            likeXDSoftDateTimePicker: true
        });
        $('#event_new_time').timepickeralone({
            twelveHoursFormat: true,
            seconds: true,
            defaultTime: ''
        });
    });
</script>
<div class="ui event_new_modal modal">
    <i class="close icon"></i>
    <div class="header">
        New Event
    </div>
    <div class="content">
        <?= form_open('event/add', ['class' => 'ui large form', 'id' => 'event_new_modal_form']) ?>
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
        <div class="ui button blue" id="event_new_modal_form_submit">Submit</div>
    </div>
</div>