<?php
/**
 * 发送客服消息类 TODO 补充完整
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/4 0:01
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Base_service.php';

class Custom_message_Service extends Base_service{

    function __construct(){
        parent::__construct();
    }

    /**
     * 发送文本消息
     * @param $token
     * @param $open_id
     * @param $content
     * @return bool
     */
    public function send_text_msg($token, $open_id, $content, $kf_account = NULL){
        $arr = array(
            'touser' => $open_id,
            'msgtye' => 'text',
            'text' => array('content'=> $content),
        );
        !$kf_account || $arr['customservice']['kf_account'] = $kf_account;
        return $this->_send_msg($token, $arr);
    }

    /**
     * 发送图片消息
     * @param $token
     * @param $open_id
     * @param $media_id
     * @return bool
     */
    public function send_image_msg($token, $open_id, $media_id, $kf_account = NULL){
        $arr = array(
            'touser' => $open_id,
            'msgtye' => 'image',
            'image' => array('media_id'=> $media_id),
        );
        !$kf_account || $arr['customservice']['kf_account'] = $kf_account;
        return $this->_send_msg($token, $arr);
    }

    /**
     * 发送语音消息
     * @param $token
     * @param $open_id
     * @param $media_id
     * @return bool
     */
    public function send_voice_msg($token, $open_id, $media_id, $kf_account = NULL){
        $arr = array(
            'touser' => $open_id,
            'msgtye' => 'voice',
            'voice' => array('media_id'=> $media_id),
        );
        !$kf_account || $arr['customservice']['kf_account'] = $kf_account;
        return $this->_send_msg($token, $arr);
    }

    /**
     * 发送视频消息
     * @param $token
     * @param $open_id
     * @param $media_id
     * @param $thumb_media_id
     * @param $title
     * @param $description
     * @return bool
     */
    public function send_video_msg($token, $open_id, $media_id, $thumb_media_id, $title, $description, $kf_account = NULL){
        $arr = array(
            'touser' => $open_id,
            'msgtye' => 'video',
            'video' => array('media_id'=> $media_id, 'thumb_media_id'=> $thumb_media_id, 'title'=>$title, 'description'=>$description),
        );
        !$kf_account || $arr['customservice']['kf_account'] = $kf_account;
        return $this->_send_msg($token, $arr);
    }

    /**
     * 发送音乐消息
     * @param $token
     * @param $open_id
     * @param $title
     * @param $description
     * @param $musicurl
     * @param $hqmusicurl
     * @param $thumb_media_id
     * @return bool
     */
    public function send_music_msg($token, $open_id, $title, $description, $musicurl, $hqmusicurl, $thumb_media_id, $kf_account = NULL){
        $arr = array(
            'touser' => $open_id,
            'msgtye' => 'music',
            'music' => array('title'=> $title, 'description'=> $description, 'musicurl'=>$musicurl, 'hqmusicurl'=>$hqmusicurl, 'thumb_media_id'=>$thumb_media_id),
        );
        !$kf_account || $arr['customservice']['kf_account'] = $kf_account;
        return $this->_send_msg($token, $arr);
    }

    /**
     * 发送图文消息
     * @param $token
     * @param $open_id
     * @param $data
     * @return bool
     */
    public function send_news_msg($token, $open_id, $data, $kf_account = NULL){
        $arr = array(
            'touser' => $open_id,
            'msgtye' => 'news',
            $arr['news']['articles'] = $data,
        );
        !$kf_account || $arr['customservice']['kf_account'] = $kf_account;
        return $this->_send_msg($token, $arr);
    }

    /**
     * 发送卡券消息
     * @param $token
     * @param $open_id
     * @param $card_id
     * @param $card_ext
     */
    public function send_wxcard_msg($token, $open_id, $card_id, $card_ext, $kf_account = NULL){
        //TODO
        $arr = array();
        !$kf_account || $arr['customservice']['kf_account'] = $kf_account;
    }

    /**
     * 发送消息
     * @param $token
     * @param $data
     * @return bool
     */
    private function _send_msg($token, $data){
        $url = sprintf($this->_config['url']['kf_account']['send_message'], $token);
        $data = json_encode($data);
        $ret = $this->http->post($url, $data);
        if( $ret['statusCode'] == 200 ){
            return $ret['body'];
        }
        return FALSE;
    }
}