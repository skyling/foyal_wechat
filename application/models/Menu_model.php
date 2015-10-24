<?php
/**
 * 菜单模型
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/6 17:43
 */

class Menu_model extends Base_Model {

    const TB_MENU_TYPE = 'menu_type';//菜单类型
    const TB_MENU_HIST = 'menu_history';//菜单历史

    function __construct(){
        $this->_table_name = 'menu';
        parent::__construct();

    }

    /**
     * 获取当前菜单
     * @param $uid
     * @param $wid
     * @param bool $sub
     * @return mixed
     */
    public function get_current_menu($uid, $wid, $sub = TRUE){
        $map = array(
            'uid' => $uid,
            'wid' => $wid,
        );
        $data = $this->get_data($map);
        if(!$sub) return $data;
        $menu = $this->sort_menu($data);
        return $menu;
    }

    /**
     * 获取信息
     * @param $id
     * @param $uid
     * @param $wid
     * @return mixed
     */
    public function get_info($id, $uid, $wid){
        $map = array(
            'id' => $id,
            'wid' => $wid,
            'uid' => $uid,
        );
        return $this->get_item('id,pid,type_id,name,value,description,sort,status', $map);
    }

    /**
     * 获取菜单类型
     */
    public function get_menu_type(){
        $map = array(
            'status' => 1,
        );
        $data = $this->get_list('id,title,type,content,description', 0, NULL, $map, 'id asc', NULL, self::TB_MENU_TYPE);
        return $data;
    }

    /**
     * 获取父级菜单
     * @param $uid
     * @param $wid
     * @return mixed
     */
    public function get_parent_menu($uid, $wid){
        $map = array(
            'pid' => 0,
            'uid' => $uid,
            'wid' => $wid,
        );
        $data = $this->get_list('*', 0, NULL, $map);
        return $data;
    }

    /**
     * 获取菜单
     * @param $id
     * @param $uid
     * @param $wid
     * @return array|mixed
     */
    public function get_post_menu($id, $uid, $wid, $json = FALSE){
        $map = array(
            'm.uid' => $uid,
            'm.wid' => $wid,
            'm.status' => 1,
        );
        if($id == 0){//获取当前目录信息
            $data = $this->get_data($map);
            $data = $this->sort_menu($data);
            if($data && $json){
                $menu['button'] = array();
                foreach($data as $item){
                    if(isset($item['sub_button']) && is_array($item['sub_button'])){
                        unset($sub_button);
                        foreach($item['sub_button'] as $s_item){
                            $sub_button[] = array(
                                'type' => $s_item['type'],
                                'name' => urlencode($s_item['name']),
                                $s_item['key'] => $s_item['value'],
                            );
                        }
                        $menu['button'][] = array(
                            'name' => urlencode($item['name']),
                            'sub_button' => $sub_button,
                        );
                    }else{
                        $menu['button'][] = array(
                            'type' => $item['type'],
                            'name' => urlencode($item['name']),
                            $item['key'] => $item['value'],
                        );
                    }
                }
                $menu = urldecode(json_encode($menu));
            }else{
                $menu = $data;
            }
        }else{
            $map = array(
                'id' => $id,
                'uid' => $uid,
                'wid' => $wid,
            );
            $menu = $this->get_item('content',$map,self::TB_MENU_HIST);
            $menu = $menu['content'];
            if(!$json){
                $menu = json_decode($menu, TRUE);
                $menu = $menu['button'];
            }

        }
        return $menu;
    }

    /**
     * 获取历史目录
     * @param $uid
     * @param $wid
     * @param int $p
     * @return mixed
     */
    public function get_history_menu($uid, $wid,$from = 0, $limit=10){
        $map = array(
            'uid'=>$uid,
            'wid' => $wid,
        );
        $data = $this->menu_model->get_list('*', $from, $limit, $map, 'create_time desc', NULL, self::TB_MENU_HIST);
        return $data;
    }

    /**
     * 获取启动的目录个数
     * @param $id
     * @param $uid
     * @param $wid
     * @return bool
     */
    public function get_menu_count($id, $uid, $wid){
        $map = array(
            'id' => $id,
            'uid' => $uid,
            'wid' => $wid,
        );
        $info = $this->get_item('pid', $map);
        if(!$info) return FALSE;
        if($info['pid'] != 0){//子目录
            $map = array(
                'pid' => $info['pid'],
                'uid' => $uid,
                'wid' => $wid,
                'status' => 1,
            );
            $ret['sub'] = TRUE;
            $ret['count'] = $this->get_count($map);

        }else{
            $map = array(
                'pid' => $info['pid'],
                'uid' => $uid,
                'wid' => $wid,
                'status' => 1,
            );
            $ret['sub'] = FALSE;
            $ret['count'] = $this->get_count($map);
        }
        return $ret;
    }

    /**
     * 添加历史菜单
     * @param $uid
     * @param $wid
     * @param $data
     * @return mixed
     */
    public function add_history_menu($uid, $wid, $data){
        $data = array(
            'uid' => $uid,
            'wid' => $wid,
            'content' => $data,
            'create_time' => time(),
        );
        $this->insert($data, self::TB_MENU_HIST);
        return $this->db->insert_id();
    }

    /**
     * 获取目录数据
     * @param $map
     * @param string $filed
     * @return mixed
     */
    private function get_data($map, $filed = ''){
        //$uid, $wid
        $filed = $filed ? $filed : 't.type,t.content "key",m.id,m.uid,m.pid,m.type_id,m.name,m.value,m.description,m.sort,m.status';
        $data = $this->db
            ->select($filed)
            ->from($this->_table_name.' m')
            ->join($this->db->dbprefix.self::TB_MENU_TYPE.' t',' m.type_id=t.id')
            ->where($map)
            ->order_by('m.sort asc')
            ->get()->result_array();
        return $data;
    }

    /**
     * 排序菜单
     * @param $data
     * @return mixed
     */
    private function sort_menu($data){
        if($data){
            foreach($data as $item){
                $menu[$item['pid']][] = $item;
            }
            if(isset($menu[0])){
                foreach($menu[0] as $key=>$item){
                    !isset($menu[$item['id']]) || $menu[0][$key]['sub_button'] = $menu[$item['id']] ;
                }
                $data = $menu[0];
            }
        }
        return $data;
    }

}