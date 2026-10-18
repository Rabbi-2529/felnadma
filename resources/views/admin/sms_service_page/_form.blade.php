{{-- Shared fields for add/edit SMS service page. Expects optional $page --}}
<?php $page = $page ?? null; ?>
@if($errors->any())
<div class="alert alert-error" style="margin:10px;">
  @foreach($errors->all() as $error)
  <div>{{ $error }}</div>
  @endforeach
</div>
@endif

<div class="control-group">
  <label class="control-label">Title <span style="color:red">*</span></label>
  <div class="controls">
    <input type="text" name="title" id="title" value="{{ old('title', $page->title ?? '') }}" style="width:350px;" required>
  </div>
</div>

<div class="control-group">
  <label class="control-label">URL Slug</label>
  <div class="controls">
    <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug ?? '') }}" style="width:350px;" placeholder="Leave empty to build from title">
    <span class="help-block">Page URL: {{ url('/bulk-sms-service') }}/<strong>your-slug</strong> ("rate" is reserved)</span>
  </div>
</div>

<div class="control-group">
  <label class="control-label">Icon Class</label>
  <div class="controls">
    <input type="text" name="icon_class" id="icon_class" value="{{ old('icon_class', $page->icon_class ?? '') }}" style="width:350px;" placeholder="e.g. fas fa-key">
    <span class="help-block">Optional Font Awesome 6 class. Used when no icon image is uploaded.</span>
  </div>
</div>

<div class="control-group">
  <label class="control-label">Icon Image</label>
  <div class="controls">
    <input type="file" name="icon_image" id="icon_image" accept=".png,.jpg,.jpeg,.gif,.webp,.svg" style="width:350px;">
    <span class="help-block">Optional (PNG/SVG, square, max 2MB). Takes priority over the icon class.</span>
    @if(!empty($page->icon_image))
    <div style="margin-top:6px;">
      <img src="{{ asset($page->iconImagePath()) }}" alt="icon" width="48">
      <label style="display:inline-block;margin-left:10px;"><input type="checkbox" name="remove_icon_image" value="1"> Remove image</label>
    </div>
    @endif
  </div>
</div>

<div class="control-group">
  <label class="control-label">Short Description</label>
  <div class="controls">
    <textarea name="short_description" rows="3" style="width:350px;" placeholder="Shown on the homepage card and under the page title">{{ old('short_description', $page->short_description ?? '') }}</textarea>
  </div>
</div>

<div class="control-group">
  <label class="control-label">Page Content</label>
  <div class="controls">
    <textarea id="messageArea" name="description" rows="7" class="form-control ckeditor">{{ old('description', $page->description ?? '') }}</textarea>
  </div>
</div>

<div class="control-group">
  <label class="control-label">Meta Title</label>
  <div class="controls">
    <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title ?? '') }}" style="width:350px;" placeholder="Defaults to the page title">
  </div>
</div>

<div class="control-group">
  <label class="control-label">Meta Description</label>
  <div class="controls">
    <textarea name="meta_description" rows="3" style="width:350px;">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
  </div>
</div>

<div class="control-group">
  <label class="control-label">Meta Keywords</label>
  <div class="controls">
    <textarea name="meta_keywords" rows="2" style="width:350px;">{{ old('meta_keywords', $page->meta_keywords ?? '') }}</textarea>
  </div>
</div>

<div class="control-group">
  <label class="control-label">Menu Order</label>
  <div class="controls">
    <input type="number" name="sort_order" value="{{ old('sort_order', $page->sort_order ?? 0) }}" style="width:100px;">
    <span class="help-block">Lower numbers show first in the menu and on the homepage.</span>
  </div>
</div>

<div class="control-group">
  <label class="control-label">Status</label>
  <div class="controls">
    <label><input type="checkbox" name="status" value="1" {{ old('status', $page->status ?? 1) ? 'checked' : '' }}> Active (show in menu and homepage)</label>
  </div>
</div>
