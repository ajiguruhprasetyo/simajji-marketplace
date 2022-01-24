<?php

namespace App\Services\Jwt;

use Firebase\JWT\JWT;
use App\Models\User;

class AuthService
{

    public function __construct()
    {
    }

    public function userIdFromJwt(){
        $token = request()->bearerToken();
        $tokenParts = explode(".", @$token);
        $tokenPayload = base64_decode(@$tokenParts[1]);
        $jwtPayload = json_decode(@$tokenPayload);
        return $jwtPayload->sub ?? 0;
    }

    public function generateTokenJwt($userId)
    {
        $user = User::find($userId)->first();
        if (!empty($userId)) {
            $payload = [
                'iss'     => $_SERVER['SERVER_NAME'],
                'iat'     => time(),
                'exp'     => strtotime("+7 day", time()),
                'uid'     => $userId,
            ];

            try {
                $jwt = JWT::encode($payload, $this->secretKey, env('JWT_ENCRYPT', 'HS256'));
                $res = ["title" => 'token', "data" => $jwt];
            } catch (UnexpectedValueException $e) {
                $res = ["title" => 'token invalid', "data" => $e->getMessage()];
            }
            return $res;
        } else {
            $res = ["title" => 'user token not found', "data" => 'user id not found'];
            return $res;
        }

    }

     public function generateTokenJwtComsume($userId)
    {
        $accountId = User::find($userId)->first();
        if (!empty($userId)) {
            $payload = [
                'iss'     => $_SERVER['SERVER_NAME'],
                'iat'     => time(),
                'exp'     => strtotime("+7 day", time()),
                'uid'     => $userId,
                'aid'     => $accountId->account_id
            ];

            try {
                $jwt = JWT::encode($payload, $this->secretKey, env('JWT_ENCRYPT', 'HS256'));
                $res = $jwt;
            } catch (UnexpectedValueException $e) {
                $res = $e->getMessage();
            }
            return $res;
        } else {
            $res = null;
            return $res;
        }

    }

    public function AuthenticationJwt($jwt, $currentUserId)
    {
        try {
            $payload = JWT::decode($jwt, $this->secretKey, [env('JWT_ENCRYPT', 'HS256')]);

            if($payload->uid == $currentUserId) {
                $res = ['status' => true];
            }else{
                $res = ["status"=>false,"Error"=>"Invalid Token or Token Exipred, So Please login Again!"];
            }
        } catch (UnexpectedValueException $e) {
             $res = ["status"=>false,"Error"=>$e->getMessage()];
        }
        return $res;
    }
}
