@extends('layouts.logged_in')

@section('content')

<h1>{{ $title }}</h1>

<div>
    @foreach($blogImages as $image)
    <a class="image" onclick="selectImage({{ $image->id }});"><img src="{{ asset('storage/' . $image->image) }}"></a>
    @endforeach
</div>
<form method="post" action="{{ route('blogs.select_delete_image', $blog_id) }}">
    @csrf
    @method('patch')
    <input type="submit" value="選択したものを削除">
    <output id="result" />
</form>

<script>
    function selectImage(id){
        if(event.target.classList.contains("select")){
            event.target.classList.remove("select");
            let deleteDiv = document.getElementById(id);
            deleteDiv.parentNode.remove();
        }else{
            event.target.classList.add("select");
            let output = document.getElementById("result")
            let div = document.createElement("div");
            div.innerHTML = "<input id='" + id + "' type='hidden' name='image_ids[]' value='" + id + "'>";
            output.insertBefore(div, null)
        };
    }
</script>

@endsection