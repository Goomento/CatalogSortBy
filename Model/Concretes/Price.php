<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Model\Concretes;

/**
 * Class Price
 * @package Goomento\CatalogSortBy\Model\Concretes
 */
class Price extends AbstractConcrete
{
    const KEY = 'price';
    /**
     * @return string
     */
    public function getName(): string
    {
        return __("Product Price");
    }

    /**
     * @param $collection
     * @param null $direction
     * @return mixed
     */
    public function setCollection($collection, $direction = null)
    {
        $collection->setOrder('price', $direction ?? 'desc');
        return $collection;
    }
}
