<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $fonction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $fonction->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fonctions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Membres'), ['controller' => 'Membres', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Membre'), ['controller' => 'Membres', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="fonctions form large-10 medium-9 columns">
    <?= $this->Form->create($fonction); ?>
    <fieldset>
        <legend><?= __('Edit Fonction') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
