<?php

    $params = "";
    $i = 0;
    foreach ($_GET as $key => $value) {
        if ($i == 0) {
            $params .= "?$key=" . urlencode($value);
            $i++;
        } else {
            $params .= "&$key=" . urlencode($value);
        }
    }
?>

<header class="hidden">
    <div class="header-container">
        <div class="column column-1">
            <a class="logo" href="{{ url("/add-counter-reading") }}"><h4>Пассмен</h4></a>
        </div>

        <div class="column column-2">
            <ul class="tabs">
                <li class="nf-s" data-name="users"><a href="{{ url('/users') }}">Сотрудники</a></li>
                <li data-name="resources"><a href="{{ url('/resources') }}">Ресурсы</a></li>
                <li class="nf-s" data-name="requests"><a href="{{ url('/requests') }}">Заявки</a></li>
                <li class="nf-ss nf-r nf-a" data-name="my-requests"><a href="{{ url('/my-requests') }}">Мои заявки</a></li>
                <li class="nf-ss nf-r nf-a my-profile" data-name="my-requests"><a href="{{ url('/users') }}">Мой профиль</a></li>
            </ul>
        </div>

        <div class="column column-3">
            <div class="user-info">
                <span class="user-name"></span>
                <div class="user-image">
                    <img src="{{ asset('img/icons/unknown.png') }}" alt="" height="30px">
                </div>
                <div class="logout">
                    <img class="svg" src="{{ asset('img/icons/logout.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</header>

<div id="user-data" data-user-data=""></div>

<style>
    header {
        background-color: #373737;
        color: #fff;
        display: flex;
        justify-content: center;
        padding: 0 20px;
        height: 60px;
        z-index: 100;
        top: 0;
    }
    header.hidden {
        display: none;
    }
    header .header-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 1000px;
    }
    header .logo {
        color: #fff;
        text-decoration: none;
    }
    header .logo h4 {
        margin-bottom: 0;
    }

    header .column {
        display: flex;
        align-items: center;
        padding: 10px 0;
        height: 100%;
    }

    .hamburger-menu {
        display: none;
        cursor: pointer;
        margin-right: 10px;
    }

    .tabs {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-wrap: nowrap;
        overflow: hidden;
    }

    .tabs a {
        color: rgba(255, 255, 255, .6);
        text-decoration: none;
    }

    .tabs a:hover {
        color: #fff;
    }

    .tabs li {
        margin-right: 20px;
    }

    .tabs a.selected {
        color: #fff;
    }

    @media (max-width: 768px) {
        .tabs {
            display: none;
        }
    }

    header .user-info {
        display: flex;
        align-items: center;
        margin-left: 20px;
    }

    header .user-name {
        margin-right: 10px;
        white-space: nowrap;
    }
    header .user-image {
        margin-right: 10px;
    }

    header .logout-button {
        cursor: pointer;
    }

    header .logout-button:hover {
        background-color: #900;
    }

    header .logout {
        transition: .1s;
        cursor: pointer;
        display: flex;
        align-items: center;
    }
    header .logout:hover {
        opacity: .8;
    }
</style>

@include("jquery")

<script>

    localStorage.getItem('user_id')
    $('.my-profile a').attr('href', '{{ asset('/users') }}/' + localStorage.getItem('user_id'));
    // if (localStorage.getItem('user_role_name') == 'Администратор') {
    //
    // }

    console.log(localStorage.getItem('user_role_name'));
    if (localStorage.getItem('user_role_name') == 'Специалист') {
        $('<style>')
            .prop('type', 'text/css')
            .html('.nf-s { display: none !important; }')
            .appendTo('head');
        console.log('СПЕЦИАЛИСТ!')
    }

    if (localStorage.getItem('user_role_name') == 'Старший специалист') {
        $('<style>')
            .prop('type', 'text/css')
            .html('.nf-ss { display: none; }')
            .appendTo('head');
        console.log('СТАРШИЙ СПЕЦИАЛИСТ!')
    }

    if (localStorage.getItem('user_role_name') == 'Руководитель') {
        $('<style>')
            .prop('type', 'text/css')
            .html('.nf-r { display: none; }')
            .appendTo('head');
        console.log('РУКОВОДИТЕЛЬ!')
    }

    if (localStorage.getItem('user_role_name') == 'Администратор') {
        $('<style>')
            .prop('type', 'text/css')
            .html('.nf-a { display: none; }')
            .appendTo('head');
        console.log('АДМИНИСТРАТОР!')
    }

    $(".logout").click(function() {
       localStorage.removeItem("token");
       localStorage.removeItem("user_role_id");
       location.href="{{  url("/") }}";
    });

    var userData;

    function getUserData() {
        if (localStorage.getItem("token") == null) {
            location.href = "{{ url('/') }}";
        }

        $.ajax({
            url: '{{ url('/api/user') }}',
            method: 'get',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem("token")
            },
            success: function (data) {
                console.log("userData", data.data)

                userData = data.data;
                localStorage.setItem("user_id", userData.id);
                localStorage.setItem("user_role_id", userData.role_id);
                localStorage.setItem("user_role_name", userData.role.name);

                userName = userData.last_name + " " + userData.first_name.split("")[0] + ". " + userData.patronymic.split("")[0] + ".";

                $("header .user-name").text(userName)
            },
            error: function () {
                localStorage.removeItem("token");
                location.href = "{{ url('/') }}<?= $params ?>";
            }
        });
    }

    getUserData();

    function generatePassword(length) {
        const upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const lowerCase = 'abcdefghijklmnopqrstuvwxyz';
        const numbers = '0123456789';
        const symbols = '@*()[]{}|<>';

        const allChars = upperCase + lowerCase + numbers + symbols;

        let password = '';
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * allChars.length);
            password += allChars[randomIndex];
        }

        return password;
    }

</script>

<div id="user-data" data-user-data=""></div>



