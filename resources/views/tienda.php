<!-- CABECERA -->
<?php include('components/header.php'); ?>

<main id="contenidoTienda">

        <div class="infoTienda">
            <h1>Tienda</h1>
            <p>
                Bienvenido a la tienda de <strong>MyWebIOT</strong>. Ofrecemos todo tipo de sistemas embebidos de diferentes marcas (Arduino, STM, ESP, etc)
                y sensores para medir temperatura, viento, etc.
            </p>
        </div>

        <div class="contenedor-carrito">
            <div id="carrito">
                <img src="images/carrito.svg">
                <span id="elementos-carrito"><strong>4</strong></span>
            </div>
            <a href="carrito"><button class="botonCheckout">
                    <img src="images/paypal.svg">
                    <span>Checkout</span>
                </button></a>
        </div>

    <div class="contenedor-productos">
        <div class="lista-productos">
            <div id="pricing-tables">
            <?php
               $productos = \Illuminate\Support\Facades\DB::table('products')
                                                            ->select('products.*')
                                                            ->paginate(4);

               foreach ($productos as $product):
            ?>

                    <div class="pricing-table">
                        <div class="header">
                            <div class="title"><?php echo $product->name ?></div>
                            <div class="price"><?php echo $product->price ?> € </div>
                        </div>
                        <div class="features">
                              <img class="imagenProducto" src="images/arduino.png" width="200" height="auto">
                        </div>
                        <div class="signup">

                            <form method="get" action="/tienda/verProducto" id="formDetalleProd">
                                <?= csrf_field() ?>
                                <input type="hidden" name="prodID" value="<?php echo $product->id ?>">
                                <?php if($product->stock == 0):?>
                                    <input type="submit" class="tiendaBoton" id="productoAgotado" value="SIN EXISTENCIAS" disabled>
                                <?php
                                    endif;
                                    if($product->stock > 0):
                                ?>
                                    <input type="submit" class="tiendaBoton" id="masInfoProducto" value="Más informacion">
                            </form>

                            <form method="post" action="/tienda/añadirProducto" id="formAñadirCarro">
                                <input type="hidden" name="prodID" value="<?php echo $product->id ?>">
                                <input type="submit" class="tiendaBoton" value="Añadir al carrito">
                            </form>
                            <?php endif; ?>

                        </div>
                    </div>
            <?php endforeach; ?>
            </div>
        </div>
        <div id="paginasCanales">
            <a href="<?php echo $productos->previousPageUrl()?>" class="previous round">&#8249;</a>
            <a href="<?php echo $productos->nextPageUrl() ?>" class="next round">&#8250;</a>
        </div>
    </div>

</main>








<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
