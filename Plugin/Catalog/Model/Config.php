<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Plugin\Catalog\Model;

use Goomento\CatalogSortBy\Helper\Config as ConfigHelper;
use Goomento\CatalogSortBy\Helper\Helper;
use Goomento\CatalogSortBy\Helper\Logger;

/**
 * Class Config
 * @package Goomento\CatalogSortBy\Plugin\Catalog\Model
 */
class Config
{
    /**
     * @var \Goomento\CatalogSortBy\Model\ConcreteComposite
     */
    protected $builder;

    public function __construct(
        \Goomento\CatalogSortBy\Model\ConcreteComposite $builder
    ) {
        $this->builder = $builder;
    }

    /**
     * @param \Magento\Catalog\Model\Config $subject
     * @param callable $proceed
     * @see \Magento\Catalog\Model\Config::getAttributeUsedForSortByArray()
     * @return array
     */
    public function aroundGetAttributeUsedForSortByArray(
        \Magento\Catalog\Model\Config $subject,
        callable $proceed
    ) {
        if (!ConfigHelper::staticIsActive()) {
            return $proceed();
        }
        $results = [];
        if ($options = ConfigHelper::staticGetOptions()) {
            foreach ($options as $option) {
                $model = Helper::parseOptionId($option['id'])['model'];
                try {
                    $results[$option['id']] = $option['title'] ?: $this->builder->get($model)->getName();
                } catch (\Exception $e) {
                    Logger::staticError($e->getMessage());
                }
            }
        }

        return $results;
    }
}
