<!-- CABECERA -->
<?php include('components/header.php'); ?>

<?php if(session('error') != null):?>
    <div class="alertError">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?php echo session('error') ?>
    </div>
<?php endif; ?>

<main id="contenidoProducto">

    <a href="/tienda" id="volverAtras">
        <img src="/images/arrow_back-24px.svg"/>
        <span>Volver a panel de administración</span>
    </a>
    <h1>Añadir producto a la tienda</h1>

        <div id="infoProducto">
            <form method="post" action="procesar_producto">
                <?= csrf_field() ?>
                <table class="formularioTabla">
                    <tr>
                        <td><strong>Nombre del producto</strong></td>
                        <td>
                            <input type="text" name="productName"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Descripción</strong></td>
                        <td>
                            <textarea name="description" rows="4" cols="50"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Precio</strong></td>
                        <td>
                            <input type="text" name="price"/>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Cantidad en stock</strong></td>
                        <td>
                            <input type="text" name="stock"/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div id="botonesEditarProducto">
                                <button type="submit" class="boton">Añadir Producto</button>
                                <button type="reset" class="boton" id="restablecerBtn">Restablecer</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</main>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
