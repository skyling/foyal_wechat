/**
 * Created by v_frli on 2015/10/15.
 */
/**
 * 定时刷新
 * @param t
 */
var reload = function(t){
    setTimeout(function(){
        window.location.reload();
    },t);
}
/**
 * 定时跳转
 * @param url
 * @param t
 */
var redirect = function(url,t){
    setTimeout(function(){
        window.location.href = url;
    },t);
}

function set_status(obj,id,url){
    var status = $(obj).attr('data-status');
    if(status == 1){
        $(obj).parents("tr").find(".article-manage").prepend('<a style="text-decoration:none" data-status=\''+(1-status)+'\' onClick="set_status(this,\''+id+'\',\''+url+'\')" href="javascript:;"  title="启用"><i class="icon-hand-up"></i></a>');
        $(obj).parents("tr").find(".article-status").html('<span class="label radius">已禁用</span>');
        $(obj).remove();
    }else{
        $(obj).parents("tr").find(".article-manage").prepend('<a style="text-decoration:none" data-status=\''+(1-status)+'\' onClick="set_status(this,\''+id+'\',\''+url+'\')" title="禁用"><i class="icon-hand-down"></i></a>');
        $(obj).parents("tr").find(".article-status").html('<span class="label label-success radius">已启用</span>');
        $(obj).remove();
    }
    layer.msg(url+status+'='+id,1,9);
}



/**
 * ajax删除
 * @param obj
 * @param id
 * @param url
 * @returns
 */
function ajax_get(){
    $(".ajax-get").on('click',function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        layer.confirm('确认此操作？',function(index){
            layer.msg('正在处理，请稍后。。。');
            ajaxget(url,function(msg){
                msg = eval("("+msg+")");
                if(msg.status == 'y'){
                    layer.msg(msg.info,{icon: 6,time:2000});
                    reload(1000);
                }else{
                    layer.msg(msg.info,{icon: 5,time:2000});
                }
            });
        });
    });
}

/**
 * ajax get异步请求
 */
var ajaxget = function(url,fun){
    $.get(url,function(msg){
        fun(msg);
    });
};

var ajaxpost = function(url, data, fun){
    $.ajax({
        type:'POST',
        url:url,
        data:data,
        success:fun
    });
}

var ajax_del = function(){
    $('.ajax_del').on('click', function(e){
        e.preventDefault();
        var checked = $('input[name="ids"]:checked');
        if(checked.length == 0){
            layer.msg('请选择需要删除的数据',{icon: 0,time:2000});
        } else {
            var id = new Array(),
                url = $(this).attr('href');
            checked.each(function(){
                id.push($(this).val());
            });

            layer.confirm('确认此操作？',function(){
                ajaxpost(url,{id:id},function(msg){
                    msg = eval("("+msg+")");
                    if(msg.status == 'y'){
                        layer.msg(msg.info,{icon: 6,time:1000});
                        reload(1000);
                    }else{
                        layer.msg(msg.info,{icon: 5,time:1000});
                    }
                });
            });

        }
    });
}

var table_sort = function(){
    var tabs = $('.table-sort').html();
    if(tabs != undefined){
        $('.table-sort').dataTable({
            "lengthMenu":false,//显示数量选择
            "bFilter": true,//过滤功能
            "bPaginate": false,//翻页信息
            "bInfo": false,//数量信息
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,-1]}// 制定列不参与排序
            ]
        });
    }
}


var pagination = function(){
    $('#pagination').change(function(){
        var url = $(this).attr('data-href');
        if(url !== undefined){
            window.location.href = url+$(this).val();
        }else{
            alert('Error');
        }
    });
}

var change_account = function(){
    $('#')
}
/**
 * 调用函数
 */
$(function(){
    ajax_get();//ajaxget操作
    ajax_del();//ajax删除
    table_sort();//表单排序
    pagination();
});
