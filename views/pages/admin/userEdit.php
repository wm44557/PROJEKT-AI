<h1><?php echo dump($params[0]) ?></h1>
<h1><?php echo dump($_POST) ?></h1>

<h1>EDIT USER</h1>
<form action="<?php echo STARTING_URL ?>/admin/users-list/user-edited" class="box" method="post">
    <label for="id">ID: </label>
    <input type="text" name="id" value="<?php echo  $params[0]->id ?>" readonly><br><br>

    <label for="id">LOGIN: </label>
    <input type="text" name="login" value="<?php echo  $params[0]->login ?>"><br><br>

    <label for="id">PASSWORD: </label>

    <input type="text" name="password" value="<?php echo  $params[0]->password ?>"><br><br>
    <label for="id">PERMISSIONS: </label>
    <input list="browsers" name="permission" id="permission" placeholder="<?php echo  $params[0]->user ?>">


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