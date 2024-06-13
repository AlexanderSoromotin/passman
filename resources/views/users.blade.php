<?php
$counterId = 0;
if (!empty($_GET["counter_id"])) {
    $counterId = (int)$_GET["counter_id"];
}

?>
<script>
    if (localStorage.getItem('user_role_name') == 'Специалист') {
        location.href = '{{ asset('/resources') }}';
    }
</script>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Пользователи</title>

    @include("css-styles")
</head>
<body>

@include('header')

<main>
    <div style="margin-top: 0 !important;" class="title-with-button">
        <h3>Сотрудники</h3>
        <button data-toggle="modal" data-target="#CreateUser" class="nf-s nf-ss btn-primary">Создать</button>
    </div>
    <br><br>

    <div style="display: flex;opacity: .6;font-size: 14px; margin-bottom: 10px" class="titles">
        <div style="margin-left: 73px; width: 250px">Имя сотрудника</div>
        <div style="width: 150px;">Роль</div>
        <div style="width: 100px;">Доступов</div>
    </div>
    <div class="users-list items-list">

    </div>



</main>

<!-- Модальное окно -->
<div class="modal fade" id="CreateUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Создание пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="rows">
                    <div class="row">
                        <label for="">Фамилия</label>
                        <input name="last_name" type="text" placeholder="Фамилия">
                    </div>
                    <div class="row">
                        <label for="">Имя</label>
                        <input name="first_name" type="text" placeholder="Имя">
                    </div>
                </div>

                <div class="rows">
                    <div class="row">
                        <label for="">Отчество</label>
                        <input name="patronymic" type="text" placeholder="Отчество">
                    </div>
                    <div class="row">
                        <label for="">Электропочта</label>
                        <input name="email" type="text" placeholder="Электропочта">
                    </div>
                </div>

                <div class="rows">
                    <div class="row">
                        <label for="">Пароль</label>
                        <input name="password" type="text" placeholder="Пароль">
                    </div>
                    <div class="row">
                        <label for="">Роль</label>
                        <select name="role" id="">
                            <option value="Руководитель">Руководитель</option>
                            <option value="Старший специалист">Старший специалист</option>
                            <option value="Специалист">Специалист</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary">Сгенерировать пароль</button>
                <button type="button" class="create-user-button btn btn-primary">Создать</button>
            </div>
        </div>
    </div>
</div>


@include('footer')

<script src="{{ asset('js/select2.min.js') }}"></script>

<style>
    .rows {
        position: relative;
        padding: 15px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .rows .row {
        display: flex;
        flex-direction: column;
        width: calc(100% / 2);
    }

    input, select {
        padding: 8px;
        border-radius: 8px;
        border: 1px solid;
    }
    label {
        margin-bottom: 0;
    }

    .items-list .role {
        width: 150px;
        text-align: center;
    }
    .items-list .resources {
        width: 100px;
        text-align: center;
    }
    .titles div {
        display: flex;
        justify-content: center;
    }
.items-list {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.items-list h6 {
    margin-bottom: 0 !important;
}
a {
    color: #000;
    text-decoration: none;
}
a:hover {
    color: #000;
    text-decoration: none;
}
.items-list .row-item {
    position: relative;
    box-shadow: 0 0 20px #00000030;
    background-color: #fff;
    display: flex;
    align-items: center;
    flex-direction: row;
    border-radius: 20px;
    padding: 20px;
    margin-bottom: 20px;
}

.row-item .arrow-right {
    position: absolute;
    right: 20px;
}

.row-item .user-name {
    width: 400px;
}
</style>

<script>
    selectFooterTab("users");

    // $('#selectProject').select2();
    // $('#selectCounter').select2();

    function updateUsersList()
    {
        $.ajax({
            url: '{{ asset('/api/users') }}',
            method: 'get',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            },
            success: (response) => {
                console.log('success GET /api/users', response)

                users = response.data.data;
                console.log(users);

                $('.users-list').text('');

                for (index in users) {
                    user = users[index];

                    $('.users-list').append(`
                        <a href="{{ asset('/users/') }}/${user.id}">
                            <div class="row-item">
                                <img style="margin-right: 15px" src="{{ asset('img/icons/unknown.png') }}" alt="" height="38px">
                                <h6 style="width: 250px" class="user-name">${user.full_name}</h6>
                                <h6 class="role">${user.role.name}</h6>
                                <h6 class="resources">${user.resources_number}</h6>
                                <img class="arrow-right" src="{{ asset('img/icons/arrow-right.svg') }}" alt="">
                            </div>
                        </a>
                    `)
                }
            },
            error: (response) => {
                console.log('success GET /api/users', response)

            }
        })
    }

    updateUsersList();

    $('.create-user-button').click(function () {
        first_name = $('#CreateUser input[name=first_name]').val();
        last_name = $('#CreateUser input[name=last_name]').val();
        patronymic = $('#CreateUser input[name=patronymic]').val();
        email = $('#CreateUser input[name=email]').val();
        password = $('#CreateUser input[name=password]').val();
        role = $('#CreateUser select[name=role]').val();

        role_id = 4;
        if (role == 'Администратор') {
            role_id = 1;
        }
        if (role == 'Руководитель') {
            role_id = 2;
        }
        if (role == 'Старший специалист') {
            role_id = 3;
        }
        if (role == 'Специалист') {
            role_id = 4;
        }

        if (first_name.replaceAll(' ', '').length <= 1) {
            alert("Введите имя сотрудника");
            return;
        }

        if (last_name.replaceAll(' ', '').length <= 1) {
            alert("Введите фамили. сотрудника");
            return;
        }

        if (email.replaceAll(' ', '').length <= 1) {
            alert("Введите email сотрудника");
            return;
        }

        if (password.length < 8) {
            alert("Пароль должен содержать не менее 8 символов");
            return;
        }

        $.ajax({
            url: '{{ asset('/api/register') }}',
            method: 'post',
            data: {
                first_name: first_name,
                last_name: last_name,
                patronymic: patronymic,
                email: email,
                password: password,
                role_id: role_id,
            },
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success POST /api/users', response);
                updateUsersList();
                $("#CreateUser").modal('hide');
                $('#CreateUser input[name=first_name]').val('');
                $('#CreateUser input[name=last_name]').val('');
                $('#CreateUser input[name=patronymic]').val('');
                $('#CreateUser input[name=email]').val('');
                $('#CreateUser input[name=password]').val('');
            }
        })

        console.log(first_name, last_name, patronymic, email, password, role);
    })

    $('#CreateUser input[name=password]').val(generatePassword(15));

    $('#CreateUser .btn-secondary').click(function () {
        $('#CreateUser input[name=password]').val(generatePassword(15));
    })

</script>



</body>
</html>
