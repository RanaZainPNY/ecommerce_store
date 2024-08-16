<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class WebController extends Controller
{
    //
    function index()
    {
        return view('web.home');
    }
    function shop()
    {
        $products = Product::all();
        // $products = Product::orderByDesc('created_at')->get();
        return view('web.shop', [
            'products' => $products,
        ]);
    }
    function checkout()
    {
        return view('web.checkout');
    }

    function notfound()
    {
        return view('web.notfound');
    }
    ////////////////// cart start //////////////////
    function cart()
    {
        return view('web.cart');
    }
    function addToCart($id)
    {
        $product = Product::findOrFail($id);
        // Session Based Cart
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "sku" => $product->sku,
                "price" => $product->price,
                "description" => $product->description,
                "image" => $product->image,
                "quantity" => 1
            ];
        }
        session()->put('cart', $cart);
        // dump(session()->get('cart', []));
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            // dd($request);
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            // session()->flash('success', "Cart updated successfully");
            return redirect()->back()->with('success', 'Product updated successfully');
        }
    }

    function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            // session()->flash('success', "Product removed successfully");
            return redirect()->back()->with('success', "Product removed successfully");
        }


    }
    ////////////////// cart end //////////////////

    public function placeorder(Request $request)
    {
        // Get items from session Based Cart
        $cart = session()->get('cart');
        // $cart => [
        //     '1' => [ 'name' => "abc", 'price'=>100, 'quantity' => 3, 'sku' => 39393 ],
        //     '2' => [ 'name' => "def", 'price'=>200, 'quantity' => 1, 'sku' => 39393 ],
        //     '3' => [ 'name' => "def", 'price'=>3333, 'quantity' => 2, 'sku' => 39393 ],
        //     '4' => [ 'name' => "def", 'price'=>3333, 'quantity' => 1, 'sku' => 39393 ],
        // ];

        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['quantity'] * $details['price'];
        }

        // Order -> Firstname, Lastname, Address, Mobile, Email, Notes, Total
        // Create a new order
        $order = new Order();
        // Add data relevant to the request
        $order->firstname = $request->firstname;
        $order->lastname = $request->lastname;
        $order->address = $request->address;
        $order->contact = $request->contact;
        $order->email = $request->email;
        $order->notes = $request->notes;
        $order->total = $total;
        $order->save();

        // Clear cart after placing order
        session()->forget('cart');
        // return redirect()->route('web-home')->with('success', 'order placed successfully');
        return redirect()->back()->with('success', 'order placed successfully');

        // dump($cart);
        // dump($request);
        // die();

    }


}
