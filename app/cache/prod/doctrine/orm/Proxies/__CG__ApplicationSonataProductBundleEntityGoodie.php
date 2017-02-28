<?php

namespace Proxies\__CG__\Application\Sonata\ProductBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Goodie extends \Application\Sonata\ProductBundle\Entity\Goodie implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'id', 'sku', 'slug', 'name', 'priceIncludingVat', 'description', 'rawDescription', 'descriptionFormatter', 'shortDescription', 'rawShortDescription', 'shortDescriptionFormatter', 'price', 'vatRate', 'stock', 'enabled', 'updatedAt', 'createdAt', 'packages', 'deliveries', 'productCategories', 'image', 'gallery', 'parent', 'variations', 'enabledVariations', 'productCollections', 'options');
        }

        return array('__isInitialized__', 'id', 'sku', 'slug', 'name', 'priceIncludingVat', 'description', 'rawDescription', 'descriptionFormatter', 'shortDescription', 'rawShortDescription', 'shortDescriptionFormatter', 'price', 'vatRate', 'stock', 'enabled', 'updatedAt', 'createdAt', 'packages', 'deliveries', 'productCategories', 'image', 'gallery', 'parent', 'variations', 'enabledVariations', 'productCollections', 'options');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Goodie $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', array($id));

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function addProductCollection(\Sonata\Component\Product\ProductCollectionInterface $productCollection)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addProductCollection', array($productCollection));

        return parent::addProductCollection($productCollection);
    }

    /**
     * {@inheritDoc}
     */
    public function removeProductCollection(\Sonata\Component\Product\ProductCollectionInterface $productCollection)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeProductCollection', array($productCollection));

        return parent::removeProductCollection($productCollection);
    }

    /**
     * {@inheritDoc}
     */
    public function getProductCollections()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProductCollections', array());

        return parent::getProductCollections();
    }

    /**
     * {@inheritDoc}
     */
    public function setProductCollections(\Doctrine\Common\Collections\ArrayCollection $productCollections)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProductCollections', array($productCollections));

        return parent::setProductCollections($productCollections);
    }

    /**
     * {@inheritDoc}
     */
    public function getCollections()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCollections', array());

        return parent::getCollections();
    }

    /**
     * {@inheritDoc}
     */
    public function setSku($sku)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSku', array($sku));

        return parent::setSku($sku);
    }

    /**
     * {@inheritDoc}
     */
    public function getSku()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSku', array());

        return parent::getSku();
    }

    /**
     * {@inheritDoc}
     */
    public function setSlug($slug)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSlug', array($slug));

        return parent::setSlug($slug);
    }

    /**
     * {@inheritDoc}
     */
    public function getSlug()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSlug', array());

        return parent::getSlug();
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', array($name));

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', array());

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescription', array($description));

        return parent::setDescription($description);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescription', array());

        return parent::getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setRawDescription($rawDescription)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRawDescription', array($rawDescription));

        return parent::setRawDescription($rawDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function getRawDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRawDescription', array());

        return parent::getRawDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescriptionFormatter($descriptionFormatter)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescriptionFormatter', array($descriptionFormatter));

        return parent::setDescriptionFormatter($descriptionFormatter);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescriptionFormatter()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescriptionFormatter', array());

        return parent::getDescriptionFormatter();
    }

    /**
     * {@inheritDoc}
     */
    public function setShortDescription($shortDescription)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setShortDescription', array($shortDescription));

        return parent::setShortDescription($shortDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function getShortDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getShortDescription', array());

        return parent::getShortDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setRawShortDescription($rawShortDescription)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRawShortDescription', array($rawShortDescription));

        return parent::setRawShortDescription($rawShortDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function getRawShortDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRawShortDescription', array());

        return parent::getRawShortDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setShortDescriptionFormatter($shortDescriptionFormatter)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setShortDescriptionFormatter', array($shortDescriptionFormatter));

        return parent::setShortDescriptionFormatter($shortDescriptionFormatter);
    }

    /**
     * {@inheritDoc}
     */
    public function getShortDescriptionFormatter()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getShortDescriptionFormatter', array());

        return parent::getShortDescriptionFormatter();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrice($price)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrice', array($price));

        return parent::setPrice($price);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrice($vat = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrice', array($vat));

        return parent::getPrice($vat);
    }

    /**
     * {@inheritDoc}
     */
    public function setUnitPrice($unitPrice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUnitPrice', array($unitPrice));

        return parent::setUnitPrice($unitPrice);
    }

    /**
     * {@inheritDoc}
     */
    public function getUnitPrice($vat = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUnitPrice', array($vat));

        return parent::getUnitPrice($vat);
    }

    /**
     * {@inheritDoc}
     */
    public function setQuantity($quantity)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setQuantity', array($quantity));

        return parent::setQuantity($quantity);
    }

    /**
     * {@inheritDoc}
     */
    public function getQuantity()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getQuantity', array());

        return parent::getQuantity();
    }

    /**
     * {@inheritDoc}
     */
    public function setVatRate($vatRate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVatRate', array($vatRate));

        return parent::setVatRate($vatRate);
    }

    /**
     * {@inheritDoc}
     */
    public function getVatRate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVatRate', array());

        return parent::getVatRate();
    }

    /**
     * {@inheritDoc}
     */
    public function setStock($stock)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStock', array($stock));

        return parent::setStock($stock);
    }

    /**
     * {@inheritDoc}
     */
    public function getStock()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStock', array());

        return parent::getStock();
    }

    /**
     * {@inheritDoc}
     */
    public function setEnabled($enabled)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEnabled', array($enabled));

        return parent::setEnabled($enabled);
    }

    /**
     * {@inheritDoc}
     */
    public function getEnabled()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEnabled', array());

        return parent::getEnabled();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedAt', array($updatedAt));

        return parent::setUpdatedAt($updatedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedAt', array());

        return parent::getUpdatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(\DateTime $createdAt = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedAt', array($createdAt));

        return parent::setCreatedAt($createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', array());

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function addPackage(\Sonata\Component\Product\PackageInterface $package)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addPackage', array($package));

        return parent::addPackage($package);
    }

    /**
     * {@inheritDoc}
     */
    public function removePackage(\Sonata\Component\Product\PackageInterface $package)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removePackage', array($package));

        return parent::removePackage($package);
    }

    /**
     * {@inheritDoc}
     */
    public function getPackages()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPackages', array());

        return parent::getPackages();
    }

    /**
     * {@inheritDoc}
     */
    public function setPackages(\Doctrine\Common\Collections\ArrayCollection $packages)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPackages', array($packages));

        return parent::setPackages($packages);
    }

    /**
     * {@inheritDoc}
     */
    public function addDelivery(\Sonata\Component\Product\DeliveryInterface $delivery)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addDelivery', array($delivery));

        return parent::addDelivery($delivery);
    }

    /**
     * {@inheritDoc}
     */
    public function removeDelivery(\Sonata\Component\Product\DeliveryInterface $delivery)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeDelivery', array($delivery));

        return parent::removeDelivery($delivery);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeliveries()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeliveries', array());

        return parent::getDeliveries();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeliveries(\Doctrine\Common\Collections\ArrayCollection $deliveries)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeliveries', array($deliveries));

        return parent::setDeliveries($deliveries);
    }

    /**
     * {@inheritDoc}
     */
    public function addDeliverie(\Sonata\Component\Product\DeliveryInterface $delivery)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addDeliverie', array($delivery));

        return parent::addDeliverie($delivery);
    }

    /**
     * {@inheritDoc}
     */
    public function removeDeliverie(\Sonata\Component\Product\DeliveryInterface $delivery)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeDeliverie', array($delivery));

        return parent::removeDeliverie($delivery);
    }

    /**
     * {@inheritDoc}
     */
    public function addProductCategorie(\Sonata\Component\Product\ProductCategoryInterface $productCategory)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addProductCategorie', array($productCategory));

        return parent::addProductCategorie($productCategory);
    }

    /**
     * {@inheritDoc}
     */
    public function removeProductCategorie(\Sonata\Component\Product\ProductCategoryInterface $productCategory)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeProductCategorie', array($productCategory));

        return parent::removeProductCategorie($productCategory);
    }

    /**
     * {@inheritDoc}
     */
    public function addProductCategory(\Sonata\Component\Product\ProductCategoryInterface $productCategory)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addProductCategory', array($productCategory));

        return parent::addProductCategory($productCategory);
    }

    /**
     * {@inheritDoc}
     */
    public function removeProductCategory(\Sonata\Component\Product\ProductCategoryInterface $productCategory)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeProductCategory', array($productCategory));

        return parent::removeProductCategory($productCategory);
    }

    /**
     * {@inheritDoc}
     */
    public function getProductCategories()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProductCategories', array());

        return parent::getProductCategories();
    }

    /**
     * {@inheritDoc}
     */
    public function setProductCategories(\Doctrine\Common\Collections\ArrayCollection $productCategories)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProductCategories', array($productCategories));

        return parent::setProductCategories($productCategories);
    }

    /**
     * {@inheritDoc}
     */
    public function getCategories()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCategories', array());

        return parent::getCategories();
    }

    /**
     * {@inheritDoc}
     */
    public function getMainCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMainCategory', array());

        return parent::getMainCategory();
    }

    /**
     * {@inheritDoc}
     */
    public function addVariation(\Sonata\Component\Product\ProductInterface $variation)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addVariation', array($variation));

        return parent::addVariation($variation);
    }

    /**
     * {@inheritDoc}
     */
    public function removeVariation(\Sonata\Component\Product\ProductInterface $variation)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeVariation', array($variation));

        return parent::removeVariation($variation);
    }

    /**
     * {@inheritDoc}
     */
    public function getVariations()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVariations', array());

        return parent::getVariations();
    }

    /**
     * {@inheritDoc}
     */
    public function setVariations(\Doctrine\Common\Collections\ArrayCollection $variations)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVariations', array($variations));

        return parent::setVariations($variations);
    }

    /**
     * {@inheritDoc}
     */
    public function hasVariations()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasVariations', array());

        return parent::hasVariations();
    }

    /**
     * {@inheritDoc}
     */
    public function setImage(\Sonata\MediaBundle\Model\MediaInterface $image = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setImage', array($image));

        return parent::setImage($image);
    }

    /**
     * {@inheritDoc}
     */
    public function getImage()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getImage', array());

        return parent::getImage();
    }

    /**
     * {@inheritDoc}
     */
    public function setGallery(\Sonata\MediaBundle\Model\GalleryInterface $gallery = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGallery', array($gallery));

        return parent::setGallery($gallery);
    }

    /**
     * {@inheritDoc}
     */
    public function getGallery()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGallery', array());

        return parent::getGallery();
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getParent', array());

        return parent::getParent();
    }

    /**
     * {@inheritDoc}
     */
    public function setParent(\Sonata\Component\Product\ProductInterface $parent)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setParent', array($parent));

        return parent::setParent($parent);
    }

    /**
     * {@inheritDoc}
     */
    public function getOptions()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOptions', array());

        return parent::getOptions();
    }

    /**
     * {@inheritDoc}
     */
    public function setOptions(array $options)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOptions', array($options));

        return parent::setOptions($options);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function isMaster()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isMaster', array());

        return parent::isMaster();
    }

    /**
     * {@inheritDoc}
     */
    public function isVariation()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isVariation', array());

        return parent::isVariation();
    }

    /**
     * {@inheritDoc}
     */
    public function isEnabled()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isEnabled', array());

        return parent::isEnabled();
    }

    /**
     * {@inheritDoc}
     */
    public function isSalable()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isSalable', array());

        return parent::isSalable();
    }

    /**
     * {@inheritDoc}
     */
    public function isRecurrentPayment()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isRecurrentPayment', array());

        return parent::isRecurrentPayment();
    }

    /**
     * {@inheritDoc}
     */
    public function preUpdate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'preUpdate', array());

        return parent::preUpdate();
    }

    /**
     * {@inheritDoc}
     */
    public function prePersist()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'prePersist', array());

        return parent::prePersist();
    }

    /**
     * {@inheritDoc}
     */
    public function setPriceIncludingVat($priceIncludingVat)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPriceIncludingVat', array($priceIncludingVat));

        return parent::setPriceIncludingVat($priceIncludingVat);
    }

    /**
     * {@inheritDoc}
     */
    public function isPriceIncludingVat()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isPriceIncludingVat', array());

        return parent::isPriceIncludingVat();
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toArray', array());

        return parent::toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function fromArray($array)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'fromArray', array($array));

        return parent::fromArray($array);
    }

    /**
     * {@inheritDoc}
     */
    public function hasOneMainCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasOneMainCategory', array());

        return parent::hasOneMainCategory();
    }

    /**
     * {@inheritDoc}
     */
    public function validateOneMainCategory(\Symfony\Component\Validator\ExecutionContextInterface $context)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'validateOneMainCategory', array($context));

        return parent::validateOneMainCategory($context);
    }

}
