<xml>
    <ToUserName><![CDATA[<?php echo $from_user_name?>]]></ToUserName>
    <FromUserName><![CDATA[<?php echo $to_user_name?>]]></FromUserName>
    <CreateTime><?php echo $time?></CreateTime>
    <MsgType><![CDATA[music]]></MsgType>
    <Music>
        <Title><![CDATA[<?php echo $title?>]]></Title>
        <Description><![CDATA[<?php echo $description?>]]></Description>
        <MusicUrl><![CDATA[<?php echo $music_url?>]]></MusicUrl>
        <HQMusicUrl><![CDATA[<?php echo $hq_music_url?>]]></HQMusicUrl>
        <ThumbMediaId><![CDATA[<?php echo $thumb_media_id?>]]></ThumbMediaId>
    </Music>
</xml>