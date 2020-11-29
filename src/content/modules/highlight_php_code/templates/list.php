<?php
$acl = new ACL ();
?>
<div class="row">
	<div class="col-xs-6">
		<p>
			<a href="<?php echo ModuleHelper::buildActionURL("code_new");?>"
				class="btn btn-default"><i class="fa fa-plus"></i> <?php translate("new");?></a>
		</p>
	</div>
	<div class="col-xs-6 text-right">
	<?php
	if ($acl->hasPermission ( "highlight_php_code_settings" )) {
		?>

		<p>
			<a href="<?php echo ModuleHelper::buildActionURL("code_settings");?>"
				class="btn btn-default"><i class="fas fa-wrench"></i> <?php translate("settings");?></a>
		</p>
		<?php }?>
	</div>
</div>
<table class="tablesorter">
	<thead>
		<tr>
			<th><?php translate("id");?></th>
			<th><?php translate("name");?></th>
			<td><strong><?php translate("shortcode");?></strong></td>
			<td></td>
			<td></td>
		</tr>
	</thead>
	<?php $data = is_array(ViewBag::get("datasets")) ? ViewBag::get("datasets") : array(); ?>
	<tbody>
	<?php foreach($data as $ds){?>
		<tr>
			<!-- @FIXME: Inline-Javascripts in externe Datei auslagern. -->
			<td><?php Template::escape($ds->getId());?></td>
			<td><?php Template::escape($ds->getName());?></td>
			<td><input type="text" onclick="this.select();"
				value="[code id=<?php Template::escape($ds->getId());?>]" readonly></td>
			<td class="text-center"><a
				href="<?php echo ModuleHelper::buildActionURL("code_edit", "id=".$ds->getId());?>"><img
					src="gfx/edit.png" alt="<?php translate("edit");?>"></a></td>
			<td class="text-center">
				<!--  @FIXME: Sicherheitsabfrage beim Löschen einbauen -->
				<div class="delete-form-container"><?php
		
		echo ModuleHelper::buildMethodCallForm ( "HighlightPHPCode", "deleteCode" );
		?> <input type="hidden" name="id"
						value="<?php Template::escape($ds->getId())?>"> <input
						type="image" alt="<?php translate("delete")?>"
						src="gfx/delete.png">
				<?php echo ModuleHelper::endForm();?>
				</div>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>
</form>
<?php
$translation = new JSTranslation ();
$translation->addKey ( "ask_for_delete" );
$translation->renderJS ();
?>
<script type="text/javascript"
	src="<?php Template::escape(ModuleHelper::buildModuleRessourcePath("highlight_php_code", "js/backend.js"));?>"></script>
