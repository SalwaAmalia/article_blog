@extends('layouts.app')
@section('title','Artikel Saya')
@section('header')
<h2><center>Artikel Saya</center></h2>
@if($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert"></button> 
    <strong>{{ $message }}</strong>
</div>
@endif
@endsection
 
@section('main')
  <div class="col-md-12 bg-white p-4">
    <a href="/add"><button class="btn btn-primary mb-3">Tambah Artikel</button></a>
    @if($articles->count())
      <table class="table table-responsive table-bordered table-hover table-stripped">
        <thead>
          <tr>
            <th><center>No.</center></th>
            <th><center>Judul</center></th>
            <th><center>Penulis</center></th>
            <th><center>Konten</center></th>
            <th width="15%"><center>Aksi</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($articles as $i => $article)
            <tr>
              <td>{{ ++$i }}.</td>
              <td>{{ $article->title }}</td>
              <td>{{ $article->author }}</td>
              <td>{{ $article->description }}</td>
              <td>
                <center><a href="/edit/{{ $article->id }}"><button class="btn btn-warning">Edit</button>
                <a href="/delete/{{ $article->id }}"><button class="btn btn-danger">Hapus</button></a></center>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="alert alert-info">
        <strong>Anda belum mempunyai artikel</strong>
      </div>
    @endif
  </div>
  <div class="d-flex justify-content-center mt-5">
    <ul class="pagination">
      @if ($currentPage > 1)
        <li class="page-item">
            <a href="{{ route('show', ['page' => $currentPage - 1]) }}" class="page-link">&laquo; Prev</a>
        </li>
      @endif

      @for ($i = 1; $i <= $pages; $i++)
        <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
            <a href="{{ route('show', ['page' => $i]) }}" class="page-link">{{ $i }}</a>
        </li>
      @endfor

      @if ($currentPage < $pages)
        <li class="page-item">
            <a href="{{ route('show', ['page' => $currentPage + 1]) }}" class="page-link">Next &raquo;</a>
        </li>
      @endif
    </ul>
  </div>
@endsection
