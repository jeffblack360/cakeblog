<?php

    $this->layout = 'default2';

?>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Please enter your username and password to register') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('email');
            echo $this->Form->input('emailconfirm', [
                'label' => 'Email (confirm)',
                'type' => 'email'
            ]);
            echo $this->Form->input('password');
            echo $this->Form->input('pwdconfirm', [
                'label' => 'Password (confirm)',
                'type' => 'password'
            ]);
            echo $this->Form->input('role', [
                 'options' => ['admin' => 'Admin', 'author' => 'Author']
            ]);
        ?>
    </fieldset>
    <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
