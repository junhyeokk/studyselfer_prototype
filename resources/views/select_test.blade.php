<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0">
    <style type="text/css">
        html, body{width: 100%; height: 100%; padding: 0; margin: 0;}
        div{position: absolute;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            /*margin: auto;*/
            padding: 5%;
            border: 1px solid #888;
            /*width: 80%;*/
            height: 40%;
            top: 20%;
            left: 5%;
            right: 5%;
        }

        /* The Close Button */
        .close {
            position: absolute;
            color: #aaaaaa;
            top: -20px;
            left: 95%;
            font-size: 28px;
            font-weight: bold;
            /*width: auto;*/
            height: 10%;
            width: 10%;
            /*border-radius: 50%;*/
            /*background-color: red;*/
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

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

        #nav_subject {
            top: 20%;
            height: 10%;
            width: 100%;
            display: block;
            cursor: pointer;
        }

        #test_buttons_list {
            top: 30%;
            height: 10%;
            width: 100%;
            text-align: center;
        }

        .test_buttons {
            position: relative;
            background-color: #ddd;
            border: none;
            color: white;
            /*width: 35%;*/
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 20px;
        }

        #tests_list {
            top: 40%;
            width: 100%;
        }

        .subject {
            float: left;
            position: relative;
            text-align: center;
            width: 25%;
            cursor: pointer;
        }

        .year {
            position: relative;
            cursor: pointer;
        }

        .test_of_year {
            position: relative;
            cursor: pointer;
        }

        #practice_mode {
            position: relative;
            height: 50%;
        }

        #test_mode {
            position: relative;
            height: 50%;
        }
    </style>
</head>

<body>
    <div class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="practice_mode">
                연습모드<br/>
                <span>시간 제한 없이 문제풀기</span>
            </div>
            <div id="test_mode">
                시험모드<br/>
                <span>실전처럼 시간안에 풀기</span>
            </div>
        </div>
    </div>
    <div class="navbar">
        <a href = "{{ route('home') }}">
            <img src="{{ url("images/logo_navbar.jpg") }}" id="navbar_logo" alt="로고"/>
        </a>
    </div>
    <div id="nav_subject">
        <div class="subject" id="physics1">물리</div>
        <div class="subject" id="chemi1">화학</div>
        <div class="subject" id="biology1">생물</div>
        <div class="subject" id="earth1">지구과학</div>
    </div>
    <div id="test_buttons_list">
        <button id="mock_test" class="test_buttons">기출 모의고사</button>
        <button id="csat" class="test_buttons">대학 수학 능력시험</button>
    </div>
    <div id="tests_list">
    </div>
</body>
<script>
    var test_time = 30;      // 분단위로만 설정?
    var mockTest = true;    // 모의고사 목록인지 수능 목록인지
    var currentSubject = "{{ $subject }}";

    const mock_test_button = document.getElementById('mock_test');
    const csat_button = document.getElementById('csat');
    const tests_list = document.getElementById('tests_list');

    const test_list = {};
    test_list['모의고사'] = {};
    test_list['수능'] = [];

    @foreach ($rows as $row)
        @if (substr(strrchr($row->source_of_question, ' '), 1) == "모의고사")
            if (test_list["모의고사"][ "{{ explode(' ', $row->source_of_question)[0] }}" ]) test_list["모의고사"][ "{{ explode(' ', $row->source_of_question)[0] }}" ].append("{{ explode(' ', $row->source_of_question)[1] }}")
            else test_list["모의고사"][ "{{ explode(' ', $row->source_of_question)[0] }}" ] = ["{{ explode(' ', $row->source_of_question)[1] }}"];
        @elseif (substr(strrchr($row->source_of_question, ' '), 1) == "수능")
            test_list["수능"].push("{{ explode(' ', $row->source_of_question)[0] }}");
        @endif
    @endforeach

    mock_test_button.addEventListener("click", function() {
        mock_test_button.style.backgroundColor = "#4F62C0";
        csat_button.style.backgroundColor = "#ddd";
        showYearsOfMockTest();
    });

    csat_button.addEventListener("click", function() {
        mock_test_button.style.backgroundColor = "#ddd";
        csat_button.style.backgroundColor = "#4F62C0";
        showCsatTests();
    });

    function showYearsOfMockTest(event) {
        tests_list.innerHTML = '';      // clear

        for (let year in test_list['모의고사']) {
            const year_list = document.createElement('div');
            year_list.id = year;
            year_list.innerText = year + " 모의고사";
            year_list.classList.add('year');
            year_list.addEventListener("click", showMockTestsOfYear);
            document.getElementById("tests_list").appendChild(year_list);
        }
    }

    var next_url = "";

    function showMockTestsOfYear(event) {
        tests_list.innerHTML = '';      // clear
        const year = document.createElement('span');
        year.innerText = event.target.id + " 모의고사";
        // year.classList.add('year');

        for (let month of test_list['모의고사'][event.target.id]) {
            const test_of_year = document.createElement('div');
            test_of_year.classList.add('test_of_year');
            test_of_year.innerText = month + " 모의고사";

            test_of_year.addEventListener('click', function() {
                showModal();
                next_url = "{{ url('/') }}" + "/try_test/{{ $subject }}/" + event.target.id + " " + month + " 모의고사/";
            });
            year.appendChild(test_of_year);
        }

        const backward = document.createElement('span');
        backward.innerText = "<";
        backward.addEventListener("click", showYearsOfMockTest);

        tests_list.appendChild(backward);
        tests_list.appendChild(year);
    }

    function showCsatTests() {
        tests_list.innerHTML = '';
        for (let csat of test_list["수능"]) {
            const csat_test = document.createElement('div');
            csat_test.innerText = csat + " 대학 수학 능력시험";
            csat_test.classList.add('test_of_year');
            csat_test.addEventListener("click", function() {
                showModal();
                next_url = "{{ url('/') }}" + "/try_test/{{ $subject }}/" + csat + " 수능/";
            });

            tests_list.appendChild(csat_test);
        }
    }

    const modal = document.querySelector(".modal");
    const close_btn = document.querySelector(".close");

    function showModal(url) {
        modal.style.display = "block";
    }

    close_btn.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

    const practice_mode = document.querySelector('#practice_mode');
    const test_mode = document.querySelector('#test_mode');

    practice_mode.onclick = function() {
        window.location = next_url + "0";
    }

    test_mode.onclick = function() {
        window.location = next_url + "30";
    }

    // var urls = document.getElementsByTagName("a");
    //
    // for (var next_url of urls) {
    //     next_url.href = next_url + "/" + test_time;
    // }
</script>
</html>
