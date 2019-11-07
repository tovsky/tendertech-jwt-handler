# JARVIS-jwt-library
 
**Назначение**
Для всех компонентов JARVIS библиотека предоставляет общий интерфейс для работы с JWT-токенами.


1.   В `services.yaml` указываем
```$xslt
    Lcobucci\JWT\Signer\Key: ~

    Lcobucci\JWT\Signer\Rsa\Sha256: ~

    Tendertech\JwtHandler\KeyProvider:
        arguments:
            $pathPublicKey: 'file://%kernel.project_dir%/config/jwt/public.pem'

    Tendertech\JwtHandler\Validator:
        arguments:
            $singer: '@Lcobucci\JWT\Signer\Rsa\Sha256'

    Tendertech\JwtHandler\DataProvider: ~

```


