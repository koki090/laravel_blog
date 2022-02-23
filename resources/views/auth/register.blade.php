@extends('layouts.not_logged_in')

@section('content')

<h1>会員登録画面</h1>
<form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <output id="result"></output>
    <label>
        画像:
        <input id="input_file" type="file" name="image">
    </label>
    <label>
        名前:
        <input type="name" name="name">
    </label>
    <label>
        メールアドレス:
        <input type="email" name="email">
    </label>
    <label>
        パスワード:
        <input type="password" name="password">
    </label>
    <label>
        パスワード（再確認）:
        <input type="password" name="password_confirmation">
    </label>
    <input type="submit" value="登録">
</form>

<script>
    
    let inputFile = document.getElementById("input_file");
    inputFile.addEventListener("change", (event) => {
        let file = event.target.files[0];
        let output = document.getElementById("result");
        output.innerHTML = "";
        if(file.type.match('image')){
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