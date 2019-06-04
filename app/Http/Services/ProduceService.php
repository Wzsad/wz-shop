<?php
namespace App\Http\Services;

use App\Http\Services\KafkaService;

class ProduceService
{
    public function produce()
    {
        $topic = env('topic_test'); //配置在env中
        $url = env('kafka_url_test'); //配置在env中
        $value =
            [
                'code' => 'test',
                'data_type' => 'personal',
                'action' => 'update',
                'data' =>
                    [
                        'id' => 1,
                        'name' => 'tom',
                        'gender' => 2
                    ],
                'redirect_url' => '',
                'operator' => 'system',
            ];
        $value = json_encode($value, JSON_FORCE_OBJECT);
        $kafka = new KafkaService();
        $kafka->Producer($topic, $value, $url);
    }
}
