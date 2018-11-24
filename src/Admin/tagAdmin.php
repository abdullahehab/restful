<?php
/**
 * Created by PhpStorm.
 * User: abdullah-ehab
 * Date: 11/24/18
 * Time: 3:20 PM
 */

namespace App\Admin;


use App\Entity\Tags;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class tagAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextareaType::class);

    }


    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper

            ->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper->addIdentifier('name', TextareaType::class);


    }

    public function toString($object)
    {
        return $object instanceof Tags
            ? $object->getName()
            : 'Product'; // shown in the breadcrumb on the create view
    }

}