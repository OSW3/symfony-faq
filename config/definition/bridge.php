<?php 

use Symfony\Component\Filesystem\Path;
use OSW3\Faq\DependencyInjection\DefinitionConfigurator;

return static function (DefinitionConfigurator $configurator): void {
    $definition = require Path::join(__DIR__, "definition.php");
    $definition($configurator);
};