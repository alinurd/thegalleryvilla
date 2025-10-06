<script>
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
                $.get("{{ route($prefixRoute . 'multi_delete') }}", {
                    id: id
                }, () => location.reload());
            }
        })
    }

    // update status
    function actionChangeStatusItem(url, id) {
        let sts = document.getElementById('status' + id).checked ? 1 : 0;
        $.get(url, {
            sts: sts
        }, function(res) {
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
            url: "{{ route($prefixRoute . 'create') }}",
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
                });

                if (res.data[0].type == "1") {
                    $("#video-wrapper").removeClass("d-none");
                    $("#image-wrapper").addClass("d-none");
                } else {
                    $("#video-wrapper").addClass("d-none");
                    $("#image-wrapper").removeClass("d-none");
                    $("#video-link, #video-embed").val("");
                    $("#video-preview").html(
                        "<small class='text-muted'>Preview Video akan tampil di sini</small>");
                    $("#video-platform").text("-").removeClass("bg-danger bg-dark bg-instagram text-white");
                }

                if (res.data[0].link) {
                    renderVideoEmbed(res.data[0].link);
                }



                $('#data_id').val(id);
                $('#modalForm').modal('toggle');
            } else {
                swAlertDialog('error', res.message);
            }
        }, 'json');
    }

    function openForm() {
        $('#formData .form-control').val('');
        $('#statusForm').val("active");
        $('#data_id').val(0);
        $('#type').val(0);
        $('#formData #holder img').attr('src', "{{ asset('assets/img/noimage.jpg') }}");
        $('#modalForm').modal('toggle');
        $("#video-wrapper").addClass("d-none");

    }

    function onlyNumberKey(evt) {
        var ASCIICode = evt.which ? evt.which : evt.keyCode;
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
        return true;
    }



    $(document).ready(function() {

        // toggle Image/Video
        $("#type").on("change", function() {
            if ($(this).val() == "1") {
                $("#video-wrapper").removeClass("d-none");
                $("#image-wrapper").addClass("d-none");
            } else {
                $("#video-wrapper").addClass("d-none");
                $("#image-wrapper").removeClass("d-none");
                $("#video-link, #video-embed").val("");
                $("#video-preview").html(
                    "<small class='text-muted'>Preview Video akan tampil di sini</small>");
            }
        });

        $("#video-link").on("input", function() {
            renderVideoEmbed($(this).val().trim());
        });

    });




    // fungsi render embed
  function renderVideoEmbed(url) {
    url = url || "";
    url = String(url).trim();

    let embedUrl = "";
    let mediaPlatfor = "";
    let preview = "<small class='text-muted'>Preview Video akan tampil di sini</small>";
    let platformBadge = $("#video-platform");

    // reset platform
    platformBadge.text("-").removeClass("bg-danger bg-dark bg-instagram text-white");
 
    let yt = url.match(/(?:youtube\.com.*v=|youtu\.be\/)([^&?/]+)/);
    if (yt) {
        mediaPlatfor = "YouTube";
        let videoId = yt[1];
        embedUrl = `https://www.youtube.com/embed/${videoId}`;
        preview = `<iframe width="100%" height="315" src="${embedUrl}" frameborder="0" allowfullscreen></iframe>`; 
        platformBadge.text(mediaPlatfor).addClass("bg-danger text-white");
    }

    // YouTube 
    else if (url.includes("youtube.com/embed/")) {
        mediaPlatfor = "YouTube";
        embedUrl = url;
        preview = `<iframe width="100%" height="315" src="${embedUrl}" frameborder="0" allowfullscreen></iframe>`;
        platformBadge.text(mediaPlatfor).addClass("bg-danger text-white");
    }

    // TikTok
    let tiktok = url.match(/tiktok\.com\/.+\/video\/(\d+)/);
    if (tiktok) {
        mediaPlatfor = "TikTok";
        let videoId = tiktok[1];
        embedUrl = url;
        preview = `
          <blockquote class="tiktok-embed" cite="${url}" data-video-id="${videoId}" style="max-width: 605px;min-width: 325px;" >
            <section></section>
          </blockquote>
        `;
        setTimeout(() => {
            let script = document.createElement("script");
            script.src = "https://www.tiktok.com/embed.js";
            script.async = true;
            document.body.appendChild(script);
        }, 100);
        platformBadge.text(mediaPlatfor).addClass("bg-dark text-white");
    }

    // Instagram
    let ig = url.match(/instagram\.com\/(p|reel|tv)\/([^/?#&]+)/);
    if (ig) {
        mediaPlatfor = "Instagram";
        embedUrl = `https://www.instagram.com/${ig[1]}/${ig[2]}/embed`;
        preview = `<iframe src="${embedUrl}" width="100%" height="400" frameborder="0" scrolling="no" allowtransparency="true"></iframe>`;
        platformBadge.text(mediaPlatfor).addClass("bg-instagram text-white");
    }
 
     if(mediaPlatfor !== "YouTube"){
                                swAlertDialog('error', 'masukan link yang di izinkan ');
                                $("#media").val(null);
    $("#video-embed").val(null);
    $("#video-preview").html(null);
    }else{
        $("#media").val(mediaPlatfor);
    $("#video-embed").val(embedUrl);
    $("#video-preview").html(preview);
    }
     
}

</script>
