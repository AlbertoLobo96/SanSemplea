<?php
    namespace AppBundle\Repository;

    use Doctrine\ORM\EntityRepository;
/**
 * Created by PhpStorm.
 * User: Alberto
 * Date: 29/05/2018
 * Time: 12:12
 */
class GradoRepository extends EntityRepository
{
    public function GetAllGrados(){
        $em = $this->getEntityManager();

        $dql = "SELECT e FROM AppBundle\Entity\Grado e ORDER BY e.id ASC";

        $query = $em->createQuery($dql)
            ->getResult();

        return $query;
    }
}