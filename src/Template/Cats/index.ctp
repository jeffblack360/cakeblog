<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Cat'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Lost Cats'), ['lost']) ?></li>
        <li><?= $this->Html->link(__('Adoption'), ['action' => 'index', 'adopt']) ?></li>
    </ul>
</div>
<div class="cats index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('breed_id') ?></th>
            <th>Status</th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($cats as $cat): ?>
        <tr>
            <td><?= $this->Number->format($cat->id) ?></td>
            <td><?= h($cat->name) ?></td>
            <td>
                <?= $cat->has('breed') ? $this->Html->link($cat->breed->name, ['controller' => 'Breeds', 'action' => 'view', $cat->breed->id]) : '' ?>
            </td>
            <td><?= h($cat->status) ?></td>
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
