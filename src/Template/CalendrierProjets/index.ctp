<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Calendrier Projet'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projets'), ['controller' => 'Projets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Projet'), ['controller' => 'Projets', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="calendrierProjets index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('mois') ?></th>
            <th><?= $this->Paginator->sort('annee') ?></th>
            <th><?= $this->Paginator->sort('projet_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($calendrierProjets as $calendrierProjet): ?>
        <tr>
            <td><?= $this->Number->format($calendrierProjet->id) ?></td>
            <td><?= $this->Number->format($calendrierProjet->mois) ?></td>
            <td><?= $this->Number->format($calendrierProjet->annee) ?></td>
            <td>
                <?= $calendrierProjet->has('projet') ? $this->Html->link($calendrierProjet->projet->id, ['controller' => 'Projets', 'action' => 'view', $calendrierProjet->projet->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $calendrierProjet->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $calendrierProjet->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $calendrierProjet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calendrierProjet->id)]) ?>
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
