<?php

namespace Home\Model;
use Think\Model;

/**
 * 订单管理模型
 * 
 * @package     app
 * @subpackage  Home
 * @category    MODEL
 * @author      Tony<879833043@qq.com>
 *
 */ 


class OrdersModel extends Model{

	protected $fields = array(
		'orders' => array(
			'order_id',		//key
			'phone',		//key
			'campus_id',
			'together_id',
			'create_time',
			'status',
			'price',
			'order_count',
			'is_remarked',
			'food_id',
			'rank',
			'together_date',
			'admin_phone',
			'reserve_time',
			'message',
			'tag'
			)
		);

	/**
     * 模型函数
     * 取得用户购物车信息
     * @access public
     * @param  null
     * @return array(array()) 购物车数据
     */
	public function getShoppingCart(){
		$join  = 'food On orders.food_id = food.food_id and orders.campus_id = food.campus_id';
		$field = array(
			'orders.order_id',
			'orders.campus_id',
			'orders.order_count',
			'food.food_id',
			'food.name',
			'food.price',
			'food.discount_price',
			'food.is_discount',
			'food.message',
			'food.img_url'
			);
		$order = 'create_time desc';

		$cart  = $this->join($join)
					  ->where('phone='.$_SESSION['username'].' and orders.status=0 and orders.tag=1 and food.tag=1')
					  ->field($field)
					  ->order($order)
					  ->select();

		for ($i = 0;$i < count($cart);$i++) {
			$cart[$i]['Price'] = $cart[$i]['price']*$cart[$i]['order_count'];
			if ($cart[$i]['is_discount'] != 0) {
				$cart[$i]['dPrice'] = $cart[$i]['discount_price']*$cart[$i]['order_count'];
			}
			else {
				$cart[$i]['dPrice'] = $cart[$i]['Price'];
			}
		}

		return $cart;
	}

	/**
     * 模型函数
     * 计算购物车所选货物的总价
     * @access public
     * @param  array(array()) 购物车数据
     * @return array() 价格状况：原价Price，折扣价dPrice，节省save
     */
	public function settleAccounts($cart){
		for ($i = 0;$i < count($cart);$i++) {
			$price['Price']  += $cart[$i]['Price'];
			$price['dPrice'] += $cart[$i]['dPrice'];
		}
		$price['save'] = $price['Price'] - $price['dPrice'];

		return $price;
	}

	/**
     * 模型函数
     * 点击加减按钮修改物品购买数量
     * @access public
     * @param  String $order_id 订单号
     * @param  int    $order_count 物品购买数量
     * @return boolean
     */
	public function updateOrderCount($order_id,$order_count){
		$Orders = M('orders');
		
		$where = array(
			'phone'    => $_SESSION['username'],
			'order_id' => $order_id, 
			);
		$data  = array(
			'order_count' => $order_count
			);

		$res = $Orders->where($where)
					  ->save($data);

		return $res;
	}

	/**
     * 模型函数
     * 根据大订单号获取小订单号字符串
     * @access public
     * @param  String $together_id 大订单号
     * @param  String $is_remarked 是否评价
     *                ''			无所谓
     *                isRemark 		已评价
     *                isNotRemarked 待评价
     * @return String $orderIds    订单号组成的字符串，以','分割
     */
    public function getOrderIds($together_id,$is_remarked = ''){
    	$field = array(
    		'order_id'
    		);

    	if ($is_remarked == 'isNotRemarked') {
	    	$ordersList = $this->where('phone='.$_SESSION['username'].' and '.'is_remarked = 0'.' and '.'together_id='.'\''.$together_id.'\'')
	    					   ->field($field)
	    					   ->select();
    	}
    	else if ($is_remarked == 'isRemarked') {
    		$ordersList = $this->where('phone='.$_SESSION['username'].' and '.'is_remarked = 1'.' and '.'together_id='.'\''.$together_id.'\'')
	    					   ->field($field)
	    					   ->select();
    	}
    	else {
    		$ordersList = $this->where('phone='.$_SESSION['username'].' and '.'together_id='.'\''.$together_id.'\'')
    					   ->field($field)
    					   ->select();
    	}

    	for ($i = 0;$i < count($ordersList);$i++) {
    		if ($i < count($ordersList)-1) {
    			$orderIds .= $ordersList[$i]['order_id'].',';
    		}
    		else {
    			$orderIds .= $ordersList[$i]['order_id'];
    		}
    	}

    	return $orderIds;
    }

	/**
     * 模型函数
     * 分割订单号字符串
     * @access public
     * @param  String $orderIds 订单号组成的字符串，以','分割
     * @return array() 订单号
     */
	public function orderIdsSplit($orderIds){
		$ordersList = explode(',', $orderIds);

		return $ordersList;
	}

	/**
     * 模型函数
     * 通过订单号获取单个物品信息
     * @access public
     * @param  String $orderId 订单号
     * @return array() 单个物品信息
     */
	public function getGoodInfo($orderId){
		$field = array(
			'food_id',
			'campus_id',
			'order_count',
			'status',
			'together_id',
			'together_date'
			);
		$where = $this->where('order_id='.$orderId)
					  ->field($field)
					  ->find();

		$Food     = D('Food');
		$goodInfo = $Food->getGoodInfo($where['food_id'],$where['campus_id']);
		$goodInfo['order_id']      = $orderId;
		$goodInfo['order_count']   = $where['order_count'];
		$goodInfo['status']		   = $where['status'];
		$goodInfo['together_id']   = $where['together_id'];
		$goodInfo['together_date'] = $where['together_date'];
		$goodInfo['Price']  	   = $goodInfo['price'] * $goodInfo['order_count'];
		$goodInfo['dPrice'] 	   = $goodInfo['discount_price'] * $goodInfo['order_count'];

		return $goodInfo;
	}

	/**
     * 模型函数
     * 通过订单号获取物品信息
     * @access public
     * @param  String $orderIds 订单号组成的字符串，以','分割
     * @return array(array()) 物品信息
     */
	public function getGoodsInfo($orderIds){
		$ordersList = $this->orderIdsSplit($orderIds);
		for ($i = 0;$i < count($ordersList);$i++) {
			$goodsInfo[$i] = $this->getGoodInfo($ordersList[$i]);
		}

		return $goodsInfo;
	}

	/**
     * 模型函数
     * 为一批订单设置一个订单号，同时设置下单时间
     * 根据phone和order_id在orders表中记录together_id,together_date
     * @access public
     * @param  String $orderIds 订单号组成的字符串，以','分割
     * @return string 订单号
     */
    public function setTogether($orderIds){
        $user = $_SESSION['username'];

        $together_id   = $user.Time();
        $together_date = date("Y-m-d H:m:s",time());

        $orderID = $this->orderIdsSplit($orderIds);

        $Orders = M('orders');
        $data = array(
            'together_id'   => $together_id,
            'together_date' => $together_date
            );

        for ($i = 0;$i < count($orderID);$i++) {
            $where = array(
                'phone'    => $user,
                'order_id' => $orderID[$i]
                );

            $Orders->where($where)
                   ->save($data);
        }

        return $together_id;
    }

    /**
     * 模型函数
     * 获取一个用户某种状态的所有大订单号
     * @access public
     * @param  String $status 状态
     * @return array() 大订单号
     */
    public function getTogetherIds($status){
    	$field = array(
    		'together_id'
    		);
    	$togetherIds = $this->where('phone='.$_SESSION['username'].' and '.'status='.$status.' and tag=1')
    						->distinct(true)
    						->field($field)
    						->select();

    	return $togetherIds;
    }

    /**
     * 模型函数
     * 删除或取消用户大订单
     * @access public
     * @param  String  $together_id 大订单号
     * @return boolean 数据库操作结果
     */
    public function deleteOrCancel($together_id){
    	$Orders = M('orders');

    	$where = array(
    		'phone'		  => $_SESSION['username'],
    		'together_id' => $together_id
    		);
    	$data = array(
    		'tag'		  => 0
    		);

    	$res = $Orders->where($where)
    				  ->save($data);

    	return $res;
    }

    /**
     * 模型函数
     * 用户确认大订单
     * @access public
     * @param  String  $together_id 大订单号
     * @return boolean 数据库操作结果
     */
    public function confirmOrder($together_id){
    	$Orders = M('orders');

    	$where = array(
    		'phone'		  => $_SESSION['username'],
    		'together_id' => $together_id
    		);
    	$data = array(
    		'status'	  => 4
    		);

    	$res = $Orders->where($where)
    				  ->save($data);

    	return $res;
    }

    /**
     * 模型函数
     * 设置订单已评价状态
     * @access public
     * @param  String  $order_id 订单号
     * @return boolean 数据库操作结果
     */
    public function setRemarked($order_id){
        $Orders = M('orders');
        $where  = array(
            'phone'    => $_SESSION['username'],
            'order_id' => $order_id
            );
        $data   = array(
            'is_remarked' => 1
            );

        $res = $Orders->where($where)
                      ->save($data);

        return $res;
    }

    /**
     * 模型函数
     * 判断该订单中是否全部评论，并做出相应改变
     * @access public
     * @param  String  $together_id 大订单号
     * @return int -1 数据库操作失败
     *              0 订单状态没有改变
     *              1 订单状态发生改变，订单已完成
     */
    public function setStatus($together_id){
        $field = array(
            'order_id'
            );
        $data = $this->where('phone='.$_SESSION['username'].' and '.'together_id='.'\''.$together_id.'\''.' and '.'is_remarked=0')
                     ->field($field)
                     ->select();

        if ($data !== false) {
            if (count($data) != 0) {
                return 0;
            }
            else {
                $Orders = M('orders');
                $where  = array(
                    'phone'       => $_SESSION['username'],
                    'together_id' => $together_id
                    );
                $status = array(
                    'status' => 5
                    );
                $res = $Orders->where($where)
                              ->data($status)
                              ->save();

                if ($res !== false) {
                    return 1;
                }
                else {
                    return -1;
                }
            }
        }
        else {
            return -1;
        }
    }



}





?>