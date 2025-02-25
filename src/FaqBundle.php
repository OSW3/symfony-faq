<?php 
namespace OSW3\Faq;

use OSW3\Faq\DependencyInjection\Configuration;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FaqBundle extends Bundle
{
    public function build(ContainerBuilder $container): void {
        $projectDir = $container->getParameter('kernel.project_dir');
        (new Configuration)->generateProjectConfig($projectDir);
    }
}