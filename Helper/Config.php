<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Helper;


use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\Context;

/**
 * Class Config
 * @package Goomento\CatalogSortBy\Helper
 * @method staticGetOptions()
 */
class Config extends \Goomento\Base\Helper\AbstractConfig
{
    const MAX_INDEX = 10;

    protected $options = [];
    /**
     * Config constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context, ['goomento_catalog_sort_by', 'general']);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        if (empty($this->options) && $this->isActive()) {
            $options = [];
            for ($i = 1; $i <= self::MAX_INDEX; $i++) {
                $_path = "goomento_catalog_sort_by/options/option";
                $_scope = ScopeInterface::SCOPE_STORE;
                if ((bool)$this->scopeConfig->getValue("{$_path}{$i}/active", ScopeInterface::SCOPE_STORE)) {
                    $_model = $this->scopeConfig->getValue("{$_path}{$i}/model", $_scope);
                    $_direction = $this->scopeConfig->getValue("{$_path}{$i}/direction", $_scope);
                    $options[$i] = [
                        'model' => $_model,
                        'id' => Helper::getOptionId($_model, $_direction, $i),
                        'direction' => $_direction,
                        'title' => $this->scopeConfig->getValue("{$_path}{$i}/title", $_scope),
                        'sort_order' => $this->scopeConfig->getValue("{$_path}{$i}/sort_order", $_scope),
                    ];
                }
            }

            if (!empty($options)) {
                $options = $this->sortOptions($options);
            }

            $this->options = $options;
        }
        return $this->options;
    }

    private function sortOptions(array $options)
    {
        usort($options, function ($a, $b) {
            return (int)$a["sort_order"] >= (int)$b["sort_order"];
        });

        return $options;
    }
}
