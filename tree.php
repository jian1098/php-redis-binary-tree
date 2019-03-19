<?php

// 节点类
Class BTNode
{
    public $data;
    public $lChild;
    public $rChild;

    public function __construct($data = null)
    {
        $this->data = $data;
    }
}

// 二叉树类
Class BinaryTree
{
    public $btData;

    public function __construct($data = null)
    {
        $this->btData = $data;
    }

    //创建二叉树
    public function CreateBT(&$root = null)
    {
        $elem = array_shift($this->btData);
        if ($elem == null) {
            return 0;
        } else if ($elem == '#') {
            $root = null;
        } else {
            $root = new BTNode();
            $root->data = $elem;
            $this->CreateBT($root->lChild);
            $this->CreateBT($root->rChild);
        }
        return $root;
    }

    //先序遍历二叉树
    public function PreOrder($root)
    {
        if ($root != null) {
            echo $root->data . " ";
            $this->PreOrder($root->lChild);
            $this->PreOrder($root->rChild);

        } else {
            return;
        }
    }

    //中序遍历二叉树
    public function InOrder($root)
    {
        if ($root != null) {
            $this->InOrder($root->lChild);
            echo $root->data . " ";
            $this->InOrder($root->rChild);

        } else {
            return;
        }
    }

    //后序遍历二叉树
    public function PosOrder($root)
    {
        if ($root != null) {
            $this->PosOrder($root->lChild);
            $this->PosOrder($root->rChild);
            echo $root->data . " ";

        } else {
            return;
        }
    }

    //层序(广度优先)遍历二叉树
    function LeverOrder($root)
    {
        $queue = new SplQueue();//双向链表
        if ($root == null){
            return;
        }else{
            $queue->enqueue($root);
        }

        while (!$queue->isEmpty()) {
            $node = $queue->bottom();
            $queue->dequeue();
            echo $node->data . " ";
            if ($node->lChild){
                $queue->enqueue($node->lChild);
            }else{
//                echo $node->data.'的左子树为空';
            }
            if ($node->rChild){
                $queue->enqueue($node->rChild);
            }else{
//                echo $node->data.'的右子树为空';
            }
        }
    }
}