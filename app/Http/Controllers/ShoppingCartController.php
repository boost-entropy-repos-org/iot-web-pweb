<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Classes\ShoppingCartItem;

class ShoppingCartController extends Controller
{
    public function mostrarCarrito() {

        $datos = session()->all();
        $listaCarro = array();
        $totalPago = 0;
        foreach ($datos as $key => $cantidad) {
            if(substr($key, 0, 5) == 'PROD-') {
                $prodID = substr($key, 5);
                $producto = Product::where('id', $prodID)->first();
                $itemCarrito = new ShoppingCartItem(
                    $producto->name,
                    $producto->description,
                    $producto->price,
                    $cantidad
                );

                $listaCarro[] = $itemCarrito;

                $totalPago += $itemCarrito->getTotalPrice();
            }
        }
        return view('checkout')->with('listaCarro', $listaCarro)
                                     ->with('totalPago', $totalPago);
    }
}
