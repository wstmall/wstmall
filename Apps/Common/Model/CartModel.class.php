<?php
namespace Common\Model;
/**
 * ============================================================================
 * WSTMall开源商城
 * 官网地址:http://www.wstmall.net
 * 联系QQ:707563272
 * ============================================================================
 * 购物车服务类
 */
class CartModel extends BaseModel {

	
	/**
	 * 获取购物车信息
	 */
	public function getPayCart(){
		
		$userId = (int)session('WST_USER.userId');
		$mgoods = D('Home/Goods');

		$cartgoods = array();

		$totalMoney = 0;
		$totalCnt = 0;
		$sql = "select * from __PREFIX__cart where userId = $userId and packageId>0 group by batchNo";
		$shopcart = $this->query($sql);
		for($i=0;$i<count($shopcart);$i++){
			$cgoods = $shopcart[$i];
			$batchNo = $cgoods["batchNo"];

			$sql = "select * from __PREFIX__cart where userId = $userId and batchNo=$batchNo";
			$pkgList = $this->query($sql);
			for($j=0;$j<count($pkgList);$j++){
				$pgoods = $pkgList[$j];
				$packageId = $pgoods["packageId"];
				$goodsId = (int)$pgoods["goodsId"];
				$goodsAttrId = (int)$pgoods["goodsAttrId"];
				
				$sql = "select p.shopId, p.packageName, gp.diffPrice from __PREFIX__goods_packages gp, __PREFIX__packages p where p.packageId =$packageId and gp.packageId=p.packageId and gp.goodsId = $goodsId";
				$pkg = $this->queryRow($sql);
		
				$diffPrice = (float)$pkg["diffPrice"];
				
				$obj = array();
				$obj["goodsId"] = $goodsId;
				$obj["goodsAttrId"] = $goodsAttrId;
				$goods = $mgoods->getGoodsForCheck($obj);
				
				$goods['shopPrice'] = ($goods['shopPrice']>$diffPrice)?($goods['shopPrice']-$diffPrice):$goods['shopPrice'];
				
				$goods["cnt"] = $pgoods["goodsCnt"];
				$totalMoney += $goods["cnt"]*$goods["shopPrice"];
				
				$cartgoods[$goods["shopId"]]["deliveryFreeMoney"] = $goods["deliveryFreeMoney"];//店铺免运费最低金额
				$cartgoods[$goods["shopId"]]["deliveryMoney"] = $goods["deliveryMoney"];//店铺配送费
				$cartgoods[$goods["shopId"]]["totalMoney"] = $cartgoods[$goods["shopId"]]["totalMoney"]+($goods["cnt"]*$goods["shopPrice"]);
			}
		}
		
		$sql = "select * from __PREFIX__cart where userId = $userId and isCheck=1 and goodsCnt>0 and packageId=0";
		$shopcart = $this->query($sql);
		
		for($i=0;$i<count($shopcart);$i++){
			$cgoods = $shopcart[$i];
			$obj["goodsId"] = (int)$cgoods["goodsId"];
			$obj["goodsAttrId"] = (int)$cgoods["goodsAttrId"];
			$goods = $mgoods->getGoodsForCheck($obj);
			$totalMoney += $goods["cnt"]*$goods["shopPrice"];
		}
		
		foreach($cartgoods as $key=> $cshop){
			if($cshop["totalMoney"]<$cshop["deliveryFreeMoney"]){
				$totalMoney = $totalMoney + $cshop["deliveryMoney"];
			}
		}
		
		$rdata["totalMoney"] = $totalMoney;//商品总价（含配送费）
		
		return $rdata;
	}
   
	
}