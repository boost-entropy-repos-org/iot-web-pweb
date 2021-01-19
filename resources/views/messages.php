<!-- CABECERA -->
<?php include('components/header.php'); ?>
<?php include('components/notifications.php'); ?>

<main id="contenido-social">

    <a href="/social" id="volverAtras">
        <img src="/images/arrow_back-24px.svg"/>
        <span>Volver a MyWebIoTSocial</span>
    </a>


    <div id="wrapper-messages">
        <div id="write-msg">
            <h1>Enviar mensaje</h1>
            <form id="form-msg" method="post" action="send">
                <?= csrf_field() ?>
                <table>
                    <tr>
                        <td><strong>Enviar mensaje a: </strong></td>
                        <td>
                            <select id="user" name="user">
                                <?php
                                $friends = \Illuminate\Support\Facades\DB::table('friends')
                                        ->where('friends.id_user', session('id'))
                                        ->join('usuarios', 'friends.id_friend', '=', 'usuarios.id')
                                        ->select('friends.*','usuarios.name')
                                        ->get();

                                    foreach($friends as $friend):
                                        if($friend->id_friend != session('id')):
                                ?>
                                    <option value="<?php echo $friend->id_friend ?>"><?php echo $friend->name ?></option>
                                <?php
                                        endif;
                                    endforeach;
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td><strong>Tipo de mensaje:</strong></td>
                        <td>
                            <select id="typeMsg" name="typeMsg">
                                <option value="p">Mensaje público</option>
                                <option value="w">Susurro</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Mensaje</strong></td>
                        <td>
                            <textarea name="message" placeholder="Di lo que piensas!" name="description" rows="4" cols="50"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div id="botonesEditarProducto">
                                <button type="submit" class="boton">Enviar</button>
                                <button type="reset" class="boton" id="restablecerBtn">Restablecer</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="msg-received">
            <h1>Buzón de mensajes</h1>
            <?php
                $messages = \Illuminate\Support\Facades\DB::table('messages')
                                                ->where('id_recip', session('id'))
                                                ->orWhere('id_auth', session('id'))
                                                ->join('usuarios as recip', 'messages.id_recip', '=', 'recip.id')
                                                ->join('usuarios as auth', 'messages.id_auth', '=', 'auth.id')
                                                ->select('messages.*', 'recip.name as recipname', 'auth.name as authname')
                                                ->orderBy('messages.created_at', 'DESC')
                                                ->paginate(5);

                //print_r($messages);

                foreach ($messages as $message):
            ?>
            <article class="mensaje">
                <p>
                    <?php if($message->pm == 'w'):?>
                        <span class="susurro">SUSURRO:</span>
                    <?php endif; ?>

                    <span class="creador-mensaje">
                        <?php
                            if($message->authname == session('username')) {
                                echo "Enviaste a ";
                            } else {
                                echo $message->authname . " envió a ";
                            }
                        ?>
                    </span>
                    <span class="destino"> <?php echo $message->recipname ?> </span>
                    <span class="fecha-mensaje"> [<?php echo $message->created_at?>]: </span>
                    <span class="contenido-mensaje"> <?php echo $message->message ?> </span>
                </p>
            </article>
            <?php endforeach; ?>
            <div id="paginasCanales">
                <a href="<?php echo $messages->previousPageUrl()?>" class="previous round">&#8249;</a>
                <a href="<?php echo $messages->nextPageUrl() ?>" class="next round">&#8250;</a>
            </div>
        </div>
    </div>

</main>

<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
