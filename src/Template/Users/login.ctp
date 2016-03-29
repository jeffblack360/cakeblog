<?php

    $this->layout = 'default2';
?>
<div class="users form large-10 medium-9 columns">
    <?= $this->Flash->render() ?>
    <div class="form-group">
    <?= $this->Form->create() ?>
        <legend><?= __('Please enter your Username and Password') ?></legend>
        <?php
            echo $this->Form->input('username', [
                'placeholder' => '',
                'data-bind' => "value: userName"
            ]);
            echo $this->Html->link(
                'Forgot Username?',
                $this->Url->build(['_name' => 'reset', 'do' => 'user'])
            );
        ?>
        <br><br>
        <?php
            echo $this->Form->input('password', [
                'placeholder' => ''
            ]);
            echo $this->Html->link(
                'Forgot Password?',
                $this->Url->build(['_name' => 'reset', 'do' => 'password'])
            );
        ?>
        <br><br>
    <?= $this->Form->button(__('Log In')) ?>
    <?= $this->Form->end() ?>
    </div>
</div>
