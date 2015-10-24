<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 * 
 * author: v_frli <frenlee@163.com>
 * since: 2015/10/16 17:58 
 */

class Service extends Admin_Controller{

    function __construct(){
        parent::__construct();
    }

    /**
     * 设置目录
     * @param int $id
     */
    public function set_menu($id = 0){
        $this->load->model('menu_model');
        //获取数据
        $data = $this->menu_model->get_post_menu($id,$this->_uid, $this->_wid, TRUE);
        if($data){
            $this->load->library('wechat/menu_service');
            if(($ret = $this->menu_service->create($this->_open_id,$data))){
                $tmp = json_decode($ret,TRUE);
                if($tmp['errcode'] == 0){
                    $this->menu_model->add_history_menu($this->_uid, $this->_wid, $data);
                    ajax_return_data(0,'设置成功！');
                }
                ajax_return_data(1,'设置失败，错误信息为'.$ret);
            }
        }
        //调用服务类
        ajax_return_data(1,'设置失败！');
    }

    /**
     * 获取目录
     */
    public function get_menu(){
        $this->load->model('menu_model');
        $this->load->library('wechat/menu_service');
        $data = json_decode($this->menu_service->get($this->_open_id),TRUE);
        $type = $this->menu_model->get_menu_type();
        $type = array_combine(array_column($type, 'type'), $type);
        if(is_array($data) && isset($data['menu']['button'])){
            foreach($data['menu']['button'] as $key=>$item){
                //存在子菜单
                $sub_button = false;
                if(isset($item['sub_button'])){
                    $sub_button = $item['sub_button'];
                    unset($item['sub_button']);
                }
                $item['uid'] = $this->_uid;
                $item['wid'] = $this->_wid;
                $item['type_id'] = isset($item['type']) ? $type[$item['type']]['id'] : $type['click']['id'];
                $item['pid'] = 0;
                $item['sort'] = $key+1;
                $item['status'] = 1;
                $item['status'] = 1;
                if(isset($item['type']))unset($item['type']);
                if(isset($item['key'])){$item['value']=$item['key'];unset($item['key']);}
                $pid = $this->menu_model->insert($item);
                if($sub_button && $pid){
                    foreach($sub_button as $k=>$i){
                        if(isset($i['sub_button'])) unset($i['sub_button']);
                        $i['uid'] = $this->_uid;
                        $i['wid'] = $this->_wid;
                        $i['type_id'] = isset($i['type']) ? $type[$i['type']]['id'] : $type['click']['id'];
                        $i['pid'] = $pid;
                        $i['sort'] = $k+1;
                        $i['status'] = 1;
                        if(isset($i['type']))unset($i['type']);
                        if(isset($i['key'])){$i['value']=$i['key'];unset($i['key']);}
                        $this->menu_model->insert($i);
                    }
                }
            }
            ajax_return_data(0,'拉取成功!');
        }
        ajax_return_data(1,'菜单为空!!');

    }

    /**
     * 初始化用户
     *
     */
    public function init_users(){
        $this->load->library('wechat/user_service');
        $this->load->model('wechat_user_model');
        //创建导入表
        $this->wechat_user_model->create_openid_list_table($this->_wid);
        $this->wechat_user_model->create_user_import_table($this->_wid);
        $this->_data['total'] = $this->get_user_openid_list();
        $this->_data['p'] = 0;
        //redirect('control/service/get_batch_user_info/'.$total);
        $this->load->view('control/service/init_users',$this->_data);

        //获取用户列表写入数据库
        //判断是否存在用户 存在  不更新  不存在 更新
        /*$this->get_batch_user_info();
        $this->wechat_user_model->import_info_from_import($this->_wid);
        ajax_return_data(0,'成功!');*/
    }

    /**
     * 获取用户ID列表
     * @param string $next_openid
     * @return mixed
     */
    private function get_user_openid_list($next_openid = ''){
        $user_list = json_decode($this->user_service->get($this->_open_id, $next_openid), TRUE);
        $total = $user_list['total'];
        if(is_array($user_list) && isset($user_list['data']['openid']) && count($user_list['data']['openid']) > 0) {
            $this->wechat_user_model->add_user_openid_list($this->_wid, $user_list['data']['openid']);
        }
        if (!empty($user_list['next_openid'])) {
            $this->get_user_openid_list($user_list['next_openid']);
        }
        return $total;
    }


    /**
     * ajax获取数据添加值导入表
     * @param string $next_openid
     */
    public function get_batch_user_info($total, $p = 0){
        $p = $p ? $p : $this->input->get_post($p);
        $this->load->model('wechat_user_model');
        $this->load->library('wechat/user_service');
        $data = $this->wechat_user_model->get_user_openid_list($this->_wid, $p);
        $ret['all'] = 1;
        if($data){
            $tmp['user_list'] = $data;
            $ret['all'] = 0;
            $user_info_list = $this->user_service->info_batch_get($this->_open_id, json_encode($tmp));
            $this->wechat_user_model->add_batch_user_to_import($this->_wid, $user_info_list);
        }elseif($p>0){
            $ret['all'] = 1;
            $this->wechat_user_model->import_info_from_import($this->_wid);
        }
        $ret['total'] = (int)$total;
        $ret['p'] = $p+1;
        echo json_encode($ret);
        /*if(is_array($user_list) && isset($user_list['data']['openid']) && count($user_list['data']['openid']) > 0) {
            foreach ($user_list['data']['openid'] as $key => $item) {
                $openid_list[] = array('openid' => $item);
            }
            $openid_list = array_chunk($openid_list, ceil(count($openid_list) / 100));
            foreach ($openid_list as $item) {
                $tmp['user_list'] = $item;
                $user_info_list = $this->user_service->info_batch_get($this->_open_id, json_encode($tmp));
                $this->wechat_user_model->add_batch_user_to_import($this->_wid, $user_info_list);
            }
            if (!empty($user_list['next_openid'])) {
                $this->get_batch_user_info($user_list['next_openid']);
            }
        }*/
    }

    /**
     * 获取详细用户信息
     * @param $openidt
     */
    public function get_user_info($openid){
        $this->load->library('wechat/user_service');
        $data = $this->user_service->info($this->_open_id, $openid);
        if($data){
            $this->load->model('wechat_user_model');
            $this->load->add_user($this->_wid, $data);
        }
        return $data;
    }

}

/*  End of file Service.php*/