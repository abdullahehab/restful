<?php
/**
 * Created by PhpStorm.
 * User: abdullah-ehab
 * Date: 11/24/18
 * Time: 1:21 PM
 */

namespace App\Form\Type;


use App\Entity\Tags;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Tags::class,
        ));
    }

}