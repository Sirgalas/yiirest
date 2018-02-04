<?php
/**
 * @api {get} http://yii2promo.herokuapp.com/api/promo/get-promo:name Получение иформации о промо
 * @apiName name
 *
 * @apiParam {String} наименование промо.
 *
 * @apiSuccess {Number} id промо.
 * @apiSuccess {String} name  наименование промо.
 * @apiSuccess {Date} date_start дата начала.
 * @apiSuccess {Date} date_finish  дата окончание .
 * @apiSuccess {Number} status промо.
 * @apiSuccess {Number} remuneration  вознаграждение.
 *
 *
 * @api {get} http://yii2promo.herokuapp.com/api/promo/get-promo:name&field тоже самое только с указанием полей которые необходимо вывести кроме названия
 *
 *
 * @api {get} http://yii2promo.herokuapp.com/api/promo/set-promo:promo&city
 *
 * @apiName name
 * @apiName city
 *
 * @apiSuccess {Number} sum
 *
 */