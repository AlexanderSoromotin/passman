<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Профиль пользователя</title>

    @include("css-styles")
</head>
<body>

@include('header')

<main>
    <div class="user-profile-data">
        <div class="image">
            <img src="{{ asset('img/icons/unknown.png') }}" alt="" width="200px">
            <button style="height: 30px; width: 200px;margin-top: 15px" class="nf-ss nf-s btn-primary change-password">Сменить пароль</button>
        </div>
        <div class="info">
            <div class="columns">
                <div class="column">
                    <label for="">Фамилия</label>
                    <input name="last_name" type="text" value="" placeholder="Фамилия">
                </div>
                <div class="column">
                    <label for="">Имя</label>
                    <input name="first_name" type="text" value="" placeholder="Имя">
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <label for="">Отчество</label>
                    <input name="patronymic" type="text" value="" placeholder="Отчество">
                </div>
                <div class="column">
                    <label for="">Электропочта</label>
                    <input name="email" type="text" value="" placeholder="Электропочта">
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <label for="">Роль</label>
                    <select name="role" style="padding: 8px; border-radius: 8px; border: 1px solid; height: 41px; width: 210px">
                        <option>Администратор</option>
                        <option>Руководитель</option>
                        <option>Старший специалист</option>
                        <option>Специалист</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <h3 class="available-services title-with-button">Доступные ресурсы</h3>
    <div class="users-list available-services-list available-services items-list">


    </div>
</main>

<!-- Модальное окно -->
<div class="modal fade" id="AvailableResource" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Доступ к сервису</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Сервис</h5>
                <div class="resource-name">
                    Мера - Облачный сервис TIMEWEB
                </div>
                <br>
                <h5>Срок доступа</h5>
                    <div class="resource-date"><input type="date"></div>

                <br>
                <h5>Описание</h5>
                <div class="description">
                    Для подключения использовать команду ssh root@255.255.255.255
                </div>

                <div class="resource-login-data">
                    <div class="column">
                        <label for="">Логин</label>
                        <input disabled type="text" placeholder="Логин">
                    </div>

                    <div class="column">
                        <label for="">Пароль</label>
                        <input disabled type="text" placeholder="Пароль">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Удалить</button>
            </div>
        </div>
    </div>
</div>


<!-- Модальное окно -->
<div class="modal fade" id="ChangePassword" tabindex="-1" role="dialog" aria-labelledby="ChangePassword" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Смена пароля</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="">Новый пароль</label>
                <br>
                <input type="text" placeholder="Новый пароль">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Сгенерировать пароль</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Сохранить пароль</button>
            </div>
        </div>
    </div>
</div>


@include('footer')

<script src="{{ asset('js/select2.min.js') }}"></script>

<style>

.user-profile-data {
    display: flex;
}

.resource-login-data {
    position: relative;
    display: flex;
    margin-top: 30px;
    justify-content: space-between;
}

.resource-login-data .column {
    position: relative;
    display: flex;
    flex-direction: column;
    width: calc(100% / 2 - 7px);
}

.user-profile-data .info {
    display: flex;
    flex-direction: column;
    margin-left: 15px;
}

.user-profile-data .info .columns {
    display: flex;
    flex-direction: row;
    margin-bottom: 15px;
}

.user-profile-data .info .column {
    display: flex;
    flex-direction: column;
    margin-right: 15px;
}

input {
    padding: 8px;
    border-radius: 8px;
    border: 1px solid;
}

label {
    margin-bottom: 0 !important;
}


.items-list {
    display: flex;
    flex-direction: column;
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
    cursor: pointer;
}

.row-item img {
    position: absolute;
    right: 20px;
}

.row-item .resource-name {
    width: 400px;
    margin-bottom: 0 !important;
}

.row-item .date {
    margin-bottom: 0 !important;
}

</style>

<script>
    console.log(localStorage.getItem('user_role_name'))
    if (localStorage.getItem('user_role_name') == 'Старший специалист' || localStorage.getItem('user_role_name') == 'Специалист') {
        $('.user-profile-data input, .user-profile-data select').attr('disabled', true)
    }
    selectFooterTab("users");

    userId = Number('<?= $id ?>');


    console.log(userId);

    // $('#selectProject').select2();
    // $('#selectCounter').select2();


    $(document).on('click', '.row-item', function () {
        resourceId = $(this).attr('data-id');
        $.ajax({
            url: '{{ asset('/api/resources') }}/' + resourceId,
            method: 'get',
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success PATCH /api/users', response);

                data = response.data;
                $('#AvailableResource .resource-name').text(data.name);
                $('#AvailableResource .description').text(data.content);
                $('#AvailableResource .resource-login-data input:eq(0)').val(data.login);
                $('#AvailableResource .resource-login-data input:eq(1)').val(data.password);
                $('#AvailableResource').modal('show');
            }
        })


    })

    $(document).on('click', '.change-password', function () {
        $('#ChangePassword').modal('show');
    })

    function updateProfile()
    {
        $.ajax({
            url: '{{ asset('/api/users') }}/' + userId,
            method: 'get',
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success GET /api/users', response);
                userData = response.data;

                $('.user-profile-data input[name=first_name]').val(userData.first_name);
                $('.user-profile-data input[name=last_name]').val(userData.last_name);
                $('.user-profile-data input[name=patronymic]').val(userData.patronymic);
                $('.user-profile-data input[name=email]').val(userData.email);
                $('.user-profile-data select[name=role]').val(userData.role.name);

                if (userData.role.name == "Администратор" || userData.role.name == "Руководитель" || userData.role.name == "Старший специалист") {
                    $('.available-services').hide();
                }
                // $('#CreateUser input[name=password]').val(userData.password);

                $('.available-services-list').text('');
                for (j in userData.resources) {
                    resource = userData.resources[j];

                    $('.available-services-list').append(`
                    <div class="row-item" data-id="${resource.resource.id}">
                        <h6 class="resource-name">${resource.resource.name} - ${resource.resource.description}</h6>
                        <h6 class="date"></h6>
                        <img src="{{ asset('img/icons/arrow-right.svg') }}" alt="">
                    </div>
                    `)
                }
            }
        })
    }

    updateProfile();

    $('.user-profile-data input, .user-profile-data select').on('change', function () {
        role = $('.user-profile-data select[name=role]').val();

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

        $.ajax({
            url: '{{ asset('/api/users') }}/' + userId,
            method: 'patch',
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            data: {
                first_name: $('.user-profile-data input[name=first_name]').val(),
                last_name: $('.user-profile-data input[name=last_name]').val(),
                patronymic: $('.user-profile-data input[name=patronymic]').val(),
                email: $('.user-profile-data input[name=email]').val(),
                role_id: role_id,
            },
            success: (response) => {
                console.log('success PATCH /api/users', response);
                userData = response.data;

                $('.user-profile-data input[name=first_name]').val(userData.first_name);
                $('.user-profile-data input[name=last_name]').val(userData.last_name);
                $('.user-profile-data input[name=patronymic]').val(userData.patronymic);
                $('.user-profile-data input[name=email]').val(userData.email);
                $('.user-profile-data select[name=role]').val(userData.role.name);
                // $('#CreateUser input[name=password]').val(userData.password);
            }
        })
    })

    $('#ChangePassword .btn-secondary').click(function () {
        $('#ChangePassword input').val(generatePassword(15))
    })

    $('#ChangePassword .btn-primary').click(function () {
        if ($('#ChangePassword input').val().length < 8) {
            alert("Пароль должен содержать не менее 8 символов");
            return;
        }

        $.ajax({
            url: '{{ asset('/api/users') }}/' + userId,
            method: 'patch',
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            data: {
                password: $('#ChangePassword input').val()
            },
            success: (response) => {
                console.log('success PATCH /api/users', response);
                userData = response.data;
                $("#ChangePassword").modal('hide');
            }
        })
    })
</script>



</body>
</html>
