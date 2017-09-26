<?php

namespace MI\BilletterieBundle\Form;

use Symfony\Component\DependencyInjection\Tests\Compiler\C;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BilletType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',            TextType::class)
            ->add('prenom',         TextType::class)
            ->add('email',          EmailType::class)
            ->add('age',            BirthdayType::class)
            ->add('type',           ChoiceType::class, array('choices' => array(
                'Journée' => 'J',
                'Demi-Journée' => 'DJ'),
                'choices_as_values' => true))
            ->add('reduc',          CheckboxType::class, array(
                'label' => 'Tarif réduit',
                'required' => false))
            ->add('Commande')
            ->add('save', SubmitType::class, array('label' => 'Valider'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MI\BilletterieBundle\Entity\Billet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mi_billetteriebundle_billet';
    }


}
