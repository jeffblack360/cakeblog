<?= $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'reset']
]) ?>

<legend><?= __('Forgot your Password?') ?></legend>
<p>
Please enter the username you use to login to your account.
<br>We will send instructions on how to reset your password to the e-mail address associated with your account. The instructions will be valid for one day.
</p>
<?php
    echo $this->Form->input('username');
?>

<br>

<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>