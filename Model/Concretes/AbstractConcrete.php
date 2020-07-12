<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Model\Concretes;

/**
 * Class AbstractConcrete
 * @package Goomento\CatalogSortBy\Model\Concretes
 */
abstract class AbstractConcrete implements \Goomento\CatalogSortBy\Model\ConcreteInterface
{
    const KEY = '';

    public function build(array $buildSubject)
    {
        $buildSubject[static::KEY] = $this;
        return $buildSubject;
    }
}
