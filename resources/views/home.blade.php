@extends('layouts.app')
 
@section('title', 'ARTIKEL TERKINI')

@section('header')
  <center>
    <h2>ARTIKEL TERKINI</h2>
  </center>
@endsection

@section('main')
<div class="row">
  @foreach ($articles as $article)
    <div class="col-md-4 col-sm-12 mt-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $article->title }}</h5>
            <p>by {{ $article->author }}</p>
            <small class="font-italic float-left">{{ $article->publish_date }}</small><br><br>
          <a href="/detail/{{ $article->id }}" class="btn btn-primary">Read</a>
        </div>
      </div>
    </div>
  @endforeach
</div>
<div class="d-flex justify-content-center mt-5">
  <ul class="pagination">
    @if ($currentPage > 1)
      <li class="page-item">
        <a href="{{ route('home', ['page' => $currentPage - 1]) }}" class="page-link">&laquo; Prev</a>
      </li>
    @endif

    @for ($i = 1; $i <= $pages; $i++)
      <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
        <a href="{{ route('home', ['page' => $i]) }}" class="page-link">{{ $i }}</a>
      </li>
    @endfor

    @if ($currentPage < $pages)
      <li class="page-item">
        <a href="{{ route('home', ['page' => $currentPage + 1]) }}" class="page-link">Next &raquo;</a>
      </li>
    @endif
  </ul>
</div>
@endsection
