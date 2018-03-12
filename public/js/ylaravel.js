
//设置AJAX启动的时候自动添加的csrf_token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//  声明Wangeditor的创建对象
var editor = new wangEditor('content');

//  判断当前页面有编辑器才进行编辑器初始化
if (editor.config) {
    //配置编辑器的图片上传路径
    editor.config.uploadImgUrl = '/post/image/upload';

    // js设置 csrf_token的headers
    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };
    //创建编辑器
    editor.create();
}

//  个人设置页面上传图片并预览
$('.preview_input').change(function (event) {
    //  获取点击后传入的文件名
    var file = event.currentTarget.files[0];
    //  获取点击上传后传入的文件所在路径
    var url = window.URL.createObjectURL(file);
    //  将获取到的路径在指定位置进行展示
    $(event.target).next('.preview_img').attr('src', url);
})

//  关注部分JS
$(".like-button").click(function (event) {//事件绑定
    target = $(event.target);//获取标签
    var current_like = target.attr("like-value");//获取当前标签的like-value值
    var user_id = target.attr("like-user");//获取当前标签进行操作的目标ID值
    if (current_like == 1) {
        //取消关注
        $.ajax({
            url: "/user/" + user_id + "/unfan",
            method: "POST",
            dataType: "json",
            success: function (data) {
                //如果返回值的error !=0 则取消关注失败
                if (data.error != 0) {
                    alert(data.msg);
                    return;
                }
                //否则取消关注成功 将按钮改成关注
                target.attr("like-value", 0);
                target.text("关注");
            }
        });
    } else {
        //关注
        $.ajax({
            url: "/user/" + user_id + "/fan",
            method: "POST",
            dataType: "json",
            success: function (data) {
                //如果返回值的error !=0 则关注失败
                if (data.error != 0) {
                    alert(data.msg);
                    return;
                }
                //否则关注成功 将按钮改成取消关注
                target.attr("like-value", 1);
                target.text("取消关注");
            }
        });
    }
})
