<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 * 目录设置
 * author: v_frli <frenlee@163.com>
 * since: 2015/10/15 18:09 
 */

class Menu extends Admin_Controller{

    function __construct(){
        parent::__construct();
        admin_accounts();
        $this->load->model('menu_model');
    }

    public function index(){

        //显示最新目录
        $this->_data['menu'] = $this->menu_model->get_current_menu($this->_uid, $this->_wid);
        $p = $this->input->get_post('p');
        $p = $p ? $p : 1;
        $per_num = $this->_config['per_page_num'];
        $from = ($p-1)*$per_num;
        //分页信息
        $map = array(
            'uid' => $this->_uid,
            'wid' => $this->_wid,
        );
        $count = $this->menu_model->get_count($map,'menu_history');
        $this->_data['p'] = $p;
        $this->_data['paginate'] = pagination($p, $count, $per_num);
        $data = $this->menu_model->get_history_menu($this->_uid, $this->_wid, $from, $per_num);
        if($data){
            foreach($data as $key=>$item){
                $item['content'] = json_decode($item['content'], TRUE);
                $this->_data['history_menu'][] = $item;
            }
        }
        //显示历史目录
        $this->load->view('control/wechat/menu/index',$this->_data);
    }

    /**
     * 添加菜单
     */
    public function add(){
        if(IS_AJAX){
            $data = array(
                'pid' => $this->input->get_post('pid'),
                'type_id' => $this->input->get_post('type_id'),
                'name' => $this->input->get_post('name'),
                'value' => $this->input->get_post('value'),
            );

            if(count(array_filter($data)) > 2){
                $data['sort'] = (int)$this->input->get_post('sort');
                $data['description'] = $this->input->get_post('description');
                $data['wid'] = $this->_wid;
                $data['uid'] = $this->_uid;
                if($this->menu_model->insert($data)){
                    ajax_return_data(0,'添加成功');
                }
            }
            ajax_return_data(1,'添加失败');
        }
        //获取菜单类型
        $this->_data['type'] = $this->menu_model->get_menu_type();
        //获取一级菜单
        $this->_data['parent_menu'] = $this->menu_model->get_parent_menu($this->_uid, $this->_wid);
        $this->load->view('control/wechat/menu/edit', $this->_data);
    }

    /**
     * 编辑菜单
     * @param int $id
     */
    public function edit($id = 0){
        $id = $id ? $id : $this->input->get_post('id');
        $this->_data['info'] = $this->menu_model->get_info($id, $this->_uid, $this->_wid);

        if(IS_AJAX){
            $data = array(
                'pid' => $this->input->get_post('pid'),
                'type_id' => $this->input->get_post('type_id'),
                'name' => $this->input->get_post('name'),
                'value' => $this->input->get_post('value'),
            );

            if(count(array_filter($data)) > 2){
                $data['sort'] = (int)$this->input->get_post('sort');
                $data['description'] = $this->input->get_post('description');
                $data['status'] = 0;
                $map = array(
                    'id' => $id,
                    'wid' => $this->_wid,
                    'uid' => $this->_uid,
                );
                if($this->menu_model->update($map, $data)){
                    ajax_return_data(0,'修改成功');
                }
            }
            ajax_return_data(1,'修改失败');
        }

        //获取一级菜单
        if($this->_data['info']['pid'] != 0){
            $this->_data['parent_menu'] = $this->menu_model->get_parent_menu($this->_uid, $this->_wid);
        }
        //获取菜单类型
        $this->_data['type'] = $this->menu_model->get_menu_type();
        $this->load->view('control/wechat/menu/edit', $this->_data);
    }

    public function set_menu($id = 0){
        $id = (int)($id ? $id : $this->input->get_post('id'));
        $id = $id ? $id : 0;
        //获取当前菜单
        $this->_data['info'] = $this->menu_model->get_post_menu($id, $this->_uid, $this->_wid);
        $this->_data['id'] = $id;
        $this->load->view('control/wechat/menu/set_menu',$this->_data);
    }

    /**
     * 删除数据
     * @param bool $id
     */
    public function delete($id = FALSE){
        $this->__delete($this->menu_model, $id);
    }

    /**
     * 改变状态
     * @param int $id
     * @param int $status
     */
    public function set_status($id = 0, $status= 0){
        //获取目录个数信息
        if($status == 1){
            $ret = $this->menu_model->get_menu_count($id,$this->_uid, $this->_wid);
            if($ret){
                if( ($ret['sub'] && ($ret['count'] >= $this->_config['sub_menu_count']) ) || (!$ret['sub'] && ($ret['count'] >= $this->_config['menu_count']))) {
                    ajax_return_data(1,'操作失败,微信菜单中，一级菜单不能超过'.$this->_config['menu_count'].'个,二级菜单不能超过'.$this->_config['sub_menu_count'].'个！');
                }
            }
        }
        $status = $status ? $status : $this->input->get_post('status');
        $this->__change_filed($this->menu_model,$id, array('status'=>$status));
    }

    /**
     * 改变排序
     * @param $id
     * @param $sort
     */
    public function change_sort($id, $sort){
        $this->__change_filed($this->menu_model, $id, array('sort'=>$sort));
    }

}

/*  End of file Menu.php*/