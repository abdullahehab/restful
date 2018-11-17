<?php
/**
 * Created by PhpStorm.
 * User: nrtroz
 * Date: 11/17/18
 * Time: 1:45 PM
 */

namespace App\Admin;

use App\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class productAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextareaType::class);
        $formMapper->add('price', TextareaType::class);
        $formMapper->add('description', TextareaType::class);
    }

/*    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
        $datagridMapper->add('price');

    }*/

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', TextareaType::class);
        $listMapper->addIdentifier('price', TextareaType::class);
        $listMapper->addIdentifier('description', TextareaType::class);

    }

    public function toString($object)
    {
        return $object instanceof Product
            ? $object->getName()
            : 'Product'; // shown in the breadcrumb on the create view
    }


}