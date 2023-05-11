<?php
/**
 * Client class file
 */
 
namespace bariew\greeninvoice\clients;

use bariew\greeninvoice\Model;

/**
 * Class Client
 * @package bariew\greeninvoice\clients
 */
class Client extends Model
{
    public $endpoint = 'clients';
    /**
     * The client name.
     *
     * @var string
     */
    public $name;

    /**
     * Is the client currently active or not.
     *
     * @var bool
     */
    public $active = true;

    /**
     * The client department.
     *
     * @var string
     */
    public $department;

    /**
     * The client tax ID.
     *
     * @var string
     */
    public $taxId;

    /**
     * The client accounting key.
     *
     * @var string
     */
    public $accountingKey;

    /**
     * The client payment term.
     *
     * @var int
     */
    public $paymentTerms = 0;

    /**
     * The client bank name.
     *
     * @var string
     */
    public $bankName;

    /**
     * The client bank branch number.
     *
     * @var string
     */
    public $bankBranch;

    /**
     * The client bank account number.
     *
     * @var string
     */
    public $bankAccount;

    /**
     * The client address.
     *
     * @var string
     */
    public $address;

    /**
     * The client city.
     *
     * @var string
     */
    public $city;

    /**
     * The client zip code.
     *
     * @var string
     */
    public $zip;

    /**
     * 2-letter ISO client country code.
     *
     * @var string
     */
    public $country = 'IL';

    /**
     * The category this client is related to.
     *
     * @var int
     */
    public $category;

    /**
     * The sub category this client is related to.
     *
     * @var int
     */
    public $subCategory;

    /**
     * The client phone number.
     *
     * @var string
     */
    public $phone;

    /**
     * The client fax number.
     *
     * @var string
     */
    public $fax;

    /**
     * The client mobile number.
     *
     * @var string
     */
    public $mobile;

    /**
     * Client remarks for self use.
     *
     * @var string
     */
    public $remarks;

    /**
     * The client contact person name.
     *
     * @var string
     */
    public $contactPerson;

    /**
     * Emails.
     *
     * @var array
     */
    public $emails = [];

    /**
     * Labels.
     *
     * @var array
     */
    public $labels = [];

    public $add = false;
    public $self = false;

    /**
     * @inheritDoc
     */
    public function __construct(string $name, $emails)
    {
        $this->name = $name;
        $this->emails = (array) $emails;
    }
}
