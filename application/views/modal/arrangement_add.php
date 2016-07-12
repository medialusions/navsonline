<script>
    $(document).ready(function() {
        //instantiate modal
        $('.ui.arrangement_new_modal')
                .modal('attach events', '#arrangement_new_modal', 'show');

        //instantiate form
        $('#arrangement_new_modal_form')
                .form({
                    fields: {
                        artist: 'empty',
                        default_key: 'empty'
                    }
                });

        //submit the form
        $('#arrangement_new_modal_form_submit').click(function() {
            //get video type and put it inside of input
            $("#video_type").val($("#video_type_text").html());
            //submit the form
            $('#arrangement_new_modal_form').submit();
        });

        //when opening modal, don't submit form
        $(".media_new_modal_button").click(function(event) {
            event.preventDefault();
        });


        //chord matrix adder
        $("#chord_matrix_table").hide();
        $("#chord_matrix_button").click(function(event) {
            event.preventDefault();
            //show the table
            $("#chord_matrix_table").show();
            //ERROR: #chord_matrix_error > p
            if ($("input[name='media_chord']").val() === '' || $("input[name='chart_key']").val() === '') {
                $("#chord_matrix_error").children("p").text("Enter the key AND select a file.");
                $("#chord_matrix_error").show();
                //refresh modal scroll
                $('.ui.arrangement_new_modal').modal('refresh');
                return false;
            } else {
                $("#chord_matrix_error").hide();
            }
            var key = $("input[name='chart_key']").val();
            var data = JSON.parse($("input[name='media_chord']").val());
            data.key = key;
            //insert it
            insert_chord_row(data);
        });
    });
    //Input #chord_matrix
    //Table #chord_matrix_table > tbody
    function chord_matrix_table() {
        var data = JSON.parse($("#chord_matrix").val());
        //just hide the table if the length is 0
        if(data.length === 0)
            $("#chord_matrix_table").hide();
        
        var html = [];
        $.each(data, function(i, data) {
            //create object
            var tr = [
                '<tr><td>' + data.key + '</td><td><a target="_blank" href="<?= base_url() ?>' + data.link + '">' + data.title + '</a></td><td>',
                '<button class="ui icon basic red button tiny chord_matrix_delete" data-key="' + data.key + '" ><i class="trash icon"></i></button>',
                '</td></tr>'
            ];
            tr = $(tr.join(''));
            html.push(tr);
        });
        $("#chord_matrix_table > tbody").html(html);

        //register chord matrix deleter
        $(".chord_matrix_delete").click(function(event) {
            event.preventDefault();
            var key = $(this).attr("data-key");
            delete_chord_row(key);
        });
        //refresh modal scroll
        $('.ui.arrangement_new_modal').modal('refresh');
    }

    function insert_chord_row(data) {
        var current = JSON.parse($("#chord_matrix").val());

        //remove the old key if adding another
        var clean = [];
        $.each(current, function(i, curr) {
            if (data.key !== curr.key) {
                clean.push(curr);
            }
        });

        clean.push(data);
        $("#chord_matrix").val(JSON.stringify(clean));
        chord_matrix_table();
    }

    function delete_chord_row(key) {
        var current = JSON.parse($("#chord_matrix").val());

        //remove the old key if adding another
        var clean = [];
        $.each(current, function(i, curr) {
            if (key !== curr.key) {
                clean.push(curr);
            }
        });

        $("#chord_matrix").val(JSON.stringify(clean));
        chord_matrix_table();
    }
</script>
<div class="ui long modal arrangement_new_modal">
    <i class="close icon"></i>
    <div class="header">
        New Arrangement for <em><?= $song['title'] ?></em>
    </div>
    <div class="content">
        <?= form_open('music/add-arrangement', ['class' => 'ui large form', 'id' => 'arrangement_new_modal_form']) ?>
        <input type="hidden" name="song" value="<?= $song['id'] ?>">
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
        <h4 class="ui dividing header">Attachments
            <button class="ui button very basic mini orange media_new_modal_button">
                <i class="arrow up icon"></i>
                Upload media
            </button>
        </h4>
        <div class="field">
            <div class="three fields">
                <div class="field">
                    <label>Video Link</label>
                    <input type="text" class="ui inline very basic" name="video" placeholder="e.g. https://www.youtube.com/watch?v=9bZkp7q19f0">
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
            </div>
        </div>
        <!-- chords -->
        <h4 class="ui dividing header">Chords</h4>
        <div class="ui error message" id="chord_matrix_error">
            <p></p>
        </div>
        <div class="field">
            <div class="three fields">
                <div class="field">
                    <div class="ui fluid search normal selection dropdown" >
                        <input type="hidden" name="chart_key">
                        <i class="dropdown icon"></i>
                        <div class="default text">Key</div>
                        <div class="menu">
                            <div class="item" data-value="Open">Open</div>
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
                    <div class="ui search media_chord">
                        <div class="ui left icon input">
                            <input class="prompt" type="text" placeholder="Search chord charts" id="chord_search">
                            <i class="table icon"></i>
                        </div>
                    </div>
                    <input name="media_chord" type="hidden" value="">
                </div>
                <div class="field">
                    <button class="ui button teal basic" id="chord_matrix_button">
                        <i class="plus icon"></i>
                        Add Chord Variation
                    </button>
                </div>
            </div>
        </div>
        <div class="field">
            <input type="hidden" name="chord_matrix" id="chord_matrix" value="[]">
            <table class="ui small teal table" id="chord_matrix_table">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Chord Chart</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <?= form_close() ?>
    </div>
    <div class="actions">
        <div class="ui button cancel">Cancel</div>
        <div class="ui button blue" id="arrangement_new_modal_form_submit">Submit</div>
    </div>
</div>