<?php

namespace App\Providers\Yandex;

use Laravel\Socialite\Two\ProviderInterface;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider implements ProviderInterface
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'YANDEX';

    /**
     * @param $state
     * @return mixed
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(
            'https://oauth.yandex.ru/authorize', $state
        );
    }

    /**
     * @return string
     */
    protected function getTokenUrl()
    {
        return 'https://oauth.yandex.ru/token';
    }

    /**
     * @param $token
     * @return mixed
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
            'https://login.yandex.ru/info?format=json', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param array $user
     * @return mixed
     */
    protected function mapUserToObject(array $user)
    {
        if (empty($user['default_avatar_id'])) {
            $user['default_avatar_id'] = '0-0/0';
        }
        return (new User())->setRaw($user)->map([
            'id' => $user['id'],
            'nickname' => $user['login'],
            'name' => null,
            'email' => array_get($user, 'default_email'),
            'avatar' => 'https://avatars.yandex.net/get-yapic/'.$user['default_avatar_id'].'/islands-200',
        ]);
    }

    /**
     * @param $code
     * @return array
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
