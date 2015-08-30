alter table wst_sys_configs modify column fieldValue text;
alter table wst_shops modify column avgeCostMoney float(11,1) DEFAULT 0.0;
alter table wst_shops modify column deliveryStartMoney float(11,1) DEFAULT 0.0;
alter table wst_shops modify column deliveryMoney float(11,1) DEFAULT 0.0;
alter table wst_shops modify column deliveryFreeMoney float(11,1) DEFAULT 0.0;

CREATE TABLE `wst_shop_scores` (
  `scoreId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `totalScore` int(11) NOT NULL DEFAULT '0',
  `totalUsers` int(11) NOT NULL DEFAULT '0',
  `goodsScore` int(11) NOT NULL DEFAULT '0',
  `goodsUsers` int(11) NOT NULL DEFAULT '0',
  `serviceScore` int(11) NOT NULL DEFAULT '0',
  `serviceUsers` int(11) NOT NULL DEFAULT '0',
  `timeScore` int(11) NOT NULL DEFAULT '0',
  `timeUsers` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`scoreId`),
  UNIQUE KEY `shopId` (`shopId`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

insert into wst_shop_scores(shopId) select shopId from wst_shops;

alter table wst_shops add latitude char(30) default '0';
alter table wst_shops add longitude char(30) default '0';
alter table wst_shops add mapLevel int default 13;
alter table wst_order_goods add goodsName varchar(50);
update wst_goods g,wst_order_goods og set og.goodsName=g.goodsName where og.goodsId=g.goodsId;
alter table wst_order_goods add goodsThums varchar(150);
update wst_goods g,wst_order_goods og set og.goodsThums=g.goodsThums where og.goodsId=g.goodsId;


INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,fieldSort) VALUES ('0', '联系电话', 'phoneNo', 'text',10);
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,fieldSort) VALUES ('0', 'QQ', 'qqNo', 'text',11);

update wst_shop_scores ss, (
   select shopId,sum(totalScore) totalScore,sum(totalUsers) totalUsers,sum(goodsScore) goodsScore,sum(goodsUsers) goodsUsers,sum(serviceScore) serviceScore,sum(serviceUsers) serviceUsers,sum(timeScore) timeScore,sum(timeUsers) timeUsers 
       from wst_goods_scores GROUP BY shopId
) as gs set ss.totalScore=gs.totalScore, ss.totalUsers=gs.totalUsers,ss.goodsScore=gs.goodsScore,ss.goodsUsers=gs.goodsUsers,ss.serviceScore=gs.serviceScore,ss.serviceUsers=gs.serviceUsers,ss.timeScore=gs.timeScore,ss.timeUsers=gs.timeUsers
 where ss.shopId=gs.shopId;



