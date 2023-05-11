<?php
/**
 * Income class file
 */

namespace bariew\greeninvoice\documents;

use bariew\greeninvoice\Model;

/**
 * Class Income
 * @package bariew\greeninvoice\documents
 */
class Income extends Model
{
    public $itemId, $catalogNum, $description, $price, $currency, $currencyRate, $vatRate;
    public $quantity = 1;
    public $vatType = 0;


    public function __construct($description, $price, string $currency = 'ILS')
    {
        $this->description = $description;
        $this->price = $price;
        $this->currency = $currency;
    }
}
