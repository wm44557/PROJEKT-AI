
<div class="boxForm">
    <form class="box" method="post">

        <h1>Sign in</h1>
        <?php if (isset($errors['auth'])) echo "<p>" . $errors['auth'] . "</p>" ?>

        <input class="loginInput" type="text" name="login" placeholder="username" autocomplete="off"><br><br>
        <input class="passwordInput" type="password" name="password" placeholder="password"><br><br>
        <input class="submit" type="submit" name="Zaloguj się" value="start">
    </form>
</div>