<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Breed'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cats'), ['controller' => 'Cats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cat'), ['controller' => 'Cats', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="breeds index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('description') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($breeds as $breed): ?>
        <tr>
            <td><?= $this->Number->format($breed->id) ?></td>
            <td><?= h($breed->name) ?></td>
            <td><?= h($breed->description) ?></td>
            <td><?= h($breed->created) ?></td>
            <td><?= h($breed->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $breed->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $breed->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $breed->id], ['confirm' => __('Are you sure you want to delete # {0}?', $breed->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
