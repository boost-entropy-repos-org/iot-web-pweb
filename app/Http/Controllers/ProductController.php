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
            return redirect('/tienda');
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
            return redirect('/tienda');
        }
    }
}
