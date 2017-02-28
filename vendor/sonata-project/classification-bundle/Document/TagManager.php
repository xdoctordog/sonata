<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Sonata\CoreBundle\Model\BaseDocumentManager;
use Sonata\ClassificationBundle\Model\TagManagerInterface;

use Sonata\DatagridBundle\Pager\Doctrine\Pager;
use Sonata\DatagridBundle\ProxyQuery\Doctrine\ProxyQuery;

class TagManager extends BaseDocumentManager implements TagManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPager(array $criteria, $page, $maxPerPage = 10)
    {
        $parameters = array();

        $query = $this->getRepository()
            ->createQueryBuilder('t')
            ->select('t');

        $criteria['enabled'] = isset($criteria['enabled']) ? $criteria['enabled'] : true;
        $query->andWhere('t.enabled = :enabled');
        $parameters['enabled'] = $criteria['enabled'];

        $query->setParameters($parameters);

        $pager = new Pager();
        $pager->setMaxPerPage($maxPerPage);
        $pager->setQuery(new ProxyQuery($query));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }
}
