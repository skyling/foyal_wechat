<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 * 二维码
 * author: v_frli <frenlee@163.com>
 * since: 2015/10/8 15:43 
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Base_service.php';

class Qcode_service extends Base_service{

    function __construct(){
        parent::__construct();
    }

    /**
     * 创建二维码
     * @param $open_id
     * @param $data {"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}} 临时的
     *              {"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "123"}}} 永久的
     * @return bool
     */
    public function create($open_id, $data){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['qcode']['create'], $access_token);
        $ret = $this->http->post($url, $data);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 获取二维码信息
     * @param $ticket
     * @return bool
     */
    public function show_qcode($ticket){
        $url = sprintf($this->_config['url']['qcode']['create'], $ticket);
        $ret = $this->http->get($url);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 生成短链接
     * @param $open_id
     * @param $long_url
     * @return bool
     */
    public function short_url($open_id, $long_url){
        $data = array(
            'action' => 'long2short',
            'long_url' => $long_url,
        );
        $data = json_encode($data);
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['qcode']['short_url'], $access_token);
        $ret = $this->http->post($url, $data);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }
}

/*  End of file Qcode_service.php*/