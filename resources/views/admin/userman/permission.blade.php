@extends('admin.layouts.app', ['title' => 'Permission'])
@section('content')
    <!-- list and filter start -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="data-table table"></table>
        </div>
        <!-- Modal to add new user starts-->
        <div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <form id="modal-submit" class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-input type="text" name="name" placeholder="Name" />
                        <x-input type="text" name="guard" placeholder="Guard" />
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
                routeEdit =
                "{{route('admin.userman.permission.update','')}}",
                routeAdd =
                "{{route('admin.userman.permission.store', '') }}",
                routeDelete =
                "{{ route('admin.userman.permission.delete', '') }}",
                routeGetAll = "{{ route('admin.userman.permission.all', '') }}",
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
                        title: 'Guard',
                        data: 'guard_name',
                        render: (data, type, full, meta) => data.toLowerCase().replace(/\b[a-z]/g,
                            function(letter) {
                                return letter.toUpperCase();
                            })
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
                    text: "Add New Permission",
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
                $('.modal-title').text('Edit Permission')
                $('.button-submit').text('Update')
                rowData = table.row($(this).parents('tr'));
                idData = rowData.data().id
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
                $('.modal-title').text('Add Permission')
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
                })
                if (response.ok) {
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
@endpush
