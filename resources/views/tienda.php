<!-- CABECERA -->
<?php include('components/header.php'); ?>

<main id="contenidoTienda">

        <div class="infoTienda">
            <h1>Tienda</h1>
            <p>
                Bienvenido a la tienda de <strong>MyWebIOT</strong>. Ofrecemos todo tipo de sistemas embebidos de diferentes marcas (Arduino, STM, ESP, etc)
                y sensores para medir temperatura, viento, etc.
                <br><br>
                El método de pago usado es PayPal.
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
            <?php for($i = 0; $i < 5; $i++): ?>
                <div id="pricing-tables">
                    <div class="pricing-table">
                        <div class="header">
                            <div class="title">Arduino UNO</div>
                            <div class="price">€29</div>
                        </div>
                        <div class="features">
                              <img class="imagenProducto" src="images/arduino.png" width="200" height="auto">
                            <div class="descripcion-producto">
                                Microcontrolador para monitorizar temperatura. Perfecto para iniciados y prototipado
                            </div>
                        </div>
                        <div class="signup">
                            <a href="#">Añadir al carro</a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div id="paginasCanales">
            <a href="#" class="previous round">&#8249;</a>
            <a href="#" class="next round">&#8250;</a>
        </div>
    </div>

</main>








<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
