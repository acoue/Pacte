<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Enquete Question'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="enqueteQuestions index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('groupe') ?></th>
            <th><?= $this->Paginator->sort('ordre') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($enqueteQuestions as $enqueteQuestion): ?>
        <tr>
            <td><?= $this->Number->format($enqueteQuestion->id) ?></td>
            <td><?= h($enqueteQuestion->name) ?></td>
            <td><?= h($enqueteQuestion->groupe) ?></td>
            <td><?= $this->Number->format($enqueteQuestion->ordre) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $enqueteQuestion->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $enqueteQuestion->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $enqueteQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enqueteQuestion->id)]) ?>
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
