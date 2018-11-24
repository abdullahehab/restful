<?php
/**
 * Created by PhpStorm.
 * User: abdullah-ehab
 * Date: 11/24/18
 * Time: 3:28 PM
 */

namespace App\Admin;

use App\Entity\Tags;
use App\Entity\Task;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class taskAdmin extends AbstractAdmin
{
    /**
     * @param Task $object
     */
    public function prePersist($object)
    {
        /** @var Tags $tag */
        foreach ($object->getTags() as $tag) {
            $tag->setTask($object);
        }
    }

    public function preUpdate($object)
    {
        /** @var Tags $tag */
        foreach ($object->getTags() as $tag) {
            $tag->setTask($object);
        }
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('tags', \Sonata\CoreBundle\Form\Type\CollectionType::class, array(), array(
                'edit'  =>  'inline',
                'inline'    =>  'table'
            ))
            ->add('description', TextareaType::class);

    }


    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper

            ->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('description', TextareaType::class)
            ->add('tags', EntityType::class,[
                'class' => Tags::class,
                'property' => 'name'
            ]);
    }

    public function toString($object)
    {
        return $object instanceof Task
            ? $object->getDescription()
            : 'Product'; // shown in the breadcrumb on the create view
    }

}