@extends('templates.default')

@section('content')
    <h1>Your search for "{{ Request::input('query') }}"</h1>

    @if(!$users->count())
        <p>No results</p>
    @else
        <div class="row">
            <div class="col-lg-12">
                @foreach ($users as $user)
                    @include('user.partials.userblock')
                @endforeach
            </div>
        </div>
    @endif
@endsection