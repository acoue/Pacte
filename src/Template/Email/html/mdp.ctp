<p>Bonjour, </p>
<p>Vous avez fait une demande de réinitialisation de mot de passe.</p>
<p>Pour effectuer cette opération suivez le lien : <?= $this->Html->link('Regénérer ce mot de passe', $link);?></p>
<p>
Si le lien ci-dessus ne fonctionne pas, copier / coller ce qui suit dans un navigateur : <br /><br />
<?= HTTP_ROOT."/".$link['controller']."/".$link['action']."?token=".$link['token'] ?>
</p>
<p>Cordialement.</p>

Merci ne pas répondre directement à ce message. 