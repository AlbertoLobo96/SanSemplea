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
    public function GetOfertas($PagSize, $PagActual,$id){

        $query = $this->createQueryBuilder('o');
        $result = $query->select('o')
            ->join('o.Grados','g')->addSelect('g')
            ->join('g.Alumnos','a')->addSelect('a')
            ->andWhere('o.Validar = 1 and a.id='.$id)
            ->setFirstResult($PagSize *($PagActual-1))
            ->setMaxResults($PagSize)
            ->getQuery();
        $Paginator = new Paginator($result,$fetchJoinCollection = true);
        return $Paginator;
    }
}