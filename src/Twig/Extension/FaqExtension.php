<?php 
namespace OSW3\Faq\Twig\Extension;

use OSW3\Faq\Twig\Runtime\FaqExtensionRuntime as RuntimeFaqExtensionRuntime;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class FaqExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('getFaqQuestions', [RuntimeFaqExtensionRuntime::class, 'getFaqQuestions']),
        ];
    }
}