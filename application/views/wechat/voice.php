<xml>
    <ToUserName><![CDATA[<?php echo $from_user_name?>]]></ToUserName>
    <FromUserName><![CDATA[<?php echo $to_user_name?>]]></FromUserName>
    <CreateTime><?php echo $time?></CreateTime>
    <MsgType><![CDATA[voice]]></MsgType>
    <Voice>
        <MediaId><![CDATA[<?php echo $meida_id?>]]></MediaId>
    </Voice>
</xml>