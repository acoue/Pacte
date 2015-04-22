<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Reponses'), ['controller' => 'Reponses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reponse'), ['controller' => 'Reponses', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="questions form large-10 medium-9 columns">
    <?= $this->Form->create($question); ?>
    <fieldset>
        <legend><?= __('Add Question') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('texte');
            echo $this->Form->input('texte_aide');
            echo $this->Form->input('ordre');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
