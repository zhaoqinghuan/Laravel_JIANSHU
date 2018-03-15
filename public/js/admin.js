//  设置AJAX启动的时候自动添加的csrf_token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//  审核页面点击通过|拒绝按钮对应的js
$(".post-audit").click(function (event) {
    target = $(event.target);//点击事件发生时获取标签
    var post_id = target.attr("post-id");//获取标签中的post_id属性的值
    var status = target.attr("post-action-status");//获取标签中post-action-status属性的值
    //ajax启动
    $.ajax({
        url: "/admin/posts/" + post_id + "/status",
        method: "POST",
        data: { "status": status },
        dataType: "json",
        success: function success(data) {
            if (data.error != 0) {
                alert(data.msg);
                return;
            }
            target.parent().parent().remove();
        }
    });
});