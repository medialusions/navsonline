<script>
    $(document).ready(function() {
        $('.ui.media_new_modal')
                .modal({blurring: false})
                .modal('attach events', '.media_new_modal_button', 'show');

        $('#media_new_modal_form')
                .form({
                    fields: {
                        file: 'empty',
                        name: 'empty',
                        file: 'empty'
                    }
                });

        $('#media_new_modal_form_submit').click(function() {
            $('#media_new_modal_form').submit();
            if ($('#media_new_modal_form').form('is valid'))
                $('.ui.media_new_modal').model('hide');
        });

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
        <?= form_open('music/add-media', ['class' => 'ui large form', 'id' => 'media_new_modal_form']) ?>
        <div class="ui error message"></div>
        <div class="field">
            <label>Name</label>
            <input type="text" name="name" placeholder="Name">
        </div>
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
                        <input type="text" placeholder="no file selected" id="file_text_field" value="" readonly>
                    </div>
                    <input type="file" id="hidden_file_picker" name="file" style="display: none">
                </div>
            </div>
        </div>
        <div id="tags_container"></div>
        <?= form_close() ?>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button blue" id="media_new_modal_form_submit">Submit</div>
    </div>
</div>