<?php
/**
 *
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/1 23:20
 */

class Wechat extends Wechat_Controller{

    /**
     * 构造函数
     */
    function __construct(){
        parent::__construct();
    }

    public function index(){
        switch($this->_post_data['MsgType']){
            case 'text' : $this->_deal_text();break;
            case 'image' : $this->_deal_image();break;
            case 'voice' : $this->_deal_voice();break;
            case 'video' : $this->_deal_video();break;
            case 'shortvideo' : $this->_deal_shortvideo();break;
            case 'location' : $this->_deal_location();break;
            case 'link' : $this->_deal_link();break;
            case 'event' : $this->_deal_event();break;
            default: break;
        }
    }

    /**
     * 处理文本消息
     */
    private function _deal_text(){
        $this->response_text('文本消息');
    }

    /**
     * 处理图片消息
     */
    private function _deal_image(){
        $this->response_text('图片消息');
    }

    /**
     * 处理声音消息
     */
    private function _deal_voice(){
        $this->response_text('声音消息');
    }

    /**
     * 处理视频消息
     */
    private function _deal_video(){
        $this->response_text('视频消息');
    }

    /**
     * 处理小视频消息
     */
    private function _deal_shortvideo(){
        $this->response_text('小视频消息');
    }

    /**
     * 处理地理位置消息
     */
    private function _deal_location(){
        $this->response_text('位置消息');
    }

    /**
     * 处理链接消息
     */
    private function _deal_link(){
        $this->response_text('链接消息');
    }

    /**
     * 处理事件消息
     */
    private function _deal_event(){
        $this->response_text('事件消息');
    }

}
