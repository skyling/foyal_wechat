<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 *
 * author: v_frli <frenlee@163.com>
 * since: 2015/8/26 17:35
 */


/**
 * 密码加密处理
 * @param $string
 * @param null $salt
 * @return string
 */
if(!function_exists('admin_do_hash')){
    function admin_do_hash($string, $salt = NULL)
    {
        if(null === $salt)
        {
            $salt = substr(md5(uniqid(rand(), true)), 0, 24);
        }
        else
        {
            $salt = substr($salt, 0, 24);
        }
        return $salt . sha1($salt . $string);
    }
}
/**
 * 判断用户是否登录
 */
if(!function_exists('admin_is_login')){
    function admin_is_login($redirect = FALSE)
    {
        $au = isset($_SESSION['au']) ? $_SESSION['au'] : '';
        $th = isset($_SESSION['th']) ? $_SESSION['th'] : '';
        if(admin_do_hash($au,$th)== $th){
            return TRUE;
        }
        $redirect || redirect('control/auth/login');
        return FALSE;
    }
}

/**
 * 获取分页信息
 * @param int $p 当前页数
 * @param int $total 数据总条数
 * @param null $url 基本url
 * @param null $count 每页显示数据条数
 * @return array
 */
if(!function_exists('pagination')){
    function pagination($p=1,$total=0,$count = 10,$url=NULL)
    {
        if(empty($url)){
            $url = $_SERVER['REQUEST_URI'];
        }
        $count = $count ? $count : 10;//每页显示条数
        $base = $query = '';
        sscanf($url, '%[^?]?%s', $base, $query);
        $query = preg_replace('/&?p=\d*/','',$query);
        $query .= empty($query) ? 'p=' : '&p=';
        $url = $base . '?' .$query;

        $pageCount = 10;
        $halfCount = intval($pageCount/2);
        $pageTotal = ceil($total / $count);

        /**     分页居中显示
         *  if(当前页 > 显示页一半){
         *      if(当前页+显示页一半 > 总页数){
         *          if(总数也>显示页){
         *              总数也-显示页+1
         *          }else{
         *              1
         *          }
         *      }else{
         *          当前页-显示页一半
         *      }
         *  }
         *  else{
         *      1
         *  }
         *
         **/

        $start = $p > $halfCount ? (($p+$halfCount)>$pageTotal ? ($pageTotal>$pageCount ? ($pageTotal-$pageCount+1) : 1) :  ($p-$halfCount)) : 1;
        $pageNum = ($pageTotal>$pageCount) ? $pageCount : $pageTotal;

        $ret = array(
            'total' => $total,//总条数
            'page_total'=>$pageTotal,//页面总条数
            'page_num'=>$pageNum,//显示页面数
            'show_num'=>$count,//每页显示条数
            'start_num'=>$start,//起始位置
            'active'=>$p,//当前位置
            'base_url'=>$url,//url
        );
        return $ret;
    }
}

/**
 * 获取一个数据表中某个字段的最大值
 * @param null $table
 * @param string $field
 * @return int
 */
if(!function_exists('get_table_max')){
    function get_max($table = NULL, $field = 'id'){
        if(!$table) return 0;
        $CI = &get_instance();
        $data = $CI->db->select_max($field, 'count')->get($table)->row_array();
        return $data['count'];
    }
}

/**
 * ajax请求返回数据
 * @param  $type 0 成功，1失败
 * @param  $str
 * @param  $extra
 * @return string
 */
if(!function_exists('ajax_return_data')){
    function ajax_return_data($type=0, $str='', $extra=NULL){
        $data = array(
            array(
                'status' => 'y',
                'info' => '操作成功',
            ),
            array(
                'status' => 'n',
                'info' => '操作失败'
            ),
        );
        if(!empty($str)){
            $data[$type]['info'] = $str;
        }
        !$extra || $data[$type] = array_merge($data[$type],$extra);
        echo json_encode($data[$type]);
        exit(1);
    }
}
/**
 * 上传文件
 * @param $name 表单字段名
 * @param $file_name 文件名
 * @param array $ext 允许后缀
 * @param string $path 保存路径
 */
if(!function_exists('file_upload')) {
    function file_upload($name='userfile', $config = array()){
        $CI = &get_instance();
        if(!isset($config['upload_path'])){
            $config['upload_path'] = './uploads';
        }
        if(!isset($config['allowed_types'])){
            $config['allowed_types'] = 'gif|jpg|png';
        }
        $CI->load->library('upload', $config);
        if ( ! $CI->upload->do_upload($name)){
            return FALSE;
        } else {
            $data = array('upload_data' => $CI->upload->data());
            return $data;
        }
    }
}

/**
 * 使用七牛云上传图片
 * @param $name
 * @param string $type
 * @return bool|string
 */
if(!function_exists('qiniu_upload')){
    function qiniu_upload($name, $type='gif|jpg|png'){

        $tmp_file = $_FILES[$name];
        if(!isset($tmp_file['name']) || (isset($tmp_file['name']) && empty($tmp_file['name']))) return '';
        $minis = &get_mimes();
        $type = explode('|', $type);

        $flag = FALSE;
        foreach($type as $item){
            if(isset($minis[$item])){
                if( (is_array($minis[$item]) && in_array($tmp_file['type'], $minis[$item])) || (is_string($minis[$item]) && $tmp_file['type'] == $minis[$item]) ){
                    $flag = TRUE;
                }
            }
        }
        if(!$flag)return FALSE;
        $CI = &get_instance();
        $CI->load->model('qiniu_model', 'qiniu');
        if(isset($_SESSION['qiniu_token'])){
            $token = $_SESSION['qiniu_token'];
        }else{
            $token = $CI->qiniu->get_token();
            $CI->session->set_tempdata('qiniu_token', $token, 3000);
        }
        $file_name = 'ci_set/'.date('Y/m/dH/i/s',time()).md5(substr($tmp_file['name'], 0, strrpos($tmp_file['name'], '.')).time()).substr($tmp_file['name'], strrpos($tmp_file['name'], '.'));
        $ret = $CI->qiniu->upload_file($token, $tmp_file['tmp_name'], $file_name);
        if(isset($ret['key']))
            return $ret['key'];
        return FALSE;
    }
}

/**
 * 上传本地文件至七牛
 * @param $path
 * @return bool
 */
if( !function_exists('qiniu_upload_local')) {
    function qiniu_upload_local($path){
        if(file_exists($path)){
            $filename = basename($path);
            $filename = 'ci_set/'.date('Y/m/dH/i/s',time()).md5(substr($filename, 0, strrpos($filename, '.')).time()).substr($filename, strrpos($filename, '.'));
            $CI = &get_instance();
            $CI->load->model('qiniu_model', 'qiniu');
            if(isset($_SESSION['qiniu_token'])){
                $token = $_SESSION['qiniu_token'];
            }else{
                $token = $CI->qiniu->get_token();
                $CI->session->set_tempdata('qiniu_token', $token, 3000);
            } $ret = $CI->qiniu->upload_file($token, $path, $filename);
            if(isset($ret['key']))
                return $ret['key'];
        }
        return FALSE;
    }
}

/**
 * 获取截图
 */
if( !function_exists('snapshot')) {
    function snapshot($url, $size = '', $zoom = 0){
        $href = 'http://tool.frenlee.cn/snapshot.php?url='.$url. ($size ? ( '&size='.$size . ($zoom ? '&zoom='.$zoom : '')) : '' );
        $ret = file_get_contents($href);
        return $ret;
    }
}

/**
 * 包含文件
 * @param $data
 */
if( !function_exists('include_file')){
    function include_file($data){
        if(is_array($data)){
            foreach($data as $item){
                include VIEWPATH.$item.'.php';
            }
            return;
        }else{
            include VIEWPATH.$data.'.php';
        }
    }
}


function admin_accounts(){
    if(!isset($_SESSION['wid'])){
        redirect('control/index/empty_account');
    }
}