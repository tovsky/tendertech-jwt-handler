<?php

namespace Tendertech\JwtHandler;

use Lcobucci\JWT\Signer\Rsa;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Validation\Constraint\SignedWith;

class Validator implements ValidatorInterface
{
    /**
     * @var KeyProviderInterface
     */
    private $keyProvider;
    /**
     * @var Rsa
     */
    private $singer;

    public function __construct(
        KeyProviderInterface $keyProvider,
        Rsa $singer
    ) {
        $this->keyProvider = $keyProvider;
        $this->singer = $singer;
    }

    public function isTokenExpired(string $token): bool
    {
        return $this->isExpired($token);
    }

    public function isValidSignature(string $token): bool
    {
        try {
            $this->checkSignature($token);
        } catch (\Exception $exception) {
            return false;
        }

        return true;
    }

    /**
     * Возвращает true если срок действия JWT истек
     * @param string $accessToken
     * @return bool
     * @throws \Exception
     */
    private function isExpired(string $token): bool
    {
        return $this->getPreparedToken($token)->isExpired(new \DateTime('now'));
    }

    /**
     * @param $accessToken
     * @throws \Exception
     */
    private function checkSignature($token): void
    {
        $constraintSignedWith = new SignedWith($this->singer, $this->keyProvider->getPublicKey());
        $constraintSignedWith->assert($this->getPreparedToken($token));
    }

    /*
    * Парсер Декодер передаем в Парсер Токенов
    * и распарсиваем токен из строки, получая объект Plain реализующий интерфейс Token
    */
    private function getPreparedToken(string $token): Token
    {
        $parserDecoder = new \Lcobucci\Jose\Parsing\Parser();
        $parserToken = new Parser($parserDecoder);

        return $parserToken->parse($token);
    }
}
