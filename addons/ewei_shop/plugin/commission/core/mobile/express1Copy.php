<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
global $_W, $_GPC;
function sortByTime($a, $b)
{
	if ($a['ts'] == $b['ts']) {
		return 0;
	} else {
		return $a['ts'] > $b['ts'] ? 1 : -1;
	}
}

// function getList($express, $expresssn)
// {
// 	$url = "http://wap.kuaidi100.com/wap_result.jsp?rand=" . time() . "&id={$express}&fromWeb=null&postid={$expresssn}";
// 	load()->func("communication");
// 	$resp = ihttp_request($url);
// 	$content = $resp['content'];
// 	if (empty($content)) {
// 		return array();
// 	}
// 	preg_match_all("/\\<p\\>&middot;(.*)\\<\\/p\\>/U", $content, $arr);
// 	if (!isset($arr[1])) {
// 		return false;
// 	}
// 	return $arr[1];
// }

// $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
// $openid = m('user')->getOpenid();
// $uniacid = $_W['uniacid'];
// $orderid = intval($_GPC['id']);
// echo $orderid;
//  exit;
if ($_W['isajax']) {
// 	if ($operation == 'display') {
// 		$order = pdo_fetch('select * from ' . tablename('ewei_shop_order') . ' where id=:id and uniacid=:uniacid and openid=:openid limit 1', array(':id' => $orderid, ':uniacid' => $uniacid, ':openid' => $openid));
// 		if (empty($order)) {
// 			show_json(0);
// 		}
// 		$goods = pdo_fetchall("select og.goodsid,og.price,g.title,g.thumb,og.total,g.credit,og.optionid,og.optionname as optiontitle,g.isverify,g.storeids  from " . tablename('ewei_shop_order_goods') . " og " . " left join " . tablename('ewei_shop_goods') . " g on g.id=og.goodsid " . " where og.orderid=:orderid and og.uniacid=:uniacid ", array(':uniacid' => $uniacid, ':orderid' => $orderid));

// 		$goods = set_medias($goods, 'thumb');
// 		$order['goodstotal'] = count($goods);
// 		$set = set_medias(m('common')->getSysset('shop'), 'logo');
// 		show_json(1, array("order" => $order, 'goods' => $goods, 'set' => $set));
	// } else 
	// if ($operation == 'step') {
 
		$appkey = 'a64a0a824dc8e622';//你的appkey
		$url = "http://api.jisuapi.com/express/query?appkey=$appkey";
		$type =  $_GPC["express"];
		$number =  $_GPC["expresssn"];

		$post = array('type'=>$type, 
		            'number'=>$number
		        );

		$result = $this->model->curlOpen($url, array('post'=>$post));

		$jsonarr = json_decode($result, true);
		//exit(var_dump($jsonarr));
		 
		// if($jsonarr['status'] != 0)
		// {
		//     echo $jsonarr['msg'];
		//     exit();
		// }
		 
		// $result = $jsonarr['result'];
		// if($result['issign'] == 1) echo '已签收'.'<br>';
		// else echo '未签收'.'<br>';
		// foreach($result['list'] as $val)
		// {
		//     echo $val['time'].' '.$val['status'].'<br>';
		// }

		show_json(1, array("list" => $jsonarr ));
	// }
}
include $this->template('express1Copy');