<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_CatalogSortBy
 * @link https://github.com/Goomento/CatalogSortBy
 */

namespace Goomento\CatalogSortBy\Model\Concretes;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Select;

/**
 * Class Popularity
 * @package Goomento\CatalogSortBy\Model\Concretes
 */
class Popularity extends AbstractConcrete
{
    const KEY = 'popularity';
    /**
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected $connection;

    public function __construct(
        ResourceConnection $resource
    ) {
        $this->connection = $resource->getConnection('catalog');
    }

    public function getName(): string
    {
        return __('Popularity');
    }

    /**
     * @param $collection
     * @param null $direction
     * @return mixed|void
     */
    public function setCollection($collection, $direction = null)
    {
        $reportEventTable = $collection->getResource()->getTable('report_event');

        $subSelect = $this->connection->select()->from(
            ['report_event_table' => $reportEventTable],
            'COUNT(report_event_table.event_id)'
        )->where(
            'report_event_table.object_id = e.entity_id'
        );

        $collection->getSelect()->reset(Select::ORDER)->columns(
            ['views' => $subSelect]
        )->order('views ' . $direction ?? 'desc');

        return $collection;
    }
}
