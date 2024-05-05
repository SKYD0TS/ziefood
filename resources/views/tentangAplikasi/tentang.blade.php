@extends('templates.layout')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h1>Tentang Aplikasi</h1>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-6">
                        <img src="{{asset('assets')}}\images.jpg" alt="{{ asset('assets') }}." class="img-circle logo_img" style="display: block; margin: 0 auto">
                    </div>
                    <div class="col-sm-6">
                        <div class="card-box">
                            <h3>Selamat Datang di Aplikasi Kami</h3>
                            <p>Aplikasi ini dibuat untuk membantu Anda dalam ... (tambahkan deskripsi singkat tentang aplikasi Anda).</p>
                            <h4>Informasi Tambahan:</h4>
                            <ul>
                                <li>Informasi tentang layanan aplikasi</li>
                                <li>Sejarah pembuatan aplikasi</li>
                                <li>Informasi lainnya
                                    <ul>
                                        <li>Fitur-fitur</li>
                                        <li>Tim pengembang</li>
                                        <li>Hubungi Kami</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection