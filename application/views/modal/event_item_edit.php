<script>
    $(document).ready(function() {
        $('.e_item_edit_modal_button').click(function() {
            //fill out form
            var string_data = $(this).next().html();

            var data = JSON.parse(string_data);
            var form = '#e_item_edit_modal_form ';

            $(form + "input[name='eiid']").val(data.id);
            $(form + "input[name='title']").val(data.title.replace("&amp;", "&"));
            $(form + "textarea").val(data.memo.replace("&amp;", "&"));
            $(form + "input[name='eiid']").val(data.id);

            //hide or show checkbox items
            $.each($(form + "input[name='type']"), function(item) {
                var selector = "#e_item_edit_" + $(this).val();
                if ($(this).val() === data.type) {
                    $(this).prop('checked', true);
                    $(selector).show();
                } else {
                    $(this).prop('checked', false);
                    $(selector).hide();
                }
            });

            //arrangement picker
            if (data.type === 'song') {
                $(form + "input[name='arrangement']").val(data.song.title.replace("&amp;", "&"));
                $(form + "input[name='arrangement_search']").val(JSON.stringify(data.arrangement));
                //select parent field for search_key
                var parent = $("#e_item_edit_song .arrangement_search").parent(".field");
                var a_search_key = parent.next(".a_search_key");
                //show the search field
                a_search_key.show();
                var keys = JSON.parse(data.arrangement.song_keys);
                a_search_key.find(".nav.menu").html('');
                //run through the keys and set the dropdown
                $.each(keys, function(key, value) {
                    if (value.key !== 'Open') {
                        var html = '<div class="item" data-value="' + value.key + '">' + value.key + '</div>';
                        a_search_key.find(".nav.menu").append(html);
                    }
                });
                //select the appropriate key
                $(form + "input[name='a_search_key']").parent(".dropdown").dropdown('clear');
                $(form + "input[name='a_search_key']").parent(".dropdown").dropdown('set text', data.arrangement_key);
                $(form + "input[name='a_search_key']").parent(".dropdown").dropdown('set value', data.arrangement_key);
            }

            //update time picker
            //data.time data.date
            $('#event_edit_time').timepickeralone('setValue', data.time);
            $('#event_edit_date').val(data.date);
            $('#event_edit_date').periodpicker('change');

            //show the modal
            $('.ui.e_item_edit_modal').modal('show');
        });

        //date/time pickers
        $('#event_edit_date').periodpicker({
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
        $('#event_edit_time').timepickeralone({
            twelveHoursFormat: true,
            seconds: false,
            defaultTime: '19:00'
        });

        //submit the form
        $('#e_item_edit_modal_form_submit').click(function() {
            //submit the form
            $('#e_item_edit_modal_form').submit();
        });

        //radio hide/show
        $("#e_item_edit_simple").hide(); //init
        $("input[name='type']").change(function() {
            if ($("input[name='type']").is(':checked')) {
                var val = $(this).val();
                //e_item_simple | e_item_song
                var selector = "#e_item_edit_" + val;
                $(".e_item_edit_").hide();
                $(selector).show();
            }
        });
    });
</script>
<div class="ui long modal e_item_edit_modal">
    <i class="close icon"></i>
    <div class="header">
        Editing item for <em><?= $title ?></em>
    </div>
    <div class="ui sub header"><em>The event date is <?= date('l, F jS, g:ia', $event['date']) ?></em></div>
    <div class="content">
        <?= form_open('event/edit-item', ['class' => 'ui large form', 'id' => 'e_item_edit_modal_form']) ?>
        <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
        <input type="hidden" name="eiid" value="">
        <div class="ui error message"></div>
        <div class="ui grid">
            <!-- left most column -->
            <div class="four wide column">
                <!-- Time picker -->
                <div class="field">
                    <label>
                        Beginning Time
                        <div style="font-weight: normal;"><em>For items pre-service, simply select a time/date before the service.</em></div>
                    </label>
                    <input type="text" name="event_edit_date" id="event_edit_date" placeholder="Date">
                    <input type="text" name="event_edit_time" id="event_edit_time" placeholder="Time">
                </div>
            </div>
            <!-- right most column -->
            <div class="twelve wide column">
                <!-- checkbox -->
                <div class="inline fields">
                    <label for="type">Select the item type:</label>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="type" value="song" checked="" tabindex="0" class="hidden">
                            <label>Song</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="type" value="simple" tabindex="0" class="hidden">
                            <label>Message</label>
                        </div>
                    </div>
                </div>
                <!-- Song/Arrangement -->
                <div class="e_item_" id="e_item_edit_song">
                    <h3 class="ui dividing header">Song</h3>
                    <div class="field">
                        <!-- Song Search -->
                        <label>Song Search</label>
                        <div class="ui search arrangement_search">
                            <div class="ui left icon input">
                                <input class="prompt" type="text" name="arrangement" placeholder="Search songs">
                                <i class="music icon"></i>
                            </div>
                        </div>
                        <input name="arrangement_search" type="hidden" value="">
                    </div>
                    <div class="field a_search_key">
                        <div class="ui fluid search normal selection dropdown" >
                            <input type="hidden" name="a_search_key">
                            <i class="dropdown icon"></i>
                            <div class="default text">Arrangement Key</div>
                            <div class="nav menu">
                                <div class="item" data-value="A#">A#</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Simple/Message -->
                <div class="e_item_" id="e_item_edit_simple">
                    <h3 class="ui dividing header">Message</h3>
                    <!-- Title -->
                    <div class="field">
                        <label>Item Title</label>
                        <input name="title" type="text">
                    </div>
                </div>
                <!-- Memo -->
                <div class="field">
                    <label>Memo/Message</label>
                    <textarea name="memo" rows="2"></textarea>
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button blue" id="e_item_edit_modal_form_submit">Submit</div>
    </div>
</div>