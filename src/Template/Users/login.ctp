<?php

    $this->layout = 'default2';

?>
<div class="users form large-10 medium-9 columns">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <div class="form-group">
        <legend><?= __('Please enter your Username and Password') ?></legend>
        <?php
            echo $this->Form->input('username', [
                'label' => '',
                'placeholder' => "Username",
                'data-bind' => "value: userName"
            ]);
            echo $this->Html->link(
                'Forgot Username?',
                $this->Url->build(['_name' => 'resetuname'])
            );
        ?>
    </div>
    <br>
    <div class="form-group">
        <?php
            echo $this->Form->input('password', [
                'label' => '',
                'placeholder' => "Password"
            ]);
            echo $this->Html->link(
                'Forgot Password?',
                $this->Url->build(['_name' => 'resetpwd'])
            );
        ?>
    </div>        
    <br>
    <?= $this->Form->button(__('Login')) ?>
    <?= $this->Form->end() ?>
</div>
