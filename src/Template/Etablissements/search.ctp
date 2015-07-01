<table cellpadding="0" cellspacing="0" class="table table-striped">
    <thead>
        <tr align='center'>
            <th>Libellé</th>
            <th>FINESS</th>
            <th>Numéro de démarche</th>
            <th>Niveau de certification</th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
   <?php foreach ($etablissements as $etablissement): ?>
        <tr>
            <td><?= h($etablissement->libelle) ?></td>
            <td><?= h($etablissement->finess) ?></td>
            <td><?= h($etablissement->numero_demarche) ?></td>
            <td><?= h($etablissement->niveau_certification) ?></td>
            <td class="actions">
<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['action' => 'view', $etablissement->id], ['title'=>'Visualiser','escape' => false]); ?>&nbsp;&nbsp;
<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $etablissement->id], ['title'=>'Editer','escape' => false]); ?>&nbsp;&nbsp;     
<?= $this->Form->postLink(
                '<span><i class="glyphicon glyphicon-trash"></i></span>',
                ['action' => 'delete', $etablissement->id],
                ['class' => 'tip', 'escape'   => false, 'title'=>'Supprimer','confirm'  => 'Etes-vous sûr de supprimer l\'établissement?']);?>
          </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>