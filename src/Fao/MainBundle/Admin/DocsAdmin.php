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
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\FormatterBundle\Formatter\Pool as FormatterPool;

class DocsAdmin extends Admin
{
    /**
     * Security Context
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    protected $securityContext;

    /**
     * @var Pool
     */
    protected $formatterPool;

    //Listar los elementos que poseemos
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper
            ->addIdentifier('titulo', null, array('route' => array('name'=> 'show')))
            ->add('estado')
            ->add('autor')
            ->add('anno')
            ->add('fileName')
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
            ->add('estado')
            ->add('titulo')
            ->add('autor')
            ->add('pais');
    }

    protected function configureFormFields(FormMapper $mapper)
    {
        $documentClass = $this->getClass();
        $status = $documentClass::getStatusList();

        if (!$this->securityContext->isGranted('ROLE_EDITOR'))
        {
            unset($status['published']);
        }

        $mapper
            ->add('estado', 'choice',
                array('choices' => $status, 'required' => true, 'empty_value' => 'Seleccione un estado',
                    'empty_data'  => null, 'label' => 'Estado', ))
            ->add('titulo')
            ->add('resumen', 'sonata_formatter_type', array(
                'event_dispatcher' => $mapper->getFormBuilder()->getEventDispatcher(),
                'format_field'   => 'contentFormatter',
                'source_field'   => 'rawContent',
                'source_field_options'      => array(
                    'attr' => array('class' => 'span10', 'rows' => 20)
                ),
                'target_field'   => 'resumen',
                'listener'       => true,
            ))
            ->add('autor')
            ->add('nivel', null, array(
                'required'      => false,
            ))
            ->add('instituto', null, array(
                'required'      => false,
            ))
            ->add('pais', 'country')
            ->add('anno', 'sonata_type_date_picker', array(
                'datepicker_use_button' => false,
            ))
            ->add('file', 'vich_file', array(
                'label'         => ' ',
                'mapping'       => 'document_file', // mandatory
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('estado')
            ->add('titulo')
            ->add('resumen')
            ->add('autor')
            ->add('nivel')
            ->add('instituto')
            ->add('pais')
            ->add('anno')
            ->add('fileName')
        ;
    }

    public function setSecurityContext(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        if(!$this->securityContext->isGranted('ROLE_SUPER_ADMIN'))
        {
             $query
                 ->andWhere('o.estado=:estado')
                 ->setParameter('estado', 'presented')
            ;
        }
        if (!$this->securityContext->isGranted('ROLE_EDITOR'))
        {
            $query
                ->andWhere('o.estado != :published')
                ->andWhere('o.createdBy = :user')
                ->setParameter('published','published')
                ->setParameter('user', $this->securityContext->getToken()->getUser()->getUsername())
            ;
        }

        return $query;
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
    public function prePersist($post)
    {
        $post->setResumen($this->getPoolFormatter()->transform($post->getContentFormatter(), $post->getRawContent()));
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($post)
    {
        $post->setResumen($this->getPoolFormatter()->transform($post->getContentFormatter(), $post->getRawContent()));
    }

} 