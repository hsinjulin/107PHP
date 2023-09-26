<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>107期末考實做題</title>
        @php
        $result = request()->session()->get('result');
        @endphp
    </head>
    <body>
        <form action="{{route('num')}}" method="get" id="form1" name="form1">
            <input type="submit" name="submit" value="送出">
        </form>
        <form action="{{route('clear')}}" method="get" id="form2" name="form2">
            <input type="submit" name="submit" value="清除">
        </form>
        <div>
            <h3>{!!$result!!}</h3>
        </div>
    </body>
</html>