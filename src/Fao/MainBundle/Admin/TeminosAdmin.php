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
use Sonata\FormatterBundle\Formatter\Pool as FormatterPool;

class TeminosAdmin extends Admin{

    /**
     * @var Pool
     */
    protected $formatterPool;

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
            ->add('content', 'sonata_formatter_type', array(
                'event_dispatcher' => $mapper->getFormBuilder()->getEventDispatcher(),
                'format_field'   => 'contentFormatter',
                'source_field'   => 'terminos',
                'source_field_options'      => array(
                    'attr' => array('class' => 'span10', 'rows' => 20)
                ),
                'target_field'   => 'content',
                'listener'       => true,
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('terminos')
        ;
    }

    /**
     * @param \Sonata\FormatterBundle\Formatter\Pool $formatterPool
     *
     * @return void
     */
    public function setPoolFormatter(FormatterPool $formatterPool)
    {
        $this->formatterPool = $formatterPool;
    }

    /**
     * @return \Sonata\FormatterBundle\Formatter\Pool
     */
    public function getPoolFormatter()
    {
        return $this->formatterPool;
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($terminos)
    {
        $terminos->setContent($this->getPoolFormatter()->transform($terminos->getContentFormatter(), $terminos->getTerminos()));
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($terminos)
    {
        $terminos->setContent($this->getPoolFormatter()->transform($terminos->getContentFormatter(), $terminos->getTerminos()));
    }
} 