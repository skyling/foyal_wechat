<?php $this->load->view('control/public/head');?>
<div class="pd-20">
    <form action="<?php echo current_url()?>" method="post" enctype="multipart/form-data" class="form form-horizontal" id="form-add">
        <?php if(isset($info)){?>
            <div class="row cl">
                <label class="form-label col-3">内容ID：</label>
                <div class="formControls col-6"><?php echo $info['id']?></div>
                <input type="hidden" name="id" value="<?php echo $info['id']?>"/>
            </div>
        <?php }?>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>父级菜单：</label>
            <div class="formControls col-6"> <span class="select-box">
                <select class="select" name="pid" id="pid">
                    <option value="0">顶级菜单</option>
                    <?php if(is_array($parent_menu))foreach($parent_menu as $item){
                        echo '<option value="'.$item['id'].'" '.((isset($info['pid']) && $item['id']== $info['pid']) ? 'selected' : '').' title="'.$item['description'].'">'.$item['name'].'--【'.$item['value'].'】</option>';
                    }?>
                </select>
                </span> </div>
            <div class="col-3"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>菜单名称：</label>
            <div class="formControls col-6">
                <input type="text" class="input-text" value="<?php echo isset($info['name']) ? $info['name'] : '';?>" placeholder="" id="" name="name" datatype="*2-255" nullmsg="菜单名称不能为空">
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>菜单类型：</label>
            <div class="formControls col-6"> <span class="select-box">
                <select class="select" name="type_id" id="type">
                    <?php if(is_array($type))foreach($type as $item){
                        echo '<option value="'.$item['id'].'" '.((isset($info['type_id']) && $item['id']== $info['type_id']) ? 'selected' : '').' title="'.$item['description'].'" data-key="'.$item['content'].'" >'.$item['title'].'--【'.$item['type'].'】</option>';
                    }?>
                </select>
                </span> </div>
            <div class="col-3"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>键值<span id="key-name"></span>：</label>
            <div class="formControls col-6">
                <input type="text" class="input-text" value="<?php echo isset($info['value']) ? $info['value'] : '';?>" placeholder="" id="" name="value" datatype="*2-32" nullmsg="键值不能为空">
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-3">描述：</label>
            <div class="formControls col-5">
                <textarea name="description" cols="" rows="" class="textarea"  placeholder="说点什么...最多输入100个字符" datatype="*0-100" dragonfly="true" ignore="ignore" onKeyUp="textarealength(this,100)"><?php echo isset($info['description']) ? $info['description'] : '';?></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
            </div>
            <div class="col-4"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>排序：</label>
            <div class="formControls col-6">
                <input type="text" class="input-text" value="<?php echo isset($info['sort']) ? $info['sort'] : get_max('menu', 'sort')+1;?>" placeholder="" id="" name="sort" datatype="n1-5">
            </div>
            <div class="col-3"> </div>
        </div>
        <div class="row cl">
            <div class="col-9 col-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</div>
<?php $this->load->view('control/public/js')?>
<script type="text/javascript">

    var type_change = function(){
        $('#type').change(function(){
            $('#key-name').html($(this).find(':selected').attr('data-key'));
        });
    }
    $(function(){
        $("#form-add").Validform({
            tiptype:2,
            ajaxPost:true,
            callback:function(form){
                if(form.status == 'y'){
                    setTimeout(function(){
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.$('.btn-refresh').click();
                        parent.location.reload();
                        parent.layer.close(index);
                    },1000);
                }
            }
        });


        type_change();
    });
</script>
</body>
</html>