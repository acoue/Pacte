<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $outil->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $outil->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Outils'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Phases'), ['controller' => 'Phases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Phase'), ['controller' => 'Phases', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="outils form large-10 medium-9 columns">
    <?= $this->Form->create($outil); ?>
    <fieldset>
        <legend><?= __('Edit Outil') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('texte');
            echo $this->Form->input('phase_id', ['options' => $phases, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
