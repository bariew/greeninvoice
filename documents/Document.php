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
    const TYPE_INVOICE = 320; // tax invoice

    /**
     * The endpoint for document request.
     *
     * @var string
     */
    public $endpoint = '/documents';

    /**
     * Document's description.
     *
     * @var string
     */
    public $description;

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
    public $type = self::TYPE_INVOICE;

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
     * Primary language.
     *
     * @var string
     */
    public $lang;

    /**
     * Primary currency.
     *
     * @var string
     */
    public $currency;

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
     * Document constructor.
     * @param Income $income
     * @param $description
     * @param string $lang
     * @param string $currency
     */
    public function __construct($description, string $lang = 'he', string $currency = 'ILS')
    {
        $this->description = $description;
        $this->lang = $lang;
        $this->currency = $currency;
        $this->date = date('Y-m-d');
    }
}
