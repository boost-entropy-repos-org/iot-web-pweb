<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function verProducto()
    {
        if (isset($_GET['prodID'])) {
            return view('producto', ['id' => $_GET['prodID']]);
        }
    }

    public function consultarProducto()
    {
        if (isset($_GET['prodID'])) {
            return view('productoAdmin', ['id' => $_GET['prodID']]);
        }
    }

    public function editarProducto()
    {
        if (isset($_GET['prodID'])) {
            return view('editarProducto', ['id' => $_GET['prodID']]);
        }
    }

    public function eliminarProducto()
    {
        if (isset($_GET['prodID'])) {
            Product::where('id', $_GET['prodID'])
                ->first()
                ->delete();
            return redirect('/tienda')->with('exito','Se ha eliminado el producto correctamente');
        }
    }

    public function procesarEditarProducto(){
        if(isset($_POST['prodID'])) {
            $product = Product::where('id',$_POST['prodID'])
                                ->first();

            if ($_POST['productName'] != "") {
                $product->name = $_POST['productName'];
            }
            if ($_POST['description'] != "") {
                $product->description = $_POST['description'];
            }
            if ($_POST['price'] != "") {
                $product->price = doubleval($_POST['price']);
            }
            if ($_POST['stock'] != "") {
                $product->stock = doubleval($_POST['stock']);
            }
            $product->save();
            return redirect('/tienda')->with('exito','Se ha editado el producto ' . $product->name . ' correctamente');
        }
    }

    public function procesar_producto() {
        if(isset($_POST['productName'], $_POST['description'], $_POST['price'], $_POST['stock'])) {
            $newProduct = new Product();
            $newProduct->name = $_POST['productName'];
            $newProduct->description = $_POST['description'];
            $newProduct->price = $_POST['price'];
            $newProduct->stock = $_POST['stock'];
            $newProduct->save();

            return redirect('/tienda')->with('exito','Se ha añadido el producto ' . $_POST['productName']);
        } else {
            return back()->with('error','Se ha añadido el producto ' . $_POST['productName']);
        }
    }

    public function añadirProducto() {
        if(isset($_POST['prodID'], $_POST['quantity'])) {
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
}
