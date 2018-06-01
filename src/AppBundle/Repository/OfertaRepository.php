<?php
    namespace AppBundle\Repository;

    use Doctrine\ORM\EntityRepository;
    use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * Created by PhpStorm.
 * User: Alberto
 * Date: 29/05/2018
 * Time: 12:12
 */
class OfertaRepository extends EntityRepository
{
    public function GetPagina($PagSize, $PagActual){
        $em = $this->getEntityManager();

        $dql = "SELECT e FROM AppBundle\Entity\Oferta e ORDER BY e.id ASC";

        $query = $em->createQuery($dql)
            ->setFirstResult($PagSize *($PagActual-1))
            ->setMaxResults($PagSize);

        $Paginator = new Paginator($query,$fetchJoinCollection = true);
        return $Paginator;
    }
    public function GetPaginaAlum($PagSize, $PagActual,$cod){
        $em = $this->getEntityManager();

        $dql = "SELECT e FROM AppBundle\Entity\Grado_Oferta e WHERE e.Grado=$cod ORDER BY e.id ASC";

        $query = $em->createQuery($dql)
            ->setFirstResult($PagSize *($PagActual-1))
            ->setMaxResults(1);
        var_dump($query);
        die();
        $Paginator = new Paginator($query,$fetchJoinCollection = true);
        return $Paginator;
    }
}