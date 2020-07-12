<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Model\Concretes;

/**
 * Class Position
 * @package Goomento\CatalogSortBy\Model\Concretes
 */
class Position extends AbstractConcrete
{
    const KEY = 'position';
    /**
     * @return string
     */
    public function getName(): string
    {
        return __("Position");
    }

    /**
     * @param $collection
     * @param null $direction
     * @return mixed|void
     */
    public function setCollection($collection, $direction = null)
    {
        $collection->setOrder('position', $direction ?? 'desc');
        return $collection;
    }
}
