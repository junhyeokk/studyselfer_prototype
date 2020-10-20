<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading"><h2>{{ $row->source_of_question }}</h2></div><br/>
        {{ $row->question_number }} 번 문제
        <br/><br/>
        <div class="panel-body">
            <img src="{{ url('/questions/'.$row->question_image_name) }}">
        </div>
    </div>
</div>
