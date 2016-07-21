<?php $this->load->view('template/header'); ?>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>

<!-- content -->
<div id="main_content" class="ui stackable grid">

    <!-- main content -->
    <div class="ui twelve wide column">

        <div class="ui segment">
            <!-- welcome message -->
            <div class="ui grid">
                <div class="twelve wide column">
                    <h1 class="ui header">
                        People Center
                        <div class="sub header">Look at all of those friends you've made!</div>
                    </h1>
                </div>
                <div class="four wide column">
                    <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                        <button class="ui button green basic tiny" id="user_new_modal">
                            <i class="add square icon"></i>
                            Add new user
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- spacer -->
            <div style="width: 100%; height: 30px; display: block;"></div>

            <div class="ui grid">
                <!-- agenda table -->
                <table class="ui very basic table">
                    <thead>
                        <tr>
                            <th class="">Role</th>
                            <th class="">First</th>
                            <th class="">Last</th>
                            <th class="">Contact</th>
                            <th class="">Last Login</th>
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
                                        <button class="ui basic button tiny navs_popup" data-content="<?= $user['email'] ?>" data-position="top center">
                                            <i class="mail icon"></i>
                                        </button>
                                        <button class="ui basic button tiny navs_popup" data-content="<?= format_phone($user['phone']) ?>" data-position="top center">
                                            <i class="phone icon"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $time = strtotime($user['last_login']);
                                    echo date('l, F jS g:ia', $time + $_SESSION['organization_data']['offset']);
                                    ?>
                                </td>
                                <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                                    <td>
                                        <?php if ($user['auth_level'] < 10): ?>
                                            <a class="ui icon basic red button tiny <?= $user['user_id'] == $auth_user_id ? 'disabled' : 'navs_popup confirm_api ' ?>" data-action="user ban" data-sid="" data-content="Make Banned" data-position="top center">
                                                <i class="ban icon"></i>
                                            </a>
                                            <a class="ui icon basic grey button tiny <?= $user['user_id'] == $auth_user_id ? 'disabled' : 'navs_popup confirm_api ' ?>" data-action="user archive" data-sid="" data-content="Archive User" data-position="top center">
                                                <i class="archive icon"></i>
                                            </a>
                                            <a class="ui icon basic orange button tiny <?= $user['user_id'] == $auth_user_id ? 'disabled' : 'navs_popup confirm_api ' ?>" data-action="user make viewer" data-sid="" data-content="Make Viewer" data-position="top center">
                                                <i class="unhide icon"></i>
                                            </a>
                                            <a class="ui icon basic blue button tiny <?= $user['user_id'] == $auth_user_id ? 'disabled' : 'navs_popup confirm_api ' ?>" data-action="user make viewer" data-sid="" data-content="Make Admin" data-position="top center">
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
                            <th colspan="<?= $auth_level >= 9 ? 6 : 5 ?>">
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
