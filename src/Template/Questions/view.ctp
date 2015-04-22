<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reponses'), ['controller' => 'Reponses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reponse'), ['controller' => 'Reponses', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="questions view large-10 medium-9 columns">
    <h2><?= h($question->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($question->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($question->id) ?></p>
            <h6 class="subheader"><?= __('Ordre') ?></h6>
            <p><?= $this->Number->format($question->ordre) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Texte') ?></h6>
            <?= $this->Text->autoParagraph(h($question->texte)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Texte Aide') ?></h6>
            <?= $this->Text->autoParagraph(h($question->texte_aide)); ?>

        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Reponses') ?></h4>
    <?php if (!empty($question->reponses)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Libelle') ?></th>
            <th><?= __('Question Id') ?></th>
            <th><?= __('Demarche Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($question->reponses as $reponses): ?>
        <tr>
            <td><?= h($reponses->id) ?></td>
            <td><?= h($reponses->libelle) ?></td>
            <td><?= h($reponses->question_id) ?></td>
            <td><?= h($reponses->demarche_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Reponses', 'action' => 'view', $reponses->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Reponses', 'action' => 'edit', $reponses->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reponses', 'action' => 'delete', $reponses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reponses->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
