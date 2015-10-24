<?php
/**
 *
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/2 16:41
 */

class MY_Model extends CI_Model{}

class Base_Model extends MY_Model{

    protected $_table_name;//数据表名称
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /**
     * 获取列表信息
     * @param string $field 选取字段
     * @param int $from 从哪里开始
     * @param null $limit 读取条数
     * @param null $where 条件
     * @param string $order 排序方式
     * * @param string $distinct 查询中添加
     * @param null $table_name 表名
     * @return mixed
     */
    public function get_list($field='*', $from=0, $limit=NULL, $where=NULL, $order='id desc', $distinct=NULL, $table_name=NULL){
        $table_name = $table_name ? $table_name : $this->_table_name;
        $this->db->select($field);
        !$limit || $this->db->limit($limit, $from);
        !$where || $this->_where($where);
        !$order || $this->db->order_by($order);
        !$distinct || $this->db->distinct($distinct);
        $query = $this->db->get($table_name);
        $data = $query->result_array();
        $query->free_result();
        return $data;
    }



    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        if(is_array($id)){
            $this->db->where_in('id', $id);
        }else{
            $this->db->where('id',$id);
        }
        return $this->db->delete($this->_table_name);
    }

    /**
     * 获取一条内容
     * @param string $field
     * @param null $where
     * @param null $table_name
     * @return mixed
     */
    public function get_item($field='*', $where=NULL, $table_name=NULL){
        $table_name = $table_name ? $table_name : $this->_table_name;
        $this->db->select($field);
        !$where || $this->_where($where);
        $query = $this->db->get($table_name);
        $data = $query->row_array();
        $query->free_result();
        return $data;
    }

    /**
     * 获取数据表条数
     * @param null $where
     * @param null $table_name
     */
    public function get_count($where=NULL, $table_name=NULL){
        $table_name = $table_name ? $table_name : $this->_table_name;
        $this->db->select('ifnull(count(1),0) as num', FALSE);
        !$where || $this->_where($where);
        $query = $this->db->get($table_name);
        $result = $query->row_array();
        $query->free_result();
        return $result['num'];
    }

    /**
     * 添加数据
     * @param $data
     * @param null $table_name
     * @return mixed
     */
    public function insert($data, $table_name = NULL ){
        $table_name = $table_name ? $table_name : $this->_table_name;
        if(count($data) != count($data,TRUE)){
            return $this->db->insert_batch($table_name, $data);
        }
        $this->db->insert($table_name, $data);
        return  $this->db->insert_id();
    }

    /**
     * 跟新数据
     * @param string $where
     * @param $data
     * @return mixed
     */
    public function update($where='', $data, $table_name = NULL ){
        $table_name = $table_name ? $table_name : $this->_table_name;
        $this->db->set($data);
        !$where || $this->db->where($where);
        return $this->db->update($table_name);
    }


    /**
     * 改变状态
     * @param $id
     * @param $status
     * @return mixed
     */
    public function set_status($id, $status){
        return $this->db->where(array('id'=>$id))->set('status',$status)->update($this->_table_name);
    }

    /**
     * 判断记录是否存在
     * @param $map
     * @return bool
     */
    public function is_exist($map){
        if( $this->db->where($map)->count_all_results($this->_table_name) > 0 ) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * 查询条件语句拼合
     * @param string $where 数组,二维数据
     */
    protected function _where($where, $table='')
    {
        if(!is_array($where) || (count($where) == count($where, 1))){
            $this->db->where($where);
        }else{
            foreach($where as $key=>$value){
                foreach ($value as $k=>$v) {
                    $this->db->$key($table.$k,$v);
                }
            }
        }
    }


}



class Wechat_Model extends MY_Model{

    protected $_post_data;//微信post数据
    function __construct(){
        parent::__construct();
        $this->_init_data();//获取到数据
    }

    /**
     * 初始化数据
     */
    private function _init_data()
    {
        $post_str = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"] : file_get_contents('php://input');
        if(!empty($post_str)){
            libxml_disable_entity_loader(true);
            $this->_post_obj = simplexml_load_string($post_str, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->_post_data = json_decode(json_encode((array) simplexml_load_string($post_str, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        }
    }

}