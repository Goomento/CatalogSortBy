<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Model\Config\Source;

/**
 * Class ConcreteList
 * @package Goomento\CatalogSortBy\Model\Config\Source
 */
class ConcreteList implements \Magento\Framework\Data\OptionSourceInterface
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
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        /** @var \Goomento\CatalogSortBy\Model\ConcreteInterface $concrete */
        foreach ($this->builder->build([]) as $key => $concrete) {
            $options[] = [
                'label' => $concrete->getName(),
                'value' => $key,
            ];
        }

        return $options;
    }
}
