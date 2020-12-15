<div class="content">


    <?php
    echo "<p>Witaj " . $params['login'] . "!</p>";

    echo "<p>Email " . $params['email'] . "!</p>";
    ?>

    <a href="/PROJEKT-AI/?action=users"><button class="button1">users list</button></a>

     <a href="/PROJEKT-AI/?action=editRecord&id=<?php echo (int) $_SESSION['id'] ?>"><button class="button1"> edit</button></a>

    <a href="/PROJEKT-AI/?action=logout"><button class="button1">logout</button></a>
</div>