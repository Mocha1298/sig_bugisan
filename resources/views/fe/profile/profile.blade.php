@extends('fe.layout.main')

@section('title','Profile')

@section('home','')
@section('peta','')
@section('profile','active')
@section('kontak','')
@section('data','')

@section('content')

<div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background-image: url('/images/hero_2.jpg')">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-5 mt-5 pt-5">
                    <h1 class="mb-3">Profile</h1>
                    <p>Halaman ini berisi profile dari instansi yaitu visi dan misi.</p>
                </div>
              </div>
        </div>
    </div>
</div>{{-- Jumbotron --}}

<div class="site-section bg-light" id="contact-section" style="padding-top: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mb-4"><strong>Visi dan Misi</strong></h1>
                <div class="bg-white pb-4">
                    <br><br>
                    <h2 class="h5 mb-4">Visi</h2>
                    <p>Terwujudnya masyarakat Desa bugisan yang Mandiri, Disiplin, Jujur, Adil, Merakyat, Nasionalis, dan Sejahtera</p>
                    <h2 class="h5 mb-4">Misi</h2>
                    <p>Misi Pemerintahan Desa Bugisan diantaranya adalah:</p>
                    <p>&nbsp;1.	Mewujudkan Pemerintahan yang bersih dan Profesional serta sikap responsif aparatur sebagai pelayan masyarakat.</p>
                    <p>&nbsp;2.	Mewujudkan masyarakat beraklak mulia, bermooral, beretika, berbudaya dan beradab berdasarkan falsafah Pancasila.</p>
                    <p>&nbsp;3.	Pengembangan sumber daya manusia berbasis kompetensi secara berkelanjutan.</p>
                    <p>&nbsp;4.	Pengembangan ekonomi kerakyatan berbasis pertanian,seni budaya dan kerajinan rakyat sesuai dengan kondisi sosial budaya yang berbasis kearifan Iokal.</p>
                    <p>&nbsp;5.	Mewujudkan pemerataan pembangunan Desa yang berkeadilan.</p>
                    <p>&nbsp;6.	Meningkatkan pbrwujudan pembangunan flsik dan infrastruktur.</p>
                    <p>&nbsp;7.	Meningkatkan taraf kehidupan masyarakat melalui peningkatan kesehatan,pendidikan dan perekonomian yang merata.</p>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
</div>

@endsection