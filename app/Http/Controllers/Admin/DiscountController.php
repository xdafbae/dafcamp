<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Discount\Store;
use App\Http\Requests\Admin\Discount\Update;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discount = Discount::all();

        return view('admin.discount.index', [
            'discount' => $discount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {

        $discount = Discount::create($request->all());
        $request->session()->flash('success', 'A new discount has been created');
        return redirect()->route('admin.discount.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        return view('admin.discount.edit', [
            'discount' => $discount,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, Discount $discount)
    {
        $discount->update($request->all());
        $request->session()->flash('success', 'Discount berhasil di update');
        return redirect()->route('admin.discount.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Discount $discount)
    {
        $discount->delete();
        $request->session()->flash('error', 'Discount berhasil di hapus');
        return redirect()->route('admin.discount.index');
    }
}
