<?php $this->load->view('control/public/head');?>
<div class="pd-20">
    <table class="table table-border table-bg table-bordered">
        <thead>
        <tr><th width="20%">一级菜单</th><th colspan="5">二级菜单</th></tr>
        </thead>
        <tbody>
        <?php if(isset($info))foreach($info as $item){
            echo '<tr><th class="active">'.$item['name'].'</th>';
            if(isset($item['sub_button'])){
                for($i=0;$i<5;$i++){
                    echo '<td>'.(isset($item['sub_button'][$i]) ? $item['sub_button'][$i]['name'] : '').'</td>';
                }
            }
            echo '</tr>';
        }?>
        </tbody>
    </table>
    <div class="text-c mt-10"><a class="btn btn-success radius ajax-get" href="<?php echo site_url('control/service/set_menu/').'/'.$id;?>">确定应用</a></div>
</div>
<?php $this->load->view('control/public/js')?>
</body>
</html>