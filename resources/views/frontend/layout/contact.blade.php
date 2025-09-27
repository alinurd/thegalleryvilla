<section id="contact" class="contact">
    <div class="container">
        <h2>Hubungi Kami</h2>
        <div class="row">
            <div class="col info">
                <p><strong>Lokasi:</strong><br>Villa Aurora - Jl. Kencana Loka, Gunung Putri, Bogor<br>
                   Villa Esperanza - Jl. Raya Parung KM 15, Bogor</p>
                <p><strong>Email:</strong> info@galleryvilla.com</p>
                <p><strong>WhatsApp:</strong> +62 812 3456 7890</p>
            </div>
            <div class="col form">
                <form action="{{ route('guest.contact.send') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Anda" required>
                    <input type="email" name="email" placeholder="Email Anda" required>
                    <input type="text" name="subject" placeholder="Subjek" required>
                    <textarea name="message" placeholder="Pesan Anda" required></textarea>
                    <button type="submit" class="btn">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</section>
