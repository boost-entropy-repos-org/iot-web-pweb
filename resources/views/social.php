<!-- CABECERA -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<?php include('components/header.php'); ?>
<?php include('components/notifications.php'); ?>

<main id="contenido-social">
    <div id="info-social-home">
        <h1>Bienvenidos a la red social de MyWebIOT</h1>
    </div>

    <section id="wrapper-profile">
        <article id="profile">
            <h1>Mi Perfil</h1>
            <?php
                $userProfile = \App\Models\Profile::where('id_user', session('id'))->first();
            ?>
            <div id="profile-wrapper">
                <img id="profile-img" src="<?php echo $userProfile->img ?>"/>
                <div id="profile-status">
                    <p><strong>Mi estado</strong></p>
                    <p><?php echo $userProfile->description ?></p>
                </div>
            </div>
        </article>

        <aside id="options-social">
            <h1>Opciones</h1>
            <table class=buttons>
                <tr>
                    <td></td>
                    <td><a href="/social/members" class="boton">Miembros</a></td>
                    <td></td>
                    <td><a href="/social/followers" class="boton">Amigos</a></td>
                </tr>
                <tr>
                    <td><a href="/social/messages" class="boton">Mensajes</a></td>
                    <td></td>
                    <td><a href="/social/channels" class="boton">Canales</a></td>
                    <td></td>
                    <td><a href="/social/editProfile" class="boton">Perfil</a></td>
                    <td></td>
                </tr>
            </table>
        </aside>

    </section>



    <div id="social-wall">
        <h2>Muro de MyWebIoT</h2>
        <div class="ultimos-mensajes">
            <p class="mensaje mensaje-muro" id="mensaje-muro-0"></p>
            <p class="mensaje mensaje-muro" id="mensaje-muro-1"></p>
            <p class="mensaje mensaje-muro" id="mensaje-muro-2"></p>
            <p class="mensaje mensaje-muro" id="mensaje-muro-3"></p>
            <p class="mensaje mensaje-muro" id="mensaje-muro-4"></p>
        </div>
    </div>
</main>

<script>
    function getLastMessages() {
        $.get('/social/lastMessages', function (data) {
            for (var i = 0; i < 5; i++) {
                document.getElementById('mensaje-muro-'+i).textContent = data[i];
                console.log('mensaje-muro-'+i, data[i])
            }
            setTimeout(getLastMessages, 2000)
        })
    }
    getLastMessages();
</script>


<!-- PIE DE PÁGINA -->
<?php include('components/footer.php'); ?>
