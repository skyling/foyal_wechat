# Host: localhost  (Version: 5.6.21)
# Date: 2015-10-24 19:27:09
# Generator: MySQL-Front 5.3  (Build 4.118)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "fy_admin"
#

DROP TABLE IF EXISTS `fy_admin`;
CREATE TABLE `fy_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(256) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '类型',
  `login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `update_time` int(11) DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '会员状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员信息';

#
# Data for table "fy_admin"
#

/*!40000 ALTER TABLE `fy_admin` DISABLE KEYS */;
INSERT INTO `fy_admin` VALUES (1,'admin','6808f547ef6e5c8f17ffe4bd0c1dd8dcc84326f7cd289a430006632868b896e0',1,68,2130706433,1440985515,2130706433,1445681231,0,1);
/*!40000 ALTER TABLE `fy_admin` ENABLE KEYS */;

#
# Structure for table "fy_menu"
#

DROP TABLE IF EXISTS `fy_menu`;
CREATE TABLE `fy_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `wid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '微信ID',
  `pid` int(11) unsigned DEFAULT '0' COMMENT '父类ID',
  `type_id` int(11) unsigned DEFAULT '0' COMMENT '类型id',
  `name` varchar(64) DEFAULT '' COMMENT '名称',
  `value` varchar(64) DEFAULT '' COMMENT '键值',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='当前菜单';

#
# Data for table "fy_menu"
#

/*!40000 ALTER TABLE `fy_menu` DISABLE KEYS */;
INSERT INTO `fy_menu` VALUES (1,1,1,0,1,'主菜单1','MAIN_1','主菜单1',1,1),(2,1,1,0,1,'主菜单3','MAIN_3','MAIN_3',3,1),(3,1,1,0,4,'主菜单2','MAIN_2','MAIN_2',2,1),(4,1,1,1,5,'子菜单4','SUB_4','SUB_4',4,1),(5,1,1,1,2,'子菜单5','http://www.baidu.com','SUB_5',5,0),(6,1,1,1,2,'子菜单1','http://www.baidu.com','SUB_1',1,1),(7,1,1,2,2,'子菜单2','http://www.baidu.com','SUB_2',2,1),(9,1,1,1,2,'子菜单3','http://www.baidu.com','SUB_3',3,1),(10,1,1,0,1,'主菜单4','MAIN_4','MAIN_4',4,0),(11,1,1,2,2,'子菜单6','http://www.baidu.com','SUB_6',2,1),(69,1,15,0,1,'个人中心','',NULL,1,1),(70,1,15,69,1,'绑定/解绑','M1_BIND',NULL,1,1),(71,1,15,69,1,'借阅信息','M1_LEND',NULL,2,1),(72,1,15,69,1,'一键续借','M1_RENEW',NULL,3,1),(73,1,15,69,1,'个人信息','M1_SELF',NULL,4,1),(74,1,15,69,1,'预约/荐购','M1_APRE',NULL,5,1),(75,1,15,0,1,'服务中心','',NULL,2,1),(76,1,15,75,1,'书目检索','M2_SEARCH',NULL,1,1),(77,1,15,75,1,'阅读账单','M2_GRAD',NULL,2,1),(78,1,15,75,1,'资讯服务','M2_INFO',NULL,3,1),(79,1,15,75,1,'新生教育','M2_xinshengruguan',NULL,4,1),(80,1,15,75,1,'读者社区','M2_READER',NULL,5,1),(81,1,15,0,1,'资讯中心','',NULL,3,1),(82,1,15,81,1,'公告活动','M3_CALL',NULL,1,1),(83,1,15,81,1,'本馆新闻','M3_NEWS',NULL,2,1),(84,1,15,81,1,'导航地图','M3_MAP',NULL,3,1),(85,1,15,81,1,'常见问题','M3_ISSUE',NULL,4,1),(86,1,15,81,1,'关于我们','M3_ABOUT',NULL,5,1);
/*!40000 ALTER TABLE `fy_menu` ENABLE KEYS */;

#
# Structure for table "fy_menu_history"
#

DROP TABLE IF EXISTS `fy_menu_history`;
CREATE TABLE `fy_menu_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0' COMMENT '用户ID',
  `wid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '微信ID',
  `content` text NOT NULL COMMENT '菜单内容',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='菜单历史';

#
# Data for table "fy_menu_history"
#

/*!40000 ALTER TABLE `fy_menu_history` DISABLE KEYS */;
INSERT INTO `fy_menu_history` VALUES (1,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',1445249654),(2,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单1\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',1445249727),(3,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',1445353708),(4,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',0),(5,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',0),(6,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',0),(7,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',0),(8,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',0),(9,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',0),(10,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',0),(11,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',0),(12,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',0),(13,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"click\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"},{\"type\":\"view\",\"name\":\"子菜单5\",\"url\":\"http:\\/\\/www.baidu.com\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',0),(14,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单1\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"pic_sysphoto\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',1445435781),(15,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单1\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"pic_sysphoto\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',1445443682),(16,1,1,'{\"button\":[{\"name\":\"主菜单1\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单1\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单3\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"pic_sysphoto\",\"name\":\"子菜单4\",\"key\":\"SUB_4\"}]},{\"type\":\"scancode_waitmsg\",\"name\":\"主菜单2\",\"key\":\"MAIN_2\"},{\"name\":\"主菜单3\",\"sub_button\":[{\"type\":\"view\",\"name\":\"子菜单2\",\"url\":\"http:\\/\\/www.baidu.com\"},{\"type\":\"view\",\"name\":\"子菜单6\",\"url\":\"http:\\/\\/www.baidu.com\"}]}]}',1445443945);
/*!40000 ALTER TABLE `fy_menu_history` ENABLE KEYS */;

#
# Structure for table "fy_menu_type"
#

DROP TABLE IF EXISTS `fy_menu_type`;
CREATE TABLE `fy_menu_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT '' COMMENT '菜单类型名称',
  `type` varchar(64) NOT NULL COMMENT '菜单类型',
  `content` varchar(255) DEFAULT NULL COMMENT '字段类型',
  `description` varchar(512) DEFAULT NULL COMMENT '菜单描述',
  `status` tinyint(3) DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='菜单类型';

#
# Data for table "fy_menu_type"
#

/*!40000 ALTER TABLE `fy_menu_type` DISABLE KEYS */;
INSERT INTO `fy_menu_type` VALUES (1,'点击推事件','click','key','用户点击click类型按钮后，微信服务器会通过消息接口推送消息类型为event\t的结构给开发者（参考消息接口指南），并且带上按钮中开发者填写的key值，开发者可以通过自定义的key值与用户进行交互；',1),(2,'跳转URL','view','url','用户点击view类型按钮后，微信客户端将会打开开发者在按钮中填写的网页URL，可与网页授权获取用户基本信息接口结合，获得用户基本信息。',1),(3,'扫码推事件','scancode_push','key','用户点击按钮后，微信客户端将调起扫一扫工具，完成扫码操作后显示扫描结果（如果是URL，将进入URL），且会将扫码的结果传给开发者，开发者可以下发消息。',1),(4,'扫码推事件且弹出“消息接收中”提示框','scancode_waitmsg','key','用户点击按钮后，微信客户端将调起扫一扫工具，完成扫码操作后，将扫码的结果传给开发者，同时收起扫一扫工具，然后弹出“消息接收中”提示框，随后可能会收到开发者下发的消息。',1),(5,'弹出系统拍照发图','pic_sysphoto','key','用户点击按钮后，微信客户端将调起系统相机，完成拍照操作后，会将拍摄的相片发送给开发者，并推送事件给开发者，同时收起系统相机，随后可能会收到开发者下发的消息。',1),(6,'弹出拍照或者相册发图','pic_photo_or_album','key','用户点击按钮后，微信客户端将弹出选择器供用户选择“拍照”或者“从手机相册选择”。用户选择后即走其他两种流程。',1),(7,'弹出微信相册发图器','pic_weixin','key','用户点击按钮后，微信客户端将调起微信相册，完成选择操作后，将选择的相片发送给开发者的服务器，并推送事件给开发者，同时收起相册，随后可能会收到开发者下发的消息。',1),(8,'弹出地理位置选择器','location_select','key','用户点击按钮后，微信客户端将调起地理位置选择工具，完成选择操作后，将选择的地理位置发送给开发者的服务器，同时收起位置选择工具，随后可能会收到开发者下发的消息。',1),(9,'下发消息（除文本消息）','media_id','media_id','用户点击media_id类型按钮后，微信服务器会将开发者填写的永久素材id对应的素材下发给用户，永久素材类型可以是图片、音频、视频、图文消息。请注意永久素材id必须是在“素材管理/新增永久素材”接口上传后获得的合法id。',1),(10,'跳转图文消息URL','view_limited','media_id','用户点击view_limited类型按钮后，微信客户端将打开开发者在按钮中填写的永久素材id对应的图文消息URL，永久素材类型只支持图文消息。请注意永久素材id必须是在“素材管理/新增永久素材”接口上传后获得的合法id。',1);
/*!40000 ALTER TABLE `fy_menu_type` ENABLE KEYS */;

#
# Structure for table "fy_wechat_user"
#

DROP TABLE IF EXISTS `fy_wechat_user`;
CREATE TABLE `fy_wechat_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '公众号ID',
  `subscribe` tinyint(3) NOT NULL DEFAULT '0' COMMENT '用户是否关注',
  `openid` varchar(256) NOT NULL DEFAULT '' COMMENT '用户标志',
  `nickname` varchar(128) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `sex` tinyint(3) NOT NULL DEFAULT '0' COMMENT '性别1男2女0未知',
  `city` varchar(64) NOT NULL DEFAULT '未知' COMMENT '所在城市',
  `country` varchar(64) NOT NULL DEFAULT '未知' COMMENT '所在国家',
  `province` varchar(64) NOT NULL DEFAULT '未知' COMMENT '所在省份',
  `language` varchar(16) NOT NULL DEFAULT '' COMMENT '用户语言',
  `headimgurl` varchar(512) NOT NULL DEFAULT '' COMMENT '头像URL',
  `subscribe_time` int(11) NOT NULL DEFAULT '0' COMMENT '关注时间',
  `unionid` varchar(64) NOT NULL DEFAULT '' COMMENT '唯一ID',
  `remark` varchar(128) NOT NULL DEFAULT '' COMMENT '用户备注',
  `groupid` int(11) DEFAULT '0' COMMENT '分组ID',
  `status` tinyint(3) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "fy_wechat_user"
#

/*!40000 ALTER TABLE `fy_wechat_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `fy_wechat_user` ENABLE KEYS */;

#
# Data for table "fy_wechat_user_import_1"
#

#
# Structure for table "fy_wxauth"
#

DROP TABLE IF EXISTS `fy_wxauth`;
CREATE TABLE `fy_wxauth` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned DEFAULT '0' COMMENT '用户ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `open_id` varchar(64) DEFAULT NULL COMMENT '用户身份验证码',
  `token` varchar(64) NOT NULL COMMENT 'TOKEN',
  `app_id` varchar(32) NOT NULL COMMENT '微信appid',
  `app_secret` varchar(32) NOT NULL COMMENT '微信appsecret',
  `access_token` varchar(512) NOT NULL DEFAULT '' COMMENT '微信接口凭证',
  `token_time` int(11) NOT NULL DEFAULT '0' COMMENT '微信接口凭证有效时间',
  `default` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '默认管理账号',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(3) DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index` (`open_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='公众号账号信息';

#
# Data for table "fy_wxauth"
#

/*!40000 ALTER TABLE `fy_wxauth` DISABLE KEYS */;
INSERT INTO `fy_wxauth` VALUES (1,1,'账号12','db1cdc565a18d2194414ae1821fdc142','libwx','wx80fad4f7fa679eab','61537a778a0e97085e55e199ebd732a1','JbF0PfcxirutD86HO8S_EZhR99IZeyWsDJxUdcYZG1Ney0kufbPgzXJhb3mi_rpXnYCxgCpBwTByyOC3Jzh9aoyAYir6i-61SQ2by3fFsXw',1445541472,0,'asdf',1445152401,1445443921,1);
/*!40000 ALTER TABLE `fy_wxauth` ENABLE KEYS */;
