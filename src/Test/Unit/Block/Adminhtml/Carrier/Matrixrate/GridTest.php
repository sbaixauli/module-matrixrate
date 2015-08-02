<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace WebShopApps\MatrixRate\Test\Unit\Block\Adminhtml\Carrier\Matrixrate;

class GridTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \WebShopApps\MatrixRate\Block\Adminhtml\Carrier\Matrixrate\Grid
     */
    protected $model;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $storeManagerMock;

    /**
     * @var \Magento\Backend\Helper\Data|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $backendHelperMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $matrixrateMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $context;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $collectionFactoryMock;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->storeManagerMock = $this->getMockBuilder('Magento\Store\Model\StoreManagerInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->context = $objectManager->getObject('Magento\Backend\Block\Template\Context', [
            'storeManager' => $this->storeManagerMock
        ]);

        $this->backendHelperMock = $this->getMockBuilder('\Magento\Backend\Helper\Data')
            ->disableOriginalConstructor()
            ->getMock();

        $this->collectionFactoryMock =
            $this->getMockBuilder('\WebShopApps\MatrixRate\Model\Resource\Carrier\Matrixrate\CollectionFactory')
            ->disableOriginalConstructor()
            ->getMock();

        $this->matrixrateMock = $this->getMockBuilder('WebShopApps\MatrixRate\Model\Carrier\Matrixrate')
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new \WebShopApps\MatrixRate\Block\Adminhtml\Carrier\Matrixrate\Grid(
            $this->context,
            $this->backendHelperMock,
            $this->collectionFactoryMock,
            $this->matrixrateMock
        );
    }

    public function testSetWebsiteId()
    {
        $websiteId = 1;

        $websiteMock = $this->getMockBuilder('Magento\Store\Model\Website')
            ->setMethods(['getId'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeManagerMock->expects($this->once())
            ->method('getWebsite')
            ->with($websiteId)
            ->willReturn($websiteMock);

        $websiteMock->expects($this->once())
            ->method('getId')
            ->willReturn($websiteId);

        $this->assertSame($this->model, $this->model->setWebsiteId($websiteId));
        $this->assertEquals($websiteId, $this->model->getWebsiteId());
    }

    public function testGetWebsiteId()
    {
        $websiteId = 10;

        $websiteMock = $this->getMockBuilder('Magento\Store\Model\Website')
            ->disableOriginalConstructor()
            ->setMethods(['getId'])
            ->getMock();

        $websiteMock->expects($this->once())
            ->method('getId')
            ->willReturn($websiteId);

        $this->storeManagerMock->expects($this->once())
            ->method('getWebsite')
            ->willReturn($websiteMock);

        $this->assertEquals($websiteId, $this->model->getWebsiteId());

        $this->storeManagerMock->expects($this->never())
            ->method('getWebsite')
            ->willReturn($websiteMock);

        $this->assertEquals($websiteId, $this->model->getWebsiteId());
    }

    public function testSetAndGetConditionName()
    {
        $conditionName = 'someName';
        $this->assertEquals($this->model, $this->model->setConditionName($conditionName));
        $this->assertEquals($conditionName, $this->model->getConditionName());
    }
}
