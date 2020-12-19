<!-- CABECERA -->
<?php include('components/header.php'); ?>

<?php
    $product = \App\Models\Product::where('id', $id)->first();
?>

<main id="contenidoProducto">

    <a href="/tienda" id="volverAtras">
        <img src="/images/arrow_back-24px.svg"/>
        <span>Volver a la tienda</span>
    </a>
    <h1><?php echo $product->name?></h1>

    <div id="productoDetalle">
        <div id="productoImagen">
            <img class="imagenProducto" src="/images/arduino.png" width="200" height="auto">
        </div>
        <div id="infoProducto">
            <ul>
                <li><strong>Descripción</strong></li>
                <li><?php echo $product->description?></li>
                <br>
                <li><strong>Cantidad en stock</strong></li>
                <li><?php echo $product->stock ?></li>
            </ul>
            <div id="precio">
                <h2><?php echo $product->price ?> €</h2>
            </div>
            <form method="post" action="añadirCarro" id="formAñadirCarro">
                <?= csrf_field() ?>
                <input type="hidden" name="prodID" value="<?php echo $product->id ?>">
                <input type="number" id="quantity" name="quantity" min="1" value="1">
                <a href="#" class="btnAñadirCarro" onclick="document.getElementById('formAñadirCarro').submit()">
                    Añadir al carro
                </a>
            </form>
        </div>
    </div>


</main>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
