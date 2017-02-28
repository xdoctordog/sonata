<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\ClassificationBundle\Tests\Entity;

use Sonata\ClassificationBundle\Entity\TagManager;

/**
 * Class TagManagerTest
 *
 */
class TagManagerTest extends \PHPUnit_Framework_TestCase
{
    protected function getTagManager($qbCallback)
    {
        $query = $this->getMockForAbstractClass('Doctrine\ORM\AbstractQuery', array(), '', false, true, true, array('execute'));
        $query->expects($this->any())->method('execute')->will($this->returnValue(true));

        $qb = $this->getMockBuilder('Doctrine\ORM\QueryBuilder')->disableOriginalConstructor()->getMock();
        $qb->expects($this->any())->method('select')->will($this->returnValue($qb));
        $qb->expects($this->any())->method('getQuery')->will($this->returnValue($query));

        $qbCallback($qb);

        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')->disableOriginalConstructor()->getMock();
        $repository->expects($this->any())->method('createQueryBuilder')->will($this->returnValue($qb));

        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->getMock();
        $em->expects($this->any())->method('getRepository')->will($this->returnValue($repository));

        $registry = $this->getMock('Doctrine\Common\Persistence\ManagerRegistry');
        $registry->expects($this->any())->method('getManagerForClass')->will($this->returnValue($em));

        return new TagManager('Sonata\PageBundle\Entity\BaseTag', $registry);
    }

    public function testGetPager()
    {
        $self = $this;
        $this
            ->getTagManager(function ($qb) use ($self) {
                $qb->expects($self->never())->method('andWhere');
                $qb->expects($self->once())->method('setParameters')->with(array());
            })
            ->getPager(array(), 1);
    }

    public function testGetPagerWithEnabledTags()
    {
        $self = $this;
        $this
            ->getTagManager(function ($qb) use ($self) {
                $qb->expects($self->once())->method('andWhere')->with($self->equalTo('t.enabled = :enabled'));
                $qb->expects($self->once())->method('setParameters')->with(array('enabled' => true));
            })
            ->getPager(array(
                'enabled' => true,
            ), 1);
    }

    public function testGetPagerWithDisabledTags()
    {
        $self = $this;
        $this
            ->getTagManager(function ($qb) use ($self) {
                $qb->expects($self->once())->method('andWhere')->with($self->equalTo('t.enabled = :enabled'));
                $qb->expects($self->once())->method('setParameters')->with(array('enabled' => false));
            })
            ->getPager(array(
                'enabled' => false,
            ), 1);
    }
}
