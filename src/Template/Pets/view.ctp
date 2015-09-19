<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Pet'), ['action' => 'edit', $pet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pet'), ['action' => 'delete', $pet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pet->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pet'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="pets view large-10 medium-9 columns">
    <h2><?= h($pet->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($pet->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($pet->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($pet->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($pet->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($pet->description)) ?>
        </div>
    </div>
</div>
