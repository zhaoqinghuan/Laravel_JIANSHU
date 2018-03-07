<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
//引入GuzzleHttp扩展类
use GuzzleHttp\Client;
class ESInit extends Command
{
    //修改这个脚本的启动命令
    protected $signature = 'es:init';
    //修改这个脚本的描述(可定义为中文)
    protected $description = 'Init Laravel Es for Post';
    public function __construct()
    {
        parent::__construct();
    }

    //实际要进行的操作
    public function handle()
    {
        // 创建template
        //实例化一个Client类
        $client = new Client();
        //获取\config\scout.php 中的elasticsearch配置属性作为访问地址参数
        $url = config('scout.elasticsearch.hosts')[0] . '/_template/tmp';
        //先删除这个模板保证模板不存在
        $client->delete($url);
        //完善创建模板所需的参数
        $param = [
            'json' =>
                [   //确定这个模板对那个索引起作用 对应\config\scout.php中elasticsearch的索引名称
                    'template' => config('scout.elasticsearch.index'),
                    'mappings' =>
                        [
                            'posts' =>
                            [
                                'properties' =>
                                    [
                                        'title' =>
                                        [
                                            'type' => 'text',
                                            'analyzer' => 'ik_smart',
                                        ],
                                        'content' =>
                                            [
                                                'type' => 'text',
                                                'analyzer' => 'ik_smart',
                                            ]
                                    ]
                            ]
                        ],
                ],
            ];
        //然后创建这个模板
        $client->put($url, $param);
        //完成后做分割
        $this->info("========= Create Template OK ========");
        // 创建index
        //确认索引访问地址
        $url = config('scout.elasticsearch.hosts')[0] . '/' . config('scout.elasticsearch.index');
        //先删除这个索引保证模板不存在
        $client->delete($url);
        //创建索引所需的参数
        $param = [
            'json' =>
                [
                    'settings' =>
                        [
                            'refresh_interval' => '5s',//设置更新时间
                            'number_of_shards' => 1,
                            'number_of_replicas' => 0,
                        ],
                    'mappings' =>
                        [
                            'posts' =>
                            [
                                '_all' =>
                                    [
                                        'enabled' => false//设置_all_是否显示为否
                                    ]
                            ]
                        ]
                ]
        ];
        //请求这个索引
        $client->put($url, $param);
        //完成索引做分割
        $this->info("========= Create index OK ========");
    }
}
