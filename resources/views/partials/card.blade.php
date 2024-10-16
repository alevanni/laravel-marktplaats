<div class="card {{ $ad->active ? 'active' : 'inactive' }}">

    <h2>{{ $ad->title}}</h2>
    <h3>{{$ad->price}} &#8364;</h3>
    @if ($ad->priority)
    <span class='badge'>Promoted</span>
    @endif
    <p>{{ $ad->created_at }}</p>
    <p>Created by: {{ $ad->user->full_name }}</p>
    <p>{{$ad->description}}</p>

    <a href="{{ route('ads.show', $ad->id ) }}"> See this article </a>


    @include('partials.categories-badges', ['categories' => $ad->categories])
</div>