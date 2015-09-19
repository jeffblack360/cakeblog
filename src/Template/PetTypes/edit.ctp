<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $petType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $petType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Pet Types'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="petTypes form large-10 medium-9 columns">
    <?= $this->Form->create($petType) ?>
    <fieldset>
        <legend><?= __('Edit Pet Type') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
