<?php

namespace Fao\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FaoMainBundle:Default:index.html.twig', array());
    }

    public function docsAction()
    {
       // $medias = $this->getDoctrine()->getRepository('ApplicationSonataMediaBundle:Media')->findBy(array( 'context' => 'default'));

        //return $this->render('FaoMainBundle:Default:docs.html.twig', array('medias' => $medias));


        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT d FROM FaoMainBundle:Docs d WHERE d.estado = :estado";
        $query = $em->createQuery($dql);
        $query->setParameter('estado', 'published');

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            12/*limit per page*/
        );

        //$documentos = $this->getDoctrine()->getRepository('FaoMainBundle:Docs')->findBy(array('estado' => 'Publicado'));
        //return $this->render('FaoMainBundle:Default:docs.html.twig', array( 'documentos' => $documentos));
        return $this->render('FaoMainBundle:Default:docs.html.twig', array( 'documentos' => $pagination));

        //$documentos = $this->getDoctrine()->getRepository('FaoMainBundle:Docs')->findBy(array('estado' => 'published'));
        //return $this->render('FaoMainBundle:Default:docs.html.twig', array( 'documentos' => $documentos));

    }

    public function terminosAction()
    {
        return $this->render('FaoMainBundle:Default:terminos.html.twig');
    }

    public function searchAction(Request $request)
    {
        $manager = $this->get('fos_elastica.manager');
        $repository = $manager->getRepository('FaoMainBundle:Docs');
        $searchTerm = $request->query->get('q');
        $documentos = $repository->find($searchTerm);

        return $this->render('FaoMainBundle:Default:docs.html.twig', array( 'documentos' => $documentos));
    }

    public function showAction($id)
    {
        $documentos = $this->getDoctrine()->getRepository('FaoMainBundle:Docs')->find($id);
        return $this->render('FaoMainBundle:Default:show.html.twig', array( 'documento' => $documentos));
    }
}
