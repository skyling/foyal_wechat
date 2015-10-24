<?php
/**
 * 微信用户
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/21 22:44
 */

class Wechat_user_model extends Base_Model{

    const TB_USER_IMPORT = 'wechat_user_import_';
    const TB_USER_LIST = 'wechat_user_list_';
    function __construct(){
        $this->_table_name = 'wechat_user';
        parent::__construct();
    }

    /**
     * 批量添加数据 数据来源为微信公众平台返回的json数据
     * @param $wid
     * @param $json
     * @return mixed
     */
    public function add_batch_user_to_import($wid, $json){
        $data = json_decode($json, TRUE);
        if(is_array($data) && isset($data['user_info_list'])){
            $data = $data['user_info_list'];
            $this->insert($data, self::TB_USER_IMPORT.$wid);
            $this->update('', array('wid'=>$wid, 'status'=>1), self::TB_USER_IMPORT.$wid);
        }
    }

    /**
     * 获取openid列表
     * @param $wid
     * @param $p
     * @return bool|mixed
     */
    public function get_user_openid_list($wid, $p){
        $limit = 100;
        $from = $p*$limit;
        $table_name = $this->db->dbprefix.self::TB_USER_LIST.$wid;
        $data = $this->get_list('openid', $from, $limit, NULL, 'id asc', NULL, $table_name);
        if(count($data) > 0){
            return $data;
        }
        return FALSE;
    }

    /**
     * 把数据从临时表中导入正式表中
     * @param $wid
     * @return mixed
     */
    public function import_info_from_import($wid){
        $table_name = $this->db->dbprefix.self::TB_USER_IMPORT.$wid;
        $query = 'insert into '.$this->db->dbprefix.$this->_table_name.' (wid,subscribe,openid,nickname,sex,city,country,province,language,headimgurl,subscribe_time,unionid,remark,groupid,status)
            select wid,subscribe,openid,nickname,sex,city,country,province,language,headimgurl,subscribe_time,unionid,remark,groupid,status from '.$table_name;
        return $this->db->query($query);
    }

    /**
     * 创建数据表
     * @param $table_name
     * @return mixed
     */
    public function create_user_import_table($wid){
        $table_name = $this->db->dbprefix.self::TB_USER_IMPORT.$wid;
        $query = 'DROP TABLE IF EXISTS '.$table_name;
        $this->db->query($query);
        $query = "CREATE TABLE `{$table_name}` (
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
                      `headimgurl` varchar(512) DEFAULT '' COMMENT '头像URL',
                      `subscribe_time` int(11) DEFAULT '0' COMMENT '关注时间',
                      `unionid` varchar(64) DEFAULT '' COMMENT '唯一ID',
                      `remark` varchar(128) DEFAULT '' COMMENT '用户备注',
                      `groupid` int(11) DEFAULT '0' COMMENT '分组ID',
                      `status` tinyint(3) DEFAULT '1' COMMENT '状态',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
        return $this->db->query($query);
    }

    /**
     * 创建用户openid 表
     * @param $wid
     * @return mixed
     */
    public function create_openid_list_table($wid){
        $table_name = $this->db->dbprefix.self::TB_USER_LIST.$wid;
        $query = 'DROP TABLE IF EXISTS '.$table_name;
        $this->db->query($query);
        $query = "CREATE TABLE `{$table_name}` (
                      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                      `openid` varchar(256) NOT NULL DEFAULT '' COMMENT '用户标志',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
        return $this->db->query($query);
    }

    /**
     * 保存列表
     * @param $wid
     * @param $data
     * @return mixed
     */
    public function add_user_openid_list($wid, $data){
        $table_name = $this->db->dbprefix.self::TB_USER_LIST.$wid;
        $query = 'insert into '.$table_name.'(openid) values("'.implode('"),("',$data).'")';
        return $this->db->query($query);
    }

}