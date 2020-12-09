 <?php if (!isset($_SESSION['zalogowany']) || empty($_SESSION['zalogowany'])) : ?>
     <form class="box" action="/PROJEKT-AI/?action=login" method="post">
         <h1>Login</h1>
         <input class="loginInput" type="text" name="login" placeholder="Username">
         <input class="passwordInput" type="password" name="haslo" placeholder="Password">
         <input class="submit" type="submit" name="Zaloguj się" value="Start">
         <?php
            if (isset($_GET['action'])) {
                if (($_GET['action']) == 'login') {
                    if ($params['login'] == 'fail') {
                        echo '<span style = color:red>Niepoprawny login lub haslo!</span>';
                    }
                }
            }

            ?>
         <button class="button2"><a href="/PROJEKT-AI/?action=register">Register</a></button>
     </form>
 <?php endif; ?>