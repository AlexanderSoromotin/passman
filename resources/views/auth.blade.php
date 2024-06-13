<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Вход в аккаунт</title>

    @include("css-styles")
</head>
<body>

<div class="container">
    <div class="row">
        <div class="login-form">
            <h1 class="title">Вход в Пассмен</h1>
            <form id="loginForm">
                <div class="form-group">
                    <label for="email">Электропочта</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Введите адрес эл. почты">
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <div class="input">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
                        <div class="eye">
                            <img class="eye-icon" src="{{ url("img/icons/eye.svg") }}" alt="">
                            <img class="eye-off-icon" src="{{ url("img/icons/eye-off.svg") }}" alt="">
                        </div>
                    </div>

                </div>
                <button type="button" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </div>
</div>

<style>
    .title {
        margin-bottom: 40px;
        text-align: center;
    }
    .container {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    button {
        position: relative;
        width: 100%;
        background-color: #b51d22 !important;
        border: none !important;
        margin-top: 20px;
        font-weight: 500 !important;
    }
    button.loading::after {
        position: absolute;
        background-size: 24px;
        opacity: 1;
        filter: invert(1);
        width: 40px;
        left: 200px;
        background-position: center center;
    }
    .row {
        margin-top: -40px;
    }
    #loginForm {
        position: relative;
    }

    .container .login-form {
        min-width: 300px;
    }
</style>

@include('jquery')

<script>
    $(document).ready(function() {
        // Обработка отправки формы
        if (localStorage.getItem("token") !== null) {
            location.href = "{{ url('/users') }}";
        }

        $("#loginForm button").click(function(e) {
            if ($(this).hasClass("loading")) {
                return;
            }

            // Получаем значения полей
            var email = $("#email").val();
            var password = $("#password").val();

            // Проводим проверку имени пользователя и пароля
            if (email === "") {
                alert("Введите адрес эл. почты");
                return;
            }
            if (password === "") {
                alert("Введите пароль");
                return;
            }

            $("#loginForm").addClass("loading");
            $.ajax({
                url: '{{ url('/api/login') }}',
                method: 'post',
                data: {
                    email: email,
                    password: password,
                },
                success: function (data) {
                    // Обработка успешного ответа сервера
                    console.log(data)
                    localStorage.setItem("user_id", data.user.id);
                    localStorage.setItem("token", data.access_token);
                    localStorage.setItem("user_role_name", data.user.role.name);
                    location.href = "{{ url("/") }}";
                },
                error: function () {
                    $("#loginForm").removeClass("loading");
                    alert("Неверные данные для входа");
                }
            });
        });
    });

    $(".input .eye").click(function () {
        input = $(this).parent().find("input");
        if (input.attr("type") == "password") {
            input.attr("type", "text");
            $(this).addClass("show-password");
            return;
        }

        input.attr("type", "password");
        $(this).removeClass("show-password");
        return;
    })
</script>

</body>
</html>
