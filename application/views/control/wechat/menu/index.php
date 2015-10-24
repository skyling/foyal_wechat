<?php $this->load->view('control/public/head');?>
<?php $this->load->view('control/public/small-nav');?>
<div class="pd-20">
    <div id="tab_foyal" class="HuiTab">
        <div class="tabBar cl"><span>当前菜单</span><span>历史菜单</span></div>
        <div class="tabCon">
            <div class="panel panel-default">
                <div class="panel-header">当前菜单
                    <button class="btn radius btn-secondary r mr-20" style="margin-top:-5px" title="新增菜单项" onclick="layer_show('添加菜单','<?php echo site_url('control/wechat/menu/add')?>')"><i class="Hui-iconfont">&#xe600;</i> 添加菜单</button>
                    <button class="btn radius btn-danger r mr-20" style="margin-top:-5px" title="应用菜单到公众号" onclick="layer_show('应用菜单','<?php echo site_url('control/wechat/menu/set_menu')?>')" ><i class="Hui-iconfont">&#xe63c;</i> 应用菜单</button>
                    <a class="btn radius r mr-20 btn-warning ajax-get" style="margin-top:-5px" title="从公众号上拉取当前菜单" href="<?php echo site_url('control/service/get_menu')?>"><i class="Hui-iconfont">&#xe645;</i> 拉取菜单</a>
                </div>
                <div class="panel-body">
                    <table class="table table-border table-bg table-bordered">
                        <thead>
                        <tr><th colspan="2">菜单名称</th><th rowspan="2">类型</th><th rowspan="2">键值类型</th><th rowspan="2">键值</th><th rowspan="2">排序[点击修改]</th><th rowspan="2">描述</th><th rowspan="2">状态</th><th rowspan="2">操作</th></tr>
                        <tr><th>一级菜单</th><th>二级菜单</th></tr>
                        </thead>
                        <tbody>
                        <?php if(isset($menu) && count($menu) > 0){
                            foreach($menu as $item) {?>
                            <tr class="success">
                                <th><?php echo $item['name']?></th>
                                <th></th>
                                <td><?php echo $item['type']?></td>
                                <td><?php echo $item['key']?></td>
                                <td><?php echo $item['value']?></td>
                                <td class="input-sort"><span class="value"><?php echo $item['sort']?></span><input type="text" data-id="<?php echo $item['id']?>" id="" style="display: none"/></td>
                                <td><?php echo $item['description']?></td>
                                <td><?php echo ($item['status']==1 ? '<span class="label label-success radius">已启用</span>' : '<span class="label label-danger radius">已禁用</span>')?></td>
                                <td style="font-size:16px;">
                                    <a title="<?php echo($item['status'] == 1 ? '禁用' : '启用')?>" href="<?php echo site_url('control/wechat/menu/set_status').'/'.$item['id'].'/'.abs(1-$item['status'])?>" class="ml-5 ajax-get" style="text-decoration:none"><i class="Hui-iconfont"><?php echo($item['status'] == 1 ? '&#xe6de;' : '&#xe6dc;')?></i></a>
                                    <a style="text-decoration:none" onclick="layer_show('编辑菜单项','<?php echo site_url('control/wechat/menu/edit/'.$item['id'])?>')" href="javascript:;" title="编辑" ><i class="Hui-iconfont">&#xe647;</i></a>
                                    <a style="text-decoration:none" class="ajax-get" href="<?php echo site_url('control/wechat/menu/delete/'.$item['id'])?>" title="删除" ><i class="Hui-iconfont">&#xe6e2;</i></a>
                                </td>
                            </tr>
                            <?php if(isset($item['sub_button'])){
                                foreach($item['sub_button'] as $s_item){?>
                                <tr>
                                    <th></th>
                                    <th><?php echo $s_item['name']?></th>
                                    <td><?php echo $s_item['type']?></td>
                                    <td><?php echo $s_item['key']?></td>
                                    <td><?php echo $s_item['value']?></td>
                                    <td class="input-sort"><span class="value"><?php echo $s_item['sort']?></span><input type="text" data-id="<?php echo $s_item['id']?>" id="" style="display: none"/></td>
                                    <td><?php echo $s_item['description']?></td>
                                    <td><?php echo(($s_item['status']==1 && $item['status']==1) ? '<span class="label label-success radius">已启用</span>' : '<span class="label label-danger radius">已禁用</span>' )?></td>
                                    <td  style="font-size:16px;">
                                        <?php if($item['status']==1) {?>
                                        <a title="<?php echo($s_item['status'] == 1 ? '禁用' : '启用')?>" href="<?php echo site_url('control/wechat/menu/set_status').'/'.$s_item['id'].'/'.abs(1-$s_item['status'])?>" class="ml-5 ajax-get" style="text-decoration:none"><i class="Hui-iconfont"><?php echo($s_item['status'] == 1 ? '&#xe6de;' : '&#xe6dc;')?></i></a>
                                        <?php }?>
                                        <a style="text-decoration:none" onclick="layer_show('编辑菜单项','<?php echo site_url('control/wechat/menu/edit/'.$s_item['id'])?>')" href="javascript:;" title="编辑" ><i class="Hui-iconfont">&#xe647;</i></a>
                                        <a style="text-decoration:none" class="ajax-get" href="<?php echo site_url('control/wechat/menu/delete/'.$s_item['id'])?>" title="删除" ><i class="Hui-iconfont">&#xe6e2;</i></a>
                                    </td>
                                </tr>
                            <?php } }?>
                            <?php }
                                } else {
                                echo "<tr><td colspan='9'>菜单为空！！若公众号已设置菜单请点击拉取菜单!或者请添加菜单项!</td></tr>";
                                } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tabCon">
            <div class="panel panel-default">
                <div class="panel-header">历史菜单</div>
                <div class="panel-body">
                    <div class="mt-20">
                        <table class="table table-border table-bordered table-hover table-bg table-sort">
                            <thead>
                            <tr class="text-c">
                                <th>ID</th>
                                <th>内容</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($history_menu))foreach( $history_menu as $item) {?>
                                <tr class="text-c">
                                    <td><?php echo $item['id']?></td>
                                    <td width="70%"><?php print_r($item['content'])?></td>
                                    <td><?php echo date('Y-m-d H:i:s', $item['create_time'])?></td>
                                    <td>
                                        <button class="btn radius btn-danger r mr-20" style="margin-top:-5px" onclick="layer_show('应用菜单','<?php echo site_url('control/wechat/menu/set_menu').'/'.$item['id']?>')" ''><i class="Hui-iconfont">&#xe63c;</i> 应用菜单</button>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                        <?php $this->load->view('control/public/paginate')?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('control/public/js')?>
<script type="text/javascript">
    $(function(){
        $.Huitab("#tab_foyal .tabBar span","#tab_foyal .tabCon","current","mousemove ","<?php echo ($p > 1 ? 1 : 0)?>");
        change_sort();
    });

    var change_sort = function(){
        $('.input-sort .value').click(function(){
            var value = $(this);
            value.hide();
            $(this).next('input').attr('size','2').val(value.html()).show().focus().select();
        });

        $('.input-sort input').blur(function(){
            var inputs = $(this);
            if(!inputs.val().match(/^\d{1,3}$/)){
                inputs.select();
                layer.msg('请输出入数字',{icon: 5,time:1000});
                return;
            }
            if(inputs.val()==inputs.prev().html()){
                inputs.hide().prev().show();
                return;
            }
            var url = '<?php echo site_url('control/wechat/menu/change_sort')?>/' + $(this).attr('data-id') + '/' + $(this).val();
            ajaxget(url, function(data){
                data = eval("("+data+")");
                if(data.status=='y'){
                    inputs.hide().prev().html(inputs.val()).show();
                }else{
                    layer.msg(msg.info,{icon: 5,time:1000});
                }
            });


        });
    }
</script>
</body>
</html>