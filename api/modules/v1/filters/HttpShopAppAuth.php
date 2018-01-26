<?php

namespace api\modules\v1\filters;

use api\models\ShopApp;
use Yii;
use yii\filters\auth\AuthMethod;
use yii\web\BadRequestHttpException;

class HttpShopAppAuth extends AuthMethod
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
        if ($authHeader !== null && preg_match('/^App\s+(.*?)$/', $authHeader, $matches)) {
            $identity = (new ShopApp())->findIdentityByCode($matches[1], get_class($this));

            if ($identity === null) {
                $this->handleFailure($response);
            }

            if (strpos($contentType, 'json')) {
                $this->checkHash($identity);
            } else {
                throw new BadRequestHttpException('Error content-type: ' . $contentType);
            }

            Yii::$app->params['shopApp'] = $identity;

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
        $hash = md5(serialize($json['data']) . '2762756467478fe46511b29233326c32a');

//        if ($json['hash'] != $hash) {
//            throw new BadRequestHttpException('Error hash');
//        }
        Yii::$app->params['request'] = $json['data'];
    }

}
