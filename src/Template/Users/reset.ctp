<?php

    $this->layout = 'default2';

?>
<div class="users form large-10 medium-9 columns">
    <?= $this->Flash->render() ?>
    <div class="form-group">

    <?php if ($reset === 'user'): ?>
        <?php
            echo $this->element('Users/resetusername');
        ?>
    <?php else: ?>
        <?php
            echo $this->element('Users/resetpassword');
        ?>
    <?php endif; ?>

    </div>
</div>
