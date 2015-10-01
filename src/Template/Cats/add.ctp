<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Cats'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Breeds'), ['controller' => 'Breeds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Breed'), ['controller' => 'Breeds', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="cats form large-10 medium-9 columns">
    <?= $this->Form->create($cat) ?>
    <fieldset>
        <legend><?= __('Add Cat') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('breed_id', ['options' => $breeds]);
            echo $this->element('catstatus');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
