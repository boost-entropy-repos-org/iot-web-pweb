<!-- CABECERA -->
<?php include('components/header.php'); ?>
<?php include('components/notifications.php'); ?>

<main id="contenido-social">
    <a href="/social" id="volverAtras">
        <img src="/images/arrow_back-24px.svg"/>
        <span>Volver a MyWebIoT Social</span>
    </a>

    <?php

        $users = \Illuminate\Support\Facades\DB::table('profiles')
                ->join('usuarios', 'profiles.id_user', '=', 'usuarios.id')
                ->select('profiles.*', 'usuarios.name')
                ->get();
    ?>

    <h1>Usuarios de MyWebIoT</h1>
    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
            <tr>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Seguir usuario</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <?php
                        $current_id_user = session('id');
                        if($user->id == $current_id_user) {
                            continue;
                        }
                    ?>

                    <td><?php echo $user->name ?></td>
                    <td><?php echo $user->description ?></td>
                    <?php
                        $condicion = ['id_user' => $current_id_user, 'id_friend' => $user->id];
                        if(\App\Models\Friend::where($condicion)->exists()):
                    ?>
                        <td class="unfollow-user"><a href="/social/unfollow/<?php echo $user->id_user ?>">Dejar de seguir</a></td>
                    <?php else: ?>
                        <td class="follow-user"><a href="/social/follow/<?php echo $user->id_user ?>">Seguir usuario</a></td>
                </tr>
                <?php endif;
                    endforeach;
                ?>
            <tbody>
        </table>
    </div>

</main>


<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
