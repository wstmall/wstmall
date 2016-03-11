SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wst_order_complains`;
CREATE TABLE `wst_order_complains` (
  `complainId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `complainType` tinyint(4) NOT NULL DEFAULT '1',
  `complainTargetId` int(11) NOT NULL,
  `respondTargetId` int(11) NOT NULL,
  `needRespond` tinyint(4) DEFAULT '0',
  `deliverRespondTime` datetime DEFAULT NULL,
  `complainContent` text NOT NULL,
  `complainAnnex` varchar(255) DEFAULT NULL,
  `complainStatus` tinyint(4) NOT NULL DEFAULT '0',
  `complainTime` datetime NOT NULL,
  `respondContent` text,
  `respondAnnex` varchar(255) DEFAULT NULL,
  `respondTime` datetime DEFAULT NULL,
  `finalResult` text,
  `finalResultTime` datetime DEFAULT NULL,
  `finalHandleStaffId` int(11) DEFAULT NULL,
  PRIMARY KEY (`complainId`),
  KEY `complainStatus` (`complainStatus`),
  KEY `orderId_2` (`orderId`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `wst_payments`(payCode,payName,payDesc,payOrder,payConfig,enabled,isOnline) VALUES ( 'weixin', '微信支付', '微信支付', '0', '', '0', '1');
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,valueRangeTxt,valueRange,fieldValue,fieldTips,fieldSort) VALUES('0', '注册禁用关键字', 'limitAccountKeys', 'textarea', null, null, 'admin，system', null, '13');

alter table wst_goods modify column marketPrice decimal(11,2) NOT NULL DEFAULT 0;
alter table wst_goods modify column shopPrice decimal(11,2) NOT NULL DEFAULT 0;

alter table wst_goods_attributes modify column attrPrice decimal(11,2) DEFAULT 0;
alter table wst_order_goods modify column goodsPrice decimal(11,2) NOT NULL DEFAULT 0;

alter table wst_orders modify column totalMoney decimal(11,2) NOT NULL DEFAULT 0;
alter table wst_orders modify column deliverMoney decimal(11,2) NOT NULL DEFAULT 0;
alter table wst_orders modify column needPay decimal(11,2) DEFAULT 0;

alter table wst_shops modify column avgeCostMoney decimal(11,2) DEFAULT 0;
alter table wst_shops modify column deliveryStartMoney decimal(11,2) DEFAULT 0;
alter table wst_shops modify column deliveryMoney decimal(11,2) DEFAULT 0;
alter table wst_shops modify column deliveryFreeMoney decimal(11,2) DEFAULT 0;
