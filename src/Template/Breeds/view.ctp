<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Breed'), ['action' => 'edit', $breed->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Breed'), ['action' => 'delete', $breed->id], ['confirm' => __('Are you sure you want to delete # {0}?', $breed->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Breeds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Breed'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cats'), ['controller' => 'Cats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cat'), ['controller' => 'Cats', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="breeds view large-10 medium-9 columns">
    <h2><?= h($breed->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($breed->name) ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($breed->description) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($breed->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($breed->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($breed->modified) ?></p>
        </div>
    </div>
</div>
<div class="related">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Cats') ?></h4>
    <?php if (!empty($breed->cats)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Date Of Birth') ?></th>
            <th><?= __('Breed Id') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($breed->cats as $cats): ?>
        <tr>
            <td><?= h($cats->id) ?></td>
            <td><?= h($cats->name) ?></td>
            <td><?= h($cats->date_of_birth) ?></td>
            <td><?= h($cats->breed_id) ?></td>
            <td><?= h($cats->created) ?></td>
            <td><?= h($cats->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Cats', 'action' => 'view', $cats->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Cats', 'action' => 'edit', $cats->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Cats', 'action' => 'delete', $cats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cats->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
