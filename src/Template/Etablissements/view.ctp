<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Etablissement'), ['action' => 'edit', $etablissement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Etablissement'), ['action' => 'delete', $etablissement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $etablissement->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Etablissements'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Etablissement'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="etablissements view large-10 medium-9 columns">
    <h2><?= h($etablissement->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Libelle') ?></h6>
            <p><?= h($etablissement->libelle) ?></p>
            <h6 class="subheader"><?= __('Finess') ?></h6>
            <p><?= h($etablissement->finess) ?></p>
            <h6 class="subheader"><?= __('Numero Demarche') ?></h6>
            <p><?= h($etablissement->numero_demarche) ?></p>
            <h6 class="subheader"><?= __('Niveau Certif') ?></h6>
            <p><?= h($etablissement->niveau_certif) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($etablissement->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($etablissement->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($etablissement->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Equipes') ?></h4>
    <?php if (!empty($etablissement->equipes)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Date Engagement') ?></th>
            <th><?= __('Score') ?></th>
            <th><?= __('Reponse') ?></th>
            <th><?= __('Situation Crise') ?></th>
            <th><?= __('Restructuration') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Etablissement Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($etablissement->equipes as $equipes): ?>
        <tr>
            <td><?= h($equipes->id) ?></td>
            <td><?= h($equipes->name) ?></td>
            <td><?= h($equipes->date_engagement) ?></td>
            <td><?= h($equipes->score) ?></td>
            <td><?= h($equipes->reponse) ?></td>
            <td><?= h($equipes->situation_crise) ?></td>
            <td><?= h($equipes->restructuration) ?></td>
            <td><?= h($equipes->user_id) ?></td>
            <td><?= h($equipes->etablissement_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Equipes', 'action' => 'view', $equipes->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Equipes', 'action' => 'edit', $equipes->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Equipes', 'action' => 'delete', $equipes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipes->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
