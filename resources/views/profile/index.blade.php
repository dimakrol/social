@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            @include('user.partials.userblock')
            <hr>

            @if (!$statuses)
                <p>{{ $user->getFirstNameOrUsername() }} hasn't posted anything yet.</p>
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
                                @if($status->user->id !== Auth::user()->id)
                                    <li><a href="{{ url('/status/' . $status->id . '/like') }}">Like</a></li>
                                @endif
                                <li>{{ $status->likes->count() }} {{ str_plural('like', $status->likes->count()) }}</li>

                            </ul>

                            @foreach($status->replies as $reply)
                                <div class="media">
                                    <a class="pull-left" href="{{ url('user/'. $reply->user->username ) }}">
                                        <img class="media-object" alt="{{ $reply->user->getFirstNameOrUsername() }}" src="{{ $reply->user->getAvatarUrl() }}">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="{{ url('user/'. $reply->user->username ) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
                                        <p>{{ $reply->body }}</p>
                                        <ul class="list-inline">
                                            <li>{{ $reply->created_at->diffForhumans() }}</li>
                                            @if($reply->user->id !== Auth::user()->id)
                                                <li><a href="{{ url('/status/' . $reply->id . '/like') }}">Like</a></li>
                                            @endif
                                            <li>{{ $reply->likes->count() }} {{ str_plural('like', $reply->likes->count()) }}</li>

                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                            @if ($authUserIsFriend || Auth::user()->id === $status->user->id)

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
                            @endif
                        </div>
                    </div>
                @endforeach

            @endif


        </div>
        <div class="col-lg-4 col-lg-offset-3">
            @if (Auth::user()->hasFriendRequestPending($user))
                <p>Waiting for {{ $user->getNameOrUsername() }} to accept your request.</p>
            @elseif (Auth::user()->hasFriendRequestReceived($user))
                <a href="{{ url('/friends/accept/' . $user->username) }}" class="btn btn-primary">Accept friend request</a>
            @elseif (Auth::user()->isFriendsWith($user))
                <p>You and {{ $user->getNameOrUsername() }} are friends</p>

                <form action="{{ url('/friends/delete/' . $user->username) }}" method="post">
                    <input type="submit" value="Delete friend" class="btn btn-primary">
                    {{ csrf_field() }}

                </form>
                
                
            @elseif(Auth::user()->id !== $user->id)
                <a href="{{ url('friends/add/'.$user->username) }}" class="btn btn-primary">Add as friend</a>
            @endif

            {{--{{ $user->first_name }}--}}
            <h4>{{ $user->getFirstNameOrUsername() }}'s friends</h4>

            @if (!$user->friends()->count())
                <p>{{ $user->getFirstNameOrUsername() }} has no friends.</p>
            @else
                @foreach ($user->friends() as $user)
                    @include('user.partials.userblock')
                @endforeach
            @endif
        </div>
    </div>
@endsection