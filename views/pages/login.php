<div class="login-form__background">
    <div class="login-form__form">
        <div>
            <h1 class="light-color">Logowanie</h1>
            <p><small class="light-color">Wpisz swój login i hasło.</small></p>
        </div>
        <form method="post">

            <input class="input" type="text" name="login" placeholder="Login" autocomplete="off">
            <input class="input" type="password" name="password" placeholder="Hasło">
            <?php if (isset($errors['auth'])) echo "<p class='error'>" . $errors['auth'] . "</p>" ?>
            <br><br>
            <input class="button primary" type="submit" name="Zaloguj się" value="Zaloguj">

        </form>
    </div>

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