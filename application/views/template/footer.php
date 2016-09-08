
<?php $this->load->view('modal/confirm'); ?>

<!-- spacer -->
<div style="width: 100%; height: 30px; display: block;"></div>
<div class="ui bottom fixed inverted menu" style="background-color: black;">
    <a href="http://www.medialusions.com" target="_blank" class="item" style="color: #999999; margin: auto auto; font-size: 0.8rem;">
        Copyright &copy; <?= date('Y') > 2016 ? '2016-' . date('Y') : '2016' ?> Medialusions Interactive, Inc.
        <br>
        ({elapsed_time} sec, {memory_usage}, <?= NAVS_VERSION ?>)
    </a>
</div>
</body>

<link rel="stylesheet" href="<?= base_url(); ?>js/periodpicker/build/jquery.periodpicker.min.css">
<script src="<?= base_url(); ?>js/periodpicker/build/jquery.periodpicker.full.min.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>js/periodpicker/build/jquery.timepicker.min.css">
<script src="<?= base_url(); ?>js/periodpicker/build/jquery.timepicker.min.js"></script>

</html>
