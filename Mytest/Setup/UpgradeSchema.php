<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-01
 * Time: 17:38
 */

namespace Vaimo\Mytest\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Vaimo\Mytest\Model\FunnyOrderInterface;

/**
 * Class UpgradeSchema
 * @package Vaimo\Mytest\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.2.5','<')) {

            $setup->startSetup();
            $tableElevator = $setup->getConnection()->newTable(
                $setup->getTable( FunnyOrderInterface::TABLE_NAME)
            )->addColumn(
                FunnyOrderInterface::FIELD_ID,
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
                'Fun order ID'
            )->addColumn(
                FunnyOrderInterface::FIELD_CREATE_ORDER,
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'default' => Table::TIMESTAMP_INIT,'nullable' => false
                ],
                'create order'
            )->addColumn(
                FunnyOrderInterface::FIELD_FUN_START,
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false],
                'start fun'
            )->addColumn(
                FunnyOrderInterface::FIELD_FUN_END,
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false],
                'fun end'
            )->addColumn(
                FunnyOrderInterface::FIELD_WISH,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Customer wishes'
            )->addColumn(
                FunnyOrderInterface::FIELD_STATUS,
                Table::TYPE_BOOLEAN,
                255, ['default' => 1 ,'nullable' => false],
                'status'
            )->addColumn(
                FunnyOrderInterface::FIELD_PHONE,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'phone'
            )->setComment(
                'Fun order table '
            );
            $setup->getConnection()->createTable($tableElevator);
            $setup->endSetup();
        }
    }
}
