@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">Article</a> > <a href="#" class="current">Edit Article</a> </div>
    <h1>Edit Article</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Article</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit_article/'.$article->id)}}" name="edit_article" id="edit_article" enctype="multipart/form-data" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Page</label>
                <div class="controls">
                  <input type="text" name="page" id="page" style="width:350px;" value="{{$article->page}}">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" style="width:350px;" value="{{$article->title}}">
                </div>
              </div>

           

              <div class="control-group">
                <label class="control-label">Description <small>(with hyperlink support)</small></label>
                <div class="controls">
                  <textarea name="description" id="description" rows="10" style="width:80%;">{{$article->description}}</textarea>
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Update Article" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('description', {
    toolbar: [
      ['Source', '-', 'NewPage', 'Preview', '-', 'Templates'],
      ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Print', 'SpellChecker', 'Scayt'],
      ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
      ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
      ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
      ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'],
      ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
      ['Link', 'Unlink', 'Anchor'],  // Hyperlink support
      ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'],
      ['Styles', 'Format', 'Font', 'FontSize'],
      ['TextColor', 'BGColor'],
      ['Maximize', 'ShowBlocks']
    ],
    height: 300,
    allowedContent: true,
    extraAllowedContent: 'a[!href,target,title];',  // Allow hyperlinks
    removeButtons: 'Save,NewPage,Preview,Templates,Form,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Smiley,PageBreak,ShowBlocks'
  });
</script>
@endsection