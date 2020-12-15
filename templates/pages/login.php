 <?php if (!isset($_SESSION['zalogowany']) || empty($_SESSION['zalogowany'])) : ?>
    
    <div class="boxForm">
    <form class="box" action="/PROJEKT-AI/?action=login" method="post">
         <h1>sign in</h1>
         <input class="loginInput" type="text" name="login" placeholder="username" autocomplete="off">
         <input class="passwordInput" type="password" name="haslo" placeholder="password">
         <input class="submit" type="submit" name="Zaloguj się" value="start">
         <?php
            if (isset($_GET['action'])) {
                if (($_GET['action']) == 'login') {
                    if ($params['login'] == 'fail') {
                        echo '<span style = color:red>wrong login or password!</span>';
                    }
                }
            }

            ?>
             <a href="/PROJEKT-AI/?action=register" class="button2">register</a>
        </form>
     </div>
 <?php endif; ?>