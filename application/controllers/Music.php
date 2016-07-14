<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Music extends MY_Controller {

    /**
     * Constructor. Gets user data/status.
     */
    public function __construct() {
        parent::__construct();

        //pre load
        $this->require_min_level(1);
    }

    /**
     * Loads and gets data for music page
     */
    public function add_song() {
        //admin level needed
        $this->require_min_level(9);

        //if post data found
        if ($this->input->post())
            $event_id = $this->song->create();
        else {
            show_404();
            return;
        }

        redirect('music/view/' . $event_id);
    }

    public function delete_arrangement($id) {
        $this->require_min_level(9);
        $arr = $this->arrangement->get($id);
        if (strpos($arr['organizations'], '"' . $_SESSION['organization_id'] . '"'))
            $this->arrangement->delete($id);
        else
            show_404();
        
        //go back to the song page
        redirect('music/view/' . $arr['song']);
    }

    /**
     * 
     */
    public function add_arrangement() {
        $this->require_min_level(9);
        if (!$this->input->post())
            show_404();

        //parse through media fields
        if ($this->input->post("media_audio") && $this->input->post("media_audio") != '') {
            $media_audio = json_decode($this->input->post("media_audio"), TRUE);
            $audio = $media_audio['id'];
        } else {
            $audio = '';
        }
        if ($this->input->post("media_lyrics") && $this->input->post("media_lyrics") != '') {
            $media_lyrics = json_decode($this->input->post("media_lyrics"), TRUE);
            $lyrics = $media_lyrics['id'];
        } else {
            $lyrics = '';
        }
        if ($this->input->post("chord_matrix") && $this->input->post("chord_matrix") != '') {
            $chord_matrix = json_decode($this->input->post("chord_matrix"), TRUE);
            $song_keys = array();
            foreach ($chord_matrix as $chord_variation) {
                $chord_var = array('key' => $chord_variation['key'], 'id' => $chord_variation['id']);
                array_push($song_keys, $chord_var);
            }
        } else {
            $song_keys = array();
        }

        //get all post data
        $post = $this->input->post();
        $post['lyrics'] = $lyrics;
        $post['audio'] = $audio;
        $post['song_keys'] = json_encode($song_keys);

        //parse length in sec
        $post['length'] = ($post['min'] * 60) + $post['sec'];

        //to the model
        $result = $this->arrangement->create($post);

        //go back to the song page
        redirect('music/view/' . $post['song']);
    }

    /**
     * 
     */
    public function edit_arrangement() {
        $this->require_min_level(9);
        if (!$this->input->post())
            show_404();

        //parse through media fields
        if ($this->input->post("media_audio") && $this->input->post("media_audio") != '') {
            if (!is_numeric($this->input->post("media_audio"))) {
                $media_audio = json_decode($this->input->post("media_audio"), TRUE);
                $audio = $media_audio['id'];
            } else {
                $audio = $this->input->post("media_audio");
            }
        } else {
            $audio = '';
        }
        if ($this->input->post("media_lyrics") && $this->input->post("media_lyrics") != '') {
            if (!is_numeric($this->input->post("media_lyrics"))) {
                $media_lyrics = json_decode($this->input->post("media_lyrics"), TRUE);
                $lyrics = $media_lyrics['id'];
            } else {
                $lyrics = $this->input->post("media_lyrics");
            }
        } else {
            $lyrics = '';
        }
        if ($this->input->post("chord_edit") && $this->input->post("chord_edit") != '') {
            $chord_matrix = json_decode($this->input->post("chord_edit"), TRUE);
            $song_keys = array();
            foreach ($chord_matrix as $chord_variation) {
                $chord_var = array('key' => $chord_variation['key'], 'id' => $chord_variation['id']);
                array_push($song_keys, $chord_var);
            }
        } else {
            $song_keys = array();
        }

        //get all post data
        $post = $this->input->post();
        $post['lyrics'] = $lyrics;
        $post['audio'] = $audio;
        $post['song_keys'] = json_encode($song_keys);

        //parse length in sec
        $post['length'] = ($post['min'] * 60) + $post['sec'];

        //to the model
        $sql = $this->arrangement->edit($post);

        //go back to the song page
        redirect('music/view/' . $post['song']);
    }

    /**
     * Loads and gets data for music page
     */
    public function view($id) {
        $data['song'] = $this->song->get($id);
        $data['arrangements'] = $this->arrangement->song_get($id);
        $data['arrangements'] = $this->arrangement->song_get($id);
        $i = 0;
        foreach ($data['arrangements'] as $arrangement) {
            if ($arrangement['audio'] != '') {
                $audio_id = $arrangement['audio'];
                $data['arrangements'][$i]['audio'] = $this->media->get($audio_id);
            }
            if ($arrangement['lyrics'] != '') {
                $lyrics_id = $arrangement['lyrics'];
                $data['arrangements'][$i]['lyrics'] = $this->media->get($lyrics_id);
            }
            $song_keys = json_decode($arrangement['song_keys'], TRUE);
            $data['arrangements'][$i]['song_keys'] = array();
            $k = 0;
            foreach ($song_keys as $song_key) {
                $data['arrangements'][$i]['song_keys'][$k] = array(
                    'key' => $song_key['key'],
                    'media' => $this->media->get($song_key['id']));
                $k++;
            }
            $i++;
        }

        $data['title'] = $data['song']['title'];

        $this->load->view('music/view', $data);
    }

}
