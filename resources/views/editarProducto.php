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
    <h1>Editar <?php echo $product->name?></h1>

    <div id="productoDetalle">
        <div id="productoImagen">
            <img class="imagenProducto" src="/images/arduino.png" width="200" height="auto">
        </div>
        <div id="infoProducto">
            <form method="post" action="procesarEditarProducto">
                <?= csrf_field() ?>
                <input type="hidden" name="prodID" value="<?php echo $product->id ?>">
                <table class="formularioTabla">
                    <tr>
                        <td><strong>Nombre del producto</strong></td>
                        <td>
                            <input type="text" name="productName" placeholder="<?php echo $product->name?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Descripción</strong></td>
                        <td>
                            <textarea placeholder="<?php echo $product->description;?>" name="description" rows="4" cols="50"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Precio</strong></td>
                        <td>
                            <input type="text" name="price" placeholder="<?php echo $product->price?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Cantidad en stock</strong></td>
                        <td>
                            <input type="text" name="stock" placeholder="<?php echo $product->stock?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div id="botonesEditarProducto">
                                <button type="submit" class="boton">Editar Producto</button>
                                <button type="reset" class="boton" id="restablecerBtn">Restablecer</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>


</main>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
