<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Pet Type'), ['action' => 'edit', $petType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pet Type'), ['action' => 'delete', $petType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $petType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pet Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pet Type'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="petTypes view large-10 medium-9 columns">
    <h2><?= h($petType->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($petType->name) ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($petType->description) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($petType->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($petType->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($petType->modified) ?></p>
        </div>
    </div>
</div>
