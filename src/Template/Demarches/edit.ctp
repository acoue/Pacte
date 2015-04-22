<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $demarch->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $demarch->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Demarches'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="demarches form large-10 medium-9 columns">
    <?= $this->Form->create($demarch); ?>
    <fieldset>
        <legend><?= __('Edit Demarch') ?></legend>
        <?php
            echo $this->Form->input('date_engagement');
            echo $this->Form->input('score');
            echo $this->Form->input('reponse');
            echo $this->Form->input('situation_crise');
            echo $this->Form->input('restructuration');
            echo $this->Form->input('equipe_id', ['options' => $equipes, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
