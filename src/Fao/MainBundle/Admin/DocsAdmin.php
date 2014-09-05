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
use \Symfony\Component\Security\Core\SecurityContextInterface;
use Sonata\AdminBundle\Route\RouteCollection;

class DocsAdmin extends Admin{

    //Listar los elementos que poseemos
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper
            ->addIdentifier('titulo', null, array('route' => array('name'=> 'show')))
            ->add('estado')
            ->add('autor')
            ->add('anno')
            ->add('fechaDePublicacion')
            ->add('archivo')
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
            ->add('pais')
        ;
    }

    //formularios para crear y modificar
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper
            ->add('estado', 'choice',
                array('choices' => array('Borrador' => 'Borrador',
                    'Presentado' => 'Presentado'), 'required' => true, 'empty_value' => 'Seleccione un Valor',
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
            ->add('archivo', 'sonata_type_model_list',array(),array( 'link_parameters' => array('context' => 'default','provider' => 'sonata.media.provider.file')))
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
            ->add('fechaDePublicacion')
            ->add('archivo')
            ->add('user')
        ;
    }

    /**
     * Security Context
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    protected $securityContext;

    public function setSecurityContext(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    // protected function configureRoutes(RouteCollection $collection)
    // {
    //     //remove all routes except those, you are using in admin and you can secure by yourself
    //     $collection
    //         ->clearExcept(array(
    //             'show',
    //             'create',
    //             'list',
    //             'edit',
    //             'delete',
    //         ))
    //     ;
    // }

    public function createQuery($context = 'list')
    {
        $queryBuilder = $this->getModelManager()->getEntityManager($this->getClass())->createQueryBuilder();

        //if is logged admin, show all data
        if ($this->securityContext->isGranted('ROLE_ADMIN_S')){
            $queryBuilder->select('list')
                ->from($this->getClass(),'list')
            ;
        } else if($this->securityContext->isGranted('ROLE_EDITOR')) {

            $queryBuilder->select('list')
                ->from($this->getClass(),'list')
                ->where('list.estado=:estado')
                ->setParameter('estado', 'Presentado')
            ;
        }else{
            //for other users, show only data, which belongs to them
            $adminId = $this->securityContext->getToken()->getUser()->getId();

            $queryBuilder->select('list')
                ->from($this->getClass(),'list')
                ->where('list.user=:adminId and list.estado != :estado')
				->setParameter('estado','Publicado')
                ->setParameter('adminId', $adminId)
            ;
        }

        $proxyQuery = new ProxyQuery($queryBuilder);
        return $proxyQuery;
    }

} 