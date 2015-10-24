<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 * 
 * author: v_frli <frenlee@163.com>
 * since: 2015/10/8 18:14 
 */

class Index extends Admin_Controller {


    function __construct(){
        parent::__construct();
    }

    function index(){
        $this->load->view('control/index/index',$this->_data);
    }

    public function logout(){
        session_destroy();
        redirect('control/auth/login');
    }

    public function empty_account(){
        $this->load->view('control/index/empty_account',$this->_data);
    }
}

/*  End of file Index.php*/