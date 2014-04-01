<?php
/**
 * Created by PhpStorm.
 * User: Andros Laptop
 * Date: 3/24/14
 * Time: 9:56 PM
 */

namespace Fao\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TeminosAdmin extends Admin{

    //Listar los elementos que poseemos
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper
            ->addIdentifier('id', null,array('label' => 'Id', 'route' => array('name'=> 'show')))
            ->add('terminos')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    //Filtrar la información
    protected function configureDatagridFilters(DatagridMapper $mapper)
    {
        $mapper
            ->add('id')
            ->add('terminos')
        ;
    }

    //formularios para crear y modificar
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper
            ->add('terminos')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('terminos')
        ;
    }
} 