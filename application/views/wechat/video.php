<xml>
    <ToUserName><![CDATA[<?php echo $from_user_name?>]]></ToUserName>
    <FromUserName><![CDATA[<?php echo $to_user_name?>]]></FromUserName>
    <CreateTime><?php echo $time?></CreateTime>
    <MsgType><![CDATA[video]]></MsgType>
    <Video>
        <MediaId><![CDATA[<?php echo $media_id?>]]></MediaId>
        <Title><![CDATA[<?php echo $title?>]]></Title>
        <Description><![CDATA[<?php echo $description?>]]></Description>
    </Video>
</xml>