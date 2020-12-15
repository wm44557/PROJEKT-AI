<div class="box1">
    <?php $recordOne = $params['recordOne'] ?? null ?>
    <?php if ($recordOne) : ?>

        <ul>
            <li>id: <?php echo $recordOne['id'] ?></li>
            <li>login: <?php echo $recordOne['login'] ?></li>
            <li>password: <?php echo $recordOne['password'] ?></li>
            <li>email: <?php echo $recordOne['email'] ?></li>
        </ul>

         <a href="/PROJEKT-AI/?action=editRecord&id=<?php echo $recordOne['id'] ?>"> <button class="button1">edit</button></a>

    <?php else : ?>
        <div>
            NULL
        </div>
    <?php endif; ?>
    <a href="/PROJEKT-AI/">
    <button class="button1">back to user list</button></a>
</div>