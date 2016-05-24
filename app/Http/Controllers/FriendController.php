<?php

namespace App\Http\Controllers;

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
}
