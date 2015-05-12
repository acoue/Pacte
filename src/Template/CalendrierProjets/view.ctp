<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Calendrier Projet'), ['action' => 'edit', $calendrierProjet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Calendrier Projet'), ['action' => 'delete', $calendrierProjet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calendrierProjet->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Calendrier Projets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Calendrier Projet'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projets'), ['controller' => 'Projets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Projet'), ['controller' => 'Projets', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="calendrierProjets view large-10 medium-9 columns">
    <h2><?= h($calendrierProjet->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Projet') ?></h6>
            <p><?= $calendrierProjet->has('projet') ? $this->Html->link($calendrierProjet->projet->id, ['controller' => 'Projets', 'action' => 'view', $calendrierProjet->projet->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($calendrierProjet->id) ?></p>
            <h6 class="subheader"><?= __('Mois') ?></h6>
            <p><?= $this->Number->format($calendrierProjet->mois) ?></p>
            <h6 class="subheader"><?= __('Annee') ?></h6>
            <p><?= $this->Number->format($calendrierProjet->annee) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Libelle') ?></h6>
            <?= $this->Text->autoParagraph(h($calendrierProjet->libelle)); ?>

        </div>
    </div>
</div>
