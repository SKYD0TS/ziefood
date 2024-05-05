@extends('templates.layout')

@push('style')
<style>
    .image-container {
        width: 600px; /* Sesuaikan lebar kotak */
        height: 500px; /* Sesuaikan tinggi kotak */
        overflow: hidden;
        border-radius: 10px; /* Atur sudut lengkungan kotak */
        margin: 0 auto; /* Memposisikan kotak di tengah */
    }

    .profile-img {
        width: 100%; /* Mengisi lebar kotak */
        height: auto; /* Tinggi otomatis sesuai proporsi asli gambar */
    }

    .section-title {
        margin-bottom: 30px;
    }

    .history {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .history h4 {
        margin-top: 0;
        color: #333333;
    }

    .history ul {
        list-style-type: none;
        padding: 0;
    }

    .history ul li {
        margin-bottom: 15px;
        line-height: 1.6;
        color: #666666;
    }

    .history ul li strong {
        font-weight: bold;
        color: #007bff;
    }

    .section-title h3 {
        margin-bottom: 20px;
        color: #333333;
        font-size: 26px;
        text-align: center;
    }

    .section-title p {
        margin-bottom: 30px;
        color: #666666;
        font-size: 16px;
        text-align: center;
    }

    .map-container {
        width: 600px; /* Sesuaikan lebar peta */
        height: 450px; /* Sesuaikan tinggi peta */
        margin: 0 auto; /* Memposisikan peta di tengah */
    }
</style>
@endpush

@section('content')
<section class="content"> 
    <div class="" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="dashboard_graph">
                    <h1>Contact Us</h1>
                    <div class="image-container">
                        <img src="{{ asset('assets')}}\download (1).jpg" alt="{{ asset('assets') }}" class="profile-img">
                    </div>

                    <ul>
                        <li><strong>Alamat:</strong> [Jl. nusa indah no 38]</li>
                        <li><strong>Nomor Telepon:</strong> [002837584]</li>
                        <li><strong>Email:</strong> [bunga49@gmail.com]</li>
                    </ul>

                    <!-- Peta Google Maps -->
                    <div class="section-title">
                        <h3>Lokasi Kami</h3>
                    </div>
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d[Latitude]!2d[Longitude]!3d[Zoom Level]!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDQ3JzQzLjYiTiAxMDLCsDU2JzM1LjkiRQ!5e0!3m2!1sen!2sus!4v1614111256621!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>


                    <!-- Form pertanyaan -->
                <form action="/submit_question" method="post">
                    @csrf
                    <label for="question">Pertanyaan:</label><br>
                    <textarea id="question" name="question" rows="4" cols="50"></textarea><br>
                    <input type="submit" value="Submit">
                </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
