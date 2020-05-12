<?php

namespace UserManagement\Entity; // added by Stoyan

use Doctrine\ORM\Mapping as ORM;
// added by Stoyan
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation; // !!!! Absolutely neccessary

// setters and getters - Zend\Stdlib\Hydrator\ClassMethods, for public properties - Zend\Stdlib\Hydrator\ObjectProperty, array 
// Zend\Stdlib\Hydrator\ArraySerializable
// Follows the definition of ArrayObject. 
// Objects must implement either the exchangeArray() or populate() methods to support hydration, 
// and the getArrayCopy() method to support extraction.
// https://bitbucket.org/todor_velichkov/homeworkuniversity/src/935b37b87e3f211a72ee571142571089dffbf82d/module/University/src/University/Form/StudentForm.php?at=master

// read here http://framework.zend.com/manual/2.1/en/modules/zend.form.quick-start.html

/**
 * Exchanges
 *
 * @ORM\Table(name="exchanges")
 * @ORM\Entity(repositoryClass="UserManagement\Entity\Repository\UserRepository")
 * @Annotation\Name("exchange")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Exchange
{
   
    /**
     * @var integer
     *
     * @ORM\Column(name="exchange_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
	 * @Annotation\Exclude()
     */
    private $exchangeId;
   
    
    /**
     * @var string
     *
     * @ORM\Column(name="from_country", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"From country:"})	 
     */
    private $fromCountry;


    /**
     * @var string
     *
     * @ORM\Column(name="to_country", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"To country:"})	 
     */
    private $toCountry;
   
    /**
     * @var string
     *
     * @ORM\Column(name="from_currency", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":5}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"From currency:"})	 
     */
    private $fromCurrency;


    /**
     * @var string
     *
     * @ORM\Column(name="to_currency", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":5}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"To currency:"})	 
     */
    private $toCurrency;
   
    
    /**
     * @var float
     *
     * @ORM\Column(name="to_currency", type="float", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":10}})
     * @Annotation\Attributes({"type":"float"})
     * @Annotation\Options({"label":"Rate of exchange:"})	 
     */
    private $rateOfExchange;
   
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="rate_of_exchange_date", type="datetime", nullable=true)
     * @Annotation\Attributes({"type":"datetime","min":"2010-01-01T00:00:00Z","max":"2020-01-01T00:00:00Z","step":"1"})
     * @Annotation\Options({"label":"Rate of exchange date:", "format":"Y-m-d\TH:iP"})
     */
    private $rateOfExchangeDate; 
  

	public function __construct()
	{
		
	}
	
    /**
     * Set fromCountry
     *
     * @param string $fromCountry
     */
    public function setFromCountry($fromCountry)
    {
        $this->fromCountry = $fromCountry;
    
        return $this;
    }

    /**
     * Get fromCountry
     *
     * @return string 
     */
    public function getFromCountry()
    {
        return $this->fromCountry;
    }

   
    /**
     * Set toCountry
     *
     * @param string $toCountry
     */
    public function setToCountry($toCountry)
    {
        $this->toCountry = $toCountry;
    
        return $this;
    }

    /**
     * Get toCountry
     *
     * @return string 
     */
    public function getToCountry()
    {
        return $this->toCountry;
    }


   /**
     * Set fromCurrency
     *
     * @param string $fromCurrency
     */
    public function setFromCurrency($fromCurrency)
    {
        $this->fromCurrency = $fromCurrency;
    
        return $this;
    }

    /**
     * Get fromCurrency
     *
     * @return string 
     */
    public function getFromCurrency()
    {
        return $this->fromCurrency;
    }


    /**
     * Set toCurrency
     *
     * @param string $toCurrency
     */
    public function setToCurrency($toCurrency)
    {
        $this->toCurrency = $toCurrency;
    
        return $this;
    }

    /**
     * Get toCurrency
     *
     * @return string 
     */
    public function getToCurrency()
    {
        return $this->toCurrency;
    }


    /**
     * Set rateOfExchange
     *
     * @param string $rateOfExchange
     */
    public function setRateOfExchange($rateOfExchange)
    {
        $this->rateOfExchange = $rateOfExchange;
    
        return $this;
    }

    /**
     * Get rateOfExchange
     *
     * @return string 
     */
    public function getRateOfExchange()
    {
        return $this->rateOfExchange;
    }


    /**
     * Set rateOfExchangeDate
     *
     * @param string $rateOfExchangeDate
     */
    public function setRateOfExchangeDate($rateOfExchangeDate)
    {
        $this->rateOfExchangeDate = $rateOfExchangeDate;
    
        return $this;
    }

    /**
     * Get rateOfExchangeDate
     *
     * @return string 
     */
    public function getRateOfExchangeDate()
    {
        return $this->rateOfExchangeDate;
    }

	
    /**
     * Get exchangeId
     *
     * @return integer 
     */
    public function getExchangeId()
    {
        return $this->exchangeId;
    }
}