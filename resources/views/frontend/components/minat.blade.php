@php
      $set = AppSetting::first();
@endphp
<section id="minat" class="minat">
  <div class="container">
    <div class="content-text">
      <h4 class=" minatTitle">
        Apakah <span class="minatHighlight">Anda Berminat</span>?
      </h4>
      <p class="">
        Kami menghadirkan fasilitas lengkap dengan kenyamanan layaknya rumah sendiri, 
        dilengkapi udara segar pegunungan dan suasana nyaman setiap momen menjadi berkesan.
      </p>
    </div>
    <div class="content-btn">
      <a class="btn btn-brown btn-lg"
        href="https://wa.me/{{$set->whatsapp}}?text={{ urlencode('Halo Pelanggan setia The Gallery Villa, Saya ingin reservasi (Booking) kamar The Gallery Villa. Bisakah Saya mendapatkan informasi harga Villa Aurora atau Villa Esperanza?') }}"
        target="_blank">
        Berminat
      </a>
    </div>
  </div>
</section>