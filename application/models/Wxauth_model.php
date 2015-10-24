<?php
/**
 *
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/6 0:24
 */

class Wxauth_model extends Base_Model{

    function __construct(){
        $this->_table_name = 'wxauth';
        parent::__construct();
    }


    /**
     * 获取账号信息
     * @param $uid 用户ID
     * @return mixed
     */
    public function get_accounts($uid){
        $map = array(
            'status' => 1,
            'uid' => $uid,
        );
        return $this->get_list('id,title,description,open_id,default', 0, NULL, $map);
    }

    /**
     * 添加微信用户
     * @param $app_id
     * @param $app_secret
     * @return mixed
     */
    public function add($data){
        $this->db->insert($this->_table_name, $data);
        return $this->db->insert_id();
    }

    /**
     * 获取TOKEN
     * @param $open_id
     * @return bool
     */
    public function get_access_token($open_id){
        $map = array(
            'open_id'       => $open_id,
            'status'        => 1,
        );
        $data = $this->db->select('access_token,app_id,app_secret,token_time')->where($map)->get($this->_table_name)->row_array();
        if($data){
            if((int)$data['token_time'] > time()){
                return $data['access_token'];
            }else{
                unset($data['access_token'],$data['token_time']);
                return $data;
            }
        }
        return false;
    }

    /**
     * 更新token
     * @param $open_id
     * @param $token
     * @param $expires_in
     * @return mixed
     */
    public function update_token($open_id, $access_token, $expires_in){
        $data = array(
            'access_token' => $access_token,
            'token_time' => (time() + $expires_in -100),
        );
        $map = array(
            'open_id' => $open_id,
        );
        return $this->db->where($map)->update($this->_table_name, $data);
    }

    /**
     * 验证open_id是否正确
     * @param $open_id
     * @return bool 返回TOKEN
     */
    public function auth_open_id($open_id){
        $map = array(
            'open_id' => $open_id,
            'status' => 1,
        );
        return $this->db->select('id,token')->where($map)->get($this->_table_name)->row_array();
    }

    /**
     * 取消默认值
     * @param $uid
     */
    public function unset_default($uid){
        $map = array('uid'=> $uid,'default'=>1);
        $this->db->set(array('default'=> 0))->where($map)->update($this->_table_name);
    }



}