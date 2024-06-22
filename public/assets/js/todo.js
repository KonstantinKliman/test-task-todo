$(document).ready(function () {
    function createTodoList() {
        var form = $('#createTodoListForm');
        var formData = form.serialize();
        var token = getToken();
        var errorField = $('#listFormError');

        clearValidation();

        console.log('test');

        $.ajax({
            url: '/api/todo-lists',
            method: 'POST',
            data: formData,
            headers: getHeaders(token),
            success: function (response) {
                $('#listModal').modal('hide');
                form[0].reset();
                errorField.removeClass('d-flex').addClass('d-none');
                appendTodoListOption(response);
                appendTodoListContainer(response);
            },
            error: function (error) {
                handleFormErrors(error, errorField);
            }
        });
    }

    function createTodo() {
        var form = $('#createTodoForm')[0];
        var formData = new FormData(form);
        var token = getToken();
        var errorField = $('#todoFormError');

        if (formData.get('tags') === '') {
            formData.delete('tags');
        }

        clearValidation();

        $.ajax({
            url: '/api/todos',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: getHeaders(token),
            success: function (response) {
                handleTodoCreationSuccess(response);
            },
            error: function (error) {
                handleFormErrors(error, errorField);
            }
        });
    }

    function fetchTodoLists() {
        var token = getToken();
        $.ajax({
            url: '/api/todo-lists',
            method: 'GET',
            headers: getHeaders(token),
            success: function (response) {
                response.forEach(function (list) {
                    appendTodoListOption(list);
                    appendTodoListContainer(list);
                    $('#filterBtn').on('click', function () {
                        fetchFilterTags();
                    })
                });
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function appendTodoListOption(list) {
        $('.todo-lists').eq(0)[0].innerHTML += '<option value="' + list.id + '">' + list.name + '</option>';
    }

    function appendTodoListContainer(list) {
        var todoListContainer = $("<div>", {
            class: "container-fluid border rounded p-2 mb-2",
            id: "todoList" + list.id
        });

        todoListContainer.append($("<div>", {
            class: "row"
        }).append($("<div>", {
            class: "col-12 d-flex justify-content-between mb-2"
        }).append($("<h3>", {
            text: list.name + " (created by " + list.user.name + ")"
        })).append($("<button>", {
            class: "btn btn-outline-secondary",
            text: "Share(Work in progress)",
            id: "shareBtn" + list.id,
            click: function () {
                fetchUsersToShare(list.id, list.userId)
            },
            "data-bs-toggle": "modal",
            "data-bs-target": "#shareListModal"
        }))));

        $('.todoListContainer').append(todoListContainer);

        if (list.todos.length !== 0) {
            list.todos.forEach(function (todo) {
                appendTodoCard(todo, list.id);
            });
        }
    }

    function appendTodoCard(todo, listId) {
        var todoCard = $("<div>", {
            class: "card mb-3"
        });

        todoCard.append($("<div>", {
            class: "row g-0"
        }).append($("<div>", {
            class: "col-md-1"
        }).append($("<a>", {
            href: todo.image ? todo.image.path : "/assets/img/not-found.png",
            target: "_blank",
            id: "todoLinkImg" + todo.id
        }).append($("<img>", {
            class: "todo-img img-fluid rounded-start",
            src: todo.image ? todo.image.path : "/assets/img/not-found.png",
            alt: "todoImg",
            id: "todoImg" + todo.id
        })))));

        var cardTitle = $("<h6>", {
            class: "card-title",
            text: todo.title
        });

        todo.tags.forEach(function (tag) {
            cardTitle.append($("<span>", {
                class: "badge text-bg-secondary mx-1",
                text: tag
            }));
        });

        var cardBody = $("<div>", {
            class: "col-md-10"
        }).append($("<div>", {
            class: "card-body h-100"
        }).append(cardTitle).append($("<p>", {
            class: "card-text text-truncate",
            text: todo.content
        })));

        var buttonsColumn = $('<div>', {
            class: "col-md-1 d-flex flex-column justify-content-center"
        });
        buttonsColumn.append($('<button>', {
            class: "btn btn-outline-secondary me-2 mb-2",
            text: "Edit preview",
            id: "todoEditBtn" + todo.id,
            click: function () {
                editTodoPreview(todo);
            },
            "data-bs-toggle": "modal",
            "data-bs-target": "#editTodoModal"
        }));
        buttonsColumn.append($('<button>', {
            class: "btn btn-outline-danger me-2 mb-2",
            text: "Delete preview",
            id: "todoDeleteBtn" + todo.id,
            click: function () {
                deleteTodoPreview(todo);
            }
        }));

        todoCard.find('.row').append(cardBody).append(buttonsColumn);

        $('#todoList' + listId).append(todoCard);
    }

    function appendTagsFilterForm(tags) {
        $('#filterForm').eq(0)[0].innerHTML = '';
        tags.forEach(function (tag) {
            $('#filterForm').append($('<div>', {
                class: "form-check"
            }).append($('<input>', {
                class: "form-check-input",
                value: tag.id,
                type: "checkbox",
                id: "todoTagId" + tag.id
            }).add($('<label>', {
                class: "form-check-label",
                for: "todoTag" + tag.name,
                text: tag.name
            }))))
        });
    }

    function handleTodoCreationSuccess(response) {
        $('#todoModal').modal('hide');
        $('#todoImg').attr('src', "/assets/img/not-found.png");
        $('#createTodoForm')[0].reset();
        $('#todoFormError').removeClass('d-flex').addClass('d-none');
        appendTodoCard(response, response.todoListId);
    }

    function handleFormErrors(error, errorField) {
        console.log(error);
        var errors = error.responseJSON.errors;
        var errorMessage = '';
        $.each(errors, function (key, value) {
            if (key === 'todoListId') {
                $('select[name="' + key + '"]').addClass('is-invalid');
            } else if (key === 'content') {
                $('textarea[name="' + key + '"]').addClass('is-invalid');
            } else {
                $('input[name="' + key + '"]').addClass('is-invalid');
            }
            errorMessage += value[0] + '\n';
        });
        errorField.removeClass('d-none').addClass('d-flex').text(errorMessage);
    }

    function clearValidation() {
        $('input').removeClass('is-invalid');
        $('select').removeClass('is-invalid');
        $('textarea').removeClass('is-invalid');
    }

    function getToken() {
        return localStorage.getItem('token');
    }

    function getHeaders(token) {
        return {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + token
        };
    }

    function editTodoPreview(todo) {
        $('#editTodoImagePreview').attr('src', todo.image ? todo.image.path : "/assets/img/not-found.png");
        $('#editTodoImage').val('');
        $('#editTodoFormError').addClass('d-none').removeClass('d-flex');
        $('#editTodoImage').removeClass('is-invalid');
        $('#editTodoImage').off('change').on('change', function () {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $('#editTodoImagePreview').attr('src', event.target.result);
                };
                reader.readAsDataURL(file);
                $('#editTodoImgDeleteBtn').removeClass('d-none');
                $('#editTodoImgDeleteBtn').on('click', function (event) {
                    event.preventDefault();
                    $('#editTodoImage').val('');
                    $('#editTodoImagePreview').attr('src', "/assets/img/not-found.png");
                    $(this).addClass('d-none');
                });
            }
        });
        $('#saveEditTodoImgBtn').on('click', function () {
            saveEditedTodoImage(todo);
        });
    }

    function saveEditedTodoImage(todo) {
        var formData = new FormData($('#editTodoForm')[0]);
        var token = getToken();
        $.ajax({
            url: "/api/todos/" + todo.id,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: getHeaders(token),
            success: function (response) {
                $('#todoImg' + todo.id).attr('src', response.image);
                $('#todoLinkImg' + todo.id).attr('href', response.image);
                $('#editTodoModal').modal('hide');
                updateTodoImage(response, todo.id);
            },
            error: function (error) {
                handleEditTodoErrors(error);
            }
        });
    }

    function updateTodoImage(response, todoId) {
        if (response.image) {
            $('#todoImg' + todoId).attr('src', response.image);
            $('#todoLinkImg' + todoId).attr('href', response.image);
        }
        $('#editTodoModal').modal('hide');
    }

    function handleEditTodoErrors(error) {
        var errorField = $('#editTodoFormError');
        handleFormErrors(error, errorField);
    }

    function deleteTodoPreview(todo) {
        $('#todoDeleteBtn' + todo.id).off('click').on('click', deleteTodoImage(todo));
    }

    function deleteTodoImage(todo) {
        var token = getToken();
        $.ajax({
            url: "/api/todos/" + todo.id,
            method: "DELETE",
            headers: getHeaders(token),
            success: function () {
                $('#todoImg' + todo.id).attr('src', "/assets/img/not-found.png");
                $('#todoLinkImg' + todo.id).attr('href', "/assets/img/not-found.png");
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function fetchUsersToShare(listId, listUserId) {
        var token = getToken();

        $.ajax({
            url: '/api/users',
            method: 'GET',
            headers: getHeaders(token),
            success: function (response) {
                appendShareUsersOption(response, listUserId);
                $('#shareListBtn').on('click', function (event) {
                    event.preventDefault();
                    var form = $('#shareListForm')[0];
                    var formData = new FormData(form);

                    formData.set('todoListId', listId);
                    formData.set('canEdit', $('#canEditCheck').is(':checked') ? 1 : 0);
                    $.ajax({
                        url: "api/todo-lists/share",
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: getHeaders(token),
                        success: function (response) {
                            $('#shareListModal').modal('hide')
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    })
                })
            },
            error: function (error) {
                console.error(error);
            }
        })
    }

    function appendShareUsersOption(response, listUserId) {
        $('#selectUserId').eq(0)[0].innerHTML = '';
        response.forEach(function (user) {
            if (user.id !== listUserId) {
                $('#selectUserId').eq(0)[0].innerHTML += '<option value="' + user.id + '">' + user.name + '</option>';
            }
        });
    }

    function fetchFilterTags() {
        var token = getToken();

        $.ajax({
            url: '/api/tags',
            method: 'GET',
            headers: getHeaders(token),
            success: function (response) {
                appendTagsFilterForm(response);
            },
            error: function (error) {
                console.error(error);
            }
        })
    }

    function fetchSharedLists() {
        var token = getToken();

        $.ajax({
            url: '/api/todo-lists/shared-lists',
            method: 'GET',
            headers: getHeaders(token),
            success: function (response) {
                response.forEach(function (list) {
                    appendTodoListOption(list);
                    appendTodoListContainer(list);
                })
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        })
    }

    fetchSharedLists();

    fetchTodoLists();

    $('#createTodoListBtn').on('click', function (event) {
        event.preventDefault();
        createTodoList();
    });

    $('#createTodoBtn').on('click', function (event) {
        event.preventDefault();
        createTodo();
    });
});
