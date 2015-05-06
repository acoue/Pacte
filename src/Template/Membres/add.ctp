<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Membres'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Demarches'), ['controller' => 'Demarches', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Demarch'), ['controller' => 'Demarches', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Responsabilites'), ['controller' => 'Responsabilites', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Responsabilite'), ['controller' => 'Responsabilites', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fonctions'), ['controller' => 'Fonctions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fonction'), ['controller' => 'Fonctions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="membres form large-10 medium-9 columns">
    <?= $this->Form->create($membre); ?>
    <fieldset>
        <legend><?= __('Add Membre') ?></legend>
        <?php
            echo $this->Form->input('nom');
            echo $this->Form->input('prenom');
            echo $this->Form->input('email');
            echo $this->Form->input('telephone');
            echo $this->Form->input('comite');
            echo $this->Form->input('demarche_id', ['options' => $demarches, 'empty' => true]);
            echo $this->Form->input('responsabilite_id', ['options' => $responsabilites, 'empty' => true]);
            echo $this->Form->input('fonction_id', ['options' => $fonctions, 'empty' => true]);
            echo $this->Form->input('service_id', ['options' => $services, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
