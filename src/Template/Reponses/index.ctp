<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Reponse'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Demarches'), ['controller' => 'Demarches', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Demarch'), ['controller' => 'Demarches', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="reponses index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('libelle') ?></th>
            <th><?= $this->Paginator->sort('question_id') ?></th>
            <th><?= $this->Paginator->sort('demarche_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($reponses as $reponse): ?>
        <tr>
            <td><?= $this->Number->format($reponse->id) ?></td>
            <td><?= h($reponse->libelle) ?></td>
            <td>
                <?= $reponse->has('question') ? $this->Html->link($reponse->question->name, ['controller' => 'Questions', 'action' => 'view', $reponse->question->id]) : '' ?>
            </td>
            <td>
                <?= $reponse->has('demarch') ? $this->Html->link($reponse->demarch->id, ['controller' => 'Demarches', 'action' => 'view', $reponse->demarch->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $reponse->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reponse->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reponse->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reponse->id)]) ?>
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
