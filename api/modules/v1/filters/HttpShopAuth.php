<?php

namespace api\modules\v1\filters;

use Yii;
use yii\filters\auth\AuthMethod;
use api\models\Shop;
use yii\web\BadRequestHttpException;

class HttpShopAuth extends AuthMethod
{

    /**
     * @var string the HTTP authentication realm
     */
    public $realm = 'api';

    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        $contentType = $request->getHeaders()->get('content-type');
        $authHeader = $request->getHeaders()->get('Authorization');
        if ($authHeader !== null && preg_match('/^Shop\s+(.*?)$/', $authHeader, $matches)) {
            $identity = (new Shop())->findIdentityByAccessToken($matches[1], get_class($this));

            if ($identity === null) {
                $this->handleFailure($response);
            }

            if (strpos($contentType, 'json')) {
                $this->checkHash($identity);
            } else {
                throw new BadRequestHttpException('Error content-type: ' . $contentType);
            }

            Yii::$app->params['shop'] = $identity;

            return $identity;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function challenge($response)
    {
        $response->getHeaders()->set('WWW-Authenticate', "Bearer realm=\"{$this->realm}\"");
    }

    private function checkHash($identity)
    {
        $json = Yii::$app->request->post();
        $hash = md5(serialize($json['data']) . $identity->api_key);

//        if ($json['hash'] != $hash) {
//            throw new BadRequestHttpException('Error hash');
//        }

        Yii::$app->params['request'] = $json['data'];
    }

}
