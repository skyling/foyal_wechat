<?php
/**
 *
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/3 17:00
 */
$config['wechat_service'] = array(
    'app_id' => 'wx80fad4f7fa679eab',
    'app_secret' => '61537a778a0e97085e55e199ebd732a1',
    'url' => array(
        'access_token'      => 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s',//获取access_token
        'get_callback_ip'   => 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=%s',//获取调用服务器IP
        //客服账号管理
        'kf_account'        => array(
            'add'           => 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token=%s',//客服账号 添加
            'update'        => 'https://api.weixin.qq.com/customservice/kfaccount/update?access_token=%s',//客服账号 修改
            'del'           => 'https://api.weixin.qq.com/customservice/kfaccount/del?access_token=%s',//客服账号 删除
            'uploadheadimg' => 'http://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token=%s&kf_account=%s',//设置客服帐号的头像
            'getkflist'     => 'https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=%s',//获取所有客服账号
            'send_message'  => 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=%s',
        ),
        //目录
        'menu'              => array(
            'create'        => 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s',//创建目录
            'get'           => 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=%s',//获取目录
            'delete'        => 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=%s',//删除目录
            'menu_info'     => 'https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=%s',//获取原有的信息
        ),
        //用户分组
        'groups'            => array(
            'create'        => 'https://api.weixin.qq.com/cgi-bin/groups/create?access_token=%s',//创建分组
            'get'           => 'https://api.weixin.qq.com/cgi-bin/groups/get?access_token=%s',//获取分组
            'getid'         => 'https://api.weixin.qq.com/cgi-bin/groups/getid?access_token=%s',//获取用户分组
            'update'        => 'https://api.weixin.qq.com/cgi-bin/groups/update?access_token=%s',//更新分组
            'm_update'      => 'https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=%s',//用户移动分组
            'm_batchupdate' => 'https://api.weixin.qq.com/cgi-bin/groups/members/batchupdate?access_token=%s',//批量移动分组
            'delete'        => 'https://api.weixin.qq.com/cgi-bin/groups/delete?access_token=%s',//删除分组
        ),
        //用户
        'user'              => array(
            'info_update_remark' => 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=%s',//修改用户备注
            'info'          => 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=%s&openid=$s&lang=%s',//用户信息
            'info_batch_get'     => 'https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=%s',//批量获取用户信息
            'get'           => 'https://api.weixin.qq.com/cgi-bin/user/get?access_token=%s&next_openid=%s',//获取用户列表
        ),
        //二维码
        'qcode'             => array(
            'create'        => 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s',//创建二维码
            'show_code'     => 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=%s',//获取二维码
            'short_url'     => 'https://api.weixin.qq.com/cgi-bin/shorturl?access_token=%s',//短连接
        ),
        //素材
        'material'          => array(
            'upload' => 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=%s&type=%s',
        ),
    ),
);