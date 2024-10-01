<ul>
    @foreach ($categories as $category)
        <span class='badge'>{{$category->name}}</span>
    @endforeach
</ul>