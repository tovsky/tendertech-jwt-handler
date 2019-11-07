<?php


namespace Tendertech\JwtHandler;


use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Token\Plain;

class DataProvider implements DataProviderInterface
{
    public function getPayload($tokenAsString): array
    {
        /** @var Plain $token */
        $token = $this->getParserToken()->parse($tokenAsString);
        return $token->claims()->all();
    }

    public function getUserData($tokenAsString)
    {
        /** @var Plain $token */
        $token = $this->getParserToken()->parse($tokenAsString);
        return $token->claims()->get('user');
    }

    private function getParserToken(): Parser
    {
        $parserDecoder = new \Lcobucci\Jose\Parsing\Parser();
        return new Parser($parserDecoder);
    }
}