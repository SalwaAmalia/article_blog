@extends('layouts.app')

@section('title')
{{ $article->title }}
@endsection

@section('main')
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="card mb-3">
        <div class="card-body">
          <h2 class="card-title">{{ $article->title }}</h2>
          <p class="card-text">{{ $article->description }}</p>
          <p class="card-text"><small class="text-muted">By {{ $article->author }} - {{ $article->publish_date }}</small></p>
        </div>
      </div>
      <div class="card mb-3">
      <div class="card-body">
        <h3>Komentar</h3>
        @php $commentCount = count($article->comments) @endphp
        @foreach($article->comments->sortByDesc('publish_date')->take(2) as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">
                <textarea id="comment-content-{{ $comment->id }}" class="form-control editable" readonly>{{ $comment->content }}</textarea>
                </p>
                <p class="card-text"><small class="text-muted">By {{ $comment->user->name }} - {{ $comment->created_at }}</small></p>
                @if(Auth::check() && $comment->user_id == Auth::user()->id)
                <div class="d-flex justify-content-between align-items-center">
                <a data-comment-id="{{ $comment->id }}" class="edit-button">Edit</a>
                <a href="{{ route('comment.delete', $comment->id) }}">Hapus</a>
                </div>
                @endif
            </div>
        </div>
        @endforeach

        @if ($commentCount > 2)
          <a href="#" class="card-link see-more-comments">Lihat komentar lainnya</a>
        @endif

        <div id="other-comments" style="display: none;">
          @foreach($article->comments->sortByDesc('publish_date')->slice(2) as $comment)
            <div class="card mb-3">
              <div class="card-body">
                <p class="card-text">{{ $comment->content }}</p>
                <p class="card-text"><small class="text-muted">By {{ $comment->user->name }} - {{ $comment->created_at }}</small></p>
              </div>
            </div>
          @endforeach
        </div>

        @guest
         <p>Silakan <a href="{{ route('login') }}">login</a> untuk berkomentar.</p>
        @else
          <form method="POST" action="{{ route('store') }}">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <div class="form-group">
              <textarea class="form-control" id="content" name="content" rows="3"></textarea><br>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
          </form>
        @endguest
    </div>
  </div> 
</div>
<div class="col-md-4">
  <div class="card mb-3">
    <div class="card-body">
      <h3>Artikel Terbaru</h3>
      @foreach($latest_articles as $latest_article)
        <div class="card mb-3">
          <a href="{{ route('detail', $latest_article->id) }}">
            <div class="card-body">
              <h5 class="card-title">{{ $latest_article->title }}</h5>
              <p class="card-text"><small class="text-muted">By {{ $latest_article->author }} - {{ $latest_article->publish_date }}</small></p>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var seeMoreButton = document.querySelector('.see-more-comments');
        var otherCommentsDiv = document.querySelector('#other-comments');
        seeMoreButton.addEventListener('click', function() {
            otherCommentsDiv.style.display = 'block';
            seeMoreButton.style.display = 'none';
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        var editableTextarea = document.querySelector('.editable');
        var editButtons = document.querySelectorAll('.edit-button');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var commentId = button.getAttribute('data-comment-id');
                var commentContentTextarea = document.querySelector('#comment-content-' + commentId);
                if (commentContentTextarea.hasAttribute('readonly')) {
                    commentContentTextarea.removeAttribute('readonly');
                    button.innerHTML = 'Save';
                } else {
                    commentContentTextarea.setAttribute('readonly', true);
                    button.innerHTML = 'Edit';
                    var content = commentContentTextarea.value;
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var formData = new FormData();
                    formData.append('content', content);
                    formData.append('_method', 'PUT');
                    formData.append('_token', csrfToken);
                    var request = new XMLHttpRequest();
                    request.open('POST', '/comment/' + commentId);
                    request.send(formData);
                }
            });
        });
    });
</script>
@endsection
