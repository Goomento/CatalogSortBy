<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Model\Config\Source;

/**
 * Class Direction
 * @package Goomento\CatalogSortBy\Model\Config\Source
 */
class Direction implements \Magento\Framework\Data\OptionSourceInterface
{

    /**
     * @return array|array[]
     */
    public function toOptionArray()
    {
        return [
            [
                'label' => __('Ascending'),
                'value' => 'asc',
            ],
            [
                'label' => __('Descending'),
                'value' => 'desc',
            ],
        ];
    }
}
