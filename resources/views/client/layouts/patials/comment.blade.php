<div class="card mb-3" style="margin-left: {{ $comment->parent_id ? '20px' : '0' }};">
    <div class="card-body">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <section class="content-item" id="comments">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="media">
                            <a class="pull-left" href="#"><img class="media-object" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt=""></a>
                            <div class="media-body">
                                <h5 class="media-heading">{{ $comment->user ? $comment->user->name : 'Khách' }}</h5>
                                  <p>{{ $comment->content }}.</p>

                                <ul class="list-unstyled list-inline media-detail   ">
                                 <a class="btn btn-link " onclick="showReplyForm({{ $comment->id }})">Phản hồi</a>
                                    <small class="">{{ $comment->created_at->format('d/m/Y H:i') }}</small>

                                    <div id="reply-form-{{ $comment->id }}" class="mt-2" style="display: none;">
                                        <form action="{{ route('posts.comments') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ $postDetail->id }}">
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            <div class="form-group">

                                                    <input name="content" type="text" class="form-control" placeholder="Bình luận">

                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm mb-3">Gửi</button>
                                        </form>
                                    </div>

                                </ul>
                            </div>
                        </div>
                         </div>
                </div>
            </div>
        </section>



        @foreach ($comment->replies as $reply)
            @include('client.layouts.patials.comment', ['comment' => $reply, 'postDetail' => $postDetail])
        @endforeach
    </div>
</div>
<style>
    body{margin-top:20px;}

.content-item {
    padding:30px 0;
	background-color:#FFFFFF;
}

.content-item.grey {
	background-color:#F0F0F0;
	padding:50px 0;
	height:100%;
}

.content-item h2 {
	font-weight:700;
	font-size:35px;
	line-height:45px;
	text-transform:uppercase;
	margin:20px 0;
}

.content-item h3 {
	font-weight:400;
	font-size:20px;
	color:#555555;
	margin:10px 0 15px;
	padding:0;
}

.content-headline {
	height:1px;
	text-align:center;
	margin:20px 0 70px;
}

.content-headline h2 {
	background-color:#FFFFFF;
	display:inline-block;
	margin:-20px auto 0;
	padding:0 20px;
}

.grey .content-headline h2 {
	background-color:#F0F0F0;
}

.content-headline h3 {
	font-size:14px;
	color:#AAAAAA;
	display:block;
}


#comments {
    box-shadow: 0 -1px 6px 1px rgba(0,0,0,0.1);
	background-color:#FFFFFF;
}

#comments form {
	margin-bottom:30px;
}

#comments .btn {
	margin-top:7px;
}

#comments form fieldset {
	clear:both;
}

#comments form textarea {
	height:100px;
}

#comments .media {
	border-top:1px dashed #DDDDDD;
	padding:20px 0;
	margin:0;

}

#comments .media > .pull-left {
    margin-right:20px;
}

#comments .media img {
	max-width:60px;
    border-radius: 50px;
}

#comments .media h4 {
	margin:0 0 10px;
}

#comments .media h4 span {
	font-size:14px;
	float:right;
	color:#999999;
}

#comments .media p {
	margin-bottom:15px;
	text-align:justify;
}

#comments .media-detail {
	margin:0;
}

#comments .media-detail li {
	color:#AAAAAA;
	font-size:12px;
	padding-right: 10px;
	font-weight:600;
}

#comments .media-detail a:hover {
	text-decoration:underline;
}

#comments .media-detail li:last-child {
	padding-right:0;
}

#comments .media-detail li i {
	color:#666666;
	font-size:15px;
	margin-right:10px;
}
</style>
