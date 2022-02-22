@extends('layouts.logged_in')

@section('content')

<h1>{{ $title }}</h1>


<form method="post" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <label>
        タイトル:
        <input type="text" name="title">
    </label>
    <label>
        内容:
        <input type="text" name="log">
    </label>
    <label>
        画像（複数選択可）:
        <input id="input_file" type="file" name="files[]" multiple>
    </label>
    <input type="submit" value="投稿">
    <output id="result" />
</form>

<script>
    let inputFiles = document.getElementById("input_file");
    inputFiles.addEventListener("change", (event) => {
        let files = event.target.files;
        let output = document.getElementById("result");
        output.innerHTML = "";
        for(let i = 0; i < files.length; i++){
            let file = files[i];
            if(!file.type.match('image')){
                continue;
            };
            let fileReader = new FileReader;
            fileReader.addEventListener("load", (event) => {
                let imageFile = event.target;
                let div = document.createElement("div");
                div.innerHTML = "<img src='" + imageFile.result + "' >";
                output.insertBefore(div, null);
            });
            fileReader.readAsDataURL(file);
            };
        });
</script>

@endsection

