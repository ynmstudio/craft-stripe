<?php

namespace craft\stripe\models;

use Craft;
use craft\base\Model;
use craft\models\FieldLayout;
use craft\stripe\elements\Price;
use craft\stripe\elements\Product;
use craft\stripe\elements\Subscription;

/**
 * Stripe settings
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 */
class Settings extends Model
{
    /**
     * @var string
     */
    public string $secretKey = '';

    /**
     * @var string
     */
    public string $publicKey = '';

    /**
     * @var string
     */
    public string $endpointSecret = '';

    /**
     * @var string
     */
    public string $webhookId = '';

    /**
     * @var string
     */
    public string $productUriFormat = '';

    /**
     * @var string
     */
    public string $productTemplate = '';

    /**
     * @var mixed
     */
    private mixed $_productFieldLayout;

    /**
     * @var mixed
     */
    private mixed $_priceFieldLayout;

    /**
     * @var mixed
     */
    private mixed $_subscriptionFieldLayout;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['secretKey', 'publicKey'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'secretKey' => Craft::t('stripe', 'Stripe Secret Key'),
            'publicKey' => Craft::t('stripe', 'Stripe Public Key'),
            'endpointSecret' => Craft::t('stripe', 'Stripe Endpoint Secret (webhooks)'),
            'productUriFormat' => Craft::t('stripe', 'Product URI format'),
            'productTemplate' => Craft::t('stripe', 'Product Template'),
        ];
    }

    /**
     * @return FieldLayout
     */
    public function getProductFieldLayout(): FieldLayout
    {
        if (!isset($this->_productFieldLayout)) {
            $this->_productFieldLayout = Craft::$app->fields->getLayoutByType(Product::class);
        }

        return $this->_productFieldLayout;
    }

    /**
     * @param FieldLayout $fieldLayout
     * @return void
     */
    public function setProductFieldLayout(FieldLayout $fieldLayout): void
    {
        $this->_productFieldLayout = $fieldLayout;
    }

    /**
     * @return FieldLayout
     */
    public function getPriceFieldLayout(): FieldLayout
    {
        if (!isset($this->_priceFieldLayout)) {
            $this->_priceFieldLayout = Craft::$app->fields->getLayoutByType(Price::class);
        }

        return $this->_priceFieldLayout;
    }

    /**
     * @param FieldLayout $fieldLayout
     * @return void
     */
    public function setPriceFieldLayout(FieldLayout $fieldLayout): void
    {
        $this->_priceFieldLayout = $fieldLayout;
    }

    /**
     * @return FieldLayout
     */
    public function getSubscriptionFieldLayout(): FieldLayout
    {
        if (!isset($this->_subscriptionFieldLayout)) {
            $this->_subscriptionFieldLayout = Craft::$app->fields->getLayoutByType(Subscription::class);
        }

        return $this->_subscriptionFieldLayout;
    }

    /**
     * @param FieldLayout $fieldLayout
     * @return void
     */
    public function setSubscriptionFieldLayout(FieldLayout $fieldLayout): void
    {
        $this->_subscriptionFieldLayout = $fieldLayout;
    }
}
