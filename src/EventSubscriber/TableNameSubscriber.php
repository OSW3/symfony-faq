<?php 
namespace OSW3\Faq\EventSubscriber;

use OSW3\Faq\Entity\Faq;
use Doctrine\Common\EventSubscriber;
use OSW3\Faq\DependencyInjection\Configuration;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use OSW3\Faq\Entity\Category;
use OSW3\Faq\Entity\Tag;
use OSW3\Faq\Entity\Translation;
use OSW3\Faq\Entity\Vote;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TableNameSubscriber implements EventSubscriber
{
    protected array $config;

    public function __construct(
        #[Autowire(service: 'service_container')] 
        private ContainerInterface $container,
    ){
        $this->config = $container->getParameter(Configuration::NAME);
    }

    public function getSubscribedEvents(): array
    {
        return [
            'loadClassMetadata',
        ];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $args): void
    {
        $classMetadata = $args->getClassMetadata();
        $entityClass   = $classMetadata->getName();
        $tableNames    = $this->config['tables'];

        $tableName = match($entityClass) {
            Faq::class         => $tableNames['faq'],
            Category::class    => $tableNames['category'],
            Translation::class => $tableNames['translation'],
            Vote::class        => $tableNames['vote'],
            Tag::class         => $tableNames['tag'],
            default            => null,
        };

        if ($tableName) {
            $classMetadata->setPrimaryTable(['name' => $tableName]);
        }
    }
}
