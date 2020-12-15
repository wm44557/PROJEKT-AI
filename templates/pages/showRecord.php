<div class="box1">
    <?php $recordOne = $params['recordOne'] ?? null ?>
    <?php if ($recordOne) : ?>

        <ul>
            <li>ID: <?php echo $recordOne['id'] ?></li>
            <li>Tytuł: <?php echo $recordOne['userName'] ?></li>
            <li>Opis: <?php echo $recordOne['pass'] ?></li>
            <li>Zapisano: <?php echo $recordOne['email'] ?></li>
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