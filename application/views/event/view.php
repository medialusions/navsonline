<?php $this->load->view('template/header'); ?>

<script type="text/javascript">
$(document).ready(function() {

});
</script>
<style>

</style>

<!-- content -->
<div id="main_content" class="ui stackable grid">

  <!-- main content -->
  <div class="ui twelve wide column">

    <div class="ui segment">
      <!-- welcome message -->
      <div class="ui grid">
        <div class="ten wide column">
          <h1 class="ui header">
            <?= $title ?>
            <?php if ($auth_level >= 9 || $is_event_manager): //admin required.?>
              <a class="ui icon blue navs_popup event_name_edit_button" data-content="Edit name" data-position="top left">
                <i class="write icon" style="position:relative;top:-10px;font-size:0.6em;cursor:pointer;"></i>
              </a>
            <?php endif; ?>
          </h1>
        </div>
        <div class="six wide column">
          <a href="<?= base_url('event/view/' . $event['id'] . '/print') ?>" target="_blank" class="ui icon basic grey button tiny navs_popup" data-content="Print" data-position="top center">
            <i class="print icon"></i>
            Print schedule
          </a>
          <?php if ($auth_level >= 9 || $is_event_manager): //admin required.?>
            <button class="ui button green basic tiny" id="e_item_new_modal">
              <i class="add square icon"></i>
              Add item
            </button>
          <?php endif; ?>
        </div>
      </div>

      <!-- spacer -->
      <div style="width: 100%; height: 30px; display: block;"></div>

      <div class="ui grid">
        <!-- agenda table -->
        <table class="ui very basic small table">
          <thead>
            <tr>
              <th class="">Time</th>
              <th class="">Name</th>
              <th class="">Attachments</th>
              <?php if ($auth_level >= 9 || $is_event_manager): //admin required.?>
                <th class="">Delete</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($items as $item): ?>
              <?php if ($item['label']): ?>
                <tr>
                  <td colspan="<?= $auth_level >= 9 || $is_event_manager ? 4 : 3 ?>">
                    <div class="ui ribbon <?= $item['start_time'] < $event['date'] && date('d/m/Y', $item['start_time']) != date('d/m/Y', $event['date']) ? 'grey nav_italic' : 'teal' ?> label">
                      <?= date('l, F jS', $item['start_time']) ?>
                    </div>
                  </td>
                </tr>
              <?php endif; ?>
              <tr class="<?= $item['start_time'] < $event['date'] ? 'nav_italic active' : '' ?> ">
                <!-- time -->
                <td>
                  <?= date('g:ia', $item['start_time']) ?>
                </td>
                <!-- name -->
                <td>
                  <?= $auth_level >= 9 || $is_event_manager ? '<a href="javascript:void(0)" class="e_item_edit_modal_button" style="font-weight: bold;">' : '<div style="font-weight: bold;">' ?>
                    <!-- title/song-info -->
                    <?php if ($item['type'] == 'song'): ?>
                      <?= $item['song']['title'] . ' - ' . $item['arrangement']['artist'] . ' [' . $item['arrangement_key'] . ']' ?>
                    <?php else: ?>
                      <?= $item['title'] ?>
                    <?php endif; ?>

                    <?= $auth_level >= 9 || $is_event_manager ? '</a>' : '</div>' ?>
                    <?php
                    if ($auth_level >= 9 || $is_event_manager): //admin required.
                      $item['time'] = date('H:i', $item['start_time']);
                      $item['date'] = date('Y/m/d', $item['start_time']);
                      ?>
                      <div class="hidden" style="display: none;"><?= json_encode($item) ?></div>
                    <?php endif; ?>

                    <div class="sub header"><?= $item['memo'] ?></div>
                  </td>
                  <!-- attachments -->
                  <td>
                    <?php if ($item['type'] == 'song'): ?>
                      <!-- to song page -->
                      <a class="ui icon mini button teal navs_popup" target="_blank" href="<?= base_url('music/view/' . $item['song']['id']) ?>" data-content="<?= $item['song']['title'] ?>" data-position="top center">
                        <i class="music icon"></i>
                      </a>
                      <?php if ($item['arrangement']['video'] != ''): ?>
                        <!-- youtube -->
                        <a class="ui icon mini button basic red navs_popup" target="_blank" href="<?= $item['arrangement']['video'] ?>" data-content="Video" data-position="top center">
                          <i class="play icon"></i>
                        </a>
                      <?php endif; ?>
                      <?php if (isset($item['arrangement']['audio']['link'])): ?>
                        <!-- audio file -->
                        <a class="ui icon mini button basic teal navs_popup" target="_blank" href="<?= base_url() . $item['arrangement']['audio']['link'] ?>" data-content="Audio File" data-position="top center">
                          <i class="volume up icon"></i>
                        </a>
                      <?php endif; ?>
                      <?php if (isset($item['arrangement']['lyrics']['link'])): ?>
                        <!-- lyrics -->
                        <a class="ui icon mini button basic grey navs_popup" target="_blank" href="<?= base_url() . $item['arrangement']['lyrics']['link'] ?>" data-content="Lyrics" data-position="top center">
                          <i class="align left icon"></i>
                        </a>
                      <?php endif; ?>
                      <?php foreach ($item['arrangement']['song_keys'] as $song_key): ?>
                        <!-- chord charts -->
                        <a class="ui mini button basic grey navs_popup" target="_blank" href="<?= base_url() . $song_key['media']['link'] ?>" data-content="Chord Chart (<?= $song_key['key'] ?>)" data-position="top center">
                          <?= $song_key['key'] ?>
                        </a>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </td>
                  <?php if ($auth_level >= 9 || $is_event_manager): //admin required.?>
                    <!-- delete -->
                    <td>
                      <a class="ui icon basic red button mini navs_popup confirm_api" data-action="event item delete" data-eiid="<?= $item['id'] ?>" data-content="Remove" data-position="top center">
                        <i class="trash icon"></i>
                      </a>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="<?= $auth_level >= 9 || $is_event_manager ? 4 : 3 ?>"></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

    <!-- right sidebar -->
    <div class="ui four wide column">
      <div class="ui segment">
        <h4 class="ui horizontal divider header">
          <i class="users icon"></i>
          People
        </h4>
        <div class="ui divided items" id="persons_list">
          <?php
          foreach ($people as $person):
            switch ($person['confirmed']) {
              case 'confirmed':
              $confirmed = 'green checkmark';
              $conf_text = "Confirmed";
              break;
              case 'denied':
              $confirmed = 'red remove';
              $conf_text = "Denied";
              break;
              default:
              $confirmed = 'grey help';
              $conf_text = "Unknown";
              break;
            }
            ?>
            <div class="item" id="person_<?= $person['user_id'] ?>">
              <i class="corner <?= $confirmed ?> icon navs_popup" data-content="<?= $conf_text ?>" data-position="top center"></i>
              <div class="middle aligned content">
                <a href="javascript:void(0)" class="ui people_edit_modal_link"><b><?= $person['first_name'] . ' ' . $person['last_name'] ?></b></a>
                <span class="hidden" style="display: none;"><?=
                json_encode([
                  'name' => $person['first_name'] . ' ' . $person['last_name'],
                  'user_id' => $person['user_id'],
                  'roles' => $person['roles']
                ])
                ?></span>
                <?= implode(', ', $person['roles']) ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php if (count($people) == 0): ?>
          <div class="ui error message">"help me obi-wan kenobi. you're my only hope!" ~luke</div>
        <?php endif; ?>
        <div class="ui centered grid">
          <div class="column">
            <button class="ui button green basic tiny person_new_modal_button">
              <i class="add square icon"></i>
              Add person
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php
  if ($auth_level >= 9 || $is_event_manager):
    $this->load->view('modal/event_item_add');
    $this->load->view('modal/event_item_edit');
    $this->load->view('modal/event_name_edit');
    $this->load->view('modal/person_add');
    $this->load->view('modal/person_edit');
  endif;

  $this->load->view('template/footer');
