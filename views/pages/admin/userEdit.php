<h1>EDIT USER</h1>
<form action="<?php echo STARTING_URL ?>/admin/users-list/user-edited" class="box" method="post">
    <label for="id">ID: </label>
    <input type="text" name="id" value="<?php echo  $params[0]->id ?>" readonly><br><br>

    <label for="login">LOGIN: </label>
    <input type="text" name="login" value="<?php echo  $params[0]->login ?>"><br><br>

    <label for="password">HASŁO: </label>
    <input type="text" name="password" value="<?php echo  $params[0]->password ?>"><br><br>

    <label for="email">EMAIL: </label>
    <input type="text" name="email" value="<?php echo  $params[0]->email ?>"><br><br>


    <label for="permission">UPRAWNIENIA: </label>
    <input list="browsers" name="permission" id="permission" placeholder="<?php echo  $params[0]->role ?>" required>


    <datalist id="browsers">
        <option value="admin">
        <option value="user">
        <option value="auditor">
    </datalist>
    <br><br>
    <input class="submit" type="submit" value="Send">

</form>
<br>
<a href="<?php echo STARTING_URL ?>"><button>Wróć</button></a>