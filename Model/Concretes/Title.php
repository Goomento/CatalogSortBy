<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Model\Concretes;

/**
 * Class Title
 * @package Goomento\CatalogSortBy\Model\Concretes
 */
class Title extends AbstractConcrete
{
    const KEY = 'title';

    /**
     * @return string
     */
    public function getName(): string
    {
        return __("Product Title");
    }

    /**
     * @param $collection
     * @param null $direction
     * @return mixed
     */
    public function setCollection($collection, $direction = null)
    {
        $collection->setOrder('name', $direction ?? 'asc');
        return $collection;
    }
}
