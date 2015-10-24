<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 * 用户分组管理
 * author: v_frli <frenlee@163.com>
 * since: 2015/10/8 14:32 
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Base_service.php';

class Groups_service extends Base_service{

    function __construct(){
        parent::__construct();
    }

    /**
     * 创建分组
     * @param $open_id
     * @param $data json格式数据 {"group":{"name":"test"}}
     * @return bool
     */
    public function create($open_id, $data){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['groups']['create'], $access_token);
        $ret = $this->http->post($url, $data);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 查询所有分组
     * @param $open_id
     * @return bool
     */
    public function get($open_id){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['groups']['get'], $access_token);
        $ret = $this->http->get($url);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 查询用户所在分组
     * @param $open_id
     * @param $data {"openid":"od8XIjsmk6QdVTETa9jLtGWA6KBc"}
     * @return bool
     */
    public function getid($open_id, $data){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['groups']['getid'], $access_token);
        $ret = $this->http->post($url, $data);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 修改分组名
     * @param $open_id
     * @param $data {"group":{"id":108,"name":"test2_modify2"}}
     * @return bool
     */
    public function update($open_id, $data){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['groups']['update'], $access_token);
        $ret = $this->http->post($url, $data);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 移动用户分组
     * @param $open_id
     * @param $data {"openid":"oDF3iYx0ro3_7jD4HFRDfrjdCM58","to_groupid":108}
     * @return bool
     */
    public function m_update($open_id, $data){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['groups']['m_update'], $access_token);
        $ret = $this->http->post($url, $data);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 批量移动用户分组
     * @param $open_id
     * @param $data {"openid_list":["oDF3iYx0ro3_7jD4HFRDfrjdCM58","oDF3iY9FGSSRHom3B-0w5j4jlEyY"],"to_groupid":108}
     * @return bool
     */
    public function m_batchupdate($open_id, $data){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['groups']['m_batchupdate'], $access_token);
        $ret = $this->http->post($url, $data);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 删除分组
     * @param $open_id
     * @param $data {"group":{"id":108}}
     * @return bool
     */
    public function delete($open_id, $data){
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['groups']['delete'], $access_token);
        $ret = $this->http->post($url, $data);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }
}

/*  End of file Group_service.php*/