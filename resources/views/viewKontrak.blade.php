@extends('layouts.layout')


<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TRAYEK</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}" >

    <!-- Bootstrap CSS CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	
     <!-- Our Custom CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
</head>


<!-- Breadcrumbs (ini buat navigation yaa) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="/proyek">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="/proyek/detailProyek/{{ $proyek->id }}">Detail Proyek {{ $proyek->projectName }}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="/proyek/{{ $proyek->id }}/lihatKontrak/">Overview Kontrak Kerja {{ $proyek->projectName }}</a></li>  
  </ol>
</nav>

@section('content')
@include('layouts.nav')


<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Overview Kontrak Kerja</p>
    <hr>
    <div class="row judul" style="margin-bottom:15px; margin-top:-10px;">
        <p class="col-sm-9 font-subtitle-2">Informasi Kontrak Kerja</p>
        <p class="col-sm-3 font-status-approval" style="margin-top:7px; margin-left:-40px;">{{ $statusHuruf }}</p>
    </div>
    <div class="container-fluid card card-kontrak">
        <div class="row judul">
            <div class="col-sm-9 font-subtitle-4">Informasi Umum</div>
            <a  class="btn btn-primary" style=" float: right;" >+ Tambah Informasi</a><br><br>
        </div>
    <hr>
    <div class="row" style="margin-left: -30px;">
        <div class="col-sm-7">
                <div class="col-sm-6 font-desc-bold">
                    <ul>
                        <li><p>Nama Proyek</p></li>
                        <li><p>Nama Perusahaan</p></li>
                        <li><p>Estimasi Waktu Pengerjaan</p></li>
                        <li><p>Alamat Proyek</p></li>
                        <li><p>Nama Pelaksana</p></li>
                        <li><p>Nilai Proyek</p></li>
                    </ul>
                </div>
                <div class="col-sm-6 font-desc">
                    <ul>
                        <li><p>:   {{ $proyek->projectName}}<p></li>
                        <li><p>:   {{ $proyek->companyName}}<p></li>
                        <li><p>:   {{ $proyek->estimatedTime}} hari<p></li>
                        <li><p>:   {{ $proyek->projectAddress}}<p></li>
                        <li><p>:   {{ $proyek->name}}<p></li>
                        <li><p>:   Rp{{ $proyek->projectValue }}
                    </ul>
                </div>
            </div>
        <div class="col-sm-5" style="margin-left:-50px;">
                <div class="col-sm-6 font-desc-bold">
                    <ul>
                        <li><p>Tanggal Kontrak</p></li>
                        <li><p>Nilai Proyek Huruf</p></li>
                        <li><p>Penanggung Jawab</p></li>
                    </ul>
                </div>
                <div class="col-sm-6 font-desc">
                    <ul>
                        <li><p>:   {{ $tanggals }}<p></li>
                        <li><p>:   nilaiproyek<p></li>
                        <li><p>:   {{ $proyek->name}}<p></li>
                    </ul>
                </div>
                </div>
        </div>
    </div>
    <br>
    <div class="container-fluid card card-kontrak">
        <div class="row judul">
            <div class="col-sm-9 font-subtitle-4" style="text-align: center">Berkas Surat Kontrak Kerja</div>
        </div>
        <hr>
        <table id="datatable" data-page-length='25' class="table table-striped table-bordered" >
            <thead>
            <tr style="text-align: center">
                <th>Nama Surat</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listKontrak as $kontrak)
            <tr>
                <td>{{$kontrak->title}}</td>
                <?php echo Storage::url($kontrak->path); ?>
                <td style="text-align: center">{{$kontrak->created_at}}</td>
                <td style="text-align: center">
                    <a href="{{ Storage::url($kontrak->path) }}" title="View file">
                    
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <a href="{{ route('download-surat-kontrak', $kontrak->id) }}" title="Download file {{$kontrak->title}}">
                        <i class="glyphicon glyphicon-download"></i>
                    </a>
                    <a href="{{ route('delete-surat-kontrak', $kontrak->id) }}" title="Delete file {{$kontrak->title}}">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </td>
            </tr>
            </tbody>
            @endforeach
        </table>
    </div>

    <div class="row" style="margin-top: 20px; margin-left: 350px;">
    <div class="col-sm-4"> </div>
    <div class="col-sm-2"> 
        <form action="/proyek/detailProyek/{{ $proyek->id }}" method="POST" id="reject">
            @csrf
            <button id="tolak" class="button-disapprove font-approval" data-toggle="modal" data-target="#myModd" style="height:35px; width:100px; margin-left:40px">Batal</button>
        </form> 
    </div>
    <div class="col-sm-2"> 
        <form action="#" method="POST" id="save">
            @csrf
            <button id="simpan" class="button-approve font-approval" style="margin-left: 65px; height:35px">Buat Kontrak</button>
        </form>    
    </div>
    <div class="col-sm-4"> </div>
</div>
    <br>
    <br>
    </div>
</div>

<div class="modal fade" id="myModd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="text-align:center;">Batalkan Proses?</h4>
			</div>
			<div class="modal-body" style="text-align:center;">
				<p>Jika proses dibatalkan, perubahan tidak akan disimpan.</p>
			</div>
			<div class="modal-footer">
					<a href="/proyek/detailProyek/{{ $proyek->id }}" class="btn btn-default" style="color:red;">Iya</a>
				
					<a href="/proyek/{{ $proyek->id }}/lihatKontrak/" class="btn btn-primary">Tidak</a>
			
			</div>
		</div>
		
		</div>
	</div>

    @section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js" integrity="sha256-+h0g0j7qusP72OZaLPCSZ5wjZLnoUUicoxbvrl14WxM=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/umd/util.js"></script>
    <script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    });
	$( document ).ready(function() {
		$("#simpan").click(function(e){
			e.preventDefault();
			//checks if it's valid
		//horray it's valid
			$("#myMod").modal("show");
			
		});
		$("#OK").click(function(e){
		   $('#save').submit();
		});

        $("#tolak").click(function(e){
			e.preventDefault();
			//checks if it's valid
		//horray it's valid
			$("#mod").modal("show");
			
		});
		$("#NO").click(function(e){
		   $('#reject').submit();
		});
  	});
	</script>
@endsection 

