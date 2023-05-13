@extends('layouts.app')
 
@section('title', 'Menambah Artikel')
@section('header')
@endsection
@section('main')
<div class="col-md-8 col-sm-12 bg-white p-4">
  <form method="post" action="/add_process">
    @csrf
    <div class="form-group"><br>
        <label>Judul</label>
        <input type="text" class="form-control" name="title" placeholder="Judul artikel">
    </div>
    <div class="form-group"><br>
        <label>Penulis</label>
        <input type="text" class="form-control" name="author" placeholder="Nama Penulis">
    </div>
    <div class="form-group"><br>
        <label>Isi Konten</label>
        <textarea class="form-control" name="description" rows="15"></textarea>
    </div>
    <div class="form-group"><br>
    <input type="hidden" class="form-control" name="publish_date" value="<?php echo date('Y-m-d H:i:s'); ?>">
    </div>
    <div class="form-group">
        <input type="submit" class="form-control btn btn-primary" value="Submit">
    </div>
  </form>
</div>
@endsection
