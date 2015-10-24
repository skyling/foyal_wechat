
<?php $this->load->view('control/public/head');?>
<div class="pd-20">
    <?php if(isset($info)) {?>
    <table class="table table-border table-bg table-bordered">
        <tr><th class="text-r active" width="20%">公众号ID</th><td class="success text-l"><?php echo $info['id']?></td></tr>
        <tr><th class="text-r active" width="20%">公众号名称</th><td class="success text-l"><?php echo $info['title']?></td></tr>
        <tr><th class="text-r active" width="20%">接入地址</th><td class="success text-l"><?php echo WECHAT_URL.$info['open_id']?></td></tr>
        <tr><th class="text-r active" width="20%">接口TOKEN</th><td class="success text-l"><?php echo $info['token']?></td></tr>
        <tr><th class="text-r active" width="20%">APP_ID</th><td class="success text-l"><?php echo $info['app_id']?></td></tr>
        <tr><th class="text-r active" width="20%">APP_SECRET</th><td class="success text-l"><?php echo $info['app_secret']?></td></tr>
        <tr><th class="text-r active" width="20%">ACCESS_TOKEN</th><td class="success text-l"><?php echo $info['access_token']?></td></tr>
        <tr><th class="text-r active" width="20%">ACCESS_TOKEN有效时间</th><td class="success text-l"><?php echo date('Y-m-d H:i:s', $info['token_time'])?></td></tr>
        <tr><th class="text-r active" width="20%">默认账号</th><td class="success text-l"><?php echo $info['default']==1 ? '<span class="label label-success  radius">默认账号</span>' : '<span class="label label-danger  radius">否</span>'?></td></tr>
        <tr><th class="text-r active" width="20%">描述</th><td class="success text-l"><?php echo $info['description']?></td></tr>
        <tr><th class="text-r active" width="20%">创建时间</th><td class="success text-l"><?php echo date('Y-m-d H:i:s', $info['create_time'])?></td></tr>
        <tr><th class="text-r active" width="20%">更新时间</th><td class="success text-l"><?php echo date('Y-m-d H:i:s', $info['update_time'])?></td></tr>
        <tr><th class="text-r active" width="20%">状态</th><td class="success text-l"><?php echo $info['status']==1 ? '<span class="label label-success  radius">开启</span>' : '<span class="label label-danger  radius">禁用</span>'?></td></tr>
    </table>
    <?php }?>
</div>
</body>
</html>