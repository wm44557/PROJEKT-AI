<h1>Users List</h1>

<div class="stats-box">
    <table class="form-table align">
        <thead>
            <tr>
                <th>ID</th>
                <th>LOGIN</th>
                <th>UPRAWNIENIA</th>
                <th>EMAIL</th>
                <th>Opcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($params['0'] ?? [] as $usr) : ?>
                <tr>
                    <td><?php echo  $usr['id'] ?></td>
                    <td><?php echo $usr['login'] ?></td>
                    <td><?php echo $usr['role'] ?></td>
                    <td><?php echo $usr['email'] ?></td>
                    <td>
                        <form action="<?php echo STARTING_URL ?>/admin/users-list/user-edit" method="post">
                            <input name="userID" type="hidden" value=<?php echo (int) $usr['id'] ?>>
                            <input class="button secondary small" type="submit" value="Edytuj">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</section>
</div>