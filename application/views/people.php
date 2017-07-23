<?php $this->load->view('template/header'); ?>

<script>
$(document).ready(function() {
  $(".resend_button").api({
    url: '<?= base_url('ajax/resend-user-confirmation') ?>/{uid}',
    on: 'click'
  });
  $(".ui.archived.checkbox").checkbox({
    onChange: function () {
      $(this).closest('form').submit();
    }
  });
});
</script>

<!-- content -->
<div id="main_content" class="ui stackable grid">

  <!-- main content -->
  <div class="ui twelve wide column">

    <div class="ui segment">
      <!-- welcome message -->
      <div class="ui grid">
        <div class="eight wide column">
          <h1 class="ui header">
            People Center
            <div class="sub header">Look at all of those friends you've made!</div>
          </h1>
        </div>
        <div class="eight wide column">
          <?php if ($auth_level >= 9): //admin required. modal included below   ?>
            <div class="ui grid">
              <div class="ui eight wide column">
                <form class="ui form" method="get" action="<?= base_url('user/people') ?>">
                  <div class="ui toggle archived checkbox">
                    <input type="checkbox" name="archived" <?= $show_archived ? 'checked' : '' ?>>
                    <label>Show archived</label>
                  </div>
                </form>
              </div>
              <div class="ui eight wide column">
                <button class="ui button green basic tiny" id="new_user_modal_button">
                  <i class="add square icon"></i>
                  Add new user
                </button>
              </div>
            </div>
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
              <th class="">Role</th>
              <th class="">First</th>
              <th class="">Last</th>
              <th class="">Contact</th>
              <th class="">Last Login</th>
              <th class="">Last Scheduling</th>
              <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                <th class="">Actions</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td>
                  <?= auth_role($user['auth_level']) ?>
                </td>
                <td>
                  <?= $user['first_name'] ?>
                </td>
                <td>
                  <?= $user['last_name'] ?>
                </td>
                <td>
                  <div class="ui icon buttons tiny">
                    <a href="mailto:<?= $user['email'] ?>" class="ui basic button tiny navs_popup" data-content="<?= $user['email'] ?>" data-position="top center">
                      <i class="mail icon"></i>
                    </a>
                    <?php if ($user['phone']): ?>
                      <a class="ui basic button tiny navs_popup" data-content="<?= format_phone($user['phone']) ?>" data-position="top center" href="tel:<?= $user['phone'] ?>">
                        <i class="phone icon"></i>
                      </a>
                    <?php endif; ?>
                  </div>
                </td>
                <td>
                  <?= $user['last_login'] ? date('D, M jS g:ia', strtotime($user['last_login']) + $_SESSION['organization_data']['offset']) : ($auth_level >= 9 ? '<div class="ui small basic orange button resend_button" data-uid="' . $user['user_id'] . '">Resend</div>' : 'N/A') ?>
                </td>
                <td>
                  <?= ($user['last_scheduling'] !== FALSE ? date('D, M jS', $user['last_scheduling']) : 'N/A') ?>
                </td>
                <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                  <td>
                    <?php if ($user['auth_level'] < 10): ?>
                      <a class="ui icon basic red button tiny <?= $user['user_id'] == $auth_user_id || $user['auth_level'] == 1 ? 'disabled' : 'navs_popup confirm_api ' ?>" data-action="user ban" data-uid="<?= $user['user_id'] ?>" data-content="Make Banned" data-position="top center">
                        <i class="ban icon"></i>
                      </a>
                      <a class="ui icon basic grey button tiny <?= $user['user_id'] == $auth_user_id || $user['auth_level'] == 2 ? 'disabled' : 'navs_popup confirm_api ' ?>" data-action="user archive" data-uid="<?= $user['user_id'] ?>" data-content="Archive User" data-position="top center">
                        <i class="archive icon"></i>
                      </a>
                      <a class="ui icon basic orange button tiny <?= $user['user_id'] == $auth_user_id || $user['auth_level'] == 5 ? 'disabled' : 'navs_popup confirm_api ' ?>" data-action="user make viewer" data-uid="<?= $user['user_id'] ?>" data-content="Make Viewer" data-position="top center">
                        <i class="unhide icon"></i>
                      </a>
                      <a class="ui icon basic blue button tiny <?= $user['user_id'] == $auth_user_id || $user['auth_level'] == 9 ? 'disabled' : 'navs_popup confirm_api ' ?>" data-action="user make admin" data-uid="<?= $user['user_id'] ?>" data-content="Make Admin" data-position="top center">
                        <i class="unlock icon"></i>
                      </a>
                    <?php else: ?>
                      <em>Insufficient privileges</em>
                    <?php endif; ?>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="<?= $auth_level >= 9 ? 7 : 6 ?>">
              </th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

  <?php $this->load->view('template/sidebar'); ?>
</div>


<?php
if ($auth_level >= 9):
  $this->load->view('modal/user_new');
endif;

$this->load->view('template/footer');
