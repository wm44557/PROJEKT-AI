<h1>Register User</h1>
<form class="boxEdit" method="post">
    <input class="form-input" type="text" name="email" placeholder="Email.."><br><br>
    <input class="form-input" type="text" name="login" placeholder="Login.."><br><br>
    <input class="form-input" type="password" name="password" placeholder="Password.."><br><br>
    <input class="form-input" list="browsers" name="permission" id="permission" placeholder="Check permission..">
    <datalist id="browsers">
        <option value="admin">
        <option value="user">
        <option value="auditor">
    </datalist>
    <br><br>
    <input class="button secondary small" class="submit" type="submit" value="Send">

</form>
<br>
<a href="<?php echo STARTING_URL ?>"><button class="button secondary small">Wróć</button></a>