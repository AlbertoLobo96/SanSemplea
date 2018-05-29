<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function LoginAction(Request $request)
    {
        //Llamamos al servicio de autenticacion
        $authenticationUtils = $this->get('security.authentication_utils');
        // conseguir el error del login si falla
        $error = $authenticationUtils->getLastAuthenticationError();
        // ultimo nombre de usuario que se ha intentado identificar
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render(
            'AppBundle:Paginas:login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }
}
