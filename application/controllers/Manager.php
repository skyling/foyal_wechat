<?php
/**
 * 数据暂时管理类
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/6 17:49
 */

class Manager extends Wechat_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('wechat/menu_service');
        $this->load->library('wechat/groups_service');
        $this->load->library('wechat/user_service');
    }

    /*菜单================================================================*/
    public function get_menu(){
        echo $this->_open_id;
        $data = $this->menu_service->get($this->_open_id);
        var_dump($data);
        echo "end";
    }

    public function delete_menu(){
        $data = $this->menu_service->delete($this->_open_id);
        var_dump($data);
    }

    public function get_menu_info(){
        $data = $this->menu_service->menu_info($this->_open_id);
        var_dump($data);
    }

    public function set_menu(){
        $data = '{
    "button": [
        {
            "name": "扫码",
            "sub_button": [
                {
                    "type": "scancode_waitmsg",
                    "name": "扫码带提示",
                    "key": "rselfmenu_0_0",
                    "sub_button": [ ]
                },
                {
                    "type": "scancode_push",
                    "name": "扫码推事件",
                    "key": "rselfmenu_0_1",
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "发图",
            "sub_button": [
                {
                    "type": "pic_sysphoto",
                    "name": "系统拍照发图",
                    "key": "rselfmenu_1_0",
                   "sub_button": [ ]
                 },
                {
                    "type": "pic_photo_or_album",
                    "name": "拍照或者相册发图",
                    "key": "rselfmenu_1_1",
                    "sub_button": [ ]
                },
                {
                    "type": "pic_weixin",
                    "name": "微信相册发图",
                    "key": "rselfmenu_1_2",
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "发图",
            "sub_button": [
                {
                    "name": "发送位置",
                    "type": "location_select",
                    "key": "rselfmenu_2_0"
                },
            ]
        }
    ]
}';
        $ret = $this->menu_service->create($this->_open_id, $data);
        var_dump($ret);
    }

    /*分组================================================================*/
    public function groups_create(){
        $name = $this->input->get('name');
        $data['group'] = array('name'=>$name);
        $ret = $this->groups_service->create($this->_open_id, json_encode($data));
        var_dump($ret);
    }

    public function groups_get(){
        $ret = $this->groups_service->get($this->_open_id);
        var_dump($ret);
    }

    public function groups_getid(){
        $openid = $this->input->get('openid');
        $data = array('openid'=>$openid);
        $ret = $this->groups_service->getid($this->_open_id, json_encode($data));
        var_dump($ret);
    }

    public function groups_update(){
        $id = $this->input->get('id');
        $name = $this->input->get('name');
        $data['group'] = array('id'=>$id,'name'=>$name);
        $ret = $this->groups_service->update($this->_open_id, json_encode($data));
        var_dump($ret);
    }

    public function groups_delete(){
        $id = $this->input->get('id');
        $data['group'] = array('id'=>$id);
        $ret = $this->groups_service->delete($this->_open_id, json_encode($data));
        var_dump($ret);
    }

    /*用户================================================================*/
    public function user_get(){
        $ret = $this->user_service->get($this->_open_id);
        var_dump($ret);
    }




    /*public function add_user(){
        $this->load->library('wechat/custom_service');
        $app_id = $this->_config['app_id'];
        $app_secret = $this->_config['app_secret'];
        $this->load->model('wechat/wxauth_model');
        $this->wxauth_model->add($app_id, $app_secret);
    }*/

    /*public function test(){
        $this->load->library('wechat/menu_service');
        var_dump($this->menu_service->create($this->_open_id));
    }*/
}