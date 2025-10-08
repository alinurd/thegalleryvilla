<x-modal.pin-point-location roleName="{{ $title }}" userData="{{ $title }}" type="customer" />

<form class="form" id="formData">
                            <input type="hidden" name="id" id="data_id" class="form-control" value="0">

  <div class="row g-2 mb-3">
    <div class="col-md-6 col-12">
      <label for="sort" id="label-sort" class="form-label">Sort</label>
      <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control"
        id="sort" name="sort" autocomplete="off" required />
    </div> 
    <div class="col-md-6 col-12">
      <label for="status" id="label-status" class="form-label">Status</label>
      <select name="status" class="form-control" id="status" required>
        <option value="">- Pilih Status -</option>
    <option value="1">Active</option>
        <option value="0">Inactive</option>
      </select>
    </div>
  </div>

  {{-- <div class="mb-3">
  <div class="btn-group" role="group">
    <button type="button" id="btn-en" class="btn btn-outline-primary d-flex align-items-center gap-1" onclick="setLang('en')">
      <img src="{{ asset('assets/img/icons/en.png') }}" width="20" alt="English"> English
    </button>
    <button type="button" id="btn-id" class="btn btn-outline-danger d-flex align-items-center gap-1" onclick="setLang('id')">
      <img src="{{ asset('assets/img/icons/id.png') }}" width="20" alt="Bahasa"> Bahasa
    </button>
  </div>
</div> --}}

    
  <div class="row g-1 mb-3">
    <div class="col-md-8 col-12">
      <label for="title" id="label-title" class="form-label"></label>
      <input type="text" class="form-control" id="title" name="title" required />
    </div>
  </div>

  <div class="mb-3">
    <label for="about" id="label-about" class="form-label"></label>
    <textarea name="about" id="about" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label for="location" id="label-location" class="form-label"></label>
    <textarea name="location" id="location" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label for="facility" id="label-facility" class="form-label"></label>
    <textarea name="facility" id="facility" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label for="event_type" id="label-event_type" class="form-label"></label>
    <textarea name="event_type" id="event_type" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label for="address" id="label-address" class="form-label"></label>
    <textarea name="address" id="address" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label for="pin_point" id="label-pin_point" class="form-label"></label>
    <div class="input-group">
                <input type="hidden" class="form-control" id="lat" name="latitude" />
                <input type="hidden" class="form-control" id="lng" name="longitude" />
                <input type="text" class="form-control" id="pinPoint" name="pin_point" required />
                <span id="btn-browse-pinpoint" class="btn btn-primary"
                    onclick="$('#modalPinPointLoaction').modal('show')">Change</span>
            </div>

   </div>

  <!-- Featured Image -->
  <div class="row">
    <div class="col mb-3">
      <div class="border rounded p-2">
        <label id="label-featured" class="form-label mb-1"></label>
        <div class="d-flex flex-column flex-md-row justify-content-evenly align-items-center">
          <div id="holder" class="mb-1 mb-md-0">
            <img src="{{ asset('assets/img/noimage.jpg') }}" style="height: 110px;" alt="Featured Image">
          </div>
          <div>
            <small id="featured-note" class="text-muted"></small>
            <div class="input-group">
              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                <i class="menu-icon tf-icons ti ti-photo"></i> <span id="btn-choose"></span>
              </a>
              <input id="thumbnail" class="form-control bg-secondary-subtle" type="text" name="image" readonly>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Action -->
  <div class="row">
    <div class="col-12 text-right">
      <div class="btn-group float-end ps-2" role="group">
        <button type="button" id="submit" onclick="saveData()" class="btn btn-outline-primary">
          <div id="simpan">
            <i data-feather="save" class="me-1"></i> <span id="btn-save"></span>
          </div>
          <div id="loading" class="hidden">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span id="btn-loading"></span>
          </div>
        </button>
        <button type="reset" class="btn btn-outline-danger">
          <i data-feather="refresh-cw" class="me-1"></i> <span id="btn-reset"></span>
        </button>
      </div>
    </div>
  </div>

</form>

<script>
const lang = {
  en: {
    sort: "Sort",
    status: "Status",

    title: "Page Detail",
    about: "About As",
    location: "Strategic Location",
    facility: "Facility",
    event_type: "Suitable Event Type",
        address: "Address",
    pin_point: "Pint Point",


    featured: "Featured Image",
    featuredNote: "Please upload an image sized 400 x 400 pixels",
    choose: "Choose",
    save: "Save",
    reset: "Reset",
    loading: "Loading...",

     
  },
  id: {
    sort: "Urutan",
    status: "Status",

    title: "Page Detail",
    about: "About As",
    location: "Strategic Location",
    facility: "Facility",
    event_type: "Suitable Event Type",
    address: "Address",
    pin_point: "Pint Point",


    
    featured: "Gambar Utama",
    featuredNote: "Silakan unggah gambar berukuran 400 x 400 pixel",
    choose: "Pilih",
    save: "Simpan",
    reset: "Reset",
    loading: "Memuat...",

    
  }
};

function setLang(l) {
  // Label
  document.getElementById("label-sort").innerText = lang[l].sort;
  document.getElementById("label-status").innerText = lang[l].status; 
  document.getElementById("label-featured").innerText = lang[l].featured;



  document.getElementById("label-about").innerText = lang[l].about;
  document.getElementById("label-title").innerText = lang[l].title;
  document.getElementById("label-location").innerText = lang[l].location;
  document.getElementById("label-facility").innerText = lang[l].facility;
  document.getElementById("label-event_type").innerText = lang[l].event_type;
  document.getElementById("label-address").innerText = lang[l].address;
  document.getElementById("label-pin_point").innerText = lang[l].pin_point;
 

  // Featured image
  document.getElementById("featured-note").innerText = lang[l].featuredNote;
  document.getElementById("btn-choose").innerText = lang[l].choose;

  // Action button
  document.getElementById("btn-save").innerText = lang[l].save;
  document.getElementById("btn-reset").innerText = lang[l].reset;
  document.getElementById("btn-loading").innerText = lang[l].loading;

  // Aktifkan tombol bahasa
  document.getElementById("btn-en").classList.remove("active");
  document.getElementById("btn-id").classList.remove("active");
  document.getElementById("btn-" + l).classList.add("active");
}

// default bahasa Indonesia
setLang("en");
</script>

<style>
/* Biar tombol bahasa aktif kelihatan */
#btn-en.active, #btn-id.active {
  font-weight: bold;
  border-width: 2px;
}
</style>
