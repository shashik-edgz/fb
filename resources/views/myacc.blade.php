@extends('layouts.master')

@section('title')
    {{Auth::user()->first_name}}
@endsection

@section('content')
    <div class="container">

        <div class="col-md-3">
            <div class="name"><p>Shashik Thiwanka</p></div>
            <div class="round">
                <img id="img_id" src="{{ route('account.image', ['filename' =>'img'.$user->id .'.jpg']) }}" class="" alt="" >

            </div>

            <div id="like_id">
                Total Likes You Got <span class="badge">{{Auth::user()->likes()->count()}}</span>
            </div>
        </div>


        <div class="col-md-6">
            <h1 class="myacc_hed">Your Posts</h1>
            @foreach($posts as $post)


                <div  class="row">
                    <article class="post" data-postid="{{$post->id}}">
                    <div id="art_id" class="thumbnail">

                        <div class="caption">

                            <p class="cap">{{$post->body}}</p>

                            <p class="interaction">
                                <a id="like_bar" href="#" class="like {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'icon ion-android-favorite' : 'icon ion-android-favorite-outline' : 'icon ion-android-favorite-outline'  }}">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>
                            <!--    <a id="like_bar" href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You Don\'t like this post' : 'Dislike' : 'Dislike'  }}</a> -->

                                @if(Auth::user()==$post->user)

                                    <a id="like_bar" href="#" class="edit">Edit</a>
                                    <a id="like_bar" href="{{route('post.delete',['post_id'=>$post->id])}}">Delete</a>

                                @endif

                            </p>

                        </div>
                    </div>
                    </article>
                </div>
                @endforeach


            <div class="modal fade" tabindex="-1" role="dialog" id="edit-model">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit Post</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div for="post-body">Edit Post</div>
                                <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


        </div>


        <div class="col-md-3">

        </div>
    </div>
    <script>
        var token='{{Session::token()}}';
        var urlEdit='{{route('edit')}}';
        var urlLike='{{route('like')}}';
    </script>
@endsection