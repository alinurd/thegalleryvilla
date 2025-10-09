@php
    use App\Models\Master\PageDetail;
    use App\Models\AppSetting;

    $set = AppSetting::first();
    $p = PageDetail::where('status', 1)->get();
@endphp

<section id="contact" class="contact root">
    <div class="container">
        <div class="text-center">
            <span class="section-title text-center mb-1 title">
                Hubungi <span class="highlight">Kami</span>
            </span>
            <p class="mb-4" style="max-width: 700px; margin: 0 auto;">
                Jika anda memiliki pertanyaan, permintaan, atau ingin mempelajari lebih lanjut tentang layanan kami,
                jangan ragu untuk menghubungi kami melalui saluran yang disediakan,
                dan tim kami yang berdedikasi akan dengan senang hati membantu anda.
            </p>
        </div>

        <div class="row g-4">
            <!-- Info -->
            <div class="col-md-6 col-12 info">
                <div class="card">
                    <div class="card-body">
                        <div class="info-item">
                            <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                            <div class="info-content">
                                <h4>Lokasi</h4>
                                <p><strong>{{ $p[0]->title }}</strong><br>
                                    {{ $p[0]->address }}<br>
                                    <a href="{{ $p[0]->pin_point }}" target="_blank">Lihat peta</a>
                                </p>
                                <br>
                                <p><strong>{{ $p[1]->title }}</strong><br>
                                    {{ $p[1]->address }}<br>
                                    <a href="{{ $p[1]->pin_point }}" target="_blank">Lihat peta</a>
                                </p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="icon"><i class="fas fa-envelope"></i></span>
                            <div class="info-content">
                                <h4>Website/eMail</h4>
                                <p>{{ $set->website ?? 'www.thegalleryvilla.id' }}<br>{{ $set->email ?? 'info@thegalleryvilla.id ' }}</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="icon"><i class="fab fa-whatsapp"></i></span>
                            <div class="info-content">
                                <h4>Whatsapp</h4>
                                <p>{{ $set->whatsapp }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="col-md-6 col-12 form">
                <div class="card">
                    <div class="card-body">
                        <form class="form" id="formData">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                </div>
                                <div class="col">
                                    <input type="email" name="email" class="form-control" placeholder="Your e-mail" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                            </div>

                            <div class="mb-3">
                                <textarea name="message" class="form-control" rows="5" placeholder="Messages" required></textarea>
                            </div>

                            <button type="button" id="submit" class="btn  w-100">
                                <span id="simpan">
                                    <i data-feather="send" class="me-1"></i> Kirim Pesan
                                </span>
                                <span id="loading" class="d-none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Mengirim...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 