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
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="UserManagement\Entity\Repository\UserRepository")
 * @Annotation\Name("user")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Username:"})	 
     */
    private $userName;


    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=60, nullable=false)
	 * @Annotation\Type("Zend\Form\Element\Email")
     * @Annotation\Options({"label":"Your email address:"})
     */
    private $userEmail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_gender", type="boolean", nullable=false)
	 * @Annotation\Type("Zend\Form\Element\Radio")
	 * @Annotation\Options({
	 * "label":"User Active:",
	 * "value_options":{"1":"Male", "0":"Female"}})
     */
    private $userGender;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="user_phone", type="integer", length=10, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":10}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Your phone number:"})	 
     */
    private $userPhone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_favorite", type="string", length=50, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":50}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Your favorite:"})	 
     */
    private $userFavorite;

      /**
     * @var string
     *
     * @ORM\Column(name="user_picture", type="string", length=50, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":50}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Your picture:"})	 
     */
    private $userPicture;
   
   
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
	 * @Annotation\Exclude()
     */
    private $userId;

	public function __construct()
	{
		//$this->userRegistrationDate = new \DateTime();
	}
	
    /**
     * Set userName
     *
     * @param string $userName
     * @return Users
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    
        return $this;
    }

    /**
     * Get userName
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
    }

   
    /**
     * Set userEmail
     *
     * @param string $userEmail
     * @return Users
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    
        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string 
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userFavorite
     *
     * @param string $userFavorite
     * @return Users
     */
    public function setUserFavorite($userFavorite)
    {
        $this->userFavorite = $userFavorite;
    
        return $this;
    }

    /**
     * Get userFavorite
     *
     * @return string 
     */
    public function getUserFavorite()
    {
        return $this->userFavorite;
    }
    

    /**
     * Set userGender
     *
     * @param string $userGender
     * @return Users
     */
    public function setUserGender($userGender)
    {
        $this->userGender = $userGender;
    
        return $this;
    }

    /**
     * Get userGender
     *
     * @return string 
     */
    public function getUserGender()
    {
        return $this->userGender;
    }
    
    /**
     * Set userPhone
     *
     * @param string $userPhone
     * @return Users
     */
    public function setUserPhone($userPhone)
    {
        $this->userPhone = $userPhone;
    
        return $this;
    }

    /**
     * Get userPhone
     *
     * @return string 
     */
    public function getUserPhone()
    {
        return $this->userPhone;
    }

    /**
     * Set userPicture
     *
     * @param string $userPicture
     * @return Users
     */
    public function setUserPicture($userPicture)
    {
        $this->userPicture = $userPicture;
    
        return $this;
    }

    /**
     * Get userPicture
     *
     * @return string 
     */
    public function getUserPicture()
    {
        return $this->userPicture;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
}