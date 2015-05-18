<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Indicateur'), ['action' => 'edit', $indicateur->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Indicateur'), ['action' => 'delete', $indicateur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $indicateur->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Indicateurs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Indicateur'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Etape Plan Actions'), ['controller' => 'EtapePlanActions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Etape Plan Action'), ['controller' => 'EtapePlanActions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="indicateurs view large-10 medium-9 columns">
    <h2><?= h($indicateur->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($indicateur->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($indicateur->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related EtapePlanActions') ?></h4>
    <?php if (!empty($indicateur->etape_plan_actions)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Numero') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Pilote') ?></th>
            <th><?= __('Mois') ?></th>
            <th><?= __('Annee') ?></th>
            <th><?= __('Etat') ?></th>
            <th><?= __('Modalite Suivi') ?></th>
            <th><?= __('Resultat') ?></th>
            <th><?= __('Indicateur Id') ?></th>
            <th><?= __('Plan Action Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($indicateur->etape_plan_actions as $etapePlanActions): ?>
        <tr>
            <td><?= h($etapePlanActions->id) ?></td>
            <td><?= h($etapePlanActions->numero) ?></td>
            <td><?= h($etapePlanActions->name) ?></td>
            <td><?= h($etapePlanActions->pilote) ?></td>
            <td><?= h($etapePlanActions->mois) ?></td>
            <td><?= h($etapePlanActions->annee) ?></td>
            <td><?= h($etapePlanActions->etat) ?></td>
            <td><?= h($etapePlanActions->modalite_suivi) ?></td>
            <td><?= h($etapePlanActions->resultat) ?></td>
            <td><?= h($etapePlanActions->type_indicateur_id) ?></td>
            <td><?= h($etapePlanActions->plan_action_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'EtapePlanActions', 'action' => 'view', $etapePlanActions->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'EtapePlanActions', 'action' => 'edit', $etapePlanActions->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'EtapePlanActions', 'action' => 'delete', $etapePlanActions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $etapePlanActions->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
