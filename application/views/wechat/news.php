<xml>
    <ToUserName><![CDATA[<?php echo $from_user_name?>]]></ToUserName>
    <FromUserName><![CDATA[<?php echo $to_user_name?>]]></FromUserName>
    <CreateTime><?php echo $time?></CreateTime>
    <MsgType><![CDATA[news]]></MsgType>
    <ArticleCount><?php echo $count?></ArticleCount>
    <Articles>
        <?php if(is_array($data)) foreach($data as $item) {?>
        <item>
            <Title><![CDATA[<?php echo $item['title']?>]]></Title>
            <Description><![CDATA[<?php echo $item['description']?>]]></Description>
            <PicUrl><![CDATA[<?php echo $item['pic_url']?>]]></PicUrl>
            <Url><![CDATA[<?php echo $item['url']?>]]></Url>
        </item>
        <?php } ?>
    </Articles>
</xml>