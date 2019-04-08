@extends('layouts.layout')

@section ('content')
@include('layouts.nav')
<html>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Upload New File for Proyek {{ $proyek->projectName }}</div>
                        <div class="panel-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('file.upload') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('post') }}
                                <input type="hidden" name="proyekId" value="{{ $proyek->id }}">
                                <div class="form-group {{ !$errors->has('title') ?: 'has-error' }}">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control">
                                    <span class="help-block text-danger">{{ $errors->first('title') }}</span>
                                </div>
                                <div class="form-group {{ !$errors->has('file') ?: 'has-error' }}">
                                    <label>File</label>
                                    <input type="file" name="file">
                                    <span class="help-block text-danger">{{ $errors->first('file') }}</span>
                                </div>

                                <div class="container-btn">
                                    <button class="container-form-btn">
                                        <span>Upload</span>
                                    </button>
                                </div>
                            </form>
                            <div  class="container-btn">
                                <button class="container-form-btn" onclick="window.location.href='/kelolaLelang/{{ $proyek->id }}'">
                                    <span>Kembali</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>