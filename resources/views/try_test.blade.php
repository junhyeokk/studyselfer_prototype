<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0">
    <style type="text/css">
        html, body{width: 100%; height: 100%; padding: 0; margin: 0;}
        /*div{position: absolute;}*/

    </style>
</head>

<body>
    <div class="header">
        <span id="backward"><</span>
        <span id="title">물리 문제풀기</span>
        <span id="clock_icon">시계</span>
        <span id="bookmark_icon">즐겨찾기</span>
        <span id="table_icon">바로가기</span>
        <div>
            <span>{{ $rows[0]->source_of_question }}</span>
        </div>
        <div id="time_display"></div>
    </div>

    @foreach ($rows as $row)
        <div id="question_{{ $row->question_number }}" style="display : none">
            <div class="panel panel-primary">
                {{ $row->question_number }} 번 문제
                <br/>
                <div class="panel-body">
                    <img src="{{ url('/questions/'.$row->question_image_name) }}">
                </div>
            </div>
            <div class="choice">
                보기<br/>
                <input type="checkbox" id="{{ $row->question_number }}_1" onClick="checkHandler_{{ $row->question_number }}_1()">1&nbsp
                <input type="checkbox" id="{{ $row->question_number }}_1_not" onClick="notHandler_{{ $row->question_number }}_1(this)">거르기
                <br/>
                <input type="checkbox" id="{{ $row->question_number }}_2" onClick="checkHandler_{{ $row->question_number }}_2()">2&nbsp
                <input type="checkbox" id="{{ $row->question_number }}_2_not" onClick="notHandler_{{ $row->question_number }}_2(this)">거르기
                <br/>
                <input type="checkbox" id="{{ $row->question_number }}_3" onClick="checkHandler_{{ $row->question_number }}_3()">3&nbsp
                <input type="checkbox" id="{{ $row->question_number }}_3_not" onClick="notHandler_{{ $row->question_number }}_3(this)">거르기
                <br/>
                <input type="checkbox" id="{{ $row->question_number }}_4" onClick="checkHandler_{{ $row->question_number }}_4()">4&nbsp
                <input type="checkbox" id="{{ $row->question_number }}_4_not" onClick="notHandler_{{ $row->question_number }}_4(this)">거르기
                <br/>
                <input type="checkbox" id="{{ $row->question_number }}_5" onClick="checkHandler_{{ $row->question_number }}_5()">5&nbsp
                <input type="checkbox" id="{{ $row->question_number }}_5_not" onClick="notHandler_{{ $row->question_number }}_5(this)">거르기
                <br/>
            </div>
            <br/>
            <button onClick="prevButtonHandler_{{ $row->question_number }}()" id="prevButton_{{ $row->question_number }}">이전 문제</button>
            <button onClick="nextButtonHandler_{{ $row->question_number }}()" id="nextButton_{{ $row->question_number }}">다음 문제</button>
        </div>
    @endforeach
    <button onClick="endButtonClick()" id="end_button">시험 종료</button>
</body>

<script>
    var answers = {};
    var current_question = {{ $rows[0]->question_number }};
    var test_time = {{ $time * 60 }};
    const test_mode  = test_time != 0;

    function displayTime() {
        if (test_mode) {
            document.getElementById("time_display").innerHTML = `${Math.floor(test_time / 60)} 분 ${test_time % 60} 초`;
        } else {
            document.getElementById("time_display").innerHTML = `${Math.floor(answers[current_question]["time_taken"] / 60)} 분 ${answers[current_question]["time_taken"] % 60} 초`;
        }
    }

    document.getElementById("question_{{ $rows[0]->question_number }}").style.display = "";
    document.getElementById("prevButton_{{ $rows[0]->question_number }}").style.display = "none";   // 첫 문제에선 이전 버튼이 없음

    if (current_question != {{ $rows[count($rows) - 1]->question_number }}) {           // 마지막 문제가 아니라면 종료 버튼 없음
        document.getElementById("end_button").style.display = "none";
    }

    @foreach ($rows as $row)
        answers["{{ $row->question_number }}"] = {};
        answers["{{ $row->question_number }}"]["time_taken"] = 0;
        answers["{{ $row->question_number }}"]["option1"] = false;
        answers["{{ $row->question_number }}"]["option2"] = false;
        answers["{{ $row->question_number }}"]["option3"] = false;
        answers["{{ $row->question_number }}"]["option4"] = false;
        answers["{{ $row->question_number }}"]["option5"] = false;
        answers["{{ $row->question_number }}"]["choice"] = 0;
        answers["{{ $row->question_number }}"]["test_mode"] = test_mode;

        function checkHandler_{{ $row->question_number }}_1() {
            answers["{{ $row->question_number }}"]["choice"] = 1;
        }

        function notHandler_{{ $row->question_number }}_1() {
            document.getElementById("{{ $row->question_number }}_1").disabled = !document.getElementById("{{ $row->question_number }}_1").disabled;
            answers["{{ $row->question_number }}"]["option1"] = document.getElementById("{{ $row->question_number }}_1_not").checked;
        }

        function checkHandler_{{ $row->question_number }}_2() {
            answers["{{ $row->question_number }}"]["choice"] = 2;
        }

        function notHandler_{{ $row->question_number }}_2() {
            document.getElementById("{{ $row->question_number }}_2").disabled = !document.getElementById("{{ $row->question_number }}_2").disabled;
            answers["{{ $row->question_number }}"]["option2"] = document.getElementById("{{ $row->question_number }}_2_not").checked;
        }

        function checkHandler_{{ $row->question_number }}_3() {
            answers["{{ $row->question_number }}"]["choice"] = 3;
        }

        function notHandler_{{ $row->question_number }}_3() {
            document.getElementById("{{ $row->question_number }}_3").disabled = !document.getElementById("{{ $row->question_number }}_3").disabled;
            answers["{{ $row->question_number }}"]["option3"] = document.getElementById("{{ $row->question_number }}_3_not").checked;
        }

        function checkHandler_{{ $row->question_number }}_4() {
            answers["{{ $row->question_number }}"]["choice"] = 4;
        }

        function notHandler_{{ $row->question_number }}_4() {
            document.getElementById("{{ $row->question_number }}_4").disabled = !document.getElementById("{{ $row->question_number }}_4").disabled;
            answers["{{ $row->question_number }}"]["option4"] = document.getElementById("{{ $row->question_number }}_4_not").checked;
        }

        function checkHandler_{{ $row->question_number }}_5() {
            answers["{{ $row->question_number }}"]["choice"] = 5;
        }

        function notHandler_{{ $row->question_number }}_5() {
            document.getElementById("{{ $row->question_number }}_5").disabled = !document.getElementById("{{ $row->question_number }}_5").disabled;
            answers["{{ $row->question_number }}"]["option5"] = document.getElementById("{{ $row->question_number }}_5_not").checked;
        }

        function prevButtonHandler_{{ $row->question_number }}() {
            document.getElementById("question_" + current_question).style.display = "none";
            document.getElementById("end_button").style.display = "none";       // 일단 이전 버튼 누르면 종료는 무조건 사라짐

            current_question--;
            if (current_question == {{ $rows[0]->question_number }}) {          // 첫번째 문제면
                document.getElementById("prevButton_{{ $rows[0]->question_number }}").style.display = "none";
            } else {
                document.getElementById("prevButton_" + current_question).style.display = "";
            }

            document.getElementById("question_" + current_question).style.display = "";
            displayTime();
        }

        function nextButtonHandler_{{ $row->question_number }}() {
            document.getElementById("question_" + current_question).style.display = "none";

            current_question++;
            if (current_question == {{ $rows[count($rows) - 1]->question_number }}) {       // 마지막 문제라면
                document.getElementById("nextButton_{{ $rows[count($rows) - 1]->question_number }}").style.display = "none";
                document.getElementById("end_button").style.display = "";
            } else {
                document.getElementById("nextButton_{{ $rows[count($rows) - 1]->question_number }}").style.display = "";
            }

            document.getElementById("question_" + current_question).style.display = "";
            displayTime();
        }
    @endforeach

    displayTime();

    var timer = setInterval(function() {
        answers[current_question]["time_taken"]++;
        if (test_mode) test_time--;
        displayTime();
    }, 1000);
    // 마지막에 종료버튼 눌리면 clear 되도록 할 것

    function endButtonClick() {
        clearTimeout(timer);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "{{ url("/test_result/".$rows[0]->subject.'/'.$rows[0]->source_of_question) }}", true);
        xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
        xhr.send(JSON.stringify(answers));

    }

</script>
</html>
