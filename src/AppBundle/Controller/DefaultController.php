<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function LoginAction()
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

    public function DatosPersonalesAction()
    {
        return $this->render('AppBundle:Paginas:Loged.html.twig');
    }

    public function ListarAlumnosAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $Alumnos_repository = $em->getRepository("AppBundle:Usuario");
        $tampag = 4;
        $alumnos = $Alumnos_repository->GetPagina($tampag, $page); //array con todos los alumnos de la base de datos

        $totalalumnos = count($alumnos);

        $totalpag = ceil($totalalumnos / $tampag);

        return $this->render('AppBundle:Paginas:ListarAlumnos.html.twig', array(
            "ListaAlumnos" => $alumnos,
            "pagina" => $page,
            "TotalAlumnos" => $totalalumnos,
            "TotalPaginas" => $totalpag
        ));
    }

    public function ListarOfertasAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $Ofertas_repository = $em->getRepository("AppBundle:Oferta");
        $tampag = 4;
        $Ofertas = $Ofertas_repository->GetPagina($tampag, $page); //array con todos los alumnos de la base de datos

        $totalofertas = count($Ofertas);

        $totalpag = ceil($totalofertas / $tampag);

        return $this->render('AppBundle:Paginas:ListarOfertas.html.twig', array(
            "ListaOfertas" => $Ofertas,
            "pagina" => $page,
            "TotalOfertas" => $totalofertas,
            "TotalPaginas" => $totalpag
        ));
    }
    public function MisOfertasAction($page){
        $cont = 0;
        $arr = [];
        $em = $this->getDoctrine()->getManager();

        $Ofertas_repository = $em->getRepository("AppBundle:Oferta");
        $tampag = 4;
        $user = $this->getUser();
        //foreach($user->GetGAlumno() as $sel){
            $Ofertas = $Ofertas_repository->GetPaginaAlum($tampag, $page,1);
          /*  $arr=[
                $cont => $Ofertas
            ];
            $cont++;
          */
        //}
        //array con todos los alumnos de la base de datos

        $totalofertas = count($arr);
        $totalpag = ceil($totalofertas / $tampag);

        var_dump($Ofertas);
        die();
        return $this->render('AppBundle:Paginas:ListarOfertas.html.twig', array(
            "ListaOfertas" => $Ofertas,
            "pagina" => $page,
            "TotalOfertas" => $totalofertas,
            "TotalPaginas" => $totalpag
        ));
    }
}
