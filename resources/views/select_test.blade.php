<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading"><h2>시험 선택</h2></div>
        <div class="panel-body">
            @foreach ($rows as $row)
{{--                <a href="{{ url('/solve/'.$row->subject.'/'.$row->source_of_question.'/1') }}">{{ $row->source_of_question }}</a>--}}
                <a href="{{ url('/try_test/'.$subject.'/'.$row->source_of_question) }}">{{ $row->source_of_question }}</a>
            @endforeach
        </div>
    </div>
</div>

<script>
    var test_time = 30;      // 분단위로만 설정?
    var urls = document.getElementsByTagName("a");

    for (var next_url of urls) {
        next_url.href = next_url + "/" + test_time;
    }
</script>
