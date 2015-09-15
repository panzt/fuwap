<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>For优评价订单</title>
		<meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1" />
		<link href="/fuwebapp/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="/fuwebapp/Public/css/commonstyle.css" />
		<link rel="icon" href="/fuwebapp/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="/fuwebapp/Public/css/style.css"/>
		<style>
			body {
				background-color: rgb(246,246,246);
			}
		</style>
	</head>
	<body>
		<div id="comment-head" class="w text-white">
			<div class="head-top bground-special">
				<span class="fl text-white history-back glyphicon glyphicon-circle-arrow-left"></span>
				<span>评价订单</span>
			</div>
		</div>
		
		<div class="comment-wrapper">
			<?php if(is_array($goodsInfo)): foreach($goodsInfo as $key=>$goods): ?><ul>
					<li class="bground-white comment-list-item">
						<table>
							<tbody>
								<tr class="comment-tr-info">
									<td>
										<div class="col-2 fl comment-img-wrapper">
											<img src="<?php echo ($goods["img_url"]); ?>" />
										</div>
										<div class="col-8 comment-goods-info fl">
											<p class="comment-name">
												<?php echo ($goods["name"]); ?>
											</p>
											<p class="comment-price">
												￥<?php echo ($goods["price"]); ?>
											</p>
										</div>
									</td>
								</tr>
								<tr class="comment-tr-star" data-grade="0">
									<td>
										<span class="fl">描述相符</span>
										<div class="comment-star fr">
											<span class="glyphicon text-light glyphicon-star-empty"></span>
											<span class="glyphicon text-light glyphicon-star-empty"></span>
											<span class="glyphicon text-light glyphicon-star-empty"></span>
											<span class="glyphicon text-light glyphicon-star-empty"></span>
											<span class="glyphicon text-light glyphicon-star-empty"></span>
										</div>
									</td>
								</tr>
								<tr class="comment-tr-mark">
									<td>
										<div class="w">
											<textarea  placeholder="写点评价吧，对其他小伙伴有很大的帮助哦" id="commenttext"></textarea>
										</div>
									</td>
								</tr>
								<tr class="comment-tr-submit">
									<td>
										<div class="fl">
											<input type="checkbox" class=""/>
											<span>
												匿名评价
											</span>
										</div>
										<input type="button" class="fr positive-button" value="发表评价" data-food="<?php echo ($goods["food_id"]); ?>" data-goods="<?php echo ($goods["order_id"]); ?>" data-together="<?php echo ($goods["together_id"]); ?>"/>
									</td>
								</tr>
							</tbody>
						</table>
					</li>
				</ul><?php endforeach; endif; ?>
		</div>
		<script type="text/javascript" src="/fuwebapp/Public/script/plugins/jquery-1.11.2.js"></script>
		<script src="/fuwebapp/Public/script/common.js"></script>
		<script src="/fuwebapp/Public/script/comment.js"></script>
	</body>
</html>