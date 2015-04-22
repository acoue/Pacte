<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Demarch'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="demarches index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('date_engagement') ?></th>
            <th><?= $this->Paginator->sort('score') ?></th>
            <th><?= $this->Paginator->sort('reponse') ?></th>
            <th><?= $this->Paginator->sort('situation_crise') ?></th>
            <th><?= $this->Paginator->sort('restructuration') ?></th>
            <th><?= $this->Paginator->sort('equipe_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($demarches as $demarch): ?>
        <tr>
            <td><?= $this->Number->format($demarch->id) ?></td>
            <td><?= h($demarch->date_engagement) ?></td>
            <td><?= $this->Number->format($demarch->score) ?></td>
            <td><?= h($demarch->reponse) ?></td>
            <td><?= h($demarch->situation_crise) ?></td>
            <td><?= h($demarch->restructuration) ?></td>
            <td>
                <?= $demarch->has('equipe') ? $this->Html->link($demarch->equipe->name, ['controller' => 'Equipes', 'action' => 'view', $demarch->equipe->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $demarch->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $demarch->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $demarch->id], ['confirm' => __('Are you sure you want to delete # {0}?', $demarch->id)]) ?>
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
