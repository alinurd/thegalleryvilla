@extends('admin.layouts.app', ['title' => 'Users'])
@section('content')
    <!-- list and filter start -->
    <div class="card">
        <div class="card-body border-bottom">
            <h4 class="card-title">Search & Filter</h4>
            <div class="row">
                <div class="col-md-4 filter-status"></div>
                <div class="col-md-4 filter-role"></div>
            </div>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <table class="data-table table"></table>
        </div>
        <!-- Modal to add new user starts-->

        <div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalScrollableTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <form id="modal-submit" class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-input type="text" name="name" placeholder="Name" required />
                        <x-input type="email" name="email" placeholder="Email" required />
                        <x-input type="text" name="mobile_phone" placeholder="Mobile Phone" required />
                        <x-input type="password" name="password" placeholder="Password" />
                        <x-input type="password" name="password_confirmation" label="Password Confirmation"
                            placeholder="Password Confirmation" />
                        <x-select name="role">
                            @foreach ($role as $item)
                                <option value="{{ $item->name }}">{{ ucwords($item->name) }}</option>
                            @endforeach
                        </x-select>
                        <x-input type="file" name="avatar" />
                        <x-select name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                            <option value="-1">Blocked</option>
                        </x-select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary me-1 button-submit">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modal-status" tabindex="-1" aria-labelledby="modalStatus"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <form id="modal-status-submit" class="modal-content" novalidate>
                    <div class="modal-header">
                        <div class="modal-title">Change Status</div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-input type="text" name="name" placeholder="Name" disabled />
                        <x-input type="email" name="email" placeholder="Email" disabled />
                        <x-select name="status" required>
                        </x-select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary me-1 button-submit">Save</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const myId = '{{auth()->id()}}';
        $(function() {
            'use strict';
            // Basic example
            var
                routeEdit =
                "{{ route('admin.userman.user.update', '') }}",
                routeAdd =
                "{{ route('admin.userman.user.store', '') }}",
                routeDelete =
                "{{ route('admin.userman.user.delete', '') }}",
                assetPath = "{{ asset('storage/images/user') }}",
                rowData = null,
                idData = null,
                form = {
                    name: "",
                    mobile_phone: "",
                    email: "",
                    status: "",
                    avatar: "",
                    role: "",
                },
                statusObj = {
                    '1': {
                        title: 'Active',
                        class: 'btn-success'
                    },
                    '0': {
                        title: 'Inactive',
                        class: 'bg-info text-white'
                    },
                    '-1': {
                        title: 'Blocked',
                        class: 'btn-secondary'
                    },
                };
            // Users List datatable
            var table = $('.data-table').DataTable({
                ajax: "{{ route('admin.userman.user.all') }}",
                columns: [{
                        title: 'Id',
                        data: 'id',
                        visible: false,
                    },
                    {
                        width: "10%",
                        title:'Avatar',
                        data:'avatar',
                        render: (data, type, full, meta) => {
                            var image = data ?
                                `<div class='avatar avatar-lg mr-2'><img src='${data}' class="img-avatar" alt="Avatar"></div>` :
                                `<div class='avatar avatar-lg mr-2 bg-white'><img src='{{ asset('assets/img/noimage.jpg') }}'  alt="Avatar"></div>`
                            return image
                            // return
                        }
                    },
                    {
                        title: 'Name',
                        data: 'name'
                    },
                    {
                        title: 'Email',
                        data: 'email'
                    },
                    {
                        title: 'Role',
                        data: 'role',
                    },
                    {
                        title: 'Status',
                        data: 'status',
                        render: function(data, type, userData, meta) {
                            // let isActive;
                            // if(data == 1) {
                            //     isActive = 'checked';
                            // } else {
                            //     isActive = '';
                            // }
                            // return `
                            //     <label class="switch">
                            //         <input type="checkbox" class="switch-input"
                            //             id="status-${userData.id}"
                            //             onchange="actionChangeStatusItem('${userData.id}')" ${isActive}  />
                            //         <span class="switch-toggle-slider">
                            //             <span class="switch-on"></span>
                            //             <span class="switch-off"></span>
                            //         </span>
                            //     </label>`;
                            let addClass;
                            if(userData.id != myId) {
                                addClass = 'status-record';
                            } else {
                                addClass = 'disabled';
                            }
                            return (
                                '<a href="javascript:;" class="btn rounded-pill waves-effect waves-light '+addClass+' btn-sm ' +
                                statusObj[data].class +
                                '" text-capitalized>' +
                                statusObj[data].title +
                                "</a>"
                            );
                        },
                    },
                    {
                        title: 'Status Text',
                        data: 'status',
                        visible: false,
                        render: function(data, type, userData, meta) {
                            return (
                                '<span class="badge rounded-pill ' +
                                statusObj[data].class +
                                '" text-capitalized>' +
                                statusObj[data].title +
                                "</span>"
                            );
                        },
                    },
                    {
                        data: null,
                        title: 'Actions',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var $status = full["status"];
                            var $id = full["id"];
                            return (
                                `<div class="btn-group data-action text-small">` +
                                '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                                feather.icons['more-vertical'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>' +
                                `<div class="dropdown-menu dropdown-menu-end">` +
                                `<a href="javascript:;" class="dropdown-item edit-record text-dark data-write">` +
                                feather.icons['edit-2'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) +
                                'Edit</a>' +
                                `<a href="javascript:;" class="dropdown-item status-record text-dark data-write">` +
                                feather.icons['award'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) +
                                'Change Status</a>' +
                                `<a href="javascript:;" class="dropdown-item delete-record text-danger data-delete ">` +
                                feather.icons['trash-2'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) +
                                'Delete</a></div>' +
                                '</div>' +
                                '</div>'
                            );
                        }
                    }
                ],
                // order: [
                //     [0, 'desc']
                // ],
                ordering: false,
                // Filter data
                initComplete: function() {
                    window.addEventListener("load", event => {
                    var image = document.querySelectorAll('.img-avatar');
                        image.forEach((item) => {
                            if(item.naturalWidth < 5) {
                                item.src = "{{ asset('assets/img/noimage.jpg') }}";
                            }
                        });

                    });
                    // Adding status filter once table initialized
                    this.api().columns(6).every(function() {
                        var column = this;
                        var label = $(
                            '<label class="form-label" for="filter-status">Status</label>'
                        ).appendTo(".filter-status");
                        var select = $(
                                '<select id="filter-status" class="form-select text-capitalize mb-md-0 mb-2xx "><option value=""> Select Status </option></select>'
                            )
                            .appendTo(".filter-status")
                            .on("change", function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(
                                        val ? "^" + val + "$" : "",
                                        true,
                                        false
                                    )
                                    .draw();
                            });
                        column.data().unique().sort().each(function(d, j) {
                            select.append(
                                '<option value="' +
                                statusObj[d].title +
                                '" class="text-capitalize">' +
                                statusObj[d].title +
                                "</option>"
                            );
                        });
                    });
                    this.api().columns(4).every(function() {
                        var column = this;
                        var label = $(
                            '<label class="form-label" for="filter-role">Role</label>'
                        ).appendTo(".filter-role");
                        var select = $(
                                '<select id="filter-role" class="form-select text-capitalize mb-md-0 mb-2xx"><option value=""> Select Role </option></select>'
                            )
                            .appendTo(".filter-role")
                            .on("change", function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(
                                        val ? "^" + val + "$" : "",
                                        true,
                                        false
                                    )
                                    .draw();
                            });
                        column.data().unique().sort().each(function(d, j) {
                            select.append(
                                '<option value="' +
                                d +
                                '" class="text-capitalize">' +
                                d +
                                "</option>"
                            );
                        });
                    });
                },
                buttons: [{
                        extend: "collection",
                        className: "btn btn-outline-secondary dropdown-toggle me-2",
                        text: feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                        buttons: [{
                                extend: "print",
                                text: feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [1, 2, 3, 4]
                                },
                            },
                            {
                                extend: "csv",
                                text: feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [1, 2, 3, 4]
                                },
                            },
                            {
                                extend: "excel",
                                text: feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [0, 1, 2]
                                },
                            },
                            {
                                extend: "pdf",
                                text: feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [0, 1, 2]
                                },
                            },
                        ],
                        init: function(api, node, config) {
                            $(node).addClass("d-inline-flex mt-50");
                            $(node).parent().removeClass("btn-group");
                            setTimeout(function() {
                                $(node)
                                    .closest(".dt-buttons")
                                    .removeClass("btn-group")
                                    .addClass("d-inline-flex mt-50");
                            }, 50);
                        },
                    },
                    {
                        text: "Add New User",
                        className: `add-new btn btn-primary data-create`,
                        attr: {
                            "id": "add-data",
                        },
                        init: function(api, node, config) {
                            $(node).addClass("d-inline-flex mt-50");
                        },
                    },
                ],
                dom: '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
                    '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
                    '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
                    '>t' +
                    '<"d-flex justify-content-between mx-2 row mb-1"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    '>',
                language: {
                    sLengthMenu: 'Show _MENU_',
                    search: 'Search',
                    searchPlaceholder: 'Search..'
                },
            });
            //delete item table
            $('.data-table tbody').on('click', '.delete-record', function() {
                var data = table.row($(this).parents('tr'))
                deleteItemTable(data, routeDelete)
            });
            //show modal edit with data
            $('.data-table tbody').on('click', '.edit-record', function() {
                $('#modal-form').on('hidden.bs.modal', function() {
                    $(this).find('form').trigger('reset');
                    $(".form-error").text('');
                })
                $('.modal-title').text('Edit User')
                $('.button-submit').text('Update')
                rowData = table.row($(this).parents('tr'));
                idData = rowData.data().id

                Object.keys(form).forEach(function(key) {
                    if (key != 'avatar') {
                        $(`#form-${key}`).val(rowData.data()[key])
                    } else
                        changeImage(key, rowData.data()[key], '')
                });
                $('#modal-form').modal('show');
            });
            //show modal status with data
            $('.data-table tbody').on('click', '.status-record', function() {
                $('#modal-status').on('hidden.bs.modal', function() {
                    $(this).find('form').trigger('reset');
                })
                $('#modal-status .modal-title').text('Change User Status')
                $('#modal-status .button-submit').text('Update')
                rowData = table.row($(this).parents('tr'));
                idData = rowData.data().id
                Object.keys(form).forEach(function(key) {
                    if(key == 'status') {
                        if(rowData.data()[key] == '1'){
                            // active
                            $(`#modal-status #form-${key}`).html(`
                                <option value="" selected disabled>Choose new status</option>
                                <option value="0">Inactive</option>
                                <option value="-1">Blocked/Banned</option>
                            `);

                        } else if(rowData.data()[key] == '0'){
                            // inactive
                            $(`#modal-status #form-${key}`).html(`
                                <option value="" selected disabled>Choose new status</option>
                                <option value="1">Activated</option>
                                <option value="-1">Blocked/Banned</option>
                            `);
                        } else if(rowData.data()[key] == '-1'){
                            // inactive
                            $(`#modal-status #form-${key}`).html(`
                                <option value="" selected disabled>Choose new status</option>
                                <option value="1">Activated</option>
                                <option value="0">Inactive</option>
                            `);

                        }
                    } else {
                        if (key != 'avatar') {
                            $(`#modal-status #form-${key}`).val(rowData.data()[key])
                        }
                    }
                });
                $('#modal-status').modal('show');
            });
            //change status item
            $('form#modal-status-submit').on('submit', async function(e) {
                e.preventDefault()
                const formStatus = document.getElementById('modal-status-submit');
                if(!formStatus.checkValidity()) {
                    sweetAlert('error', 'Status required');
                } else {
                    var url = "{{route('admin.userman.user.change-status')}}"
                    var data = new FormData(this);
                    if (idData) {
                        data.append('id', idData)
                    }
                    var response = await fetch(url, {
                        method: "POST",
                        headers: {
                            'Accept': 'application/json',
                            'url': url,
                            "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                        },
                        body: data
                    })
                    if (response.ok) {
                        var dataResponse = await response.json();
                        table.ajax.reload()
                        $('#modal-status').modal('hide');
                        sweetAlert('success', dataResponse.success)
                    } else {
                        var errors = await response.json();
                        if (response.status == 422) {
                            $(".form-error").text('');
                            errors = errors.errors
                            $.each(errors, function(key, val) {
                                $("#form-error-" + key).text(val[0]);
                            });
                        } else
                            sweetAlert('error', errors.error)
                    }
                }
            });
            //show modal create
            $('#add-data').on('click', function() {
                idData = null
                $('#modal-form').on('hidden.bs.modal', function() {
                    $(".form-error").text('');
                })
                Object.keys(form).forEach(function(key) {
                    if (key != 'avatar') {
                        $(`#form-${key}`).val('')
                    } else
                        changeImage(key, '', '')
                });
                $('.modal-title').text('Add User')
                $('.button-submit').text('Create')
                $('#modal-form').modal('show')

            });
            //store item
            $('form#modal-submit').on('submit', async function(e) {
                e.preventDefault()
                var url = idData ? (routeEdit + '/' + idData) : routeAdd
                var data = new FormData(this);
                if (idData) {
                    data.append('_method', 'PUT')
                }
                var response = await fetch(url, {
                    method: "POST",
                    headers: {
                        'Accept': 'application/json',
                        'url': url,
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                    },
                    body: data
                });
                if (response.ok) {
                    var dataResponse = await response.json();
                    table.ajax.reload()
                    $('#modal-form').modal('hide');
                    sweetAlert('success', dataResponse.success)
                } else {
                    var errors = await response.json();
                    if (response.status == 422) {
                        $(".form-error").text('');
                        errors = errors.errors
                        $.each(errors, function(key, val) {
                            $("#form-error-" + key).text(val[0]);
                        });
                    } else
                        sweetAlert('error', errors.error)
                }

            });

        });
    </script>
    {{-- <script>
        function actionChangeStatusItem(id) {
            $.ajax({
                type: 'POST',
                url: '{{route('userman.user.change-status')}}',
                data: {
                    _token: $('meta[name=csrf-token]').attr('content'),
                    id: id
                },
                cache: false,
                success: function(data) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Status Change Successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    }).then(result => {
                        // window.location.reload();
                        const currentUrl = "{{url()->current() }}";
                        window.location.href = currentUrl;
                    })

                }
            });
        }
    </script> --}}
    {{-- <script>
        $(function() {
            var permission = ['create', 'write', 'delete'];
            var userPermission = "{{ auth()->user()->can('user-management user create') }}"
            permission.forEach(key => {
                if (userPermission.include()) {

                }
                var element = {{ auth()->user()->can('user-management user create')? 1: 0 }}
                if (element) {
                    console.log(key)
                }
            });
        })
    </script> --}}
@endpush
