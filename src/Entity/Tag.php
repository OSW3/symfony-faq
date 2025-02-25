<?php
namespace OSW3\Faq\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use OSW3\Faq\Repository\TagRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    // ID's
    // --
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    // INFOS
    // --

    /**
     * The name of the tag
     * 
     * @var string
     */
    #[ORM\Column(name: "`name`", type: Types::STRING, length: 80, nullable: false)]
    private ?string $name = null;


    // RELATIONS
    // --

    // ManyToMany

    /**
     * @var Collection<int, Faq>
     */
    #[ORM\ManyToMany(targetEntity: Faq::class, inversedBy: 'tags')]
    #[ORM\JoinTable(name: "faq_tags_relations")]
    private Collection $questions;

    
    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Faq>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Faq $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
        }

        return $this;
    }

    public function removeQuestion(Faq $question): static
    {
        $this->questions->removeElement($question);

        return $this;
    }
}
