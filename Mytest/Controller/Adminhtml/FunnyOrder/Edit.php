<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-05
 * Time: 08:52
 */

namespace Vaimo\Mytest\Controller\Adminhtml\FunnyOrder;

/**
 * Class Edit
 * @package Vaimo\Mytest\Controller\Adminhtml\FunnyOrder
 */
class Edit extends AbstractFunnyOrder
{
    /**
     *
     */
    const TITLE = 'Funny form';
    /**
     *
     */
    const BREADCRUMB_TITLE = 'Funny form';

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        if (!empty($id)) {
            try {
                $model = $this->repository->getById($id);
                $this->_getSession()->setCurrentFunnyOrderModel($model);
            } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
                $this->messageManager->addErrorMessage(__('Entity with id %1 not found', $id));

                return $this->redirectToGrid();
            }
        } else {
            if ($this->_getSession()->getFormData()) {
                $model = $this->getModel();
                $model->setData($this->_getSession()->getFormData());
                $this->_getSession()->setFormData(null);
                $this->_getSession()->setCurrentFunnyOrderModel($model);
            }
        }

        return parent::execute();
    }
}
