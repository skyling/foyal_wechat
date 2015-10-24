<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo HUI?>lib/html5.js"></script>
    <script type="text/javascript" src="<?php echo HUI?>lib/respond.min.js"></script>
    <script type="text/javascript" src="<?php echo HUI?>lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="<?php echo HUI?>css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo HUI?>css/H-ui.login.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo HUI?>css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo HUI?>lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>后台登录 - CODER集中营</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>
<body>
<!--<div class="header"></div>-->
<div class="loginWraper">
    <div id="loginform" class="loginBox">
        <form class="form form-horizontal" action="<?php echo current_url()?>" method="post">
            <input type="hidden" name="auth" value="<?php echo $auth?>"/>
            <div class="row cl">
                <label class="form-label col-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-8">
                    <input id="" name="username" type="text" placeholder="账户" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-8">
                    <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
                </div>
            </div>
            <div class="row">
                <div class="formControls col-8 col-offset-3">
                    <label for="online">
                        <input type="checkbox" name="online" id="online" value="">
                        使我保持登录状态</label>
                </div>
            </div>
            <div class="row">
                <div class="formControls col-8 col-offset-3">
                    <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="footer">Copyright CODER风向标</div>
<script type="text/javascript" src="<?php echo HUI?>lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo HUI?>js/H-ui.js"></script>
<script>
   $(document).ready(function(){
       var flag  = <?php echo $flag?>;
       if(!flag)Huimodal_alert('登陆信息错误，请重试！',2000);
   });
</script>
</body>
</html>