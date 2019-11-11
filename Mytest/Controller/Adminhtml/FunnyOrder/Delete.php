<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-05
 * Time: 12:29
 */

namespace Vaimo\Mytest\Controller\Adminhtml\FunnyOrder;

/**
 * Class Delete
 * @package Vaimo\Mytest\Controller\Adminhtml\FunnyOrder
 */
class Delete extends AbstractFunnyOrder
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        if ($id) {
            try {
                $this->repository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You deleted chosen item.'));

                // go to grid
                return $this->redirectToGrid();
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());

                // go to grid
                return $this->redirectToGrid();
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find an item to delete.'));

        // go to grid
        return $this->redirectToGrid();
    }
}
