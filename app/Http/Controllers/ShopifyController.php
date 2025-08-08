<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Signifly\Shopify\Shopify;

class ShopifyController extends Controller
{
    public function products_show(Request $request, Shopify $shopify)
    {
        $products = $shopify->getProducts();

        return view('shopify.products', compact('products'));
    }

    public function orders_show(Request $request, Shopify $shopify)
    {
        $orders = $shopify->getOrders();

        return view('shopify.orders', compact('orders'));
    }
}
