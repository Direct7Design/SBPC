<!DOCTYPE html>
<html>
<head>
<title><?php echo $title_for_layout?> | SpaceBukkit by XereoNet | Bukkit Web Administration</title>

<!-- CSS -->
<link rel="stylesheet" href="<?php echo $this->webroot; ?>css/import.css" /> 

<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Load theme -->
<link rel="stylesheet" href="<?php echo $this->webroot; ?>themes/<?php echo $current_theme?>/css/theme.css" /> 

<!-- Load Jquery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $this->webroot; ?>js/script.js"></script> 
<script src="<?php echo $this->webroot; ?>js/selectivizr.min.js"></script> 

</head>

<body>
<div class="screen_overlay">
 <div>text...</div>
</div>
<?php if((isset($spacebukkitbuildready)) && ($user_perm['is_super'] == 1)) {?>
<div class="top_message black slideDown">
<p><?php echo __('A new SpaceBukkit update is ready for you to download! Your version is'); ?> <strong><?php echo $spacebukkitbuildcurrent; ?></strong> <?php echo __('while the new version is'); ?> <strong><?php echo $spacebukkitbuildfile; ?></strong> &nbsp; &nbsp;  <a class="button icon arrowright" href="<?php ?>"><?php echo __('Click here to get it'); ?></a></p>
</div>
<?php };?>

<?php if(isset($antmessage)) {?>
<div class="top_message <?php echo $antmessagetype; ?> slideDown">
<p><?php echo $antmessage; ?></p>
</div>
<?php };?>

</div>
	<div id="header">
		<div id="container"> 
			<a class="trigger" href="#"></a>

			<!-- Logo -->
			<div class="hheight"> 

				<!-- Logo -->
				<div class="col left col_1_3">
				<h1 id="logo">SpaceBukkit</h1>
				</div>
				<!-- Upper Bar -->
				<div id="upperbar" class="col right">
					<div id="serverbox">
						<span class="dropdown_servers tip"><p><a href="#"><?php echo $current_server_name; ?></a></p></span>
						<div class="tooltip white server_add_to_list" style="max-width: 190px">
							<ul>
								<?php 

					//get all servers and display them nicely :)

					if ($is_super = 1) {

					//if superuser
					
					foreach ($all_servers as $list) {

						$title = $list['Server']['title'];
						$id = $list['Server']['id'];

								echo <<<END
									<li><a href="./global/setserver/$id">$title</a></li>
END;
					}
										
					} else {

					//if not superuser
					
					foreach ($user_data as $list) {

						$title = $list['Server']['title'];
						$id = $list['Server']['id'];

								echo <<<END
									<li><a href="./global/setserver/$id">$title</a></li>
END;
					}
 }


								?>	
							</ul>
						</div>

					</div>
					
					<!-- Start/Stop, Reload, Message, Logout -->

					<div id="serverbuttons"> 

					</div>
					<div id="userbuttons">
						
						<span><a href="#" class="account tip"><?php echo __('Welcome aboard'); ?>, <?php echo $username; ?> </a></span>
						<div class="tooltip white">
							<ul>
								<li><a href="./users/settings" class="fancy"><?php echo __('Account Settings'); ?></a></li>
								<li><a href="./users/theme" class="fancy"><?php echo __('SpaceBukkit Theme'); ?></a></li>
								<li><a href="./users/logout"><?php echo __('Logout'); ?></a></li>
							</ul>
						</div>

						
					</div>
				</div>
			</div>


			<!-- Main Content Start -->
			<div id="wrapper"> 
			
					<!-- Navigation -->
					<nav id="mainnav">
						<ul>
					        <li class="bounce fadein floatright"> <a href="./tsettings"> <span class="icon settings"></span> <?php echo __('Settings'); ?> </a> </li>
						</ul>
					</nav>
					<!-- End Navigation --> 

					<!-- Tabs -->
					<nav id="smalltabs">
					</nav>
					<!-- End Tabs -->

					<div class="colorbox red">
					    <h3><?php echo __('Server was not reached! Maybe it crashed, maybe the ports are not open. Who knows? You should. Go fix it!'); ?></h3> 
					</div>
				
						</div>
			<!-- End #wrapper --> 
			
		</div>
		<!-- End #container --> 

	<!-- Import JS -->
	<script src="<?php echo $this->webroot; ?>js/ttw-simple-notifications-min.js"></script> 
	<script src="<?php echo $this->webroot; ?>js/excanvas.js"></script> 
	<script src="<?php echo $this->webroot; ?>js/jquery.uniform.min.js"></script> 
	<script src="http://tab-slide-out.googlecode.com/files/jquery.tabSlideOut.v1.3.js"></script>
	<script src="<?php echo $this->webroot; ?>js/jquery.livesearch.js"></script>
	<script src="<?php echo $this->webroot; ?>js/jquery.visualize.js"></script> 
	<script src="<?php echo $this->webroot; ?>js/jquery.validate.min.js"></script> 	
	<script src="<?php echo $this->webroot; ?>js/jquery.datatables.js"></script>
	<script src="<?php echo $this->webroot; ?>js/reload_dtb.js"></script>
	<script src="<?php echo $this->webroot; ?>js/ajax.js"></script> 
	<script src="<?php echo $this->webroot; ?>js/jquery.placeholder.js"></script> 
	<script src="<?php echo $this->webroot; ?>js/jquery.tools.min.js"></script> 
	<script src="<?php echo $this->webroot; ?>js/jquery.colorbox-min.js"></script>
	<?php 
if (isset($doodle)) {
?>
<script>
$(document).ready(function() {
var doodle = "url(<?php echo $doodle; ?>)";
$("#logo").css("background-image", doodle);  

});
</script>

<?php 
}
?>
	</body>
</html>
