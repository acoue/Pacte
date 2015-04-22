<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Reponse'), ['action' => 'edit', $reponse->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reponse'), ['action' => 'delete', $reponse->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reponse->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reponses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reponse'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Demarches'), ['controller' => 'Demarches', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Demarch'), ['controller' => 'Demarches', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="reponses view large-10 medium-9 columns">
    <h2><?= h($reponse->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Libelle') ?></h6>
            <p><?= h($reponse->libelle) ?></p>
            <h6 class="subheader"><?= __('Question') ?></h6>
            <p><?= $reponse->has('question') ? $this->Html->link($reponse->question->name, ['controller' => 'Questions', 'action' => 'view', $reponse->question->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Demarch') ?></h6>
            <p><?= $reponse->has('demarch') ? $this->Html->link($reponse->demarch->id, ['controller' => 'Demarches', 'action' => 'view', $reponse->demarch->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($reponse->id) ?></p>
        </div>
    </div>
</div>
