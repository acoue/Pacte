<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Parametres'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="parametres form large-10 medium-9 columns">
    <?= $this->Form->create($parametre); ?>
    <fieldset>
        <legend><?= __('Add Parametre') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('valeur');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
