@php
    $setting = AppSetting::first();
@endphp
<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{ url('/') }}"
    data-template="vertical-menu-template">


<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> {{ $setting?->title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keyword" content="{{ $setting->meta_keyword }}" />
    <meta name="description" content="{{ $setting->meta_description }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="{{ $setting?->favicon ? asset($setting->favicon) : asset('assets/img/favicon/favicon.ico') }}" />
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
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

    <!-- GLightbox -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/frontend/app.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('_css/style.css') }}"> --}}
</head>

<body>



    {{-- Konten --}}
    <main>
        @yield('content')
    </main>
    <a class="btn btn-brown btn-lg whatsapp-float"
        href="https://wa.me/{{ $setting->whatsapp }}?text={{ urlencode('Halo Pelanggan setia The Gallery Villa, Saya ingin reservasi (Booking) kamar The Gallery Villa. Bisakah Saya mendapatkan informasi harga Villa Aurora atau Villa Esperanza?') }}"
        target="_blank">
        <i class="fab fa-whatsapp" aria-hidden="true"></i>
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            background-color: #25D366;
            color: white;
            border-radius: 50%;
            text-align: center;
            font-size: 28px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            color: white;
        }
    </style>

    {{-- Footer --}}
    @include('frontend.components.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>


    <!-- CDN GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="{{ asset('_js/app.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#submit').on('click', function(e) {
                e.preventDefault();
                saveData();
            });

        });

        function saveData() {
             let hasEmptyRequiredForm = false;

            $('#formData input[required]:visible, #formData textarea[required]:visible').each(function() {
                if (!$(this).val()) hasEmptyRequiredForm = true;
            });

            if (hasEmptyRequiredForm) {
                return swAlertDialog('error', 'Silakan isi semua formulir');
            }

            const email = $('#formData input[name="email"]').val();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                return swAlertDialog('error', 'Format email tidak valid. Silakan periksa kembali.');
            }

             const message = $('#formData textarea[name="message"]').val().trim();
        if (message.length < 10) {
            return swAlertDialog('error', 'Pesan minimal harus 10 karakter.');
        }

      // const spamWords = [
      //       'gratis', 'hadiah', 'uang', 'promo', 'diskon', 'transfer',
      //       'klik di sini', 'link ini', 'daftar sekarang', 'belanja',
      //       'pinjaman', 'kredit', 'menang', 'lotre', 'bitcoin', 'crypto'
      //   ];

        // const lowerMsg = message.toLowerCase();
        // const foundSpamWords = spamWords.filter(word => lowerMsg.includes(word));

        // const spamThreshold = 4;

        // if (foundSpamWords.length >= spamThreshold) {
        //     return swAlertDialog(
        //         'error',
        //         `Pesan Anda mengandung terlalu banyak kata mencurigakan (${foundSpamWords.length}). Harap ubah isi pesan agar tidak dianggap spam.`
        //     );
        // } else if (foundSpamWords.length > 0) { 
        //     console.warn(`⚠️ Ditemukan kata mencurigakan: ${foundSpamWords.join(', ')}`);
        // }

            const formData = $('#formData').serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('sendMail') }}",
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('#submit').prop('disabled', true);
                    $('#loading').removeClass('d-none');
                    $('#simpan').addClass('d-none');
                },
                success: function(res) {
                    if (res.status === 'success' || res === 'OK') {
                        swAlertDialog('success',
                            'Terima kasih sudah menghubungi kami, tim kami akan segera merespon pesan Anda.'
                            );
                        $('#formData')[0].reset();
                    } else {
                        swAlertDialog('error', res.message ?? 'Terjadi kesalahan saat mengirim email.');
                    }
                },
                error: function(err) {
                    console.error(err);
                    swAlertDialog('error', 'Gagal mengirim email. Silakan coba lagi.');
                },
                complete: function() {
                    $('#submit').prop('disabled', false);
                    $('#loading').addClass('d-none');
                    $('#simpan').removeClass('d-none');
                }
            });
        }


        // === SweetAlert Helpers ===
        function sweetAlert(type, message) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 1500
            });
        }

        function swAlertDialog(type, message) {
            Swal.fire({
                title: type === 'error' ? 'Gagal!' : 'Berhasil!',
                text: message,
                icon: type === 'error' ? 'error' : 'success',
                confirmButtonText: 'Oke',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
            });
        }
    </script>
 
</body>

</html>
