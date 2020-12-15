<div class="contentAdmin">

        <table class="table-style-one">
            <thead>
                <tr>
                    <th>LOGIN</th>
                    <th>PASSWORD</th>
                    <th>EMAIL</th>
                    <th>ACTION</th>
                </tr>
            </thead>
        <tbody>
            <?php foreach ($params['tableUsers'] ?? [] as $user) : ?>
                <tr>
                    <td><?php echo  $user['userName'] ?></td>
                    <td><?php echo $user['pass'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td>
                        <button class="buttonMini"> <a href="/PROJEKT-AI/?action=showRecord&id=<?php echo (int) $user['id'] ?>">Options</a></button>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="admin"><a href="/PROJEKT-AI/?action=logout"><button class="button1">logout</button></a></div>
</div>