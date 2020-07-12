<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Model;


/**
 * Interface ConcreteInterface
 * @package Goomento\CatalogSortBy\Model
 */
interface ConcreteInterface extends \Goomento\Base\Model\BuilderInterface
{
    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @param $collection
     * @param null $direction
     * @return mixed
     */
    public function setCollection($collection, $direction = null);
}
