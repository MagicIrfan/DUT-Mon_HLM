
	<form method="post">
		<div>
			<h3 class="text-left" id="MailDestinataire" style="margin-bottom: 15px;">Destinataire : <?=esc($pseudoquelconque)?> </h3><input class="d-flex" type="text" name="objet" placeholder = "Objet"><div class="areacontainer">
			<div class="comment">
				<textarea class="textinput" rows="5" cols="200" type="text" name="message" placeholder="Message"></textarea>
			</div>
		</div><div class="areacontainer"><button class="btn btn-primary" type="submit">Envoyer</button><button class="btn btn-primary" id="EffacerBouton" type="reset">Effacer</button>
		</div>
	</form>
