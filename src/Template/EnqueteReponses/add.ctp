<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Enquete Reponses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Demarches'), ['controller' => 'Demarches', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Demarch'), ['controller' => 'Demarches', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fonctions'), ['controller' => 'Fonctions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fonction'), ['controller' => 'Fonctions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="enqueteReponses form large-10 medium-9 columns">
    <?= $this->Form->create($enqueteReponse); ?>
    <fieldset>
        <legend><?= __('Add Enquete Reponse') ?></legend>
        <?php
            echo $this->Form->input('valeur');
            echo $this->Form->input('service');
            echo $this->Form->input('question_id', ['options' => $questions]);
            echo $this->Form->input('demarche_id', ['options' => $demarches]);
            echo $this->Form->input('fonction_id', ['options' => $fonctions]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
