<script>
    $(document).ready(function() {
        $('.ui.person_new_modal')
                .modal()
                .modal('attach events', '.person_new_modal_button', 'show');
        $('#person_new_modal_form_submit').click(function() {
            $('#person_new_modal_form').api({
                url: '<?= base_url('ajax/event-person-add/' . $event['id']) ?>',
                on: 'now',
                method: 'post',
                data: {
                    user: $('input[name="user_search"]').val(),
                    roles: $('input[name="roles"]').val()
                },
                beforeSend: function(settings) {
                    //validate and exit if invalid
                    if (!$('#person_new_modal_form')
                            .form({fields: {user_search: 'empty', roles: 'empty'}})
                            .form('is valid')) {
                        $('#person_new_modal_form').form('validate form');
                        return false;
                    }
                    //success
                    return settings;
                },
                onResponse: function(response) {
                    if (response.success) {
                        var html = $(response.html);
                        $("#persons_list").append(html);
                        $('.ui.person_new_modal').modal('hide');
                        //reset listener
                        person_click_handler(html.find('.people_edit_modal_link'));
                    } else {
                        $('#person_new_modal_form')
                                .form('add errors', ['Server error. Please try again.']);
                    }
                }
            });
        });

        //ensure form is never submitted
        $('#person_new_modal_form').submit(function(e) {
            return false;
        });
    });
</script>
<div class="ui person_new_modal small modal">
    <i class="close icon"></i>
    <div class="header">
        Add Person
    </div>
    <div class="content">
        <?= form_open('ajax/event-person-add', ['class' => 'ui large form', 'id' => 'person_new_modal_form']) ?>
        <div class="ui error message"></div>
        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label>User</label>
                    <div class="ui search user_search restricted_search" data-eid="<?= $event['id'] ?>">
                        <div class="ui left icon input">
                            <input class="prompt" type="text" name="user" placeholder="Search active users">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <input name="user_search" type="hidden" value="">
                </div>
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
                </div>
            </div>
        </div>
        <div id="tags_container"></div>
        <?= form_close() ?>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button blue" id="person_new_modal_form_submit">Add</div>
    </div>
</div>