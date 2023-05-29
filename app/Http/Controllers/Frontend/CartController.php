<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        //Removing the coupon in the checkout
        // if (Session::has('coupon')) {
        //     Session::forget('coupon');
        // }

        $product = Product::findOrFail($id);

        if ($product->discount_price == NULL) {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'format' => $request->format,
                    'size' => $request->size,
                    // 'vendor' => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Article Ajouté au Panier']);

        } else {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'format' => $request->format,
                    'size' => $request->size,
                    'vendor' => $request->vendor,

                ],
            ]);

            return response()->json(['success' => 'Article ajouté au Panier']);

        }
    } //End Method

    public function AddToCartDetails(Request $request, $id)
    {
        // if (Session::has('coupon')) {
        //     Session::forget('coupon');
        // }

        $product = Product::findOrFail($id);

        if ($product->discount_price == NULL) {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'format' => $request->format,
                    'size' => $request->size,
                    // 'vendor' => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Article ajouté au Panier']);

        } else {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'format' => $request->format,
                    'size' => $request->size,
                    // 'vendor' => $request->vendor,

                ],
            ]);

            return response()->json(['success' => 'Article ajouté au Panier']);

        }

    } // End Method

    public function AddMiniCart()
    {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(
            array(
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => $cartTotal

            )
        );
    } // End Method

    public function RemoveMiniCart($rowId)
    {
        Cart::remove($rowId);
        // if (Session::has('coupon')) {
        //     $coupon_name = Session::get('coupon')['coupon_name'];
        //     $coupon = Coupon::where('coupon_name', $coupon_name)->first();

        //     Session::put('coupon', [
        //         'coupon_name' => $coupon->coupon_name,
        //         'coupon_discount' => $coupon->coupon_discount,
        //         'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
        //         'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
        //     ]);
        // }
        return response()->json(['success' => 'Aricle enlevé du Panier']);

    } // End Method
}
