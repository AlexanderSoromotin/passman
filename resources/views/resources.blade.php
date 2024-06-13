<?php

    if (!isset($id)) {
        $id = 0;
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Ресурсы</title>

    @include("css-styles")
</head>
<body>

@include('header')

<main>
    <div class="resources">
        <h6 style="color: #00000090" class="bread-crumbs">Все ресурсы</h6>

        <div class="title-with-button">
            <h3>Ресурсы</h3>
            <div>
                <button data-toggle="modal" data-target="#CreateFolder" class="nf-s nf-ss btn-secondary">Создать группу</button>
                <button data-toggle="modal" data-target="#CreateResource" class="nf-s nf-ss btn-primary">Добавить ресурс</button>
            </div>
        </div>
        <br>


        <div style="display: flex;opacity: .6;font-size: 14px;" class="titles">
            <div style="width: 320px;margin-left: 65px;">Название</div>
            <div style="width: 100px;">Тип</div>
            <div style="width: 110px;margin-left: 40px">Срок действия</div>
        </div>
        <div class="users-list items-list">

        </div>
    </div>
</main>

<!-- Модальное окно -->
<div class="modal fade" id="CreateFolder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Создание группы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="">Название группы</label>
                <input type="text" placeholder="Название группы">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Создать</button>
            </div>
        </div>
    </div>
</div>


<!-- Модальное окно -->
<div class="modal fade" id="CreateResource" tabindex="-1" role="dialog" aria-labelledby="ChangePassword" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Создать ресурс</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="rows">
                    <div class="row">
                        <label for="">Название</label>
                        <input name="name" type="text" placeholder="Название">
                    </div>
                    <div class="row">
                        <label for="">Описание</label>
                        <input name="description" type="text" placeholder="Описание">
                    </div>
                </div>

                <label for="">Скрытая информация</label>
                <br>
                <textarea name="content" id="" placeholder="Дополнительная полезная информация. Будет скрыто"></textarea>

                <div class="rows">
                    <div class="row">
                        <label for="">Логин</label>
                        <input name="login" type="text" placeholder="Логин">
                    </div>
                    <div class="row">
                        <label for="">Пароль</label>
                        <input name="password" type="text" placeholder="Пароль">
                    </div>
                </div>

                <div class="rows">
                    <div class="row">
                        <label for="">Срок действия пароля</label>
                        <input name="expiration_at" type="date" placeholder="Дата">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn generate-password btn-secondary">Сгенерировать пароль</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Создать</button>
            </div>
        </div>
    </div>
</div>


<!-- Модальное окно -->
<div class="modal fade" id="EditResource" tabindex="-1" role="dialog" aria-labelledby="ChangePassword" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Изменить ресурс</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="rows">
                    <div class="row">
                        <label  for="">Название</label>
                        <input name="name" type="text" placeholder="Название">
                    </div>
                    <div class="row">
                        <label for="">Описание</label>
                        <input name="description" type="text" placeholder="Описание">
                    </div>
                </div>

                <label class="secret nf-s" for="">Скрытая информация</label>
                <br class="secret nf-s">
                <textarea class="secret nf-s" name="content" id="" placeholder="Дополнительная полезная информация. Будет скрыто"></textarea>

                <div class="secret nf-s rows">
                    <div class="row">
                        <label for="">Логин</label>
                        <input name="login" type="text" placeholder="Логин">
                    </div>
                    <div class="row">
                        <label for="">Пароль</label>
                        <input name="password" type="text" placeholder="Пароль">
                    </div>
                </div>

                <div class="secret nf-s rows">
                    <div class="row">
                        <label for="">Срок действия пароля</label>
                        <input name="expiration_at" type="date" placeholder="Дата">
                    </div>
                </div>

                <br><br>
                <h5 class="nf-s webhook_data">Вебхук</h5>
                <div class="nf-s rows">
                    <div class="row">
                        <label for="">Ссылка</label>
                        <input name="webhook_url" type="text" placeholder="Ссылка">
                    </div>
                    <div class="row">
                        <label for="">API-Ключ / Токен</label>
                        <input name="webhook_token" type="text" placeholder="API-Ключ / Токен">
                    </div>
                </div>


                <br><br>
                <h5 class="nf-s">У кого есть доступ</h5>
                <div class="nf-s users-with-access">

                </div>

            </div>
            <div class="modal-footer">
                <button data-toggle="modal" data-target="#CreateRequest" type="button" class="nf-ss nf-r btn request-access btn-secondary">Запросить доступ</button>
                <button type="button" class="btn nf-ss nf-s delete btn-secondary">Удалить</button>
                <button type="button" class="btn nf-ss nf-s generate-password btn-secondary">Сгенерировать пароль</button>
                <button type="button" class="btn nf-ss nf-s btn-primary" data-dismiss="modal">Сохранить</button>
            </div>
        </div>
    </div>
</div>



<!-- Модальное окно -->
<div class="modal fade" id="EditGroup" tabindex="-1" role="dialog" aria-labelledby="ChangePassword" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Изменить папку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="rows">
                    <div class="row">
                        <label for="">Название</label>
                        <input type="text" placeholder="Название">
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button data-toggle="modal" data-target="#CreateRequest" type="button" class="nf-ss nf-r btn btn-secondary request-access" data-dismiss="modal">Запросить доступ</button>
                <button type="button" class="nf-s nf-ss delete btn btn-secondary" data-dismiss="modal">Удалить</button>
                <button type="button" class="nf-s nf-ss btn btn-primary" data-dismiss="modal">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно -->
<div class="modal fade" id="CreateRequest" tabindex="-1" role="dialog" aria-labelledby="ChangePassword" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Создание заявки на доступ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <label for="">Сопроводительное сообщение</label>
                <br>
                <textarea name="description" id="" style="width: 100%; height: 180px" placeholder="Опишите, почему Вам необходим доступ к этому ресурсу"></textarea>

                <br><br>
                <label for="">Выберите старшего специалиста</label>
                <select class="head_users" name="" id="">
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Создать</button>
            </div>
        </div>
    </div>
</div>


@include('footer')

<script src="{{ asset('js/select2.min.js') }}"></script>

<style>
    .titles div {
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
    }
    .resource-type {
        width: 100px;
        display: flex;
        justify-content: center;
        margin-bottom: 0 !important;
        margin-right: 40px;
    }
    .items-list h6 {
        font-size: 14px;
    }
    .users-with-access {
        display: flex;
        flex-direction: column;
    }
    .user-with-access {
        display: flex;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 0 10px #00000050;
        justify-content: space-between;
    }
    #CreateResource .modal-dialog {
        margin-top: -50px;
    }

    #EditResource .modal-dialog {
        margin-top: -50px;
    }
    .rows {
        position: relative;
        padding: 15px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    textarea {
        width: 100%;
        height: 100px;
        border-radius: 8px;
        padding: 8px;
    }

    .rows .row {
        display: flex;
        flex-direction: column;
        width: calc(100% / 2 - 7px);
    }

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

.row-item .arrow-right {
    position: absolute;
    right: 20px;
}

.row-item .resource-icon {
    margin-right: 15px;
}

.row-item .resource-name {
    width: 320px;
    margin-bottom: 0 !important;
}

.row-item .date {
    margin-bottom: 0 !important;
    text-align: center;
    width: 110px;
}

</style>

<script>
    if (localStorage.getItem('user_role_name') == 'Администратор') {
        $('#EditResource .request-access').hide();
    }

    if (localStorage.getItem('user_role_name') == 'Специалист') {
        $('#EditResource input, #EditResource textarea').attr('disabled', true);
        $('#EditGroup input, #EditResource textarea').attr('disabled', true);
    }

    selectFooterTab("resources");

    groupId = Number('{{ $id }}');

    console.log('group id ', groupId);


    $(document).on('click', '.row-item', function () {
        $('#AvailableResource').modal('show');
    })

    $(document).on('click', '.change-password', function () {
        $('#ChangePassword').modal('show');
    })

    $(document).on('click', '.row-item', function (e) {
        if ($(this).hasClass('resource')) {
            $.ajax({
                url: '{{ asset('/api/resources') }}/' + $(this).attr('data-id'),
                method: 'get',
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                },
                success: (response) => {
                    console.log('success POST /api/resources', response);

                    resource = response.data;

                    if (resource.expiration_at != null) {
                        resource.expiration_at = resource.expiration_at.substr(0, 10)
                    }

                    $('#EditResource input[name=name]').val(resource.name);
                    $('#EditResource input[name=description]').val(resource.description);
                    $('#EditResource textarea[name=content]').val(resource.content);
                    $('#EditResource input[name=login]').val(resource.login);
                    $('#EditResource input[name=password]').val(resource.password);
                    $('#EditResource input[name=expiration_at]').val(resource.expiration_at);

                    $('#EditResource input[name=webhook_url]').val(resource.webhook.request_url);
                    $('#EditResource input[name=webhook_token]').val(resource.webhook.token);

                    if (localStorage.getItem('user_role_name') == "Специалист") {
                        if (resource.user_status == 'does not has access') {
                            $('#EditResource .secret').addClass('nf-s');
                            $('.webhook_data').addClass('nf-s')
                            $('#EditResource .request-access').attr('disabled', false).text('Запросить доступ').removeClass('nf-s')
                        }

                        if (resource.user_status == 'has access') {
                            $('#EditResource .secret').removeClass('nf-s');
                            $('.webhook_data').addClass('nf-s')
                            $('#EditResource .request-access').attr('disabled', false).text('Запросить доступ').addClass('nf-s')
                        }

                        if (resource.user_status == 'waiting access') {
                            $('#EditResource .secret').addClass('nf-s');
                            $('.webhook_data').addClass('nf-s')
                            $('#EditResource .request-access').removeClass('nf-s').attr('disabled', true).text('Заявка в обработке')
                        }
                    }


                    $('.users-with-access').text('')
                    for (i in resource.users) {
                        user = resource.users[i];

                        $('.users-with-access').append(`
                        <div class="user-with-access" data-id="${user.id}">
                            <div class="user-name">${user.user.full_name}</div>
                            <div class="date">Неограниченно</div>
                            <div class="delete">
                                <img src="{{ asset('img/icons/trash.svg') }}" alt="">
                            </div>
                        </div>`);
                    }

                    $('#EditResource').attr('data-id', resource.id);
                    $('#CreateRequest').attr('data-id', resource.id);
                }
            })

            $('#EditResource').modal('show');
            return;
        }

        if ($(this).hasClass('group')) {
            $.ajax({
                url: '{{ asset('/api/resources') }}/' + $(this).attr('data-id'),
                method: 'get',
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                },
                success: (response) => {
                    console.log('success POST /api/resources', response);

                    resource = response.data;



                    if (resource.user_status == 'does not has access') {
                        $('#EditGroup .request-access').attr('disabled', false).text('Запросить доступ').removeClass('nf-s')
                    }

                    if (resource.user_status == 'has access') {
                        $('#EditGroup .request-access').attr('disabled', false).text('Запросить доступ').addClass('nf-s')
                    }

                    if (resource.user_status == 'waiting access') {
                        $('#EditGroup .request-access').attr('disabled', true).text('Заявка в обработке')
                    }
                }
            })

            $('#EditGroup').modal('show');
            $('#EditGroup input').val($(this).find('.resource-name').text());
            $('#EditGroup').attr('data-id', $(this).attr('data-id'));
            $('#CreateRequest').attr('data-id', $(this).attr('data-id'));


        }


    })

    function loadResources(groupId) {
        if (groupId == 0) {
            data = {};
        } else {
            data = {
                group_id: groupId
            };
        }

        $.ajax({
            url: '{{ asset('/api/resources') }}',
            method: 'get',
            data: data,
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success GET /api/resources', response);

                resources = response.data;

                $('.users-list').text('');

                breadScrumbs = `<a href='{{ asset('/resources') }}'>Все ресурсы</a>`;
                for (h in response.bread_scrumbs) {
                    breadScrumb = response.bread_scrumbs[h];
                    if (h == 0) {
                        continue;
                    }

                    breadScrumbs += ' → ' + `<a href='{{ asset('/resources') }}/${breadScrumb.id}'>${breadScrumb.name}</a>`;
                }
                $('.bread-crumbs').text('').append(breadScrumbs);

                for (index in resources) {
                    resource = resources[index];

                    if (resource.is_group == 1) {
                        $('.users-list').append(`
                        <div class="row-item group" data-type="group" data-id="${resource.id}">
                            <img class="resource-icon" src="{{ asset('img/folder.png') }}" alt="" height="30px">
                            <h6 class="resource-name">${resource.name}</h6>
                            <h6 class="resource-type">Группа</h6>
                            <a style="position: absolute; right: 20px; top: 50%; transform: translatey(-50%)" href="{{ asset('/resources') }}/${resource.id}">
                                <img style="margin-top: -12px;" class="arrow-right" src="{{ asset('img/icons/arrow-right.svg') }}" alt="">
                            </a>
                        </div>
                    `);
                    } else {
                        $('.users-list').append(`
                        <div class="row-item resource" data-type="resource" data-id="${resource.id}">
                            <img class="resource-icon" src="{{ asset('img/file.png') }}" alt="" height="30px">
                            <h6 class="resource-name">${resource.name}</h6>
                            <h6 class="resource-type">Ресурс</h6>
                            <h6 class="date">${resource.expiration_in}</h6>
                        </div>
                    `)
                    }


                }
            }
        })
    }
    loadResources(groupId);

    $('#CreateFolder .btn-primary').click(function () {
        folderName = $('#CreateFolder input').val();

        if (folderName.replaceAll(' ', '').length == 0) {
            alert('Введите название группы');
            return;
        }

        group_id = groupId;
        if (groupId == 0) {
            group_id = null;
        }

        $.ajax({
            url: '{{ asset('/api/resources') }}',
            method: 'post',
            data: {
                name: folderName,
                is_group: 1,
                group_id: group_id,
            },
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success POST /api/resources', response);

                resources = response.data;

                $('#CreateFolder input').val('')

                loadResources(groupId);
            }
        })
    })

    $('#EditGroup .delete').click(function () {
        if (!confirm("Вы уверены, что хотите удалить эту папку?")) {
            return;
        }

        $.ajax({
            url: '{{ asset('/api/resources') }}/' + $('#EditGroup').attr('data-id'),
            method: 'delete',
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success DELETE /api/resources/{id}', response);

                resources = response.data;

                $('#EditGroup').modal('hide')
                loadResources(groupId);
            }
        })
    })

    $('#EditGroup input').on('change', function () {
        $.ajax({
            url: '{{ asset('/api/resources') }}/' + $('#EditGroup').attr('data-id'),
            method: 'patch',
            data: {
                name: $('#EditGroup input').val()
            },
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success PATCH /api/resources/{id}', response);

                resources = response.data;

                loadResources(groupId);
            }
        })
    })

    $('#CreateResource .generate-password').click(function () {
        $('#CreateResource input[name=password]').val(generatePassword(15))
    });

    $('#CreateResource .btn-primary').click(function () {
        name = $('#CreateResource input[name=name]').val();
        description = $('#CreateResource input[name=description]').val();
        content = $('#CreateResource textarea[name=content]').val();
        login = $('#CreateResource input[name=login]').val();
        password = $('#CreateResource input[name=password]').val();
        expiration_at = $('#CreateResource input[name=expiration_at]').val();

        group_id = null;
        if (groupId != 0) {
            group_id = groupId;
        }

        if (expiration_at == '') {
            expiration_at = null;
        } else {
            expiration_at = expiration_at.substr(8, 2) + '.' + expiration_at.substr(5, 2) + '.' + expiration_at.substr(0, 4);
        }

        $.ajax({
            url: '{{ asset('/api/resources') }}',
            method: 'post',
            data: {
                name: name,
                description: description,
                content: content,
                is_group: 0,
                group_id: group_id,
                login: login,
                password: password,
                expiration_at: expiration_at,
            },
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success POST /api/resources', response);

                $('#CreateResource input[name=name]').val('');
                $('#CreateResource input[name=description]').val('');
                $('#CreateResource input[name=content]').val('');
                $('#CreateResource input[name=login]').val('');
                $('#CreateResource input[name=password]').val('');
                $('#CreateResource input[name=expiration_at]').val('');
                $('#CreateResource').modal('hide');
                loadResources(groupId);
            }
        })
    });

    $('#EditResource .delete').click(function () {
        resourceId = $('#EditResource').attr('data-id');

        if (!confirm("Вы уверены, что хотите удалить ресурс?")) {
            return;
        }

        $.ajax({
            url: '{{ asset('/api/resources') }}/' + resourceId,
            method: 'delete',
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success DELETE /api/resources/{id}', response);

                $('#EditResource').modal('hide');
                loadResources(groupId);
            }
        })
    })

    $('#EditResource input[name=name], #EditResource input[name=description], #EditResource textarea[name=content], #EditResource input[name=login], #EditResource input[name=password], #EditResource input[name=expiration_at]').on('change', function () {
        resourceId = $('#EditResource').attr('data-id');

        name = $('#EditResource input[name=name]').val();
        description = $('#EditResource input[name=description]').val();
        content = $('#EditResource textarea[name=content]').val();
        login = $('#EditResource input[name=login]').val();
        password = $('#EditResource input[name=password]').val();
        expiration_at = $('#EditResource input[name=expiration_at]').val();

        if (expiration_at == '') {
            expiration_at = null;
        } else {
            expiration_at = expiration_at.substr(8, 2) + '.' + expiration_at.substr(5, 2) + '.' + expiration_at.substr(0, 4);
        }

        $.ajax({
            url: '{{ asset('/api/resources') }}/' + resourceId,
            method: 'patch',
            data: {
                name: name,
                description: description,
                content: content,
                login: login,
                password: password,
                expiration_at : expiration_at,
            },
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success DELETE /api/resources/{id}', response);

                loadResources(groupId);
            }
        })
    });

    $('#EditResource .generate-password').click(function () {
        $('#EditResource input[name=password]').val(generatePassword(15));
    })

    $('.request-access').click(function () {
        $('#EditResource').modal('hide');
        $('#EditGroup').modal('hide');
    })

    $('#CreateRequest .btn-primary').click(function () {
        description = $('#CreateRequest textarea').val();
        resource_id = $('#CreateRequest').attr('data-id');
        head_specialist_id = $('#CreateRequest select').val();

        $.ajax({
            url: '{{ asset('/api/requests') }}',
            method: 'post',
            data: {
                description: description,
                resource_id: resource_id,
                head_specialist_id: head_specialist_id,
            },
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success DELETE /api/resources/{id}', response);

                location.reload();
            }
        })
    });


    $.ajax({
        url: '{{ asset('/api/users') }}',
        method: 'get',
        data: {
            role_id: 3,
        },
        headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
        },
        success: (response) => {
            console.log('success GET /api/users', response);

            users = response.data.data;

            for (i in users) {
                user = users[i];

                $('.head_users').append(`
                    <option value="${user.id}">${user.full_name}</option>
                `);
            }
        }
    })

    $(document).on('click', '.user-with-access .delete', function () {
        if (!confirm("Вы действительно хотите удалить доступ для этого сотрудника?")) {
            return;
        }

        $.ajax({
            url: '{{ asset('/api/user-resources') }}/' + $(this).parents('.user-with-access').attr('data-id'),
            method: 'delete',
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success GET /api/users', response);

                location.reload();
            }
        })
    })





















</script>



</body>
</html>
