<?php
namespace OSW3\Faq\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use OSW3\Faq\Repository\TranslationRepository;

#[ORM\Entity(repositoryClass: TranslationRepository::class)]
class Translation
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
     * Translation language
     * 
     * @var string
     */

    #[ORM\Column(name: "`language`", type: Types::STRING, length: 2, nullable: false, options: ['fixed' => true])]
    private ?string $language = null;

    /**
     * Translated question
     * 
     * @var string
     */
    #[ORM\Column(name: "`question`", type: Types::TEXT, nullable: false)]
    private ?string $question = null;

    /**
     * Translated answer
     * 
     * @var string
     */
    #[ORM\Column(name: "`answer`", type: Types::TEXT, nullable: false)]
    private ?string $answer = null;


    // RELATIONS
    // --

    // ManyToOne

    #[ORM\ManyToOne(inversedBy: 'translations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Faq $faq = null;

    
    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setLanguage(string $language): static
    {
        $this->language = $language;

        return $this;
    }
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }
    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setAnswer(string $answer): static
    {
        $this->answer = $answer;

        return $this;
    }
    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function getFaq(): ?Faq
    {
        return $this->faq;
    }

    public function setFaq(?Faq $faq): static
    {
        $this->faq = $faq;

        return $this;
    }
}
