<div class="card">
    <a href="{{ route('ads.edit', $ad->id ) }}">Edit this ad</a>
    <h2>{{ $ad->title}}</h2>
    <h3>{{$ad->price}} &#8364;</h3>
    <p>{{ $ad->created_at }}</p>
    <p>{{$ad->description}}</p>
    <a href="{{ route('ads.show', $ad->id ) }}">Bid on this article</a>
</div>