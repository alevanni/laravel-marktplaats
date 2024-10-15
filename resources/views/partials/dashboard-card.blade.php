<div class="card {{ $ad->active ? 'active' : 'inactive' }}">
    <ul>
    <li><a href="{{ route('ads.edit', $ad->id ) }}">Edit or promote this ad</a> </li>
    <li>
    <form action="{{ route('ads.destroy', $ad->id ) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    </li>
    </ul>
    <h2>{{ $ad->title}}</h2>
    <h3>{{$ad->price}} &#8364;</h3>
    @if ($ad->priority) 
    <span class='badge'>Promoted</span>
    @endif
    <p>{{ $ad->created_at }}</p>
    <p>{{$ad->description}}</p>
    
    @include('partials.categories-badges', ['categories' => $ad->categories])
</div>