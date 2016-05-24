<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    
    public function getIndex()
    {
        $friends  = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();

        return view('friends.index', ['friends' => $friends, 'requests' => $requests]);
    }

    public function getAdd($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect('/')->with('info', 'That user could not be found');
        }

        if (Auth::user()->id === $user->id) {
            return redirect('/');
        }

        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect('/user/' . $user->username)
                ->with('info', 'Friends request already pending');
        }

        if (Auth::user()->isFriendsWith($user)) {
            return redirect('/user/' . $user->username)
                ->with('info', 'Already friends');
        }

        Auth::user()->addFriend($user);

        return redirect('/user/' . $user->username)
            ->with('info', 'Friends request sent.');
    }

    public function getAccept($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect('/')->with('info', 'That user could not be found');
        }

        if (!Auth::user()->hasFriendRequestReceived($user)) {
            return redirect('/');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect(url('/user/'.$user->username))
            ->with('info', 'Friends request accepted');

    }   
}
