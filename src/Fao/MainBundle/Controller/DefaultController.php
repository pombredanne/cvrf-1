<?php

namespace Fao\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FaoMainBundle:Default:index.html.twig', array());
    }

    public function docsAction()
    {
        $medias = $this->getDoctrine()->getRepository('ApplicationSonataMediaBundle:Media')->findBy(array( 'context' => 'default'));

        return $this->render('FaoMainBundle:Default:docs.html.twig', array('medias' => $medias));
    }
}
