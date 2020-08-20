<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0">
    <style type="text/css">
        html, body{width: 100%; height: 100%; padding: 0; margin: 0}
        div{position: absolute;}

        .navbar {
            height: 20%;
            width: 100%;
            background-color: #4F62C0;
        }

        #navbar_logo {
            position: absolute;
            bottom: 5%;
            height: 70%;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href = "{{ route('home') }}">
            <img src="{{ url("images/logo_navbar.jpg") }}" id="navbar_logo" />
        </a>
    </div>
    <div class="tests_list">
        @foreach ($rows as $row)
            <a href="{{ url('/try_test/'.$subject.'/'.$row->source_of_question) }}">{{ $row->source_of_question }}</a>
        @endforeach
    </div>
</body>
<script>
    var test_time = 30;      // 분단위로만 설정?
    // var urls = document.getElementsByTagName("a");
    //
    // for (var next_url of urls) {
    //     next_url.href = next_url + "/" + test_time;
    // }
</script>
</html>
