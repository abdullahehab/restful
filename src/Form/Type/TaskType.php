<?php
/**
 * Created by PhpStorm.
 * User: abdullah-ehab
 * Date: 11/24/18
 * Time: 1:22 PM
 */

namespace App\Form\Type;


use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description');

        $builder->add('tags', CollectionType::class, array(
            'entry_type' => TagType::class,
            'entry_options' => array('label' => false),
            'allow_add' => true,
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Task::class,
        ));
    }




}