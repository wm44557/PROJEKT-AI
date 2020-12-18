
<div class="boxForm">
    <form class="box" method="post">

        <h1>Sign in</h1>
        <?php if (isset($errors['auth'])) echo "<p>" . $errors['auth'] . "</p>" ?>

        <input class="loginInput" type="text" name="login" placeholder="username" autocomplete="off"><br><br>
        <input class="passwordInput" type="password" name="password" placeholder="password"><br><br>
        <input class="submit" type="submit" name="Zaloguj się" value="start">
    </form>
</div>
<br>
<h4>Admin:</h4>
<p>login: admin</P>
<p>haslo: admin123</P>
<br>
<h4>User:</h4>
<p>login: kowal</P>
<p>haslo: kowal123</P>
<br>
<h4>Auditor:</h4>
<p>login: osek</P>
<p>haslo: osek123</P>