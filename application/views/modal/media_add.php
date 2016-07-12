<script>
    $(document).ready(function() {
        $('.ui.media_new_modal')
                .modal({blurring: false})
                .modal('attach events', '.media_new_modal_button', 'show');
        $('#media_new_modal_form')
                .form({fields: {file: 'empty'}});
        $('#media_new_modal_form_submit').click(function() {
            $.ajax({
                url: '<?= base_url('ajax/media-add') ?>',
                method: 'POST',
                data: new FormData($("#media_new_modal_form")[0]),
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $("#media_new_modal_form_submit").addClass('disabled');
                    //show media upload progress
                    $('#media_add_progress').show();
                    $('#media_add_progress').progress('set label', 'Sending data packet');
                    $('#media_add_progress').progress('increment');
                },
                complete: function(returnData, status) {
                    var response = JSON.parse(returnData.responseText);
                    if (response.success) {
                        $('#media_add_progress').progress('complete');
                    } else {
                        $('#media_add_progress').progress('set error');
                        $('#media_add_progress').progress('set bar label', 'Error');
                        $('#media_add_progress').progress('set label', response.message);
                    }
                    $("#media_new_modal_form_submit").removeClass('disabled');
                    $('#media_add_progress').hide();
                    $('.ui.media_new_modal').modal('hide');
                }
            });
        });
        //setup the progress bar
        $('#media_add_progress').progress({total: 3, text: {success: 'File uploaded'}}).hide();
        //disable button if media type isn't selected yet
        if ($("input[name='link_type']").val() === '') {
            $("#trigger_file").addClass('disabled');
        }
        $("input[name='link_type']").change(function() {
            var accept = "";
            switch ($("input[name='link_type']").val()) {
                case "audio":
                    accept = "audio/*";
                    break;
                case "chord":
                case "lyric":
                    accept = ".pdf, .doc, .docx";
                    break;
            }
            $("#hidden_file_picker").attr("accept", accept);
            $("#trigger_file").removeClass('disabled');
        });
        //hidden file uploader
        $("#trigger_file").click(function(event) {
            event.preventDefault();
            $('#hidden_file_picker').click();
        });
        //on file picker change
        $('#hidden_file_picker').on("change", function() {
            $("#file_text_field").val($('#hidden_file_picker').val().replace(/.*(\/|\\)/, ''));
        });
    });
</script>
<div class="ui media_new_modal modal">
    <i class="close icon"></i>
    <div class="header">
        Media Uploader
    </div>
    <div class="content">
        <?= form_open_multipart('ajax/media-add', ['class' => 'ui large form', 'id' => 'media_new_modal_form']) ?>
        <div class="ui error message"></div>
        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label>Media Type</label>
                    <div class="ui fluid search normal selection dropdown" >
                        <input type="hidden" name="link_type">
                        <i class="dropdown icon"></i>
                        <div class="default text">e.g. lyrics, chords, etc.</div>
                        <div class="menu">
                            <div class="item" data-value="audio">Audio File</div>
                            <div class="item" data-value="chord">Chord Sheet</div>
                            <div class="item" data-value="lyric">Lyric Sheet</div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>File Upload</label>
                    <div class="ui left action input">
                        <button class="ui blue labeled icon button" id="trigger_file">
                            <i class="arrow up icon"></i>
                            Choose File
                        </button>
                        <input type="text" placeholder="no file selected" name="name" id="file_text_field" value="" readonly>
                    </div>
                    <input type="file" id="hidden_file_picker" name="file" style="display: none">
                </div>
            </div>
        </div>
        <div id="tags_container"></div>
        <?= form_close() ?>
        <div class="ui progress" id="media_add_progress">
            <div class="bar">
                <div class="progress"></div>
            </div>
            <div class="label">Uploading Media</div>
        </div>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button green" id="media_new_modal_form_submit">Upload</div>
    </div>
</div>