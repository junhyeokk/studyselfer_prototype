<head>
    <style type="text/css">
        body {
            display: block;
            text-align: center;
            background-color: #4F62C0;
        }

        div.main {
            display: block;
            height: 100%;
        }

        img.logo {
            position: relative;
            top: 40%;
            transition: top 0.5s;
            transition-timing-function: ease-in;
        }

        img.kakao_login {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            transition: visibility 0.8s, opacity 0.8s ease-in;
        }
    </style>
</head>
<body>
    <div class="main">
        <img src="{{ url("/images/loading_image_logo.png") }}" class="logo" alt="logo" />
        <a href="{{ url("/login/kakao") }}">
            <img src="{{ url("/images/kakao_login_large_wide.png") }}" class="kakao_login" alt="kakao login"/>
        </a>
    </div>
</body>

<script>
    const logo = document.querySelector(".logo");
    const login = document.querySelector(".kakao_login");

    window.addEventListener("load", function(e) {
        logo.style.top = "30%";
        login.style.visibility = "visible";
        login.style.opacity = "1";
    });
</script>
