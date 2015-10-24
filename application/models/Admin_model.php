<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 * 
 * author: v_frli <frenlee@163.com>
 * since: 2015/9/22 15:04 
 */

class Admin_model extends Base_Model{

    function __construct(){
        $this->_table_name = 'admin';
        parent::__construct();
    }

    /**
     * 获取密码
     * @param $map
     * @return bool
     */
    public function get_admin_info($map){
        $map['status'] = 1;
        $data = $this->get_item('id,username,password,login', $map);
        if($data){
            return $data;
        }
        return FALSE;
    }

    /**
     * 改变登录后的状态
     * @param int $id
     * @param $data
     * @return mixed
     */
    public function login($id=0, $data){
        return $this->db->set($data)->where(array('id'=>$id))->update($this->_table_name);
    }
}

/*  End of file Admin_model.php*/