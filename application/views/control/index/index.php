<?php $this->load->view('control/public/head')?>
<?php $this->load->view('control/public/header')?>
<?php $this->load->view('control/aside/system_aside')?>
    <div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box">
        <div id="Hui-tabNav" class="Hui-tabNav">
            <div class="Hui-tabNav-wp">
                <ul id="min_title_list" class="acrossTab cl">
                    <li class="active"><span title="我的桌面" data-href="welcome.html">我的桌面</span><em></em></li>
                </ul>
            </div>
            <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
        </div>
        <div id="iframe_box" class="Hui-article">
            <div class="show_iframe">
                <div style="display:none" class="loading"></div>
            </div>
            <?php if(isset($empty_account) && $empty_account == TRUE ) {?>
                <div class="text-c mt-50">您目前系统暂无微信公众平台账号，请先添加账号<br/>
                    <button class="btn btn-primary" onclick="layer_show('添加公众号','<?php echo site_url('control/account/add')?>')">添加公众号</button></div>
            <?php } ?>
        </div>
    </section>
<?php $this->load->view('control/public/js')?>
<?php $this->load->view('control/public/footer')?>