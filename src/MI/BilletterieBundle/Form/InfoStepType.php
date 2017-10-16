<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 14/10/2017
 * Time: 12:25
 */

namespace MI\BilletterieBundle\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class InfoStepType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Billet', CollectionType::class, array(
                'validation_groups' => false,
                'label' => false,
                'constraints' => [
                    new Assert\Valid(),
                ],
                'entry_type' => BilletType::class,
                'entry_options' => array('label' => false),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mi\BilletterieBundle\Entity\Commande', 'validation_groups' => 'billet'
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