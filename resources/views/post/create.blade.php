<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @error('alert')
        <span style="color:red">{{ $errors->first('alert') }}</span>
    @enderror
    @error('lucky_code')
        <span style="color:red">{{ $errors->first('lucky_code') }}</span>
    @enderror
    <form method="POST" action="{{route('post.store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <label for="title">Title</label>
        <input type="text" name="title" value="{{old('title')}}">
        @error('title')
            @foreach ($errors->get('title') as $titleError)
                {{--This because there could be more than one title errors--}}
                <span style="color:red">{{$titleError}}</span>
            @endforeach
        @enderror
        @error('invalid_word')
            @foreach($errors->get('invalid_word') as $invalidWord)
                <span style="color:red"> {{ $invalidWord }}</span>
            @endforeach
        @enderror

        </br>

        <label for="title">Body</label>
        <input type="text" name="body" value="{{old('body')}}">
        @if($errors->has('body'))
            @foreach ($errors->get('body') as $bodyError)
                <span style="color:red">{{$bodyError}}</span>
            @endforeach
        @endif

        </br>
        {{-- <input type="submit" value="Create"> --}}
        <button type="submit">Create</button>
    </form>
</body>
</html>
