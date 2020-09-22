<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace EccDom\AdminAbstractProductsCategoryFilter\Ui\DataProvider\Product\Related;

use Magento\Framework\Api\Filter;

/**
 * Class RelatedDataProvider
 *
 * @api
 * @since 101.0.0
 */
class RelatedDataProvider extends AbstractDataProvider
{
    /**
     * {@inheritdoc
     * @since 101.0.0
     */
    protected function getLinkType()
    {
        return 'relation';
    }

    public function addFilter(Filter $filter)
    {
        if ($filter->getField() == 'category_id') {
            $this->getCollection()->addCategoriesFilter(array('in' => $filter->getValue()));
        } else if (isset($this->addFilterStrategies[$filter->getField()])) {
            $this->addFilterStrategies[$filter->getField()]
                ->addFilter(
                    $this->getCollection(),
                    $filter->getField(),
                    [$filter->getConditionType() => $filter->getValue()]
                );
        } else {
            parent::addFilter($filter);
        }
    }

}
