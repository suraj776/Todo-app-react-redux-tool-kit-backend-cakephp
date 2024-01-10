<?php
namespace App\Auth;

use Cake\Utility\Security;
use Firebase\JWT\JWT;

class JwtToken
{

    private $public_key;

    /**
     *
     * @return mixed
     */
    public function getPublic_key()
    {
        return $this->public_key;
    }

    /**
     *
     * @param mixed $public_key
     */
    public function setPublic_key()
    {
        $this->public_key = Security::getSalt();
    }

    public function __construct()
    {
        $this->setPublic_key(Security::getSalt());
    }

    public function generateToken($data)
    {
        $payload = [
            'sub' => $data['id'],
            'exp' => strtotime("+1 week") // given 1 week token expiry
        ];
        return JWT::encode($payload, $this->public_key);
    }

}
