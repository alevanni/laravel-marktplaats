<div class="card">
    <h2>{{ $ad->title}}</h2>
    <h3>{{$ad->price}} &#8364;</h3>
    <p>{{ $ad->created_at }}</p>
    <p>{{$ad->description}}</p>
    <a href="{{ route('ads.show', $ad->id ) }}" >Bid on this article</a>
</div>