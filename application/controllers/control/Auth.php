<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 * 
 * author: v_frli <frenlee@163.com>
 * since: 2015/9/22 11:24 
 */

class Auth extends CI_Controller{

    function __construct(){
        parent::__construct();
        if(admin_is_login(TRUE)){
            redirect('control/index/index');
        }
        $this->load->model('admin_model', 'admin');
    }

    /**
     * 登录页面
     */
    public function login(){
        //弹出提示框控制位
        $data['flag'] = 'true';
        if(IS_POST){
            if( $this->input->post('auth') == $_SESSION['auth']
                && ($user = $this->input->post('username'))
                && ($pass = $this->input->post('password'))
                && ($ret = $this->admin->get_admin_info(array('username'=>$user,'type'=>1)))
                && (admin_do_hash($pass, $ret['password']) == $ret['password']) ){//登录成功
                $_SESSION['au'] = $ret['id'].','.$ret['username'];
                $_SESSION['th'] = admin_do_hash($_SESSION['au']);

                $u['id'] = $ret['id'];
                $u['login'] = $ret['login'] + 1;
                $u['last_login_time'] = time();
                $u['last_login_ip'] = ip2long($this->input->ip_address());

                $this->admin->login($ret['id'],$u);//登录成功
                redirect('control/index/index');
            }
            $data['flag'] = 'false';
        }
        $data['auth'] = md5('coder'.rand(0,10000));
        $_SESSION['auth'] = $data['auth'];
        $this->load->view('control/auth/login', $data);
    }
}

/*  End of file Auth.php*/