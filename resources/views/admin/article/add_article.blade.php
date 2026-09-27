@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">Article</a> > <a href="#" class="current">Add Article</a> </div>
    <h1>Article</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Article</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add_article')}}" name="add_article" id="add_article" enctype="multipart/form-data" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Page</label>
                <div class="controls">
                  <select name="page" id="page" style="width:364px;">
                    <option selected disabled>Select Page</option>
                    @foreach($navbars as $nav)
                      <option value="{{$nav->nav_route}}">{{$nav->nav_item}} ({{$nav->nav_route}})</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" style="width:350px;" placeholder="Enter article title">
                </div>
              </div>

       

              <div class="control-group">
                <label class="control-label">Description <small>(with hyperlink support)</small></label>
                <div class="controls">
                  <textarea name="description" id="description" rows="10" style="width:80%;"></textarea>
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Add Article" class="btn btn-success">
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

<script>
  // Auto-fill or sync page with navbar selection (optional)
  document.getElementById('navbar_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var pageValue = selectedOption.text.match(/\(([^)]+)\)/);
    if(pageValue) {
      document.getElementById('page').value = pageValue[1];
    }
  });
</script>
@endsection