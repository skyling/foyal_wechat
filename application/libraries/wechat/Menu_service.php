<?php
/**
 * 自定义菜单
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/5 12:57
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Base_service.php';

class Menu_service extends Base_service{

    function __construct(){
        parent::__construct();
    }

    /**
     * 创建菜单
     * @param $open_id
     * @param $data
     * @return bool
     */
    public function create($open_id, $data){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['menu']['create'], $access_token);
        $ret = $this->http->post($url, $data);
        if($ret['statusCode'] == 200 ){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 获取菜单信息
     * @param $open_id
     * @return bool
     */
    public function get($open_id){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['menu']['get'], $access_token);
        $ret = $this->http->get($url);
        if($ret['statusCode'] == 200 ){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 删除菜单
     * @param $open_id
     * @return bool
     */
    public function delete($open_id){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['menu']['delete'], $access_token);
        $ret = $this->http->get($url);
        if($ret['statusCode'] == 200 ){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 获取现有菜单信息
     * @param $open_id
     * @return bool
     */
    public function menu_info($open_id){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['menu']['delete'], $access_token);
        $ret = $this->http->get($url);
        if($ret['statusCode'] == 200 ){
            return $ret['body'];
        }
        return FALSE;
    }
}