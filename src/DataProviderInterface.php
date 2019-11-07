<?php


namespace Tendertech\JwtHandler;


interface DataProviderInterface
{
    public function getPayload($token): array ;

    public function getUserData($token);
}