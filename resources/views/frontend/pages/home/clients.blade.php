 @php
$customer = [
    ["name" => "Bank CBN","img" => "1.png"],
    ["name" => "Tree House","img" => "2.png"],
    ["name" => "CS Finansial","img" => "3.png"],
    ["name" => "CS 4","img" => "4.png"],
    ["name" => "CS 5","img" => "5.png"],
    ["name" => "Tree House","img" => "2.png"],
    ["name" => "CS 7","img" => "7.png"],
    ["name" => "Tree House","img" => "2.png"],
    ["name" => "Bank CBN","img" => "1.png"],
    ["name" => "CS Finansial","img" => "3.png"],
    ["name" => "CS 4","img" => "4.png"],
];
@endphp

<section id="customer" class="customer">
  <div class="container text-center">

    <!-- Title & Desc -->
    <span class="title">
      Siapa <span class="highlight">Pelanggan Kami</span>
    </span>
    <p class="desc">
      Loyalitas pelanggan kami merupakan bukti komitmen teguh kami untuk 
      menyediakan produk dan layanan yang luar biasa, membangun hubungan yang kuat, 
      dan secara konsisten melampaui harapan pelanggan kami.
    </p>

    <!-- Logo slider -->
    <div class="customer-logos" id="customer-logos">
      <div class="customer-logos-inner">
        @foreach ($customer as $c)
          <div class="logo-item">
            <img src="{{ asset('assets/img/villa/customer/' . $c['img']) }}" alt="{{ $c['name'] }}">
          </div>
        @endforeach
      </div>
    </div>
    <div class="customer-dots" id="customer-dots"></div>
  </div>
</section>