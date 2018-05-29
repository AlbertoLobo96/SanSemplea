<?php
/**
 * Created by PhpStorm.
 * User: VSPC-GIANTSV5
 * Date: 26/05/2018
 * Time: 0:39
 */

namespace AppBundle\Controller;


class LogedController
{
    public  function HomeAction(){
        return $this->render(
            'AppBundle:Paginas:Loged.html.twig');
    }
}