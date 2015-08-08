CREATE TABLE `wst_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payCode` varchar(255) DEFAULT NULL,
  `payName` varchar(255) DEFAULT NULL,
  `payDesc` text,
  `payOrder` int(11) DEFAULT '0',
  `payConfig` text,
  `enabled` tinyint(4) DEFAULT '0',
  `isOnline` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `payCode` (`payCode`,`enabled`,`isOnline`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `wst_payments` VALUES ('1', 'Cod', '货到付款', '开通城市', '1', '', '1', '0');
INSERT INTO `wst_payments` VALUES ('2', 'Alipay', '支付宝', '', '2', '', '0', '1');

DROP TABLE IF EXISTS `wst_navs`;
CREATE TABLE `wst_navs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `navType` tinyint(4) NOT NULL DEFAULT '0',
  `areaId1` int(11) DEFAULT NULL,
  `areaId2` int(11) DEFAULT NULL,
  `navTitle` varchar(50) NOT NULL,
  `navUrl` varchar(100) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `isOpen` tinyint(4) NOT NULL DEFAULT '0',
  `navSort` int(11) NOT NULL DEFAULT '0',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `wst_goods_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `goodsId` int(11) NOT NULL,
  `attrId` int(11) NOT NULL,
  `attrVal` text NOT NULL,
  `attrPrice` float(11,1) DEFAULT '0.0',
  `attrStock` int(11) DEFAULT '0',
  `isRecomm` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shopId` (`shopId`),
  KEY `goodsId` (`goodsId`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `wst_attributes` (
  `attrId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `attrName` varchar(255) NOT NULL,
  `attrType` tinyint(4) NOT NULL DEFAULT '0',
  `isPriceAttr` tinyint(4) DEFAULT '0',
  `attrContent` text,
  `attrFlag` tinyint(4) NOT NULL DEFAULT '1',
  `attrSort` int(11) DEFAULT '0',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`attrId`),
  KEY `shopId` (`shopId`,`catId`,`attrFlag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `wst_attribute_cats` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL,
  `catFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`catId`),
  KEY `shopId` (`shopId`,`catFlag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

update wst_sys_configs set fieldCode='mallName' where fieldCode='shopName';
update wst_sys_configs set fieldCode='mallTitle' where fieldCode='shopTitle';
update wst_sys_configs set fieldCode='mallDesc' where fieldCode='shopDesc';
update wst_sys_configs set fieldCode='mallKeywords' where fieldCode='shopKeywords';

INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType) VALUES ('0', '授权码', 'mallLicense', 'hidden');
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,fieldTips,fieldValue) VALUES ('0', '商城Logo', 'mallLogo', 'upload','(建议为240x132)<br/>','Apps/Home/View/default/images/logo.png');
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,fieldTips,fieldValue) VALUES ('0', '默认图片', 'goodsImg', 'upload','','Apps/Home/View/default/images/item-pic.jpg');
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,fieldValue) VALUES ('0', '底部设置', 'mallFooter', 'textarea','CROPYRIGHT 2013-2015 广州晴暖信息科技有限公司 版权所有  电话：020-29806661&lt;br/&gt;公司邮箱：wasonteam@163.com  客服QQ:707563272  粤ICP备13014375号&lt;br/&gt;我们愿与更多中小企业一起努力，一起成功 We Success together');

alter table wst_orders add needPay float(11) DEFAULT 0;
alter table wst_goods add attrCatId int DEFAULT 0;
alter table wst_order_goods add goodsAttrId int DEFAULT 0;
alter table wst_order_goods add goodsAttrName varchar(255) DEFAULT '';

INSERT INTO `wst_navs` VALUES ('1', '0', '0', '0', '品牌街', 'index.php/Home/Brands/index.html', '1', '0', '2', '2015-07-12 20:08:22');
INSERT INTO `wst_navs` VALUES ('2', '0', '0', '0', '首页', 'index.php', '1', '0', '0', '2015-07-12 20:08:36');
INSERT INTO `wst_navs` VALUES ('3', '0', '0', '0', '店铺街', 'index.php/Home/Shops/toShopStreet.html', '1', '0', '3', '2015-07-12 20:10:00');
INSERT INTO `wst_navs` VALUES ('4', '0', '0', '0', '自营店铺', 'index.php/Home/Shops/toShopHome.html', '1', '0', '4', '2015-07-12 20:11:21');
INSERT INTO `wst_navs` VALUES ('5', '1', '0', '0', '关于我们', '#', '1', '0', '0', '2015-07-12 20:25:58');
INSERT INTO `wst_navs` VALUES ('7', '1', '0', '0', 'WST百科', '#', '1', '0', '0', '2015-07-12 23:02:39');
INSERT INTO `wst_navs` VALUES ('10', '1', '0', '0', '诚征英才', '#', '1', '0', '0', '2015-07-12 23:04:41');
INSERT INTO `wst_navs` VALUES ('8', '1', '0', '0', '帮助中心', '#', '1', '0', '0', '2015-07-12 23:03:43');
INSERT INTO `wst_navs` VALUES ('9', '1', '0', '0', '交易条款', '#', '1', '0', '0', '2015-07-12 23:03:55');
INSERT INTO `wst_navs` VALUES ('11', '1', '0', '0', '网站地图', '#', '1', '0', '0', '2015-07-12 23:04:51');
INSERT INTO `wst_navs` VALUES ('12', '1', '0', '0', '友情链接', '#', '1', '0', '0', '2015-07-12 23:05:08');
INSERT INTO `wst_navs` VALUES ('13', '1', '0', '0', '店铺管理', 'shop.php', '1', '0', '0', '2015-07-12 23:05:42');

