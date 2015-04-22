<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Etablissement'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="etablissements index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('libelle') ?></th>
            <th><?= $this->Paginator->sort('finess') ?></th>
            <th><?= $this->Paginator->sort('numero_demarche') ?></th>
            <th><?= $this->Paginator->sort('niveau_certif') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($etablissements as $etablissement): ?>
        <tr>
            <td><?= $this->Number->format($etablissement->id) ?></td>
            <td><?= h($etablissement->libelle) ?></td>
            <td><?= h($etablissement->finess) ?></td>
            <td><?= h($etablissement->numero_demarche) ?></td>
            <td><?= h($etablissement->niveau_certif) ?></td>
            <td><?= h($etablissement->created) ?></td>
            <td><?= h($etablissement->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $etablissement->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $etablissement->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $etablissement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $etablissement->id)]) ?>
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
