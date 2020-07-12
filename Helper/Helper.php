<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Helper;

/**
 * Class Helper
 * @package Goomento\CatalogSortBy\Helper
 */
class Helper extends \Goomento\Base\Helper\AbstractHelper
{
    const DELIMITER = '__';

    /**
     * @param $model
     * @param $direction
     * @param $index
     * @return string
     */
    public static function getOptionId($model, $direction, $index)
    {
        return implode(self::DELIMITER, func_get_args());
    }

    /**
     * @param string $id
     * @return array
     */
    public static function parseOptionId(string $id)
    {
        $id = explode(self::DELIMITER, $id);
        return count($id) === 3 ? array_combine(['model', 'direction', 'index'], $id) : [];
    }
}
