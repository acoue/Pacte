<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Enquete Reponse'), ['action' => 'edit', $enqueteReponse->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Enquete Reponse'), ['action' => 'delete', $enqueteReponse->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enqueteReponse->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Enquete Reponses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Enquete Reponse'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Demarches'), ['controller' => 'Demarches', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Demarch'), ['controller' => 'Demarches', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fonctions'), ['controller' => 'Fonctions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fonction'), ['controller' => 'Fonctions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="enqueteReponses view large-10 medium-9 columns">
    <h2><?= h($enqueteReponse->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Valeur') ?></h6>
            <p><?= h($enqueteReponse->valeur) ?></p>
            <h6 class="subheader"><?= __('Service') ?></h6>
            <p><?= h($enqueteReponse->service) ?></p>
            <h6 class="subheader"><?= __('Question') ?></h6>
            <p><?= $enqueteReponse->has('question') ? $this->Html->link($enqueteReponse->question->name, ['controller' => 'Questions', 'action' => 'view', $enqueteReponse->question->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Demarch') ?></h6>
            <p><?= $enqueteReponse->has('demarch') ? $this->Html->link($enqueteReponse->demarch->id, ['controller' => 'Demarches', 'action' => 'view', $enqueteReponse->demarch->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Fonction') ?></h6>
            <p><?= $enqueteReponse->has('fonction') ? $this->Html->link($enqueteReponse->fonction->name, ['controller' => 'Fonctions', 'action' => 'view', $enqueteReponse->fonction->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($enqueteReponse->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($enqueteReponse->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($enqueteReponse->modified) ?></p>
        </div>
    </div>
</div>
