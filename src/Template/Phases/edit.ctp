<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $phase->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $phase->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Phases'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="phases form large-10 medium-9 columns">
    <?= $this->Form->create($phase); ?>
    <fieldset>
        <legend><?= __('Edit Phase') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
