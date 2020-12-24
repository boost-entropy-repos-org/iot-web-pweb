<!-- CABECERA -->
<?php include('components/header.php'); ?>

<?php if(session('exito') != null):?>
    <div class="alertExito">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?php echo session('exito') ?>
    </div>
<?php endif; ?>

<main id="shopBackend">

    <h1>Panel de administración de la tienda</h1>

    <section id="productos">
        <diV id="cabeceraProductos">
            <h2>Administrar productos</h2>
            <a href="/tienda/nuevoProducto" id="añadirProductos">
                <span>Añadir producto</span>
                <img src="/images/add-24px.svg">
            </a>
        </diV>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad en stock</th>
                    <th>Consultar</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $products = \App\Models\Product::all();
                    foreach ($products as $product):
                ?>
                <tr>
                    <td><?php echo $product->id ?></td>
                    <td><?php echo $product->name ?></td>
                    <td><?php echo $product->price ?></td>
                    <td><?php echo $product->stock ?></td>
                    <form method="get">
                        <input type="hidden" name="prodID" value="<?php echo $product->id ?>">
                        <td>
                            <button type="submit" formaction="/tienda/consultarProducto">
                                <img class="iconosCRUDProducto" src="/images/article-24px.svg">
                            </button>
                        </td>
                        <td>
                            <button type="submit" formaction="/tienda/editarProducto">
                                <img class="iconosCRUDProducto" src="/images/create-24px.svg">
                            </button>
                        </td>
                        <td>
                            <button type="submit" formaction="/tienda/eliminarProducto">
                                <img class="iconosCRUDProducto" src="/images/icono-borrar.svg">
                            </button>
                        </td>
                    </form>
                </tr>
                <?php endforeach; ?>
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
                    <?php
                        $orders = \Illuminate\Support\Facades\DB::table('orders')
                                            ->join('usuarios','orders.id_client','=','usuarios.id')
                                            ->select('orders.*', 'usuarios.name')
                                            ->get();
                        foreach ($orders as $order):
                    ?>
                        <tr>
                            <td><?php echo $order->id ?></td>
                            <td><?php echo $order->name ?></td>
                            <td><?php echo $order->total ?></td>
                            <td><?php echo $order->status ?></td>
                        </tr>
                        <?php endforeach; ?>
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
                        <th>ID transacción</th>
                        <th>ID orden</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Fecha del pago</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $transactions = \Illuminate\Support\Facades\DB::table('transactions')
                            ->join('usuarios','transactions.id_client','=','usuarios.id')
                            ->select('transactions.*', 'usuarios.name')
                            ->get();

                        foreach ($transactions as $transaction):
                    ?>
                    <tr>
                        <td><?php echo $transaction->id ?></td>
                        <td><?php echo $transaction->id_order ?></td>
                        <td><?php echo $transaction->name ?></td>
                        <td><?php echo $transaction->total ?></td>
                        <td><?php echo $transaction->created_at ?></td>
                    </tr>
                        <?php endforeach; ?>
                    <tbody>
                </table>
            </div>
        </article>
    </section>

</main>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
