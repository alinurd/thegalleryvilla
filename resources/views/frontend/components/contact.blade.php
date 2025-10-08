@php
use App\Models\Master\PageDetail;
    $set = AppSetting::first();
    $p = PageDetail::where('status',1)->get();
  @endphp
<section id="contact" class="contact root">
    <div class="container">
        <div class="text-center">
            <span class="section-title text-center mb-1 title">
                Hubungi <span class="highlight">Kami</span>
            </span>
            <p class="mb-4" style="max-width: 700px; margin: 0 auto;">
                Jika anda memiliki pertanyaan, permintaan, atau ingin mempelajari
                lebih lanjut  tentang layanan kami, jangan ragu untuk menghubungi kami melalui saluran yang disediakan, dan tim kami yang berdedikasi akan dengan senang hati membantu anda.
            </p>
        </div>
        <div class="row">
            <!-- Info -->
            <div class="col info">
                <div class="card">
                    <div class="card-body">
                        <div class="info-item">
                            <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                            <div class="info-content">
                                <h4>Lokasi</h4>
                                <p><strong>{{$p[0]->title}}</strong><br>
                                    {{$p[0]->location}}
                                    <br>
                                    <a href="{{$p[0]->pin_point}}" target="_blank">Lihat peta</a>
                                </p>
                                <br>
                                <p><strong>{{$p[1]->title}}</strong><br>
                                    {{$p[1]->location}}
                                    <br>
                                    <a href="{{$p[1]->pin_point}}" target="_blank">Lihat peta</a>
                                </p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="icon"><i class="fas fa-envelope"></i></span>
                            <div class="info-content">
                                <h4>Website/eMail</h4>
                                <p>{{$set->website??'www.thegalleryvilla.'}}id<br>{{$set->email??'thegalleryvilla@gmail.com'}}</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="icon"><i class="fab fa-whatsapp"></i></span>
                            <div class="info-content">
                                <h4>Whatsapp</h4>
                                <p>{{$set->whatsapp}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->

            <div class="col form">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('guest.contact.send') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col"><input type="text" name="name" placeholder="Your Name"
                                        required></div>
                                <div class="col"><input type="email" name="email" placeholder="Your e-mail"
                                        required></div>
                            </div>
                            <input type="text" name="subject" placeholder="Subject" required>
                            <textarea name="message" placeholder="Messages" required></textarea>
                            <button type="submit" class="btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>