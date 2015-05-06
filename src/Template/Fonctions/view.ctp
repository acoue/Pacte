<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Fonction'), ['action' => 'edit', $fonction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fonction'), ['action' => 'delete', $fonction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fonction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fonctions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fonction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Membres'), ['controller' => 'Membres', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Membre'), ['controller' => 'Membres', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="fonctions view large-10 medium-9 columns">
    <h2><?= h($fonction->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($fonction->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($fonction->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Membres') ?></h4>
    <?php if (!empty($fonction->membres)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Nom') ?></th>
            <th><?= __('Prenom') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Telephone') ?></th>
            <th><?= __('Comite') ?></th>
            <th><?= __('Demarche Id') ?></th>
            <th><?= __('Responsabilite Id') ?></th>
            <th><?= __('Fonction Id') ?></th>
            <th><?= __('Service Id') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($fonction->membres as $membres): ?>
        <tr>
            <td><?= h($membres->id) ?></td>
            <td><?= h($membres->nom) ?></td>
            <td><?= h($membres->prenom) ?></td>
            <td><?= h($membres->email) ?></td>
            <td><?= h($membres->telephone) ?></td>
            <td><?= h($membres->comite) ?></td>
            <td><?= h($membres->demarche_id) ?></td>
            <td><?= h($membres->responsabilite_id) ?></td>
            <td><?= h($membres->fonction_id) ?></td>
            <td><?= h($membres->service_id) ?></td>
            <td><?= h($membres->created) ?></td>
            <td><?= h($membres->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Membres', 'action' => 'view', $membres->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Membres', 'action' => 'edit', $membres->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Membres', 'action' => 'delete', $membres->id], ['confirm' => __('Are you sure you want to delete # {0}?', $membres->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
