<?php $this->load->view('template/header'); ?>

<!-- content -->
<div class="ui middle aligned center aligned grid">
    <div class="ui segment">

        <?php $this->load->view('template/rail'); ?>

        <!-- main content -->
        <div id="main_content">
            <div class="column">

                <!-- welcome message -->
                <h1 class="ui center aligned header">
                    Welcome, Zach Smith
                    <div class="sub header">Here is the upcoming schedule</div>
                </h1>

                <!-- spacer -->
                <div style="width: 100%; height: 20px; display: block;"></div>

                <div class="ui grid">
                    <!-- agenda table -->
                    <table class="ui very basic table">
                        <thead>
                            <tr>
                                <th class="">Event</th>
                                <th class="">Date</th>
                                <th class="">Your Role</th>
                                <th class="">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- agenda template -->
                            <tr>
                                <td>
                                    <a href="#">
                                        Nav Night
                                    </a>
                                </td>
                                <td>Aug 14th</td>
                                <td>Lead Guitar, Vocals</td>
                                <td>
                                    <div class="ui icon buttons tiny">
                                        <button class="ui button basic blue tiny navs_popup" data-content="View" data-position="top center">
                                            <i class="unhide icon"></i>
                                        </button>
                                        <button class="ui button basic blue tiny navs_popup" data-content="Edit (admin)" data-position="top center">
                                            <i class="write icon"></i>
                                        </button>
                                    </div>
                                    <div class="ui icon buttons tiny">
                                        <button class="ui button basic green tiny navs_popup" data-content="Confirm" data-position="top center">
                                            <i class="check icon"></i>
                                        </button>
                                        <button class="ui button basic red tiny navs_popup" data-content="Deny" data-position="top center">
                                            <i class="close icon"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- end template -->
                            <!-- agenda template -->
                            <tr>
                                <td>
                                    <a href="#">
                                        Nav Night
                                    </a>
                                </td>
                                <td>Aug 14th</td>
                                <td>Lead Guitar, Vocals</td>
                                <td>
                                    <div class="ui icon buttons tiny">
                                        <button class="ui button basic blue tiny navs_popup" data-content="View" data-position="top center">
                                            <i class="unhide icon"></i>
                                        </button>
                                        <button class="ui button basic blue tiny navs_popup" data-content="Edit (admin)" data-position="top center">
                                            <i class="write icon"></i>
                                        </button>
                                    </div>
                                    <div class="ui icon buttons tiny">
                                        <button class="ui button basic green tiny navs_popup" data-content="Confirm" data-position="top center">
                                            <i class="check icon"></i>
                                        </button>
                                        <button class="ui button basic red tiny navs_popup" data-content="Deny" data-position="top center">
                                            <i class="close icon"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- end template -->
                            <!-- agenda template -->
                            <tr>
                                <td>
                                    <a href="#">
                                        Nav Night
                                    </a>
                                </td>
                                <td>Aug 14th</td>
                                <td>Lead Guitar, Vocals</td>
                                <td>
                                    <div class="ui icon buttons tiny">
                                        <button class="ui button basic blue tiny navs_popup" data-content="View" data-position="top center">
                                            <i class="unhide icon"></i>
                                        </button>
                                        <button class="ui button basic blue tiny navs_popup" data-content="Edit (admin)" data-position="top center">
                                            <i class="write icon"></i>
                                        </button>
                                    </div>
                                    <div class="ui icon buttons tiny">
                                        <button class="ui button basic green tiny navs_popup" data-content="Confirm" data-position="top center">
                                            <i class="check icon"></i>
                                        </button>
                                        <button class="ui button basic red tiny navs_popup" data-content="Deny" data-position="top center">
                                            <i class="close icon"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- end template -->
                        <tfoot>
                            <tr><th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('template/footer');