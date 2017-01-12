@extends('layouts.master')

@section('content')
	@include('includes.message-block')
	

	<section class="row new-post">
		<div class="container-fluid">
			<div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <!--<a class="navbar-brand" href="index.html">Brand</a>-->
            </div>
			<header><h3>What do you have to say?</h3></header>
			<form action="{{ route('post.create') }}" method="post">
				<div class="form-group">
					<textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Create Post</button>
				<input type="hidden" value="{{ Session::token() }}" name="_token">
			</form>
		</div>
	</section>

	<!--ORIGINAL CODE
	<section class="row posts">
		<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
			<header><h3>What other people say...</h3></header>
			@foreach($posts as $post)
				<article class="post" data-postid="{{ $post->id }}">
					<p>{{ $post->body }}</p>
					<div class="info">
						Posted by {{ $post->user->first_name }} on {{ $post->created_at }} 
					</div>
					<div class="interaction">
						<a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
						@if(Auth::user() == $post->user)
							|
							<a href="#" class="edit">Edit</a> |
							<a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
						@endif
					</div>
				</article>
			@endforeach
		</div>
	</section> -->

	<div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            	<header><h3>What other people say...</h3></header>
            	@foreach($posts as $post)
                <div class="post-preview" data-postid="{{ $post->id }}">
                    <a href="post.html">
                        <h2 class="post-title">
                            <p>{{ $post->body }}</p>
                        </h2>
                    </a>
                    <p class="post-meta">Posted by <a href="#">{{ $post->user->first_name }}</a> on {{ $post->created_at }}</p>
                </div>
                
                <div class="interaction">
						<a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
						@if(Auth::user() == $post->user)
							|
							<a href="#" class="edit">Edit</a> |
							<a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
						@endif
					</div>
					<hr>
                @endforeach
                
                <hr>
                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


	<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the Post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
    	var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('edit') }}';
        var urlLike = '{{ route('like') }}';
    </script>
@endsection