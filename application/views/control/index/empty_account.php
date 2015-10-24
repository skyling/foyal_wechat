<?php $this->load->view('control/public/head');?>
<div class="pd-20">
<?php if(isset($empty_account) && $empty_account == TRUE ) {?>
    <div class="text-c mt-50">您目前系统暂无微信公众平台账号，请先添加账号<br/>
        <button class="btn btn-primary" onclick="layer_show('添加公众号','<?php echo site_url('control/account/add')?>')">添加公众号</button></div>
<?php } ?>
</div>
<?php $this->load->view('control/public/js')?>
</body>
</html>