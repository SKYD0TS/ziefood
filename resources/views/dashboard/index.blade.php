@extends('templates.layout')

@push('css')
@endpush
<!-- page content -->
@section('content')
    <div class="row" style="display: flex; width: 100%;">
        <!-- Jumlah Menu -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Menu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_menu }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-cutlery fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_transaksi }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-money fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Jumlah Transaksi Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_transaksi_today }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Pendapatan hari ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ $pendapatan_today }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-dollar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                    <div class="x_title">
                        <h2>Grafik Penjualan dan Pendapatan</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="#" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-toggle="modal" data-target="#filter"><i class="fa fa-calendar fa-sm text-white-50"></i>
        @if(is_array($date))
        {{ \Carbon\Carbon::parse($date['tanggal_awal'])->format('d M Y') }} - {{ \Carbon\Carbon::parse($date['tanggal_akhir'])->format('d M Y') }}
        @else
        {{ $date->format('d M Y') }}
        @endif
    </a></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div>


                        <div class="x_content">
                            <div style="display:flex; flex-direction:column">
                                <div id="chart" style="height: 500px; width: auto;"></div>
<hr>
                                {{--    --}}
                                <div style="display:flex; justify-content:space-around;">
                                <div style="width: 320px;">
                                    <div class="x_title">
                                        <h2>10 Pelanggan Pertama</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div>
                                        @foreach ($pelanggan as $p)
                                            <div class="card p-3">
                                                <h6><i class="fa fa-user"></i>
                                                    <strong>{{ $p->nama }}</strong>
                                                </h6>
                                                <p>{{ $p->no_telp }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{--    --}}
                                <div style="width: 320px;">
                                    <div class="x_title">
                                        <h2>Stok tersisa</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div>
                                        @foreach ($lows_stok as $s)
                                            <div class="card p-3">
                                                    <strong>{{ $s->nama_menu }}</strong><br>
                                                    <img class="img-fluid" style="max-width: 100px;" src="{{ asset('storage/menu-image/' .$s->image)}}" alt="Tidak ada gambar">
                                                </h6>
                                                <p>{{ $s->jumlah }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{--    --}}
                                <div style="width: 320px;">
                                    <div class="x_title">
                                        <h2>Menu Best Seller</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div>
                                    @foreach ($menu_teratas as $item)
                                            <div class="card p-3">
                                                    <strong>{{ $item->menu->nama_menu }}</strong><br>
                                                    <img class="img-fluid" style="max-width: 100px;" src="{{ asset('storage/menu-image/' .$item->menu->image)}}" alt="Tidak ada gambar">
                                                </h6>
                                                <p>Terjual{{ $item->menu->stok->jumlah }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.modal')
        <!-- /page content -->
    @endsection

    @push('script')
        <script>
            window.onload = function() {
                var dataPenjualan = [];
                var dataJmlTransaksi = [];

                var chart;

                $.get("{{ url('data_penjualan') }}/0", function(data) {
                    console.log(data)
                    $.each(data, function(key, value) {
                        let dat = value['tanggal'];
                        let year = dat.substring(0, 4);
                        let month = dat.substring(5, 7) - 1;
                        let day = dat.substring(8, 10);
                        // console.log(year+"-"+month+"-"+day);
                        dataPenjualan.push({
                            x: new Date(year, month, day),
                            y: parseInt(value['total_bayar'])
                        });

                        dataJmlTransaksi.push({
                            x: new Date(year, month, day),
                            y: parseInt(value['jumlah'])
                        });
                    });

                    chart = new CanvasJS.Chart("chart", {
                        title: {
                            text: "Grafik Pendapatan"
                        },
                        axisY: {
                            title: "Penjualan",
                            lineColor: "#C24642",
                            tickColor: "#C24642",
                            labelFontColor: "#C24642",
                            titleFontColor: "#C24642",
                            includeZero: true,
                            suffix: ""
                        },
                        axisY2: {
                            title: "Pendapatan",
                            lineColor: "#7F6084",
                            tickColor: "#7F6084",
                            labelFontColor: "#7F6084",
                            titleFontColor: "#7F6084",
                            includeZero: true,
                            prefix: "",
                            suffix: ""
                        },
                        toolTip: {
                            shared: true
                        },
                        legend: {
                            cursor: "pointer",
                            itemclick: toggleDataSeries
                        },
                        data: [{
                                type: "line",
                                name: "Penjualan",
                                color: "#C24642",
                                axisYIndex: 0,
                                showInLegend: true,
                                dataPoints: dataJmlTransaksi
                            },
                            {
                                type: "line",
                                name: "Pendapatan",
                                color: "#7F6084",
                                axisYType: "secondary",
                                showInLegend: true,
                                dataPoints: dataPenjualan
                            }
                        ]
                    });
                    chart.render();
                    updateChart();
                });


                function updateChart() {
                    $.get("{{ url('data_penjualan') }}/" + dataJmlTransaksi.length, function(data) {
                        console.log(data)
                        $.each(data, function(key, value) {
                            let date = value['tanggal'];
                            let year = date.substring(0, 4);
                            let month = date.substring(5, 7) - 1;
                            let day = date.substring(8, 10);
                            console.log(year + "-" + month + "-" + day);
                            dataPenjualan.push({
                                x: new Date(year, month, day),
                                y: parseInt(value['total_bayar'])
                            });

                            if (dataPenjualan.length == 1)
                                dataJmlTransaksi.pop({
                                    x: new Date(year, month, day),
                                    y: parseInt(value['jumlah'])
                                });
                            else
                                dataJmlTransaksi.push({
                                    x: new Date(year, month, day),
                                    y: parseInt(value['jumlah'])
                                });

                        });
                    });
                    chart.render();
                    setTimeout(function() {
                        updateChart()
                    }, 10000);
                }

                function toggleDataSeries(e) {
                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                        e.dataSeries.visible = false;
                    } else {
                        e.dataSeries.visible = true;
                    }
                    e.chart.render();
                }

            }
        </script>
    @endpush