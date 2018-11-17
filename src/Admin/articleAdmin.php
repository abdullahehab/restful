<?php
/**
 * Created by PhpStorm.
 * User: abdullahehab
 * Date: 11/6/18
 * Time: 5:16 PM
 */

namespace App\Admin;
use App\Entity\Article;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;


class articleAdmin extends AbstractAdmin

{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextareaType::class);
        $formMapper->add('description', TextareaType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', TextareaType::class);
        $listMapper->add('description', TextareaType::class);
    }

    public function toString($object)
    {
        return $object instanceof Article
            ? $object->getName()
            : 'Atricle'; // shown in the breadcrumb on the create view
    }
}