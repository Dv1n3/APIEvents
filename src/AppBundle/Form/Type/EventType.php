<?php
/**
 * Created by PhpStorm.
 * User: dvine
 * Date: 20/04/2018
 * Time: 21:01
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('referrer')
            ->add('cookieId');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'csrf_protection' => false
        ]);
    }
}