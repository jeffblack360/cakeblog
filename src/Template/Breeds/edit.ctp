<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $breed->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $breed->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Breeds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cats'), ['controller' => 'Cats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cat'), ['controller' => 'Cats', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="breeds form large-10 medium-9 columns">
    <?= $this->Form->create($breed) ?>
    <fieldset>
        <legend><?= __('Edit Breed') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
