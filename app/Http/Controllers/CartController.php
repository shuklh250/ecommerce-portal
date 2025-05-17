<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function add(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        if (Auth::guard('user')->check()) {
            $user = Auth::guard('user')->user();

            $existing = Cart::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

            if ($existing) {
                $existing->quantity += $quantity;
                $existing->save();
            } else {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }

            return response()->json(['status' => 'success', 'message' => 'Added to cart']);
        }

        $cartItems = session('cart_items', []);

        $found = false;

        foreach ($cartItems as &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cartItems[] = ['product_id' => $productId, 'quantity' => $quantity];
        }

        session(['cart_items' => $cartItems]);
        return response()->json(['cart_count' => count($cartItems)]);
        // return response()->json(['status' => 'success', 'message' => 'Added to cart']);
    }

    public function update(Request $request)
    {


        // dd($request);
        $cart = session()->get('cart', []);
        $id = $request->product_id;

        if (isset($cart[$id])) {
            // Agar product pehle se hai → update quantity
            $cart[$id]['quantity'] = $request->quantity;
        } else {
            // Agar product nahi hai → add karo
            $cart[$id] = [
                "name" => $request->name,
                "price" => $request->price,
                "quantity" => $request->quantity,
                "image" => $request->image
            ];
        }

        // Save back to session
        session(['cart' => $cart]);

        return response()->json(['cart_count' => count($cart)]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        // Agar session me item hai
        if (isset($cart[$productId])) {

            $cart[$productId]['quantity']--;


            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);


                Cart::where('user_id', Auth::guard('user')->id())
                    ->where('product_id', $productId)
                    ->delete();
            } else {

                Cart::where('user_id', Auth::guard('user')->id())
                    ->where('product_id', $productId)
                    ->update(['quantity' => $cart[$productId]['quantity']]);
            }

            // Session update
            session(['cart' => $cart]);
        }

        return response()->json(['cart_count' => count($cart)]);
    }

    public function list($slug)
    {
        return view('cart-list');
    }
}
