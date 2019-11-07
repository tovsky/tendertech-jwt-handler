<?php


namespace Tendertech\JwtHandler;


interface ValidatorInterface
{
    public function isValidSignature(string $token): bool ;

    public function isTokenExpired(string $token): bool;
}