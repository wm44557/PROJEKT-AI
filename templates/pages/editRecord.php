<div class=boxEdit>
    <h3> edit form </h3>
    <div>
        <?php if (!empty($params['recordOne'])) : ?>
            <?php $recordOne = $params['recordOne']; ?>
            <form class="note-form" action="/PROJEKT-AI/?action=editRecord&id=<?php echo $recordOne['id'] ?>" method="post">
                <input name="id" type="hidden" value="<?php echo $recordOne['id'] ?>" />
                <ul class="editUL">
                    <li>
                        <label>login <?php echo $recordOne['userName'] ?><span class="required">*</span></label>
                    </li>

                    <li>
                        <label>password</label>
                        <input type="text" name="userPassEdit" class="editRecord" value="<?php echo $recordOne['pass'] ?>" />
                    </li>
                    <li>
                        <label>email</label>
                        <input type="text" name="userEmailEdit" class="editRecord" value="<?php echo $recordOne['email'] ?>" />
                    </li>
                    <li>
                        <label>foto url</label>
                        <input type="text" name="urlFoto" class="editRecord" value="<?php echo $recordOne['urlFoto'] ?>" />
                    </li>
                    <li>
                        <input class="submit" type="submit" name="Zaloguj się" value="edit">
                    </li>
                </ul>
            </form>
           <a href="/PROJEKT-AI/"> <button class="button1">
                    back</button></a>
        <?php else : ?>
            <div>Brak danych do wyświetlenia</div>
            <a href="/PROJEKT-AI/"><button>Powrót</button></a>
        <?php endif; ?>
    </div>
</div>