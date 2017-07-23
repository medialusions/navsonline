<script>
$(document).ready(function() {
  $('.ui.event_name_edit_modal')
  .modal()
  .modal('attach events', '.event_name_edit_button', 'show');
  $('#event_name_edit_form_submit').click(function() {
    $('#event_name_edit_form').api({
      url: '<?= base_url('ajax/event-name-edit/' . $event['id']) ?>',
      on: 'now',
      method: 'post',
      data: {
        name: $('input[name="event_name"]').val()
      },
      beforeSend: function(settings) {
        //validate and exit if invalid
        if (!$('#person_new_modal_form')
        .form({fields: {name: 'empty'}})
        .form('is valid')) {
          $('#event_name_edit_form').form('validate form');
          return false;
        }
        //success
        return settings;
      },
      onResponse: function(response) {
        if (response.success) {
          location.reload();
        } else {
          $('#event_name_edit_form')
          .form('add errors', ['Server error. Please try again.']);
        }
      }
    });
  });

  //ensure form is never submitted
  $('#event_name_edit_form').submit(function(e) {
    return false;
  });
});
</script>
<div class="ui event_name_edit_modal small modal">
  <i class="close icon"></i>
  <div class="header">
    Edit Name
  </div>
  <div class="content">
    <?= form_open('ajax/event-name-edit', ['class' => 'ui large form', 'id' => 'event_name_edit_form']) ?>
    <div class="ui error message"></div>
    <div class="field">
      <div class="ui input">
        <input name="event_name" type="text" value="<?= $title ?>" placeholder="Cannot be empty">
      </div>
    </div>
    <div id="tags_container"></div>
    <?= form_close() ?>
  </div>
  <div class="actions">
    <div class="ui button cancel">Cancel</div>
    <div class="ui button blue" id="event_name_edit_form_submit">Save</div>
  </div>
</div>
