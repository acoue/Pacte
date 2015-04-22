<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reponses'), ['controller' => 'Reponses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reponse'), ['controller' => 'Reponses', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="questions index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('ordre') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($questions as $question): ?>
        <tr>
            <td><?= $this->Number->format($question->id) ?></td>
            <td><?= h($question->name) ?></td>
            <td><?= $this->Number->format($question->ordre) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $question->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $question->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?>
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
