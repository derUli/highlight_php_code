<?php
$controller = ControllerRegistry::get ( "HighlightPHPCode" );
$properties = $controller->getColorProperties ();
$acl = new ACL ();
if ($acl->hasPermission ( "highlight_php_code_settings" )) {
	?>
<p>
	<a
		href="<?php echo ModuleHelper::buildAdminURL($controller->moduleName);?>"
		class="btn btn-default btn-back"><?php translate("back")?></a>
</p>
<?php echo ModuleHelper::buildMethodCallForm("HighlightPHPCode", "saveSettings");?>
<?php

	foreach ( $properties as $property ) {
		$settingName = str_replace ( ".", "_", $property );
		$color = Settings::get ( $settingName ) !== false ? Settings::get ( str_replace ( ".", "/", $property ) ) : ini_get ( $property );
		
		?>

<p>
	<strong><?php esc($property);?></strong> <br /> <input
		name="<?php esc($settingName);?>"
		class="jscolor {hash:true,caps:true}" value="<?php esc($color);?>">
</p>
<?php } ?>
<p>
	<button type="submit" class="btn btn-primary"><?php translate("save");?></button>
</p>
<?php
	
	echo ModuleHelper::endForm ();
} else {
	noperms ();
}
?>