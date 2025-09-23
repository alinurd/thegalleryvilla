
@php
    $setting = AppSetting::first();
@endphp
<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('/assets') . '/' }}"
  data-base-url="{{url('/')}}"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $title }} | {{ $setting?->title ? $setting->title : 'PT. Maxon Prime Technology' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keyword" content="{{$setting->meta_keyword}}" />
    <meta name="description" content="{{$setting->meta_description}}" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ $setting?->favicon ? asset($setting->favicon) : asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/min/sweetalert2.min.css') }}" /> --}}

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />

    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tables/datatable/css/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tables/datatable/css/responsive.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tables/datatable/css/buttons.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tables/datatable/css/rowGroup.bootstrap5.min.css') }}"/> --}}

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}" />
    <style type="text/css">
        .hidden { display: none; }
        .zoom {
            transition: transform .2s; /* Animation */
            width: 200px;
            height: 200px;
            margin: 0 auto;
        }

        .zoom:hover {
            transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
    </style>
    @stack('css')

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
              <span class="app-brand-logo menu-text fw-bold">
                <img src="{{ $setting?->logo ? asset($setting->logo) : asset('assets/img/logo-maxon.png') }}" alt="Logo" class="w-50">
              </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>
            @include('admin.layouts.menu')
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @include('admin.layouts.navbar')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">

            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Content -->
                @yield('content')
                <!-- / Content -->
            </div>

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container py-2">
                  <div>
                    @if($setting?->footer_text)
                        {{$setting->footer_text}}
                    @else
                        ©
                        <script>
                        document.write(new Date().getFullYear());
                        </script>
                        ,
                        <a href="https://maxonprime.id" target="_blank" class="footer-link text-primary fw-medium"
                        >PT. Maxon Prime Technology</a
                        >
                    @endif
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    {{-- <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script> --}}
    {{-- <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script> --}}
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/libs/sweetalert2/min/sweetalert2.all.min.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>


    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    {{-- <script src="{{ asset('assets') }}/vendor/libs/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/tables/datatable/responsive.bootstrap5.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/tables/datatable/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/tables/datatable/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/tables/datatable/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/tables/datatable/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/tables/datatable/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/tables/datatable/dataTables.rowGroup.min.js"></script> --}}


    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/imask/imask.min.js') }}"></script>
    <script>
        const nodeList = document.querySelectorAll(".mask-money");
        for (let i = 0; i < nodeList.length; i++) {
            IMask(nodeList[i],
                {
                    mask: 'num',
                    blocks: {
                        num: {
                            // nested masks are available!
                            mask: Number,
                            thousandsSeparator: '.'
                        }
                    }
                }
            )
        }


    </script>
    <script type="text/javascript">
        // Inisialisasi semua .flatpickr dan simpan ke dalam array
        // const flatpickrInstances = $('.flatpickr').map(function () {
        //     return flatpickr(this, {
        //         // opsional: opsi flatpickr kamu
        //         dateFormat: "Y-m-d"
        //     });
        // }).get(); // .get() mengubah hasil jQuery.map menjadi array biasa
        // $('.flatpickr').flatpickr();
        const flatpickrInstances = [];

        // Inisialisasi setiap elemen dengan flatpickr dan simpan instance-nya
        $('.flatpickr-onmodal').each(function () {
            const instance = flatpickr(this, {
                dateFormat: "Y-m-d",
                //
                // static: true,
            });
            flatpickrInstances.push(instance);
        });


        $(document).ready(function() {
            $('.bs-datepicker').datepicker({
                todayHighlight: true,
                format: 'yyyy-mm-dd',
                orientation: 'auto left',
                autoclose: true,
            });
            $('.bs-datepicker-birth').datepicker({
                format: 'yyyy-mm-dd',
                orientation: 'auto left',
                autoclose: true,
                startView: "years",
            });



            // Default
            const select2 = $('.select2');
            if (select2.length) {
                select2.each(function () {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        placeholder: 'Choose',
                        dropdownParent: $this.parent()
                    });
                });
            }

        //     // Ambil URL halaman saat ini
        //     var currentUrl = window.location.href;

        //     // Loop melalui setiap tautan dalam daftar menu
        //     $('#layout-menu ul.menu-inner li.menu-item').each(function() {
        //         var menuLink = $(this).find('.menu-link').attr('href');

        //         // Periksa apakah URL halaman saat ini cocok dengan URL dari tautan menu
        //         if (currentUrl === menuLink) {
        //             // Tambahkan kelas 'active' ke elemen <li> yang sesuai
        //             $(this).addClass('active');
        //         }
        //     });

        });
    </script>
    @isset($ckeditor)
        @if ($ckeditor)
            <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
            <script>
                CKEDITOR.config.disableObjectResizing = true;
                let CKEDITORGlobalOptions = {
                        filebrowserImageBrowseUrl: "/filemanager?type=image",
                        filebrowserImageUploadUrl: "/filemanager/upload?type=image&_token={{ csrf_token() }}",
                        filebrowserBrowseUrl: "/filemanager?type=files",
                        filebrowserUploadUrl: "/filemanager/upload?type=files&_token={{ csrf_token() }}",
                        disallowedContent: 'img{width,height};'
                };

            </script>
        @endif
    @endisset

    @stack('js')

    <script type="text/javascript">

        (function( $ ){

          $.fn.filemanager = function(type, options) {
            type = type || 'file';

            this.on('click', function(e) {
              var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
              var target_input = $('#' + $(this).data('input'));
              var target_preview = $('#' + $(this).data('preview'));
              window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
              window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                  return item.url;
                }).join(',');

                // set the value of the desired input to image url
                target_input.val('').val(file_path).trigger('change');

                // clear previous preview
                target_preview.html('');

                // set or change the preview image src
                items.forEach(function (item) {
                  target_preview.append(
                    $('<img>').css('max-height', '100px').css('width', '100%').attr('src', item.url).attr('alt', 'Featured Image').addClass('rounded')
                  );
                });

                // trigger change event
                target_preview.trigger('change');
              };
              return false;
            });
          }

        })(jQuery);

    </script>
    <script>
        //datatables Set
        $(document).ready(function() {
            $('#lfm').filemanager('image');
            $('.lfm').filemanager('image');
            $('#lfmfiles').filemanager('files');


                 $('.dataTables').DataTable({

                    dom: '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
                '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" f>' +
                '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1 mb-2 mb-md-0"l>>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
                language: {
                    sLengthMenu: 'Display _MENU_',
                    search: 'Search',
                    searchPlaceholder: 'Search..'
                },
                });
        });
        function onlyNumberKey(evt) {

            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: true,
        });

        async function doAjax(url, params, method) {
            return $.ajax({
                url: url,
                type: method || 'POST',
                dataType: 'json',
                data: params
            });
        }

        function sweetAlert(type, message) {
            if (type == 'success') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: message,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            if (type == 'error') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: message,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }

        function swAlertDialog(type, message) {
            Swal.fire({
                title: type == 'error' ? 'Gagal!' : 'Berhasil!',
                text: message,
                icon: type == 'error' ? 'error' : 'success',
                confirmButtonText: 'Oke',
                customClass: {
                  confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
            })
        }

        function deleteItemTable(data, url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert thi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url + '/' + data.data().id,
                        type: 'DELETE',
                        success: function(response) {
                            sweetAlert('success', response.success)
                            data.remove().draw(false)
                        },
                        error: function(response, error) {
                            if (response.status == 404) {
                                data.remove().draw(false)
                                sweetAlert('error', response.responseJSON.error)
                            } else
                                sweetAlert('error', response.responseJSON.error)
                        },
                    });
                }
            });
        }
        async function errorResponse(response){
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

        $(window).on('load', function() {
            feather.replace({
                width: 14,
                height: 14
            });
        })

        function changeImage(formName = false, fileName = false, src = false) {
            if (fileName) {
                $(`#image-${formName}`).attr('src', src + '/' + fileName)
                    .width(150)
                    .height(150)
                    .removeClass('hidden')
            } else {
                $(`#image-${formName}`).attr('src', '#').addClass('hidden')
            }
        }
    </script>
    <script>
        $(document).on({
            'show.bs.modal': function () {
                var zIndex = 1040 + (10 * $('.modal:visible').length);
                $(this).css('z-index', zIndex);
                setTimeout(function() {
                    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
                }, 0);
            },
            'hidden.bs.modal': function() {
                if ($('.modal:visible').length > 0) {
                    // restore the modal-open class to the body element, so that scrolling works
                    // properly after de-stacking a modal.p
                    setTimeout(function() {
                        $(document.body).addClass('modal-open');
                    }, 0);
                }
            }
        }, '.modal');
        $(document).on("keydown", "form", function(event) {
            return event.key != "Enter";
        });
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }


     function formatRupiah(angka, prefix) { 
    let str = angka.toString();
 
    str = str.replace(/\.00$/, '');
 
    let number_string = str.replace(/[^0-9]/g, '');
    
    let split = number_string.split(','),
        sisa  = split[0].length % 3,
        rupiah  = split[0].substr(0, sisa),
        ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return prefix === undefined ? rupiah : (prefix + rupiah);
} 
 

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".input-money").forEach(function(el) { 
        if(el.value) {
            el.value = formatRupiah(el.value, "");
        }
 
        el.addEventListener("keyup", function(e) {
            this.value = formatRupiah(this.value, "");
        });
    });
});

    </script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('assets/js/location-form.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/form.js') }}"></script> --}}
  </body>
</html>
