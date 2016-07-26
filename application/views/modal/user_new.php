<script>
    $(document).ready(function() {
        $('.ui.new_user_modal')
                .modal('attach events', '#new_user_modal_button', 'show');
        $('#new_user_form')
                .form({fields: {
                        first_name: 'empty',
                        last_name: 'empty',
                        permissions: 'empty',
                        email: 'email'
            }});
        $('#new_user_form_submit').click(function() {
            $('#new_user_form').submit();
            if ($('#new_user_form').form('is valid'))
                $('.ui.new_user_modal').model('hide');
        });
    });
</script>
<div class="ui new_user_modal small modal">
    <i class="close icon"></i>
    <div class="header">
        Add New User
    </div>
    <div class="content">
        <?= form_open_multipart('user/user-add', ['class' => 'ui large form', 'id' => 'new_user_form']) ?>
        <div class="ui error message"></div>
        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="First Name">
                </div>
                <div class="field">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Last Name">
                </div>
            </div>
        </div>
        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label>Permissions</label>
                    <div class="ui fluid search normal selection dropdown" >
                        <input type="hidden" name="permissions">
                        <i class="dropdown icon"></i>
                        <div class="default text">Admin or Viewer</div>
                        <div class="menu">
                            <div class="item" data-value="admin">Admin/Scheduler</div>
                            <div class="item" data-value="viewer">Viewer</div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email">
                </div>
            </div>
        </div>
        <div id="tags_container"></div>
        <?= form_close() ?>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button blue" id="new_user_form_submit">Create</div>
    </div>
</div>