<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Grado;
use AppBundle\Entity\Oferta;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use AppBundle\Form\OfertaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function LoginAction()
    {
        $Grados_repository = $this->getDoctrine()->getRepository(Grado::class);
        $grados = $Grados_repository->GetAllGrados();
        $Oferta  = new Oferta();
        $form = $this->createForm(OfertaType::class,$Oferta,array(
            'action' => $this->generateUrl('EnviarOferta'),
        ));
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
            'form' => $form->createView()
        ));
    }

    public function DatosPersonalesAction(Request $request)
    {
        $user = $this->getUser();
        $Alumnos_repository = $this->getDoctrine()->getRepository(Usuario::class);

        $alumno = $Alumnos_repository->find($user->getId()); //Buscamos el objeto con el id

        $form = $this->createForm(UsuarioType::class,$alumno);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $alumno = $form->getData();

                $file = $form["Foto"]->getData();
                $extension= $file->guessExtension();
                $file_name = time().".".$extension;
                $file->move('assets/img/my',$file_name);

                $alumno->setfoto($file_name);
                $plainPassword = $form["Passwd"]->getData();
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($alumno, $plainPassword);

                $user->setPasswd($encoded);
                $em->persist($alumno);
                //flush graba los datos en la base de datos
                $flush=$em->flush();

                if($flush != null){
                    $status = "Formulario validado perfectamente pero no se ha modificado el alumno";
                    $tipo="warning";
                }
                else{
                    $status = "Formulario validado perfectamente y modificado el alumno";
                    $tipo ="success";
                }
            } else {
                $status = "Formulario no válido";
                $tipo = "danger";
            }
            $this->addFlash('estado', $status);
            $this->addFlash('tipo', $tipo);
        }
        return $this->render('AppBundle:Paginas:Loged.html.twig',array(
            "form" => $form->createView()
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
    public function DeleteAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $Alumnos_repository = $em->getRepository("AppBundle:Usuario");

        $id = $request->query->get("id");


        $alumno = $Alumnos_repository->find($id); //Buscamos el objeto con el id

        $em->remove($alumno);

        $flush=$em->flush();

        if($flush != null){
            $status = "Alumno no borrado";
            $tipo="danger";
        }
        else{
            $status = "El alumno ha sido borrado correctamente";
            $tipo ="success";
        }
        $this->addFlash('estado', $status);
        $this->addFlash('tipo', $tipo);
        return $this->redirectToRoute('Listar_Alumnos');
    }

    public function ConfirmarAction($id){
        $em = $this->getDoctrine()->getManager();

        $Alumnos_repository = $em->getRepository("AppBundle:Usuario");

        $alumno = $Alumnos_repository->find($id); //Buscamos el objeto con el id

        return $this->render("AppBundle:Paginas:Confirmar.html.twig",array(
            "alumno"=> $alumno
        ));
    }

    public function EnviarOfertaAction(Request $request){
        $ofertum = new Oferta();
        $form = $this->createForm(OfertaType::class, $ofertum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Nueva Oferta')
                ->setFrom('t.albertito@gmail.com')
                ->setTo('alberto_trinidad_lobo@hotmail.es')
                ->setBody(
                    $this->renderView(
                        'AppBundle:Paginas:Partes/email.html.twig',
                        array('name' => "admin")
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            $ofertum=$form->getData();
            $ofertum->setValidar(0);
            $file = $form["Archivos"]->getData();
            if($file != null){
                $extension= $file->guessExtension();
                $file_name = time().".".$extension;
                $file->move('assets/img/Archivos',$file_name);

                $ofertum->setArchivos($file_name);
            }
            else{
                $ofertum->setArchivos("nada");
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($ofertum);
            $em->flush();
        }
        return $this->redirectToRoute('login');
    }

    public function ValidarAction($id){
        $Oferta_repository = $this->getDoctrine()->getRepository(Oferta::class);
        $oferta = $Oferta_repository->find($id);
        $oferta->setValidar(1);
        return $this->redirectToRoute('Listar_Ofertas');
    }
}
