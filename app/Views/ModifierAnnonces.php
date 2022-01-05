<script> 
				function display()
				{	
					if (document.getElementById('ind').checked)
					{
						document.getElementById("fioul").style.display = "inline";
						document.getElementById("electrique").style.display = "inline";
						document.getElementById("gaz").style.display = "inline";
						document.getElementById("f").style.display = "inline";
						document.getElementById("e").style.display = "inline";
						document.getElementById("g").style.display = "inline";
					}
					else
					{
						document.getElementById("fioul").style.display = "none";
						document.getElementById("electrique").style.display = "none";
						document.getElementById("gaz").style.display = "none";
						document.getElementById("f").style.display = "none";
						document.getElementById("e").style.display = "none";
						document.getElementById("g").style.display = "none";
						document.getElementById("fioul").checked = false;
						document.getElementById("electrique").checked = false;
						document.getElementById("gaz").checked = false;
					}			
				}
			</script>

<form method = "post" enctype="multipart/form-data">
	<fieldset>
		<legend>Location </legend>
		<label> Titre : </label><br /> <input type ="text" name="mtitre" value="<?=esc($annonce->A_titre)?>" required /><br>
		<label> Coût mensuel de location : </label> <br /> <input type ="number" name="mlocation" value="<?=esc($annonce->A_cout_loyer)?>" required /><br>
        <label> Coût éventuel des charges : </label><br />	<input type ="number" name="mcharges" value="<?=esc($annonce->A_cout_charges)?>"/><br>
		<label> Nombre de pièces : </label> <br />
		<select name="logement" value="<?=esc($annonce->T_typeMaison)?>">
			<option value="T1"> Une pièce</option>
			<option value="T2"> Deux pièces</option>
			<option value="T3"> Trois pièces</option>
			<option value="T4"> Quatre pièces</option>
			<option value="T5"> Cinq pièces</option>
		</select> <br/>
		<label> Superficie </label> <br /> <input type ="text" name="msuperficie" value="<?=esc($annonce->A_superficie)?>"/> <br>
		<label> Type de chauffage : </label> <br>
		
		
		<label>Collectif</label> <input type="radio" name="mchauffage" value="Collectif" id="col" onchange="display()"/> <br/>
		
		<label>Individuel</label>  <input type="radio" name="mchauffage" value="Individuel" id="ind" onchange="display()"/><br/>
		
		<label id="f">Fioul</label>	<input type="radio" name="mindividuel" value="Fioul" id="fioul"/> 
		<br />
		
		<label id="e">Electrique</label> <input type="radio" name="mindividuel" value="Electrique" id="electrique"/> 
				 <br />
        <label id="g">Gaz</label> <input type="radio" name="mindividuel" value="Gaz" id="gaz"/> <br />
		
		<label> Adresse : </label> <input type ="text" name="madresse" value="<?=esc($annonce->A_adresse)?>"/> <br />
		<label> Ville </label> <input type ="text" name="mville" value="<?=esc($annonce->A_ville)?>"/> <br />
		<label> CP </label> <input type ="text" name="mCP" value="<?=esc($annonce->A_CP)?>"/> <br />
		<!--<label for="pictures"> Photos : </label> <input type="file" class="form-control" name="images[]" accept="image/*" multiple> <br/>-->
		<label for="pictures"> Photo 1 : </label> <input type="file" class="form-control" name="mimage1" accept="image/*">
		<label for="pictures"> Photo 2 : </label> <input type="file" class="form-control" name="mimage2" accept="image/*">
		<label for="pictures"> Photo 3 : </label> <input type="file" class="form-control" name="mimage3" accept="image/*">
		<label for="pictures"> Photo 4 : </label> <input type="file" class="form-control" name="mimage4" accept="image/*">
		<label for="pictures"> Photo 5 : </label> <input type="file" class="form-control" name="mimage5" accept="image/*">
		<label for="form-msg">Entrez votre commentaire :</label><br/>
		<textarea id="form-msg" name="mdescription" cols="35" rows="5" placeholder ="Entrez votre description ici" value="<?=esc($annonce->A_description)?>"></textarea><br/>
		
        <p><input type="submit" value="Valider" name="formulaire" />
			<input type="reset" value="Effacer"/></p>
		<p> * <i> Champs obligatoires </i> </p>
			
	</fieldset>
</form>
