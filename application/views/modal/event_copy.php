<script>
    $(document).ready(function() {
        $('.ui.event_copy_modal')
                .modal({
                    blurring: false
                });

        $('.event_copy_modal_button').click(function() {
            var eid = $(this).attr('data-eid');
            $("#event_copy_modal_form input[name='eid']").val(eid);
            $('.ui.event_copy_modal').modal('show');
        });

        $('#event_copy_modal_form')
                .form({
                    fields: {
                        event_date: 'empty',
                        event_time: 'empty',
                        event_name: 'empty'
                    }
                })
                ;

        $('#event_copy_modal_form_submit').click(function() {
            $('#event_copy_modal_form').submit();
            if ($('#event_copy_modal_form').form('is valid'))
                $('.ui.event_new_modal').model('hide');
        });

        $('#event_copy_date').periodpicker({
            dayOfWeekStart: 7,
            norange: true,
            cells: [1, 1],
            withoutBottomPanel: true,
            yearsLine: false,
            title: false,
            closeButton: false,
            fullsizeButton: false,
            hideOnBlur: true,
            likeXDSoftDateTimePicker: true
        });
        $('#event_copy_time').timepickeralone({
            twelveHoursFormat: true,
            seconds: false,
            defaultTime: '19:00'
        });
    });
</script>
<div class="ui small event_copy_modal modal">
    <i class="close icon"></i>
    <div class="header">
        Copy Event 
    </div>
    <div class="content">
        <?= form_open('event/copy', ['class' => 'ui large form', 'id' => 'event_copy_modal_form']) ?>
        <div class="ui error message"></div>
        <input type="hidden" name="eid">
        <div class="field">
            <label>New Name</label>
            <input type="text" name="event_name" placeholder="Name">
        </div>
        <div class="field">
            <label>Date and Time</label>
            <div class="two fields">
                <div class="field">
                    <input type="text" name="event_date" id="event_copy_date" placeholder="Date">
                </div>
                <div class="field">
                    <input type="text" name="event_time" id="event_copy_time" placeholder="Time">
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button blue" id="event_copy_modal_form_submit">Submit</div>
    </div>
</div>