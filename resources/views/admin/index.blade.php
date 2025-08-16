@extends('layouts.main')
@section('content')
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>

            <img src="/images/profil.png" alt="">
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="text">Total Saham</span>
                        <span class="number">{{ $radarSaham->count() }}</span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Total Fuzzifikasi</span>
                        <span class="number">{{ $fuzzifikasi->count() }}</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-share"></i>
                        <span class="text">Total Hasil Rekomendasi</span>
                        <span class="number">{{ $kategoriDistribusi->sum() }}</span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Grafik Diagram</span>
                </div>

                <div class="row">
                    <!-- Pie Chart: Distribusi Kategori -->
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <span class="h5 d-block text-center mb-2">Distribusi Kategori Saham</span>
                        <div id="chartKategori"></div>
                    </div>

                    <!-- Bar Chart: Top 10 Saham -->
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <span class="h5 d-block text-center mb-2">Top 10 Saham</span>
                        <div id="chartTopSaham"></div>
                    </div>

                    <!-- Radar Chart -->
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <span class="h5 d-block text-center mb-2">Radar Fundamental Saham</span>
                        <div id="chartRadar"></div>
                    </div>

                    <!-- Stacked Bar Chart -->
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <span class="h5 d-block text-center mb-2">Fuzzifikasi Saham</span>
                        <div id="chartFuzzifikasi"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // ================
        // Pie Chart Distribusi Kategori
        // ================
        var optionsKategori = {
            chart: { type: 'pie' },
            series: @json(array_values($kategoriDistribusi->toArray())),
            labels: @json(array_keys($kategoriDistribusi->toArray()))
        };
        new ApexCharts(document.querySelector("#chartKategori"), optionsKategori).render();

        // ================
        // Bar Chart Top Saham
        // ================
        var optionsTopSaham = {
            chart: { type: 'bar', height: 350 },
            series: [{
                name: 'Persentase',
                data: @json($topSaham->pluck('persentase'))
            }],
            xaxis: {
                categories: @json($topSaham->pluck('saham.nama_saham'))
            }
        };
        new ApexCharts(document.querySelector("#chartTopSaham"), optionsTopSaham).render();

        // ================
        // Radar Chart (PER, ROE, Volume, Market Cap)
        // ================
        var optionsRadar = {
            chart: { type: 'radar', height: 350 },
            series: [
                @foreach($radarSaham as $s)
                {
                    name: "{{ $s->kode_saham }}",
                    data: [{{ $s->per }}, {{ $s->roe }}, {{ $s->volume }}, {{ $s->market_cap }}]
                },
                @endforeach
            ],
            labels: ['PER', 'ROE', 'Volume', 'Market Cap']
        };
        new ApexCharts(document.querySelector("#chartRadar"), optionsRadar).render();

        // ================
        // Stacked Bar Chart (Fuzzifikasi)
        // ================
        var optionsFuzzifikasi = {
            chart: { type: 'bar', stacked: true, height: 350 },
            series: [
                {
                    name: 'PER Rendah',
                    data: @json($fuzzifikasi->pluck('per_rendah'))
                },
                {
                    name: 'PER Sedang',
                    data: @json($fuzzifikasi->pluck('per_sedang'))
                },
                {
                    name: 'PER Tinggi',
                    data: @json($fuzzifikasi->pluck('per_tinggi'))
                }
            ],
            xaxis: {
                categories: @json($fuzzifikasi->pluck('saham.nama_saham'))
            }
        };
        new ApexCharts(document.querySelector("#chartFuzzifikasi"), optionsFuzzifikasi).render();
    </script>
@endsection
