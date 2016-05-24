@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" action="{{ url('/status') }}" method="post">
                <div class="form-group{{ $errors->has('status') ? ' has-error' : ''}}">
                    <textarea placeholder="What's up {{ Auth::user()->getFirstNameOrUsername() }}?" name="status" class="form-control" rows="2"></textarea>
                    @if($errors->has('status'))
                        <span class="help-block"></span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Update status</button>
                {{ csrf_field() }}
            </form>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            @if (!$statuses)
                <p>Nothing in your timeline, yet</p>
            @else
                @foreach($statuses as $status)
                    <div class="media">
                        <a class="pull-left" href="{{ url('/user/' . $status->user->username) }}">
                            <img class="media-object" alt="{{ $status->user->getFirstNameOrUsername() }}" src="{{ $status->user->getAvatarUrl() }}">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{ url('/user/' . $status->user->username) }}">{{ $status->user->username }}</a></h4>
                            <p>{{ $status->body }}</p>
                            <ul class="list-inline">
                                <li>{{ $status->created_at->diffForhumans() }}</li>
                                <li><a href="#">Like</a></li>
                                <li>10 likes</li>
                            </ul>

                            @foreach($status->replies as $reply)
                                <div class="media">
                                    <a class="pull-left" href="{{ url('user/'. $reply->user->username ) }}">
                                        <img class="media-object" alt="{{ $reply->user->getNameOrUsername() }}" src="{{ $reply->user->getAvatarUrl() }}">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="{{ url('user/'. $reply->user->username ) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
                                        <p>{{ $reply->body }}</p>
                                        <ul class="list-inline">
                                            <li>{{ $reply->created_at->diffForhumans() }}</li>
                                            <li><a href="#">Like</a></li>
                                            <li>4 likes</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                            <form role="form" action="{{ url('/status/' . $status->id .'/reply') }}" method="post">
                                <div class="form-group {{ $errors->has("reply-{$status->id}") ? ' has-error' : '' }}">
                                    <textarea name="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
                                    @if($errors->has("reply-{$status->id}"))
                                        <span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span>
                                    @endif
                                </div>
                                <input type="submit" value="Reply" class="btn btn-default btn-sm">
                                {{ csrf_field() }}

                            </form>
                        </div>
                    </div>
                @endforeach

                {!!  $statuses->render() !!}
            @endif
        </div>
    </div>
@endsection