<?php
/**
 * Created by PhpStorm.
 * User: nrtroz
 * Date: 11/17/18
 * Time: 3:20 PM
 */

namespace App\Admin;
use App\Entity\Category;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;

class categoryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextareaType::class);
    }

  protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', TextareaType::class);

    }

    public function toString($object)
    {
        return $object instanceof Category
            ? $object->getName()
            : 'Product'; // shown in the breadcrumb on the create view
    }

}