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
                        Music Center
                        <div class="sub header">Those are some neat tunes you got there</div>
                    </h1>
                </div>
                <div class="four wide column">
                    <?php if ($auth_level >= 9): //admin required. modal included below   ?>
                        <button class="ui button green basic tiny" id="music_new_modal">
                            <i class="add square icon"></i>
                            Add new song
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
                            <th class="">Title</th>
                            <th class="">Tags</th>
                            <th class="">Arrangements</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($songs as $song): ?>
                            <tr>
                                <td>
                                    <a href="<?= base_url('music/view/' . $song['id']) ?>"><?= $song['title'] ?></a>
                                </td>
                                <td>
                                    <?php
                                    $tags = json_decode($song['tags'], TRUE);
                                    echo implode(', ', $tags);
                                    ?>
                                </td>
                                <td>
                                    <?= count($song['arrangement']) ?> arrangements
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <tfoot>
                        <tr><th></th>
                            <th></th>
                            <th></th>
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
    $this->load->view('modal/song_new');
endif;

$this->load->view('template/footer');
