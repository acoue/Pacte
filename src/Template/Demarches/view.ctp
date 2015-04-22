<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Demarch'), ['action' => 'edit', $demarch->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Demarch'), ['action' => 'delete', $demarch->id], ['confirm' => __('Are you sure you want to delete # {0}?', $demarch->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Demarches'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Demarch'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="demarches view large-10 medium-9 columns">
    <h2><?= h($demarch->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Reponse') ?></h6>
            <p><?= h($demarch->reponse) ?></p>
            <h6 class="subheader"><?= __('Equipe') ?></h6>
            <p><?= $demarch->has('equipe') ? $this->Html->link($demarch->equipe->name, ['controller' => 'Equipes', 'action' => 'view', $demarch->equipe->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($demarch->id) ?></p>
            <h6 class="subheader"><?= __('Score') ?></h6>
            <p><?= $this->Number->format($demarch->score) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Date Engagement') ?></h6>
            <p><?= h($demarch->date_engagement) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($demarch->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($demarch->modified) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Situation Crise') ?></h6>
            <p><?= $demarch->situation_crise ? __('Yes') : __('No'); ?></p>
            <h6 class="subheader"><?= __('Restructuration') ?></h6>
            <p><?= $demarch->restructuration ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
</div>
