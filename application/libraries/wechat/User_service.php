<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 * 用户管理
 * author: v_frli <frenlee@163.com>
 * since: 2015/10/8 14:31 
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Base_service.php';

class User_service extends Base_service{

    function __construct(){
        parent::__construct();
    }

    /**
     * 设置用户备注名
     * @param $open_id
     * @param $data {
                        "openid":"oDF3iY9ffA-hqb2vVvbr7qxf6A0Q",
                        "remark":"pangzi"
                    }
     * @return bool
     */
    public function info_update_remark($open_id, $data){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['user']['info_update_remark'], $access_token);
        $ret = $this->http->post($url, $data);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 获取用户信息
     * @param $open_id
     * @param $openid 用户openid
     * @param string $lang 语言
     * @return bool
     */
    public function info($open_id, $openid, $lang='zh_CN'){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['user']['info'], $access_token, $openid, $lang);
        $ret = $this->http->get($url);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 批量获取用户信息
     * @param $open_id
     * @param $data {
                        "user_list": [
                        {
                        "openid": "otvxTs4dckWG7imySrJd6jSi0CWE",
                        "lang": "zh-CN"
                        },
                        {
                        "openid": "otvxTs_JZ6SEiP0imdhpi50fuSZg",
                        "lang": "zh-CN"
                        }
                        ]
                    }
     * @return bool
     */
    public function info_batch_get($open_id, $data){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['user']['info_batch_get'], $access_token);
        $ret = $this->http->post($url, $data);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 获取用户openid列表
     * @param $open_id
     * @param string $next_openid
     * @return bool
     */
    public function get($open_id, $next_openid=''){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['user']['get'], $access_token, $next_openid);
        $ret = $this->http->get($url);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }





}

/*  End of file User_service.php*/