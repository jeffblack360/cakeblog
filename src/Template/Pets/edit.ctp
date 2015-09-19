<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $pet->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $pet->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Pets'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="pets form large-10 medium-9 columns">
    <?= $this->Form->create($pet) ?>
    <fieldset>
        <legend><?= __('Edit Pet') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
