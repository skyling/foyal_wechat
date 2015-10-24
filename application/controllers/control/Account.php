<?php
/**
 *
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/18 11:57
 */

class Account extends Admin_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('wxauth_model');
    }

    /**
     * 添加账号
     */
    public function add(){
        if(IS_AJAX){
            $data = array(
                'title' => $this->input->get_post('title'),
                'token' => $this->input->get_post('token'),
                'app_id' => $this->input->get_post('app_id'),
                'app_secret' => $this->input->get_post('app_secret'),
            );
            if(count(array_filter($data)) == 4){
                $data['description'] = $this->input->get_post('description');
                $data['status'] = $this->input->get_post('status');
                $data['uid'] = $this->_uid;
                $data['open_id'] = md5($data['app_id'].$data['app_secret'].microtime(TRUE));
                $data['create_time'] = time();
                $data['update_time'] = time();
                if( $this->wxauth_model->add($data) ){
                    ajax_return_data(0,'添加成功');
                }
            }
            ajax_return_data(1,'账号添加失败');
        }
        $this->load->view('control/account/edit',$this->_data);
    }

    /**
     * 编辑
     * @param int $id
     */
    public function edit($id = 0){
        $id = $id ? $id : $this->input->get_post('id');
        $map = array('uid'=>$this->_uid,'id'=>(int)$id);
        if(IS_AJAX){
            $data = array(
                'title' => $this->input->get_post('title'),
                'token' => $this->input->get_post('token'),
                'app_id' => $this->input->get_post('app_id'),
                'app_secret' => $this->input->get_post('app_secret'),
            );
            if(count(array_filter($data)) == 4){
                $data['description'] = $this->input->get_post('description');
                $data['status'] = $this->input->get_post('status');
                $data['update_time'] = time();
                if( $this->wxauth_model->update($map, $data) ){
                    ajax_return_data(0,'修改成功');
                }
            }
            ajax_return_data(1,'修改失败');
        }
        $this->_data['info'] = $this->wxauth_model->get_item('*',$map);

        $this->load->view('control/account/edit',$this->_data);
    }

    /**
     * 显示列表
     */
    public function lists(){
        $p = $this->input->get_post('p');
        $p = $p ? $p : 1;
        $per_num = $this->_config['per_page_num'];
        $from = ($p-1)*$per_num;

        $map = array('uid'=>$this->_uid);
        //分页信息
        $count = $this->wxauth_model->get_count($map);
        $this->_data['paginate'] = pagination($p, $count, $per_num);

        $this->_data['lists'] = $this->wxauth_model->get_list('id,title,token,open_id,app_id,default,create_time,update_time,status', $from, $per_num, $map);
        $this->load->view('control/account/lists',$this->_data);
    }

    /**
     * 详细信息
     * @param int $id
     */
    public function detail($id = 0){
        $id = $id ? $id : $this->input->get_post('id');
        $map = array('uid'=>$this->_uid,'id'=>(int)$id);
        $this->_data['info'] = $this->wxauth_model->get_item('*',$map);
        $this->load->view('control/account/detail',$this->_data);
    }

    public function change_account($id = 0){
        $id = (int)($id ? $id : $this->input->get_post('id'));
        if(is_numeric($id) && in_array($id, array_column($this->_wx_accounts, 'id'))){
            $_SESSION['wid'] = $id;
        }
        redirect('control/index/index');
    }

    /**
     * 删除数据
     * @param bool $id
     */
    public function delete($id = FALSE){
        $this->__delete($this->wxauth_model, $id);
    }

    /**
     * 改变状态
     * @param int $id
     * @param int $status
     */
    public function set_status($id = 0, $status= 0){
        $status = $status ? $status : $this->input->get_post('status');
        $this->__change_filed($this->wxauth_model,$id, array('status'=>(int)$status));
    }

    /**
     * 改变状态
     * @param int $id
     * @param int $status
     */
    public function set_default($id = 0, $status= 0){
        $status = $status ? $status : $this->input->get_post('default');
        $this->wxauth_model->unset_default($this->_uid);
        $this->__change_filed($this->wxauth_model,$id, array('default'=>(int)$status));
    }

}