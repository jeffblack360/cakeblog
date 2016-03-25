<?= $this->Form->create(null, [
    'url' => ['controller' => 'Users', 'action' => 'reset']
]) ?>

<legend><?= __('Forgot your Username?') ?></legend>
<p>Your username can be e-mailed to you. Please enter the e-mail address used when you registered.</p>
<?php
    echo $this->Form->input('email');
?>

<br>

<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>