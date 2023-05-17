<?php
/**
 * Document class file
 */

namespace bariew\greeninvoice\documents;

use bariew\greeninvoice\Model;
use bariew\greeninvoice\clients\Client;

/**
 * Class Document
 * @package bariew\greeninvoice\documents
 */
class Document extends Model
{
    const TYPE_BID = 10;
    const TYPE_INVITATION = 100;
    const TYPE_SHIPPING_CERTIFICATE = 200;
    const TYPE_RETURN_CERTIFICATE = 210;
    const TYPE_TRANSACTION_ACCOUNT = 300;
    const TYPE_INVOICE = 305;
    const TYPE_TAX_INVOICE = 320;
    const TYPE_CREDIT_INVOICE = 330;
    const TYPE_ACCEPTANCE = 400;
    const TYPE_DONATION_RECEIPT = 405;
    const TYPE_PURCHAISE_ORDER = 500;
    const TYPE_RECEIVING_DEPOSIT = 600;
    const TYPE_DEPOSIT_WITHDRAWAL = 610;

    /**
     * The endpoint for document request.
     *
     * @var string
     */
    public $endpoint = '/documents';

    /**
     * Document's description.
     *
     * @var string required
     */
    public $description;

    /**
     * Primary language.
     *
     * @var string required
     */
    public $lang;

    /**
     * Primary currency.
     *
     * @var string required
     */
    public $currency;

    /**
     * Document's remarks.
     *
     * @var string
     */
    public $remarks;

    /**
     * Texts appearing in footer.
     *
     * @var string
     */
    public $footer;

    /**
     * Custom extra text appearing in email sent to customer.
     *
     * @var string
     */
    public $emailContent;

    /**
     * Document type.
     *
     * @var int
     */
    public $type = self::TYPE_TAX_INVOICE;

    /**
     * Document date in the format YYYY-MM-DD.
     *
     * @var string
     */
    public $date;

    /**
     * Document payment due date in the format YYYY-MM-DD.
     *
     * @var string
     */
    public $dueDate;

    /**
     * Vat type for that document.
     *
     * @var int
     */
    public $vatType = 1;

    /**
     * Discount information.
     *
     * @var object
     */
    public $discount;

    /**
     * Round the amounts?
     *
     * @var bool
     */
    public $rounding = false;

    /**
     * Digital sign the document?
     *
     * @var bool
     */
    public $signed = true;

    /**
     * Attach the document in the email sent to recipient?
     *
     * @var bool
     */
    public $attachment;

    /**
     * @var array
     */
    public $paymentRequestData;

    /**
     * Client information.
     *
     * @var Client
     */
    public $client;

    /**
     * Income rows.
     *
     * @var Income[]
     */
    public $income;

    /**
     * Payment rows.
     *
     * @var Payment[]
     */
    public $payment;

    /**
     * Linked document IDs.
     * allows you to state the related / relevant documents, e.g.: when creating a receipt,
     * attach your original invoice document ID as one of the ids in the linkedDocumentIds -
     * this in turn will automatically close the original invoice if needed.
     *
     * @var array
     */
    public $linkedDocumentIds = [];

    /**
     * Linked payment ID (valid for document type 305 only).
     * allows you to define the paymentId that the document is going to be relevant to,
     * this can be attached only to invoice documents (type 305).
     *
     * @var string
     */
    public $linkedPaymentId;

    /**
     * Reference type (applicable only when using linkedDocumentIds)
     *
     * @var string
     */
    public $linkType;

    /**
     * @inheritDoc
     */
    public function __construct($data = [])
    {
        $this->date = date('Y-m-d');
        parent::__construct($data);
    }
}
