<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Pet Type'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="petTypes index large-10 medium-9 columns">
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
    <?php foreach ($petTypes as $petType): ?>
        <tr>
            <td><?= $this->Number->format($petType->id) ?></td>
            <td><?= h($petType->name) ?></td>
            <td><?= h($petType->description) ?></td>
            <td><?= h($petType->created) ?></td>
            <td><?= h($petType->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $petType->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $petType->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $petType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $petType->id)]) ?>
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
