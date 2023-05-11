<?php
/**
 * Me class file
 */

namespace bariew\greeninvoice\users;

use bariew\greeninvoice\Model;

/**
 * Class Me
 * @package bariew\greeninvoice\users
 */
class Me extends Model
{
    /**
     * The endpoint for token request.
     *
     * @var string
     */
    public $endpoint = '/users/me';
}
