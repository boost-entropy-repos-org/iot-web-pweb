<!-- CABECERA -->
<?php include('components/header.php'); ?>
<main id="shopBackend">

    <h1>Panel de administración de la tienda</h1>

    <section id="productos">
        <h2>Administrar productos</h2>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad en stock</th>
                    <th>Eliminar</th>
                    <th>Modificar</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Content 1</td>
                    <td>Content 1</td>
                    <td>Content 1</td>
                    <td>Content 1</td>
                    <td>Content 1</td>
                    <td><img src="images/icono-borrar.svg"></td>
                    <td><img src="images/create-24px.svg"></td>
                </tr>
                <tbody>
            </table>
        </div>
    </section>

    <section class="pagos">
        <article class="ordenes">
            <h2>Órdenes de pago</h2>
            <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total (Euros)</th>
                        <th>Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                    </tr>
                    <tbody>
                </table>
            </div>
        </article>
        <article class="transacciones">
            <h2>Transacciones</h2>
            <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                    <tr>
                        <th>ID de transacción</th>
                        <th>ID de orden</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Fecha del pago</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                    </tr>
                    <tbody>
                </table>
            </div>
        </article>
    </section>

</main>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
