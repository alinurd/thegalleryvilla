@extends('admin.layouts.app', ['title' => 'Role'])
@section('content')
    <!-- list and filter start -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="data-table table"></table>
        </div>
        <!-- Modal to add new user starts-->
        <div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="modal-submit" class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-input type="text" name="name" placeholder="Name" />
                        <x-input type="text" name="guard" placeholder="Guard" />
                        <h4 class="mt-2 pt-50">Role Permissions</h4>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">
                                            Administrator Access
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Allows a full access to the system">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-info">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="12" y1="16" x2="12" y2="12">
                                                    </line>
                                                    <line x1="12" y1="8" x2="12.01" y2="8">
                                                    </line>
                                                </svg>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAllPermission">
                                                <label class="form-check-label" for="selectAll"> Select All </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($permission as $key => $item)
                                        @php
                                            $read = $item->where('permission', 'read')->first();
                                            $write = $item->where('permission', 'write')->first();
                                            $create = $item->where('permission', 'create')->first();
                                            $delete = $item->where('permission', 'delete')->first();
                                        @endphp
                                        <tr>
                                            <td class="text-nowrap fw-bolder">
                                                {{ $key }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" {{ !$read ? 'disabled' : null }}
                                                            type="checkbox" value="{{ $read['id'] ?? null }}"
                                                            name="{{ $read ? 'permission[]' : null }}" id="permissionCheck">
                                                        <label class="form-check-label" for="permissionCheck"> Read
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" {{ !$write ? 'disabled' : null }}
                                                            type="checkbox" id="permissionCheck"
                                                            name="{{ $write ? 'permission[]' : null }}"
                                                            value="{{ $write['id'] ?? null }}">
                                                        <label class="form-check-label" for="permissionCheck"> Write
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            {{ !$create ? 'disabled' : null }} id="permissionCheck"
                                                            value="{{ $create['id'] ?? null }}"
                                                            name="{{ $create ? 'permission[]' : null }}">
                                                        <label class="form-check-label" for="permissionCheck"> Create
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $delete['id'] ?? null }}"
                                                            name="{{ $delete ? 'permission[]' : null }}"
                                                            {{ !$delete ? 'disabled' : null }} id="permissionCheck">
                                                        <label class="form-check-label" for="permissionCheck"> Delete
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary me-1 button-submit">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            'use strict';
            var
                routeGetAll = "{{ route('admin.userman.role.all', '') }}",
                routeEdit =
                "{{  route('admin.userman.role.update','') }}",
                routeAdd =
                "{{ route('admin.userman.role.store', '') }}",
                routeDelete =
                "{{ route('admin.userman.role.delete', '')}}",
                rowData = null,
                idData = null
            // Users List datatable
            var table = $('.data-table').DataTable({
                ajax: routeGetAll,
                columns: [{
                        title: 'Id',
                        data: 'id',
                        visible: false,
                    },
                    {
                        title: 'Name',
                        data: 'name',
                        render: (data, type, full, meta) => data.toLowerCase().replace(/\b[a-z]/g,
                            function(letter) {
                                return letter.toUpperCase();
                            })
                    },
                    {
                        title: 'User Count',
                        data: 'user_count'
                    },
                    {
                        title: 'permission',
                        data: 'permission',
                        visible: false
                    },
                    {
                        data: null,
                        title: 'Actions',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var $status = full["status"];
                            var $id = full["id"];
                            return (
                                `<div class="btn-group ${routeEdit || routeDelete ? null : 'hidden' }">` +
                                '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                                feather.icons['more-vertical'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>' +
                                `<div class="dropdown-menu dropdown-menu-end">` +
                                `<a href="javascript:;" class="dropdown-item edit-record text-warning ${routeEdit ? null : 'hidden' }">` +
                                feather.icons['edit-2'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) +
                                'Edit</a>' +
                                `<a href="javascript:;" class="dropdown-item delete-record text-danger ${routeDelete ? null : 'hidden' } ">` +
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
                order: [
                    [0, 'desc']
                ],
                buttons: [{
                    text: "Add New Role",
                    className: `add-new btn btn-primary ${!routeAdd ? 'hidden' : null}`,
                    attr: {
                        "id": "add-data",
                    },
                    init: function(api, node, config) {
                        $(node).addClass("d-inline-flex mt-50");
                    },
                }, ],
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
                $('.modal-title').text('Edit Role')
                $('.button-submit').text('Update')
                rowData = table.row($(this).parents('tr'));
                idData = rowData.data().id
                rowData.data().permission.forEach(function(value, index) {
                    $("input[name='permission[]'][value='" + value + "']").prop('checked', true)
                });
                checkIfcheckedAll()
                $('#form-name').val(rowData.data().name)
                $('#form-guard').val(rowData.data().guard_name)
                $('#modal-form').modal('show')
            });
            //show modal create
            $('#add-data').on('click', function() {
                idData = null
                //reset form
                $('#modal-form').on('hidden.bs.modal', function() {
                    $(this).find('form').trigger('reset');
                    $(".form-error").text('');
                })
                $('.modal-title').text('Add Role')
                $('.button-submit').text('Create')
                $('#modal-form').modal('show')

            });
            //store item
            $('form#modal-submit').on('submit', async function(e) {
                e.preventDefault()
                var checkboxes = $('input[name="permission[]"]');
                var checked = checkboxes.filter(':checked')
                var permission = checked.map(function() {
                    return this.value;
                }).get();
                var url = idData ? (routeEdit + '/' + idData) : routeAdd
                var data = new FormData();
                data.append('name', $('input[name="name"]').val())
                data.append('guard', $('input[name="guard"]').val())
                data.append('permission', permission)
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
                })
                if (response.ok) {
                    var dataResponse = await response.json();
                    table.ajax.reload()
                    sweetAlert('success', dataResponse.success)
                    $('#modal-form').modal('hide');
                } else {
                    var errors = await response.json();
                    if (response.status == 422) {
                        $(".form-error").text('');
                        errors = errors.errors
                        $.each(errors, function(key, val) {
                            sweetAlert('error', val[0])
                        });
                    } else
                        sweetAlert('error', errors.error)
                }
            });
            $('#checkAllPermission').click(function() {
                $('input[name="permission[]"]').prop('checked', this.checked);
            });
            $('input[name="permission[]"]').on('change', function() {
                checkIfcheckedAll()
            });
        });

        function checkIfcheckedAll() {
            var all = $('input[name="permission[]"]').length
            var checked = $('input[name="permission[]"]:checked').length
            if (all == checked) {
                $('#checkAllPermission').prop('checked', true)
            } else
                $('#checkAllPermission').prop('checked', false)
        }
    </script>
@endpush
