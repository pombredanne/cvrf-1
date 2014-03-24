<?php
/**
 * Created by PhpStorm.
 * User: Andros Laptop
 * Date: 3/23/14
 * Time: 4:28 PM
 */

namespace Fao\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class DocsAdmin extends Admin{

    //Listar los elementos que poseemos
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper
            ->addIdentifier('id', null,array('label' => 'Identificador', 'route' => array('name'=> 'show')))
            ->add('estado')
            ->add('titulo')
            ->add('autor')
            ->add('nivel')
            ->add('instituto')
            ->add('pais')
            ->add('anno')
            ->add('fechaDePublicacion')
            ->add('archivo')
        ;
    }

    //Filtrar la información
    protected function configureDatagridFilters(DatagridMapper $mapper)
    {
        $mapper
            ->add('id')
            ->add('estado')
            ->add('titulo')
            ->add('autor')
            ->add('pais')
        ;
    }

    //formularios para crear y modificar
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper
            ->add('estado', 'choice',
                array('choices' => array('Restitucion' => 'Restitucion', 'Borrador' => 'Borrador',
                    'Presentado' => 'Presentado', 'Publicado' => 'Publicado'), 'required' => true, 'empty_value' => 'Seleccione un valor',
                    'empty_data'  => null, 'label' => 'Estado', ))
            ->add('titulo')
            ->add('resumen')
            ->add('autor')
            ->add('nivel')
            ->add('instituto')
            //country esto es lo que hay que poner
            ->add('pais', null, array('label' => "Pais"))
            ->add('anno', 'date', array('label' => 'Anno', 'format' => 'MM/dd/yyyy',
                'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day')))
            ->add('fechaDePublicacion', 'date', array('format' => 'MM/dd/yyyy',
                'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day')))
            ->add('archivo', 'sonata_type_model_list',array(),array( 'link_parameters' => array('context' => 'default','provider' => 'sonata.media.provider.file')))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('estado')
            ->add('titulo')
            ->add('resumen')
            ->add('autor')
            ->add('nivel')
            ->add('instituto')
            ->add('pais')
            ->add('anno')
            ->add('fechaDePublicacion')
            ->add('archivo')
        ;
    }

} 