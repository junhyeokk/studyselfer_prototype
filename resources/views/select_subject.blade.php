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
        #nw{display: inline-block; top: 20%; left: 0; right: 50%; bottom: 40%}
        #ne{top: 20%; left: 50%; right: 0; bottom: 40%}
        #sw{top: 60%; left: 0; right: 50%; bottom: 0}
        #se{top: 60%; left: 50%; right: 0; bottom: 0}

        .navbar {
            height: 20%;
            width: 100%;
            background-color: #4F62C0;
        }

        .subject {
            height: 80%;
            width: auto;
        }

        #navbar_logo {
            position: absolute;
            bottom: 5%;
            height: 70%;
        }

        #physics1 {
            position: absolute;
            bottom : 5%;
            left : 5%;
        }

        #chemi1 {
            position: absolute;
            bottom : 5%;
            right : 5%;
        }

        #biology1 {
            position: absolute;
            top : 5%;
            left : 5%;
        }

        #earth1 {
            position: absolute;
            top: 5%;
            right: 5%;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <img src="{{ url("images/logo_navbar.jpg") }}" id="navbar_logo" />
    </div>

    <div id="nw"><a href="{{ url('/select/물리1') }}"><img src="{{ url("images/physics_clicked.jpg") }}" class="subject" id="physics1"></a></div>
    <div id="ne"><a href="{{ url('/select/화학1') }}"><img src="{{ url("images/chemi.jpg") }}" class="subject" id="chemi1"></a></div>
    <div id="sw"><a href="{{ url('/select/생물1') }}"><img src="{{ url("images/biology.jpg") }}" class="subject" id="biology1"></a></div>
    <div id="se"><a href="{{ url('/select/지구과학1') }}"><img src="{{ url("images/earth.jpg") }}" class="subject" id="earth1"></a></div>
</body>

<script>
    const subjects = document.querySelectorAll(".subject");

    subjects.forEach(function(subject) {
        subject.addEventListener("click", firstClick);
    });

    function firstClick(event) {
        event.preventDefault();
        let target = "error";
        switch (event.target.id) {
            case 'physics1':
                target = "물리1";
                break;
            case 'chemi1' :
                target = "화학1";
                break;
            case 'biology1':
                target = "생물1";
                break;
            case 'earth1' :
                target = "지구과학1";
                break;
            default:
                target = "error";
        }
        event.target.parentNode.setAttribute("href", "{{ url('/select') }}" + "/" + target);
        event.target.setAttribute("src", "{{ url("images/physics_clicked.jpg") }}");
        event.target.removeEventListener("click", firstClick);

        pageTransition(document.querySelectorAll("a"));

        function pageTransition(nodeList) {
            const body = document.querySelector("body");
            nodeList.forEach(a => {
                const href = a.getAttribute("href");
                const hash = a.hash || "tmp";

                href && href[0] !== "#" && a.target !== "_blank" && a.href !== `${location.protocol}//${location.hostname}${location.pathname}${hash}` && (
                    a.addEventListener("click", e => {
                        e.preventDefault(),

                            setTimeout(() => {
                                body.classList.contains("hidden") && (
                                    location.href = href
                                )
                            }, 800),
                            body.classList.add("hidden")
                    })
                )
            })
        }
    }
</script>
