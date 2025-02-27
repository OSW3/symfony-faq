<?php 
namespace OSW3\Faq\Services;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\RequestStack;

class LanguagesService
{
    public function __construct(
        #[Autowire('%kernel.enabled_locales%')] 
        private $enabledLocales,
        private RequestStack $requestStack,
        private ?TranslatorInterface $translator = null,
    ){}

    public function getLanguages() {
        $languages = [];
        $default   = $this->translator?->getLocale();
        $current   = $this->requestStack->getCurrentRequest()->getDefaultLocale();

        $languages  = array_merge($languages, $this->enabledLocales);
        if ($default) array_push($languages, $default);
        if ($current) array_push($languages, $current);

        sort($languages);
        return array_unique($languages);
    }
}