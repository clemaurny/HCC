<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>
	<?php if( isset($myUser) ){ ?>
	<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#peripherique">P&eacute;ripheriques</a></li>
	<li><a href="#lieux">Lieux</a></li>
	<li><a href="#divers">Divers</a></li>
	<li><a href="#login">Logins</a></li>
	<!--<li><a href="#utilisateurs">Utilisateurs</a></li>-->
	</ul>
	 
	
	<div class="tab-content">
	<div class="tab-pane active" id="peripherique">

	<table class="table table-striped">
		<tr>
		<td>
		
		    <form class="form-horizontal" action="action.php?action=ADD_ENGINE" method="POST" enctype="multipart/form-data">
				<div class="control-group">
					<label class="control-label" for="inputEmail">P&eacute;riph&eacute;rique</label>
					<div class="controls">
					<input type="text" name="name" id="inputEmail" placeholder="P&eacute;riph&eacute;rique">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Code radio</label>
					<div class="controls">
					<input type="text" name="code" id="inputPassword" placeholder="Code radio">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="selectType">Type de contrôl</label>
					<div class="controls">
						<select id="selectType" name="selectType">
							<option value="prise">Prise</option>
							<option value="interrupteur">Interrupteur</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Heures moy/jours</label>
					<div class="controls">
						<input type="text" name="hoursMoy" placeholder="durée moyenne de fonctionnement">
					</div>

				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Image</label>
					
					
					

					<div class="controls">

						<input  name="picture" id="inputImg" type="file" style="display:none">
							<div class="input-append">
							   <input id="photoCover" placeholder="Image" class="input" type="text">
							   <a class="btn" onclick="$('input[id=inputImg]').click();">Parcourir</a>
							</div>
							 
					</div>

				</div>
				<div class="control-group">
				<label class="control-label"   for="inputPassword">Lieux</label>
				<div class="controls">
					<input class="span2" readonly="readonly" name="place" id="appendedDropdownButton" type="text">
					<input  name="idPlace"  type="hidden">
					<div class="btn-group">
					<button class="btn dropdown-toggle" data-toggle="dropdown">
					Pi&egrave;ce
					<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php $counter1=-1; if( isset($places) && is_array($places) && sizeof($places) ) foreach( $places as $key1 => $value1 ){ $counter1++; ?>
						<li style="cursor:pointer;">
							<a onclick="$('#appendedDropdownButton').val('<?php echo $value1['name'];?>');$('input[name=\'idPlace\']').val('<?php echo $key1;?>');"><?php echo $value1['name'];?></a>
						</li>
						<?php } ?>
					</ul>
					</div>
				</div>
				</div>
				<div class="clear"></div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Description</label>
					<div class="controls">
					<textarea rows="3" name="description" id="inputDescription"  placeholder="Description"></textarea>
					</div>
				</div>
				<div class="control-group">
                               	     <label class="control-label" for="inputPower">Puissance</label>
                                     <div class="controls">
					<input id="inputPower" name="power" placeholder="puissance appareils">
                                     </div>
				</div>
				    <div class="form-actions">
					<button type="submit" class="btn btn-primary">Enregistrer</button>
					<button type="button" class="btn">Annuler</button>
				    </div>
			</form>
		
		</td>
		<td>
		
			<table class="table table-striped  table-bordered">
				<?php $counter1=-1; if( isset($engines) && is_array($engines) && sizeof($engines) ) foreach( $engines as $key1 => $value1 ){ $counter1++; ?>
				<tr>
					<td><strong><?php echo $value1['name'];?></strong></td>
					<td><code><?php echo $places[$value1['place']]['name'];?></code></td>
					<td>
						<!--<a class="btn btn-info" href="./settings.php?engine=<?php echo $key1;?>"><i class="icon-edit icon-white"></i></a> -->
						<a class="btn btn-danger" href="./action.php?action=DELETE_ENGINE&amp;engine=<?php echo $key1;?>"><i class="icon-remove icon-white"></i></a>
					</td>
				</tr>
				
				<?php } ?>
			</table>
		
		</td>
		</tr>

	</table>
	
	</div>

	<div class="tab-pane" id="lieux">

	<table class="table table-striped">
		<tr>
		<td>
		
		    <form class="form-horizontal" action="action.php?action=ADD_PLACE" method="POST">
				<div class="control-group">
					<label class="control-label" for="inputPlace">Lieu</label>
					<div class="controls">
		
					<input type="text" name="place"  id="inputPlace" placeholder="Salle de bain">
					</div>
				</div>
				
				    <div class="form-actions">
					<button type="submit" class="btn btn-primary">Enregistrer</button>
					<button type="button" class="btn">Annuler</button>
					</div>
			</form>
		
		</td>
		<td>
		
			<table class="table table-striped  table-bordered">
				<?php $counter1=-1; if( isset($places) && is_array($places) && sizeof($places) ) foreach( $places as $key1 => $value1 ){ $counter1++; ?>
				<tr>
					<td><strong><?php echo $value1['name'];?></strong></td>
					<td>
						<!--<a class="btn btn-info" href="./setting.php?place=<?php echo $key1;?>"><i class="icon-edit icon-white"></i></a> -->
						<a class="btn btn-danger" href="./action.php?action=DELETE_PLACE&amp;place=<?php echo $key1;?>"><i class="icon-remove icon-white"></i></a>
					</td>
				</tr>
				
				<?php } ?>
			</table>
		
		</td>
		</tr>

	</table>
	
	</div>

	<div class="tab-pane" id="divers">
		<p>Si vous souhaitez utiliser la reconnaissance vocale en plus de cette interface, vous devez au préalable télécharger et installer <a href="http://domotique.idleman.fr/data/interface%20vocale/YURI.rar">le logiciel gratuit YURI</a> sur un ordinateur doté de windows vista ou supérieur. (toutes les explications <a href="http://blog.idleman.fr/?p=1788">ici</a>)</p>

		<p>Puis, téléchargez le xml de reconnaissance adapté a vos périphériques ici <div onclick="window.location='action.php?action=GET_YURI_XML';" class="btn btn-primary">Télécharger le XML</div></p>

		<p><strong>Nb:</strong> Le XML est à placer dans le repertoire <code>\macros\</code> de votre YURI</p>
	</div>

	<div class="tab-pane row" id="login">
		<div class="span-8">
			<form method="POST" action="action.php?action=ADD_LOGIN" name="newLogin" class="form-horizontal">
				<label>email :</label><input type="text" id="newEmail" name="newEmail" />
				<label>pass :</label><input type="text" id="newPass" name="newPass" />
				<input type="submit" value="ajouter" class="btn btn-primary" />
			</form>

		</div>
		<div class="span-4">
			<p>logins</p>
			<hr />
		<?php $counter1=-1; if( isset($logins) && is_array($logins) && sizeof($logins) ) foreach( $logins as $key1 => $value1 ){ $counter1++; ?>
			<p>login &nbsp; <?php echo $value1['email'];?>  
				<a class="btn btn-danger" href="./action.php?action=DELETE_LOGIN&amp;login=<?php echo $key1;?>"><i class="icon-remove icon-white"></i></a>
			
			</p>
			 
		<?php } ?>
		</div>
	</div>
	<!--<div class="tab-pane" id="utilisateurs">
		
	
	</div>-->
	<?php }else{ ?>
		Vous devez vous connecter pour controler cet espace
	  <?php } ?>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>
	  <script type="text/javascript">
	  
$('input[id=inputImg]').change(function() {
   $('#photoCover').val($(this).val());
});
</script>
