<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Cat'), ['action' => 'edit', $cat->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cat'), ['action' => 'delete', $cat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cat->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cats'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cat'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Breeds'), ['controller' => 'Breeds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Breed'), ['controller' => 'Breeds', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="cats view large-10 medium-9 columns">
    <h2><?= h($cat->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($cat->name) ?></p>
            <h6 class="subheader"><?= __('Breed') ?></h6>
            <p><?= $cat->has('breed') ? $this->Html->link($cat->breed->name, ['controller' => 'Breeds', 'action' => 'view', $cat->breed->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($cat->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Date Of Birth') ?></h6>
            <p><?= h($cat->date_of_birth) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($cat->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($cat->modified) ?></p>
        </div>
    </div>
</div>
