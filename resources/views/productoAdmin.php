<!-- CABECERA -->
<?php include('components/header.php'); ?>

<?php
$product = \App\Models\Product::where('id', $id)->first();
?>

<main id="contenidoProducto">

    <a href="/tienda" id="volverAtras">
        <img src="/images/arrow_back-24px.svg"/>
        <span>Volver a panel de administración</span>
    </a>
    <h1><?php echo $product->name?></h1>

    <div id="productoDetalle">
        <div id="productoImagen">
            <img class="imagenProducto" src="/images/arduino.png" width="200" height="auto">
        </div>
        <div id="infoProducto">
            <form method="get">
                <input type="hidden" name="prodID" value="<?php echo $product->id ?>">
                <button type="submit" formaction="/tienda/eliminarProducto">
                    <img class="iconosCRUDProducto" src="/images/icono-borrar.svg">
                </button>
                <button type="submit" formaction="/tienda/editarProducto">
                    <img class="iconosCRUDProducto" src="/images/create-24px.svg">
                </button>
            </form>
            <ul>
                <li><strong>ID del producto</strong></li>
                <li><?php echo $product->id?></li>
                <br>
                <li><strong>Descripción</strong></li>
                <li><?php echo $product->description?></li>
                <br>
                <li><strong>Cantidad en stock</strong></li>
                <li><?php echo $product->stock ?></li>
            </ul>
            <div id="precio">
                <h2><?php echo $product->stock ?> €</h2>
            </div>
        </div>
    </div>


</main>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
