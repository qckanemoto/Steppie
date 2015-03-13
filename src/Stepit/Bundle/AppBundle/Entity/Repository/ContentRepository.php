<?php

namespace Stepit\Bundle\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Stepit\Bundle\AppBundle\Entity\Project;

/**
 * ContentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContentRepository extends EntityRepository
{
    /**
     * @param Project $project
     * @return array
     */
    public function findByProject(Project $project)
    {
        $contents = $this
            ->createQueryBuilder('c')
            ->innerJoin('c.matter', 'm', 'WITH')
            ->where('m.project = :project')
            ->setParameter('project', $project)
            ->getQuery()
            ->getResult()
        ;

        $result = [];
        foreach ($contents as $content) {
            $result[$content->getMatter()->getId()][$content->getStep()->getId()] = $content;
        }

        return $result;
    }
}
