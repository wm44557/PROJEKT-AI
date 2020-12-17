<h1>Register User</h1>
<form class="box" method="post">
    <input type="text" name="email" placeholder="Email.." ><br><br>
    <input type="text" name="login" placeholder="Login.."><br><br>
    <input type="password" name="password" placeholder="Password.."><br><br>
    <input list="browsers" name="permission" id="permission" placeholder="Check permission..">
    <datalist id="browsers">
        <option value="admin">
        <option value="user">
        <option value="auditor">
    </datalist>
    <br><br>
    <input class="submit" type="submit" value="Send">

</form>
<br>
<a href="<?php echo STARTING_URL?>"><button>Wróć</button></a>