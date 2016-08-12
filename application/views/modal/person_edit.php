<script>
    $(document).ready(function() {
        //modal link
        person_click_handler($('.people_edit_modal_link'));

        $('#person_edit_modal_form_submit').click(function() {
            $('#person_edit_modal_form').api({
                url: '<?= base_url('ajax/event-person-add/' . $event['id']) ?>',
                on: 'now',
                method: 'post',
                data: {
                    user_id: $(person_edit_form + 'input[name="user_id"]').val(),
                    user_name: $(person_edit_form + 'input[name="user_name"]').val(),
                    roles: $(person_edit_form + 'input[name="roles"]').val()
                },
                beforeSend: function(settings) {
                    $("#person_" + settings.data.user_id).remove();
                    return settings;
                },
                onResponse: function(response) {
                    if (response.success) {
                        var html = $(response.html);
                        $("#persons_list").append(html);
                        $('.ui.person_edit_modal').modal('hide');
                        //reset listener
                        person_click_handler(html.find('.people_edit_modal_link'));
                    } else {
                        $('#person_edit_modal_form')
                                .form('add errors', ['Server error. Please try again.']);
                    }
                }
            });
        });
        //clear dropdown if ever the modal is hidden
        $('.ui.person_edit_modal').modal({
            onHide: function() {
                $(person_edit_form + "input[name='roles']").parent(".dropdown").dropdown('clear');
            }
        });
        //ensure form is never submitted
        $('#person_edit_modal_form').submit(function(e) {
            return false;
        });
    });
    var person_edit_form = '#person_edit_modal_form ';
    function person_click_handler(obj) {
        obj.click(function() {
            var string_data = $(this).next().html();
            var data = JSON.parse(string_data);
            //insert data
            $("#person_name").html(data.name);
            $(person_edit_form + "input[name='user_name']").val(data.name);
            $(person_edit_form + "input[name='roles']").parent(".dropdown").dropdown('set selected', data.roles);
            $(person_edit_form + "input[name='user_id']").val(data.user_id);
            $("#person_delete").attr('data-uid', data.user_id);
            //show modal
            $('.ui.person_edit_modal').modal('show');
        });
    }
</script>
<div class="ui person_edit_modal small modal">
    <i class="close icon"></i>
    <div class="header">
        Edit Roles: <span id="person_name"></span>
    </div>
    <div class="content">
<?= form_open('ajax/event-person-add', ['class' => 'ui large form', 'id' => 'person_edit_modal_form']) ?>
        <input type="hidden" name="user_id" value="">
        <input type="hidden" name="user_name" value="">
        <div class="ui error message"></div>
        <div class="field">
            <label>Roles</label>
            <div class="ui fluid multiple search normal selection dropdown additions" >
                <input type="hidden" name="roles">
                <i class="dropdown icon"></i>
                <div class="default text">Enter roles separated by commas</div>
                <div class="menu">
<?= get_roles() ?>
                </div>
            </div>
            <div><em>Event Manager</em> role will give user administrative privileges on this event.</div>
            <br/>
            <a class="ui icon basic red button navs_popup confirm_api no_delete" id="person_delete" data-action="event person delete" data-uid="" data-eid="<?= $event['id'] ?>" data-content="Remove" data-position="top center">
                <i class="trash icon"></i> Remove user from event
            </a>
        </div>
        <div id="tags_container"></div>
<?= form_close() ?>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button blue" id="person_edit_modal_form_submit">Save</div>
    </div>
</div>