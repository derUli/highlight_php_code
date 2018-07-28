<?php
// setup database tables
$migrator = new DBMigrator("module/highlight_php_code", ModuleHelper::buildModuleRessourcePath("highlight_php_code", "sql/up"));
$migrator->migrate();