<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipRegion;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

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
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);
        }
        return response()->json(['success' => 'Aricle enlevé du Panier']);

    } // End Method

    public function MyCart()
    {

        return view('frontend.mycart.view_mycart');

    } // End Method


    public function GetCartProduct()
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

    public function CartRemove($rowId)
    {
        Cart::remove($rowId);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);
        }


        return response()->json(['success' => 'Supprimé du Panier']);

    } // End Method

    public function CartDecrement($rowId)
    {

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);
        }


        return response()->json('Decrement');

    } // End Method


    public function CartIncrement($rowId)
    {

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);
        }

        return response()->json('Increment');

    } // End Method

    public function CouponApply(Request $request)
    {

        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);

            return response()->json(
                array(
                    'validity' => true,
                    'success' => 'Coupon Apliquée'

                )
            );


        } else {
            return response()->json(['error' => ' Coupon Invalide']);
        }

    } // End Method


    public function CouponCalculation()
    {

        if (Session::has('coupon')) {

            return response()->json(
                array(
                    'subtotal' => Cart::total(),
                    'coupon_name' => session()->get('coupon')['coupon_name'],
                    'coupon_discount' => session()->get('coupon')['coupon_discount'],
                    'discount_amount' => session()->get('coupon')['discount_amount'],
                    'total_amount' => session()->get('coupon')['total_amount'],
                )
            );
        } else {
            return response()->json(
                array(
                    'total' => Cart::total(),
                )
            );
        }
    } // End Method

    public function CouponRemove()
    {

        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Supprimé ']);

    } // End Method

    public function CheckoutCreate()
    {

        if (Auth::check()) {

            if (Cart::total() > 0) {

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $regions = ShipRegion::orderBy('region_name', 'ASC')->get();

                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'regions'));


            } else {

                $notification = array(
                    'message' => 'Achetez au moins un Article',
                    'alert-type' => 'error'
                );

                return redirect()->to('/')->with($notification);
            }



        } else {

            $notification = array(
                'message' => 'Se connecter avant de procéder',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }




    } // End Method




}
