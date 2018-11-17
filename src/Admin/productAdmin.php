<?php
/**
 * Created by PhpStorm.
 * User: nrtroz
 * Date: 11/17/18
 * Time: 1:45 PM
 */

namespace App\Admin;

use App\Entity\Product;
use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class productAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Content')
                ->add('name', TextareaType::class)
                ->add('price', TextareaType::class)
                ->add('description', TextareaType::class)
            ->end()

            ->with('Category')
                ->add('category', ModelType::class, [
                    'class' => Category::class,
                    'property' => 'name',
                ])
            ->end();
    }


        protected function configureDatagridFilters(DatagridMapper $datagridMapper)
        {
            $datagridMapper

                ->add('name')
                ->add('price')
                ->add('category', null, [], EntityType::class, [
                    'class'    => Category::class,
                    'choice_label' => 'name',
        ]);

        }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('name', TextareaType::class)
            ->add('price', TextareaType::class)
            ->add('description', TextareaType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'property' => 'name'
            ]);


    }

    public function toString($object)
    {
        return $object instanceof Product
            ? $object->getName()
            : 'Product'; // shown in the breadcrumb on the create view
    }


}