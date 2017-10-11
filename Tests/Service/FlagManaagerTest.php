<?php

namespace Service;


use ED\FlagBundle\Service\EDFlagManager;

class FlagManaagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \ED\FlagBundle\Service\FlagManagerInterface
     */
    private $flagManager;

    /**
     * { @inheritdoc }
     */
    public function setUp()
    {
        $em = $this
            ->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $reader = $this
            ->getMockBuilder('ED\FlagBundle\Service\FlagAnnotationReader')
            ->disableOriginalConstructor()
            ->getMock();

        $this->flagManager = new EDFlagManager(
            $em,
            $reader,
            'ED\FlagBundle\Tests\Entity\FlagReport',
            'ED\FlagBundle\Tests\Entity\FlagReason',
            'ED\FlagBundle\Tests\Entity\FlagAction'
        );
    }

    /**
     * Test creation of flag report
     */
    public function testCreateFlagReport()
    {
        $flagReport = $this->flagManager->createFlagReport();

        $this->assertInstanceOf('ED\FlagBundle\Tests\Entity\FlagReport', $flagReport);
    }

    /**
     * Test creation of flag action
     */
    public function testCreateFlagAction()
    {
        $flagAction = $this->flagManager->createFlagAction();

        $this->assertInstanceOf('ED\FlagBundle\Tests\Entity\FlagAction', $flagAction);
    }
}