<?php

namespace App\Form;

use App\Entity\SignRule;
use App\Enum\MetadataEnumSign;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignRuleType extends AbstractType
{
    final public const OPERATOR_AND = 'and';
    final public const OPERATOR_OR = 'or';

    final public const OPERATOR_EQUAL = 'eq';
    final public const OPERATOR_NOT_EQUAL = 'neq';
    final public const OPERATOR_GREATER = 'gt';
    final public const OPERATOR_GREATER_OR_EQUAL = 'gte';
    final public const OPERATOR_LOWER = 'lt';
    final public const OPERATOR_LOWER_OR_EQUAL = 'lte';

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $metadataChoices = [];
        foreach (MetadataEnumSign::cases() as $case) {
            $metadataChoices[$case->name] = $case;
        }

        $builder
            ->add('glueOperator', ChoiceType::class, [
                'choices' => [
                    'AND' => self::OPERATOR_AND,
                    'OR' => self::OPERATOR_OR,
                ],
                'required' => true,
                'placeholder' => false,
            ])
            ->add('metadata', ChoiceType::class, [
                'choices' => $metadataChoices,
                'required' => true,
                'placeholder' => false,
            ])
            ->add('comparisonOperator', ChoiceType::class, [
                'choices' => [
                    '=' => self::OPERATOR_EQUAL,
                    '!=' => self::OPERATOR_NOT_EQUAL,
                    '>' => self::OPERATOR_GREATER,
                    '>=' => self::OPERATOR_GREATER_OR_EQUAL,
                    '<' => self::OPERATOR_LOWER,
                    '<=' => self::OPERATOR_LOWER_OR_EQUAL,
                ],
            ])
            ->add('value', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('excludeFromGeneration', CheckboxType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SignRule::class,
        ]);
    }
}
