<?php
class HighlightPHPCode extends Controller {
	public $moduleName = "highlight_php_code";
	public function getSettingsLinkText() {
		return get_translation ( "edit" );
	}
	public function getSettingsHeadline() {
		return "Highlight PHP Code";
	}
	public function settings() {
		// List of Code Snippets
		ViewBag::set ( "datasets", PHPCode::getAll () );
		return Template::executeModuleTemplate ( $this->moduleName, "list.php" );
	}
	public function saveSettingsPost() {
		$properties = $this->getColorProperties ();
		
		// Save color settings
		foreach ( $properties as $property ) {
			$settingName = str_replace ( ".", "/", $property );
			$paramName = str_replace ( ".", "_", $property );
			$value = Request::getVar ( $paramName );
			if ($value) {
				Settings::set ( $settingName, $value );
			} else {
				Settings::delete ( $settingName );
			}
		}
		// Redirect to Code List
		Response::redirect ( ModuleHelper::buildAdminURL ( $this->moduleName ) );
	}
	// The names of php.ini settings for code highlighting
	public function getColorProperties() {
		return array (
				"highlight.comment",
				"highlight.default",
				"highlight.html",
				"highlight.keyword",
				"highlight.string" 
		);
	}
	public function afterInit() {
		$properties = $this->getColorProperties ();
		// Set colors for syntax highlighting
		foreach ( $properties as $property ) {
			$color = Settings::get ( str_replace ( ".", "/", $property ) );
			if (is_string ( $color )) {
				ini_set ( $property, $color );
			}
		}
	}
	public function contentFilter($html) {
		// replace [code id=123] placeholders with highlighted code++++
		preg_match_all ( "/\[code id=([0-9]+)]/i", $html, $match );
		if (count ( $match ) > 0) {
			for($i = 0; $i < count ( $match [0] ); $i ++) {
				$placeholder = $match [0] [$i];
				$id = intval ( unhtmlspecialchars ( $match [1] [$i] ) );
				$code = new PHPCode ( $id );
				$code = $code->getCode ();
				$codeHTML = '<div class="highlighted-php-code" id="highlighted-php-code-' . $id . '">';
				$codeHTML .= highlight_string ( $code, true );
				$codeHTML .= '</div>';
				$html = str_replace ( $placeholder, $codeHTML, $html );
			}
		}
		return $html;
	}
	public function createCode() {
		if (Request::hasVar ( "name" ) and Request::hasVar ( "code" )) {
			$ds = new PHPCode ();
			$ds->setName ( Request::getVar ( "name" ) );
			$ds->setCode ( Request::getVar ( "code" ) );
			$ds->save ();
		}
		Request::redirect ( ModuleHelper::buildAdminURL ( $this->moduleName ) );
	}
	public function editCode() {
		if (Request::hasVar ( "name" ) and Request::hasVar ( "code" ) and Request::hasVar ( "name" )) {
			$ds = new PHPCode ( Request::getVar ( "id", null, "int" ) );
			if ($ds->getID ()) {
				$ds->setName ( Request::getVar ( "name" ) );
				$ds->setCode ( Request::getVar ( "code" ) );
				$ds->save ();
			}
		}
		Request::redirect ( ModuleHelper::buildAdminURL ( $this->moduleName ) );
	}
	public function deleteCode() {
		if (Request::hasVar ( "id" )) {
			$code = new PHPCode ( Request::getVar ( "id", null, "int" ) );
			$code->delete ();
		}
		Request::redirect ( ModuleHelper::buildAdminURL ( $this->moduleName ) );
	}
	// remove codes on uninstall
	public function uninstall() {
		$migrator = new DBMigrator ( "module/" . $this->moduleName, ModuleHelper::buildModuleRessourcePath ( $this->moduleName, "sql/down" ) );
		$migrator->rollback ();
	}
}