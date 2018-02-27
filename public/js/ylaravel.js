//声明Wangeditor的创建对象
var editor = new wangEditor('content');
//配置编辑器的图片上传路径
editor.config.uploadImgUrl = '/post/image/upload';

// js设置 csrf_token的headers
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
};
//创建编辑器
editor.create();