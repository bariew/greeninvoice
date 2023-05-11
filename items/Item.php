<?php
/**
 * Item class file
 */

namespace bariew\greeninvoice\items;

use bariew\greeninvoice\Model;

/**
 * Class Item
 * @package bariew\greeninvoice\items
 */
class Item extends Model
{
    public $endpoint = '/items';
    public $name, $description, $price, $currency;
    public $business_id = '148e9169-d7c8-4d8c-8b70-5e07fa1aa98e';

    /**
     * @inheritDoc
     */
    public function __construct($name, $description, $price, $currency = 'ILS')
    {
        $this->name = $name;
        $this->description =  $description;
        $this->price = $price;
        $this->currency = $currency;
    }
}
