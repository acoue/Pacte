<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $typeIndicateur->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $typeIndicateur->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Indicateurs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Etape Plan Actions'), ['controller' => 'EtapePlanActions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Etape Plan Action'), ['controller' => 'EtapePlanActions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="indicateurs form large-10 medium-9 columns">
    <?= $this->Form->create($typeIndicateur); ?>
    <fieldset>
        <legend><?= __('Edit Indicateur') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
