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
    public $description, $price, $currency; //required
    public $itemId, $catalogNum, $currencyRate, $vatRate;
    public $quantity = 1;
    public $vatType = 0;
}
