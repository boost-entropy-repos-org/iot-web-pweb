<!-- CABECERA -->
<?php include('components/header.php'); ?>

<main id="contenidoTienda">

        <div class="infoTienda">
            <h1>Tienda</h1>
            <p>Bienvenido a la tienda de MyWebIOT</p>
        </div>

        <div class="contenedor-carrito">
            <img src="images/carrito.svg">
            <span id="elementos-carrito"><strong>4</strong></span>
            <a href="carrito"><button class="boton">Checkout</button></a>
        </div>

    <div class="contenedor-productos">
        <div class="lista-productos">
            <?php for($i = 0; $i < 5; $i++): ?>
            <article class="detalle-producto">
                <h2>Producto X</h2>
                <img src="images/tienda-sensor.jpg">
                <p>Descripción del producto</p>
                <h3>23€</h3>
                <form method="get" action="tienda">
                    <button type="submit" class="boton">Add to cart</button>
                </form>
            </article>
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
