<?php $this->load->view('control/public/head');?>
<div class="pd-20">
    <form action="<?php echo current_url()?>" method="post" class="form form-horizontal" id="form-add">
        <?php if(isset($info)){?>
            <div class="row cl">
                <label class="form-label col-3">公众号ID</label>
                <div class="formControls col-6"><?php echo $info['id']?></div>
                <input type="hidden" name="id" value="<?php echo $info['id']?>"/>
            </div>
        <?php }?>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>公众号名称：</label>
            <div class="formControls col-6">
                <input type="text" class="input-text" value="<?php echo isset($info['title']) ? $info['title'] : '';?>" placeholder="" id="" name="title" datatype="*2-32" nullmsg="公众号名称不能为空">
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>认证TOKEN：</label>
            <div class="formControls col-6">
                <input type="text" class="input-text" value="<?php echo isset($info['token']) ? $info['token'] : '';?>" placeholder="" id="" name="token" datatype="s2-16" nullmsg="认证TOKEN不能为空">
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>APP_ID：</label>
            <div class="formControls col-6">
                <input type="text" class="input-text" value="<?php echo isset($info['app_id']) ? $info['app_id'] : '';?>" placeholder="" id="" name="app_id" datatype="s10-32" nullmsg="APP_ID不能为空">
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-3"><span class="c-red">*</span>APP_SECRET：</label>
            <div class="formControls col-6">
                <input type="text" class="input-text" value="<?php echo isset($info['app_secret']) ? $info['app_secret'] : '';?>" placeholder="" id="" name="app_secret" datatype="s32-32" nullmsg="APP_SECRET不能为空">
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
            <label class="form-label col-3">状态：</label>
            <div class="formControls col-6">
                <span class="radio-box">
                    <input type="radio" value="1" name="status" id="radio-on-checked" checked>
                    <label for="radio-on-checked" >启用</label>
                    <input type="radio" value="0" name="status" id="radio-off-checked" <?php echo (isset($info['status']) && $info['status'] == 0) ? 'checked' : ''?>>
                    <label for="radio-off-checked">禁用</label>
                </span>
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