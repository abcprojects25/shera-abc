<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin\Products;
use App\Models\CartEnquiry;
use App\Models\CartItem;

class AddCartController extends Controller
{
    // Add product to cart session
  public function addToCart($id)
{
    $cart = session()->get('cart', []);

    $foundIndex = null;
    foreach ($cart as $index => $item) {
        if ($item['product_id'] == $id) {
            $foundIndex = $index;
            break;
        }
    }

    if ($foundIndex !== null) {
        // Increment quantity if product exists
        $cart[$foundIndex]['quantity']++;
    } else {
        // Add new product with quantity 1
        $cart[] = [
            'product_id' => $id,
            'quantity' => 1,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('cart.view');
}


    // Show cart view (passing cart items from session)
   public function viewCart()
{
    $cart = session()->get('cart', []);

    // For each item in cart, load product info and merge with quantity
    $cartItems = collect($cart)->map(function ($item) {
        $product = Products::find($item['product_id']);
        if (!$product) {
            return null; // skip missing products
        }
        return [
            'product_id' => $product->id,
            'product_name' => $product->title,
            'product_image' => $product->image,
            'quantity' => $item['quantity'],
        ];
    })->filter()->values();

    return view('frontend.cart', compact('cartItems'));
}


    // Remove item from cart session by product ID
 public function removeCartItem($productId)
{
    $cart = session()->get('cart', []);

    $newCart = array_filter($cart, fn($item) => $item['product_id'] != $productId);

    session()->put('cart', array_values($newCart));

    return response()->json(['success' => true, 'message' => 'Item removed']);
}


    // Submit enquiry - store enquiry and cart items into DB
 public function submitEnquiry(Request $request)
{
    $validated = $request->validate([
        'client_name' => 'required|string|max:255',
        'email' => 'required|email',
        'contact_no' => 'required',
        'office_address' => 'required|string',
        'product_id' => 'required|array',
        'product_id.*' => 'required|integer|exists:products,id',
        'quantity' => 'required|array',
        'quantity.*' => 'required|integer|min:1',
        'requirement' => 'required|array',
        'requirement.*' => 'nullable|string',
    ]);

    $enquiry = CartEnquiry::create([
        'client_name' => $validated['client_name'],
        'email' => $validated['email'],
        'contact_no' => $validated['contact_no'],
        'office_address' => $validated['office_address'],
    ]);

    foreach ($validated['product_id'] as $index => $productId) {
        $product = Products::find($productId);

        CartItem::create([
            'cart_enquiry_id' => $enquiry->id,
            'product_id' => $productId,
            'product_name' => $product->title,       // store product name
            'product_image' => $product->image,      // store product image path
            'quantity' => $validated['quantity'][$index],
            'requirement' => $validated['requirement'][$index] ?? null,
        ]);
    }

    session()->forget('cart'); // clear cart

    return redirect()->route('thanks')->with('success', 'Your quote has been submitted!');
}
}
