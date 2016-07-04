<script>
    $(document).ready(function() {
        $('.ui.event_new_modal')
                .modal({
                    blurring: false
                })
                .modal('attach events', '#event_new_modal', 'show')
                ;

        $('#event_new_date').periodpicker({
            dayOfWeekStart: 7,
            formatDate: 'MM/DD/YYYY',
            norange: true, // use only one valuecells: [1, 1],
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
            seconds: false,
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
        <?= form_open('event/add', ['class' => 'ui large form']) ?>
        <div class="field">
            <label>Event Name</label>
            <input type="text" name="event-name" placeholder="Event Name">
        </div>
        <div class="field">
            <label>Date and Time</label>
            <div class="two fields">
                <div class="field">
                    <input type="text" name="datetime" id="event_new_date" placeholder="Select Date">
                </div>
                <div class="field">
                    <input type="text" name="datetime" id="event_new_time" placeholder="Select Time">
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button ok">Submit</div>
    </div>
</div>