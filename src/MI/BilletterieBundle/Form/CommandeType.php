<?php

namespace MI\BilletterieBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContext;
use MI\BilletterieBundle\Entity\Commande;

class CommandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NbBillet',       ChoiceType::class, array(
             'required' => true,
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
            ->add('dateEntree',     DateType::class, array(
                'attr' => ['class' => 'js-datepicker'],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'required' => true,
                'constraints' => [
                    new Assert\Range(array(
                        'min' => 'yesterday',
                        'max' => '+8760 hours',
                        'minMessage' => "La date est dans le passé.",
                        'maxMessage' => "Vous êtes allé trop loin !",
                    )),
                 ]
             ))
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Demi-journée' => 'demi-journée',
                    'Journée' => 'journée',
                ),
                'multiple' => false,
                'attr' => ['class' => 'radio-demi'],
                'required' => true,
            ))
            ->add('save',           SubmitType::class, array(
                'label' => 'Valider'
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MI\BilletterieBundle\Entity\Commande',
            'constraints' => [
                new Assert\Callback([ 'callback' => function($data, ExecutionContext $context) {
                    // Current time
                    $presentTime = date('H:i:s');

                    // Present day
                    $today = date_format(new \Datetime(), 'd/m/Y');

                    // Selected date in jQuery UI datepicker, formatted 'd/m/Y'
                    $selectedDate = date_format($data->getDateEntree(), 'd/m/Y');

                    // Selected date in jQuery UI datepicker, formatted 'd/m/' (holidays check)
                    $formattedDate = date_format($data->getDateEntree(), 'd/m');

                    // Selected type of tickets in the form
                    $selectedType = $data->getType();

                    // Array of French holidays
                    $holidays = ['01/01', '14/04', '01/05', '08/05', '25/05', '05/06', '14/07', '15/08', '01/11', '11/11', '25/12'];

                    /*
                     * Si la date sélectionné dans le datepicker est celle d'aujourd'hui, que le type
                     * de billet sélectionné est "journée" et qu'il est plus de 14h, la réservation
                     * n'est pas permise.
                     */
                    if($selectedDate === $today && $selectedType === "journée") {
                        if($presentTime >= "14:00:00" && $presentTime <= "23:59:59") {
                            $context
                                ->buildViolation('Vous ne pouvez pas réserver de billet "Journée" après 14h.')
                                ->atPath('type')
                                ->addViolation()
                            ;
                        }
                        /*
                         * Si la date sélectionnée dans le datepicker correspond à l'une des dates présentes
                         * dans le tableau des jours fériés français, la réservation n'est pas permise.
                         */
                    } else if(in_array($formattedDate, $holidays)) {
                        $context
                            ->buildViolation('Impossible de réserver pour les jours fériés')
                            ->atPath('date')
                            ->addViolation()
                        ;
                    }
                }])
            ]
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'MI_BilletteriebBundle_commande';
    }


}
