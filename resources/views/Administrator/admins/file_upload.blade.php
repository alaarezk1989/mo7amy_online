@extends(ADI.'.master')
@section('content')
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Multiple File Upload
<small>amazing file upload experience</small>
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
<div class="col-md-12">
    {!! Form::open(['files' => true,'method'=>'POST','id'=>'fileupload','url'=>'uploads']) !!}
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn green fileinput-button">
                    <i class="fa fa-plus"></i>
                    <span> Add files... </span>
                    <input type="file" name="files[]" multiple=""> </span>
                <button type="submit" id="UploadBTN" class="btn blue start">
                    <i class="fa fa-upload"></i>
                    <span> Start upload </span>
                </button>
                <button type="reset" class="btn warning cancel">
                    <i class="fa fa-ban-circle"></i>
                    <span> Cancel upload </span>
                </button>
                <button type="button" class="btn red delete">
                    <i class="fa fa-trash"></i>
                    <span> Delete </span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"> </span>
            </div>
            <!-- The global progress information -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended"> &nbsp; </div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped clearfix">
            <tbody class="files"> </tbody>
        </table>
    {!! Form::close() !!}

</div>
</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
<div class="slides"> </div>
<h3 class="title"></h3>
<a class="prev"> ‹ </a>
<a class="next"> › </a>
<a class="close white"> </a>
<a class="play-pause"> </a>
<ol class="indicator"> </ol>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
<tr class="template-upload fade">
    <td>
        <span class="preview"></span>
    </td>
    <td>
        <p class="name">{%=file.name%}</p>
        <strong class="error text-danger label label-danger"></strong>
    </td>
    <td>
        <p class="size">Processing...</p>
        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
        </div>
    </td>
    <td> {% if (!i && !o.options.autoUpload) { %}
        <button class="btn blue start" disabled>
            <i class="fa fa-upload"></i>
            <span>Start</span>
        </button> {% } %} {% if (!i) { %}
        <button class="btn red cancel">
            <i class="fa fa-ban"></i>
            <span>Cancel</span>
        </button> {% } %} </td>
</tr> {% } %} </script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
<tr class="template-download fade">
    <td>
        <span class="preview"> {% if (file.thumbnailUrl) { %}
            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
                <img src="{%=file.thumbnailUrl%}">
            </a> {% } %} </span>
    </td>
    <td>
        <span class="size">{%=o.formatFileSize(file.size)%}</span>
    </td>
    <td> {% if (file.deleteUrl) { %}
        <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
            <i class="fa fa-trash-o"></i>
            <span>Delete</span>
        </button>
        <input type="checkbox" name="delete" value="1" class="toggle"> {% } else { %}
        <button class="btn yellow cancel btn-sm">
            <i class="fa fa-ban"></i>
            <span>Cancel</span>
        </button> {% } %} </td>
</tr> {% } %} </script>

<script type="text/javascript">
    $(document).ready(function(){
        // $('#UploadBTN').on('click', function() {
        //     var url = $('#fileupload').attr('action');
        //     var data = $('#fileupload').serialize();
        //     $.ajax({
        //       type:'post',
        //       url: url,
        //       dataType:'json',
        //       data:data,
        //       success: function(result){
        //         if(result.success){
        //             location.reload();
        //         }
        //     }});
        //     return false;
        //   });

        // $('#fileupload').fileupload({
        //     dataType: 'json',
        //     done: function (e, data) {
        //         alert('meme');
        //     }
        // });
    });
</script>
@stop
