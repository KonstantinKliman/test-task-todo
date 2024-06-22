@extends('layouts.main')

@section('main')
    <div class="h-100 d-flex justify-content-center align-items-center flex-column" id="guestContent"></div>
    <div class="user-content" id="userContent">
        <div class="d-flex my-2 justify-content-between">
            <div>
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#filterModal" id="filterBtn">
                    Filter by tag
                </button>
                <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="filterModalLabel">Filter by tag</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="filterForm">
                                </form>
                                <div
                                    class="w-auto mb-2 border rounded d-none justify-content-start align-items-center p-2 border-danger bg-danger-subtle text-danger"
                                    id="filterFormError">
                                    Error
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close
                                </button>
                                <button type="button" class="btn btn-outline-success" id="applyFilterBtn">Apply Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <form id="searchForm">
                    <div class="d-flex">
                        <input type="text" name="query" class="form-control me-2" placeholder="Search" id="searchFormInput">
                        <button type="submit" class="btn btn-outline-success" id="searchFormBtn">
                            Search
                        </button>
                    </div>
                </form>
            </div>
            <div>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#listModal">
                    Add list
                </button>
                <div class="modal fade" id="listModal" tabindex="-1" aria-labelledby="listModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="listModalLabel">Create list</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="createTodoListForm">
                                    <input type="text" name="name" class="form-control mb-2"
                                           placeholder="Enter list name here">
                                </form>
                                <div
                                    class="w-auto mb-2 border rounded d-none justify-content-start align-items-center p-2 border-danger bg-danger-subtle text-danger"
                                    id="listFormError">
                                    Error
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close
                                </button>
                                <button type="submit" class="btn btn-outline-success" id="createTodoListBtn">Create
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#todoModal">
                    Add TODO
                </button>
                <div class="modal fade" id="todoModal" tabindex="-1" aria-labelledby="todoModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="todoModalLabel">TODO Modal</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="createTodoForm" enctype="multipart/form-data">
                                    <select class="form-select mb-2 todo-lists" aria-label="Default select example"
                                            name="todoListId">
                                        <option selected disabled>Choose list</option>
                                    </select>
                                    <input type="text" name="title" class="form-control mb-2"
                                           placeholder="Enter title here">
                                    <input type="text" name="tags" class="form-control mb-2"
                                           placeholder="Enter the tags separated by commas">
                                    <textarea name="content" class="form-control mb-2"
                                              placeholder="Enter TODO here"></textarea>
                                    <div class="mb-2">
                                        <label for="formFile" class="form-label">Select preview</label>
                                        <input class="form-control" type="file" id="formFile" name="image">
                                    </div>
                                    <div class="mb-2 d-flex flex-column">
                                        <label for="todoImg" class="form-label">Preview
                                            <button class="btn btn-sm btn-outline-danger ms-2 d-none"
                                                    id="formImgDeleteBtn">Delete
                                            </button>
                                        </label>
                                        <img src="{{ asset('assets/img/not-found.png') }}" alt="preview"
                                             class="todo-img" id="todoImg">
                                    </div>
                                </form>
                                <div
                                    class="w-auto mb-2 border rounded d-none justify-content-start align-items-center p-2 border-danger bg-danger-subtle text-danger"
                                    id="todoFormError">
                                    Error
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close
                                </button>
                                <button type="button" class="btn btn-outline-success" id="createTodoBtn">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editTodoModal" tabindex="-1" aria-labelledby="editTodoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTodoModalLabel">Edit Todo Preview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editTodoForm">
                                    <input type="hidden" id="todoId">
                                    <div class="mb-3 d-flex flex-column align-items-center">
                                        <label for="editTodoImage" class="form-label">Preview Image
                                            <button class="btn btn-sm btn-outline-danger ms-2 d-none"
                                                    id="editTodoImgDeleteBtn">Delete
                                            </button>
                                        </label>
                                        <img src="{{ asset('assets/img/not-found.png') }}" alt="Todo Preview" class="img-fluid mb-2 todo-img" id="editTodoImagePreview">
                                        <input type="file" name="image" class="form-control" id="editTodoImage" accept="image/*">
                                    </div>
                                </form>
                                <div
                                    class="w-auto mb-2 border rounded d-none justify-content-start align-items-center p-2 border-danger bg-danger-subtle text-danger"
                                    id="editTodoFormError">
                                    Error
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveEditTodoImgBtn">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="shareListModal" tabindex="-1" aria-labelledby="shareListModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="shareListModalLabel">Share TODO list</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="shareListForm">
                                    <select class="form-select mb-2" aria-label="Default select example" name="userId" id="selectUserId">
                                        <option selected disabled>Choose user</option>
                                    </select>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="canEdit" id="canEditCheck">
                                        <label class="form-check-label" for="canEditCheck">
                                            Can edit
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="shareListBtn">Share</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="todoListContainer"></div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="todoScript"></div>
@endsection
