<!-- CABECERA -->
<?php include('components/header.php'); ?>

<main id="contenidoProducto">
    <a href="/tienda" id="volverAtras">
        <img src="/images/arrow_back-24px.svg"/>
        <span>Volver a la tienda</span>
    </a>
    <h1>Carrito de compra</h1>

    <section id="articulosCarro">
        <hr>
    <?php foreach ($listaCarro as $producto): ?>
        <article class="productoCarro">
            <div class="imagenProductoCarro">
                <img src="/images/arduino.png">
            </div>
            <div class="infoProductoCarro">
                <h3>Producto: <?php echo $producto->name; ?></h3>
                <ul>
                    <li><strong>Descripción: </strong> <?php echo $producto->description ?></li>
                    <li><strong>Cantidad: </strong> <?php echo $producto->quantity ?> ud(s) </li>
                    <li><strong>Precio por unidad: </strong> <?php echo number_format($producto->price,2) ?> €</li>
                </ul>
                <p>TOTAL: <?php echo $producto->getTotalPrice() ?> €</p>
            </div>
        </article>
    <?php endforeach; ?>
        <hr>
    </section>
    <div id="totalPago">
        <h2>TOTAL</h2>
        <h2><strong><?php echo number_format($totalPago,2) ?> €</strong></h2>
    </div>
    <div id="pagarConPaypal">
        <form method="get" action="/tienda/pagoPaypal">
            <button type="submit" class="botonCheckout">
                <img src="/images/paypal.svg">
                <span>Pagar con Paypal</span>
            </button>
        </form>
        <a href="/tienda/vaciarCarrito">
            <button class="tiendaBoton" id="vaciarCarro">
                Vaciar carrito
            </button>
        </a>
    </div>
</main>

<!-- CABECERA -->
<?php include('components/footer.php'); ?>
