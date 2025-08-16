<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediksi Saham</title>
    <link rel="stylesheet" href="/css/commonStyle.css">
    <link rel="stylesheet" href="/css/styles.css">

    <script src="https://kit.fontawesome.com/aa7454d09f.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

    <!-- Header -->
    <header>
        <div id="logo">
            <a href="/">
                <img src="/img/logo-white.png" alt="">
            </a>
        </div>
        <ul class="nav" id="nav">
            <ul class="navLogo">
                <a href="./index.html">
                    <img src="/img/logo-white.png" alt="">
                </a>
            </ul>

            <li class="nav-link"><a href="/">Home</a></li>
            <li class="nav-link"><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Rekomendasi</a></li>
            <li class="nav-link"><a href="#login">Login</a></li>
            <li class="sociallinkContainer">
                <img class="sociallink" src="/img/fabook-icon-white.svg" alt="">
                <img class="sociallink" src="/img/twitter-icon-white.svg" alt="">
                <img class="sociallink" src="/img/inkedin-icon-white.svg" alt="">
                <img class="sociallink" src="/img/whatsapp-icon-white.svg" alt="">
            </li>
        </ul>
        <div id="barContainer">
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </header>

    <!-- Hero page -->
    <section class="hero gridSection">
        <div class="sectionDesc">
            <h1 class="headline">
                Temukan <span class="cryptoText">Rekomendasi Saham</span> Terbaik Untuk Investasi Anda.
            </h1>
            <p class="sub-headline">
                Sistem kami menganalisis data fundamental saham (PER, ROE, Volume, Market Cap)
                menggunakan metode fuzzy logic untuk memberikan rekomendasi saham yang lebih akurat
                dan terpercaya bagi investor.
            </p>

            <!-- Tombol -->
            <div class="btnContainer">
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btns btn1">
                    Lihat Rekomendasi
                </button>
                <button class="btns btn2">Pelajari Lebih Lanjut <i class="fa-solid fa-play"></i></button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content shadow-lg">
                        <div class="modal-header bg-primary text-white">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                <i class="bi bi-bar-chart-line"></i> Lihat Rekomendasi Saham
                            </h1>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-4">
                                <label for="sahamSelect" class="form-label fw-bold">Pilih Saham</label>
                                <select id="sahamSelect" class="form-select">
                                    <option value="">-- Pilih Saham --</option>
                                    @foreach ($saham as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama_saham }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <!-- Informasi Fundamental -->
                                <div class="col-md-6 mb-3">
                                    <div class="card border-info shadow-sm">
                                        <div class="card-header bg-info text-white fw-bold">
                                            <i class="bi bi-graph-up"></i> Informasi Fundamental Saham
                                        </div>
                                        <ul class="list-group list-group-flush" id="fundamentalList">
                                            <li class="list-group-item text-center text-muted">
                                                Silakan pilih saham terlebih dahulu...
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Rekomendasi -->
                                <div class="col-md-6 mb-3">
                                    <div class="card border-success shadow-sm">
                                        <div class="card-header bg-success text-white fw-bold">
                                            <i class="bi bi-lightbulb"></i> Rekomendasi Saham
                                        </div>
                                        <ul class="list-group list-group-flush" id="rekomendasiList">
                                            <li class="list-group-item text-center text-muted">
                                                Silakan pilih saham terlebih dahulu...
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <div class="sectionPic bouncepic" id="sectionPic">
            <img src="/img/hero-image.png" alt="">
        </div>
    </section>

    <!-- Carousel -->
    <section>
        <div class="carouselContainer">

            @foreach ($saham->take(45) as $index => $item)
                <div class="eachCarousel {{ $index == 0 ? 'eachCarouselBorder' : '' }}">
                    <!-- Gambar statis sesuai urutan -->
                    @if ($index % 3 == 0)
                        <img src="/img/bitcoin-icon.png" alt="">
                    @elseif($index % 3 == 1)
                        <img src="/img/ethereum-icon.png" alt="">
                    @else
                        <img src="/img/tether-icon.png" alt="">
                    @endif

                    <article class="carouselDesc">
                        <h1 class="carouselTitle">{{ $item->kode_saham }}</h1>
                        <p class="carouselPara">{{ $item->nama_saham }}</p>
                        <div class="carouselPrice">
                            <h3>PER: {{ $item->per }}</h3>
                            <span class="rect"></span>
                            <h3 class="carouselDiscount">ROE: {{ $item->roe }}%</h3>
                        </div>
                        <button class="btns carouselBtn lihatDetailBtn" data-id="{{ $item->id }}"
                            data-bs-toggle="modal" data-bs-target="#detailModal">
                            Lihat Detail
                        </button>
                    </article>
                </div>
            @endforeach

        </div>

        <!-- indikator carousel -->
        <div class="carouselIndicator">
            @foreach ($saham->take(45) as $index => $item)
                <div class="indicator {{ $index == 0 ? 'activeIndicator' : '' }}"
                    onclick="slideCarousel({{ $index }})"></div>
            @endforeach
        </div>
    </section>

    <!-- Modal Detail Saham -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="detailModalLabel">Detail Saham</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Fundamental -->
                        <div class="col-md-6">
                            <h6><i class="bi bi-bar-chart-fill text-primary"></i> Informasi Fundamental</h6>
                            <ul class="list-group" id="modalFundamental">
                                <li class="list-group-item text-center text-muted">Memuat data...</li>
                            </ul>
                        </div>

                        <!-- Rekomendasi -->
                        <div class="col-md-6">
                            <h6><i class="bi bi-lightbulb-fill text-warning"></i> Rekomendasi Saham</h6>
                            <ul class="list-group" id="modalRekomendasi">
                                <li class="list-group-item text-center text-muted">Memuat data...</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Processes -->
    <section class="gridSection">
        <div class="sectionDesc processessDesc">
            <h1 class="sectionHeader">Proses Analisis Saham</h1>
            <p class="sectionPara">
                Sistem ini membantu menganalisis data fundamental saham untuk memberikan
                rekomendasi terbaik. Semua proses dilakukan otomatis tanpa biaya tambahan.
            </p>

            <div class="eachProcesses">
                <img src="/img/handshake-icon-white-line.svg" alt="handshake">
                <div class="eachprocessesPara">
                    <h1 class="processTitle">Fuzzifikasi</h1>
                    <p>
                        Data saham seperti PER, ROE, Volume, dan Market Cap diubah ke dalam
                        bentuk himpunan fuzzy agar dapat dihitung tingkat kelayakannya.
                    </p>
                </div>
            </div>

            <div class="eachProcesses">
                <img src="/img/cart-icon-white-line.svg" alt="cart">
                <div class="eachprocessesPara">
                    <h1 class="processTitle">Rekomendasi</h1>
                    <p>
                        Hasil analisis ditampilkan sebagai rekomendasi saham dengan kategori
                        Tidak Layak, Layak, atau Sangat Layak sehingga memudahkan pengambilan
                        keputusan investasi.
                    </p>
                </div>
            </div>
        </div>

        <div class="sectionPic bouncepic processesPic" id="sectionPic">
            <img src="/img/chain-process-img.png" alt="">
        </div>
    </section>

    <!-- Markets -->
    <section class="gridSection">
        <div class="sectionDesc marketDesc">
            <h1 class="sectionHeader">Pantau Saham Lebih Mudah</h1>
            <p class="sectionPara">
                Dari analisis data fundamental hingga rekomendasi investasi, semua proses dilakukan
                secara otomatis untuk membantu investor mengambil keputusan dengan cepat dan tepat.
            </p>

            <div class="eachMarket">
                <img src="/img/buy-icon-color.svg" alt="analisis">
                <div>
                    <h1 class="marketTitle">Data Saham Lengkap</h1>
                    <p class="darkPara">
                        Informasi kode, nama saham, PER, ROE, volume, dan market cap disajikan secara detail
                        untuk memudahkan proses evaluasi.
                    </p>
                </div>
            </div>

            <div class="eachMarket">
                <img src="/img/trading-icon-color.svg" alt="fuzzy">
                <div>
                    <h1 class="marketTitle">Proses Fuzzy</h1>
                    <p class="darkPara">
                        Sistem menggunakan logika fuzzy untuk mengubah data mentah menjadi informasi yang terukur
                        sesuai kategori kinerja saham.
                    </p>
                </div>
            </div>

            <div class="eachMarket">
                <img src="/img/support-icon-color.svg" alt="rekomendasi">
                <div>
                    <h1 class="marketTitle">Hasil Rekomendasi</h1>
                    <p class="darkPara">
                        Setiap saham diberi label rekomendasi seperti <b>Tidak Layak</b>, <b>Layak</b>,
                        atau <b>Sangat Layak</b> berdasarkan hasil analisis.
                    </p>
                </div>
            </div>

            <div class="eachMarket">
                <img src="/img/online-icon-color.svg" alt="akses">
                <div>
                    <h1 class="marketTitle">Dashboard Publik</h1>
                    <p class="darkPara">
                        Investor dapat mengakses informasi saham dan hasil rekomendasi kapan saja
                        melalui halaman dashboard online.
                    </p>
                </div>
            </div>
        </div>

        <div class="sectionPic marketspicSection" id="sectionPic">
            <h1 class="marketspicHeader">ANALISIS SAHAM</h1>
            <div class="marketsPicContainer">
                <div class="marketPic marketPic1">
                    <img src="/img/persent-icon-white.svg" alt="">
                    <article class="marketTitle">Data</article>
                </div>

                <div class="marketPic marketPic2">
                    <img src="/img/bitcoin-icon-white.svg" alt="">
                    <article class="marketTitle">Fuzzy</article>
                </div>

                <div class="marketPic marketPic3">
                    <img src="/img/ethereum-white-icon.svg" alt="">
                    <article class="marketTitle">Rekomendasi</article>
                </div>

                <div class="marketPic marketPic4">
                    <img src="/img/handshake-icon-white.svg" alt="">
                    <article class="marketTitle">Aksi</article>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard -->
    <section class="gridSection">
        <div class="sectionDesc dashboardDesc">
            <h1 class="sectionHeader">Pantau Saham dalam Sekejap</h1>
            <p class="sectionPara">
                Dengan sistem ini, Anda dapat melihat performa saham, analisis fundamental,
                hingga hasil rekomendasi investasi secara langsung tanpa ribet.
            </p>
            <button class="btns">Lihat Rekomendasi</button>
        </div>

        <div class="sectionPic dashboardPic">
            <img src="/img/dashboard-dark.jpg" alt="dashboard saham">
        </div>
    </section>

    <div class="fundSection">
        <div class="sectionDesc">
            <h1 class="sectionHeader">Kelola Investasi Anda</h1>
            <p class="sectionPara">
                Semua data saham diproses otomatis melalui sistem analisis dan fuzzy,
                memberikan rekomendasi yang akurat untuk mendukung keputusan investasi.
            </p>
            <div class="fundsContainer">
                <div class="fund">
                    <img src="/img/cryptocurrency-white-icon.svg" alt="data">
                    <h1 class="fundType">Data Fundamental</h1>
                    <p class="darkPara">
                        Menampilkan PER, ROE, Volume, dan Market Cap dari setiap saham.
                    </p>
                </div>

                <div class="fund">
                    <img src="/img/blockchain-white-icon.svg" alt="fuzzy">
                    <h1 class="fundType">Proses Fuzzy</h1>
                    <p class="darkPara">
                        Data diolah dengan logika fuzzy untuk menghasilkan analisis yang lebih objektif.
                    </p>
                </div>

                <div class="fund">
                    <img src="/img/cryptocurrency-sell-white-icon.svg" alt="rekomendasi">
                    <h1 class="fundType">Hasil Rekomendasi</h1>
                    <p class="darkPara">
                        Setiap saham diberi rekomendasi: Tidak Layak, Layak, atau Sangat Layak.
                    </p>
                </div>

                <div class="fund">
                    <img src="/img/cryptocurrency-card-white-icon.svg" alt="akses">
                    <h1 class="fundType">Akses Mudah</h1>
                    <p class="darkPara">
                        Semua informasi dapat diakses secara online kapan saja dan di mana saja.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact form -->
    <section id="login" class="gridSection contactSection">
        <div class="contactformContainer">
            <h1 class="sectionHeader">Login</h1>
            <form method="POST" action="/" class="contactForm">
                @csrf
                <div>
                    @if ($errors->has('login'))
                        <div class="alert alert-danger">{{ $errors->first('login') }}</div>
                    @endif
                    <input type="text" name="username" id="username" placeholder="username"
                        class="contactInput" required>
                    <input type="password" name="password" id="password" placeholder="password"
                        class="contactInput" required>
                </div>
                <button type="submit" class="btns primaryBtn contactBtn">Login</button>
            </form>
        </div>
        <div class="sectionPic bouncepic contactPic" id="sectionPic">
            <img src="/img/newsletter.png" alt="">
        </div>
    </section>

    <footer>
        <div class="joinSection">
            <div class="joinDesc">
                <h1 class="sectionHeader">Bergabung Bersama Kami</h1>
                <p class="sectionPara">
                    Dapatkan analisis fundamental, fuzzifikasi, dan rekomendasi saham
                    untuk membantu Anda membuat keputusan investasi yang lebih cerdas.
                </p>
            </div>
            <button class="btns primaryBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">Lihat Rekomendasi</button>
        </div>

        <div class="footerlinksContainer">
            <div class="footerAboutus">
                <img src="/img/logo-white.png" alt="Logo Saham">
                <p class="darkPara">
                    Sistem Rekomendasi Saham berbasis analisis fundamental dan fuzzy logic.
                    Memberikan hasil rekomendasi Layak atau Tidak Layak secara objektif,
                    mudah diakses kapan saja, di mana saja.
                </p>
                <div class="footersociallinkContainer">
                    <img class="sociallink" src="/img/fabook-icon-white.svg" alt="facebook">
                    <img class="sociallink" src="/img/twitter-icon-white.svg" alt="twitter">
                    <img class="sociallink" src="/img/inkedin-icon-white.svg" alt="linkedin">
                    <img class="sociallink" src="/img/whatsapp-icon-white.svg" alt="whatsapp">
                </div>
            </div>

            <div class="footerlink">
                <h1 class="linkTitle">Jelajahi</h1>
                <a href="#" class="eachLink">Tentang Kami</a>
                <a href="#" class="eachLink">FAQ</a>
                <a href="#" class="eachLink">Artikel</a>
                <a href="#" class="eachLink">Kontak</a>
            </div>

            <div class="footerlink">
                <h1 class="linkTitle">Layanan</h1>
                <a href="#" class="eachLink">Analisis Saham</a>
                <a href="#" class="eachLink">Fuzzifikasi Data</a>
                <a href="#" class="eachLink">Rekomendasi Investasi</a>
                <a href="#" class="eachLink">Laporan PDF</a>
            </div>

            <div class="footerlink">
                <h1 class="linkTitle">Sumber Daya</h1>
                <a href="#" class="eachLink">Panduan</a>
                <a href="#" class="eachLink">Update Sistem</a>
                <a href="#" class="eachLink">Lisensi</a>
            </div>
        </div>

        <div class="footerCopyright">
            <p>&copy; 2025 Sistem Rekomendasi Saham | Developed by
                <a href="https://avinto.my.id" target="_blank" class="developedBy">Ariel Dandi</a>.
            </p>
        </div>
    </footer>


    <script src="/script/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    <!-- Script AJAX -->
    <script>
        document.getElementById('sahamSelect').addEventListener('change', function() {
            let sahamId = this.value;
            if (sahamId) {
                fetch(`/api/saham/${sahamId}`)
                    .then(response => response.json())
                    .then(data => {
                        // === Update Fundamental ===
                        let fundamentalList = document.getElementById('fundamentalList');
                        fundamentalList.innerHTML = `
                    <li class="list-group-item"><i class="bi bi-upc-scan text-primary"></i> <strong>Kode Saham:</strong> ${data.saham.kode_saham}</li>
                    <li class="list-group-item"><i class="bi bi-building text-primary"></i> <strong>Nama Saham:</strong> ${data.saham.nama_saham}</li>
                    <li class="list-group-item"><i class="bi bi-percent text-primary"></i> <strong>PER:</strong> ${data.saham.per}</li>
                    <li class="list-group-item"><i class="bi bi-graph-up text-primary"></i> <strong>ROE:</strong> ${data.saham.roe}</li>
                    <li class="list-group-item"><i class="bi bi-bar-chart text-primary"></i> <strong>Volume:</strong> ${Number(data.saham.volume).toLocaleString()}</li>
                    <li class="list-group-item"><i class="bi bi-cash-coin text-primary"></i> <strong>Market Cap:</strong> ${Number(data.saham.market_cap).toLocaleString()}</li>
                `;

                        // === Update Rekomendasi ===
                        let rekomendasiList = document.getElementById('rekomendasiList');
                        if (data.rekomendasi.length > 0) {
                            rekomendasiList.innerHTML = data.rekomendasi.map((r, i) => `
                        <li class="list-group-item">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <strong>${i+1}. ${r.saham.kode_saham} - ${r.saham.nama_saham}</strong><br>
                            <span class="badge bg-${r.kategori === 'Sangat Layak' ? 'success' : (r.kategori === 'Layak' ? 'primary' : 'secondary')}">
                                ${r.kategori}
                            </span>
                            <span class="ms-2 text-muted">${r.persentase}%</span>
                        </li>
                    `).join('');
                        } else {
                            rekomendasiList.innerHTML =
                                `<li class="list-group-item text-center text-muted">Tidak ada rekomendasi untuk saham ini.</li>`;
                        }
                    })
                    .catch(error => console.error(error));
            }
        });
    </script>
    <script>
        document.querySelectorAll('.lihatDetailBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                let sahamId = this.getAttribute('data-id');

                // tampilkan loading sementara
                document.getElementById('modalFundamental').innerHTML =
                    `<li class="list-group-item text-center text-muted">Memuat data...</li>`;
                document.getElementById('modalRekomendasi').innerHTML =
                    `<li class="list-group-item text-center text-muted">Memuat data...</li>`;

                fetch(`/api/saham/${sahamId}`)
                    .then(res => res.json())
                    .then(data => {
                        // isi fundamental
                        document.getElementById('modalFundamental').innerHTML = `
                    <li class="list-group-item"><i class="bi bi-upc-scan text-primary"></i> <strong>Kode Saham:</strong> ${data.saham.kode_saham}</li>
                    <li class="list-group-item"><i class="bi bi-building text-primary"></i> <strong>Nama Saham:</strong> ${data.saham.nama_saham}</li>
                    <li class="list-group-item"><i class="bi bi-percent text-primary"></i> <strong>PER:</strong> ${data.saham.per}</li>
                    <li class="list-group-item"><i class="bi bi-graph-up text-primary"></i> <strong>ROE:</strong> ${data.saham.roe}</li>
                    <li class="list-group-item"><i class="bi bi-bar-chart text-primary"></i> <strong>Volume:</strong> ${Number(data.saham.volume).toLocaleString()}</li>
                    <li class="list-group-item"><i class="bi bi-cash-coin text-primary"></i> <strong>Market Cap:</strong> ${Number(data.saham.market_cap).toLocaleString()}</li>
                `;

                        // isi rekomendasi
                        if (data.rekomendasi.length > 0) {
                            document.getElementById('modalRekomendasi').innerHTML = data.rekomendasi
                                .map((r, i) => `
                        <li class="list-group-item">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <strong>${i+1}. ${r.saham.kode_saham} - ${r.saham.nama_saham}</strong><br>
                            <span class="badge bg-${r.kategori === 'Sangat Layak' ? 'success' : (r.kategori === 'Layak' ? 'primary' : 'secondary')}">
                                ${r.kategori}
                            </span>
                            <span class="ms-2 text-muted">${r.persentase}%</span>
                        </li>
                    `).join('');
                        } else {
                            document.getElementById('modalRekomendasi').innerHTML =
                                `<li class="list-group-item text-center text-muted">Tidak ada rekomendasi.</li>`;
                        }
                    })
                    .catch(err => console.error(err));
            });
        });
    </script>

</html>
