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
               $productos = \App\Models\Product::all();

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
                            <a href="#" id="masInfoProducto">Más información</a>
                            <a href="#">Añadir al carro</a>
                        </div>
                    </div>

            <?php endforeach; ?>
            </div>
        </div>
        <div id="paginasCanales">
            <a href="#" class="previous round">&#8249;</a>
            <a href="#" class="next round">&#8250;</a>
        </div>
    </div>

</main>








<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
