<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $calendrierProjet->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $calendrierProjet->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Calendrier Projets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Projets'), ['controller' => 'Projets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Projet'), ['controller' => 'Projets', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="calendrierProjets form large-10 medium-9 columns">
    <?= $this->Form->create($calendrierProjet); ?>
    <fieldset>
        <legend><?= __('Edit Calendrier Projet') ?></legend>
        <?php
            echo $this->Form->input('libelle');
            echo $this->Form->input('mois');
            echo $this->Form->input('annee');
            echo $this->Form->input('projet_id', ['options' => $projets, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
