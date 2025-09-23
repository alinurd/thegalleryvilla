// main.js
// Pastikan untuk include file address-form.js sebelum file ini

// delete
function btnDeleteItem(target, title) {
    Swal.fire({
        title: 'Apakah Anda yakin ingin menghapus: ' + title + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batalkan',
        customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            swAlertDialog('success', 'Berhasil menghapus data');
            $.get(target, () => location.reload());
        }
    })
}

// multi delete
function actionMultiDeleteItems() {
    var id = [];
    $('.delete-checkbox:checked').each(function() {
        id.push(parseInt($(this).val()));
    });
    Swal.fire({
        title: 'Apakah Anda yakin ingin menghapus semua data terpilih?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            swAlertDialog('success', 'Berhasil menghapus data terpilih');
            $.get("{{ route($prefixRoute.'multi_delete') }}", { id: id }, () => location.reload());
        }
    })
}

// update status
function actionChangeStatusItem(url, id) {
    let sts = document.getElementById('status' + id).checked ? 1 : 0;
    $.get(url, { sts: sts }, function(res) {
        swAlertDialog(res.status, res.message);
        if (res.status == 'success') location.reload();
    }, 'json');
}

// save data
function saveData() {
    let hasEmptyRequiredForm = false;
    $('#formData .form-control[required]:visible').each(function() {
        if (!$(this).val()) hasEmptyRequiredForm = true;
    });
    if (hasEmptyRequiredForm) {
        return swAlertDialog('error', 'Silakan isi semua formulir');
    }

    const jsonData = {};
    $('#formData .form-control').each(function() {
        let key = $(this).attr('name');
        jsonData[key] = $(this).val().trim();
    });

    $.ajax({
        type: "POST",
        url: "{{ route($prefixRoute.'create') }}",
        data: jsonData,
        dataType: 'json',
        beforeSend: function() {
            $('#submit').prop('disabled', true);
            $('#loading').removeClass('hidden');
            $('#simpan').addClass('hidden');
        },
        success: function(res) {
            if (res.status == 'success') {
                swAlertDialog('success', 'Data berhasil disimpan');
                location.reload();
            } else {
                swAlertDialog('error', res.message);
                $('#submit').prop('disabled', false);
                $('#loading').addClass('hidden');
                $('#simpan').removeClass('hidden');
            }
        }
    });
}

// edit
function btnEditItem(url, id) {
    $.get(url, function(res) {
        if (res.status == 'success') {
            $.each(res.data[0], function(name, val) {
                $(`#formData .form-control[name='${name}']`).val(val);
                if (name === 'image' && val) {
                    $('#formData #holder img').attr('src', "{{ url('/') }}/" + val);
                }
            });
            $('#data_id').val(id);
            $('#modalForm').modal('toggle');
            
            // Inisialisasi AddressForm setelah modal terbuka
            setTimeout(() => {
                console.log('Initializing AddressForm for edit');
                if (window.addressFormInstance) {
                    window.addressFormInstance.destroy();
                }
                window.addressFormInstance = new AddressForm();
            }, 500);
        } else {
            swAlertDialog('error', res.message);
        }
    }, 'json');
}

function openForm() {
    $('#formData .form-control').val('');
    $('#status').val('');
    $('#technicianId').val("{{ $codeNew }}");
    $('#formData #holder img').attr('src', "{{ asset('assets/img/noimage.jpg') }}");
    $('#modalForm').modal('toggle');
    
    // Inisialisasi AddressForm setelah modal terbuka sepenuhnya
    setTimeout(() => {
        console.log('Initializing AddressForm for new form');
        if (window.addressFormInstance) {
            window.addressFormInstance.destroy();
        }
        window.addressFormInstance = new AddressForm();
    }, 500);
}

function onlyNumberKey(evt) {
    var ASCIICode = evt.which ? evt.which : evt.keyCode;
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
    return true;
}

// Inisialisasi saat DOM siap
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded, checking for address form');
    
    // Cek apakah elemen form alamat ada di halaman
    if (document.getElementById('province')) {
        console.log('Address form found on page, initializing');
        window.addressFormInstance = new AddressForm();
    } else {
        console.log('No address form found on page');
    }
    
    // Jika menggunakan modal Bootstrap, dengarkan event shown
    $('#modalForm').on('shown.bs.modal', function () {
        console.log('Modal shown, initializing AddressForm');
        if (window.addressFormInstance) {
            window.addressFormInstance.destroy();
        }
        window.addressFormInstance = new AddressForm();
    });

    // Cleanup saat modal ditutup
    $('#modalForm').on('hidden.bs.modal', function () {
        if (window.addressFormInstance) {
            window.addressFormInstance.destroy();
            window.addressFormInstance = null;
        }
    });
});