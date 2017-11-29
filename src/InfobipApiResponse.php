<?php
namespace NotificationChannels\Infobip;

class InfobipApiResponse implements \JsonSerializable
{
    private $name;

    private $key;

    private $publicApiKey;

    private $accountKey;

    private $allowedIPs;

    private $permissions;

    private $validFrom;

    private $validTo;

    private $enabled;

    private $apiKeys;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setPublicApiKey($publicApiKey)
    {
        $this->publicApiKey = $publicApiKey;
    }

    public function setAccountKey($accountKey)
    {
        $this->accountKey = $accountKey;
    }

    public function setAllowedIPs($allowedIPs)
    {
        $this->allowedIPs = $allowedIPs;
    }

    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    public function setValidFrom($validFrom)
    {
        $this->validFrom = $validFrom;
    }

    public function setValidTo($validTo)
    {
        $this->validTo = $validTo;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getPublicApiKey()
    {
        return $this->publicApiKey;
    }

    public function getAccountKey()
    {
        return $this->accountKey;
    }

    public function getAllowedIPs()
    {
        return $this->allowedIPs;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function getValidFrom()
    {
        return $this->validFrom;
    }

    public function getValidTo()
    {
        return $this->validTo;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setApiKeys($apiKeys)
    {
        $this->apiKeys = $apiKeys;
    }

    public function getApiKeys()
    {
        return $this->apiKeys;
    }


  /**
   * (PHP 5 &gt;= 5.4.0)<br/>
   * Specify data which should be serialized to JSON
   * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
   * @return mixed data which can be serialized by <b>json_encode</b>,
   * which is a value of any type other than a resource.
   */
  function jsonSerialize()
  {
      return get_object_vars($this);
  }
}
