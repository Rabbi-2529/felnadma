{{-- Icon for an SMS service link: uploaded image first, then Font Awesome class, else nothing. Usage: @include('frontend.partials.sms_service_icon', ['link' => $link, 'size' => 38]) --}}
@if(!empty($link->icon_image))
  {!! App\Support\Img::tag($link->icon_image, '', ['width' => $size ?? 38, 'height' => $size ?? 38]) !!}
@elseif(!empty($link->icon_class))
  <i class="{{ $link->icon_class }}" aria-hidden="true"></i>
@endif
