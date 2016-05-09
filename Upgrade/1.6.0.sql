UPDATE wst_ads SET adFile = REPLACE(adFile, '/ads/', '/adspic/'); 

alter table wst_users add userFrom tinyint default 0;
alter table wst_users add openId varchar(100) default null;

alter table wst_areas modify column areaName varchar(100) not null ;
alter table wst_areas modify column areaKey varchar(10) ;

INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,valueRangeTxt,valueRange,fieldValue,fieldSort) VALUES ('4', '开启QQ登录', 'isOpenQQLogin', 'radio','是||否','1,0',0,1);
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,valueRangeTxt,valueRange,fieldValue,fieldTips,fieldSort) VALUES ('4', 'QQ APP ID', 'qqAppId', 'text','','','','',2);
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,valueRangeTxt,valueRange,fieldValue,fieldTips,fieldSort) VALUES ('4', 'QQ APP KEY', 'qqAppKey', 'text','','','','',3);

INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,valueRangeTxt,valueRange,fieldValue,fieldSort) VALUES ('4', '开启微信登录', 'isOpenWxLogin', 'radio','是||否','1,0',0,4);
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,valueRangeTxt,valueRange,fieldValue,fieldTips,fieldSort) VALUES ('4', '微信 APP ID', 'wxAppId', 'text','','','','',5);
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,valueRangeTxt,valueRange,fieldValue,fieldTips,fieldSort) VALUES ('4', '微信 APP KEY', 'wxAppKey', 'text','','','','',6);

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wst_cart`;
CREATE TABLE `wst_cart` (
  `cartId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL DEFAULT '0',
  `isCheck` tinyint(4) NOT NULL DEFAULT '1',
  `goodsId` int(11) NOT NULL DEFAULT '0',
  `goodsAttrId` int(11) NOT NULL DEFAULT '0',
  `goodsCnt` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cartId`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;