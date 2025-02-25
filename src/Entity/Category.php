<?php
namespace OSW3\Faq\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use OSW3\Faq\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
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
     * The name of the category
     * 
     * @var string
     */
    #[ORM\Column(name: "`name`", type: Types::STRING, length: 80, nullable: false)]
    private ?string $name = null;

    /**
     * The slug 
     * 
     * @var string
     */
    #[Gedmo\Slug(fields: ['name'])]
    #[ORM\Column(name: "`slug`", type: Types::STRING, length: 80, nullable: false)]
    private ?string $slug = null;


    // RELATIONS
    // --

    // OneToMany

    /**
     * @var Collection<int, Faq>
     */
    #[ORM\OneToMany(targetEntity: Faq::class, mappedBy: 'category')]
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

    // public function setSlug(string $slug): static
    // {
    //     $this->slug = $slug;

    //     return $this;
    // }
    public function getSlug(): ?string
    {
        return $this->slug;
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
            $question->setCategory($this);
        }

        return $this;
    }

    public function removeQuestion(Faq $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getCategory() === $this) {
                $question->setCategory(null);
            }
        }

        return $this;
    }
}
