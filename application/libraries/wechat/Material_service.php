<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 * 素材管理 TODO 补充完整
 * author: v_frli <frenlee@163.com>
 * since: 2015/10/8 14:21 
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Base_service.php';

class Material_service extends Base_service{

    function __construct(){
        parent::__construct();
    }

    /**
     * 上传临时素材
     * @param $open_id
     * @param $file_path
     * @param $type
     * @return bool
     */
    public function upload($open_id, $file_path, $type){
        if(!file_exists($file_path))show_error('File don\'t exist');
        $data['media'] = '@'.$file_path;
        $access_token = $this->get_access_token($open_id);
        $url = sprintf($this->_config['url']['menu']['delete'], $access_token, $type);
        $ret = $this->http->post($url,$data);
        if($ret['statusCode'] == 200 ){
            return $ret['body'];
        }
        return FALSE;
    }




}

/*  End of file Media_service.php*/