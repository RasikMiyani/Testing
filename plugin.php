<type name="\Magento\Catalog\Model\Layer">
        <plugin name="lovesofas-search-result" type="Lovesofas\Custom\Plugin\CatalogSearchProductCollection" />
    </type>

Plugin file

<?php
 
namespace Lovesofas\Custom\Plugin;
 
class CatalogSearchProductCollection
{
    private $registry;

    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->registry = $registry;
        $this->request = $request;
    }

    public function aroundGetProductCollection(
        \Magento\Catalog\Model\Layer $subject,
        \Closure $proceed
    ) {
        
        $action = $this->request->getFullActionName();
        $result = $proceed();
        //catalogseach result page product collection asc order based on the product_search_scores
        if ($action == 'catalogsearch_result_index') {
            $result->addAttributeToSort('product_search_scores','DESC');
        }
        return $result;
    }
}
