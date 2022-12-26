<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addCart(Request $request){
        $userid = Auth::user()->id;
        // $form =  $request->hid;
        $form = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);
        
        $form['users_id'] = $userid;
        Cart::create($form);

        return redirect('#')->with('status', 'Item Added to Cart');
        

    }

    public function getCart(){
        $showCart =  Cart::where('users_id', auth()->user()->id)->get();
        $totalPrice = 0;
        foreach($showCart as $show){
            $totalPrice += str_replace(',', '', $show->price) ;

        }
        return view('cart', [
            'showCart' => $showCart,
            'totalPrice' => $totalPrice
        ]);
    }
}
