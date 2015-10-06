<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Cat'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Lost Cats'), ['controller' => 'Cats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Adoption'), ['controller' => 'Cats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Breeds'), ['controller' => 'Breeds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Breed'), ['controller' => 'Breeds', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="cats index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('date_of_birth') ?></th>
            <th><?= $this->Paginator->sort('breed_id') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($cats as $cat): ?>
        <tr>
            <td><?= $this->Number->format($cat->id) ?></td>
            <td><?= h($cat->name) ?></td>
            <td><?= h($cat->date_of_birth) ?></td>
            <td>
                <?= $cat->has('breed') ? $this->Html->link($cat->breed->name, ['controller' => 'Breeds', 'action' => 'view', $cat->breed->id]) : '' ?>
            </td>
            <td><?= h($cat->created) ?></td>
            <td><?= h($cat->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $cat->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cat->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cat->id)]) ?>
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
