<?php
/**
 * Model class file
 */


namespace bariew\greeninvoice;

use bariew\greeninvoice\clients\Client;
use bariew\greeninvoice\documents\Document;
use bariew\greeninvoice\documents\Income;
use bariew\greeninvoice\documents\Payment;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;


/**
 * Class Model
 * @package bariew\greeninvoice
 *
 * @url https://www.greeninvoice.co.il/api-docs#/introduction/overview/authorization
 */
class Api
{
    /**
     * The base URL for the Model API.
     *
     * @var string
     */
    public $url = 'https://sandbox.d.greeninvoice.co.il/api/v1'; //production 'https://api.greeninvoice.co.il/api/v1'
    public $id, $secret; // get it from the greenenvoice and put in the local config
    public $token;// = 'JWT';

    private static $_instance;

    /**
     * @return static
     */
    public static function instance($id = null, $secret = null, $url = 'https://sandbox.d.greeninvoice.co.il/api/v1')
    {
        if (static::$_instance) {
            return static::$_instance;
        }
        $model = new static();
        $model->id = $id;
        $model->secret = $secret;
        $model->url = $url;
        static::$_instance = $model;
        return $model;
    }

    /**
     * Yii framework instance
     * @return static
     */
    public static function yii()
    {
        extract(\Yii::$app->params['greenInvoice']); /** @var $id */ /** @var $secret */ /** @var $url */
        return static::instance($id, $secret, $url);
    }

    /**
     * @param string $description
     * @param string $clientName
     * @param string $clientEmail
     * @param string $itemName
     * @param float $itemPrice
     * @param string $language en he
     * @param string $currency USD ILS
     * @return mixed
     *
     * @example response
     *  [
        'id' => '3f35c548-6ba0-4099-b2bc-f189ce7ef00c',
        'client' => [], 'number' => 50009, 'type' => 320, 'signed' => true, 'lang' => 'en',
        'url' => [
            'origin' => 'https://www.greeninvoice.co.il/api/v1/documents/download?d=zAZeHKAQCb1DZkQ0yMWPfXbz827r9mnJwDXCKB81%2BctUkp%2BrGSXhi3bEBjFKWQqQ%2Bw1gwOjpx6IfJa9eOx7mYCICci25iljPXk%2BKK925B%2BhRpG2PKb9Gvw1BWYkZfoOt7vEjVC%2F2tA%2BZPE9xUVQ8pkWBgydRvaX5',
            'he' => 'https://www.greeninvoice.co.il/api/v1/documents/download?d=zAZeHKAQCb1AZkQ0yMWPfXbz827r9mnJwDXCKB81%2BctUkp%2BrGSXhi3bEBjFKWQqQ%2Bw1gwOjpx6IfJa9eOx7mYCICci25iljPXk%2BKK925B%2BhRpG2PKb9Gvw1BWYkZfoOt7vEjVC%2F2tA%2BZPE9xUVQ8pkWBhSJTt6v5',
            'en' => 'https://www.greeninvoice.co.il/api/v1/documents/download?d=zAZeHKAQCb1BZkQ0yMWPfXbz827r9mnJwDXCKB81%2BctUkp%2BrGSXhi3bEBjFKWQqQ%2Bw1gwOjpx6IfJa9eOx7mYCICci25iljPXk%2BKK925B%2BhRpG2PKb9Gvw1BWYkZfoOt7vEjVC%2F2tA%2BZPE9xUVQ8pkWBgC5RtKr5',
        ],
    ];
     */
    public function createInvoice($description, $clientName, $clientEmail, $itemName, $itemPrice, $language = 'en', $currency = 'USD', $callback = null)
    {
        $doc = new Document(['desciption' => $description, 'lang' => $language, 'currency' => $currency]);
        $doc->client = $this->search(new Client(), ['email' => $clientEmail])['items'][0] ?? new Client(['name' => $clientName, 'emails' => (array) $clientEmail]);
        $doc->income = [new Income(['desciption' => $itemName, 'price' => $itemPrice, 'currency' => $currency])];
        $doc->payment = [new Payment(['price' => $itemPrice, 'currency' => $currency])];
        $callback && call_user_func($callback, $doc);
        return $this->add($doc)['id'];
    }


    // API METHODS

    /**
     * @param Model $model
     * @return array
     */
    public function add(Model $model)
    {
        return $this->request($model->endpoint, 'POST', $model->toArray());
    }

    /**
     * @param Model $model
     * @param $id
     * @return array
     */
    public function get(Model $model, $id)
    {
        return $this->request($model->endpoint . "/{$id}");
    }

    /**
     * @param Model $model
     * @param $id
     * @return array
     */
    public function update(Model $model, $id)
    {
        return $this->request($model->endpoint . "/{$id}", 'PUT', $model->toArray());
    }

    /**
     * @param Model $model
     * @param $id
     * @return array
     */
    public function close(Model $model, $id)
    {
        return $this->request($model->endpoint . "/{$id}/close", 'POST');
    }

    /**
     * @param Model $model
     * @param array $data
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function search(Model $model, $data = [], $page = 1, $pageSize = 20)
    {
        $result = $this->request($model->endpoint . "/search", 'POST', array_merge($data, [
            'page' => $page, 'pageSize' => $pageSize
        ]));
        foreach ($result['items'] as $k => $item) {
            $result['items'][$k] = new $model($item);
        }
        return $result;
    }


    // PRIVATE

    /**
     * @return $this
     */
    private function login()
    {
        $this->token = 'JWT';
        $result = $this->request('/account/token', 'POST', [
            'id' => $this->id,
            'secret' => $this->secret,
        ]);
        $this->token = @$result['token'];
        return $this;
    }

    /**
     * @param string $path
     * @param mixed $body
     * @param string $method
     * @return array
     */
    public function request($path, $method = 'GET', $body = null)
    {
        if (!$this->token) {
            $this->login();
        }
        $response = (new GuzzleClient())->request($method, $this->url . $path, [
            'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $this->token],
            'body' => json_encode($body),
            'curl' => [CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2],
        ]);
        return json_decode($response->getBody(), true);
    }
}