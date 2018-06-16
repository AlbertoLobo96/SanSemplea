<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Grado;
use AppBundle\Entity\Oferta;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use AppBundle\Form\OfertaType;
use AppBundle\Form\GradoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * Funcion que carga el login de la pagina y crea el formulario de las ofertas
     */
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

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * Funcion que obtiene los datos personsales del usuario y carga la pagina inicial del login con ellos
     */
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
                //sube la foto a una carpeta personalizada apra guardar las fotos.
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
    /**
     * @param Request $request
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     * Funcion que lista todos los alumnos de la base de datos y añadir uno nuevo
     */
    public function ListarAlumnosAction(Request $request,$page)
    {
        $Alumnos_repository = $this->getDoctrine()->getRepository(Usuario::class);

        $Alumno  = new Usuario();

        $form = $this->createForm(UsuarioType::class,$Alumno);

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
                //encriptamos la contraseña en la base de datos
                $plainPassword = $form["Passwd"]->getData();
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($alumno, $plainPassword);
                $alumno->setPasswd($encoded);

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
        $tampag = 4;
        $alumnos = $Alumnos_repository->GetPagina($tampag, $page); //array con todos los alumnos de la base de datos

        $totalalumnos = count($alumnos);

        $totalpag = ceil($totalalumnos / $tampag);

        return $this->render('AppBundle:Paginas:ListarAlumnos.html.twig', array(
            "ListaAlumnos" => $alumnos,
            "pagina" => $page,
            "TotalAlumnos" => $totalalumnos,
            "TotalPaginas" => $totalpag,
            "form" => $form->createView()
        ));
    }

    /**
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     * Funcion que Lista todas las ofertas de la base de datos, validadas y no validadas
     */
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

    /**
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     * Funcion para mostrar las ofertas que tiene un alumno en funcion de los grados en los que esta inscrito
     */
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

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * Funcion para borrar un alumno
     */
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

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * Funcion para confirmar la eliminacion de un alumno
     */
    public function ConfirmarAlumnoAction($id){
        $em = $this->getDoctrine()->getManager();

        $Alumnos_repository = $em->getRepository("AppBundle:Usuario");

        $alumno = $Alumnos_repository->find($id); //Buscamos el objeto con el id

        return $this->render("AppBundle:Paginas:Confirmar.html.twig",array(
            "alumno"=> $alumno
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * Funcion que crea una oferta y envia un mensaje al administrador
     */
    public function EnviarOfertaAction(Request $request){
        $ofertum = new Oferta();
        $form = $this->createForm(OfertaType::class, $ofertum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Nueva Oferta')
                    ->setFrom('sansemplea@gmail.com')
                    ->setTo('bosssansemplea@gmail.com')
                    ->setBody(
                        $this->renderView(
                            'AppBundle:Paginas:Partes/email.html.twig', array(
                                'oferta' => $ofertum,
                                'name' => "Administrador"
                                )
                        ),
                        'text/html'
                    );
                $this->get('mailer')->send($message);

                $ofertum = $form->getData();
                $ofertum->setValidar(0);
                $file = $form["Archivos"]->getData();
                if ($file != null) {
                    $extension = $file->guessExtension();
                    $file_name = time() . "." . $extension;
                    $file->move('assets/img/Archivos', $file_name);

                    $ofertum->setArchivos($file_name);
                } else {
                    $ofertum->setArchivos("nada");
                }

                $em = $this->getDoctrine()->getManager();
            $em->persist($ofertum);
            $em->flush();
            }
            return $this->redirectToRoute('login');
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * Funcion que valida una oferta
     */
    public function ValidarAction($id){

        $Oferta_repository = $this->getDoctrine()->getRepository(Oferta::class);
        $oferta = $Oferta_repository->find($id);
        $oferta->setValidar(1);

        $Alumno_repository = $this->getDoctrine()->getRepository(Usuario::class);

        $Alumnos = $Alumno_repository->GetAllUsuarios();

        foreach ($oferta->getGrados() as $grad) {
            foreach ($Alumnos as $sel) {
                foreach ($sel->getGrados() as $s) {
                    if ($grad->getId() == $s->getId()) {
                        $message = \Swift_Message::newInstance()
                            ->setSubject('Nueva Oferta')
                            ->setFrom('sansemplea@gmail.com')
                            ->setTo($sel->getEmail())
                            ->setBody(
                                $this->renderView(
                                    'AppBundle:Paginas:Partes/email.html.twig', array(
                                        'oferta' => $oferta,
                                        'name' => $sel->getNombre()
                                    )
                                ),
                                'text/html'
                            );
                        $this->get('mailer')->send($message);
                    }
                }
            }
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($oferta);
        $em->flush();
        return $this->redirectToRoute('Listar_Ofertas');
    }

    /**
     * @param Request $request
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     * Funcion que lista y añade grados a la base de datos
     */
    public function ListarGradosAction(Request $request,$page){

        $grado  = new Grado();

        $form = $this->createForm(GradoType::class,$grado);

        $form->handleRequest($request);

        $Grados_repository = $this->getDoctrine()->getRepository(Grado::class);


        if($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $grado = $form->getData();
                $em->persist($grado);
                //flush graba los datos en la base de datos
                $flush=$em->flush();

                if($flush != null){
                    $status = "Formulario validado perfectamente pero no se ha añadido el grado";
                    $tipo="warning";
                }
                else{
                    $status = "Formulario validado perfectamente y añadido el grado";
                    $tipo ="success";
                }
            } else {
                $status = "Formulario no válido";
                $tipo = "danger";
            }
            $this->addFlash('estado', $status);
            $this->addFlash('tipo', $tipo);
        }

        $tampag = 8;
        $Grados = $Grados_repository->GetPagina($tampag, $page); //array con todos los alumnos de la base de datos

        $totalgrados = count($Grados);

        $totalpag = ceil($totalgrados / $tampag);

        return $this->render('AppBundle:Paginas:ListarGrados.html.twig', array(
            "ListaGrados" => $Grados,
            "pagina" => $page,
            "TotalPaginas" => $totalpag,
            "form" => $form->createView()
        ));
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * Funcion para borrar un grado
     */
    public function DeleteGradoAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $Grado_repository = $em->getRepository("AppBundle:Grado");

        $id = $request->query->get("id");


        $grado = $Grado_repository->find($id); //Buscamos el objeto con el id

        $em->remove($grado);

        $flush=$em->flush();

        if($flush != null){
            $status = "Grado no borrado";
            $tipo="danger";
        }
        else{
            $status = "El grado ha sido borrado correctamente";
            $tipo ="success";
        }
        $this->addFlash('estado', $status);
        $this->addFlash('tipo', $tipo);
        return $this->redirectToRoute('Listar_Grados');
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * Funcion para confirmar la eliminacion de un grado
     */
    public function ConfirmarGradoAction($id){
        $em = $this->getDoctrine()->getManager();

        $Grado_repository = $em->getRepository("AppBundle:Grado");

        $grado = $Grado_repository->find($id); //Buscamos el objeto con el id

        return $this->render("AppBundle:Paginas:ConfirmarGrado.html.twig",array(
            "grado"=> $grado
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * Funcion para borrar una oferta
     */
    public function DeleteOfertaAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $Oferta_repository = $em->getRepository("AppBundle:Oferta");

        $id = $request->query->get("id");


        $oferta = $Oferta_repository->find($id); //Buscamos el objeto con el id

        $em->remove($oferta);

        $flush=$em->flush();

        if($flush != null){
            $status = "Oferta no borrada";
            $tipo="danger";
        }
        else{
            $status = "La oferta ha sido borrada correctamente";
            $tipo ="success";
        }
        $this->addFlash('estado', $status);
        $this->addFlash('tipo', $tipo);
        return $this->redirectToRoute('Listar_Ofertas');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * Funcion para modificar los datos de algun alumno
     */
    
    public function ModificarAlumnoAction(Request $request){

    $em = $this->getDoctrine()->getManager();

    $Alumnos_repository = $em->getRepository("AppBundle:Usuario");

    $id = $request->query->get("id");

    $alumno = $Alumnos_repository->find($id); //Buscamos el objeto con el id

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
            //encriptamos la contraseña en la base de datos
            $plainPassword = $form["Passwd"]->getData();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($alumno, $plainPassword);
            $alumno->setPasswd($encoded);

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
            $tipo = "danager";
        }
        $this->addFlash('estado', $status);
        $this->addFlash('tipo', $tipo);
    }
    return $this->render("AppBundle:Paginas:ModAlumno.html.twig",array(
        "form" => $form->createView()
    ));
    }
}
