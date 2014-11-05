<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>

<!--
 @nom: index
 @auteur: Idleman (idleman@idleman.fr)
 @description: Page d'accueil
-->

<?php if( isset($myUser) ){ ?>
<p class="ipAddress">Bienvenue <?php echo $myUser['login'];?></p>	
<p> </p>
<ul class="nav nav-tabs" id="myTab">
<?php $first=$this->var['first']=0;?>
<?php $counter1=-1; if( isset($places) && is_array($places) && sizeof($places) ) foreach( $places as $key1 => $value1 ){ $counter1++; ?>
<li class="<?php if( $first==0 ){ ?><?php $first=$this->var['first']=1;?>active<?php } ?>"><a href="#<?php echo $key1;?>"><?php echo $value1['name'];?></a></li>
<?php } ?>




</ul>
 
<div class="tab-content">
<?php $first=$this->var['first']=0;?>
<?php $counter1=-1; if( isset($places) && is_array($places) && sizeof($places) ) foreach( $places as $key1 => $value1 ){ $counter1++; ?>
<?php $currentPlace=$this->var['currentPlace']=$key1;?>
<div class="tab-pane <?php if( $first==0 ){ ?><?php $first=$this->var['first']=1;?>active<?php } ?>" id="<?php echo $key1;?>">

      <div class="row">


<?php $counter2=-1; if( isset($engines) && is_array($engines) && sizeof($engines) ) foreach( $engines as $key2 => $value2 ){ $counter2++; ?>

	<?php if( $value2['place']==$currentPlace ){ ?>
	
<div class="span3">
          <h5><?php echo $value2['name'];?></h5>
		  <a class="thumbnail" href="#"><img src="./templates/hcc/../../<?php echo $value2['picture'];?>"></a>
		   <br/>
		  <p><span class="glyphicon glyphicon-dashboard"> <?php echo $value2['type'];?></span></p>
		  <p><?php echo $value2['description'];?>
		  	<ul>
		  		<li>Code radio : <code><?php echo $value2['code'];?></code></li>
		  		<li>Id : <code><?php echo $key2;?></code></li>
		  		<li>Emplacement : <code><?php echo $places[$value2['place']]['name'];?></code></li>
		  	</ul>
		  </p>
		  	 <div class="btn-toolbar">
				<div class="btn-group">
				<a class="btn <?php if( $value2['state']=='on' ){ ?>btn-success<?php } ?>" href="action.php?engine=<?php echo $key2;?>&amp;action=CHANGE_STATE&amp;code=<?php echo $value2['code'];?>&amp;state=on"><span class="glyphicon glyphicon-ok <?php if( $value2['state']=='on' ){ ?>icon-white<?php } ?>"></span></a>
				<a class="btn <?php if( $value2['state']=='off' ){ ?>btn-danger<?php } ?>" href="action.php?engine=<?php echo $key2;?>&amp;action=CHANGE_STATE&amp;code=<?php echo $value2['code'];?>&amp;state=off&amp;CURRENT_STATE=<?php echo $value2['state'];?>"><span class="glyphicon glyphicon-off <?php if( $value2['state']=='off' ){ ?>icon-white<?php } ?>"></span></a>
				</div>
			</div>
        </div>
        <?php } ?>
<?php } ?>
		<div class="span4" id="infoConso">
			<p>Fonctionne depuis <?php echo $duration;?></p>
			<p><span class="glyphicon glyphicon-asterisk">Consommation : <?php echo $consommation;?> kWh</span></p>
		</div>
      </div>



</div>

<?php } ?>

</div>

	  <?php }else{ ?>
		Vous devez vous connecter pour controler cet espace
	  <?php } ?>
<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>
