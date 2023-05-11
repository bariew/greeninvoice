<?php
/**
 * Item class file
 */

namespace bariew\greeninvoice\businesses;

use bariew\greeninvoice\Model;

/**
 * Class Item
 * @package bariew\greeninvoice\businesses
 */
class Business extends Model
{
    const TYPE_OSEK_MURSHE = 1;
    const TYPE_LTD_COMPANY = 2;
    const TYPE_OSEK_PATUR = 3;
    const TYPE_NON_PROFIT_ORGANIZATION = 4;
    const TYPE_PUBLIC_BENEFIT_COMPANY = 5;
    const TYPE_PARTNERSHIP = 6;

    public $endpoint = '/businesses';
    public $taxId, $name, $nameEn, $title, $titleEn, $address, $cityId, $phone, $category, $subCategory;
    public $type = self::TYPE_OSEK_MURSHE;

    /**
     * @inheritDoc
     */
    public function __construct($taxId, $name, $nameEn)
    {
        $this->taxId = $taxId;
        $this->name = $name;
        $this->nameEn =  $nameEn;
    }
}
