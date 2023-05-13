@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('header')
  <center class="mt-4">
      <h2>Edit Artikel</h2>
  </center>
@endsection

@section('main')
<div class="col-md-8 col-sm-12 bg-white p-4">
  <form method="post" action="{{ route('update', $article->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group"><br>
        <label>Judul Artikel</label>
        <input type="text" class="form-control" name="title" value="{{ $article->title }}" placeholder="Judul artikel">
    </div>
    <div class="form-group"><br>
        <label>Penulis</label>
        <input type="text" class="form-control" name="author" value="{{ $article->author }}" placeholder="Penulis artikel">
    </div>
    <div class="form-group"><br>
        <label>Isi Artikel</label>
        <textarea class="form-control" name="description" rows="15">{{ $article->description }}</textarea>
    </div>
    <div class="form-group"><br>
        <label>Timestamp</label>
        <input type="hidden" class="form-control" name="publish_date" value="<?php echo date('Y-m-d H:i:s'); ?>">
    </div>
    <div class="form-group">
        <label>Edit</label>
        <input type="submit" class="form-control btn btn-primary" value="Update">
    </div>
  </form>
</div>
@endsection
