<?php
/**
 *
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/3 17:10
 */

class Base_service {

    protected $_CI;//ci对象
    protected $_config;//配置项
    protected $http;//http请求对象
    private $_access_token = NULL;
    function __construct(){
        $this->_CI = &get_instance();
        $this->_CI->config->load('wechat_service');
        $this->_config = $this->_CI->config->item('wechat_service');
        $this->_CI->load->library('http');
        $this->http = $this->_CI->http;
    }

    /**
     * 获取access_token
     * @param $open_id
     * @return bool|null
     */
    public function get_access_token($open_id){
        if( $this->_access_token ) return $this->_access_token;
        //从数据库获取
        $this->_CI->load->model('wxauth_model');
        $data = $this->_CI->wxauth_model->get_access_token($open_id);
        if(!$data) exit(1);
        if(!is_array($data)){
            return $data;
        }
        //从网络上获取
        $url = sprintf($this->_config['url']['access_token'], $data['app_id'], $data['app_secret']);
        $ret = $this->http->get($url);
        if($ret['statusCode'] == 200){
            $data = json_decode($ret['body'], TRUE);
            if(!isset($data['access_token'])){
                return FALSE;
            }
        }
        //更新
        $this->_CI->wxauth_model->update_token($open_id, $data['access_token'], $data['expires_in']);
        return $data['access_token'];
    }

    /**
     * 获取回调服务器IP
     * @param $open_id
     * @return bool
     */
    public function get_callback_ip($open_id){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['get_callback_ip'], $access_token);
        $ret = $this->http->get($url);
        if($ret['statusCode'] == 200){
            $token = json_decode($ret['body'], TRUE);
            if(isset($token['ip_list'])) return $token['ip_list'];
        }
        return FALSE;
    }


}