<script>
    $(document).ready(function() {
        //instantiate modal
        $('.ui.e_item_new_modal')
                .modal('attach events', '#e_item_new_modal', 'show');

        //submit the form
        $('#e_item_new_modal_form_submit').click(function() {
            //submit the form
            $('#e_item_new_modal_form').submit();
        });

        //datetimepicker
        $('#event_new_time').periodpicker({
            dayOfWeekStart: 7,
            norange: true, // use only one value
            cells: [1, 1],
            title: false,
            closeButton: false,
            fullsizeButton: false,
            timepicker: true // use timepicker
        });
        $('#event_new_time').val('<?= date('Y/m/d', $event['date']) ?>');
        $('#event_new_time').periodpicker('change');

        //radio hide/show
        $("#e_item_simple").hide(); //init
        $("input[name='type']").change(function() {
            if ($("input[name='type']").is(':checked')) {
                var val = $(this).val();
                //e_item_simple | e_item_song
                var selector = "#e_item_" + val;
                $(".e_item_").hide();
                $(selector).show();
            }
        });
    });
</script>
<div class="ui long modal e_item_new_modal">
    <i class="close icon"></i>
    <div class="header">
        New event item for <em><?= $title ?></em>
    </div>
    <div class="ui sub header"><em><?= date('l, F jS g:ia', $event['date']) ?></em></div>
    <div class="content">
        <?= form_open('event/add-item', ['class' => 'ui large form', 'id' => 'e_item_new_modal_form']) ?>
        <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
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
                    <input type="text" name="event_time" id="event_new_time" placeholder="Time">
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
                <div class="e_item_" id="e_item_song">
                    <h3 class="ui dividing header">Song</h3>
                    <div class="field">
                        <!-- Song Search -->
                        <label>Song Search</label>
                        <div class="ui search arrangement_search">
                            <div class="ui left icon input">
                                <input class="prompt" type="text" placeholder="Search songs">
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
                <div class="e_item_" id="e_item_simple">
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
        <div class="ui button blue" id="e_item_new_modal_form_submit">Submit</div>
    </div>
</div>