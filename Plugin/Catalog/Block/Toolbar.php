<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Plugin\Catalog\Block;

use Goomento\CatalogSortBy\Helper\Config as ConfigHelper;
use Goomento\CatalogSortBy\Helper\Helper;
use Goomento\CatalogSortBy\Helper\Logger;

/**
 * Class Toolbar
 * @package Goomento\CatalogSortBy\Plugin\Catalog\Block
 */
class Toolbar
{
    /**
     * @var \Goomento\CatalogSortBy\Model\ConcreteComposite
     */
    protected $builder;

    private $executed = [];

    /**
     * Toolbar constructor.
     * @param \Goomento\CatalogSortBy\Model\ConcreteComposite $builder
     */
    public function __construct(
        \Goomento\CatalogSortBy\Model\ConcreteComposite $builder
    ) {
        $this->builder = $builder;
    }

    /**
     * @param \Magento\Catalog\Block\Product\ProductList\Toolbar $subject
     * @param callable $proceed
     * @param \Magento\Framework\Data\Collection $collection
     * @return $this|Toolbar
     * @see \Magento\Catalog\Block\Product\ProductList\Toolbar::setCollection()
     * @throws \Exception
     */
    public function aroundSetCollection(
        \Magento\Catalog\Block\Product\ProductList\Toolbar $subject,
        callable $proceed,
        $collection
    ) {
        $result = $proceed($collection);
        if (!ConfigHelper::staticIsActive()) {
            return $result;
        }
        $current_order = $subject->getCurrentOrder();
        if ($current_order) {
            $option = Helper::parseOptionId($current_order);
            if (!isset($this->executed[$current_order]) && isset($option['model'])) {
                try {
                    $this->builder->get($option['model'])->setCollection($subject->getCollection(), $option['direction']);
                } catch (\Exception $e) {
                    Logger::staticError($e->getMessage());
                } finally {
                    $this->executed[$current_order] = true;
                }
            }
        }
        return $this;
    }

    /**
     * @param \Magento\Catalog\Block\Product\ProductList\Toolbar $subject
     * @param callable $proceed
     * @param null $template
     * @return
     * @see \Magento\Catalog\Block\Product\ProductList\Toolbar::getTemplateFile()
     */
    public function aroundGetTemplateFile(
        \Magento\Catalog\Block\Product\ProductList\Toolbar $subject,
        callable $proceed,
        $template = null
    ) {
        if ($template && $template==='Magento_Catalog::product/list/toolbar/sorter.phtml') {
            if (ConfigHelper::staticConfigGetBool('remove_sorter_button')
                || (string)ConfigHelper::staticConfigGet('override_sorter_label')) {
                $template = 'Goomento_CatalogSortBy::product/list/toolbar/sorter.phtml';
            }
        }

        return $proceed($template);
    }
}
