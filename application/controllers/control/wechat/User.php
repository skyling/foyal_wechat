<?php
/**
 * 微信用户模块
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/21 22:01
 */

class User extends Admin_Controller{

    function __construct(){
        parent::__construct();
    }

    /**
     * 初始化用户列表，从微信关注人数中拉取
     */
    public function init_user($p = 0){

        $this->load->view('control/wechat/init_user',$this->_data);
    }

}