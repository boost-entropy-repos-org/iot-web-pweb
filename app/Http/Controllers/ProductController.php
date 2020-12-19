<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function verProducto() {
        if(isset($_POST['prodID'])) {
            return view('producto', ['id' => $_POST['prodID']]);
        } else {
            return "<h2>Producto no encontrado</h2>";
        }
    }
}
