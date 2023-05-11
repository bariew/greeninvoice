<?php
/**
 * Model class file
 */


namespace bariew\greeninvoice;

/**
 * Class Model
 * @package bariew\greeninvoice
 */
abstract class Model
{
    public $endpoint;

    /**
     * @return array
     */
    public function toArray()
    {
        foreach (get_object_vars($this) as $k => $v) { /** @var static $v */
            if (is_null($v) || ($k == 'endpoint')) continue;
            $result[$k] = is_object($v) ? $v->toArray() : $v;
        }
        return $result ?? [];
    }
}





















