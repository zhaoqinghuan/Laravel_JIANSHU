//声明Wangeditor的创建对象
var editor = new wangEditor('content');

//判断当前页面有编辑器才进行编辑器初始化
if(editor.config){
    //配置编辑器的图片上传路径
        editor.config.uploadImgUrl = '/post/image/upload';

    // js设置 csrf_token的headers
        editor.config.uploadHeaders = {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        };
    //创建编辑器
        editor.create();
}


//个人设置页面上传图片并预览
$('.preview_input').change(function(event){
    //  获取点击后传入的文件名
    var file = event.currentTarget.files[0];
    //  获取点击上传后传入的文件所在路径
    var url = window.URL.createObjectURL(file);
    //  将获取到的路径在指定位置进行展示
    $(event.target).next('.preview_img').attr('src',url);
})