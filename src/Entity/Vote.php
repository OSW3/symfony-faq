<?php
namespace OSW3\Faq\Entity;

use OSW3\Faq\Enum\VoteType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use OSW3\Faq\Repository\VoteRepository;

#[ORM\Entity(repositoryClass: VoteRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Vote
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
     * Like or dislike
     * 
     * @var VoteType
     */
    #[ORM\Column(name: "`vote`", type: Types::SMALLINT, nullable: false, enumType: VoteType::class)]
    private ?VoteType $vote = null;


    // DATES
    // --

    /**
     * The creation datetime
     * 
     * @var \DateTimeImmutable
     */
    #[ORM\Column(name: "`datetime_create`", type: Types::DATETIME_IMMUTABLE, nullable: false)]
    private ?\DateTimeImmutable $createAt = null;


    // RELATIONS
    // --

    // ManyToOne

    #[ORM\ManyToOne(inversedBy: 'votes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Faq $question = null;

    
    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setVote(VoteType $vote): static
    {
        $this->vote = $vote;

        return $this;
    }
    public function getVote(): ?VoteType
    {
        return $this->vote;
    }

    #[ORM\PrePersist]
    public function setCreateAt(): static
    {
        $this->createAt = new \DateTimeImmutable;

        return $this;
    }
    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function getQuestion(): ?Faq
    {
        return $this->question;
    }

    public function setQuestion(?Faq $question): static
    {
        $this->question = $question;

        return $this;
    }
}
