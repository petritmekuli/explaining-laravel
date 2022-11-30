<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{route('post.store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <label for="title">Title</label>
        <input type="text" name="title">

        </br>

        <label for="title">Body</label>
        <input type="text" name="body">

        </br>
        {{-- <input type="submit" value="Create"> --}}
        <button type="submit">Create</button>
    </form>
</body>
</html>
