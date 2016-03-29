<?php

    $this->layout = 'default2';

?>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user) ?>
    <div class="form-group">
        <legend><?= __('Please enter a Username, Email, and Password to register') ?></legend>
        <?php
            echo $this->Form->input('username', [
                'placeholder' => '',
            ]);
            echo $this->Form->input('email', [
                'placeholder' => '',
            ]);
            echo $this->Form->input('cemail', [
                'label' => 'Email (confirm)',
                'placeholder' => '',
                'type' => 'email'
            ]);
            echo $this->Form->input('password', [
                'placeholder' => '',
            ]);
            echo $this->Form->input('cpassword', [
                'label' => 'Password (confirm)',
                'placeholder' => '',
                'type' => 'password'
            ]);
        ?>
    </div>
    <?= $this->Form->submit(__('Register')) ?>
    <?= $this->Form->end() ?>
</div>
