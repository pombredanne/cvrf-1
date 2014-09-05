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
        $documentos = $this->getDoctrine()->getRepository('FaoMainBundle:Docs')->findBy(array('estado' => 'Publicado'));
        return $this->render('FaoMainBundle:Default:docs.html.twig', array( 'documentos' => $documentos));
    }

    public function terminosAction()
    {
        $terminos = $this->getDoctrine()->getRepository('FaoMainBundle:Teminos')->find(2);
        return $this->render('FaoMainBundle:Default:terminos.html.twig', array( 'terminos' => $terminos));
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
