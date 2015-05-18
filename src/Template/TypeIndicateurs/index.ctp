<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Indicateur'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Etape Plan Actions'), ['controller' => 'EtapePlanActions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Etape Plan Action'), ['controller' => 'EtapePlanActions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="indicateurs index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($typeIndicateurs as $typeIndicateur): ?>
        <tr>
            <td><?= $this->Number->format($typeIndicateur->id) ?></td>
            <td><?= h($typeIndicateur->name) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $typeIndicateur->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $typeIndicateur->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $typeIndicateur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $typeIndicateur->id)]) ?>
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
