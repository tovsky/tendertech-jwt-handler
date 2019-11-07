<?php


namespace Tendertech\JwtHandler;


use Lcobucci\JWT\Signer\Key;

class KeyProvider implements KeyProviderInterface
{
    /**
     * @var string
     */
    private $pathPublicKey;

    public function __construct(string $pathPublicKey) {
        $this->pathPublicKey = $pathPublicKey;
    }

    public function getPublicKey(): Key
    {
       return new Key($this->pathPublicKey);
    }
}
