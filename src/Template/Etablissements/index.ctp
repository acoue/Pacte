<div class="blocblanc">
	<h2>Administration</h2>
    <h3>Etablissement</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
			<?= $this->Form->create(NULL); ?>
				<div class="row">
                	<label class="col-md-4 control-label" for="libelle">Entrez un Libellé pour la recherche : </label>
                    <div class="col-md-5"><?= $this->Form->input('libelle', ['label' => false,'id'=>'libelle',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text']); ?>
                    </div> 
                    <div class="col-md-3"></div>                         
				</div><br />  
			
			<?= $this->Form->end() ?>
				<div id="listeDiv"></div>
			
			
			
				
					
				</div>						
			<div class="col-md-1"></div>
		</div>
		<p align="center">
			<?= $this->Html->link(__('Ajouter un établissement'), ['action' => 'add'], ['class'=>'btn btn-default']) ?>
		</p>
	</div>
</div>




<?php $this->append('script');?>
	<script>
	$(function () {

		$("#libelle").bind('input', function () {
            $.ajax({
                url: "<?= $this->Url->build(['controller'=>'etablissements','action'=>'search'])?>",
                data: {
                    libelle: $("#libelle").val()
                },
                length: 3,
                dataType: 'html',
                type: 'post',
                success: function (html) {
                    $("#listeDiv").html(html);
                }
            })
        });
		
	});
	</script>
<?php $this->end();?>