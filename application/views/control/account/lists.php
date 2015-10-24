<?php $this->load->view('control/public/head');?>
<?php $this->load->view('control/public/small-nav');?>
<div class="pd-20">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="<?php echo site_url('control/account/delete')?>" class="btn btn-danger radius ajax_del">
                <i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a class="btn btn-primary radius" onclick="layer_show('添加公众号','<?php echo site_url('control/account/add')?>')" href="javascript:;">
                <i class="Hui-iconfont">&#xe600;</i> 添加公众号</a>
        </span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th>公众号名称</th>
                <th>接入地址</th>
                <th>验证TOKEN</th>
                <th>APP_ID</th>
                <th>默认管理账号</th>
                <th>状态</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(isset($lists))foreach( $lists as $item) {?>
                <tr class="text-c">
                    <td><input type="checkbox" name="ids" value="<?php echo $item['id']?>"></td>
                    <td><?php echo $item['id']?></td>
                    <td><?php echo $item['title']?></td>
                    <td><?php echo WECHAT_URL.$item['open_id']?></td>
                    <td><?php echo $item['token']?></td>
                    <td><?php echo $item['app_id']?></td>
                    <td><span class="label label-<?php echo $item['default'] == 1 ? 'success' : 'danger'?>  radius"><?php echo $item['default'] == 1 ? '默认账号' : '否'?></span></td>
                    <td><span class="label label-<?php echo $item['status'] == 1 ? 'success' : 'danger'?>  radius"><?php echo $item['status'] == 1 ? '已启用' : '已禁用'?></span></td>
                    <td class="f-14">
                        <a title="详细信息" href="javascript:;" onclick="layer_show('详细信息','<?php echo site_url('control/account/detail/'.$item['id'])?>')" style="text-decoration:none"><i class="Hui-iconfont">&#xe616;</i></a>
                        <a title="编辑" href="javascript:;" onclick="layer_show('账号编辑','<?php echo site_url('control/account/edit/'.$item['id'])?>')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                        <a title="删除" href="<?php echo site_url('control/account/delete').'/'.$item['id']?>" class="ml-5 ajax-get" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                        <a title="<?php echo $item['default'] == 1 ? '取消默认' : '设为默认'?>" href="<?php echo site_url('control/account/set_default').'/'.$item['id'].'/'.abs(1-$item['default'])?>" class="ml-5 ajax-get" style="text-decoration:none"><i class="Hui-iconfont"><?php echo $item['default'] == 1 ? '&#xe608;' : '&#xe6a8;'?></i></a>
                        <a title="<?php echo $item['status'] == 1 ? '禁用' : '启用'?>" href="<?php echo site_url('control/account/set_status').'/'.$item['id'].'/'.abs(1-$item['status'])?>" class="ml-5 ajax-get" style="text-decoration:none"><i class="Hui-iconfont"><?php echo $item['status'] == 1 ? '&#xe6de;' : '&#xe6dc;'?></i></a>

                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?php $this->load->view('control/public/paginate')?>
    </div>
</div>
<?php $this->load->view('control/public/js')?>
</body>
</html>