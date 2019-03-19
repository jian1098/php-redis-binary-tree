<?php

class MyRedis {
    private $redis;
    private $host;  //redis ip
    private $port;  //redis 端口
    private $tree;

    public function __construct($host,$port){
        $this->host=$host;
        $this->port=$port;
        //连接redis
        if(class_exists('Redis')){
            $this->redis = new \Redis();
            if($this->redis->connect($this->host, $this->port)){
                $this->connect=true;
            }
        }else{
            exit('redis扩展不存在');
        }
    }

    //插入hash    参数：区域id,用户id，属性数组
    public function addNode($id,$data){
        if(!is_array($data)){
            return [];
        }
        $resOrder=$this->redis->hMSet($id,$data);
        return $resOrder;
    }

    //查找指定区域指定用户id的属性
    public function getNode($id){
        return $this->redis->hGetAll($id);
    }

    //修改指定区域指定用户id的属性   参数：区域id,用户id，属性名，属性值
    public function setNode($id,$field,$value){
        return $this->redis->hSet($id,$field,$value);
    }

    //获取redis所有键
    public function getKeys(){
        return $this->redis->keys('*');
    }

    //获取key的个数
    public function dbSize(){
        return $this->redis->dbSize();
    }

    //清空数据库
    public function flushDB(){
        return $this->redis->flushDB();
    }

    //前序遍历的顺序取出二叉树 参数：区域，根节点
    public function tree($root_id){
        $rootNode=$this->getNode($root_id);
        $this->tree[]=$root_id;
        if (isset($rootNode['left'])){
            $this->tree($rootNode['left']);
        }
        if (isset($rootNode['right'])){
            $this->tree($rootNode['right']);
        }
        return $this->tree;
    }
}