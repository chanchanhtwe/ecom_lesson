<?php

namespace App;


class Cart
{
    public $posts;
    public $totalQty=0;
    public $totalAmount=0;

    public function __construct($oldPost)
    {
        if($oldPost){
            $this->posts=$oldPost->posts;
            $this->totalQty=$oldPost->totalQty;
            $this->totalAmount=$oldPost->totalAmount;
        }else{
            $this->posts=null;
        }
    }

    public function add($post){
        $storePost=['post'=>$post,'amount'=>$post->price,'qty'=>0];
        if($this->posts) {

            if (array_key_exists($post->id, $this->posts)) {
                $storePost = $this->posts[$post->id];
            }

        }
            $storePost['qty']++;
            $storePost['amount']=$storePost['qty']*$post->price;
            $this->posts[$post->id]=$storePost;
            $this->totalQty++;
            $this->totalAmount+=$post->price;
        }

        public function increase($post){
            $this->posts[$post->id]['qty']++;
            $this->posts[$post->id]['amount']+=$post->price;
            $this->totalQty++;
            $this->totalAmount+=$post->price;
        }

        public function decrease($id){
        $this->posts[$id]['qty']--;
        $this->posts[$id]['amount']-=$this->posts[$id]['post']['price'];
        $this->totalQty--;
        $this->totalAmount-=$this->posts[$id]['post']['price'];
        if($this->posts[$id]['qty']<1){
            unset($this->posts[$id]);
            }
        }

}
