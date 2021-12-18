<?php

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

    function quantity($product_id){
        $product = Product::find($product_id);
        $quantity = $product->quantity;
        return $quantity;
    }

    function qty_added($product_id){
        $cart = Cart::content();
        $item = $cart->where('id', $product_id)->first();
        if($item){
            return $item->qty;
        }else{
            return 0;
        }
    }

    function qty_available($product_id){
        return quantity($product_id) - qty_added($product_id);
    }

    function discount($item){
        $product = Product::find($item->id);
        $qty_available = qty_available($item->id);

        $product->quantity = $qty_available;
        $product->save();
    }

    function increase($item){
        $product = Product::find($item->id);
        $quantity = quantity($item->id) + $item->qty;

        $product->quantity = $quantity;
        $product->save();
    }