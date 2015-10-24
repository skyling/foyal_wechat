<?php $this->load->view('control/public/head');?>
<?php $this->load->view('control/public/js')?>
<div class="pd-20">
    <div id="total"><?php echo $total;?></div>
    <div id="p"><?php echo isset($p) ? $p : 0?></div>
    <div class="progress"><div class="progress-bar"><span id="progress" class="sr-only" style="width:0%"></span></div></div>
</div>
<script type="text/javascript">
    var p = 0;
    var url = "<?php echo site_url('control/service/get_batch_user_info/'.$total)?>/";
    $total = <?php echo $total?>;
    var test = function(status){
        tmpurl = url + p;
        if(status != 1){
            setTimeout(ajaxget(tmpurl,function(data){
                data = eval('('+data+')');
                if(data.all == 0){
                    p = data.p;
                    $('#p').html(""+p);
                    $("#progress").attr('style','width:'+((p*10000)/data.total)+'%');
                    test(data.all);
                }
            }),1000);
        }
    }
    $(document).ready(function(){
        if($total > 0 ){
            test(0);
        }
    });
</script>
</body>
</html>