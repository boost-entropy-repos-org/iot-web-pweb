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
        if(count($listaCarro) > 0) {
            return view('checkout')->with('listaCarro', $listaCarro)
                ->with('totalPago', $totalPago);
        } else {
            return redirect('/tienda')->with('error', '¡El carrito está vacío! Añada elementos al carrito para pagar');
        }
    }

    public function vaciarCarrito() {
        $datos = session()->all();
        foreach ($datos as $producto => $cantidad) {
            if(substr($producto, 0, 5) == 'PROD-') {
                session()->forget($producto);
            }
        }
        return redirect('/tienda')->with('exito', 'Se ha eliminado el contenido del carrito');
    }

    public function añadirProducto() {
        if(session('id') == null) {
            return redirect('/tienda')->with('error', 'Debe iniciar sesión para comprar productos de la tienda');
        }

        if(isset($_POST['prodID'], $_POST['quantity'])) {

            //Se comprueba si hay stock suficiente
            if(!$this->isProductAvailable($_POST['prodID'],$_POST['quantity'])) {
                return redirect('/tienda')->with('error', 'No hay suficientes unidades en stock');
            }

            $producto = "PROD-" . $_POST['prodID'];
            if(session($producto) != null) {
                $cantidadEnCarro = session($producto) + $_POST['quantity'];
                session([$producto => $cantidadEnCarro]);
            } else {
                session([$producto => $_POST['quantity']]);
            }
            return redirect('/tienda')->with('exito', 'Se han añadido ' . $_POST['quantity'] . ' producto(s) al carro');
        }
        return redirect('/tienda')->with('error', 'Ha ocurrido un error al añadir el producto al carro');
    }

    public function getNumeroElementosCarro() {
        $data = session()->all();
        $NelementosCarro = 0;
        foreach ($data as $key => $valor) {
            if($key[0]=='P') {
                $NelementosCarro += $valor;
            }
        }
        return $NelementosCarro;
    }


    public function isProductAvailable($prodID, $cantidad) {
        $producto = Product::where('id', $prodID)->first();
        return ($producto->stock > $cantidad);
    }
}
