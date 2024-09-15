<?php

namespace App\Http\Controllers\User;

use App\Models\Camps;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Checkout\AfterCheckout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\User\Checkout\Store;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Camps $camps, Request $request)
    {
        //
        
        if ($camps->isRegistered){
            $request->session()->flash('error', "You already registered on {$camps->title} camp.");
            return redirect()->route('dashboard');
        }
        return view('checkout.create', [
            'camps' => $camps,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request, Camps $camps)
    {
        
       //mapping request data
       $data = $request->all();
       $data['user_id'] = Auth::id(); // Pastikan user login
       $data['camps_id'] = $camps->id; // Pastikan nama kolom di DB adalah camps_id
   
       // Update data user
       $user = Auth::user();
       $user->email = $data['email'];
       $user->name = $data['name'];
       $user->occupation = $data['occupation'];
       $user->save();
   
       // Buat entri checkout
       $checkout = Checkout::create($data);

       //sending email
       Mail::to(Auth::user()->email)->send(new AfterCheckout($checkout));
   
       // Return atau redirect ke halaman sukses
       return redirect(route('checkout.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
    public function success(){
        return view('checkout.success');
    }

    public function invoice(Checkout $checkout){
        return $checkout;
    }
}
