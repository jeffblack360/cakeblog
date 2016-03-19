<?php

    $this->layout = 'default2';

?>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user) ?>
    <div class="form-group">
        <legend><?= __('Please enter a Username, Email, and Password to register') ?></legend>
        <?php
            echo $this->Form->input('username', [
                'placeholder' => 'Username',
            ]);
            echo $this->Form->input('email', [
                'placeholder' => 'Email',
            ]);
            echo $this->Form->input('cemail', [
                'label' => 'Email (confirm)',
                'placeholder' => 'Email (confirm)',
                'type' => 'email'
            ]);
            echo $this->Form->input('password', [
                'placeholder' => 'Password',
            ]);
            echo $this->Form->input('cpassword', [
                'label' => 'Password (confirm)',
                'placeholder' => 'Password (confirm)',
                'type' => 'password'
            ]);
        ?>
    </div>
    <?= $this->Form->submit(__('Register')) ?>
    <?= $this->Form->end() ?>
</div>
