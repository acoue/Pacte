<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Enquete Reponse'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Demarches'), ['controller' => 'Demarches', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Demarch'), ['controller' => 'Demarches', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fonctions'), ['controller' => 'Fonctions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fonction'), ['controller' => 'Fonctions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="enqueteReponses index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('valeur') ?></th>
            <th><?= $this->Paginator->sort('service') ?></th>
            <th><?= $this->Paginator->sort('question_id') ?></th>
            <th><?= $this->Paginator->sort('demarche_id') ?></th>
            <th><?= $this->Paginator->sort('fonction_id') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($enqueteReponses as $enqueteReponse): ?>
        <tr>
            <td><?= $this->Number->format($enqueteReponse->id) ?></td>
            <td><?= h($enqueteReponse->valeur) ?></td>
            <td><?= h($enqueteReponse->service) ?></td>
            <td>
                <?= $enqueteReponse->has('question') ? $this->Html->link($enqueteReponse->question->name, ['controller' => 'Questions', 'action' => 'view', $enqueteReponse->question->id]) : '' ?>
            </td>
            <td>
                <?= $enqueteReponse->has('demarch') ? $this->Html->link($enqueteReponse->demarch->id, ['controller' => 'Demarches', 'action' => 'view', $enqueteReponse->demarch->id]) : '' ?>
            </td>
            <td>
                <?= $enqueteReponse->has('fonction') ? $this->Html->link($enqueteReponse->fonction->name, ['controller' => 'Fonctions', 'action' => 'view', $enqueteReponse->fonction->id]) : '' ?>
            </td>
            <td><?= h($enqueteReponse->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $enqueteReponse->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $enqueteReponse->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $enqueteReponse->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enqueteReponse->id)]) ?>
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
