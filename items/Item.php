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
    public $name, $description, $price, $currency; //required
    public $business_id;
}
