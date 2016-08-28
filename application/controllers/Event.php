<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller {

    /**
     * Constructor. Gets user data/status.
     */
    public function __construct() {
        parent::__construct();

        //helpers
        $this->load->helper('form');
    }

    /**
     * Redirect upon knowledge of login status
     */
    public function index() {
        $this->schedule();
    }

    /**
     * Loads and gets data for schedule page
     */
    public function add() {
        //admin level needed
        $this->require_min_level(9);

        //if post data found
        if ($this->input->post())
            $event_id = $this->event->create();
        else {
            show_404();
            return;
        }

        redirect('event/view/' . $event_id);
    }

    public function add_item() {
        //admin level needed
        $this->require_min_level(5);

        $this->event_item->add();

        redirect('event/view/' . $this->input->post('event_id'));
    }

    public function edit_item() {
        //admin level needed
        $this->require_min_level(5);

        $this->event_item->edit();

        redirect('event/view/' . $this->input->post('event_id'));
    }

    /**
     * Loads and gets data for event page
     */
    public function view($id) {
        //user login needed
        $this->require_min_level(3);
        //get event data
        $data['event'] = $this->event->get($id);
        //get people data
        $data['people'] = $this->event->get_people($id);
        //check if event manager
        $curr_uid = $this->auth_user_id;
        $has_roles = isset($data['people'][$curr_uid]);
        if ($has_roles) {
            $curr_person_roles = $data['people'][$curr_uid]['roles'];
            if (array_search('Event Manager', $curr_person_roles) !== FALSE)
                $data['is_event_manager'] = TRUE;
            else
                $data['is_event_manager'] = FALSE;
        }else {
            $data['is_event_manager'] = FALSE;
        }
        //get event items
        $data['items'] = $this->event_item->get($id);
        //add more data to each event item
        $dates = array();
        $i = 0;
        foreach ($data['items'] as $item) {
            //labels
            $data['items'][$i]['label'] = FALSE;
            if (array_search(date('d/m/Y', $item['start_time']), $dates) === FALSE) {
                array_push($dates, date('d/m/Y', $item['start_time']));
                $data['items'][$i]['label'] = TRUE;
            }
            //get song stuff
            if ($item['type'] == 'song') {
                //arrangement
                $data['items'][$i]['arrangement'] = $this->arrangement->get($item['arrangement_id']);
                //chord charts
                $song_keys = json_decode($data['items'][$i]['arrangement']['song_keys'], TRUE);
                $data['items'][$i]['arrangement']['song_keys'] = array();
                $k = 0;
                foreach ($song_keys as $song_key) {
                    if ($song_key['key'] == 'Open' || $song_key['key'] == $item['arrangement_key']) {
                        $data['items'][$i]['arrangement']['song_keys'][$k] = array(
                            'key' => $song_key['key'],
                            'media' => $this->media->get($song_key['id']));
                        $k++;
                    }
                }
                //audio file
                if ($data['items'][$i]['arrangement']['audio'] != '') {
                    $audio_id = $data['items'][$i]['arrangement']['audio'];
                    $data['items'][$i]['arrangement']['audio'] = $this->media->get($audio_id);
                }
                //lyric sheet
                if ($data['items'][$i]['arrangement']['lyrics'] != '') {
                    $lyrics_id = $data['items'][$i]['arrangement']['lyrics'];
                    $data['items'][$i]['arrangement']['lyrics'] = $this->media->get($lyrics_id);
                }
                //song
                $data['items'][$i]['song'] = $this->song->get($data['items'][$i]['arrangement']['song']);
            }
            $i++;
        }

        //setup view
        $data['title'] = $data['event']['name'];
        $this->load->view('event/view', $data);
    }

}
