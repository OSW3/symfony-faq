<?php 
namespace OSW3\Faq\Twig\Runtime;

use OSW3\Faq\Entity\Faq;
use OSW3\Faq\Enum\VoteType;
use Doctrine\Persistence\ManagerRegistry;
use Twig\Extension\RuntimeExtensionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FaqExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private ManagerRegistry $doctrine,
        private ParameterBagInterface $parameters
    ) {}

    public function getFaqQuestions(string $language): array 
    {
        $repository = $this->doctrine->getRepository(Faq::class);
        $entities   = $repository->findAll();

        $results = [];

        foreach ($entities as $entity) {

            $id       = $entity->getId();
            $category = $entity->getCategory()->getName();
            $tags     = $entity->getTags()->map(fn($tag) => $tag->getName())->toArray();

            $votes     = $entity->getVotes();
            $question = null;
            $answer   = null;
            $upvotes   = 0;
            $downvotes = 0;


            foreach ($votes as $vote) {
                if ($vote->getVote() == VoteType::UPVOTE) {
                    $upvotes++;
                }
                else if ($vote->getVote() == VoteType::DOWNVOTE) {
                    $downvotes++;
                }
            }
            // $questions = [];

            foreach ($entity->getTranslations() as $translation) {

                // if ($language == null) {
                //     array_push($questions, [
                //         'language' => $translation->getLanguage(),
                //         'question' => $translation->getQuestion(),
                //         'answer'   => $translation->getAnswer(),
                //     ]);
                // }
                // else 
                if ($language == $translation->getLanguage()) {
                    $question = $translation->getQuestion();
                    $answer   = $translation->getAnswer();
                }
            }

            array_push($results, [
                'id'        => $id,
                'category'  => $category,
                'tags'      => $tags,
                'question'  => $question,
                'answer'    => $answer,
                'upvotes'   => $upvotes,
                'downvotes' => $downvotes,
            ]);
        }
        
        return $results;
    }
}