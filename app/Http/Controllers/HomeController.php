<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class HomeController extends Controller
{
    public function dashboard(){

        $checkouts = Checkout::with('camps')->whereUserId(Auth::id())->get();
        return view('user.dashboard', [
            'checkouts' => $checkouts
        ]);
    }
}
