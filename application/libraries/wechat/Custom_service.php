<?php
/**
 * 客服调用 TODO 补充完整
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/3 16:56
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Base_service.php';

class Custom_service extends Base_service{

    function __construct(){
        parent::__construct();
    }

    /**
     * 添加客服账号
     * @param $open_id
     * @param $account
     * @param $nickname
     * @param $password
     * @return bool
     */
    public function add($open_id,$account, $nickname, $password){
        return $this->edit('add', $open_id, $account, $nickname, $password);
    }

    /**
     * 修改客服账号
     * @param $open_id
     * @param $account
     * @param $nickname
     * @param $password
     * @return bool
     */
    public function update($open_id, $account, $nickname, $password){
        return $this->edit('udpate', $open_id, $account, $nickname, $password);
    }

    /**
     * 删除客服账号
     * @param $open_id
     * @param $account
     * @param $nickname
     * @param $password
     * @return bool
     */
    public function del($open_id, $account, $nickname, $password) {
        return $this->edit('del', $open_id, $account, $nickname, $password);
    }

    /**
     * 设置客服帐号的头像
     * @param $open_id
     */
    public function upload_head_img($open_id){
        //TODO
    }

    /**
     * 获取客服列表
     * @param $token
     * @return bool
     */
    public function get_kf_list($open_id) {
        $url = sprintf($this->_config['url']['kf_account']['getkflist'], $open_id);
        $ret = $this->http->get($url);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }

    /**
     * 操作客户账号
     * @param $type
     * @param $open_id
     * @param $account
     * @param $nickname
     * @param $password
     * @return bool
     */
    private function edit($type, $open_id,$account, $nickname, $password){
        $access_token = $this->get_access_token($open_id);
        $arr = array('add', 'update', 'del');
        if(!in_array($type, $arr))return FALSE;
        $data = array(
            'kf_account' => $account,
            'nickname' => $nickname,
            'password' => $password,
        );

        $url = sprintf($this->_config['url']['kf_account'][$type], $access_token);
        $json = json_encode($data);
        $ret = $this->http->post($url, $json);
        if($ret['statusCode'] == 200){
            return $ret['body'];
        }
        return FALSE;
    }
}