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

        // Agar user login hai to DB me store karo
        if (Auth::guard('user')->check()) {
            $user = Auth::guard('user')->user();

            // Agar pehle se product cart me hai to update karo
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

        // 👇 Guest user - Session me store karo
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

        return response()->json(['status' => 'success', 'message' => 'Added to cart']);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->product_id;
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session(['cart' => $cart]);
        }
        return response()->json(['cart_count' => count($cart)]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->product_id]);
        session(['cart' => $cart]);
        return response()->json(['cart_count' => count($cart)]);
    }

    public function list($slug)
    {
        return view('cart-list');
    }
}
