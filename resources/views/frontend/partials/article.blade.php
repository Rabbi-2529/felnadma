{{-- Admin-managed article block. Usage: @include('frontend.partials.article', ['muted' => true]) --}}
@if(isset($article) && $article)
<section class="section {{ !empty($muted) ? 'section--muted' : '' }}" aria-labelledby="article-title">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10">
        <article class="article-card">
          <h2 class="article-card__title" id="article-title">{{ $article->title }}</h2>
          <div class="prose">{!! $article->description !!}</div>
        </article>
      </div>
    </div>
  </div>
</section>
@endif
