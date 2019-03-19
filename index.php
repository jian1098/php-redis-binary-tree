<?php
require_once 'redis.php';
require_once 'tree.php';

$myredis=new MyRedis('127.0.0.1','6379');

/*
    假设我构造一颗如下的二叉树
            1
        2       3
      #   4   #   #
        #   #
*/

//添加节点
//$data=[
//    'left'      =>      '2',
//    'right'     =>      '3',
//];
//$res=$myredis->addNode(1,$data);
//
//$data=[
//    'left'      =>      '#',
//    'right'     =>      '4',
//];
//$res=$myredis->addNode(2,$data);
//
//$data=[
//    'left'      =>      '#',
//    'right'     =>      '#',
//];
//$res=$myredis->addNode(3,$data);
//
//$data=[
//    'left'      =>      '#',
//    'right'     =>      '#',
//];
//$res=$myredis->addNode(4,$data);
//print_r($res);

//修改节点信息
//$res=$myredis->setNode(1,'left',2);
//print_r($res);

//查询指定节点
//$res=$myredis->getNode(1);
//print_r($res);

//清空数据
//$res=$myredis->flushDB();
//获取redis所有键
//$res=$myredis->getKeys();
//print_r($res);

//前序遍历的顺序从redis读取节点
$data=$myredis->tree(1);//$data = array(1,2,'#',4,'#','#',3,'#','#');

//生成二叉树
$tree = new BinaryTree($data);
$root = $tree->CreateBT();

//遍历二叉树
echo '前序：';
$tree->PreOrder($root);
echo '<br>中序：';
$tree->InOrder($root);
echo '<br>后序：';
$tree->PosOrder($root);
echo '<br>层序：';
$tree->LeverOrder($root);
