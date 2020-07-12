<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Model\Concretes;

/**
 * Class Datetime
 * @package Goomento\CatalogSortBy\Model\Concretes
 */
class Datetime extends AbstractConcrete
{
    const KEY = 'datetime';
    /**
     * @return string
     */
    public function getName(): string
    {
        return __("Date Time");
    }

    /**
     * @param $collection
     * @param null $direction
     * @return mixed|void
     */
    public function setCollection($collection, $direction = null)
    {
        $collection->setOrder('created_at', $direction ?? 'desc');
        return $collection;
    }
}
