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
class UsuarioRepository extends EntityRepository
{
    public function GetPagina($PagSize, $PagActual){
        $em = $this->getEntityManager();

        $dql = "SELECT e FROM AppBundle\Entity\Usuario e WHERE e.Rol='ROLE_USER' ORDER BY e.id ASC";

        $query = $em->createQuery($dql)
            ->setFirstResult($PagSize *($PagActual-1))
            ->setMaxResults($PagSize);

        $Paginator = new Paginator($query,$fetchJoinCollection = true);
        return $Paginator;
    }
    public function GetAllUsuarios(){
        $em = $this->getEntityManager();

        $dql = "SELECT e FROM AppBundle\Entity\Usuario e WHERE e.Rol ='ROLE_USER' ORDER BY e.id ASC";

        $query = $em->createQuery($dql)
            ->getResult();

        return $query;
    }
}