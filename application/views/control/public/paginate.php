<?php if(isset($paginate) && $paginate['page_total']>1) {?>
    <div class="dataTables_wrapper">
    <div class="dataTables_paginate paging_simple_numbers" style="text-align: center;float: none">
        <?php echo '<a class="paginate_button" href="'.$paginate['base_url'].'1">首页</a>';?>
        <?php echo '<a class="paginate_button previous" href="'.($paginate['active'] <= 1 ? 'javascript:;' : $paginate['base_url']).($paginate['active']-1).'">上一页</a>';?>
    <span>
        <?php
            for($i=$paginate['start_num']; $i<($paginate['start_num'] + $paginate['page_num']); $i++) {
                if($paginate['active'] == $i){
                    echo '<a href="javascript:;" class="paginate_button current">'.$i.'</a>';
                }else{
                    echo '<a href="'.$paginate['base_url'].$i.'" class="paginate_button">'.$i.'</a>';
                }
            }
        ?>
    </span>
        <?php echo '<a class="paginate_button next" href="'.($paginate['active'] >= $paginate['page_total'] ? 'javascript:;' : $paginate['base_url']).($paginate['active']+1).'">下一页</a>';?>
        <?php echo '<a class="paginate_button" href="'.$paginate['base_url'].$paginate['page_total'].'">尾页</a>';?>
    </span>
        <select id="pagination" data-href="<?php echo $paginate['base_url']?>">
            <?php
                for($i=1;$i<=$paginate['page_total'];$i++){
                    echo '<option '.($paginate['active'] == $i ? 'selected' : '').'>'.$i.'</option>';
                }
            ?>
        </select>
        <span>共<?php echo $paginate['total'].'条/'.$paginate['page_total']?>页</span>
    </div></div>
<?php }?>