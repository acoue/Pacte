<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Phase'), ['action' => 'edit', $phase->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Phase'), ['action' => 'delete', $phase->id], ['confirm' => __('Are you sure you want to delete # {0}?', $phase->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Phases'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Phase'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="phases view large-10 medium-9 columns">
    <h2><?= h($phase->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($phase->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($phase->id) ?></p>
        </div>
    </div>
</div>
