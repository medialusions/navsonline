<script>
    $(document).ready(function() {
        $('.ui.music_new_modal')
                .modal({
                    blurring: false
                })
                .modal('attach events', '#music_new_modal', 'show')
                ;

        $('#event_new_modal_form')
                .form({
                    fields: {
                        song_title: 'empty'
                    }
                })
                ;

        $('#music_new_modal_form_submit').click(function() {
            $('#music_new_modal_form').submit();
            if ($('#music_new_modal_form').form('is valid'))
                $('.ui.music_new_modal').model('hide');
        });

        
    });
</script>
<div class="ui small music_new_modal modal">
    <i class="close icon"></i>
    <div class="header">
        New Song
    </div>
    <div class="content">
        <?= form_open('music/add-song', ['class' => 'ui large form', 'id' => 'music_new_modal_form']) ?>
        <div class="ui error message"></div>
        <p>Enter the song title and tags related to it first. Next, we will introduce different artist arrangements.</p>
        <div class="field">
            <label>Song Title</label>
            <input type="text" name="song_title" placeholder="Name">
        </div>
        <div class="field">
            <label>Song Tags</label>
            <div class="ui fluid multiple search normal selection dropdown nav_tags" >
                <input type="hidden" name="tags">
                <i class="dropdown icon"></i>
                <div class="default text">Manually enter custom tags like "Hymns"</div>
                <div class="menu">
                    <?= get_tags() ?>
                </div>
            </div>
        </div>
        <div id="tags_container"></div>
        <?= form_close() ?>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button blue" id="music_new_modal_form_submit">Submit</div>
    </div>
</div>