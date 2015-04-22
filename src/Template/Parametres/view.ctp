<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Parametre'), ['action' => 'edit', $parametre->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Parametre'), ['action' => 'delete', $parametre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parametre->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Parametres'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parametre'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="parametres view large-10 medium-9 columns">
    <h2><?= h($parametre->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($parametre->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($parametre->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($parametre->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($parametre->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Valeur') ?></h6>
            <?= $this->Text->autoParagraph(h($parametre->valeur)); ?>

        </div>
    </div>
</div>
