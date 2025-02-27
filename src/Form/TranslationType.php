<?php
namespace OSW3\Faq\Form;

use OSW3\Faq\Entity\Faq;
use OSW3\Faq\Entity\Tag;
use OSW3\Faq\Entity\Translation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $languages = $options['languages'] ?? [];

        $builder
            ->add('language', ChoiceType::class, [
                'label' => "Translation Language",
                'required' => true,
                'choices' => array_flip($languages),
                // 'constraints' => [
                //     new NotBlank(['message' => "Language is required"])
                // ],
            ])
            ->add('question', TextType::class, [
                'label' => "Translation question",
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => "question is required"])
                ],
            ])
            ->add('answer', TextType::class, [
                'label' => "Translation answer",
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => "answer is required"])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Translation::class,
            'languages' => [],
        ]);
    }
}
