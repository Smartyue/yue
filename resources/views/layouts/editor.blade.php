<link rel="stylesheet" type="text/css" href="{{asset('utils/simditor/styles/simditor.css')}}" />
<script src="{{asset('utils/simditor/scripts/jquery.min.js')}}"></script>
<script src="{{asset('utils/simditor/scripts/module.js')}}"></script>
<script src="{{asset('utils/simditor/scripts/hotkeys.js')}}"></script>
<script src="{{asset('utils/simditor/scripts/uploader.js')}}"></script>
<script src="{{asset('utils/simditor/scripts/simditor.js')}}"></script>
<textarea id="editor" placeholder="test" autofocus></textarea>
<script>
    var editor=new Simditor({
        textarea:$('#editor'),
        placeholder: '',
        defaultImage: 'images/image.png',
        params: {},
//        upload: true,
        tabIndent: true,
        toolbar: true,
        toolbarFloat: true,
        toolbarFloatOffset: 0,
        toolbarHidden: false,
        pasteImage: false,
        cleanPaste: false,
        upload : {
            url : 'Upload', //文件上传的接口地址
            params: null, //键值对,指定文件上传接口的额外参数,上传的时候随文件一起提交
            fileKey: 'fileDataFileName', //服务器端获取文件数据的参数名
            connectionCount: 3,
            leaveConfirm: '正在上传文件'
        }
    });
</script>