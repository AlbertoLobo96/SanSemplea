<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Grado;
use AppBundle\Entity\Oferta;
use AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function LoginAction()
    {
        $Grados_repository = $this->getDoctrine()->getRepository(Grado::class);
        $grados = $Grados_repository->GetAllGrados();

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
            'ListaGrados' => $grados,
        ));
    }

    public function DatosPersonalesAction()
    {
        $Grados_repository = $this->getDoctrine()->getRepository(Grado::class);
        $grados = $Grados_repository->GetAllGrados();

        return $this->render('AppBundle:Paginas:Loged.html.twig',array(
            'ListaGrados' => $grados
        ));
    }

    public function ListarAlumnosAction($page)
    {
        $Alumnos_repository = $this->getDoctrine()->getRepository(Usuario::class);

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
        $Oferta_repository = $this->getDoctrine()->getRepository(Oferta::class);
        $tampag = 4;
        $Ofertas = $Oferta_repository->GetPagina($tampag, $page); //array con todos los alumnos de la base de datos

        $totalofertas = count($Ofertas);

        $totalpag = ceil($totalofertas / $tampag);

        return $this->render('AppBundle:Paginas:ListarOfertas.html.twig', array(
            "ListaOfertas" => $Ofertas,
            "pagina" => $page,
            "TotalOfertas" => $totalofertas,
            "TotalPaginas" => $totalpag
        ));
    }

    public function MisOfertasAction($page)
    {
        $Oferta_repository = $this->getDoctrine()->getRepository(Oferta::class);
        $tampag = 4;
        $user = $this->getUser();
        $Ofertas = $Oferta_repository->GetOfertas($tampag, $page, $user->getId());

        $totalofertas = count($Ofertas);
        $totalpag = ceil($totalofertas / $tampag);

        return $this->render('AppBundle:Paginas:ListarOfertas.html.twig', array(
            "ListaOfertas" => $Ofertas,
            "pagina" => $page,
            "TotalOfertas" => $totalofertas,
            "TotalPaginas" => $totalpag
        ));
    }

    public function ActualizarDatos(){

    }
}
