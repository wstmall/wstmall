<?php
namespace WebApp\Action;
/**
 * ============================================================================
 * WSTMall开源商城-合作团队
 * 官网地址:http://www.wstmall.com 
 * 联系QQ:707563272
 * ============================================================================
 * 商家控制器
 */
class BrandsAction extends BaseAction {
	/**
	 * 品牌馆
	 */
	public function getBrandsList(){	
		$brands = D('WebApp/Brands');
		$brandsList = $brands->getBrandsList();
		$this->ajaxReturn($brandsList);
	}
}