<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Enquete Question'), ['action' => 'edit', $enqueteQuestion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Enquete Question'), ['action' => 'delete', $enqueteQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enqueteQuestion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Enquete Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Enquete Question'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="enqueteQuestions view large-10 medium-9 columns">
    <h2><?= h($enqueteQuestion->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($enqueteQuestion->name) ?></p>
            <h6 class="subheader"><?= __('Groupe') ?></h6>
            <p><?= h($enqueteQuestion->groupe) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($enqueteQuestion->id) ?></p>
            <h6 class="subheader"><?= __('Ordre') ?></h6>
            <p><?= $this->Number->format($enqueteQuestion->ordre) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Aide') ?></h6>
            <?= $this->Text->autoParagraph(h($enqueteQuestion->aide)); ?>

        </div>
    </div>
</div>
