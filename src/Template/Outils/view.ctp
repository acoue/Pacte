<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Outil'), ['action' => 'edit', $outil->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Outil'), ['action' => 'delete', $outil->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outil->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Outils'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Outil'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Phases'), ['controller' => 'Phases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Phase'), ['controller' => 'Phases', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="outils view large-10 medium-9 columns">
    <h2><?= h($outil->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($outil->name) ?></p>
            <h6 class="subheader"><?= __('Phase') ?></h6>
            <p><?= $outil->has('phase') ? $this->Html->link($outil->phase->name, ['controller' => 'Phases', 'action' => 'view', $outil->phase->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($outil->id) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Texte') ?></h6>
            <?= $this->Text->autoParagraph(h($outil->texte)); ?>

        </div>
    </div>
</div>
