<div class="modal fade" id="modalPinPointLoaction" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
        
      {{-- Header --}}
      <div class="modal-header">
        <h5 class="modal-title">Location Pinpoint <strong>{{ $roleName ?? '' }}</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      {{-- Body --}}
      <div class="modal-body">
        {{-- Map --}}
        <div id="map" style="height: 350px; width: 100%;"></div> 
          <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" readonly>
                </div>
            </div>

        <div class="mt-3 p-2 bg-light border rounded">
          <strong>Nama lokasi tidak sesuai alamatmu?</strong><br>
          Tenang, kamu akan isi alamat nanti. Pastikan pinpoint sudah sesuai dulu.
        </div>
      </div> 
      {{-- Footer --}}
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="resetPin">Reset</button>
        <button type="button" class="btn btn-primary" id="savePin">Simpan</button>
      </div>

    </div>
  </div>
</div>

{{-- Hidden input di form utama --}}

@push('js')
<script>
    let map, marker, geocoder;

    function initMap() {
        // Default lokasi Jakarta
        const defaultLocation = { lat: -6.200000, lng: 106.816666 };

        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 13,
        });

        geocoder = new google.maps.Geocoder();
        marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true
        });

        marker.addListener("dragend", function (event) {
            updateLocation(event.latLng);
        }); 
        map.addListener("click", function (event) {
            marker.setPosition(event.latLng);
            updateLocation(event.latLng);
        });
 
        document.getElementById("savePin").addEventListener("click", function () {
    const lat = document.getElementById("latitude").value;
    const lng = document.getElementById("longitude").value;
     if (lat && lng) {
        document.getElementById("lat").value = lat;
        document.getElementById("lng").value = lng;
        document.getElementById("pinPoint").value = JSON.stringify({
        latitude: lat,
        longitude: lng
    });
     

        const modalEl = document.getElementById("modalPinPointLoaction"); 
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) {
            modalInstance.hide();
        } 
    } else {
        alert("Silakan pilih titik lokasi di map terlebih dahulu!");
    }
});

    }

    function updateLocation(latLng) {
         const lat = latLng.lat ? latLng.lat() : latLng.lat;
    const lng = latLng.lng ? latLng.lng() : latLng.lng;

     document.getElementById("latitude").value = lat;
    document.getElementById("longitude").value = lng;
  
    }
</script>
 

<script async defer 
  src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap">
</script>
@endpush
