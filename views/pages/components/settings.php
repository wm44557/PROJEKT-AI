<?php if (isset($params['settingsInfo'])) : ?>

    <div><?php echo $params['settingsInfo'] ?></div>
<?php endif; ?>

<h1>Ustawienia Konta</h1>

<form action="<?php echo STARTING_URL . '/' . $_SESSION['user_role'] ?>/settings" class="boxEdit" method="post">
    <label for="id">ID: </label>
    <input class="form-input" type="text" name="id" value="<?php echo  $params[0]->id ?>" readonly><br><br>

    <label for="login">LOGIN: </label>
    <input class="form-input" type="text" name="login" value="<?php echo  $params[0]->login ?>" readonly><br><br>

    <label for="password">HASŁO: </label>
    <input class="form-input" type="password" name="password" value="<?php echo  $params[0]->password ?>"><br><br>

    <label for="email">EMAIL: </label>
    <input class="form-input" type="text" name="email" value="<?php echo  $params[0]->email ?>"><br><br>

    <?php $_SESSION['editedUserId'] = $params[0]->id ?>
    <label for="permission">UPRAWNIENIA: </label>
    <input class="form-input" list="browsers" name="permission" id="permission" value="<?php echo  $params[0]->role ?>" readonly>

    <br><br>
    <input class="button secondary" class="submit" type="submit" value="Edytuj dane konta">

</form>
<br>
<a href="<?php echo STARTING_URL . "/" . $_SESSION['user_role']?>"><button class="button secondary small">Wróć</button></a>