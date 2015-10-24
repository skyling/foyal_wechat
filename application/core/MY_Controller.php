<?php
/**
 *
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/1 23:15
 */

class Wechat_Controller extends CI_Controller{

    protected $_config;//配置文件
    protected $_post_obj;//post数据对象

    protected $_post_data;//接收消息
    protected $_data;//回复消息
    protected $_open_id;//账号识别码
    protected $_token;//TOKEN
    protected $_wa_id;//微信公众平台凭证ID

    // = array(
        /*'to_user_name' => 'ToUserName',
        'from_user_name' => 'FromUserName',
        'create_time' => 'CreateTime',
        'msg_type' => 'MsgType',
        'msg_id' => 'MsgId',
    );*/
    /*//不同消息类型字段
    protected $_msg_filed = array(
        'text' => array('content'=>'Content'),
//        文本消息 文本消息内容
        'image' => array('pic_url'=>'PicUrl','media_id'=>'MediaId'),
//        图片消息 图片链接 图片消息媒体id，可以调用多媒体文件下载接口拉取数据。
        'voice' => array('media_id'=>'MediaId', 'format'=>'Format','recognition'=>'Recognition'),
//        语音消息 语音消息媒体id，可以调用多媒体文件下载接口拉取数据。  语音格式，如amr，speex等 语音识别结果
        'video' => array('media_id'=>'MediaId', 'thumb_media_id'=>'ThumbMediaId'),
//        视频消息 视频消息媒体id，可以调用多媒体文件下载接口拉取数据。  视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
        'shortvideo' => array('media_id'=>'MediaId', 'thumb_media_id'=>'ThumbMediaId'),
//       小视频消息 视频消息媒体id，可以调用多媒体文件下载接口拉取数据。 视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
        'location' => array('location_x'=>'Location_X', 'location_y'=>'Location_Y', 'scale'=>'Scale', 'label'=>'Label'),
//       地理位置消息 地理位置维度 地理位置经度 地图缩放大小 地理位置信息
        'link' => array('title'=>'Title', 'description'=>'Description', 'url'=>'Url'),
//       链接消息 消息标题 消息描述 消息链接
    );*/

    /**
     * 构造函数
     */
    function __construct()
    {
        parent::__construct();

        $this->config->load('wechat');
        $this->_config = $this->config->item('wechat');
        $this->_valid_open_id();
        $this->_valid();//消息验证
        $this->_init_data();
    }

    /**
     * 验证是否正确
     */
    private function _valid_open_id(){
        $open_id = $this->input->get('open_id');
        if(!$open_id) exit(1);
        $this->load->model('wechat/wxauth_model');
        if( !($data = $this->wxauth_model->auth_open_id($open_id)) ){
            show_error(400,'NO OPEN_ID');
            exit(1);
        }
        $this->_token = $data['token'];
        $this->_wa_id = $data['id'];
        $this->_open_id = $open_id;
    }

    /**
     * 验证消息
     * @throws Exception
     */
    private function _valid()
    {
        $echoStr = $this->input->get('echostr');
        //valid signature , option
        if($echoStr && $this->_check_signature()){
            echo $echoStr;
            exit;
        }
    }

    /**
     * 验证签名
     * @return bool
     * @throws Exception
     */
    private function _check_signature()
    {
        // you must define TOKEN by yourself
        if ( !$this->_token ) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $this->input->get("signature");
        $timestamp = $this->input->get("timestamp");
        $nonce = $this->input->get("nonce");

        $tmpArr = array($this->_token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    /**
     *  初始化消息
     */
    private function _init_data()
    {
        $post_str = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"] : file_get_contents('php://input');
        if(!empty($post_str)){
            libxml_disable_entity_loader(true);
            $this->_post_obj = simplexml_load_string($post_str, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->_post_data = json_decode(json_encode((array) simplexml_load_string($post_str, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
            $this->_data['to_user_name'] = $this->_post_data['ToUserName'];
            $this->_data['from_user_name'] = $this->_post_data['FromUserName'];
            $this->_data['time'] = time();
        }
    }

    /**
     * 回复文本消息
     * @param $content
     */
    public function response_text($content)
    {
        $this->_data['content'] = $content;
        $this->response('text');
    }

    /**
     * 回复图片消息
     * @param $media_id
     */
    public function response_image($media_id)
    {
        $this->_data['media_id'] = $media_id;
        $this->response('image');
    }

    /**
     * 回复语音消息
     * @param $media_id
     */
    public function response_voice($media_id)
    {
        $this->_data['media_id'] = $media_id;
        $this->response('voice');

    }

    /**
     * 回复视频消息
     * @param $media_id
     * @param $title
     * @param $description
     */
    public function response_video($media_id, $title, $description)
    {
        $this->_data['media_id'] = $media_id;
        $this->_data['title'] = $title;
        $this->_data['description'] = $description;
        $this->response('video');
    }

    /**
     * 回复音乐消息
     * @param $title
     * @param $description
     * @param $music_url
     * @param $hq_music_url
     * @param $thumb_media_id
     */
    public function response_music($title, $description, $music_url, $hq_music_url, $thumb_media_id)
    {
        $this->_data['title'] = $title;
        $this->_data['description'] = $description;
        $this->_data['music_url'] = $music_url;
        $this->_data['hq_music_url'] = $hq_music_url;
        $this->_data['thumb_media_id'] = $thumb_media_id;
        $this->response('music');
    }

    /**
     * 回复图文消息 title description picurl url
     * @param $data
     */
    public function response_news($data)
    {
        $this->_data['count'] = count($data);
        $this->_data['data'] = $data;
        $this->response('news');
    }

    /**
     * 回复消息
     * @param $type
     */
    private function response($type)
    {
        $arr = array('text', 'image', 'video', 'voice', 'news', 'music');
        if(in_array($type, $arr)){
            $this->load->view('wechat/'.$type, $this->_data);
        }
    }
}

/**
 * 后台管理控制器
 * Class Admin_Controller
 */
class Admin_Controller extends CI_Controller{

    protected $_uid;//用户ID
    protected $_username;//用户名
    protected $_open_id;//当前管理的微信ID
    protected $_wx_accounts;//当前用户管理的所有账号
    protected $_wid;//wxauth id
//    protected $_default_account;//默认ID
    protected $_data;//视图数据
    protected $_config;//配置文件

    function __construct(){
        parent::__construct();
        $this->config->load('control');
        $this->_config = $this->config->item('control');
        admin_is_login();
        list($this->_uid, $this->_username) = explode(',',$_SESSION['au']);
        $this->_data['username'] = $this->_username;
        $this->get_accounts();
    }

    /**
     * 获取账号信息
     */
    private function get_accounts(){
        $this->load->model('wxauth_model');
        $this->_data['wx_accounts'] = $this->wxauth_model->get_accounts($this->_uid);
        $this->_wx_accounts = $this->_data['wx_accounts'];
        if($this->_data['wx_accounts']){
            if(count($this->_data['wx_accounts']) == 1 ){
                $tmp = $this->_data['wx_accounts'][0];
            }else{
                foreach($this->_data['wx_accounts'] as $item){
                    $tmp = $item;
                    if(isset($_SESSION['wid'])){
                        if($item['id'] == $_SESSION['wid']){
                            break;
                        }
                    }else{
                        if($item['default'] == 1){
                            break;
                        }
                    }
                }
            }
            if($tmp){
                //$item = $this->_data['wx_accounts'][0];
                $this->_open_id = $tmp['open_id'];
                $this->_data['default_account'] = $tmp;
                $_SESSION['wid'] = $tmp['id'];
                $this->_wid = $tmp['id'];
                return;
            }
        }
        $this->_data['empty_account'] = TRUE;
    }

    /**
     * 删除数据
     * @param bool $id
     */
    protected function __delete($model = NULL, $id = FALSE){
        if(!$model) return FALSE;
        $id = $id ? $id : $this->input->get_post('id') ;
        if($model->delete($id)){
            ajax_return_data();
        }
        ajax_return_data(1);
    }

    /**
     * 改变状态
     * @param int $id
     * @param int $status
     */
    protected function __set_status($model = FALSE, $id = 0, $status= 0){
        if(!$model) return FALSE;
        $id = $id ? $id : $this->input->get_post('id');
        $status = $status ? $status : $this->input->get_post('status');
        if($model->set_status((int)$id, (int)$status)){
            ajax_return_data();
        }
        ajax_return_data(1);
    }

    /**
     * 改变字段值
     * @param bool $model
     * @param int $id
     * @param $data
     * @return bool
     */
    protected function __change_filed($model = FALSE, $id = 0, $data){
        if(!$model && !is_array($data)) return FALSE;
        $id = $id ? $id : $this->input->get_post('id');
        if($model->update(array('id'=>(int)$id), $data)){
            ajax_return_data();
        }
        ajax_return_data(1);
    }
}
