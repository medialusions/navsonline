<script>
    $(document).ready(function() {
        //instantiate modal
        $('.arrangement_edit_modal_button').click(function(e) {
            var string_data = $(this).next().html();
            var data = JSON.parse(string_data);
            var form = '#arrangement_edit_modal_form ';

            $(form + "input[name='arr_id']").val(data.id);
            $(form + "input[name='artist']").parent(".dropdown").dropdown('set selected', data.artist);
            $(form + "input[name='default_key']").parent(".dropdown").dropdown('set selected', data.default_key);
            $(form + "input[name='bpm']").val(data.bpm);
            var min, sec;
            if (data.length !== "") {
                var length = parseInt(data.length);
                sec = length % 60;
                min = (length - sec) / 60;
            } else {
                sec = '';
                min = '';
            }
            $(form + "input[name='min']").val(min);
            $(form + "input[name='sec']").val(sec);
            $(form + "input[name='video']").val(data.video);
            if (data.audio.constructor === {}.constructor) {
                $(form + "input[name='audio']").val(data.audio.name.replace("&amp;", "&"));
                $(form + "input[name='media_audio']").val(data.audio.id);
            }
            if (data.lyrics.constructor === {}.constructor) {
                $(form + "input[name='lyrics']").val(data.lyrics.name.replace("&amp;", "&"));
                $(form + "input[name='media_lyrics']").val(data.lyrics.id);
            }
            var song_keys = [];
            if (data.song_keys instanceof Array) {
                $.each(data.song_keys, function(i, song_key) {
                    var curr = {'key': song_key.key};
                    curr.link = song_key.media.link;
                    curr.title = song_key.media.name;
                    curr.id = song_key.media.id;
                    song_keys.push(curr);
                });
                $("#chord_edit").val(JSON.stringify(song_keys));
                chord_edit_table_2();
            } else {
                $("#chord_edit").val(JSON.stringify(song_keys));
            }

            //show the modal
            $('.ui.arrangement_edit_modal').modal('show');
        });

        //instantiate form
        $('#arrangement_edit_modal_form')
                .form({
                    fields: {
                        artist: 'empty',
                        default_key: 'empty'
                    }
                });

        //submit the form
        $('#arrangement_edit_modal_form_submit').click(function() {
            //get video type and put it inside of input
            $("#video_type").val($("#video_type_text").html());
            //submit the form
            $('#arrangement_edit_modal_form').submit();
        });

        //chord matrix adder
        $("#chord_edit_table").hide();
        $("#chord_edit_button").click(function(event) {
            event.preventDefault();
            //show the table
            $("#chord_edit_table").show();
            //ERROR: #chord_edit_error > p
            if ($("#arrangement_edit_modal_form input[name='media_chord']").val() === '' || $("#arrangement_edit_modal_form input[name='chart_key']").val() === '') {
                $("#chord_edit_error").children("p").text("Enter the key AND select a file.");
                $("#chord_edit_error").show();
                //refresh modal scroll
                $('.ui.arrangement_edit_modal').modal('refresh');
                return false;
            } else {
                $("#chord_edit_error").hide();
            }
            var key = $("#arrangement_edit_modal_form input[name='chart_key']").val();
            var data = JSON.parse($("#arrangement_edit_modal_form input[name='media_chord']").val());
            data.key = key;
            //insert it
            insert_chord_row_2(data);
        });
    });
    //Input #chord_edit
    //Table #chord_edit_table > tbody
    function chord_edit_table_2() {
        var data = JSON.parse($("#chord_edit").val());
        //just hide the table if the length is 0
        if (data.length === 0)
            $("#chord_edit_table").hide();
        else
            $("#chord_edit_table").show();

        var html = [];
        $.each(data, function(i, data) {
            //create object
            var tr = [
                '<tr><td>' + data.key + '</td><td><a target="_blank" href="<?= base_url() ?>' + data.link + '">' + data.title + '</a></td><td>',
                '<button class="ui icon basic red button tiny chord_edit_delete" data-key="' + data.key + '" ><i class="trash icon"></i></button>',
                '</td></tr>'
            ];
            tr = $(tr.join(''));
            html.push(tr);
        });
        $("#chord_edit_table > tbody").html(html);

        //register chord matrix deleter
        $(".chord_edit_delete").click(function(event) {
            event.preventDefault();
            var key = $(this).attr("data-key");
            delete_chord_row_2(key);
        });
        //refresh modal scroll
        $('.ui.arrangement_edit_modal').modal('refresh');
    }

    function insert_chord_row_2(data) {
        var current = JSON.parse($("#chord_edit").val());

        //remove the old key if adding another
        var clean = [];
        $.each(current, function(i, curr) {
            if (data.key !== curr.key) {
                clean.push(curr);
            }
        });

        clean.push(data);
        $("#chord_edit").val(JSON.stringify(clean));
        chord_edit_table_2();
    }

    function delete_chord_row_2(key) {
        var current = JSON.parse($("#chord_edit").val());

        //remove the old key if adding another
        var clean = [];
        $.each(current, function(i, curr) {
            if (key !== curr.key) {
                clean.push(curr);
            }
        });

        $("#chord_edit").val(JSON.stringify(clean));
        chord_edit_table_2();
    }
</script>
<div class="ui long modal arrangement_edit_modal">
    <i class="close icon"></i>
    <div class="header">
        Edit Arrangement for <em><?= $song['title'] ?></em>
    </div>
    <div class="content">
        <?= form_open('music/edit-arrangement', ['class' => 'ui large form', 'id' => 'arrangement_edit_modal_form']) ?>
        <input type="hidden" name="song" value="<?= $song['id'] ?>">
        <input type="hidden" name="arr_id" value="">
        <div class="ui error message"></div>
        <!-- artist -->
        <h4 class="ui dividing header">Artist</h4>
        <div class="field">
            <div class="ui fluid search normal selection dropdown additions" >
                <input type="hidden" name="artist">
                <i class="dropdown icon"></i>
                <div class="default text">Search or type new artist</div>
                <div class="menu">
                    <?= get_artists() ?>
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
                            <input class="prompt" type="text" name="lyrics" placeholder="Search lyrics">
                            <i class="align left icon"></i>
                        </div>
                    </div>
                    <input name="media_lyrics" type="hidden" value="">
                </div>
            </div>
        </div>
        <!-- chords -->
        <h4 class="ui dividing header">Chords</h4>
        <div class="ui error message" id="chord_edit_error">
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
                    <button class="ui button teal basic" id="chord_edit_button">
                        <i class="plus icon"></i>
                        Add Chord Variation
                    </button>
                </div>
            </div>
        </div>
        <div class="field">
            <input type="hidden" name="chord_edit" id="chord_edit" value="[]">
            <table class="ui small teal table" id="chord_edit_table">
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
        <div class="ui button blue" id="arrangement_edit_modal_form_submit">Submit</div>
    </div>
</div>