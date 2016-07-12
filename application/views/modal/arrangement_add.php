<script>
    $(document).ready(function() {
        $('.ui.arrangement_new_modal')
                .modal({
                    blurring: false
                })
                .modal('attach events', '#arrangement_new_modal', 'show')
                ;

        $('#arrangement_new_modal_form')
                .form({
                    fields: {
                        artist: 'empty',
                        default_key: 'empty'
                    }
                })
                ;

        $('#arrangement_new_modal_form_submit').click(function() {
            //get video type and put it inside of input
            $("#video_type").val($("#video_type_text").html());
            //submit the form
            //$('#arrangement_new_modal_form').submit();
            if ($('#arrangement_new_modal_form').form('is valid'))
                $('.ui.arrangement_new_modal').modal('hide');
        });

        // create an observer instance
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                console.log(mutation.type);
            });
        });
        observer.observe(document.getElementById('video_type_text'), {characterData: true});
    });
</script>
<div class="ui arrangement_new_modal modal">
    <i class="close icon"></i>
    <div class="header">
        New Arrangement for <em><?= $song['title'] ?></em>
    </div>
    <div class="content">
        <?= form_open('music/add-arrangement', ['class' => 'ui large form', 'id' => 'arrangement_new_modal_form']) ?>
        <div class="ui error message"></div>
        <!-- artist -->
        <h4 class="ui dividing header">Artist</h4>
        <div class="field">
            <div class="ui fluid search normal selection dropdown additions" >
                <input type="hidden" name="artist">
                <i class="dropdown icon"></i>
                <div class="default text">Search or type new artist</div>
                <div class="menu">
                    <div class="item" data-value="David Crowder Band">David Crowder Band</div>
                    <div class="item" data-value="Another">Another</div>
                </div>
            </div>
        </div>
        <!-- song details -->
        <h4 class="ui dividing header">Song Details</h4>
        <div class="field">
            <div class="four fields">
                <div class="field">
                    <div class="ui fluid search normal selection dropdown" >
                        <input type="hidden" name="default_key">
                        <i class="dropdown icon"></i>
                        <div class="default text">Default key</div>
                        <div class="menu">
                            <div class="item" data-value="A">A</div>
                            <div class="item" data-value="A#">A#</div>
                            <div class="item" data-value="B">B</div>
                            <div class="item" data-value="C">C</div>
                            <div class="item" data-value="C#">C#</div>
                            <div class="item" data-value="D">D</div>
                            <div class="item" data-value="D#">D#</div>
                            <div class="item" data-value="E">E</div>
                            <div class="item" data-value="F">F</div>
                            <div class="item" data-value="F#">F#</div>
                            <div class="item" data-value="G">G</div>
                            <div class="item" data-value="G#">G#</div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="ui right labeled input">
                        <input type="number" name="bpm" placeholder="Enter bpm">
                        <div class="ui basic label">
                            bpm
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="ui right labeled input">
                        <input type="number" name="min" placeholder="Minutes">
                        <div class="ui basic label">
                            min
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="ui right labeled input">
                        <input type="number" name="sec" placeholder="Seconds">
                        <div class="ui basic label">
                            sec
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- attachments -->
        <h4 class="ui dividing header">Attachments</h4>
        <div class="field">
            <div class="four fields">
                <div class="field">
                    <label>Video</label>
                    <h4 class="ui header">
                        <div class="content">
                            The video type is 
                            <div class="ui inline dropdown">
                                <div class="text" id="video_type_text">youtube</div>
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    <div class="header">Select video type</div>
                                    <div class="active item" data-text="youtube">YouTube</div>
                                    <div class="item" data-text="vimeo">Vimeo</div>
                                </div>
                            </div>
                            <input type="hidden" name="video_type" value="" id="video_type">
                            <input type="text" class="ui inline very basic" name="video_identifier" placeholder="id e.g. 9bZkp7q19f0">
                        </div>
                    </h4>
                </div>
                <div class="field">
                    <label>Audio</label>
                    <div class="ui search media_audio">
                        <div class="ui left icon input">
                            <input class="prompt" type="text" name="audio" placeholder="Search audio files">
                            <i class="volume up icon"></i>
                        </div>
                    </div>
                    <input name="media_audio" type="hidden" value="">
                </div>
                <div class="field">
                    <label>Lyrics</label>
                    <div class="ui search media_lyrics">
                        <div class="ui left icon input">
                            <input class="prompt" type="text" placeholder="Search lyrics">
                            <i class="align left icon"></i>
                        </div>
                    </div>
                    <input name="media_lyrics" type="hidden" value="">
                </div>
                <div class="field">
                    <label>Chords</label>
                    <div class="ui search media_chord">
                        <div class="ui left icon input">
                            <input class="prompt" type="text" placeholder="Search chord charts">
                            <i class="table icon"></i>
                        </div>
                    </div>
                    <input name="media_chord" type="hidden" value="">
                </div>
            </div>
        </div>
        <?= form_close() ?>
        <div class="ui centered grid">
            <div class="column">
                <button class="ui button orange media_new_modal_button">
                    <i class="arrow up icon"></i>
                    Upload media
                </button>
            </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button blue" id="arrangement_new_modal_form_submit">Submit</div>
    </div>
</div>