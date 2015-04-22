<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $etablissement->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $etablissement->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Etablissements'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="etablissements form large-10 medium-9 columns">
    <?= $this->Form->create($etablissement); ?>
    <fieldset>
        <legend><?= __('Edit Etablissement') ?></legend>
        <?php
            echo $this->Form->input('libelle');
            echo $this->Form->input('finess');
            echo $this->Form->input('numero_demarche');
            echo $this->Form->input('niveau_certif');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
