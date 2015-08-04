<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title>For优 确认订单</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1" />	
		<link href="/fuwebapp/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="/fuwebapp/Public/css/commonstyle.css" />
		<link type="text/css" rel="stylesheet" href="/fuwebapp/Public/css/style.css" />
		<link type="text/css" rel="stylesheet" href="/fuwebapp/Public/css/style-y.css" />
		<style>
			body{
				background-color: #FAFAFA;
			}
		</style>
		<script>
		$(document).ready(function(){
				$(".orderconfirm-goods-txt a.sub-goods").click(function(){
				      var v=$(this).next("input").val();
				      if(parseInt(v)!=0){
				          $(this).next("input").val(parseInt(v)-1);
				      }    
				      /*caltotalCost();*/
				  });
				
				  $(".orderconfirm-goods-txt a.add-goods").click(function(){
				      var v=$(this).prev("input").val();
				      $(this).prev("input").val(parseInt(v)+1); 
				      /*caltotalCost();*/
				  });
		  });
		</script>
	</head>
	<body>
		<div class="orderconfirm-head">
			<span class="glyphicon glyphicon-chevron-left fl"></span>
			<span>确认订单</span>
		</div><!--register-head-->
		<div class="consumer-info w">
				<span class="glyphicon glyphicon-user"></span>
				<span class="consumer-name">杜佳文</span>
				<span class="consumer-phone">18012341234</span>
				<span class="consumer-rightarrow ">&gt;</span>
		</div>
		<div class="consumer-info-add w">
				<span class="glyphicon  glyphicon-map-marker glyadd"></span>
				<span class="consumer-address">江苏省苏州市沧浪区干将东路33号本部前化四10101010</span>
		</div>
		<div class="orderconfirm-goodsdetail w">
			<div class="orderconfirm-goodsimg">
				<img src="/fuwebapp/Public/img/littleclock.png" />
			</div>
			<div class="orderconfirm-goods-txt">
				<p class="goods-txt-name">糖果色挂表 居家风格</p>
				<p class="goods-txt-intro">设计师原创 纯手工打造</p>
				<div class="bo">
					<div class="fl">
						<div class="orderconfirm-price fl discount-price">￥79</div> <span class="orgin-price fl bef-price"> 原价：89</span>
					</div>
					<div id="order-goods-count" class="fl">
						<a class="sub-goods ">-</a>
						<input class="goods-count" type="text" value="1" disabled="true">
						<a class="add-goods ">+</a>
					</div>
				</div>
			</div>
		</div>
		<div class="orderconfirm-arrivetime w">
			<span class="fl">送达时间</span>
			<span class="ri">&gt;</span>
		</div>
		<div class="payment-orderconfirm w">
			<div class="payment-method-oc">
				选择支付方式
			</div>
			<div class="">
				<form action>
					<div class="radio">
					   <label>
					      <input type="radio" name="optionsRadios" id="" 
					         value="option1" checked> 支付宝支付<span>
					         <img src="/fuwebapp/Public/img/alipay.png" />
					         </span>
					   </label>
					</div>
					<div class="radio">
					   <label>
					      <input type="radio" name="optionsRadios" id="" 
					         value="option2">微信支付<span >
					         	<img src="/fuwebapp/Public/img/wechatpay_03.png" />	
					         </span>
					   </label>
					</div>
				</form>
			</div>
		</div>
		<div class="orderconfirm-message">
<!--	<p>留言备注：</p>	-->	
			<textarea     placeholder="留言备注：" rows="5"></textarea>
		</div>
		<div class="orderconfirm-totalamount">
			合计：79元 <span class="orgin-price">129元</span>（已节省50元）
		</div>
		<div class="orderconfirm-btn-pay" >
			<button class="btn register-info-submit-btn">
					立即支付
			</button>
		</div>
		
		<div id="order-confirm-time">
			<div id="order-confirm-time-top" class="clearfix">
				<span class="fl">取消</span>
				<span class="fr">确定</span>
			</div>
			<div id="order-time-list">
				<div class="hour-list">
					<ul>
						<li>5</li>
						<li class="sub-active">6</li>
						<li class="active">7</li>
						<li class="sub-active">8</li>
						<li>9</li>
						<li>10</li>
						<li>11</li>
						<li>12</li>
					</ul>
				</div>
				<div class="minute-list">
					<ul>
						<li>15</li>
						<li class="sub-active">16</li>
						<li class="active">17</li>
						<li class="sub-active">18</li>
						<li>19</li>
						<li>20</li>
						<li>21</li>
						<li>22</li>
					</ul>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="/fuwebapp/Public/script/plugins/jquery-1.11.2.js"></script>
		<script src="/fuwebapp/Public/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>