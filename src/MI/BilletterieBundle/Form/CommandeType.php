<?php

namespace MI\BilletterieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NbBillet',       ChoiceType::class, array(
             'choices' => array(
                 '1' => 1,
                 '2' => 2,
                 '3' => 3,
                 '4' => 4,
                 '5' => 5,
                 '6' => 6,
                 '7' => 7,
                 '8' => 8,
                 '9' => 9,
                 '10'=>10,
            ),
           ))
            ->add('dateEntree',     DateTimeType::class)
            ->add('save',           SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MI\BilletterieBundle\Entity\Commande'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mi_billetteriebundle_commande';
    }


}
