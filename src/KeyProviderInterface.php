<?php


namespace Tendertech\JwtHandler;


interface KeyProviderInterface
{
    public function getPublicKey();
}
