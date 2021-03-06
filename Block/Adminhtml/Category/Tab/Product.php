<?php
declare(strict_types=1);

namespace Webiators\AdminCategoryProduct\Block\Adminhtml\Category\Tab;

use Webiators\AdminCategoryProduct\Block\Adminhtml\Category\Tab\Product\Grid\Renderer\Image;
use Magento\Framework\Data\Collection;

class Product extends \Magento\Catalog\Block\Adminhtml\Category\Tab\Product
{
    /**
     * Set collection object adding product thumbnail
     *
     * @param Collection $collection
     * @return void
     */
    public function setCollection($collection)
    {
        $collection->addAttributeToSelect('thumbnail')
        ->addAttributeToSelect('url_key')
        ->addAttributeToSelect('meta_title');
        $this->_collection = $collection;
    }

    /**
     * add column image with a custom renderer and after column entity_id
     * @return Product
     */
    protected function _prepareColumns(): Product
    {
        parent::_prepareColumns();
        $this->addColumnAfter(
            'image',
            [
                'header' => __('Thumbnail'),
                'index' => 'image',
                'renderer' => Image::class,
                'filter' => false,
                'sortable' => false,
                'column_css_class' => 'data-grid-thumbnail-cell'
            ],
            'entity_id'
        );
        $this->addColumnAfter(
            'url_key',
            [
                'header' => __('Product Url'),
                'index' => 'url_key'                
            ],
            'entity_id'
        );
        $this->addColumnAfter(
            'meta_title',
            [
                'header' => __('Meta Title'),
                'index' => 'meta_title'                
            ],
            'entity_id'
        );
        $this->sortColumnsByOrder();
        
        return $this;
    }
}
