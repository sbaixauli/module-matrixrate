<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace WebShopApps\MatrixRate\Test\Unit\Model\Config\Source;

class FlatrateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \WebShopApps\MatrixRate\Model\Config\Source\Flatrate
     */
    protected $model;

    protected function setUp()
    {
        $this->model = new \WebShopApps\MatrixRate\Model\Config\Source\Flatrate();
    }

    public function testToOptionArray()
    {
        $expected = [
            ['value' => '', 'label' => __('None')],
            ['value' => 'O', 'label' => __('Per Order')],
            ['value' => 'I', 'label' => __('Per Item')]
        ];

        $this->assertEquals($expected, $this->model->toOptionArray());
    }
}
