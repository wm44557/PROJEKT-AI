<h1>Users List</h1>

<div class="stats-box">
    <table class="form-table align">
        <thead>
            <tr>
                <th>ID</th>
                <th>LOGIN</th>
                <th>EMAIL</th>
                <th>Opcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($params['0'] ?? [] as $usr) : ?>
                <tr>
                    <td><?php echo  $usr['id'] ?></td>
                    <td><?php echo $usr['login'] ?></td>
                    <td><?php echo $usr['email'] ?></td>
                    <td>
                        <a href="/PROJEKT-AI/admin/users-list/?action=show&id=<?php echo (int) $usr['id'] ?>">
                            <button class="button secondary small">Edytuj</button></a>


                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</section>
</div>