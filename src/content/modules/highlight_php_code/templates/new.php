<?php

$controller = ControllerRegistry::get ( "HighlightPHPCode" );

$acl = new ACL ();
if ($acl->hasPermission ( getModuleMeta ( "highlight_php_code", "admin_permission" ) )) {
	?>
<p>
	<a
		href="<?php echo ModuleHelper::buildAdminURL($controller->moduleName);?>"
		class="btn btn-default btn-back"><?php translate("back")?></a>
</p>
<?php echo ModuleHelper::buildMethodCallForm("HighlightPHPCode", "createCode");?>
<p>
	<strong><?php translate("name")?></strong><br /> <input type="text"
		name="name" maxlength="140" value="" required>
</p>
<!--  @FIXME: CodeMirror verwenden -->
<p>
	<strong><?php translate("code")?></strong><br />
	<textarea id="code" cols="80" rows="8" name="code"></textarea>
</p>
<button type="submit" class="btn btn-success"><?php translate("save");?></button>
</form>
<script type="text/javascript"
	src="<?php Template::escape(ModuleHelper::buildModuleRessourcePath("highlight_php_code", "js/backend.js"));?>"></script>
<?php
} else {
	noperms ();
}
?>
