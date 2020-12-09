<form class="box" action="/PROJEKT-AI/?action=register" method="post">
    <h1>Register</h1>
    <input class="loginInput" type="text" name="login2" placeholder="Username">
    <input class="passwordInput" type="password" name="haslo2" placeholder="Password">
    <input class="passwordInput" type="email" name="email2" placeholder="E-mail">
    <input class=" submit" type="submit" name="Zarejstruj się" value="Register now!">
    <?php
    if (isset($params['infoRegister'])) {
        if ($params['infoRegister'] == 'one') {
            echo '<span style = color:red>User with this login already exists!</span>';
        }
        if ($params['infoRegister'] == 'two') {
            echo '<span style = color:red>EMPTY FIELD !<span>';
        }
    }

    ?>

</form>