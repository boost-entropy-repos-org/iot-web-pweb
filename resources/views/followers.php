<!-- CABECERA -->
<?php include('components/header.php'); ?>
<?php include('components/notifications.php'); ?>

<main id="contenido-social">
    <a href="/social" id="volverAtras">
        <img src="/images/arrow_back-24px.svg"/>
        <span>Volver a MyWebIoT Social</span>
    </a>

    <h1>Seguidores</h1>
    <?php
        $followers = \Illuminate\Support\Facades\DB::table('friends')
            ->where('friends.id_friend', session('id'))
            ->join('usuarios', 'friends.id_user', '=', 'usuarios.id')
            ->select('friends.*','usuarios.name')
            ->get();
    ?>
    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
            <tr>
                <th>Usuario</th>
                <th>Seguir</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($followers as $friend):
                        $friend_user = \App\Models\Usuario::where('id', $friend->id_user)->first();
                ?>
                <tr>
                    <td><?php echo $friend_user->name ?></td>
                    </td>
                    <?php
                    $condicion = ['id_user' => session('id'), 'id_friend' => $friend->id_user];
                    if(\App\Models\Friend::where($condicion)->exists()):
                        ?>
                        <td class="unfollow-user">
                            <a class="unfollow-user" href="/social/unfollow/<?php echo $friend->id_user ?>">Dejar de seguir</a>
                        </td>
                    <?php else: ?>
                        <td class="follow-user">
                            <a class="follow-user" href="/social/follow/<?php echo $friend->id_user ?>">Seguir usuario</a>
                        </td>
                    <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
            <tbody>
        </table>
    </div>

    <div class="table-wrapper">
        <h1>Siguiendo</h1>
        <?php
            $following = \Illuminate\Support\Facades\DB::table('friends')
                ->where('friends.id_user', session('id'))
                ->join('usuarios', 'friends.id_user', '=', 'usuarios.id')
                ->select('friends.*','usuarios.name')
                ->get();
        ?>

        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                <tr>
                    <th>Usuario</th>
                    <th>¿Te sigue?</th>
                    <th>Seguir</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($following as $friend):
                    $friend_user = \App\Models\Usuario::where('id', $friend->id_friend)->first();
                    ?>
                    <tr>
                        <td><?php echo $friend_user->name ?></td>
                        <td>
                            <?php
                                if(
                                    \App\Models\Friend::where('id_user', $friend->id_friend)
                                                        ->where('id_friend', session('id'))
                                                        ->exists()
                                ):
                            ?>
                                <span>Te sigue</span>
                            <?php else: ?>
                                <span>No te sigue</span>
                            <?php endif; ?>
                        </td>
                            <?php
                            $condicion = ['id_user' => session('id'), 'id_friend' => $friend->id_friend];
                            if(\App\Models\Friend::where($condicion)->exists()):
                                ?>
                            <td class="unfollow-user">
                                <a class="unfollow-user" href="/social/unfollow/<?php echo $friend->id_friend ?>">Dejar de seguir</a>
                            </td>
                            <?php else: ?>
                            <td class="follow-user">
                                <a class="follow-user" href="/social/follow/<?php echo $friend->id_friend ?>">Seguir usuario</a>
                            </td>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach;?>
                <tbody>
            </table>
        </div>
    </div>

</main>


<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>

