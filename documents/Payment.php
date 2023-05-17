<?php
/**
 * Payment class file
 */

namespace bariew\greeninvoice\documents;

use bariew\greeninvoice\Model;

/**
 * Class Payment
 * @package bariew\greeninvoice\documents
 */
class Payment extends Model
{
    const TYPE_NOT_PAID = -1;
    const TYPE_IN_PROGRESS = 0;
    const TYPE_CASH = 1;
    const TYPE_CHECK = 2;
    const TYPE_CREDIT_CARD = 3;
    const TYPE_BANK_TRANSFER = 4;
    const TYPE_PAYPAL = 5;
    const TYPE_PAYMENT_APP = 1;
    const TYPE_OTHER = 11;


    /**
     * @var float required
     */
    public $price;

    /**
     * 3-letter ISO item currency code.
     *
     * @var string required
     */
    public $currency;

    /**
     * Payment date in the format YYYY-MM-DD.
     *
     * @var string
     */
    public $date;

    /**
     * Payment method.
     *
     * @var int
     */
    public $type = self::TYPE_CREDIT_CARD;

    /**
     * Currency rate relative to ILS, If not set - decided by the rates of requested payment date.
     *
     * @var float
     */
    public $currencyRate;

    /**
     * Bank name (required when using Cheques).
     *
     * @var string
     */
    public $bankName;

    /**
     * Bank branch (required when using Cheques).
     *
     * @var string
     */
    public $bankBranch;

    /**
     * Bank account (required when using Cheques).
     *
     * @var string
     */
    public $bankAccount;

    /**
     * Cheque number (required when using Cheques).
     *
     * @var string
     */
    public $chequeNum;

    /**
     * PayPal account ID.
     *
     * @var string
     */
    public $accountId;

    /**
     * PayPal transaction ID.
     *
     * @var string
     */
    public $transactionId;

    /**
     * Credit card type.
     *
     * @var int
     */
    public $cardType;

    /**
     * Credit card's last 4 digits.
     *
     * @var string
     */
    public $cardNum;

    /**
     * Credit card deal type.
     *
     * @var int
     */
    public $dealType;

    /**
     * Credit card's payments count (1-36).
     *
     * @var int
     */
    public $numPayments;

    /**
     * Credit card's first payment.
     *
     * @var float
     */
    public $firstPayment;

    /**
     * @inheritDoc
     */
    public function __construct($data = [])
    {
        $this->date = date('Y-m-d');
        parent::__construct($data);
    }
}
