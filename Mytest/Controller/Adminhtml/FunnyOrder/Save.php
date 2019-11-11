<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-05
 * Time: 10:21
 */

namespace Vaimo\Mytest\Controller\Adminhtml\FunnyOrder;

use Vaimo\Mytest\Model\FunnyOrderInterface;

/**
 * Class Save
 * @package Vaimo\Mytest\Controller\Adminhtml\FunnyOrder
 */
class Save extends AbstractFunnyOrder
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $isPost = $this->getRequest()->isPost();
        if ($isPost) {
            $model = $this->getModel();
            $formData = $this->getRequest()->getParam('funnyorder');
            if (empty($formData)) {
                $formData = $this->getRequest()->getParams();
            }
            if (!empty($formData[FunnyOrderInterface::FIELD_ID])) {
                $id = $formData[FunnyOrderInterface::FIELD_ID];
                $model = $this->repository->getById($id);
            } else {
                unset($formData[FunnyOrderInterface::FIELD_ID]);
            }
            $model->setData($formData);
            try {
                $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('Order has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', [
                        'id' => $model->getId(),
                        '_current' => true
                    ]);
                }
                $this->_getSession()->setFormData(null);

                return $this->redirectToGrid();
            } catch (\Exception $e) {
                if ($e->getMessage()) {
                    $this->messageManager->addWarningMessage($e->getMessage());
                } else {
                    $this->messageManager->addErrorMessage(__('Order doesn\'t save'));
                }
            }
            $this->_getSession()->setFormData($formData);

            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', ['id' => $model->getId()])
                : $this->_redirect('*/*/edit');
        }

        return $this->doRefererRedirect();
    }
}
