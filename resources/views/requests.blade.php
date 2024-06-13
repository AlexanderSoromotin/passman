<?php
$counterId = 0;
if (!empty($_GET["counter_id"])) {
    $counterId = (int)$_GET["counter_id"];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Заявки</title>

    @include("css-styles")
</head>
<body>

@include('header')

<main>
    <div class="users-list items-list">



    </div>

</main>

<!-- Модальное окно -->
<div class="modal fade" id="ChangeRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Просмотр заявки</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Сотрудник</h5>
                <div class="user-name">Соромотин Александр Сергеевич (Специалист)</div>
                <div style="opacity: .8;font-size: 14px" class="status">Заявка ожидает подтверждения (23.10.2024)</div>

                <br><br>
                <h5>Сопроводительное сообщение</h5>
                <textarea name="description" id="" disabled>Прошу выдать мне доступ к серверу TIMEWEB. В моя обязанности входит деплой и раскатка серверной части нашего любимого приложения, а для этого мне нужны авторизационные данные для удалённого доступа к серверу по ssh</textarea>

                <br><br>
                <h5>Требуемый сервис</h5>
                <div class="resource-name">
                    <a target="_blank" href="">Доступ к серверу TIMEWEB <img style="opacity: .8; height: 20px !important;margin-left: 5px;margin-top: -4px" src="{{ asset('/img/icons/external-link.svg') }}" alt=""></a>
                </div>

                <br><br>
                <h5>Статус</h5>
                <div class="accept-senior">Ожидает подтверждения старшего специалиста (Четин Антон Владимирович)</div>
                <div style="font-size: 12px;margin-top: 10px;" class="description">После подтверждения нужды в запрашиваемых данных, заявка будет отправлена на рассмотрение Руководителю</div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Удалить</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Подтвердить</button>
            </div>
        </div>
    </div>
</div>

@include('footer')

<script src="{{ asset('js/select2.min.js') }}"></script>

<style>
    #ChangeRequest .modal-dialog {
        margin-top: -50px;
    }
    .primary-data {
        width: 300px !important;
    }
    #ChangeRequest textarea {
        width: 100%;
        height: 180px;
        border-radius: 8px;
        padding: 8px;
        resize: none;
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

.row-item .user-name {
    width: 400px;
}
</style>

<script>
    selectFooterTab("requests");

    // $('#selectProject').select2();
    // $('#selectCounter').select2();

    $(document).on('click', '.row-item', function () {
        request_id = $(this).attr('data-id');
        $('#ChangeRequest').attr('data-id', request_id);

        $.ajax({
            url: '{{ asset('/api/requests') }}/' + request_id,
            method: 'get',
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success GET /api/requests/{id}', response);

                request = response.data;

                $('#ChangeRequest .user-name').text(`${request.user.full_name} (${request.user.role.name})`);
                $('#ChangeRequest .status').text(`${request.status} (${request.updated_at.substr(0, 10)})`);
                $('#ChangeRequest textarea').val(request.description);
                $('#ChangeRequest .resource-name a').text('').append(request.resource.name + '<img style="opacity: .8; height: 20px !important;margin-left: 5px;margin-top: -4px" src="{{ asset('/img/icons/external-link.svg') }}" alt=""></a>').attr('href', '{{ asset('/resources') }}/' + request.resource.group_id);

                if (request.status == 'Заявка ожидает подтверждения') {
                    $('.accept-senior').text(`Ожидает подтверждения старшего специалиста (${request.head_specialist.full_name})`)

                }

                if (request.status == 'Ожидает одобрения') {
                    $('.accept-senior').text(`Ожидает одобрения руководителя (${request.senior_specialist.full_name})`)

                }
            }
        })

        $('#ChangeRequest').modal('show');
    })

    function loadRequests() {
        if (localStorage.getItem('user_role_name') == 'Старший специалист') {
            data = {
                head: 1,
            };
        }

        else if (localStorage.getItem('user_role_name') == 'Руководитель') {
            data = {
                senior: 1,
            };
        } else {
            data = {};
        }
        $.ajax({
            url: '{{ asset('/api/requests') }}',
            method: 'get',
            data: data,
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success GET /api/requests', response);

                requests = response.data;

                for (i in requests) {
                    request = requests[i];

                    if (request.status == 'Ожидает одобрения') {
                        request.head_specialist = request.senior_specialist;
                    }

                    $('.users-list').append(`
                    <div class="row-item" data-id="${request.id}">
                        <div class="column primary-data">
                            <h6 class="user-name">${request.user.full_name}</h6>
                            <div class="resource-name">${request.resource.name}</div>
                            <div style="font-size: 14px" class="">${request.updated_at.substr(0, 10)}</div>
                        </div>

                        <div style="display: flex;flex-direction: column; align-items: center;" class="column primary-data">
                            <div style="" class="status">${request.status}</div>
                            <div style="font-size: 12px;opacity: .8;" class="status-description">Ожидание действий ${request.head_specialist.full_name}</div>
                        </div>
                        <img src="{{ asset('img/icons/arrow-right.svg') }}" alt="">
                    </div>
                    `);
                }
            }
        })
    }

    loadRequests();

    $('#ChangeRequest .btn-primary').click(function () {
        requestId = $('#ChangeRequest').attr('data-id');
        if (localStorage.getItem('user_role_name') == 'Старший специалист') {
            url = '{{ asset('/api/requests') }}/' + requestId + '/approve';
        }

        if (localStorage.getItem('user_role_name') == 'Руководитель') {
            url = '{{ asset('/api/requests') }}/' + requestId + '/close';
        }

        $.ajax({
            url: url,
            method: 'post',
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            },
            success: (response) => {
                console.log('success GET /api/requests/{id}', response);

                location.reload();
            }
        })
    })

</script>



</body>
</html>
