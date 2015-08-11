/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : wstmall_full

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-08-10 23:02:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_users`
-- ----------------------------
DROP TABLE IF EXISTS `wst_users`;
CREATE TABLE `wst_users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `loginName` varchar(20) NOT NULL,
  `loginSecret` int(11) NOT NULL,
  `loginPwd` varchar(50) NOT NULL,
  `userSex` tinyint(4) DEFAULT '0',
  `userType` tinyint(4) DEFAULT '0',
  `userName` varchar(20) DEFAULT NULL,
  `userQQ` varchar(20) DEFAULT NULL,
  `userPhone` char(11) DEFAULT NULL,
  `userEmail` varchar(50) DEFAULT NULL,
  `userScore` int(11) DEFAULT '0',
  `userPhoto` varchar(150) DEFAULT NULL,
  `userTotalScore` int(11) DEFAULT '0',
  `userStatus` tinyint(4) DEFAULT '1',
  `userFlag` tinyint(4) DEFAULT '1',
  `createTime` datetime DEFAULT NULL,
  `lastIP` varchar(16) DEFAULT NULL,
  `lastTime` datetime DEFAULT NULL,
  PRIMARY KEY (`userId`),
  KEY `userStatus` (`userStatus`,`userFlag`),
  KEY `loginName` (`loginName`),
  KEY `userPhone` (`userPhone`),
  KEY `userEmail` (`userEmail`),
  KEY `userType` (`userType`,`userFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_users
-- ----------------------------
INSERT INTO `wst_users` VALUES ('9', 'gd_guangzhou', '7902', 'd6a3fe736d32101b2070e4d7667db639', '0', '1', '广东广州店铺', null, '15918671994', null, '0', null, '0', '1', '1', '2015-05-08 10:29:39', '103.199.87.218', '2015-05-31 21:42:44');
INSERT INTO `wst_users` VALUES ('10', 'gd_shenzhen', '1679', '7fdc1a0615463a521a59d1da3fb49e5b', '0', '1', '广东深圳店铺', null, '15918671994', null, '0', null, '0', '1', '1', '2015-05-08 10:34:26', null, null);
INSERT INTO `wst_users` VALUES ('11', 'gd_zhuhai', '9254', '5dd44b6e13011dcaec803ebb71eee9ed', '0', '1', '广东珠海店铺', null, '15918671994', null, '0', null, '0', '1', '1', '2015-05-08 10:35:55', null, null);
INSERT INTO `wst_users` VALUES ('12', 'gd_shantou', '9880', 'ab9496339c7c82a54e04ed88cef3a88e', '0', '1', '广东汕头店铺', null, '15918671994', null, '0', null, '0', '1', '1', '2015-05-08 10:37:31', null, null);
INSERT INTO `wst_users` VALUES ('13', 'gd_shaoguan', '5234', '6dc085c2ffe8d99a1cce1f7d772ab23b', '0', '1', '广东韶关店铺', null, '15918671994', null, '0', null, '0', '1', '1', '2015-05-08 10:38:47', null, null);
INSERT INTO `wst_users` VALUES ('14', 'gd_foshan', '3896', 'f40f40cbe332a15292f9324d962422a2', '0', '1', '广东佛山店铺', null, '15918671994', null, '0', null, '0', '1', '1', '2015-05-08 10:39:51', null, null);
INSERT INTO `wst_users` VALUES ('15', '13763316008_b', '6834', 'fc9fb3a4db2ebb524be31925435987dc', '0', '1', '张测试', '', '13763316008', '', '0', null, '0', '1', '1', '2015-05-10 22:49:23', '101.46.63.120', '2015-06-01 21:22:19');
INSERT INTO `wst_users` VALUES ('16', 'ceshi1', '2885', '7e9b1a3e2a390f5da94b1b36e754c976', '0', '1', '测试店铺1', null, '15918671993', null, '0', null, '0', '1', '1', '2015-05-12 22:16:17', '103.199.87.218', '2015-05-31 22:43:31');
INSERT INTO `wst_users` VALUES ('17', 'ceshi2', '4644', '202cd234d8619d8b26ab8b2197e965ad', '0', '1', '测试店铺2', '', '15918671994', '', '0', null, '0', '1', '1', '2015-05-12 22:17:50', '103.199.87.218', '2015-05-31 17:18:26');
INSERT INTO `wst_users` VALUES ('18', 'ceshi3', '8150', 'eabc4d39c913b6e78f4756ae2a1daf2a', '0', '1', '测试店铺3', '', '15918671994', '', '0', null, '0', '1', '1', '2015-05-12 22:32:48', '103.199.87.218', '2015-05-31 21:58:08');
INSERT INTO `wst_users` VALUES ('19', 'ceshi21', '4334', '060ee46489799f04ad97b3d11f49f2b8', '0', '1', '测试店铺21', null, '15918671994', null, '0', null, '0', '1', '1', '2015-05-13 15:07:05', '223.73.155.87', '2015-05-26 21:52:51');
INSERT INTO `wst_users` VALUES ('20', 'ceshi22', '1466', '453e4fd1d9a7d33a6f5c4bd0bb1fc44b', '0', '1', '测试店铺22', null, '15918671994', null, '0', null, '0', '1', '1', '2015-05-13 15:08:14', '103.199.87.218', '2015-06-01 08:32:52');
INSERT INTO `wst_users` VALUES ('21', 'ceshi23', '4380', 'cd9a2715fdb1c8771122f978903ca74e', '0', '1', '测试店铺23', null, '15918671994', null, '0', null, '0', '1', '1', '2015-05-13 15:09:24', null, null);
INSERT INTO `wst_users` VALUES ('22', 'ceshi24', '3677', '06521bce3982f140212989e332488e72', '0', '1', '测试店铺24', null, '15918671994', null, '0', null, '0', '1', '1', '2015-05-13 15:10:47', null, null);
INSERT INTO `wst_users` VALUES ('23', '865984518_g', '9799', 'd5e8ee584602dce671a305c69da92f0e', '0', '0', '', '', '', '865984518@qq.com', '0', null, '0', '1', '1', '2015-05-21 14:08:24', null, null);
INSERT INTO `wst_users` VALUES ('24', 'ceshi31', '2518', 'fc9fb3a4db2ebb524be31925435987dc', '0', '1', '测试店铺31', '', '15918671996', '', '0', null, '0', '1', '1', '2015-05-26 21:06:03', '211.136.253.232', '2015-05-27 10:17:08');
INSERT INTO `wst_users` VALUES ('25', 'ceshi32', '8937', '2e59831193563c21a51b275788229f98', '0', '1', '测试店铺32', '', '15918671997', '', '0', null, '0', '1', '1', '2015-05-26 21:08:13', '103.199.87.218', '2015-06-01 11:34:34');
INSERT INTO `wst_users` VALUES ('26', 'ceshi33', '1867', '845aa09ad90841fccdf865def2c80755', '0', '1', '测试店铺33', '', '15918671991', '', '0', null, '0', '1', '1', '2015-05-26 21:09:53', '103.199.87.218', '2015-06-01 11:53:52');
INSERT INTO `wst_users` VALUES ('27', 'ceshi34', '4588', 'fc9fb3a4db2ebb524be31925435987dc', '0', '1', '测试店铺34', '', '15918671998', '', '0', null, '0', '1', '1', '2015-05-26 21:11:23', null, null);
INSERT INTO `wst_users` VALUES ('28', 'ceshi41', '7274', 'fc9fb3a4db2ebb524be31925435987dc', '0', '1', '测试店铺41', '', '15918671992', '', '0', null, '0', '1', '1', '2015-05-26 21:14:00', '211.136.253.198', '2015-05-27 14:54:22');
INSERT INTO `wst_users` VALUES ('29', 'ceshi42', '4880', '947a7d3678d8bd05c7f21cfd0c5be50d', '0', '1', '测试店铺42', '', '15918671990', '', '0', null, '0', '1', '1', '2015-05-26 21:20:27', '103.199.87.218', '2015-06-01 19:04:36');
INSERT INTO `wst_users` VALUES ('30', 'ceshi43', '1630', 'fc9fb3a4db2ebb524be31925435987dc', '0', '1', '测试店铺43', '', '15918671989', '', '0', null, '0', '1', '1', '2015-05-26 21:22:06', null, null);
INSERT INTO `wst_users` VALUES ('31', 'ceshi44', '4123', 'fc9fb3a4db2ebb524be31925435987dc', '0', '1', '测试店铺44', '', '15918671980', '', '0', null, '0', '1', '1', '2015-05-26 21:24:36', null, null);
INSERT INTO `wst_users` VALUES ('32', 'ceshi51', '3092', 'fc9fb3a4db2ebb524be31925435987dc', '0', '1', '测试店铺51', '', '15918671988', '', '0', null, '0', '1', '1', '2015-05-26 21:30:17', '223.73.155.87', '2015-05-27 20:55:46');
INSERT INTO `wst_users` VALUES ('33', 'ceshi52', '9160', '6276f96ad761e03f633d1a1b484156d8', '0', '1', '测试店铺52', '', '15918671881', '', '0', null, '0', '1', '1', '2015-05-26 21:32:01', '103.199.87.218', '2015-06-01 20:32:34');
INSERT INTO `wst_users` VALUES ('34', 'ceshi53', '9425', 'fc9fb3a4db2ebb524be31925435987dc', '0', '1', '测试店铺53', '', '15918671812', '', '0', null, '0', '1', '1', '2015-05-26 21:33:27', null, null);
INSERT INTO `wst_users` VALUES ('35', 'ceshi54', '3157', 'fc9fb3a4db2ebb524be31925435987dc', '0', '1', '测试店铺54', '', '15918671834', '', '0', null, '0', '1', '1', '2015-05-26 21:40:20', null, null);
INSERT INTO `wst_users` VALUES ('36', 'ceshi61', '1934', 'fc9fb3a4db2ebb524be31925435987dc', '0', '1', '测试店铺61', '', '15918671833', '', '0', null, '0', '1', '1', '2015-05-26 21:42:59', '223.73.155.87', '2015-05-27 22:24:04');
INSERT INTO `wst_users` VALUES ('37', 'ceshi62', '1996', '0c3a4081280a5b80af5b70967cb6252a', '0', '1', '测试店铺62', '', '15918671867', '', '0', null, '0', '1', '1', '2015-05-26 21:45:22', '103.199.87.218', '2015-06-01 21:44:20');
INSERT INTO `wst_users` VALUES ('38', 'ceshi63', '8163', 'fc9fb3a4db2ebb524be31925435987dc', '0', '1', '测试店铺63', '', '15918671987', '', '0', null, '0', '1', '1', '2015-05-26 21:47:10', null, null);
INSERT INTO `wst_users` VALUES ('39', 'ceshi64', '3204', '5d50361a4cc2359475c8d08c34fbfcd4', '0', '1', '测试店铺64', '', '15918671857', '', '0', null, '0', '1', '1', '2015-05-26 21:48:43', null, null);

-- ----------------------------
-- Table structure for `wst_user_ranks`
-- ----------------------------
DROP TABLE IF EXISTS `wst_user_ranks`;
CREATE TABLE `wst_user_ranks` (
  `rankId` int(11) NOT NULL AUTO_INCREMENT,
  `rankName` varchar(20) NOT NULL,
  `startScore` int(11) NOT NULL DEFAULT '0',
  `endScore` int(11) NOT NULL DEFAULT '0',
  `rebate` int(11) DEFAULT '100',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`rankId`),
  KEY `startScore` (`startScore`,`endScore`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_user_ranks
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_user_address`
-- ----------------------------
DROP TABLE IF EXISTS `wst_user_address`;
CREATE TABLE `wst_user_address` (
  `addressId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPhone` varchar(20) DEFAULT NULL,
  `userTel` varchar(20) DEFAULT NULL,
  `areaId1` int(11) NOT NULL DEFAULT '0',
  `areaId2` int(11) NOT NULL DEFAULT '0',
  `areaId3` int(11) NOT NULL DEFAULT '0',
  `communityId` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL,
  `postCode` char(6) NOT NULL,
  `isDefault` tinyint(4) NOT NULL DEFAULT '0',
  `addressFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`addressId`),
  KEY `userId` (`userId`,`addressFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_user_address
-- ----------------------------
INSERT INTO `wst_user_address` VALUES ('1', '9', '马生', null, '020-46787622', '440000', '440100', '440106', '15', '红花岗', '512000', '0', '1', '2015-05-19 23:28:38');
INSERT INTO `wst_user_address` VALUES ('2', '9', '马生', null, '1591867199', '440000', '440100', '440106', '17', '桑德菲杰卡拉斯的减肥', '345987', '1', '1', '2015-05-19 23:55:11');

-- ----------------------------
-- Table structure for `wst_sys_configs`
-- ----------------------------
DROP TABLE IF EXISTS `wst_sys_configs`;
CREATE TABLE `wst_sys_configs` (
  `configId` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `parentId` int(11) DEFAULT '0' COMMENT '所属类别ID',
  `fieldName` varchar(50) DEFAULT NULL COMMENT '字段名称',
  `fieldCode` varchar(20) DEFAULT NULL COMMENT '字段代码',
  `fieldType` char(10) DEFAULT NULL COMMENT '字段类型',
  `valueRangeTxt` varchar(255) DEFAULT NULL COMMENT '范围值名称',
  `valueRange` varchar(255) DEFAULT NULL COMMENT '范围值',
  `fieldValue` varchar(255) DEFAULT NULL COMMENT '字段值',
  `fieldTips` varchar(255) DEFAULT NULL COMMENT '字段提示',
  `fieldSort` int(11) DEFAULT '0' COMMENT '字段排序',
  PRIMARY KEY (`configId`),
  KEY `parentId` (`parentId`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_sys_configs
-- ----------------------------
INSERT INTO `wst_sys_configs` VALUES ('1', '0', '商城名称', 'mallName', 'text', null, '', 'WSTMall开源商城', null, '1');
INSERT INTO `wst_sys_configs` VALUES ('2', '0', '商城标题', 'mallTitle', 'text', null, null, 'WSTMall开源商城', null, '2');
INSERT INTO `wst_sys_configs` VALUES ('3', '0', '商城描述', 'mallDesc', 'text', null, null, 'WSTMall开源商城,本地O2O商城,多商户,PHP多用户开源商城,O2O开源商城', null, '3');
INSERT INTO `wst_sys_configs` VALUES ('4', '0', '商城关键字', 'mallKeywords', 'text', null, null, 'WSTMall开源商城,本地O2O商城,多商户,PHP多用户开源商城,O2O开源商城', '&nbsp;&nbsp;以，号分隔', '4');
INSERT INTO `wst_sys_configs` VALUES ('6', '1', '验证码显示范围', 'captcha_model', 'hidden', '管理员登录||商家加盟||商家登录||新用户注册||用户登录||留言反馈', '0,1,2,3,4,5', '0,1,2,3,4,5', null, '0');
INSERT INTO `wst_sys_configs` VALUES ('7', '1', '验证码个数', 'captcha_len', 'hidden', null, null, '4', null, '0');
INSERT INTO `wst_sys_configs` VALUES ('8', '1', '验证码宽度', 'captcha_width', 'hidden', null, null, '85', null, '0');
INSERT INTO `wst_sys_configs` VALUES ('9', '1', '验证码高度', 'captcha_height', 'hidden', null, null, '25', null, '0');
INSERT INTO `wst_sys_configs` VALUES ('10', '1', '验证模式', 'captcha_show', 'hidden', '字母,数字,混合', '0,1,6', '0', null, '0');
INSERT INTO `wst_sys_configs` VALUES ('13', '0', '商品是否需要审核', 'isGoodsVerify', 'radio', '是||否', '1,0', '0', null, '5');
INSERT INTO `wst_sys_configs` VALUES ('14', '0', '访问统计', 'visitStatistics', 'textarea', null, null, '&lt;script language=&quot;javascript&quot; type=&quot;text/javascript&quot; src=&quot;http://js.users.51.la/18256266.js&quot;&gt;&lt;/script&gt;', null, '9');
INSERT INTO `wst_sys_configs` VALUES ('15', '1', 'SMTP服务器', 'mailSmtp', 'text', null, null, 'smtp.163.com', null, '1');
INSERT INTO `wst_sys_configs` VALUES ('16', '1', 'SMTP端口', 'mailPort', 'text', null, null, '25', null, '2');
INSERT INTO `wst_sys_configs` VALUES ('17', '1', '是否验证SMTP', 'mailAuth', 'radio', '是||否', '1,0', '1', null, '3');
INSERT INTO `wst_sys_configs` VALUES ('18', '1', 'SMTP发件人邮箱', 'mailAddress', 'text', null, null, 'xxxxx@163.com', null, '4');
INSERT INTO `wst_sys_configs` VALUES ('19', '1', 'SMTP登录账号', 'mailUserName', 'text', null, null, 'username', null, '5');
INSERT INTO `wst_sys_configs` VALUES ('20', '1', 'SMTP登录密码', 'mailPassword', 'text', null, null, 'password', null, '6');
INSERT INTO `wst_sys_configs` VALUES ('21', '1', '发件人名称', 'mailSendTitle', 'text', null, null, 'WSTMall', null, '7');
INSERT INTO `wst_sys_configs` VALUES ('22', '2', '短信账号', 'smsKey', 'text', null, null, 'WSTMall', null, '1');
INSERT INTO `wst_sys_configs` VALUES ('23', '2', '短信密码', 'smsPass', 'text', null, null, 'WSTMall', null, '2');
INSERT INTO `wst_sys_configs` VALUES ('24', '2', '号码每日发送数', 'smsLimit', 'text', null, null, '20', '避免恶意浪费短信的行为', '3');
INSERT INTO `wst_sys_configs` VALUES ('26', '0', '授权码', 'mallLicense', 'hidden', null, null, null, null, '0');
INSERT INTO `wst_sys_configs` VALUES ('27', '0', '商城Logo', 'mallLogo', 'upload', null, null, 'Apps/Home/View/default/images/logo.png', '(建议为240x132)<br/>', '6');
INSERT INTO `wst_sys_configs` VALUES ('28', '0', '默认图片', 'goodsImg', 'upload', null, null, 'Apps/Home/View/default/images/item-pic.jpg', '', '7');
INSERT INTO `wst_sys_configs` VALUES ('29', '0', '底部设置', 'mallFooter', 'textarea', null, null, 'CROPYRIGHT 2013-2015 广州晴暖信息科技有限公司 版权所有  电话：020-29806661&lt;br/&gt;公司邮箱：wasonteam@163.com  客服QQ:707563272  粤ICP备13014375号&lt;br/&gt;我们愿与更多中小企业一起努力，一起成功 We Success together', null, '8');

-- ----------------------------
-- Table structure for `wst_staffs`
-- ----------------------------
DROP TABLE IF EXISTS `wst_staffs`;
CREATE TABLE `wst_staffs` (
  `staffId` int(11) NOT NULL AUTO_INCREMENT,
  `loginName` varchar(40) NOT NULL,
  `loginPwd` varchar(50) NOT NULL,
  `secretKey` int(32) NOT NULL,
  `staffName` varchar(50) NOT NULL,
  `staffNo` varchar(20) DEFAULT NULL,
  `staffPhoto` varchar(150) DEFAULT NULL,
  `staffRoleId` int(11) NOT NULL,
  `workStatus` tinyint(4) NOT NULL DEFAULT '1',
  `staffStatus` tinyint(4) NOT NULL DEFAULT '0',
  `staffFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  `lastTime` datetime DEFAULT NULL,
  `lastIP` char(16) DEFAULT NULL,
  PRIMARY KEY (`staffId`),
  KEY `loginName` (`loginName`),
  KEY `staffStatus` (`staffStatus`,`staffFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_staffs
-- ----------------------------
INSERT INTO `wst_staffs` VALUES ('1', 'admin', '598f0a2c3fa54a88dbe6350d0ed00529', '9365', 'admin', '001', 'Upload/staffs/2015-04/55306cf76bc1f.jpg', '3', '1', '1', '1', '2014-04-06 11:47:20', '2015-06-04 22:37:16', '127.0.0.1');
INSERT INTO `wst_staffs` VALUES ('14', 'system', 'a0da805e0b77f6cc05cdf0ef6ca8caad', '2508', '系统管理员', 'sn001', null, '3', '1', '1', '1', '2014-12-20 00:13:36', null, null);
INSERT INTO `wst_staffs` VALUES ('15', 'goodsAdmin', '1600195af828b21c1f586b1e01cb89fc', '1729', '商品管理员', 'sn001', 'Upload/staffs/2014-12/5496376a7ff89.jpg', '1', '1', '1', '1', '2014-12-21 10:58:40', null, null);

-- ----------------------------
-- Table structure for `wst_shops_communitys`
-- ----------------------------
DROP TABLE IF EXISTS `wst_shops_communitys`;
CREATE TABLE `wst_shops_communitys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `areaId3` int(11) NOT NULL,
  `communityId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shopId` (`shopId`),
  KEY `communityId` (`communityId`)
) ENGINE=MyISAM AUTO_INCREMENT=407 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_shops_communitys
-- ----------------------------
INSERT INTO `wst_shops_communitys` VALUES ('60', '10', '440000', '440100', '440101', '0');
INSERT INTO `wst_shops_communitys` VALUES ('61', '10', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('65', '8', '440000', '440200', '440201', '0');
INSERT INTO `wst_shops_communitys` VALUES ('66', '8', '440000', '440200', '440203', '0');
INSERT INTO `wst_shops_communitys` VALUES ('67', '8', '440000', '440200', '440204', '0');
INSERT INTO `wst_shops_communitys` VALUES ('68', '8', '440000', '440200', '440205', '0');
INSERT INTO `wst_shops_communitys` VALUES ('69', '7', '440000', '440500', '440501', '0');
INSERT INTO `wst_shops_communitys` VALUES ('70', '7', '440000', '440500', '440507', '0');
INSERT INTO `wst_shops_communitys` VALUES ('71', '7', '440000', '440500', '440511', '0');
INSERT INTO `wst_shops_communitys` VALUES ('72', '6', '440000', '440400', '440401', '0');
INSERT INTO `wst_shops_communitys` VALUES ('73', '6', '440000', '440400', '440402', '0');
INSERT INTO `wst_shops_communitys` VALUES ('74', '6', '440000', '440400', '440403', '0');
INSERT INTO `wst_shops_communitys` VALUES ('75', '6', '440000', '440400', '440404', '0');
INSERT INTO `wst_shops_communitys` VALUES ('76', '5', '440000', '440300', '440301', '0');
INSERT INTO `wst_shops_communitys` VALUES ('77', '5', '440000', '440300', '440303', '0');
INSERT INTO `wst_shops_communitys` VALUES ('78', '5', '440000', '440300', '440304', '0');
INSERT INTO `wst_shops_communitys` VALUES ('79', '9', '440000', '440600', '440601', '0');
INSERT INTO `wst_shops_communitys` VALUES ('80', '9', '440000', '440600', '440604', '0');
INSERT INTO `wst_shops_communitys` VALUES ('81', '9', '440000', '440600', '440605', '0');
INSERT INTO `wst_shops_communitys` VALUES ('102', '13', '440000', '440100', '440101', '0');
INSERT INTO `wst_shops_communitys` VALUES ('103', '13', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('104', '12', '440000', '440100', '440101', '0');
INSERT INTO `wst_shops_communitys` VALUES ('105', '12', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('112', '17', '440000', '440100', '440101', '0');
INSERT INTO `wst_shops_communitys` VALUES ('113', '17', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('114', '17', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('115', '17', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('116', '17', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('117', '17', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('118', '17', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('119', '17', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('120', '17', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('121', '17', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('122', '17', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('123', '17', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('124', '17', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('125', '16', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('126', '16', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('127', '16', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('128', '16', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('129', '16', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('130', '16', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('131', '16', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('132', '16', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('133', '16', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('134', '16', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('135', '15', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('136', '15', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('137', '15', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('138', '15', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('139', '15', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('140', '15', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('141', '15', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('142', '15', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('143', '15', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('144', '15', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('155', '4', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('156', '4', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('157', '4', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('158', '4', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('159', '4', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('160', '4', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('161', '4', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('162', '4', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('163', '4', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('164', '4', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('165', '4', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('166', '4', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('167', '11', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('168', '11', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('169', '11', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('170', '11', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('171', '11', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('172', '11', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('173', '11', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('174', '11', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('175', '11', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('176', '11', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('177', '11', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('178', '18', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('179', '18', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('180', '18', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('181', '18', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('182', '18', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('183', '18', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('184', '18', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('185', '18', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('186', '18', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('187', '18', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('188', '18', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('189', '18', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('190', '18', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('191', '19', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('192', '19', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('193', '19', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('194', '19', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('195', '19', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('196', '19', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('197', '19', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('198', '19', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('199', '19', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('200', '19', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('201', '19', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('202', '19', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('203', '19', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('204', '20', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('205', '20', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('206', '20', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('207', '20', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('208', '20', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('209', '20', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('210', '20', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('211', '20', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('212', '20', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('213', '20', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('214', '20', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('215', '20', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('216', '21', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('217', '21', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('218', '21', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('219', '21', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('220', '21', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('221', '21', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('222', '21', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('223', '21', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('224', '21', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('225', '21', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('226', '21', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('227', '21', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('228', '21', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('229', '22', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('230', '22', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('231', '22', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('232', '22', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('233', '22', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('234', '22', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('235', '22', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('236', '22', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('237', '22', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('238', '22', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('239', '22', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('240', '23', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('241', '23', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('242', '23', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('243', '23', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('244', '23', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('245', '23', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('246', '23', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('247', '23', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('248', '23', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('249', '23', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('250', '23', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('251', '23', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('252', '23', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('253', '24', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('254', '24', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('255', '24', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('256', '24', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('257', '24', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('258', '24', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('259', '24', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('260', '24', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('261', '24', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('262', '24', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('263', '24', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('264', '24', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('265', '24', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('266', '25', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('267', '25', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('268', '25', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('269', '25', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('270', '25', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('271', '25', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('272', '25', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('273', '25', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('274', '25', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('275', '25', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('276', '25', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('277', '25', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('278', '26', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('279', '26', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('280', '26', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('281', '26', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('282', '26', '440000', '440100', '440111', '0');
INSERT INTO `wst_shops_communitys` VALUES ('283', '26', '440000', '440100', '440112', '0');
INSERT INTO `wst_shops_communitys` VALUES ('284', '26', '440000', '440100', '440113', '0');
INSERT INTO `wst_shops_communitys` VALUES ('285', '26', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('286', '26', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('287', '26', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('288', '26', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('289', '26', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('290', '26', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('291', '26', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('292', '26', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('293', '26', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('294', '27', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('295', '27', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('296', '27', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('297', '27', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('298', '27', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('299', '27', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('300', '27', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('301', '27', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('302', '27', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('303', '27', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('304', '27', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('305', '27', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('306', '27', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('307', '28', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('308', '28', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('309', '28', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('310', '28', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('311', '28', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('312', '28', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('313', '28', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('314', '28', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('315', '28', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('316', '28', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('317', '28', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('318', '28', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('319', '28', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('320', '29', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('321', '29', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('322', '29', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('323', '29', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('324', '29', '440000', '440100', '440111', '0');
INSERT INTO `wst_shops_communitys` VALUES ('325', '29', '440000', '440100', '440112', '0');
INSERT INTO `wst_shops_communitys` VALUES ('326', '29', '440000', '440100', '440113', '0');
INSERT INTO `wst_shops_communitys` VALUES ('327', '29', '440000', '440100', '440114', '0');
INSERT INTO `wst_shops_communitys` VALUES ('328', '29', '440000', '440100', '440115', '0');
INSERT INTO `wst_shops_communitys` VALUES ('329', '29', '440000', '440100', '440117', '0');
INSERT INTO `wst_shops_communitys` VALUES ('330', '29', '440000', '440100', '440118', '0');
INSERT INTO `wst_shops_communitys` VALUES ('331', '29', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('332', '29', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('333', '29', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('334', '29', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('335', '29', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('336', '29', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('337', '29', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('338', '29', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('339', '29', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('340', '30', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('341', '30', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('342', '30', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('343', '30', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('344', '30', '440000', '440100', '440111', '0');
INSERT INTO `wst_shops_communitys` VALUES ('345', '30', '440000', '440100', '440112', '0');
INSERT INTO `wst_shops_communitys` VALUES ('346', '30', '440000', '440100', '440113', '0');
INSERT INTO `wst_shops_communitys` VALUES ('347', '30', '440000', '440100', '440114', '0');
INSERT INTO `wst_shops_communitys` VALUES ('348', '30', '440000', '440100', '440115', '0');
INSERT INTO `wst_shops_communitys` VALUES ('349', '30', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('350', '30', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('351', '30', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('352', '30', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('353', '30', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('354', '30', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('355', '30', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('356', '30', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('357', '30', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('358', '31', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('359', '31', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('360', '31', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('361', '31', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('362', '31', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('363', '31', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('364', '31', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('365', '31', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('366', '31', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('367', '31', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('368', '31', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('369', '31', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('370', '31', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('371', '32', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('372', '32', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('373', '32', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('374', '32', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('375', '32', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('376', '32', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('377', '32', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('378', '32', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('379', '32', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('380', '32', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('381', '32', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('382', '32', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('383', '32', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('384', '33', '440000', '440100', '440103', '0');
INSERT INTO `wst_shops_communitys` VALUES ('385', '33', '440000', '440100', '440104', '0');
INSERT INTO `wst_shops_communitys` VALUES ('386', '33', '440000', '440100', '440105', '0');
INSERT INTO `wst_shops_communitys` VALUES ('387', '33', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('388', '33', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('389', '33', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('390', '33', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('391', '33', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('392', '33', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('393', '33', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('394', '33', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('395', '33', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('396', '33', '440000', '440100', '440106', '23');
INSERT INTO `wst_shops_communitys` VALUES ('397', '14', '440000', '440100', '440106', '0');
INSERT INTO `wst_shops_communitys` VALUES ('398', '14', '440000', '440100', '440106', '15');
INSERT INTO `wst_shops_communitys` VALUES ('399', '14', '440000', '440100', '440106', '16');
INSERT INTO `wst_shops_communitys` VALUES ('400', '14', '440000', '440100', '440106', '17');
INSERT INTO `wst_shops_communitys` VALUES ('401', '14', '440000', '440100', '440106', '18');
INSERT INTO `wst_shops_communitys` VALUES ('402', '14', '440000', '440100', '440106', '19');
INSERT INTO `wst_shops_communitys` VALUES ('403', '14', '440000', '440100', '440106', '20');
INSERT INTO `wst_shops_communitys` VALUES ('404', '14', '440000', '440100', '440106', '21');
INSERT INTO `wst_shops_communitys` VALUES ('405', '14', '440000', '440100', '440106', '22');
INSERT INTO `wst_shops_communitys` VALUES ('406', '14', '440000', '440100', '440106', '23');

-- ----------------------------
-- Table structure for `wst_shops_cats`
-- ----------------------------
DROP TABLE IF EXISTS `wst_shops_cats`;
CREATE TABLE `wst_shops_cats` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `parentId` int(11) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `catName` varchar(100) NOT NULL,
  `catSort` int(11) NOT NULL DEFAULT '0',
  `catFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catId`),
  KEY `parentId` (`isShow`,`catFlag`) USING BTREE,
  KEY `shopId` (`shopId`,`catFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=184 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_shops_cats
-- ----------------------------
INSERT INTO `wst_shops_cats` VALUES ('7', '4', '0', '1', '水果类', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('8', '4', '7', '1', '亚酸性水果', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('9', '4', '0', '1', '蔬菜类', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('10', '4', '7', '1', '甜性水果', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('11', '4', '7', '1', '葡萄', '4', '-1');
INSERT INTO `wst_shops_cats` VALUES ('12', '4', '7', '1', '樱桃', '6', '-1');
INSERT INTO `wst_shops_cats` VALUES ('13', '4', '9', '1', '瓜果实', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('14', '4', '9', '1', '豆类', '7', '1');
INSERT INTO `wst_shops_cats` VALUES ('15', '4', '9', '1', '根茎', '8', '1');
INSERT INTO `wst_shops_cats` VALUES ('16', '4', '9', '1', '柿子', '9', '-1');
INSERT INTO `wst_shops_cats` VALUES ('17', '4', '9', '1', '凤梨', '9', '-1');
INSERT INTO `wst_shops_cats` VALUES ('18', '11', '0', '1', '新鲜蔬菜', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('19', '11', '0', '1', '肉类蛋禽', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('20', '11', '19', '1', '肉类', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('21', '11', '19', '1', '蛋品', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('22', '11', '19', '1', '骨肉', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('23', '11', '19', '1', '虾蟹', '6', '1');
INSERT INTO `wst_shops_cats` VALUES ('24', '11', '19', '1', '海鱼', '7', '1');
INSERT INTO `wst_shops_cats` VALUES ('25', '11', '18', '1', '叶菜', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('26', '11', '18', '1', '花菜', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('27', '11', '18', '1', '豆类', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('28', '4', '0', '1', '海鲜水产', '5', '1');
INSERT INTO `wst_shops_cats` VALUES ('29', '4', '28', '1', '海鱼', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('30', '4', '28', '1', '虾蟹', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('31', '14', '0', '1', '厨房清洁', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('32', '14', '0', '1', '纸质品', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('33', '14', '0', '1', '纸质品', '1', '-1');
INSERT INTO `wst_shops_cats` VALUES ('34', '14', '0', '1', '居家清洁', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('35', '14', '0', '1', '整理收纳', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('36', '14', '31', '1', '洗洁精', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('37', '14', '31', '1', '浴室清洁', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('38', '14', '31', '1', '洁厕精', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('39', '14', '32', '1', '卷筒纸', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('40', '14', '32', '1', '手帕纸', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('41', '14', '34', '1', '洗衣粉', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('42', '14', '34', '1', '洗衣液', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('43', '14', '35', '1', '收纳箱', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('44', '14', '35', '1', '压缩袋', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('45', '14', '34', '1', '洗衣皂', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('46', '18', '0', '1', '黑茶', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('47', '18', '0', '1', '红茶', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('48', '18', '0', '1', '绿茶', '4', '1');
INSERT INTO `wst_shops_cats` VALUES ('49', '18', '0', '1', '黄茶', '7', '1');
INSERT INTO `wst_shops_cats` VALUES ('50', '18', '46', '1', '普洱', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('51', '18', '46', '1', '安化黑茶', '4', '1');
INSERT INTO `wst_shops_cats` VALUES ('52', '18', '0', '1', '乌龙茶', '9', '1');
INSERT INTO `wst_shops_cats` VALUES ('53', '18', '52', '1', '铁观音', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('54', '19', '0', '1', '白酒', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('55', '19', '0', '1', '葡萄酒', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('56', '19', '0', '1', '洋酒', '6', '1');
INSERT INTO `wst_shops_cats` VALUES ('57', '19', '0', '1', '养生酒/啤酒/黄酒', '6', '1');
INSERT INTO `wst_shops_cats` VALUES ('58', '19', '54', '1', '茅台', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('59', '19', '54', '1', '五粮液', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('60', '19', '54', '1', '汾酒', '4', '1');
INSERT INTO `wst_shops_cats` VALUES ('61', '19', '54', '1', '泸州老窖', '7', '1');
INSERT INTO `wst_shops_cats` VALUES ('62', '19', '55', '1', '法国', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('63', '19', '55', '1', '澳大利亚', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('64', '19', '55', '1', '中国', '4', '1');
INSERT INTO `wst_shops_cats` VALUES ('65', '19', '55', '1', '智利', '76', '1');
INSERT INTO `wst_shops_cats` VALUES ('66', '19', '56', '1', '威士忌', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('67', '19', '56', '1', '白兰地', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('68', '19', '56', '1', '伏特加', '4', '1');
INSERT INTO `wst_shops_cats` VALUES ('69', '19', '56', '1', '朗姆酒', '4', '1');
INSERT INTO `wst_shops_cats` VALUES ('70', '19', '57', '1', '宁夏红', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('71', '19', '57', '1', '竹叶青', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('72', '19', '57', '1', '劲牌', '4', '1');
INSERT INTO `wst_shops_cats` VALUES ('73', '19', '57', '1', '乌毡帽', '5', '1');
INSERT INTO `wst_shops_cats` VALUES ('74', '22', '0', '1', '食用油', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('75', '22', '0', '1', '方便速食', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('76', '22', '0', '1', '菇类干货', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('77', '22', '76', '1', '莲子/红枣', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('78', '22', '76', '1', '菌菇', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('79', '22', '76', '1', '枸杞', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('80', '22', '75', '1', '八宝粥', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('81', '22', '75', '1', '火腿肠', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('82', '22', '75', '1', '罐头食品', '5', '1');
INSERT INTO `wst_shops_cats` VALUES ('83', '22', '74', '1', '玉米油', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('84', '22', '74', '1', '大豆油', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('85', '22', '74', '1', '花生油', '4', '1');
INSERT INTO `wst_shops_cats` VALUES ('86', '22', '74', '1', '菜籽油', '6', '1');
INSERT INTO `wst_shops_cats` VALUES ('87', '22', '74', '1', '橄榄油', '8', '1');
INSERT INTO `wst_shops_cats` VALUES ('88', '26', '0', '1', '化妆品', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('89', '26', '0', '1', '护肤品', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('90', '26', '0', '1', '洗浴用品', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('91', '26', '90', '1', '沐浴露', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('92', '26', '90', '1', '洗发水', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('93', '26', '90', '1', '沐浴套装', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('94', '26', '89', '1', '保湿', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('95', '26', '88', '1', '女士化妆品', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('96', '26', '88', '1', '化妆品套装', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('97', '26', '88', '1', '男士护肤品', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('98', '30', '0', '1', '休闲零食', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('99', '30', '0', '1', '进口糕点', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('100', '30', '98', '1', '牛肉干', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('101', '30', '99', '1', '进口威化饼', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('102', '30', '99', '1', '进口蛋卷', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('103', '30', '99', '1', '进口夹心饼', '2', '1');
INSERT INTO `wst_shops_cats` VALUES ('104', '30', '98', '1', '鱼干', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('105', '30', '98', '1', '凤爪鸡翅', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('106', '30', '98', '1', '肉类休闲零食', '5', '1');
INSERT INTO `wst_shops_cats` VALUES ('107', '10', '0', '1', '银饰', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('108', '10', '107', '1', '手链', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('109', '10', '107', '1', '手链', '0', '-1');
INSERT INTO `wst_shops_cats` VALUES ('110', '10', '107', '1', '戒指', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('111', '10', '107', '1', '耳环', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('112', '12', '0', '1', '有机蔬菜', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('113', '12', '112', '1', '菌菇类', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('114', '12', '112', '1', '根茎类', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('115', '12', '112', '1', '叶菜类', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('116', '12', '112', '1', '茄果类', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('117', '12', '112', '1', '豆荚类', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('118', '12', '112', '1', '海鲜水产', '0', '-1');
INSERT INTO `wst_shops_cats` VALUES ('119', '12', '0', '1', '海鲜水产', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('120', '12', '119', '1', '蟹', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('121', '12', '119', '1', '鱼', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('122', '12', '119', '1', '虾', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('123', '12', '119', '1', '贝壳', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('124', '12', '0', '1', '净菜', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('125', '12', '124', '1', '荤菜', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('126', '12', '124', '1', '汤类', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('127', '13', '0', '1', '海鲜水产', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('128', '13', '127', '1', '速冻生鲜', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('129', '15', '0', '1', '一次性用品', '1', '1');
INSERT INTO `wst_shops_cats` VALUES ('130', '15', '0', '1', '居室清洁', '3', '1');
INSERT INTO `wst_shops_cats` VALUES ('131', '15', '0', '1', '整理收纳', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('132', '15', '129', '1', '一次性餐具', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('133', '15', '129', '1', '一次性手套', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('134', '15', '129', '1', '一次性鞋套', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('135', '15', '129', '1', '棉签/棉棒', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('136', '15', '129', '1', '保鲜膜', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('137', '15', '129', '1', '垃圾袋', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('138', '15', '131', '1', '挂钩/粘钩', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('139', '15', '131', '1', '压缩袋', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('140', '15', '131', '1', '抽气泵', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('141', '15', '131', '1', '收纳袋', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('142', '15', '131', '1', '收纳盒', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('143', '15', '131', '1', '收纳篮', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('144', '15', '130', '1', '多用途清洁剂', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('145', '15', '130', '1', '玻璃清洁', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('146', '15', '130', '1', '驱蚊驱虫', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('147', '20', '0', '1', '咖啡', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('148', '20', '147', '1', '速溶咖啡', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('149', '20', '147', '1', '咖啡伴侣', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('150', '20', '147', '1', '咖啡豆/粉', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('151', '20', '0', '1', '饮料饮品', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('152', '20', '151', '1', '功能饮料', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('153', '20', '151', '1', '碳酸饮料', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('154', '20', '151', '1', '乳饮料', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('155', '20', '0', '1', '成人奶粉', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('156', '20', '155', '1', '奶粉', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('157', '23', '0', '1', '食用油', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('158', '23', '0', '1', '大米面粉', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('159', '23', '0', '1', '杂粮', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('160', '23', '0', '1', '方便速食', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('161', '23', '157', '1', '调和油', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('162', '23', '157', '1', '菜籽油', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('163', '23', '158', '1', '大米', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('164', '23', '159', '1', '小米', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('165', '23', '159', '1', '玉米', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('166', '23', '159', '1', '薏米', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('167', '23', '159', '1', '糙米', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('168', '23', '160', '1', '方便面', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('169', '23', '160', '1', '八宝粥', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('170', '27', '0', '1', '女性护理', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('171', '27', '170', '1', '私处洗液', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('172', '27', '0', '1', '进口美护', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('173', '27', '172', '1', '进口美护', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('174', '31', '0', '1', '坚果现货', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('175', '31', '174', '1', '开心果', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('176', '31', '174', '1', '核桃', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('177', '31', '174', '1', '瓜子', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('178', '31', '174', '1', '腰果', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('179', '31', '0', '1', '进口休闲零食', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('180', '31', '179', '1', '巧克力', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('181', '31', '179', '1', '花生', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('182', '31', '179', '1', '奶糖', '0', '1');
INSERT INTO `wst_shops_cats` VALUES ('183', '31', '179', '1', '饼干', '0', '1');

-- ----------------------------
-- Table structure for `wst_shops`
-- ----------------------------
DROP TABLE IF EXISTS `wst_shops`;
CREATE TABLE `wst_shops` (
  `shopId` int(11) NOT NULL AUTO_INCREMENT,
  `shopSn` varchar(20) NOT NULL,
  `userId` int(11) NOT NULL,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `areaId3` int(11) NOT NULL,
  `goodsCatId1` int(11) NOT NULL,
  `goodsCatId2` int(11) DEFAULT NULL,
  `goodsCatId3` int(11) DEFAULT NULL,
  `isSelf` tinyint(4) NOT NULL DEFAULT '0',
  `shopName` varchar(100) NOT NULL,
  `shopCompany` varchar(255) NOT NULL,
  `shopImg` varchar(150) NOT NULL,
  `shopTel` varchar(20) DEFAULT NULL,
  `shopAddress` varchar(255) NOT NULL,
  `avgeCostMoney` float NOT NULL DEFAULT '0',
  `deliveryStartMoney` float NOT NULL DEFAULT '0',
  `deliveryMoney` float NOT NULL DEFAULT '0',
  `deliveryFreeMoney` float NOT NULL DEFAULT '0',
  `deliveryCostTime` int(11) NOT NULL DEFAULT '0',
  `deliveryTime` varchar(255) NOT NULL,
  `deliveryType` tinyint(4) NOT NULL DEFAULT '0',
  `bankId` int(11) NOT NULL,
  `bankNo` varchar(20) NOT NULL,
  `isInvoice` tinyint(4) NOT NULL DEFAULT '0',
  `invoiceRemarks` varchar(255) DEFAULT NULL,
  `serviceStartTime` float(11,1) NOT NULL,
  `serviceEndTime` float(11,1) NOT NULL,
  `shopStatus` tinyint(4) NOT NULL DEFAULT '0',
  `statusRemarks` varchar(255) DEFAULT NULL,
  `shopAtive` tinyint(4) NOT NULL DEFAULT '1',
  `shopFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`shopId`),
  KEY `areaId1` (`areaId2`) USING BTREE,
  KEY `shopStatus` (`shopStatus`,`shopFlag`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_shops
-- ----------------------------
INSERT INTO `wst_shops` VALUES ('4', '00002', '9', '440000', '440100', '440106', '47', null, null, '1', '广东广州店铺', '广东广州店铺', 'Upload/shops/2015-05/554c1f72a4480.png', '', '广东广州店铺', '20', '0', '0', '10', '0', '', '0', '17', '6222023602094008497', '1', '开错无补', '8.0', '20.0', '1', null, '1', '1', '2015-05-19 23:28:06');
INSERT INTO `wst_shops` VALUES ('5', '00006', '10', '440000', '440300', '440301', '48', null, null, '1', '广东深圳店铺', '广东深圳店铺', 'Upload/shops/2015-05/554c208b77447.png', '', '广东深圳店铺', '0', '0', '0', '0', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '0.0', '1', null, '1', '1', '2015-05-12 21:22:37');
INSERT INTO `wst_shops` VALUES ('6', '00005', '11', '440000', '440400', '440401', '49', null, null, '0', '广东珠海店铺', '广东珠海店铺', 'Upload/shops/2015-05/554c20d9578f2.png', '', '广东珠海店铺', '0', '0', '0', '0', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '0.0', '1', null, '1', '1', '2015-05-12 21:22:14');
INSERT INTO `wst_shops` VALUES ('7', '00004', '12', '440000', '440500', '440501', '50', null, null, '0', '广东汕头店铺', '广东汕头店铺', 'Upload/shops/2015-05/554c21314a3ab.png', '', '广东汕头店铺', '0', '0', '0', '0', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '0.0', '1', null, '1', '1', '2015-05-12 21:21:49');
INSERT INTO `wst_shops` VALUES ('8', '00003', '13', '440000', '440200', '440201', '51', null, null, '1', '广东韶关店铺', '广东韶关店铺', 'Upload/shops/2015-05/554c21985e65a.png', '', '广东韶关店铺', '0', '0', '0', '0', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '0.0', '1', null, '1', '1', '2015-05-12 21:21:09');
INSERT INTO `wst_shops` VALUES ('9', '00001', '14', '440000', '440600', '440601', '52', null, null, '1', '广东佛山店铺', '广东佛山店铺', 'Upload/shops/2015-05/554c21df265f1.png', '15918671994', '广东佛山店铺', '20', '0', '0', '10', '0', '', '0', '17', '6222023602094008497', '0', '', '8.0', '20.0', '1', null, '1', '1', '2015-05-12 22:03:39');
INSERT INTO `wst_shops` VALUES ('10', 'S0001', '15', '440000', '440100', '440106', '47', null, null, '0', '测试店铺', '测试公司', 'Upload/shops/2015-05/554f70160cd3a_thumb.png', '', '广东省广州市天河区龙口东路', '50', '0', '0', '0', '0', '', '0', '17', '5212023122016330670', '1', '请注明发票抬头，可开具各种类型发票', '8.0', '20.0', '1', null, '0', '1', '2015-05-10 22:52:52');
INSERT INTO `wst_shops` VALUES ('11', '10001', '16', '440000', '440100', '440106', '47', null, null, '0', '测试店铺1', '广州晴暖信息科技有限公司', 'Upload/shops/2015-05/55520afe5a5f6.png', '', '广东省广州市天河区', '0', '0', '0', '0', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '0.0', '1', null, '1', '1', '2015-05-26 16:32:26');
INSERT INTO `wst_shops` VALUES ('12', '10002', '17', '440000', '440100', '440106', '47', null, null, '0', '测试店铺2', '广州晴暖信息有限公司', 'Upload/shops/2015-05/55520bac225be_thumb.png', '', '广东省广州市天河区', '41', '0', '2', '2', '0', '', '0', '17', '6222023602094008497', '0', '', '8.0', '20.0', '1', null, '1', '1', '2015-05-12 22:35:10');
INSERT INTO `wst_shops` VALUES ('13', '10003', '18', '440000', '440100', '440105', '47', null, null, '0', '测试店铺3', '测试店铺3', 'Upload/shops/2015-05/55520f278cc93_thumb.png', '', '广东省广州市海珠区', '45', '0', '2', '8', '0', '', '0', '17', '6222023602094008497', '0', '', '8.0', '20.0', '1', null, '1', '1', '2015-05-12 22:34:57');
INSERT INTO `wst_shops` VALUES ('14', '20004', '19', '440000', '440100', '440111', '48', null, null, '0', '测试店铺21', '测试店铺21', 'Upload/shops/2015-05/5552f7f735905.png', '15918671994', '广东省广州市白云区', '0', '0', '0', '0', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '0.0', '1', null, '1', '1', '2015-05-27 00:45:31');
INSERT INTO `wst_shops` VALUES ('15', '20003', '20', '440000', '440100', '440111', '48', null, null, '0', '测试店铺22', '测试店铺22', 'Upload/shops/2015-05/5552f8351f762.png', '', '广东省广州市白云区', '0', '0', '0', '0', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '0.0', '1', null, '1', '1', '2015-05-13 17:35:55');
INSERT INTO `wst_shops` VALUES ('16', '20002', '21', '440000', '440100', '440111', '48', null, null, '0', '测试店铺23', '测试店铺23', 'Upload/shops/2015-05/5552f87d9651a.png', '', '广东省广州市白云区', '0', '0', '0', '0', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '0.0', '1', null, '1', '1', '2015-05-13 16:59:29');
INSERT INTO `wst_shops` VALUES ('17', '20001', '22', '440000', '440100', '440111', '48', null, null, '0', '测试店铺24', '测试店铺24', 'Upload/shops/2015-05/5552f8c6de2e7.png', '', '广东省广州市白云区', '0', '0', '0', '0', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '0.0', '1', null, '1', '1', '2015-05-13 16:59:03');
INSERT INTO `wst_shops` VALUES ('18', '234978', '24', '440000', '440100', '440106', '49', null, null, '0', '测试店铺31', '测试店铺31', 'Upload/shops/2015-05/55646f83c80eb.png', '15918671994', '广东省广州市天河区', '45', '0', '5', '20', '0', '', '0', '17', '6222023602094008497', '0', '', '9.0', '23.0', '1', '', '1', '1', '2015-05-26 21:06:03');
INSERT INTO `wst_shops` VALUES ('19', '23498', '25', '440000', '440100', '440106', '49', null, null, '0', '测试店铺32', '测试店铺32', 'Upload/shops/2015-05/55647005331e6.png', '15918671994', '广东省广州市天河区', '47', '0', '0', '30', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '0.0', '1', '', '1', '1', '2015-05-26 21:08:13');
INSERT INTO `wst_shops` VALUES ('20', '3249', '26', '440000', '440100', '440106', '49', null, null, '0', '测试店铺33', '测试店铺33', 'Upload/shops/2015-05/5564709e3dc3d.png', '15918671994', '广东省广州市天河区', '34', '0', '5', '32', '0', '', '0', '17', '6222023602094008497', '0', '', '6.0', '17.0', '1', '', '1', '1', '2015-05-26 21:09:53');
INSERT INTO `wst_shops` VALUES ('21', '324982', '27', '440000', '440100', '440106', '49', null, null, '0', '测试店铺34', '测试店铺34', 'Upload/shops/2015-05/556470c441fff.png', '15918671994', '广东省广州市天河区', '50', '0', '5', '45', '0', '', '0', '17', '6222023602094008497', '0', '', '7.0', '21.0', '1', '', '1', '1', '2015-05-26 21:11:23');
INSERT INTO `wst_shops` VALUES ('22', '234823', '28', '440000', '440100', '440106', '50', null, null, '0', '测试店铺41', '测试店铺41', 'Upload/shops/2015-05/5564715db78ba.png', '15918671994', '广东省广州市天河区', '65', '0', '5', '40', '0', '', '0', '17', '6222023602094008497', '0', '', '9.0', '22.0', '1', '', '1', '1', '2015-05-26 21:14:00');
INSERT INTO `wst_shops` VALUES ('23', '234978', '29', '440000', '440100', '440106', '50', null, null, '0', '测试店铺42', '测试店铺42', 'Upload/shops/2015-05/556472c50ae1a.png', '15918671994', '广东省广州市天河区', '45', '0', '5', '54', '0', '', '0', '17', '6222023602094008497', '0', '', '9.0', '23.0', '1', '', '1', '1', '2015-05-26 21:20:27');
INSERT INTO `wst_shops` VALUES ('24', '23423', '30', '440000', '440100', '440106', '50', null, null, '0', '测试店铺43', '测试店铺43', 'Upload/shops/2015-05/55647356b697b.png', '15918671994', '广东省广州市天河区', '80', '0', '8', '80', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '0.0', '1', '', '1', '1', '2015-05-26 21:22:06');
INSERT INTO `wst_shops` VALUES ('25', '234798', '31', '440000', '440100', '440106', '50', null, null, '0', '测试店铺44', '测试店铺44', 'Upload/shops/2015-05/556473da51f49.png', '15918671994', '广东省广州市天河区', '45', '0', '5', '50', '0', '', '0', '17', '6222023602094008497', '0', '', '10.0', '21.0', '1', '', '1', '1', '2015-05-26 21:24:36');
INSERT INTO `wst_shops` VALUES ('26', '23489723', '32', '440000', '440100', '440106', '51', null, null, '0', '测试店铺51', '测试店铺51', 'Upload/shops/2015-05/5564752741943.png', '15918671994', '广东省广州市天河区', '34', '0', '4', '30', '0', '', '0', '17', '6222023602094008497', '0', '', '9.0', '17.0', '1', '', '1', '1', '2015-05-26 21:30:17');
INSERT INTO `wst_shops` VALUES ('27', '2189', '33', '440000', '440100', '440106', '51', null, null, '0', '测试店铺52', '测试店铺52', 'Upload/shops/2015-05/556475978d54c.png', '15918671994', '广东省广州市天河区', '67', '0', '6', '50', '0', '', '0', '17', '6222023602094008497', '0', '', '10.0', '22.0', '1', '', '1', '1', '2015-05-26 21:32:01');
INSERT INTO `wst_shops` VALUES ('28', '249823', '34', '440000', '440100', '440106', '51', null, null, '0', '测试店铺53', '测试店铺53', 'Upload/shops/2015-05/556475f979416.png', '15918671994', '广东省广州市天河区', '45', '0', '3', '45', '0', '', '0', '17', '6222023602094008497', '0', '', '0.0', '22.0', '1', '', '1', '1', '2015-05-26 21:33:27');
INSERT INTO `wst_shops` VALUES ('29', '23489', '35', '440000', '440100', '440106', '51', null, null, '0', '测试店铺54', '测试店铺54', 'Upload/shops/2015-05/5564777f510ac.png', '15918671994', '广东省广州市天河区', '35', '0', '3', '30', '0', '', '0', '17', '6222023602094008497', '0', '', '7.0', '22.0', '1', '', '1', '1', '2015-05-26 21:40:20');
INSERT INTO `wst_shops` VALUES ('30', '23499', '36', '440000', '440100', '440106', '52', null, null, '0', '测试店铺61', '测试店铺61', 'Upload/shops/2015-05/5564782d1b224.png', '15918671994', '广东省广州市天河区', '24', '0', '4', '12', '0', '', '0', '17', '6222023602094008497', '0', '', '4.0', '23.0', '1', '', '1', '1', '2015-05-26 21:42:59');
INSERT INTO `wst_shops` VALUES ('31', '23497832', '37', '440000', '440100', '440106', '52', null, null, '0', '测试店铺62', '测试店铺62', 'Upload/shops/2015-05/556478c4abcd8.png', '15918671994', '广东省广州市天河区', '32', '0', '10', '65', '0', '', '0', '17', '6222023602094008497', '0', '', '7.0', '21.0', '1', '', '1', '1', '2015-05-26 21:45:22');
INSERT INTO `wst_shops` VALUES ('32', '34789', '38', '440000', '440100', '440106', '52', null, null, '0', '测试店铺63', '测试店铺63', 'Upload/shops/2015-05/5564791d7cf5f.png', '15918671994', '广东省广州市天河区', '70', '0', '6', '78', '0', '', '0', '17', '6222023602094008497', '0', '', '9.0', '22.0', '1', '', '1', '1', '2015-05-26 21:47:10');
INSERT INTO `wst_shops` VALUES ('33', '234897', '39', '440000', '440100', '440106', '52', null, null, '0', '测试店铺64', '测试店铺64', 'Upload/shops/2015-05/5564797444510.png', '15918671994', '广东省广州市天河区', '45', '0', '4', '40', '0', '', '0', '17', '6222023602094008497', '0', '', '12.0', '23.0', '1', '', '1', '1', '2015-05-26 21:48:43');

-- ----------------------------
-- Table structure for `wst_shop_configs`
-- ----------------------------
DROP TABLE IF EXISTS `wst_shop_configs`;
CREATE TABLE `wst_shop_configs` (
  `configId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) DEFAULT NULL,
  `shopTitle` varchar(255) DEFAULT NULL,
  `shopKeywords` varchar(255) DEFAULT NULL,
  `shopDesc` varchar(255) DEFAULT NULL,
  `shopBanner` varchar(150) DEFAULT NULL,
  `shopAds` text,
  `shopAdsUrl` text,
  PRIMARY KEY (`configId`),
  KEY `shopId` (`shopId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_shop_configs
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_roles`
-- ----------------------------
DROP TABLE IF EXISTS `wst_roles`;
CREATE TABLE `wst_roles` (
  `roleId` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(30) NOT NULL,
  `grant` text,
  `createTime` datetime NOT NULL,
  `roleFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`roleId`),
  KEY `roleFlag` (`roleFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_roles
-- ----------------------------
INSERT INTO `wst_roles` VALUES ('1', '商品管理员', 'spfl_00,spfl_01,spfl_02,spfl_03,ppgl_00,ppgl_01,ppgl_02,ppgl_03,splb_00,splb_04,splb_03,spsh_00,spsh_04,spsh_03,sppl_00,sppl_04,sppl_03', '2014-11-02 12:07:12', '1');
INSERT INTO `wst_roles` VALUES ('2', '门店管理员', 'dplb_00,dplb_01,dplb_02,dplb_03,dpsh_00,dpsh_04,dpsh_03', '2014-11-02 12:09:05', '1');
INSERT INTO `wst_roles` VALUES ('3', '系统管理员', 'spgl_00,spfl_00,spfl_01,spfl_02,spfl_03,ppgl_00,ppgl_01,ppgl_02,ppgl_03,splb_00,splb_04,spsh_00,spsh_04,sppl_00,sppl_04,sppl_03,ddgl_00,ddlb_00,tk_00,tk_04,dpgl_00,dplb_00,dplb_01,dplb_02,dplb_03,dpsh_00,dqgl_00,dqlb_00,dqlb_01,dqlb_02,dqlb_03,sqlb_00,sqlb_01,sqlb_02,sqlb_03,wzgl_00,wzlb_00,wzlb_01,wzlb_02,wzlb_03,wzfl_00,wzfl_01,wzfl_02,wzfl_03,hygl_00,hydj_00,hydj_01,hydj_02,hydj_03,hylb_00,hylb_01,hylb_02,hylb_03,hyzh_00,hyzh_04,xtgl_00,jsgl_00,jsgl_01,jsgl_02,jsgl_03,zylb_00,zylb_01,zylb_02,zylb_03,dlrz_00,scsz_00,scxx_00,scxx_02,dhgl_00,dhgl_01,dhgl_02,dhgl_03,yqlj_00,yqlj_01,yqlj_02,yqlj_03,gggl_00,gggl_01,gggl_02,gggl_03,yhgl_00,yhgl_01,yhgl_02,yhgl_03,zfgl_00,zfgl_01,zfgl_02,zfgl_03', '2014-11-02 12:09:09', '1');
INSERT INTO `wst_roles` VALUES ('4', '客服', 'sppl_00,sppl_04,sppl_03', '2014-12-20 00:08:53', '1');

-- ----------------------------
-- Table structure for `wst_payments`
-- ----------------------------
DROP TABLE IF EXISTS `wst_payments`;
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

-- ----------------------------
-- Records of wst_payments
-- ----------------------------
INSERT INTO `wst_payments` VALUES ('1', 'cod', '货到付款', '开通城市', '1', '', '1', '0');
INSERT INTO `wst_payments` VALUES ('2', 'alipay', '支付宝', '', '2', '', '0', '1');

-- ----------------------------
-- Table structure for `wst_orders`
-- ----------------------------
DROP TABLE IF EXISTS `wst_orders`;
CREATE TABLE `wst_orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(20) NOT NULL,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `areaId3` int(11) NOT NULL,
  `shopId` int(11) NOT NULL,
  `orderStatus` tinyint(4) NOT NULL DEFAULT '-2',
  `totalMoney` float(11,1) NOT NULL,
  `deliverMoney` float(11,1) NOT NULL,
  `payType` tinyint(4) NOT NULL DEFAULT '0',
  `isSelf` tinyint(4) NOT NULL DEFAULT '0',
  `isPay` tinyint(4) NOT NULL DEFAULT '0',
  `deliverType` tinyint(4) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `communityId` int(11) NOT NULL,
  `userAddress` varchar(255) NOT NULL,
  `userTel` varchar(20) DEFAULT NULL,
  `userPhone` char(11) DEFAULT NULL,
  `userPostCode` char(6) NOT NULL,
  `orderScore` int(11) NOT NULL DEFAULT '0',
  `isInvoice` tinyint(4) NOT NULL DEFAULT '0',
  `invoiceClient` varchar(255) DEFAULT NULL,
  `orderRemarks` varchar(255) DEFAULT NULL,
  `requireTime` datetime NOT NULL,
  `isAppraises` tinyint(4) NOT NULL DEFAULT '0',
  `createTime` datetime NOT NULL,
  `isClosed` tinyint(4) NOT NULL DEFAULT '0',
  `isRefund` tinyint(4) NOT NULL DEFAULT '0',
  `refundRemark` varchar(255) DEFAULT NULL,
  `orderunique` varchar(20) NOT NULL,
  `orderSrc` tinyint(4) NOT NULL DEFAULT '0',
  `orderFlag` tinyint(4) NOT NULL DEFAULT '1',
  `needpay` float(11,1) DEFAULT '0.0',
  PRIMARY KEY (`orderId`),
  KEY `shopId` (`shopId`,`orderFlag`),
  KEY `userId` (`userId`,`orderFlag`),
  KEY `isRefund` (`isRefund`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_orders
-- ----------------------------
INSERT INTO `wst_orders` VALUES ('1', '11', '440000', '440100', '440106', '4', '-2', '108.0', '0.0', '1', '1', '0', '0', '9', '马生', '15', '红花岗', '020-46787622', null, '512000', '108', '0', '', '111', '2015-05-21 00:00:00', '0', '2015-05-19 23:29:11', '0', '0', null, '1432049292155', '0', '1', '0.0');
INSERT INTO `wst_orders` VALUES ('2', '22', '440000', '440100', '440106', '4', '-4', '36.0', '0.0', '0', '0', '0', '0', '9', '马生', '15', '红花岗', '020-46787622', null, '512000', '36', '1', '江门移动', '757', '2015-05-20 04:00:00', '0', '2015-05-19 23:35:48', '0', '0', null, '1432049687902', '0', '1', '0.0');
INSERT INTO `wst_orders` VALUES ('3', '33', '440000', '440100', '440106', '4', '0', '144.0', '0.0', '0', '0', '0', '0', '9', '马生', '15', '红花岗', '020-46787622', null, '512000', '144', '0', '', '', '2015-05-24 17:00:00', '0', '2015-05-24 15:59:46', '0', '0', null, '1432454386374', '0', '1', '0.0');

-- ----------------------------
-- Table structure for `wst_orderids`
-- ----------------------------
DROP TABLE IF EXISTS `wst_orderids`;
CREATE TABLE `wst_orderids` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `rnd` float(16,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_orderids
-- ----------------------------
INSERT INTO `wst_orderids` VALUES ('100000000', '356590.00');

-- ----------------------------
-- Table structure for `wst_order_reminds`
-- ----------------------------
DROP TABLE IF EXISTS `wst_order_reminds`;
CREATE TABLE `wst_order_reminds` (
  `remindId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `shopId` int(11) NOT NULL,
  `remindType` tinyint(4) NOT NULL DEFAULT '0',
  `userType` tinyint(4) NOT NULL DEFAULT '0',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`remindId`),
  KEY `shopId` (`shopId`,`remindType`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_order_reminds
-- ----------------------------
INSERT INTO `wst_order_reminds` VALUES ('1', '2', '9', '4', '0', '0', '2015-05-19 23:35:49');
INSERT INTO `wst_order_reminds` VALUES ('2', '3', '9', '4', '0', '0', '2015-05-24 15:59:46');

-- ----------------------------
-- Table structure for `wst_order_goods`
-- ----------------------------
DROP TABLE IF EXISTS `wst_order_goods`;
CREATE TABLE `wst_order_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `goodsId` int(11) NOT NULL,
  `goodsNums` int(11) NOT NULL DEFAULT '0',
  `goodsPrice` float(11,1) NOT NULL DEFAULT '0.0',
  `goodsAttrId` int(11) DEFAULT '0',
  `goodsAttrName` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `goodsId` (`goodsId`),
  KEY `orderId` (`orderId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_order_goods
-- ----------------------------
INSERT INTO `wst_order_goods` VALUES ('1', '1', '3', '3', '36.0', '0', '');
INSERT INTO `wst_order_goods` VALUES ('2', '2', '3', '1', '36.0', '0', '');
INSERT INTO `wst_order_goods` VALUES ('3', '3', '3', '1', '36.0', '0', '');
INSERT INTO `wst_order_goods` VALUES ('4', '3', '2', '3', '36.0', '0', '');

-- ----------------------------
-- Table structure for `wst_navs`
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_navs
-- ----------------------------
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

-- ----------------------------
-- Table structure for `wst_messages`
-- ----------------------------
DROP TABLE IF EXISTS `wst_messages`;
CREATE TABLE `wst_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msgType` tinyint(4) DEFAULT '0',
  `sendUserId` int(11) DEFAULT NULL,
  `receiveUserId` int(11) DEFAULT NULL,
  `msgContent` text,
  `createTime` datetime DEFAULT NULL,
  `msgStatus` tinyint(4) DEFAULT '0',
  `msgFlag` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `receiveUserId` (`receiveUserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_messages
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_log_user_logins`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_user_logins`;
CREATE TABLE `wst_log_user_logins` (
  `loginId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `loginTime` datetime NOT NULL,
  `loginIp` varchar(16) NOT NULL,
  `loginSrc` tinyint(3) unsigned DEFAULT '0' COMMENT '0:商城  1:webapp  2:App',
  `loginRemark` varchar(30) DEFAULT NULL COMMENT '登录备注信息',
  PRIMARY KEY (`loginId`),
  KEY `loginTime` (`loginTime`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_user_logins
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_log_staff_logins`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_staff_logins`;
CREATE TABLE `wst_log_staff_logins` (
  `loginId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `loginTime` datetime NOT NULL,
  `loginIp` varchar(16) NOT NULL,
  PRIMARY KEY (`loginId`),
  KEY `loginTime` (`loginTime`),
  KEY `staffId` (`staffId`)
) ENGINE=MyISAM AUTO_INCREMENT=180 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_staff_logins
-- ----------------------------
INSERT INTO `wst_log_staff_logins` VALUES ('178', '1', '2015-06-02 22:50:57', '127.0.0.1');
INSERT INTO `wst_log_staff_logins` VALUES ('179', '1', '2015-06-04 22:37:16', '127.0.0.1');

-- ----------------------------
-- Table structure for `wst_log_sms`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_sms`;
CREATE TABLE `wst_log_sms` (
  `smsId` int(11) NOT NULL AUTO_INCREMENT,
  `smsSrc` tinyint(4) DEFAULT '0',
  `smsUserId` int(11) DEFAULT '0',
  `smsContent` varchar(255) DEFAULT NULL,
  `smsPhoneNumber` varchar(11) DEFAULT NULL,
  `smsReturnCode` varchar(255) DEFAULT NULL,
  `smsFunc` varchar(50) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  PRIMARY KEY (`smsId`),
  KEY `logSrcType` (`smsSrc`,`smsPhoneNumber`),
  KEY `createTime` (`createTime`),
  KEY `logFunc` (`smsFunc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_sms
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_log_orders`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_orders`;
CREATE TABLE `wst_log_orders` (
  `logId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `logContent` varchar(255) NOT NULL,
  `logUserId` int(11) NOT NULL,
  `logType` tinyint(4) NOT NULL DEFAULT '0',
  `logTime` datetime NOT NULL,
  PRIMARY KEY (`logId`),
  KEY `orderId` (`orderId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_orders
-- ----------------------------
INSERT INTO `wst_log_orders` VALUES ('1', '2', '下单成功', '9', '0', '2015-05-19 23:35:49');
INSERT INTO `wst_log_orders` VALUES ('2', '2', '商家已受理订单', '9', '0', '2015-05-19 23:40:20');
INSERT INTO `wst_log_orders` VALUES ('3', '2', '订单打包中', '9', '0', '2015-05-19 23:41:11');
INSERT INTO `wst_log_orders` VALUES ('4', '2', '商家已发货', '9', '0', '2015-05-19 23:41:49');
INSERT INTO `wst_log_orders` VALUES ('5', '2', '用户已收货', '9', '0', '2015-05-19 23:42:31');
INSERT INTO `wst_log_orders` VALUES ('6', '2', '用户已收货', '9', '0', '2015-05-19 23:42:39');
INSERT INTO `wst_log_orders` VALUES ('7', '2', '用户已收货', '9', '0', '2015-05-19 23:59:42');
INSERT INTO `wst_log_orders` VALUES ('8', '2', '用户已收货', '9', '0', '2015-05-19 23:59:50');
INSERT INTO `wst_log_orders` VALUES ('9', '2', '用户拒收', '9', '0', '2015-05-19 23:59:57');
INSERT INTO `wst_log_orders` VALUES ('10', '2', '商家确认拒收', '9', '0', '2015-05-20 00:09:38');
INSERT INTO `wst_log_orders` VALUES ('11', '3', '下单成功', '9', '0', '2015-05-24 15:59:46');

-- ----------------------------
-- Table structure for `wst_log_operates`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_operates`;
CREATE TABLE `wst_log_operates` (
  `operateId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `operateTime` datetime NOT NULL,
  `module` varchar(20) NOT NULL,
  `operateURI` varchar(150) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`operateId`),
  KEY `operateTime` (`operateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_operates
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_goods_scores`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_scores`;
CREATE TABLE `wst_goods_scores` (
  `scoreId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) DEFAULT NULL,
  `shopId` int(11) DEFAULT NULL,
  `totalScore` int(11) DEFAULT '0',
  `totalUsers` int(11) DEFAULT '0',
  `goodsScore` int(11) DEFAULT '0',
  `goodsUsers` int(11) DEFAULT '0',
  `serviceScore` int(11) DEFAULT '0',
  `serviceUsers` int(11) DEFAULT '0',
  `timeScore` int(11) DEFAULT '0',
  `timeUsers` int(11) DEFAULT '0',
  PRIMARY KEY (`scoreId`),
  KEY `goodsId` (`goodsId`,`shopId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_scores
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_goods_relateds`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_relateds`;
CREATE TABLE `wst_goods_relateds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) NOT NULL,
  `relatedGoodsId` int(11) NOT NULL,
  `relatedType` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_relateds
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_goods_gallerys`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_gallerys`;
CREATE TABLE `wst_goods_gallerys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) NOT NULL,
  `shopId` int(11) NOT NULL,
  `goodsImg` varchar(150) NOT NULL,
  `goodsThumbs` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goodsId` (`goodsId`,`shopId`)
) ENGINE=MyISAM AUTO_INCREMENT=494 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_gallerys
-- ----------------------------
INSERT INTO `wst_goods_gallerys` VALUES ('2', '3', '4', 'Upload/goods/2015-05/554c2c1e38e03.jpg', 'Upload/goods/2015-05/554c2c1e38e03_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('3', '3', '4', 'Upload/goods/2015-05/554c2c2540bbb.png', 'Upload/goods/2015-05/554c2c2540bbb_thumb.png');
INSERT INTO `wst_goods_gallerys` VALUES ('13', '5', '4', 'Upload/goods/2015-05/5563efa072081.jpg', 'Upload/goods/2015-05/5563efa072081_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('14', '5', '4', 'Upload/goods/2015-05/5563efa276070.jpg', 'Upload/goods/2015-05/5563efa276070_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('15', '5', '4', 'Upload/goods/2015-05/5563efa4ac19d.jpg', 'Upload/goods/2015-05/5563efa4ac19d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('19', '6', '4', 'Upload/goods/2015-05/5563f37817542.jpg', 'Upload/goods/2015-05/5563f37817542_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('20', '6', '4', 'Upload/goods/2015-05/5563f37b1eae7.jpg', 'Upload/goods/2015-05/5563f37b1eae7_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('21', '6', '4', 'Upload/goods/2015-05/5563f37d002c8.jpg', 'Upload/goods/2015-05/5563f37d002c8_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('23', '7', '4', 'Upload/goods/2015-05/55641f418a6b3.jpg', 'Upload/goods/2015-05/55641f418a6b3_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('27', '9', '4', 'Upload/goods/2015-05/556422319d52f.jpg', 'Upload/goods/2015-05/556422319d52f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('28', '9', '4', 'Upload/goods/2015-05/55642233c3f63.jpg', 'Upload/goods/2015-05/55642233c3f63_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('29', '9', '4', 'Upload/goods/2015-05/556422354e819.jpg', 'Upload/goods/2015-05/556422354e819_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('30', '10', '4', 'Upload/goods/2015-05/5564263dac034.jpg', 'Upload/goods/2015-05/5564263dac034_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('31', '10', '4', 'Upload/goods/2015-05/5564263f3219a.jpg', 'Upload/goods/2015-05/5564263f3219a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('32', '10', '4', 'Upload/goods/2015-05/556426409f4c6.jpg', 'Upload/goods/2015-05/556426409f4c6_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('33', '8', '4', 'Upload/goods/2015-05/55642c550d196.jpg', 'Upload/goods/2015-05/55642c550d196_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('34', '8', '4', 'Upload/goods/2015-05/55642c576be16.jpg', 'Upload/goods/2015-05/55642c576be16_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('37', '11', '11', 'Upload/goods/2015-05/55643432c0801.jpg', 'Upload/goods/2015-05/55643432c0801_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('40', '28', '14', 'Upload/goods/2015-05/556480ebada5f.jpg', 'Upload/goods/2015-05/556480ebada5f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('41', '29', '14', 'Upload/goods/2015-05/5564818cc1764.jpg', 'Upload/goods/2015-05/5564818cc1764_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('42', '31', '14', 'Upload/goods/2015-05/556485bb85d2a.jpg', 'Upload/goods/2015-05/556485bb85d2a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('43', '31', '14', 'Upload/goods/2015-05/556485c430771.jpg', 'Upload/goods/2015-05/556485c430771_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('44', '31', '14', 'Upload/goods/2015-05/556485c9b20d9.jpg', 'Upload/goods/2015-05/556485c9b20d9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('45', '31', '14', 'Upload/goods/2015-05/556485ca618d0.jpg', 'Upload/goods/2015-05/556485ca618d0_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('46', '33', '14', 'Upload/goods/2015-05/55648deaa0eea.jpg', 'Upload/goods/2015-05/55648deaa0eea_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('47', '33', '14', 'Upload/goods/2015-05/55648deb4aefd.jpg', 'Upload/goods/2015-05/55648deb4aefd_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('48', '34', '14', 'Upload/goods/2015-05/55648f45afaab.jpg', 'Upload/goods/2015-05/55648f45afaab_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('49', '34', '14', 'Upload/goods/2015-05/55648f465cb3b.jpg', 'Upload/goods/2015-05/55648f465cb3b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('50', '35', '14', 'Upload/goods/2015-05/5564902e457a6.jpg', 'Upload/goods/2015-05/5564902e457a6_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('51', '36', '14', 'Upload/goods/2015-05/55649c8a61b2d.jpg', 'Upload/goods/2015-05/55649c8a61b2d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('52', '36', '14', 'Upload/goods/2015-05/55649c8acf2e4.jpg', 'Upload/goods/2015-05/55649c8acf2e4_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('53', '37', '14', 'Upload/goods/2015-05/55649d5712e62.jpg', 'Upload/goods/2015-05/55649d5712e62_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('54', '37', '14', 'Upload/goods/2015-05/55649d57b7506.jpg', 'Upload/goods/2015-05/55649d57b7506_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('55', '37', '14', 'Upload/goods/2015-05/55649d5841b02.jpg', 'Upload/goods/2015-05/55649d5841b02_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('56', '38', '14', 'Upload/goods/2015-05/55649dd083973.jpg', 'Upload/goods/2015-05/55649dd083973_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('59', '39', '14', 'Upload/goods/2015-05/55649f52d28e1.jpg', 'Upload/goods/2015-05/55649f52d28e1_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('60', '42', '14', 'Upload/goods/2015-05/5564a2a43c7de.jpg', 'Upload/goods/2015-05/5564a2a43c7de_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('61', '42', '14', 'Upload/goods/2015-05/5564a2a4e7d31.jpg', 'Upload/goods/2015-05/5564a2a4e7d31_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('67', '2', '4', 'Upload/goods/2015-05/55641879b274d.jpg', 'Upload/goods/2015-05/55641879b274d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('72', '43', '18', 'Upload/goods/2015-05/55652a0bbc2b6.jpg', 'Upload/goods/2015-05/55652a0bbc2b6_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('73', '43', '18', 'Upload/goods/2015-05/55652a0c366cf.jpg', 'Upload/goods/2015-05/55652a0c366cf_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('74', '43', '18', 'Upload/goods/2015-05/55652a0fa8e82.jpg', 'Upload/goods/2015-05/55652a0fa8e82_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('75', '43', '18', 'Upload/goods/2015-05/55652a10638f5.jpg', 'Upload/goods/2015-05/55652a10638f5_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('82', '44', '18', 'Upload/goods/2015-05/55652c2275a6d.jpg', 'Upload/goods/2015-05/55652c2275a6d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('83', '44', '18', 'Upload/goods/2015-05/55652c230aa1e.jpg', 'Upload/goods/2015-05/55652c230aa1e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('84', '44', '18', 'Upload/goods/2015-05/55652c23d560e.jpg', 'Upload/goods/2015-05/55652c23d560e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('85', '44', '18', 'Upload/goods/2015-05/55652c6d8b2b2.jpg', 'Upload/goods/2015-05/55652c6d8b2b2_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('86', '45', '4', 'Upload/goods/2015-05/55652cf5f2bc4.jpg', 'Upload/goods/2015-05/55652cf5f2bc4_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('87', '45', '4', 'Upload/goods/2015-05/55652cfbcac39.jpg', 'Upload/goods/2015-05/55652cfbcac39_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('88', '46', '18', 'Upload/goods/2015-05/55652d0aa8261.jpg', 'Upload/goods/2015-05/55652d0aa8261_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('89', '46', '18', 'Upload/goods/2015-05/55652d0c2540d.jpg', 'Upload/goods/2015-05/55652d0c2540d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('90', '46', '18', 'Upload/goods/2015-05/55652d0d1942b.jpg', 'Upload/goods/2015-05/55652d0d1942b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('91', '46', '18', 'Upload/goods/2015-05/55652d0dccb37.jpg', 'Upload/goods/2015-05/55652d0dccb37_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('100', '48', '18', 'Upload/goods/2015-05/55652e15c9bd1.jpg', 'Upload/goods/2015-05/55652e15c9bd1_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('101', '48', '18', 'Upload/goods/2015-05/55652e167dd1a.jpg', 'Upload/goods/2015-05/55652e167dd1a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('102', '48', '18', 'Upload/goods/2015-05/55652e17bd752.jpg', 'Upload/goods/2015-05/55652e17bd752_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('103', '48', '18', 'Upload/goods/2015-05/55652e1871e2f.jpg', 'Upload/goods/2015-05/55652e1871e2f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('108', '47', '18', 'Upload/goods/2015-05/55652dbb59d31.jpg', 'Upload/goods/2015-05/55652dbb59d31_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('109', '47', '18', 'Upload/goods/2015-05/55652dbcedd46.jpg', 'Upload/goods/2015-05/55652dbcedd46_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('110', '47', '18', 'Upload/goods/2015-05/55652dbe36f6e.jpg', 'Upload/goods/2015-05/55652dbe36f6e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('111', '47', '18', 'Upload/goods/2015-05/55652dbf07c24.jpg', 'Upload/goods/2015-05/55652dbf07c24_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('118', '49', '18', 'Upload/goods/2015-05/55653130c3042.jpg', 'Upload/goods/2015-05/55653130c3042_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('119', '49', '18', 'Upload/goods/2015-05/556531316c331.jpg', 'Upload/goods/2015-05/556531316c331_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('120', '49', '18', 'Upload/goods/2015-05/556531324e849.jpg', 'Upload/goods/2015-05/556531324e849_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('121', '49', '18', 'Upload/goods/2015-05/5565313306019.jpg', 'Upload/goods/2015-05/5565313306019_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('122', '49', '18', 'Upload/goods/2015-05/55653133a3249.jpg', 'Upload/goods/2015-05/55653133a3249_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('123', '49', '18', 'Upload/goods/2015-05/55653134402c2.jpg', 'Upload/goods/2015-05/55653134402c2_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('124', '50', '18', 'Upload/goods/2015-05/5565336e3a061.jpg', 'Upload/goods/2015-05/5565336e3a061_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('125', '50', '18', 'Upload/goods/2015-05/5565336f6535c.jpg', 'Upload/goods/2015-05/5565336f6535c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('126', '50', '18', 'Upload/goods/2015-05/5565337041019.jpg', 'Upload/goods/2015-05/5565337041019_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('127', '50', '18', 'Upload/goods/2015-05/55653370bb676.jpg', 'Upload/goods/2015-05/55653370bb676_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('135', '51', '18', 'Upload/goods/2015-05/556535c9d4b87.jpg', 'Upload/goods/2015-05/556535c9d4b87_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('136', '51', '18', 'Upload/goods/2015-05/556535caa93e9.jpg', 'Upload/goods/2015-05/556535caa93e9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('137', '51', '18', 'Upload/goods/2015-05/556535cb5b943.jpg', 'Upload/goods/2015-05/556535cb5b943_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('138', '51', '18', 'Upload/goods/2015-05/556535cbeb7a1.jpg', 'Upload/goods/2015-05/556535cbeb7a1_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('139', '51', '18', 'Upload/goods/2015-05/556535cc824d0.jpg', 'Upload/goods/2015-05/556535cc824d0_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('140', '51', '18', 'Upload/goods/2015-05/556535cd2c10c.jpg', 'Upload/goods/2015-05/556535cd2c10c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('141', '51', '18', 'Upload/goods/2015-05/556535cdaacf8.jpg', 'Upload/goods/2015-05/556535cdaacf8_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('148', '52', '19', 'Upload/goods/2015-05/556539c691c99.jpg', 'Upload/goods/2015-05/556539c691c99_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('149', '52', '19', 'Upload/goods/2015-05/556539c76dae9.jpg', 'Upload/goods/2015-05/556539c76dae9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('150', '52', '19', 'Upload/goods/2015-05/556539c7bc42d.jpg', 'Upload/goods/2015-05/556539c7bc42d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('151', '53', '19', 'Upload/goods/2015-05/55653e2855992.jpg', 'Upload/goods/2015-05/55653e2855992_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('152', '53', '19', 'Upload/goods/2015-05/55653e2a721af.jpg', 'Upload/goods/2015-05/55653e2a721af_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('153', '54', '19', 'Upload/goods/2015-05/55653f29e309a.jpg', 'Upload/goods/2015-05/55653f29e309a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('154', '54', '19', 'Upload/goods/2015-05/55653f2be1acf.jpg', 'Upload/goods/2015-05/55653f2be1acf_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('155', '54', '19', 'Upload/goods/2015-05/55653f2cd61c9.jpg', 'Upload/goods/2015-05/55653f2cd61c9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('156', '55', '19', 'Upload/goods/2015-05/5565400c55b29.jpg', 'Upload/goods/2015-05/5565400c55b29_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('157', '56', '19', 'Upload/goods/2015-05/5565412f6e079.jpg', 'Upload/goods/2015-05/5565412f6e079_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('158', '56', '19', 'Upload/goods/2015-05/556541302cc71.jpg', 'Upload/goods/2015-05/556541302cc71_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('159', '57', '19', 'Upload/goods/2015-05/5565419cae8ac.jpg', 'Upload/goods/2015-05/5565419cae8ac_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('160', '58', '19', 'Upload/goods/2015-05/5565427b25647.jpg', 'Upload/goods/2015-05/5565427b25647_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('161', '58', '19', 'Upload/goods/2015-05/5565427bcbe85.jpg', 'Upload/goods/2015-05/5565427bcbe85_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('162', '59', '19', 'Upload/goods/2015-05/5565436d78c7e.jpg', 'Upload/goods/2015-05/5565436d78c7e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('163', '59', '19', 'Upload/goods/2015-05/5565436dc7ca3.jpg', 'Upload/goods/2015-05/5565436dc7ca3_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('164', '59', '19', 'Upload/goods/2015-05/5565436e2f373.jpg', 'Upload/goods/2015-05/5565436e2f373_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('165', '60', '22', 'Upload/goods/2015-05/55656f0dc8726.jpg', 'Upload/goods/2015-05/55656f0dc8726_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('166', '60', '22', 'Upload/goods/2015-05/55656f0e91f06.jpg', 'Upload/goods/2015-05/55656f0e91f06_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('167', '60', '22', 'Upload/goods/2015-05/55656f0fb24e3.jpg', 'Upload/goods/2015-05/55656f0fb24e3_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('168', '61', '22', 'Upload/goods/2015-05/5565701b5dce1.jpg', 'Upload/goods/2015-05/5565701b5dce1_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('169', '61', '22', 'Upload/goods/2015-05/5565701c3b880.jpg', 'Upload/goods/2015-05/5565701c3b880_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('170', '61', '22', 'Upload/goods/2015-05/5565701cc71e3.jpg', 'Upload/goods/2015-05/5565701cc71e3_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('171', '62', '22', 'Upload/goods/2015-05/556570f548f9e.jpg', 'Upload/goods/2015-05/556570f548f9e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('172', '62', '22', 'Upload/goods/2015-05/5565710c6ba89.jpg', 'Upload/goods/2015-05/5565710c6ba89_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('173', '62', '22', 'Upload/goods/2015-05/5565710d6ef1a.jpg', 'Upload/goods/2015-05/5565710d6ef1a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('174', '63', '22', 'Upload/goods/2015-05/556572b9f3346.jpg', 'Upload/goods/2015-05/556572b9f3346_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('175', '63', '22', 'Upload/goods/2015-05/556572bc4cf30.jpg', 'Upload/goods/2015-05/556572bc4cf30_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('176', '63', '22', 'Upload/goods/2015-05/556572bd29814.jpg', 'Upload/goods/2015-05/556572bd29814_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('177', '64', '22', 'Upload/goods/2015-05/556574c553f33.jpg', 'Upload/goods/2015-05/556574c553f33_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('178', '64', '22', 'Upload/goods/2015-05/556574c6510f3.png', 'Upload/goods/2015-05/556574c6510f3_thumb.png');
INSERT INTO `wst_goods_gallerys` VALUES ('179', '64', '22', 'Upload/goods/2015-05/556574c72ea85.png', 'Upload/goods/2015-05/556574c72ea85_thumb.png');
INSERT INTO `wst_goods_gallerys` VALUES ('180', '66', '22', 'Upload/goods/2015-05/5565776165013.jpg', 'Upload/goods/2015-05/5565776165013_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('181', '66', '22', 'Upload/goods/2015-05/556577623dc0e.png', 'Upload/goods/2015-05/556577623dc0e_thumb.png');
INSERT INTO `wst_goods_gallerys` VALUES ('182', '66', '22', 'Upload/goods/2015-05/55657762e7635.png', 'Upload/goods/2015-05/55657762e7635_thumb.png');
INSERT INTO `wst_goods_gallerys` VALUES ('183', '67', '22', 'Upload/goods/2015-05/556579f80240b.jpg', 'Upload/goods/2015-05/556579f80240b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('184', '67', '22', 'Upload/goods/2015-05/556579f87653a.jpg', 'Upload/goods/2015-05/556579f87653a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('185', '67', '22', 'Upload/goods/2015-05/556579f99ec2c.jpg', 'Upload/goods/2015-05/556579f99ec2c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('186', '68', '22', 'Upload/goods/2015-05/55657bb2cb473.jpg', 'Upload/goods/2015-05/55657bb2cb473_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('187', '68', '22', 'Upload/goods/2015-05/55657bb350127.jpg', 'Upload/goods/2015-05/55657bb350127_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('188', '69', '22', 'Upload/goods/2015-05/556589e6a109b.jpg', 'Upload/goods/2015-05/556589e6a109b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('189', '69', '22', 'Upload/goods/2015-05/556589e7742f9.jpg', 'Upload/goods/2015-05/556589e7742f9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('190', '70', '22', 'Upload/goods/2015-05/55658aaa2f68c.jpg', 'Upload/goods/2015-05/55658aaa2f68c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('191', '70', '22', 'Upload/goods/2015-05/55658aaaaaa10.jpg', 'Upload/goods/2015-05/55658aaaaaa10_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('192', '70', '22', 'Upload/goods/2015-05/55658aab0d505.jpg', 'Upload/goods/2015-05/55658aab0d505_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('193', '71', '22', 'Upload/goods/2015-05/55658bf10e3e1.jpg', 'Upload/goods/2015-05/55658bf10e3e1_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('194', '71', '22', 'Upload/goods/2015-05/55658bf1c2924.jpg', 'Upload/goods/2015-05/55658bf1c2924_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('195', '71', '22', 'Upload/goods/2015-05/55658bf287eaa.jpg', 'Upload/goods/2015-05/55658bf287eaa_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('196', '72', '22', 'Upload/goods/2015-05/55658c81af47f.jpg', 'Upload/goods/2015-05/55658c81af47f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('197', '72', '22', 'Upload/goods/2015-05/55658c82bbd0b.jpg', 'Upload/goods/2015-05/55658c82bbd0b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('198', '72', '22', 'Upload/goods/2015-05/55658c83f19ad.jpg', 'Upload/goods/2015-05/55658c83f19ad_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('202', '73', '26', 'Upload/goods/2015-05/5565c016aa36b.jpg', 'Upload/goods/2015-05/5565c016aa36b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('203', '73', '26', 'Upload/goods/2015-05/5565c0177c47c.jpg', 'Upload/goods/2015-05/5565c0177c47c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('204', '73', '26', 'Upload/goods/2015-05/5565c0183e5d9.jpg', 'Upload/goods/2015-05/5565c0183e5d9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('205', '74', '26', 'Upload/goods/2015-05/5565c3b10200b.png', 'Upload/goods/2015-05/5565c3b10200b_thumb.png');
INSERT INTO `wst_goods_gallerys` VALUES ('206', '74', '26', 'Upload/goods/2015-05/5565c3b190c79.jpg', 'Upload/goods/2015-05/5565c3b190c79_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('207', '74', '26', 'Upload/goods/2015-05/5565c3b1e8b50.jpg', 'Upload/goods/2015-05/5565c3b1e8b50_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('208', '75', '26', 'Upload/goods/2015-05/5565c4a1d54e2.jpg', 'Upload/goods/2015-05/5565c4a1d54e2_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('209', '75', '26', 'Upload/goods/2015-05/5565c4a29c3ed.jpg', 'Upload/goods/2015-05/5565c4a29c3ed_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('210', '75', '26', 'Upload/goods/2015-05/5565c4a31535a.jpg', 'Upload/goods/2015-05/5565c4a31535a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('211', '76', '26', 'Upload/goods/2015-05/5565c55f01a5b.jpg', 'Upload/goods/2015-05/5565c55f01a5b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('212', '76', '26', 'Upload/goods/2015-05/5565c55f01a5b.jpg', 'Upload/goods/2015-05/5565c55f01a5b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('213', '76', '26', 'Upload/goods/2015-05/5565c56053212.jpg', 'Upload/goods/2015-05/5565c56053212_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('214', '77', '26', 'Upload/goods/2015-05/5565c5ffcd37a.jpg', 'Upload/goods/2015-05/5565c5ffcd37a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('215', '77', '26', 'Upload/goods/2015-05/5565c6006fbfa.jpg', 'Upload/goods/2015-05/5565c6006fbfa_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('216', '77', '26', 'Upload/goods/2015-05/5565c600e7625.jpg', 'Upload/goods/2015-05/5565c600e7625_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('217', '77', '26', 'Upload/goods/2015-05/5565c60159599.jpg', 'Upload/goods/2015-05/5565c60159599_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('218', '78', '26', 'Upload/goods/2015-05/5565c713ca4c2.jpg', 'Upload/goods/2015-05/5565c713ca4c2_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('219', '78', '26', 'Upload/goods/2015-05/5565c7149cf0f.jpg', 'Upload/goods/2015-05/5565c7149cf0f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('220', '78', '26', 'Upload/goods/2015-05/5565c7152c719.jpg', 'Upload/goods/2015-05/5565c7152c719_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('221', '79', '26', 'Upload/goods/2015-05/5565c7e0024c3.jpg', 'Upload/goods/2015-05/5565c7e0024c3_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('222', '79', '26', 'Upload/goods/2015-05/5565c7e0cd10b.jpg', 'Upload/goods/2015-05/5565c7e0cd10b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('223', '79', '26', 'Upload/goods/2015-05/5565c7e2ecc11.jpg', 'Upload/goods/2015-05/5565c7e2ecc11_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('224', '79', '26', 'Upload/goods/2015-05/5565c7e43a308.jpg', 'Upload/goods/2015-05/5565c7e43a308_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('225', '80', '26', 'Upload/goods/2015-05/5565c8b57be7d.jpg', 'Upload/goods/2015-05/5565c8b57be7d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('226', '80', '26', 'Upload/goods/2015-05/5565c8b618f70.jpg', 'Upload/goods/2015-05/5565c8b618f70_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('227', '80', '26', 'Upload/goods/2015-05/5565c8b680405.jpg', 'Upload/goods/2015-05/5565c8b680405_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('228', '80', '26', 'Upload/goods/2015-05/5565c8b6df578.jpg', 'Upload/goods/2015-05/5565c8b6df578_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('229', '81', '26', 'Upload/goods/2015-05/5565cc0e30b26.jpg', 'Upload/goods/2015-05/5565cc0e30b26_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('230', '81', '26', 'Upload/goods/2015-05/5565cc1c05591.jpg', 'Upload/goods/2015-05/5565cc1c05591_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('231', '81', '26', 'Upload/goods/2015-05/5565cc221b9cf.jpg', 'Upload/goods/2015-05/5565cc221b9cf_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('232', '82', '26', 'Upload/goods/2015-05/5565ccb259904.jpg', 'Upload/goods/2015-05/5565ccb259904_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('233', '82', '26', 'Upload/goods/2015-05/5565ccb36ddab.jpg', 'Upload/goods/2015-05/5565ccb36ddab_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('234', '82', '26', 'Upload/goods/2015-05/5565ccb53a07f.jpg', 'Upload/goods/2015-05/5565ccb53a07f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('235', '82', '26', 'Upload/goods/2015-05/5565ccb5efb97.jpg', 'Upload/goods/2015-05/5565ccb5efb97_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('236', '83', '26', 'Upload/goods/2015-05/5565ce87de3d7.jpg', 'Upload/goods/2015-05/5565ce87de3d7_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('237', '83', '26', 'Upload/goods/2015-05/5565ce8c08d27.jpg', 'Upload/goods/2015-05/5565ce8c08d27_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('238', '83', '26', 'Upload/goods/2015-05/5565ce8e2e42c.jpg', 'Upload/goods/2015-05/5565ce8e2e42c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('239', '84', '26', 'Upload/goods/2015-05/5565cfd272d9f.jpg', 'Upload/goods/2015-05/5565cfd272d9f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('240', '84', '26', 'Upload/goods/2015-05/5565cfd34f089.jpg', 'Upload/goods/2015-05/5565cfd34f089_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('241', '84', '26', 'Upload/goods/2015-05/5565cfd50bac1.jpg', 'Upload/goods/2015-05/5565cfd50bac1_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('242', '85', '26', 'Upload/goods/2015-05/5565d04bd2287.jpg', 'Upload/goods/2015-05/5565d04bd2287_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('243', '85', '26', 'Upload/goods/2015-05/5565d04e9f999.jpg', 'Upload/goods/2015-05/5565d04e9f999_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('244', '85', '26', 'Upload/goods/2015-05/5565d054be144.jpg', 'Upload/goods/2015-05/5565d054be144_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('245', '86', '26', 'Upload/goods/2015-05/5565d13ed59cc.jpg', 'Upload/goods/2015-05/5565d13ed59cc_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('246', '87', '26', 'Upload/goods/2015-05/5565d1da8bc70.jpg', 'Upload/goods/2015-05/5565d1da8bc70_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('247', '87', '26', 'Upload/goods/2015-05/5565d1db2186e.jpg', 'Upload/goods/2015-05/5565d1db2186e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('248', '87', '26', 'Upload/goods/2015-05/5565d1db992cc.jpg', 'Upload/goods/2015-05/5565d1db992cc_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('249', '87', '26', 'Upload/goods/2015-05/5565d1dc245eb.jpg', 'Upload/goods/2015-05/5565d1dc245eb_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('250', '88', '26', 'Upload/goods/2015-05/5565d2adb5408.jpg', 'Upload/goods/2015-05/5565d2adb5408_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('251', '88', '26', 'Upload/goods/2015-05/5565d2ae637f7.jpg', 'Upload/goods/2015-05/5565d2ae637f7_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('252', '88', '26', 'Upload/goods/2015-05/5565d2af81e60.jpg', 'Upload/goods/2015-05/5565d2af81e60_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('253', '89', '30', 'Upload/goods/2015-05/5565e0e2261bd.jpg', 'Upload/goods/2015-05/5565e0e2261bd_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('254', '89', '30', 'Upload/goods/2015-05/5565e0e404617.jpg', 'Upload/goods/2015-05/5565e0e404617_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('255', '89', '30', 'Upload/goods/2015-05/5565e0e51306a.jpg', 'Upload/goods/2015-05/5565e0e51306a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('256', '90', '30', 'Upload/goods/2015-05/5565e21dedf1e.jpg', 'Upload/goods/2015-05/5565e21dedf1e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('257', '90', '30', 'Upload/goods/2015-05/5565e23546787.jpg', 'Upload/goods/2015-05/5565e23546787_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('258', '90', '30', 'Upload/goods/2015-05/5565e236759a8.jpg', 'Upload/goods/2015-05/5565e236759a8_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('259', '91', '30', 'Upload/goods/2015-05/5565e2f34c1e9.jpg', 'Upload/goods/2015-05/5565e2f34c1e9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('260', '91', '30', 'Upload/goods/2015-05/5565e2f4be849.jpg', 'Upload/goods/2015-05/5565e2f4be849_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('261', '91', '30', 'Upload/goods/2015-05/5565e2f69e74d.jpg', 'Upload/goods/2015-05/5565e2f69e74d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('262', '92', '30', 'Upload/goods/2015-05/5565e2f34c1e9.jpg', 'Upload/goods/2015-05/5565e2f34c1e9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('263', '92', '30', 'Upload/goods/2015-05/5565e2f4be849.jpg', 'Upload/goods/2015-05/5565e2f4be849_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('264', '92', '30', 'Upload/goods/2015-05/5565e2f69e74d.jpg', 'Upload/goods/2015-05/5565e2f69e74d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('265', '93', '30', 'Upload/goods/2015-05/5565e2f34c1e9.jpg', 'Upload/goods/2015-05/5565e2f34c1e9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('266', '93', '30', 'Upload/goods/2015-05/5565e2f4be849.jpg', 'Upload/goods/2015-05/5565e2f4be849_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('267', '93', '30', 'Upload/goods/2015-05/5565e2f69e74d.jpg', 'Upload/goods/2015-05/5565e2f69e74d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('268', '94', '30', 'Upload/goods/2015-05/5565e5aebd4c4.jpg', 'Upload/goods/2015-05/5565e5aebd4c4_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('269', '94', '30', 'Upload/goods/2015-05/5565e5af656bc.jpg', 'Upload/goods/2015-05/5565e5af656bc_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('270', '94', '30', 'Upload/goods/2015-05/5565e5afcbf29.jpg', 'Upload/goods/2015-05/5565e5afcbf29_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('271', '95', '30', 'Upload/goods/2015-05/5565e6c41e1f6.jpg', 'Upload/goods/2015-05/5565e6c41e1f6_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('272', '95', '30', 'Upload/goods/2015-05/5565e6c4cbde8.jpg', 'Upload/goods/2015-05/5565e6c4cbde8_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('273', '95', '30', 'Upload/goods/2015-05/5565e6c563ff9.jpg', 'Upload/goods/2015-05/5565e6c563ff9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('274', '96', '30', 'Upload/goods/2015-05/5565e79d29c0b.jpg', 'Upload/goods/2015-05/5565e79d29c0b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('275', '96', '30', 'Upload/goods/2015-05/5565e79e3b157.jpg', 'Upload/goods/2015-05/5565e79e3b157_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('276', '96', '30', 'Upload/goods/2015-05/5565e79f764b7.jpg', 'Upload/goods/2015-05/5565e79f764b7_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('277', '97', '30', 'Upload/goods/2015-05/5565e81d6d662.jpg', 'Upload/goods/2015-05/5565e81d6d662_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('278', '97', '30', 'Upload/goods/2015-05/5565e81e1244b.jpg', 'Upload/goods/2015-05/5565e81e1244b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('279', '98', '30', 'Upload/goods/2015-05/5565e8c4de5dd.jpg', 'Upload/goods/2015-05/5565e8c4de5dd_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('280', '98', '30', 'Upload/goods/2015-05/5565e8c5bc256.jpg', 'Upload/goods/2015-05/5565e8c5bc256_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('281', '99', '30', 'Upload/goods/2015-05/5565e9d80e76d.jpg', 'Upload/goods/2015-05/5565e9d80e76d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('282', '99', '30', 'Upload/goods/2015-05/5565e9d91f8c8.jpg', 'Upload/goods/2015-05/5565e9d91f8c8_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('283', '99', '30', 'Upload/goods/2015-05/5565e9d9c79f9.jpg', 'Upload/goods/2015-05/5565e9d9c79f9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('284', '109', '12', 'Upload/goods/2015-05/556b086ea67c2.jpg', 'Upload/goods/2015-05/556b086ea67c2_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('285', '109', '12', 'Upload/goods/2015-05/556b086f029d9.jpg', 'Upload/goods/2015-05/556b086f029d9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('286', '109', '12', 'Upload/goods/2015-05/556b086f5b93c.jpg', 'Upload/goods/2015-05/556b086f5b93c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('287', '111', '12', 'Upload/goods/2015-05/556b0a9b0d13b.jpg', 'Upload/goods/2015-05/556b0a9b0d13b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('288', '111', '12', 'Upload/goods/2015-05/556b0a9b6018d.jpg', 'Upload/goods/2015-05/556b0a9b6018d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('289', '112', '12', 'Upload/goods/2015-05/556b0b1360524.jpg', 'Upload/goods/2015-05/556b0b1360524_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('290', '113', '12', 'Upload/goods/2015-05/556b0c26ee7ae.jpg', 'Upload/goods/2015-05/556b0c26ee7ae_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('291', '113', '12', 'Upload/goods/2015-05/556b0c27869e0.jpg', 'Upload/goods/2015-05/556b0c27869e0_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('292', '114', '12', 'Upload/goods/2015-05/556b0f0430a02.jpg', 'Upload/goods/2015-05/556b0f0430a02_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('293', '115', '12', 'Upload/goods/2015-05/556b0f596175c.jpg', 'Upload/goods/2015-05/556b0f596175c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('294', '4', '4', 'Upload/goods/2015-05/556b100dc6ec3.jpg', 'Upload/goods/2015-05/556b100dc6ec3_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('295', '117', '4', 'Upload/goods/2015-05/556b11d98f37e.jpg', 'Upload/goods/2015-05/556b11d98f37e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('296', '117', '4', 'Upload/goods/2015-05/556b11da0fc38.jpg', 'Upload/goods/2015-05/556b11da0fc38_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('297', '121', '13', 'Upload/goods/2015-05/556b1c3090090.jpg', 'Upload/goods/2015-05/556b1c3090090_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('298', '121', '13', 'Upload/goods/2015-05/556b1c3103de4.jpg', 'Upload/goods/2015-05/556b1c3103de4_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('299', '124', '13', 'Upload/goods/2015-05/556b1d99e2edd.jpg', 'Upload/goods/2015-05/556b1d99e2edd_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('300', '125', '13', 'Upload/goods/2015-05/556b1dd66d5fc.jpg', 'Upload/goods/2015-05/556b1dd66d5fc_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('301', '127', '11', 'Upload/goods/2015-05/556b1fcb90e35.jpg', 'Upload/goods/2015-05/556b1fcb90e35_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('302', '128', '11', 'Upload/goods/2015-05/556b202a693a0.jpg', 'Upload/goods/2015-05/556b202a693a0_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('303', '129', '11', 'Upload/goods/2015-05/556b2048ecf54.jpg', 'Upload/goods/2015-05/556b2048ecf54_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('304', '131', '11', 'Upload/goods/2015-05/556b20ca427a6.jpg', 'Upload/goods/2015-05/556b20ca427a6_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('305', '133', '15', 'Upload/goods/2015-06/556bad89c3cc8.jpg', 'Upload/goods/2015-06/556bad89c3cc8_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('306', '133', '15', 'Upload/goods/2015-06/556bad8a3d477.jpg', 'Upload/goods/2015-06/556bad8a3d477_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('307', '133', '15', 'Upload/goods/2015-06/556bad8a882e6.jpg', 'Upload/goods/2015-06/556bad8a882e6_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('308', '133', '15', 'Upload/goods/2015-06/556bad8adc0a7.jpg', 'Upload/goods/2015-06/556bad8adc0a7_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('309', '137', '15', 'Upload/goods/2015-06/556bb0fcb72fe.jpg', 'Upload/goods/2015-06/556bb0fcb72fe_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('310', '137', '15', 'Upload/goods/2015-06/556bb0fd12afa.jpg', 'Upload/goods/2015-06/556bb0fd12afa_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('311', '137', '15', 'Upload/goods/2015-06/556bb0fd758b5.jpg', 'Upload/goods/2015-06/556bb0fd758b5_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('312', '140', '15', 'Upload/goods/2015-06/556bb4523ee91.jpg', 'Upload/goods/2015-06/556bb4523ee91_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('313', '140', '15', 'Upload/goods/2015-06/556bb452c1370.jpg', 'Upload/goods/2015-06/556bb452c1370_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('314', '140', '15', 'Upload/goods/2015-06/556bb453610df.jpg', 'Upload/goods/2015-06/556bb453610df_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('315', '140', '15', 'Upload/goods/2015-06/556bb453b5b07.jpg', 'Upload/goods/2015-06/556bb453b5b07_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('316', '140', '15', 'Upload/goods/2015-06/556bb45417e1b.jpg', 'Upload/goods/2015-06/556bb45417e1b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('317', '141', '15', 'Upload/goods/2015-06/556bbd4d914e2.jpg', 'Upload/goods/2015-06/556bbd4d914e2_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('318', '141', '15', 'Upload/goods/2015-06/556bbd4de65a0.jpg', 'Upload/goods/2015-06/556bbd4de65a0_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('319', '141', '15', 'Upload/goods/2015-06/556bbd4e649b3.jpg', 'Upload/goods/2015-06/556bbd4e649b3_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('320', '142', '15', 'Upload/goods/2015-06/556bbf43efdd7.jpg', 'Upload/goods/2015-06/556bbf43efdd7_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('321', '142', '15', 'Upload/goods/2015-06/556bbf445e196.jpg', 'Upload/goods/2015-06/556bbf445e196_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('322', '142', '15', 'Upload/goods/2015-06/556bbf44c6471.jpg', 'Upload/goods/2015-06/556bbf44c6471_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('323', '142', '15', 'Upload/goods/2015-06/556bbf453742d.jpg', 'Upload/goods/2015-06/556bbf453742d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('324', '143', '15', 'Upload/goods/2015-06/556bc6382cbe3.jpg', 'Upload/goods/2015-06/556bc6382cbe3_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('325', '143', '15', 'Upload/goods/2015-06/556bc6388a413.jpg', 'Upload/goods/2015-06/556bc6388a413_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('326', '143', '15', 'Upload/goods/2015-06/556bc63937d27.jpg', 'Upload/goods/2015-06/556bc63937d27_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('327', '143', '15', 'Upload/goods/2015-06/556bc6399ff4d.jpg', 'Upload/goods/2015-06/556bc6399ff4d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('328', '144', '15', 'Upload/goods/2015-06/556bcbbe1ed42.jpg', 'Upload/goods/2015-06/556bcbbe1ed42_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('329', '144', '15', 'Upload/goods/2015-06/556bcbbe7c0fa.jpg', 'Upload/goods/2015-06/556bcbbe7c0fa_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('330', '144', '15', 'Upload/goods/2015-06/556bcbbef4125.jpg', 'Upload/goods/2015-06/556bcbbef4125_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('331', '145', '15', 'Upload/goods/2015-06/556bcc363c6be.jpg', 'Upload/goods/2015-06/556bcc363c6be_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('332', '145', '15', 'Upload/goods/2015-06/556bcc369c75b.jpg', 'Upload/goods/2015-06/556bcc369c75b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('333', '145', '15', 'Upload/goods/2015-06/556bcc3713b3b.jpg', 'Upload/goods/2015-06/556bcc3713b3b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('334', '146', '15', 'Upload/goods/2015-06/556bcc8fdf4cd.jpg', 'Upload/goods/2015-06/556bcc8fdf4cd_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('335', '146', '15', 'Upload/goods/2015-06/556bcc9076314.jpg', 'Upload/goods/2015-06/556bcc9076314_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('336', '146', '15', 'Upload/goods/2015-06/556bcc9721c42.jpg', 'Upload/goods/2015-06/556bcc9721c42_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('337', '147', '15', 'Upload/goods/2015-06/556bccf6d056d.jpg', 'Upload/goods/2015-06/556bccf6d056d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('338', '147', '15', 'Upload/goods/2015-06/556bccf868149.jpg', 'Upload/goods/2015-06/556bccf868149_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('339', '147', '15', 'Upload/goods/2015-06/556bccf96c570.jpg', 'Upload/goods/2015-06/556bccf96c570_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('340', '147', '15', 'Upload/goods/2015-06/556bccfa3d7c9.jpg', 'Upload/goods/2015-06/556bccfa3d7c9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('341', '148', '15', 'Upload/goods/2015-06/556bce1174400.jpg', 'Upload/goods/2015-06/556bce1174400_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('342', '149', '15', 'Upload/goods/2015-06/556bced73de18.jpg', 'Upload/goods/2015-06/556bced73de18_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('343', '153', '15', 'Upload/goods/2015-06/556bd0b6737d5.jpg', 'Upload/goods/2015-06/556bd0b6737d5_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('350', '160', '20', 'Upload/goods/2015-06/556c1337277dd.jpg', 'Upload/goods/2015-06/556c1337277dd_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('351', '160', '20', 'Upload/goods/2015-06/556c133781136.jpg', 'Upload/goods/2015-06/556c133781136_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('352', '157', '20', 'Upload/goods/2015-06/556be7fd12d80.jpg', 'Upload/goods/2015-06/556be7fd12d80_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('353', '156', '20', 'Upload/goods/2015-06/556be78648caf.jpg', 'Upload/goods/2015-06/556be78648caf_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('354', '156', '20', 'Upload/goods/2015-06/556be787287a6.jpg', 'Upload/goods/2015-06/556be787287a6_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('355', '158', '20', 'Upload/goods/2015-06/556bf9819ece2.jpg', 'Upload/goods/2015-06/556bf9819ece2_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('356', '158', '20', 'Upload/goods/2015-06/556bf982060e9.jpg', 'Upload/goods/2015-06/556bf982060e9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('357', '159', '20', 'Upload/goods/2015-06/556bf9fda709e.jpg', 'Upload/goods/2015-06/556bf9fda709e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('358', '161', '20', 'Upload/goods/2015-06/556c147ea4142.jpg', 'Upload/goods/2015-06/556c147ea4142_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('359', '161', '20', 'Upload/goods/2015-06/556c147f0d64b.jpg', 'Upload/goods/2015-06/556c147f0d64b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('360', '161', '20', 'Upload/goods/2015-06/556c147f6cfa1.jpg', 'Upload/goods/2015-06/556c147f6cfa1_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('361', '162', '20', 'Upload/goods/2015-06/556c15333e140.jpg', 'Upload/goods/2015-06/556c15333e140_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('362', '163', '20', 'Upload/goods/2015-06/556c15b9bdca7.jpg', 'Upload/goods/2015-06/556c15b9bdca7_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('363', '163', '20', 'Upload/goods/2015-06/556c15ba27cf0.jpg', 'Upload/goods/2015-06/556c15ba27cf0_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('364', '164', '20', 'Upload/goods/2015-06/556c17899e10b.jpg', 'Upload/goods/2015-06/556c17899e10b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('365', '164', '20', 'Upload/goods/2015-06/556c178c165b2.jpg', 'Upload/goods/2015-06/556c178c165b2_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('366', '168', '20', 'Upload/goods/2015-06/556c195983cdb.jpg', 'Upload/goods/2015-06/556c195983cdb_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('367', '169', '20', 'Upload/goods/2015-06/556c19c90f9b3.jpg', 'Upload/goods/2015-06/556c19c90f9b3_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('368', '171', '20', 'Upload/goods/2015-06/556c1ae574add.jpg', 'Upload/goods/2015-06/556c1ae574add_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('369', '172', '20', 'Upload/goods/2015-06/556c1d2381be7.jpg', 'Upload/goods/2015-06/556c1d2381be7_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('370', '173', '20', 'Upload/goods/2015-06/556c1d703f39f.jpg', 'Upload/goods/2015-06/556c1d703f39f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('371', '173', '20', 'Upload/goods/2015-06/556c1d7b55adf.jpg', 'Upload/goods/2015-06/556c1d7b55adf_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('372', '174', '20', 'Upload/goods/2015-06/556c1e3c6bea4.jpg', 'Upload/goods/2015-06/556c1e3c6bea4_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('373', '176', '20', 'Upload/goods/2015-06/556c1f4ca436b.jpg', 'Upload/goods/2015-06/556c1f4ca436b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('374', '176', '20', 'Upload/goods/2015-06/556c1f4d0f785.jpg', 'Upload/goods/2015-06/556c1f4d0f785_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('375', '177', '20', 'Upload/goods/2015-06/556c1ffc80b8c.jpg', 'Upload/goods/2015-06/556c1ffc80b8c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('376', '177', '20', 'Upload/goods/2015-06/556c1ffcf04b2.jpg', 'Upload/goods/2015-06/556c1ffcf04b2_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('377', '177', '20', 'Upload/goods/2015-06/556c1ffd585df.jpg', 'Upload/goods/2015-06/556c1ffd585df_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('378', '177', '20', 'Upload/goods/2015-06/556c1ffde645b.jpg', 'Upload/goods/2015-06/556c1ffde645b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('379', '178', '20', 'Upload/goods/2015-06/556c20cac978e.jpg', 'Upload/goods/2015-06/556c20cac978e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('380', '178', '20', 'Upload/goods/2015-06/556c20cb5be5a.jpg', 'Upload/goods/2015-06/556c20cb5be5a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('381', '178', '20', 'Upload/goods/2015-06/556c20cbb9935.jpg', 'Upload/goods/2015-06/556c20cbb9935_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('383', '182', '23', 'Upload/goods/2015-06/556c26ff07de2.jpg', 'Upload/goods/2015-06/556c26ff07de2_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('384', '183', '23', 'Upload/goods/2015-06/556c27b9af355.jpg', 'Upload/goods/2015-06/556c27b9af355_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('385', '183', '23', 'Upload/goods/2015-06/556c27ba1b9ba.jpg', 'Upload/goods/2015-06/556c27ba1b9ba_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('386', '184', '23', 'Upload/goods/2015-06/556c28532a1af.jpg', 'Upload/goods/2015-06/556c28532a1af_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('387', '185', '23', 'Upload/goods/2015-06/556c28d50ba5d.jpg', 'Upload/goods/2015-06/556c28d50ba5d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('388', '185', '23', 'Upload/goods/2015-06/556c28d56954c.jpg', 'Upload/goods/2015-06/556c28d56954c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('389', '186', '23', 'Upload/goods/2015-06/556c2941585ab.jpg', 'Upload/goods/2015-06/556c2941585ab_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('390', '186', '23', 'Upload/goods/2015-06/556c2941bbbbe.jpg', 'Upload/goods/2015-06/556c2941bbbbe_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('391', '187', '23', 'Upload/goods/2015-06/556c2a235511a.jpg', 'Upload/goods/2015-06/556c2a235511a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('392', '180', '23', 'Upload/goods/2015-06/556c257eb6123.jpg', 'Upload/goods/2015-06/556c257eb6123_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('393', '188', '23', 'Upload/goods/2015-06/556c2d4134582.jpg', 'Upload/goods/2015-06/556c2d4134582_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('394', '189', '23', 'Upload/goods/2015-06/556c2df9a5c53.jpg', 'Upload/goods/2015-06/556c2df9a5c53_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('395', '189', '23', 'Upload/goods/2015-06/556c2dfa6e0c4.jpg', 'Upload/goods/2015-06/556c2dfa6e0c4_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('396', '189', '23', 'Upload/goods/2015-06/556c2dfac649d.jpg', 'Upload/goods/2015-06/556c2dfac649d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('397', '190', '23', 'Upload/goods/2015-06/556c2efc94bf9.jpg', 'Upload/goods/2015-06/556c2efc94bf9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('398', '190', '23', 'Upload/goods/2015-06/556c2f043bcfd.jpg', 'Upload/goods/2015-06/556c2f043bcfd_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('399', '191', '23', 'Upload/goods/2015-06/556c46cb281a1.jpg', 'Upload/goods/2015-06/556c46cb281a1_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('400', '191', '23', 'Upload/goods/2015-06/556c46cb8d432.jpg', 'Upload/goods/2015-06/556c46cb8d432_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('401', '193', '23', 'Upload/goods/2015-06/556c476c62ab8.jpg', 'Upload/goods/2015-06/556c476c62ab8_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('402', '194', '23', 'Upload/goods/2015-06/556c47be669aa.jpg', 'Upload/goods/2015-06/556c47be669aa_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('403', '194', '23', 'Upload/goods/2015-06/556c47beb949c.jpg', 'Upload/goods/2015-06/556c47beb949c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('404', '194', '23', 'Upload/goods/2015-06/556c47bf1cf10.jpg', 'Upload/goods/2015-06/556c47bf1cf10_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('405', '196', '23', 'Upload/goods/2015-06/556c484e8ddc9.jpg', 'Upload/goods/2015-06/556c484e8ddc9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('406', '197', '23', 'Upload/goods/2015-06/556c48a4b3ac2.jpg', 'Upload/goods/2015-06/556c48a4b3ac2_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('407', '197', '23', 'Upload/goods/2015-06/556c48a5534ca.jpg', 'Upload/goods/2015-06/556c48a5534ca_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('408', '200', '23', 'Upload/goods/2015-06/556c49b98bd6c.jpg', 'Upload/goods/2015-06/556c49b98bd6c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('409', '201', '23', 'Upload/goods/2015-06/556c4a3e1fe15.jpg', 'Upload/goods/2015-06/556c4a3e1fe15_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('410', '201', '23', 'Upload/goods/2015-06/556c4a3e79b40.jpg', 'Upload/goods/2015-06/556c4a3e79b40_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('411', '204', '23', 'Upload/goods/2015-06/556c4fcf388ca.jpg', 'Upload/goods/2015-06/556c4fcf388ca_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('412', '204', '23', 'Upload/goods/2015-06/556c4fcf9f1ed.jpg', 'Upload/goods/2015-06/556c4fcf9f1ed_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('413', '205', '23', 'Upload/goods/2015-06/556c501f6c554.jpg', 'Upload/goods/2015-06/556c501f6c554_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('414', '205', '23', 'Upload/goods/2015-06/556c501fc9a5c.jpg', 'Upload/goods/2015-06/556c501fc9a5c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('415', '206', '23', 'Upload/goods/2015-06/556c506e60c34.jpg', 'Upload/goods/2015-06/556c506e60c34_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('416', '206', '23', 'Upload/goods/2015-06/556c506ec378d.jpg', 'Upload/goods/2015-06/556c506ec378d_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('417', '207', '27', 'Upload/goods/2015-06/556c526f3413b.jpg', 'Upload/goods/2015-06/556c526f3413b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('418', '207', '27', 'Upload/goods/2015-06/556c526f916b7.jpg', 'Upload/goods/2015-06/556c526f916b7_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('419', '207', '27', 'Upload/goods/2015-06/556c52700090b.jpg', 'Upload/goods/2015-06/556c52700090b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('420', '208', '27', 'Upload/goods/2015-06/556c53743e932.jpg', 'Upload/goods/2015-06/556c53743e932_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('421', '208', '27', 'Upload/goods/2015-06/556c5374c631c.jpg', 'Upload/goods/2015-06/556c5374c631c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('422', '208', '27', 'Upload/goods/2015-06/556c53767ae6e.jpg', 'Upload/goods/2015-06/556c53767ae6e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('423', '209', '27', 'Upload/goods/2015-06/556c54664934a.jpg', 'Upload/goods/2015-06/556c54664934a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('424', '209', '27', 'Upload/goods/2015-06/556c54670e219.jpg', 'Upload/goods/2015-06/556c54670e219_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('425', '210', '27', 'Upload/goods/2015-06/556c54fcea013.jpg', 'Upload/goods/2015-06/556c54fcea013_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('426', '210', '27', 'Upload/goods/2015-06/556c54fd8e239.jpg', 'Upload/goods/2015-06/556c54fd8e239_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('427', '210', '27', 'Upload/goods/2015-06/556c54fe467e9.jpg', 'Upload/goods/2015-06/556c54fe467e9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('428', '211', '27', 'Upload/goods/2015-06/556c567b1d130.jpg', 'Upload/goods/2015-06/556c567b1d130_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('429', '211', '27', 'Upload/goods/2015-06/556c567c270e8.jpg', 'Upload/goods/2015-06/556c567c270e8_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('430', '211', '27', 'Upload/goods/2015-06/556c567cb4efc.jpg', 'Upload/goods/2015-06/556c567cb4efc_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('431', '212', '27', 'Upload/goods/2015-06/556c5765a6b70.jpg', 'Upload/goods/2015-06/556c5765a6b70_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('432', '212', '27', 'Upload/goods/2015-06/556c57664c453.jpg', 'Upload/goods/2015-06/556c57664c453_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('433', '213', '27', 'Upload/goods/2015-06/556c5811acc97.jpg', 'Upload/goods/2015-06/556c5811acc97_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('434', '213', '27', 'Upload/goods/2015-06/556c58129638f.jpg', 'Upload/goods/2015-06/556c58129638f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('435', '213', '27', 'Upload/goods/2015-06/556c581342225.jpg', 'Upload/goods/2015-06/556c581342225_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('436', '213', '27', 'Upload/goods/2015-06/556c58142ac10.jpg', 'Upload/goods/2015-06/556c58142ac10_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('437', '214', '27', 'Upload/goods/2015-06/556c59125d44c.jpg', 'Upload/goods/2015-06/556c59125d44c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('438', '214', '27', 'Upload/goods/2015-06/556c591328371.jpg', 'Upload/goods/2015-06/556c591328371_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('439', '215', '27', 'Upload/goods/2015-06/556c5d0c0cab6.jpg', 'Upload/goods/2015-06/556c5d0c0cab6_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('440', '216', '27', 'Upload/goods/2015-06/556c5df155bd8.jpg', 'Upload/goods/2015-06/556c5df155bd8_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('441', '216', '27', 'Upload/goods/2015-06/556c5df1bc9c5.jpg', 'Upload/goods/2015-06/556c5df1bc9c5_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('442', '217', '27', 'Upload/goods/2015-06/556c5e5e87993.jpg', 'Upload/goods/2015-06/556c5e5e87993_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('443', '217', '27', 'Upload/goods/2015-06/556c5e5f57f11.jpg', 'Upload/goods/2015-06/556c5e5f57f11_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('444', '218', '27', 'Upload/goods/2015-06/556c5ed3c254a.jpg', 'Upload/goods/2015-06/556c5ed3c254a_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('445', '220', '27', 'Upload/goods/2015-06/556c5ff218931.jpg', 'Upload/goods/2015-06/556c5ff218931_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('446', '220', '27', 'Upload/goods/2015-06/556c5ff289bbe.jpg', 'Upload/goods/2015-06/556c5ff289bbe_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('447', '220', '27', 'Upload/goods/2015-06/556c5ff2f104b.jpg', 'Upload/goods/2015-06/556c5ff2f104b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('448', '221', '27', 'Upload/goods/2015-06/556c60937cedb.jpg', 'Upload/goods/2015-06/556c60937cedb_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('449', '221', '27', 'Upload/goods/2015-06/556c6094460d3.jpg', 'Upload/goods/2015-06/556c6094460d3_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('450', '222', '27', 'Upload/goods/2015-06/556c610dec8d7.jpg', 'Upload/goods/2015-06/556c610dec8d7_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('451', '224', '31', 'Upload/goods/2015-06/556c65b4c99d5.jpg', 'Upload/goods/2015-06/556c65b4c99d5_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('452', '224', '31', 'Upload/goods/2015-06/556c65b53995e.jpg', 'Upload/goods/2015-06/556c65b53995e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('453', '225', '31', 'Upload/goods/2015-06/556c661218d22.jpg', 'Upload/goods/2015-06/556c661218d22_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('454', '225', '31', 'Upload/goods/2015-06/556c6612a9efb.jpg', 'Upload/goods/2015-06/556c6612a9efb_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('455', '226', '31', 'Upload/goods/2015-06/556c664307fe8.jpg', 'Upload/goods/2015-06/556c664307fe8_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('456', '226', '31', 'Upload/goods/2015-06/556c6643c0ec7.jpg', 'Upload/goods/2015-06/556c6643c0ec7_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('457', '226', '31', 'Upload/goods/2015-06/556c66442dc06.jpg', 'Upload/goods/2015-06/556c66442dc06_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('458', '227', '31', 'Upload/goods/2015-06/556c6751e7dc9.jpg', 'Upload/goods/2015-06/556c6751e7dc9_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('459', '227', '31', 'Upload/goods/2015-06/556c6752b0901.jpg', 'Upload/goods/2015-06/556c6752b0901_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('460', '230', '31', 'Upload/goods/2015-06/556c6823db5a1.jpg', 'Upload/goods/2015-06/556c6823db5a1_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('461', '231', '31', 'Upload/goods/2015-06/556c695db83ab.jpg', 'Upload/goods/2015-06/556c695db83ab_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('462', '232', '31', 'Upload/goods/2015-06/556c69b8c762b.jpg', 'Upload/goods/2015-06/556c69b8c762b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('463', '233', '31', 'Upload/goods/2015-06/556c6a0adcca0.jpg', 'Upload/goods/2015-06/556c6a0adcca0_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('464', '235', '31', 'Upload/goods/2015-06/556c6aca3235f.jpg', 'Upload/goods/2015-06/556c6aca3235f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('465', '236', '31', 'Upload/goods/2015-06/556c6b6248f39.jpg', 'Upload/goods/2015-06/556c6b6248f39_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('466', '236', '31', 'Upload/goods/2015-06/556c6b62d3407.jpg', 'Upload/goods/2015-06/556c6b62d3407_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('467', '236', '31', 'Upload/goods/2015-06/556c6b6343533.jpg', 'Upload/goods/2015-06/556c6b6343533_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('468', '236', '31', 'Upload/goods/2015-06/556c6b63a9231.jpg', 'Upload/goods/2015-06/556c6b63a9231_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('469', '237', '31', 'Upload/goods/2015-06/556c6b8575a00.jpg', 'Upload/goods/2015-06/556c6b8575a00_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('470', '238', '31', 'Upload/goods/2015-06/556c6c13245c8.jpg', 'Upload/goods/2015-06/556c6c13245c8_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('471', '239', '31', 'Upload/goods/2015-06/556c6c93c278b.jpg', 'Upload/goods/2015-06/556c6c93c278b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('472', '239', '31', 'Upload/goods/2015-06/556c6c944cc72.jpg', 'Upload/goods/2015-06/556c6c944cc72_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('473', '239', '31', 'Upload/goods/2015-06/556c6c94bc9fb.jpg', 'Upload/goods/2015-06/556c6c94bc9fb_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('474', '241', '31', 'Upload/goods/2015-06/556c6d8cb487c.jpg', 'Upload/goods/2015-06/556c6d8cb487c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('475', '243', '31', 'Upload/goods/2015-06/556c6e4d54e10.jpg', 'Upload/goods/2015-06/556c6e4d54e10_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('476', '243', '31', 'Upload/goods/2015-06/556c6e4db70d5.jpg', 'Upload/goods/2015-06/556c6e4db70d5_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('477', '244', '31', 'Upload/goods/2015-06/556c6eedbad5f.jpg', 'Upload/goods/2015-06/556c6eedbad5f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('478', '244', '31', 'Upload/goods/2015-06/556c6eee81dbb.jpg', 'Upload/goods/2015-06/556c6eee81dbb_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('479', '245', '31', 'Upload/goods/2015-06/556c6f810b870.jpg', 'Upload/goods/2015-06/556c6f810b870_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('480', '245', '31', 'Upload/goods/2015-06/556c6f81946ce.jpg', 'Upload/goods/2015-06/556c6f81946ce_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('481', '245', '31', 'Upload/goods/2015-06/556c6f8200dc1.jpg', 'Upload/goods/2015-06/556c6f8200dc1_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('482', '246', '31', 'Upload/goods/2015-06/556c6fd85734f.jpg', 'Upload/goods/2015-06/556c6fd85734f_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('483', '246', '31', 'Upload/goods/2015-06/556c6fd8ec656.jpg', 'Upload/goods/2015-06/556c6fd8ec656_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('484', '247', '31', 'Upload/goods/2015-06/556c72a728acc.jpg', 'Upload/goods/2015-06/556c72a728acc_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('485', '247', '31', 'Upload/goods/2015-06/556c72a7c4f5b.jpg', 'Upload/goods/2015-06/556c72a7c4f5b_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('486', '248', '31', 'Upload/goods/2015-06/556c7320c9066.jpg', 'Upload/goods/2015-06/556c7320c9066_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('487', '250', '31', 'Upload/goods/2015-06/556c743c9e0df.jpg', 'Upload/goods/2015-06/556c743c9e0df_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('488', '250', '31', 'Upload/goods/2015-06/556c743d2285c.jpg', 'Upload/goods/2015-06/556c743d2285c_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('489', '251', '31', 'Upload/goods/2015-06/556c74ade2a55.jpg', 'Upload/goods/2015-06/556c74ade2a55_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('490', '252', '31', 'Upload/goods/2015-06/556c751ad110e.jpg', 'Upload/goods/2015-06/556c751ad110e_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('491', '252', '31', 'Upload/goods/2015-06/556c751b514dc.jpg', 'Upload/goods/2015-06/556c751b514dc_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('492', '253', '31', 'Upload/goods/2015-06/556c758e77960.jpg', 'Upload/goods/2015-06/556c758e77960_thumb.jpg');
INSERT INTO `wst_goods_gallerys` VALUES ('493', '253', '31', 'Upload/goods/2015-06/556c758ee4d25.jpg', 'Upload/goods/2015-06/556c758ee4d25_thumb.jpg');

-- ----------------------------
-- Table structure for `wst_goods_cats`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_cats`;
CREATE TABLE `wst_goods_cats` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `catName` varchar(20) NOT NULL,
  `priceSection` text,
  `catSort` int(11) NOT NULL DEFAULT '0',
  `catFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catId`),
  KEY `parentId` (`parentId`,`isShow`,`catFlag`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=334 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_cats
-- ----------------------------
INSERT INTO `wst_goods_cats` VALUES ('47', '0', '1', '时蔬水果、网上菜场', '100', '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('48', '0', '1', '厨卫清洁、纸制用品', '111', '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('49', '0', '1', '酒水饮料、茶叶冲饮', '11', '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('50', '0', '1', '粮油食品、南北干货', 'we', '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('51', '0', '1', '美容护理、洗浴用品', 'd', '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('52', '0', '1', '休闲食品、进口食品', 'asd', '6', '1');
INSERT INTO `wst_goods_cats` VALUES ('53', '0', '1', '营养保健、调理用品', 'sd', '7', '1');
INSERT INTO `wst_goods_cats` VALUES ('54', '0', '1', '家居家电、厨具卫浴', 'sd', '8', '1');
INSERT INTO `wst_goods_cats` VALUES ('55', '0', '1', '床上用品、玩具乐器', 'sd', '9', '1');
INSERT INTO `wst_goods_cats` VALUES ('56', '0', '1', '虚拟服务、优惠票券', 'sd', '10', '1');
INSERT INTO `wst_goods_cats` VALUES ('57', '0', '1', '母婴、玩具乐器', 'sd', '11', '-1');
INSERT INTO `wst_goods_cats` VALUES ('58', '0', '1', '食品饮料、酒类、生鲜', 'sad', '12', '-1');
INSERT INTO `wst_goods_cats` VALUES ('59', '0', '1', '营养保健', 'sd', '13', '-1');
INSERT INTO `wst_goods_cats` VALUES ('60', '0', '1', '彩票、旅行、充值、票务', 'sd', '14', '-1');
INSERT INTO `wst_goods_cats` VALUES ('61', '47', '1', '进口水果', '100', '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('62', '47', '1', '新鲜蔬菜', '100', '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('63', '47', '1', '美食净菜', '100', '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('64', '47', '1', '肉类蛋禽', '100', '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('65', '47', '1', '海鲜水产', '100', '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('66', '47', '1', '速冻食品', '100', '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('67', '47', '1', '生活', '100', '0', '-1');
INSERT INTO `wst_goods_cats` VALUES ('68', '47', '1', '科技', '100', '0', '-1');
INSERT INTO `wst_goods_cats` VALUES ('69', '47', '1', '少儿', '100', '0', '-1');
INSERT INTO `wst_goods_cats` VALUES ('70', '47', '1', '教育', '100', '0', '-1');
INSERT INTO `wst_goods_cats` VALUES ('71', '47', '1', '其它', '100', '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('72', '61', '1', '橙柚', '100', '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('73', '61', '1', '苹果', '100', '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('74', '48', '1', '纸制品', '0-100,100-200', '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('75', '74', '1', '软包抽纸', '0-100,100-200', '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('76', '61', '1', '凤梨', '100', '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('77', '61', '1', '火龙果', '100', '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('78', '49', '1', '酒水', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('79', '49', '1', '咖啡', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('80', '49', '1', '茶叶', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('81', '49', '1', '饮料饮品', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('82', '49', '1', '成人奶粉', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('83', '49', '1', '养生茶', null, '6', '-1');
INSERT INTO `wst_goods_cats` VALUES ('84', '56', '1', '通讯充值', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('85', '56', '1', '本地生活', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('86', '56', '1', '演出票务', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('87', '56', '1', '教育培训', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('88', '87', '1', '早教幼教', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('89', '87', '1', '艺术培训', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('90', '87', '1', '语言培训', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('91', '87', '1', '网络课程', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('92', '87', '1', '学习培训', null, '6', '1');
INSERT INTO `wst_goods_cats` VALUES ('93', '86', '1', '电影选座', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('94', '86', '1', '演唱会', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('95', '86', '1', '音乐会', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('96', '86', '1', '体育赛事', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('97', '85', '1', '外卖订座', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('98', '85', '1', '生活缴费', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('99', '85', '1', '汽车养护', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('100', '84', '1', '移动话费充值', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('101', '84', '1', '电信话费充值', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('102', '84', '1', '联通话费充值', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('103', '55', '1', '儿童玩具', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('104', '103', '1', '毛绒玩具', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('105', '103', '1', '电动车', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('106', '103', '1', '积木拼插', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('107', '103', '1', '滑板车', null, '7', '1');
INSERT INTO `wst_goods_cats` VALUES ('108', '55', '1', '婴幼家纺', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('109', '55', '1', '床上用品', null, '7', '1');
INSERT INTO `wst_goods_cats` VALUES ('110', '108', '1', '婴儿枕', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('111', '108', '1', '冬抱被', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('112', '108', '1', '床垫', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('113', '109', '1', '记忆枕', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('114', '109', '1', '电热毯', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('115', '109', '1', '床单床笠', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('116', '108', '1', '床品套件', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('117', '109', '1', '全棉四件套', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('118', '54', '1', '厨具锅具', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('119', '54', '1', '厨房电器', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('120', '54', '1', '电器附件', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('121', '54', '1', '日常电器', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('122', '118', '1', '压力锅', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('123', '118', '1', '平底锅', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('124', '118', '1', '铲勺', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('125', '118', '1', '烘焙工具', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('126', '119', '1', '电饭煲', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('127', '119', '1', '电磁炉', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('128', '119', '1', '电炖锅', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('129', '120', '1', '万能遥控器', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('130', '120', '1', '电池', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('131', '120', '1', '电视挂架', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('132', '120', '1', '插头', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('133', '121', '1', '理发器', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('134', '121', '1', '电吹风', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('135', '121', '1', '脱毛器', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('136', '121', '1', '美发器', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('137', '53', '1', '日常用药', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('138', '53', '1', '营养健康', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('139', '53', '1', '调理用药', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('140', '53', '1', '传统滋补', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('141', '53', '1', '营养成分', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('142', '137', '1', '感冒发热', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('143', '137', '1', '咽喉肿痛', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('144', '137', '1', '止咳化痰', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('145', '137', '1', '牙龈肿痛', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('146', '137', '1', '跌打损伤', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('147', '138', '1', '增强免疫', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('148', '138', '1', '改善睡眠', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('149', '138', '1', '补肾健体', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('150', '138', '1', '延缓衰老', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('151', '138', '1', '美白养颜', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('152', '139', '1', '补脑安神', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('153', '139', '1', '减肥瘦身', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('154', '139', '1', '健脾消食', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('155', '139', '1', '养肝护胆', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('156', '140', '1', '蜂蜜/蜂产品', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('157', '140', '1', '阿胶', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('158', '140', '1', '燕窝', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('159', '141', '1', '鱼油', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('160', '141', '1', '螺旋藻', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('161', '141', '1', '海狗/海豹油', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('162', '141', '1', '蛋白质/氨基酸', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('163', '141', '1', '葡萄糖', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('164', '51', '1', '洗浴用品', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('165', '51', '1', '进口美护', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('166', '51', '1', '女性护理', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('167', '51', '1', '缤纷彩妆', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('168', '164', '1', '沐浴露', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('169', '164', '1', '舒肤佳', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('170', '164', '1', '浴球/浴擦', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('171', '164', '1', '威露士', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('172', '165', '1', '进口护肤品', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('173', '165', '1', '进口男士护理', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('174', '165', '1', '进口沐浴', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('175', '165', '1', '进口美妆', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('176', '166', '1', '日用卫生巾', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('177', '166', '1', '夜用卫生巾', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('178', '166', '1', '护垫', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('179', '166', '1', '卫生棉条', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('180', '167', '1', '润唇膏', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('181', '167', '1', '眼线笔', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('182', '167', '1', '粉底', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('183', '167', '1', '眼影', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('184', '164', '1', '沐浴套装', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('185', '164', '1', '滴露', null, '6', '1');
INSERT INTO `wst_goods_cats` VALUES ('186', '164', '1', '女性洗液', null, '7', '1');
INSERT INTO `wst_goods_cats` VALUES ('187', '164', '1', '香皂', null, '8', '1');
INSERT INTO `wst_goods_cats` VALUES ('188', '167', '1', '指甲油', null, '8', '1');
INSERT INTO `wst_goods_cats` VALUES ('189', '52', '1', '坚果/蜜饯', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('190', '52', '1', '休闲零食', null, '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('191', '52', '1', '进口速食调料', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('192', '52', '1', '进口休闲零食', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('193', '52', '1', '进口饼干/糕点', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('194', '193', '1', '进口曲奇', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('195', '193', '1', '进口蛋卷', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('196', '193', '1', '进口西式糕点', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('197', '193', '1', '进口夹心饼干', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('198', '193', '1', '进口威化', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('199', '189', '1', '坚果', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('200', '189', '1', '核桃', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('201', '189', '1', '夏威夷果', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('202', '189', '1', '开心果', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('203', '189', '1', '百草味', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('204', '190', '1', '薯片', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('205', '190', '1', '牛肉干', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('206', '190', '1', '鱼豆腐', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('207', '190', '1', '鱼干', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('208', '190', '1', '凤爪鸡翅', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('209', '191', '1', '进口意面酱', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('210', '191', '1', '进口调味油', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('211', '191', '1', '进口肉罐头', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('212', '191', '1', '进口水果罐头', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('213', '191', '1', '进口咖喱', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('214', '192', '1', '进口薯片', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('215', '192', '1', '进口玉米片', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('216', '192', '1', '进口果冻', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('217', '192', '1', '进口海苔', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('218', '192', '1', '进口海鲜零食', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('219', '50', '1', '南北干货', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('220', '50', '1', '食用油', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('221', '50', '1', '大米面粉', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('222', '50', '1', '健康杂粮', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('223', '50', '1', '方便速食', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('224', '219', '1', '枸杞', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('225', '219', '1', '桂圆/龙眼干', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('226', '219', '1', '莲子/枣子', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('227', '219', '1', '腌干水产品', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('228', '219', '1', '猴头菇', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('229', '221', '1', '大米', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('230', '221', '1', '面粉', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('231', '221', '1', '豆类', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('232', '223', '1', '方便面', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('233', '223', '1', '方便粉丝', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('234', '223', '1', '蛋制品', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('235', '223', '1', '八宝粥', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('236', '223', '1', '罐头食品', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('237', '222', '1', '小米', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('238', '222', '1', '糙米', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('239', '222', '1', '玉米', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('240', '222', '1', '杂粮', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('241', '222', '1', '薏仁米', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('242', '220', '1', '调和油', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('243', '220', '1', '葵花籽油', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('244', '220', '1', '玉米油', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('245', '220', '1', '花生油', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('246', '220', '1', '橄榄油', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('247', '221', '1', '粗粮', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('248', '82', '1', '脱脂', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('249', '61', '1', '梨', null, '6', '1');
INSERT INTO `wst_goods_cats` VALUES ('250', '61', '1', '芒果', null, '8', '1');
INSERT INTO `wst_goods_cats` VALUES ('251', '61', '1', '蓝莓', null, '12', '1');
INSERT INTO `wst_goods_cats` VALUES ('252', '62', '1', '茄果类', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('253', '62', '1', '农场菜', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('254', '62', '1', '叶菜类', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('255', '62', '1', '营养菜', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('256', '62', '1', '根茎类', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('257', '62', '1', '豆角类', null, '6', '1');
INSERT INTO `wst_goods_cats` VALUES ('258', '48', '1', '厨卫清洁', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('259', '48', '1', '居室清洁', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('260', '48', '1', '整理收纳', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('261', '48', '1', '一次性用品', null, '7', '1');
INSERT INTO `wst_goods_cats` VALUES ('262', '74', '1', '卷筒纸', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('263', '74', '1', '手帕纸', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('264', '74', '1', '平板纸', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('265', '74', '1', '湿巾纸', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('266', '74', '1', '商务卫生纸', null, '6', '1');
INSERT INTO `wst_goods_cats` VALUES ('267', '258', '1', '洗洁精', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('268', '261', '1', '垃圾袋', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('269', '261', '1', '保鲜袋', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('270', '261', '1', '保鲜膜', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('271', '261', '1', '牙签', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('272', '261', '1', '一次性鞋套', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('273', '258', '1', '油污净', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('274', '258', '1', '洁厕剂', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('275', '258', '1', '浴室清洁', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('276', '258', '1', '管道疏通', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('277', '261', '1', '一次性手套', null, '6', '1');
INSERT INTO `wst_goods_cats` VALUES ('278', '259', '1', '地板清洁', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('279', '259', '1', '灭蟑驱虫 ', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('280', '259', '1', '空气清新', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('281', '259', '1', '家具清洁', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('282', '259', '1', '玻璃清洁', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('283', '260', '1', '挂钩/粘钩', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('284', '260', '1', '收纳盒', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('285', '260', '1', '防尘罩', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('286', '260', '1', '整理架', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('287', '260', '1', '压缩袋', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('288', '65', '1', '海鲜', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('289', '65', '1', '贝类', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('290', '65', '1', '蟹类', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('291', '65', '1', '虾类', null, '6', '1');
INSERT INTO `wst_goods_cats` VALUES ('292', '65', '1', '加工水产', null, '8', '1');
INSERT INTO `wst_goods_cats` VALUES ('293', '78', '1', '白酒', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('294', '78', '1', '葡萄酒', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('295', '78', '1', '黄酒', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('296', '78', '1', '啤酒', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('297', '78', '1', '起泡酒', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('298', '79', '1', '速溶咖啡', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('299', '79', '1', '白咖啡', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('300', '82', '1', '低脂', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('301', '82', '1', '全脂', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('302', '79', '1', '咖啡伴侣', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('303', '80', '1', '乌龙茶', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('304', '81', '1', '果蔬汁', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('305', '82', '1', '甜奶粉', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('306', '82', '1', '高钙', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('307', '80', '1', '红茶', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('308', '79', '1', '雀巢咖啡', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('309', '80', '1', '花草茶', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('310', '79', '1', '咖啡豆', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('311', '80', '1', '绿茶', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('312', '80', '1', '水果茶', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('313', '81', '1', '功能饮料', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('314', '81', '1', '凉茶', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('315', '81', '1', '椰汁', null, '4', '1');
INSERT INTO `wst_goods_cats` VALUES ('316', '81', '1', '碳酸饮料', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('317', '64', '1', '新鲜鸡蛋', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('318', '63', '1', '凉菜', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('319', '66', '1', '冰冻鸡翅', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('320', '71', '1', '其他蔬果', null, '1', '1');
INSERT INTO `wst_goods_cats` VALUES ('321', '63', '1', '乳肉', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('322', '64', '1', '新鲜鸭蛋', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('323', '66', '1', '冰冻鸭', null, '2', '1');
INSERT INTO `wst_goods_cats` VALUES ('324', '66', '1', '冰激凌', null, '3', '1');
INSERT INTO `wst_goods_cats` VALUES ('325', '61', '1', 'dddd', null, '0', '-1');
INSERT INTO `wst_goods_cats` VALUES ('326', '64', '1', '肉类', null, '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('327', '64', '1', '骨头', null, '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('328', '64', '1', '牛肉', null, '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('329', '258', '1', '洗衣粉', null, '10', '1');
INSERT INTO `wst_goods_cats` VALUES ('330', '223', '1', '火腿肠', null, '5', '1');
INSERT INTO `wst_goods_cats` VALUES ('331', '167', '1', '化妆品套装', null, '10', '1');
INSERT INTO `wst_goods_cats` VALUES ('332', '66', '1', '冰冻海鲜', null, '0', '1');
INSERT INTO `wst_goods_cats` VALUES ('333', '223', '1', '其他', null, '20', '1');

-- ----------------------------
-- Table structure for `wst_goods_cat_brands`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_cat_brands`;
CREATE TABLE `wst_goods_cat_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catId` int(11) DEFAULT NULL,
  `brandId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catId` (`catId`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_cat_brands
-- ----------------------------
INSERT INTO `wst_goods_cat_brands` VALUES ('1', '47', '19');
INSERT INTO `wst_goods_cat_brands` VALUES ('2', '47', '20');
INSERT INTO `wst_goods_cat_brands` VALUES ('3', '47', '21');
INSERT INTO `wst_goods_cat_brands` VALUES ('4', '47', '22');
INSERT INTO `wst_goods_cat_brands` VALUES ('5', '47', '23');
INSERT INTO `wst_goods_cat_brands` VALUES ('6', '47', '24');
INSERT INTO `wst_goods_cat_brands` VALUES ('7', '48', '25');
INSERT INTO `wst_goods_cat_brands` VALUES ('8', '48', '26');
INSERT INTO `wst_goods_cat_brands` VALUES ('9', '48', '27');
INSERT INTO `wst_goods_cat_brands` VALUES ('10', '48', '28');
INSERT INTO `wst_goods_cat_brands` VALUES ('11', '49', '29');
INSERT INTO `wst_goods_cat_brands` VALUES ('12', '49', '30');
INSERT INTO `wst_goods_cat_brands` VALUES ('13', '49', '31');
INSERT INTO `wst_goods_cat_brands` VALUES ('14', '49', '32');
INSERT INTO `wst_goods_cat_brands` VALUES ('15', '49', '33');
INSERT INTO `wst_goods_cat_brands` VALUES ('16', '49', '34');
INSERT INTO `wst_goods_cat_brands` VALUES ('17', '49', '35');
INSERT INTO `wst_goods_cat_brands` VALUES ('18', '49', '36');
INSERT INTO `wst_goods_cat_brands` VALUES ('19', '49', '37');
INSERT INTO `wst_goods_cat_brands` VALUES ('20', '49', '38');
INSERT INTO `wst_goods_cat_brands` VALUES ('21', '49', '39');
INSERT INTO `wst_goods_cat_brands` VALUES ('22', '49', '40');
INSERT INTO `wst_goods_cat_brands` VALUES ('23', '50', '41');
INSERT INTO `wst_goods_cat_brands` VALUES ('24', '50', '42');
INSERT INTO `wst_goods_cat_brands` VALUES ('25', '50', '43');
INSERT INTO `wst_goods_cat_brands` VALUES ('26', '50', '44');
INSERT INTO `wst_goods_cat_brands` VALUES ('27', '50', '45');
INSERT INTO `wst_goods_cat_brands` VALUES ('28', '50', '46');
INSERT INTO `wst_goods_cat_brands` VALUES ('29', '50', '47');
INSERT INTO `wst_goods_cat_brands` VALUES ('30', '51', '48');
INSERT INTO `wst_goods_cat_brands` VALUES ('31', '51', '49');
INSERT INTO `wst_goods_cat_brands` VALUES ('32', '51', '50');
INSERT INTO `wst_goods_cat_brands` VALUES ('33', '51', '51');
INSERT INTO `wst_goods_cat_brands` VALUES ('34', '51', '52');
INSERT INTO `wst_goods_cat_brands` VALUES ('36', '51', '53');
INSERT INTO `wst_goods_cat_brands` VALUES ('37', '51', '54');
INSERT INTO `wst_goods_cat_brands` VALUES ('38', '51', '55');
INSERT INTO `wst_goods_cat_brands` VALUES ('39', '51', '56');
INSERT INTO `wst_goods_cat_brands` VALUES ('40', '51', '57');
INSERT INTO `wst_goods_cat_brands` VALUES ('41', '51', '58');
INSERT INTO `wst_goods_cat_brands` VALUES ('42', '51', '59');

-- ----------------------------
-- Table structure for `wst_goods_attributes`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_attributes`;
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

-- ----------------------------
-- Records of wst_goods_attributes
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_goods_appraises`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_appraises`;
CREATE TABLE `wst_goods_appraises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `goodsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `goodsScore` int(11) NOT NULL DEFAULT '0',
  `serviceScore` int(11) NOT NULL DEFAULT '0',
  `timeScore` int(11) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shopId` (`shopId`),
  KEY `orderId` (`orderId`,`goodsId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_appraises
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_goods`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods`;
CREATE TABLE `wst_goods` (
  `goodsId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsSn` varchar(20) NOT NULL,
  `goodsName` varchar(50) NOT NULL,
  `goodsImg` varchar(150) NOT NULL,
  `goodsThums` varchar(150) NOT NULL,
  `brandId` int(11) DEFAULT NULL,
  `shopId` int(11) NOT NULL,
  `marketPrice` float(11,1) NOT NULL DEFAULT '0.0',
  `shopPrice` float(11,1) NOT NULL DEFAULT '0.0',
  `goodsStock` int(11) NOT NULL DEFAULT '0',
  `saleCount` int(11) DEFAULT '0',
  `isBook` tinyint(4) NOT NULL DEFAULT '0',
  `bookQuantity` int(11) NOT NULL DEFAULT '0',
  `warnStock` int(11) NOT NULL DEFAULT '0',
  `goodsUnit` char(10) NOT NULL,
  `goodsSpec` text,
  `isSale` tinyint(4) NOT NULL DEFAULT '1',
  `isBest` tinyint(4) DEFAULT '1',
  `isHot` tinyint(4) DEFAULT '1',
  `isRecomm` tinyint(4) DEFAULT '1',
  `isNew` tinyint(4) DEFAULT '1',
  `isAdminBest` tinyint(4) DEFAULT '0',
  `isAdminRecom` tinyint(4) DEFAULT '0',
  `recommDesc` varchar(255) DEFAULT NULL,
  `goodsCatId1` int(11) NOT NULL,
  `goodsCatId2` int(11) NOT NULL,
  `goodsCatId3` int(11) NOT NULL,
  `shopCatId1` int(11) NOT NULL,
  `shopCatId2` int(11) NOT NULL,
  `goodsDesc` text NOT NULL,
  `isShopRecomm` tinyint(4) NOT NULL DEFAULT '0',
  `isIndexRecomm` tinyint(4) NOT NULL DEFAULT '0',
  `isActivityRecomm` tinyint(4) NOT NULL DEFAULT '0',
  `isInnerRecomm` tinyint(4) NOT NULL DEFAULT '0',
  `goodsStatus` tinyint(4) NOT NULL DEFAULT '0',
  `statusRemarks` varchar(255) DEFAULT NULL,
  `goodsFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  `saleTime` datetime DEFAULT NULL,
  `attrCatId` int(11) DEFAULT '0',
  PRIMARY KEY (`goodsId`),
  KEY `shopId` (`shopId`) USING BTREE,
  KEY `goodsStatus` (`goodsStatus`,`goodsFlag`,`isSale`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=255 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods
-- ----------------------------
INSERT INTO `wst_goods` VALUES ('2', '0001', 'wstmall墨西哥牛油果8个 7天内发货 8个装', 'Upload/goods/2015-05/55641875b7501.jpg', 'Upload/goods/2015-05/55641875b7501.jpg', null, '4', '40.0', '36.0', '497', '0', '0', '0', '0', '组', '8粒/组（8个装）', '1', '1', '1', '1', '1', '0', '0', null, '47', '61', '76', '9', '13', '&lt;p&gt;\n	这里省略描述一万字\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526065325_58122.jpg&quot; alt=&quot;&quot; /&gt; \n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-08 11:14:28', null, '0');
INSERT INTO `wst_goods` VALUES ('3', '223655', '进口 美国新奇士Sunkist 脐橙 6粒', 'Upload/goods/2015-05/554c2c1a6a4b9.jpg', 'Upload/goods/2015-05/554c2c1a6a4b9.jpg', null, '4', '40.0', '36.0', '4998', '0', '0', '0', '0', '箱', '1箱6粒', '1', '1', '1', '1', '1', '1', '1', null, '47', '61', '72', '7', '8', '蜜柚&lt;img src=&quot;/product/wstmall/Public/plugins/kindeditor/attached/image/20150508/20150508032414_33455.jpg&quot; alt=&quot;&quot; /&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-08 11:24:27', null, '0');
INSERT INTO `wst_goods` VALUES ('4', '00001', '特色菜 半成品菜肴BCP-22 糖醋排条225g', 'Upload/goods/2015-05/556b10094ea52.jpg', 'Upload/goods/2015-05/556b10094ea52.jpg', '23', '4', '20.0', '13.0', '133', '0', '0', '0', '0', '盒', '225克', '1', '1', '1', '1', '1', '0', '0', null, '47', '63', '318', '9', '13', '&lt;p&gt;\n	测试商品 请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531134405_46326.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-15 10:49:19', null, '0');
INSERT INTO `wst_goods` VALUES ('5', '0003', 'wstmal鲜果蔬 越南新鲜青芒果 5斤装 好吃的', 'Upload/goods/2015-05/5563ef4681396.jpg', 'Upload/goods/2015-05/5563ef4681396.jpg', null, '4', '55.0', '40.0', '1000', '0', '0', '0', '0', '箱', '一箱为5斤', '1', '1', '1', '1', '1', '1', '0', null, '47', '61', '250', '7', '10', '&lt;span style=&quot;color:#E53333;font-size:16px;&quot;&gt;&lt;strong&gt;&amp;nbsp; 温馨提示&lt;/strong&gt;&lt;/span&gt;&lt;br /&gt;\n&lt;p&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:16px;&quot;&gt;配送说明：为了保障生鲜水果产品的最优质量，WSTMALL所有生鲜水果均使用顺丰速运进行配送。发货重量保证足斤实量，标称重量均不含包装物的重量，但因运输途中水分蒸发等客观原因，&lt;/span&gt;&lt;/strong&gt;&lt;span style=&quot;color:#E53333;font-size:16px;&quot;&gt;&lt;strong&gt;到货重量可能有所减少，此情况敬请谅解&lt;/strong&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#E53333;font-size:16px;&quot;&gt;&lt;strong&gt;&lt;br /&gt;\n&lt;/strong&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#E53333;font-size:16px;&quot;&gt;&lt;strong&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526035750_75003.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/strong&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 11:59:39', null, '0');
INSERT INTO `wst_goods` VALUES ('6', '0003', '台湾金钻凤梨2粒/组（约2.5kg-3.2kg）', 'Upload/goods/2015-05/5563f3941bd95.jpg', 'Upload/goods/2015-05/5563f3941bd95.jpg', null, '4', '95.0', '56.0', '5214', '0', '0', '0', '0', '箱', '2粒/组（约2.5kg-3.2kg）', '1', '1', '1', '1', '1', '1', '0', null, '47', '61', '76', '9', '17', '&lt;p&gt;\n	&lt;strong&gt;&lt;span style=&quot;background-color:#E53333;font-size:18px;&quot;&gt;wstmall测试商品，勿下单&lt;/span&gt;&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526041510_85357.png&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 12:16:25', null, '0');
INSERT INTO `wst_goods` VALUES ('7', '543512', 'wstmall汇绿鲜果蔬 限量发售泰国金枕榴莲带壳', 'Upload/goods/2015-05/55641f039eb22.jpg', 'Upload/goods/2015-05/55641f039eb22.jpg', null, '4', '200.0', '150.0', '300', '0', '0', '0', '0', '组', '4-5.5斤为一组', '1', '1', '1', '1', '1', '0', '0', null, '47', '61', '72', '9', '15', '&lt;p&gt;\n	商品不是用来下单的，大家请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526072309_74931.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526072320_32582.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 15:23:25', null, '0');
INSERT INTO `wst_goods` VALUES ('8', '345352', 'wstmall 进口水果 菲律宾菠萝 2只装 新鲜', 'Upload/goods/2015-05/55642c4d7b1b5.jpg', 'Upload/goods/2015-05/55642c4d7b1b5.jpg', null, '4', '345.0', '123.0', '1234234', '0', '0', '0', '0', '箱', '2只装', '1', '1', '1', '1', '1', '1', '0', null, '47', '61', '250', '9', '14', '&lt;p&gt;\n	&lt;span style=&quot;color:#666666;font-family:Arial, Verdana, 宋体;font-size:16px;background-color:#F5F5F5;&quot;&gt;wstmall 所售商品均经过严格的供应商资质审查、商品审查、入库全检、出货全检流程。由于部分商品存在厂家更换包装、不同批次、不同生产日期、不同生产工厂等情况，导致商品实物与图片存在微小差异，因此请您以收到的商品实物为准，同时我们会尽量做到及时更新，由此给您带来不便敬请谅解，谢谢！&lt;/span&gt; \n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#666666;font-family:Arial, Verdana, 宋体;font-size:16px;background-color:#F5F5F5;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt; \n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#666666;font-family:Arial, Verdana, 宋体;font-size:16px;background-color:#F5F5F5;&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526073032_88912.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/span&gt; \n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 15:30:53', null, '0');
INSERT INTO `wst_goods` VALUES ('9', '34456', 'wstmall 阳光金果奇异果果王6粒装', 'Upload/goods/2015-05/5564222d7c7fd.jpg', 'Upload/goods/2015-05/5564222d7c7fd.jpg', null, '4', '566.0', '425.0', '50000', '0', '0', '0', '0', '箱', '6粒装', '1', '1', '1', '1', '1', '0', '0', null, '47', '61', '249', '7', '10', '&lt;p&gt;\n	&lt;span style=&quot;color:#666666;font-family:Arial, Verdana, 宋体;font-size:12px;background-color:#F5F5F5;&quot;&gt;wstmall 所售商品均经过严格的供应商资质审查、商品审查、入库全检、出货全检流程。由于部分商品存在厂家更换包装、不同批次、不同生产日期、不同生产工厂等情况，导致商品实物与图片存在微小差异，因此请您以收到的商品实物为准，同时我们会尽量做到及时更新，由此给您带来不便敬请谅解，谢谢！&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#666666;font-family:Arial, Verdana, 宋体;font-size:12px;background-color:#F5F5F5;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#666666;font-family:Arial, Verdana, 宋体;font-size:12px;background-color:#F5F5F5;&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526073618_87041.png&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 15:36:21', null, '0');
INSERT INTO `wst_goods` VALUES ('10', '346456', '贪吃虎 进口水果 美国新奇士橙 15只装 新鲜爽口', 'Upload/goods/2015-05/556425c1bdb76.jpg', 'Upload/goods/2015-05/556425c1bdb76.jpg', null, '4', '234.0', '132.0', '12311312', '0', '0', '0', '0', '15只装', '15只装', '1', '1', '1', '1', '1', '0', '0', null, '47', '61', '72', '7', '10', '&lt;p&gt;\n	&lt;span style=&quot;font-size:18px;&quot;&gt;wstmall&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-size:18px;line-height:1.5;&quot;&gt;所售商品均经过严格的供应商资质审查、商品审查、入库全检、出货全检流程。由于部分商品存在厂家更换包装、不同批次、不同生产日期、不同生产工厂等情况，导致商品实物与图片存在微小差异，因此请您以收到的商品实物为准，同时我们会尽量做到及时更新，由此给您带来不便敬请谅解，谢谢！&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;font-size:12px;line-height:1.5;&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526075220_70592.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;font-size:12px;line-height:1.5;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 15:52:46', null, '0');
INSERT INTO `wst_goods` VALUES ('11', '34234', 'wstmall 测试商品 牛肉', 'Upload/goods/2015-05/5564342e87634.jpg', 'Upload/goods/2015-05/5564342e87634.jpg', null, '11', '45.0', '39.0', '500', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '0', '0', null, '47', '64', '326', '19', '20', '&lt;p&gt;\n	&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n		牛肉是全世界人都爱吃的食品，中国人消费的肉类食品之一，仅次于猪肉，牛肉蛋白质含量高，而脂肪含量低，所以味道鲜美，受人喜爱，享有“肉中骄子”的美称。\n	&lt;/p&gt;\n	&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n		&amp;nbsp;\n	&lt;/div&gt;\n	&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n		牛肉含有丰富的蛋白质，氨基酸组成等比猪肉更接近人体需要，能提高机体抗病能力，对生长发育及手术后、病后调养的人在补充失血和修复组织等方面特别适宜。寒冬食牛肉，有暖胃作用，为寒冬补益佳品。中医认为：牛肉有补中益气、滋养脾胃、强健筋骨、化痰息风、止渴止涎的功能。适用于中气下陷、气短体虚，筋骨酸软和贫血久病及面黄目眩之人食用。\n	&lt;/div&gt;\n	&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n		&amp;nbsp;\n	&lt;/div&gt;\n	&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n		牛肉的功效\n	&lt;/div&gt;\n	&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n		补脾胃、益气血、强筋骨、消水肿 。\n	&lt;/div&gt;\n	&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n		虚损羸瘦、消渴、脾弱不运、痞积、水肿、腰膝酸软。\n	&lt;/div&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526085320_65675.jpg&quot; alt=&quot;&quot; /&gt; \n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 16:53:25', null, '0');
INSERT INTO `wst_goods` VALUES ('12', '4522356', 'wstmall测试商品 清远鸡（光鸡）', 'Upload/goods/2015-05/5564355c4fcce.jpg', 'Upload/goods/2015-05/5564355c4fcce.jpg', null, '11', '34.0', '32.0', '1234', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '0', '0', null, '47', '64', '326', '19', '20', '&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	清远麻鸡\n&lt;/p&gt;\n&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	原产于广东省清远县（现清远市）。因母鸡背侧羽毛有细小黑色斑点，故称麻鸡。它以体型小、皮下和肌间脂肪发达、皮薄骨软而著名，素为我国活鸡出口的小型肉用名产鸡之一。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp;\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	清远麻鸡以肉用品质优良而驰名，《中国家禽品种志》27个优质品种之一，也是家禽行业著名品种。\n&lt;/div&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526085712_33988.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 16:57:15', null, '0');
INSERT INTO `wst_goods` VALUES ('13', '345235', 'wstmall 测试商品 猪筒骨', 'Upload/goods/2015-05/556435a901b68.jpg', 'Upload/goods/2015-05/556435a901b68.jpg', null, '11', '123.0', '99.0', '123', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '0', '0', null, '47', '64', '327', '19', '22', '&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	猪筒骨：&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp; 中间有洞，可以容纳骨髓的大骨头。比较好的筒骨，应该是后腿的腿骨，因为这里的骨头比较粗。骨中的骨髓含有很多骨胶元，除了可以美容，还可以促进伤口愈合，增强体质。猪筒骨骨中的骨髓含有很多骨胶元，除了可以美容，还可以促进伤口愈合，增强体质。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	食疗作用：&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp; 提高免疫力,养颜护肤。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	选购技巧：&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp; 比较好的筒骨，应该是后腿的腿骨，因为这里的骨头比较粗。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 16:59:32', null, '0');
INSERT INTO `wst_goods` VALUES ('14', '3453245', 'wstmall 测试商品 猪前腿上肉', 'Upload/goods/2015-05/556436339ad9a.jpg', 'Upload/goods/2015-05/556436339ad9a.jpg', null, '11', '344.0', '234.0', '1234', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '0', '1', null, '47', '64', '326', '19', '20', '&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	猪前腿上肉&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp; 猪前腿〈猪手〉四周的肉，叫前上肉。含蛋白质丰富,含有的必需氮基酸全面、数量多，而且比例恰当，接近于人体的蛋白质，容易消化吸收。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	食用功效&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp; 有补虚强身，滋阴润燥、丰肌泽肤的作用。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526090124_45060.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 17:01:30', null, '0');
INSERT INTO `wst_goods` VALUES ('15', '2342', 'wstmall 测试商品 冰鲜红立鱼', 'Upload/goods/2015-05/556439094a571.jpg', 'Upload/goods/2015-05/556439094a571.jpg', null, '11', '522.0', '400.0', '2000', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '1', '1', null, '47', '65', '288', '19', '24', '&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	红立鱼，又叫立鱼、立花、立仔、板立、长旗。正式名称是二长棘鲷，产于我国南海和东海南部、主要产地在北部湾及雷州半岛。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	暖温性底层鱼类。体长130～230毫米。栖息于近海水深20～70米的沙泥底水域。为南海经济鱼类。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	红立鱼含多种人体必需氨基酸，刺少，非常适合蒸制食用。蒸制后，鱼肉爽滑鲜嫩，是过节餐桌不可多得的一道大餐。\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 17:13:37', null, '0');
INSERT INTO `wst_goods` VALUES ('16', '234234', 'wstmall 测试商品 冰鲜鸡全翅', 'Upload/goods/2015-05/5564397599f61.jpg', 'Upload/goods/2015-05/5564397599f61.jpg', null, '11', '25.0', '20.0', '0', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '1', '0', null, '47', '64', '326', '19', '20', '&lt;p&gt;\n	&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;冰鲜鸡全翅&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526091517_84847.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 17:15:20', null, '0');
INSERT INTO `wst_goods` VALUES ('17', '23424', 'wstmall 测试商品 皇上皇金冠腊肠400克', 'Upload/goods/2015-05/55643a2615f00.jpg', 'Upload/goods/2015-05/55643a2615f00.jpg', null, '11', '100.0', '50.0', '3000', '0', '0', '0', '0', '袋', '400克每袋', '1', '1', '1', '1', '1', '1', '0', null, '47', '64', '326', '19', '20', '&lt;p&gt;\n	&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;皇上皇金冠二八腊肠400克&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;皇上皇金冠二八腊肠400克&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;皇上皇金冠二八腊肠400克&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526091815_69131.jpg&quot; alt=&quot;&quot; /&gt;&lt;/span&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 17:18:18', null, '0');
INSERT INTO `wst_goods` VALUES ('18', '234234', 'wstmall 测试商品 肥羊肉片1000g', 'Upload/goods/2015-05/55643adeb9ba2.jpg', 'Upload/goods/2015-05/55643adeb9ba2.jpg', null, '11', '250.0', '200.0', '100213423', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '1', '1', null, '47', '64', '326', '19', '20', '&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp;&amp;nbsp;羊肉既能御风寒，又可补身体，对一般风寒咳嗽、慢性气管炎、虚寒哮喘、肾亏阳痿、腹部冷痛、体虚怕冷、腰膝酸软、面黄肌瘦、气血两亏、病后或产后身体虚亏等一切虚状均有治疗和补益效果，最适宜于冬季食用，故被称为冬令补品，深受人们欢迎。由于羊肉有一股令人讨厌的羊膻怪味，故被一部分人所冷落。其实，一公斤羊肉若能放入10克甘草和适量料酒、生姜一起烹调，即能够去其膻气而又可保持其羊肉风味。\n&lt;/p&gt;\n&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp;\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp;\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	营养分析：\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp; &amp;nbsp; &amp;nbsp;羊肉鲜嫩，营养价值高，凡肾阳不足、腰膝酸软、腹中冷痛、虚劳不足者皆可用它作食疗品。羊肉营养丰富，对肺结核、气管炎、哮喘、贫血、产后气血两虚、腹部冷痛、体虚畏寒、营养不良、腰膝酸软,阳痿早泄以及一切虚寒病症均有很大裨益；具有补肾壮阳、补虚温中等作用，男士适合经常食用。\n&lt;/div&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 17:20:49', null, '0');
INSERT INTO `wst_goods` VALUES ('19', '315314', 'wstmall 测试商品  瘦肉', 'Upload/goods/2015-05/55643b6b72f07.jpg', 'Upload/goods/2015-05/55643b6b72f07.jpg', null, '11', '50.0', '35.0', '5000', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '1', '1', null, '47', '64', '326', '19', '20', '&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;line-height:18px;background-color:#FFFFFF;&quot;&gt;瘦肉&lt;/span&gt;&lt;br /&gt;\n&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;line-height:18px;background-color:#FFFFFF;&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &amp;nbsp;瘦肉一般人说的瘦肉指猪，牛等家畜身上富含蛋白质的肉。&lt;/span&gt;&lt;br /&gt;\n&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;line-height:18px;background-color:#FFFFFF;&quot;&gt;功效&lt;/span&gt;&lt;br /&gt;\n&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;line-height:18px;background-color:#FFFFFF;&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &amp;nbsp;补肾养血、滋阴润燥&amp;nbsp;&lt;/span&gt;&lt;br /&gt;\n&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;line-height:18px;background-color:#FFFFFF;&quot;&gt;热病伤津、消渴羸瘦、肾虚体弱、产后血虚、燥咳、便秘、补虚、滋阴、润燥、滋肝阴，润肌肤、利二便、止消渴&lt;/span&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 17:23:13', null, '0');
INSERT INTO `wst_goods` VALUES ('20', '353523', 'wstmall 测试商品 冰鲜龙头鱼', 'Upload/goods/2015-05/556442e5a585a.jpg', 'Upload/goods/2015-05/556442e5a585a.jpg', null, '4', '60.0', '42.0', '20000', '0', '0', '0', '0', '斤', '斤', '1', '1', '1', '1', '1', '0', '1', null, '47', '65', '288', '28', '29', '&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	龙头鱼富含蛋白质，具有维持钾钠平衡；消除水肿。提高免疫力。调低血压 ，缓冲贫血，有利于生长发育。富含胆固醇，维持细胞的稳定性，\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	增加血管壁柔韧性。维持正常性功能，增加免疫力。富含镁，提高精子的活力，增强男性生育能力。有助于调节人的心脏活动，降低血压，\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	预防心脏病。调节神经和肌肉活动、增强耐久力。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	钙是骨骼发育的基本原料，直接影响身高；调节酶的活性；参与神经、肌肉的活动和神经递质的释放；调节激素的分泌；调节心律、降低心\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	血管的通透性；控制炎症和水肿；维持酸碱平衡等。富含钾，具有有助于维持神经健康、心跳规律正常，可以预防中风，并协助肌肉正常收\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	缩。具有降血压作用。富含磷，具有构成骨骼和牙齿，促进成长及身体组织器官的修复，供给能量与活力，参与酸碱平衡的调节。富含钠，\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	调节渗透压，维持酸碱平衡。维持血压正常。增强肌肉兴奋。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	适宜人群：适宜消瘦，免疫力低，记忆力下降贫血，水肿等症状的人群，生长发育停滞的儿童。中风、冠心病和糖尿病患者。出现肌肉无力、\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	抽筋、记忆力衰退、神经错乱、抑郁症、幻觉、心悸等症状的人群。厌食、偏食；不易入睡、易惊醒；易感冒；头发稀疏；智力发育迟缓；\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	学步、出牙晚或出牙不整齐；阵发性腹痛腹泻；X或O型腿；鸡胸的少年儿童。抽筋乏力；关节疼；头晕；贫血及产前高血压综合征；水肿及\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	乳汁分泌不足的孕妇及哺乳期妇女。骨痛；牙齿松动、脱落；驼背、食欲减退、消化道溃疡多梦、失眠、烦躁、易怒的老年人。甲状腺功能\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	亢进的人。高温、重体力劳动、经常出汗的人需要注意补充钠。\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 17:55:22', null, '0');
INSERT INTO `wst_goods` VALUES ('21', '14123', 'wstmall 测试商品 冰鲜鸡爪', 'Upload/goods/2015-05/5564433ac11dc.jpg', 'Upload/goods/2015-05/5564433ac11dc.jpg', null, '4', '34.0', '25.0', '5000', '0', '0', '0', '0', '斤', '斤', '1', '1', '1', '1', '1', '0', '0', null, '47', '66', '319', '9', '15', '&lt;p class=&quot;MsoNormal&quot; style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;span class=&quot;headline-content&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12pt;font-family:宋体;&quot;&gt;泡椒凤爪&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;span style=&quot;font-family:宋体;&quot;&gt;是近年来最为流行的&lt;/span&gt;小吃之一。以麻辣有滋、皮韧肉香而著称。泡椒凤爪既能登大雅之堂，也为普通老百姓所喜爱。此款美食具有开胃生津、促进血液循环的功效。制作过程比较讲究，这样才能使泡椒的劲辣味道沁入凤爪中。正宗的泡椒凤爪丰满洁白，咀嚼时骨肉生香，具有很强的催味功效。&lt;span&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p class=&quot;MsoNormal&quot; style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;span class=&quot;headline-content&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12pt;font-family:宋体;&quot;&gt;制作方法：&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;span class=&quot;headline-content&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:12pt;&quot;&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;text-indent:22.5pt;&quot;&gt;\n	&lt;span style=&quot;font-family:宋体;&quot;&gt;凤爪洗净去指甲对半切开。先在开水里氽过去腥气。换水，在水中放入葱姜片，黄酒，花椒，八角和适量盐，将凤爪放入，上火烧开，中小火闷煮&lt;/span&gt;&lt;span style=&quot;font-family:Arial;&quot;&gt;15-20&lt;/span&gt;&lt;span style=&quot;font-family:宋体;&quot;&gt;分钟。喜欢脆的就&lt;/span&gt;&lt;span style=&quot;font-family:Arial;&quot;&gt;15&lt;/span&gt;&lt;span style=&quot;font-family:宋体;&quot;&gt;分钟，喜欢口感软些的就&lt;/span&gt;&lt;span style=&quot;font-family:Arial;&quot;&gt;20&lt;/span&gt;&lt;span style=&quot;font-family:宋体;&quot;&gt;分钟。&lt;/span&gt;&lt;span style=&quot;font-family:Arial;&quot;&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;text-indent:22.5pt;&quot;&gt;\n	&lt;span style=&quot;font-family:宋体;&quot;&gt;准备一个够大的带盖冰箱盛器，将一瓶泡山椒里的液体全部倒入，也就一点点，放入部分泡椒，喜辣的多放，放大约&lt;/span&gt;&lt;span style=&quot;font-family:Arial;&quot;&gt;1/5&lt;/span&gt;&lt;span style=&quot;font-family:宋体;&quot;&gt;。加饮用水至盛器的一半，加入白醋，白糖，盐，料酒调味。&lt;/span&gt;&lt;span style=&quot;font-family:Arial;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-family:宋体;&quot;&gt;味道要足，按个人喜好偏酸偏甜自己掌握，但要够咸，否则不入味。放些花椒和一个八角，几个厚姜片，有助于去腥提味。&lt;/span&gt;&lt;span style=&quot;font-family:Arial;&quot;&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;text-indent:22.5pt;&quot;&gt;\n	&lt;span style=&quot;font-family:宋体;&quot;&gt;凤爪出锅后投入凉水中冷透，可以多过几遍水去油。然后放入对好的泡椒水里，要能够被汁液浸透。盖上盖子，放入冰箱。泡两天后拿出来挑出凤抓和泡椒就可以了！&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 17:56:57', null, '0');
INSERT INTO `wst_goods` VALUES ('22', '345235', 'wstmall 测试商品 冰鲜鱿鱼', 'Upload/goods/2015-05/5564441acf878.jpg', 'Upload/goods/2015-05/5564441acf878.jpg', null, '4', '234.0', '231.0', '2132134', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '0', '0', null, '47', '66', '319', '28', '29', '&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	鱿鱼&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp; 鱿鱼属软体动物类，是乌贼的一种。目前市场看到的鱿鱼有两种：一种是躯干部较肥大的鱿鱼，它的名称叫“枪乌贼”；一种是躯干部细长的鱿鱼，它的名称叫“柔鱼”，小的柔鱼俗名叫“小管仔”。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	功效&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp; 益气壮志, 通妇女月经, 入肝补血, 入肾可滋水强志, 滋阴养胃, 补虚润肤。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526100008_84465.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 18:00:11', null, '0');
INSERT INTO `wst_goods` VALUES ('23', '34535', 'wstmall 测试商品 冰鲜鲈鱼', 'Upload/goods/2015-05/556448ac442c6.jpg', 'Upload/goods/2015-05/556448ac442c6.jpg', null, '4', '234.0', '123.0', '123234', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '0', '0', null, '47', '65', '288', '28', '29', '&lt;strong&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	鲈鱼&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp; 鲈鱼肉质白嫩、清香，没有腥味，肉为蒜瓣形，最宜清蒸、红烧或炖汤。尤其是秋末冬初，成熟的鲈鱼特别肥美，鱼体内积累的营养物质也最丰富，所以是吃鱼的最好时令。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	鲈鱼的功效&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp; 健脾,补气,益肾,安胎,补血。\n&lt;/p&gt;\n&lt;/strong&gt;\n&lt;p&gt;\n	&lt;strong&gt;&lt;br /&gt;\n&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;&lt;br /&gt;\n&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;&lt;/strong&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 18:02:10', null, '0');
INSERT INTO `wst_goods` VALUES ('24', '6546', 'wstmall测试商品 冰鲜深海金鲳鱼约500g', 'Upload/goods/2015-05/556444c931a82.jpg', 'Upload/goods/2015-05/556444c931a82.jpg', null, '4', '2422.0', '1233.0', '0', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '0', '0', null, '47', '65', '292', '28', '29', '&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	金鲳鱼&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp; 金鲳鱼，又叫平鱼。是一种身体扁平的海鱼，因其刺少肉嫩，故很受人们喜爱，它富含高蛋白、不饱和脂肪酸和多种微量元素。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	功效&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp; 益气养血, 补胃益精, 滑利关节, 柔筋利骨。\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526100545_57518.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 18:05:23', null, '0');
INSERT INTO `wst_goods` VALUES ('25', '345234', 'wstmall 测试商品 大闸蟹', 'Upload/goods/2015-05/556445fe8e57d.jpg', 'Upload/goods/2015-05/556445fe8e57d.jpg', null, '4', '123.0', '100.0', '554313', '0', '0', '0', '0', '只', '', '1', '1', '1', '1', '1', '0', '0', null, '47', '65', '290', '28', '30', '&lt;p&gt;\n	&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;大闸蟹&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:18px;font-weight:bold;line-height:40px;background-color:#FFFFFF;&quot;&gt;\n	&lt;p style=&quot;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n		中华绒螯蟹又称河蟹、毛蟹、清水蟹、大闸蟹或螃蟹，味道鲜美，营养丰富。\n	&lt;/p&gt;\n	&lt;div style=&quot;margin:0px auto;padding:0px;color:#404040;font-family:宋体, Verdana, Arial;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n		&amp;nbsp;\n	&lt;/div&gt;\n&lt;img src=&quot;/product/wstmall/Upload/image/20150526/20150526100818_71751.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 18:08:21', null, '0');
INSERT INTO `wst_goods` VALUES ('26', '2342', 'wstmall 测试商品 花蛤', 'Upload/goods/2015-05/556446e328d34.jpg', 'Upload/goods/2015-05/556446e328d34.jpg', null, '4', '54.0', '45.0', '5000', '0', '0', '0', '0', '千克', '千克', '1', '1', '1', '1', '1', '0', '0', null, '47', '65', '288', '28', '30', '食疗功效&lt;br /&gt;\n&lt;br /&gt;\n花蛤肉味鲜美、营养丰富，蛋白质含量高，氨基酸的种类组成及配比合理； 脂肪含量低，不饱和脂肪酸较高，易被人体消化吸收，还有各种维生素和药用成分。含钙、镁、铁、锌等多种人体必需的微量元素，可作为人类的营养、绿色食品，深受消费者的青睐。蛤肉以及贝类软体动物中，含一种具有降低血清胆固醇作用的代尔太7—胆固醇和24—亚甲基胆固醇，它们兼有抑制胆固醇在肝脏合成和加速排泄胆固醇的独特作用，从而使体内胆固醇下降。它们的功效比常用的降胆固醇的药物谷固醇更强。人们在食用蛤肉和贝类食物后，常有一种清爽宜人的感觉，这对解除一些烦恼症状无疑是有益的。中医认为，蛤肉有滋阴明目、软坚、化痰之功效，有的贝类还有益精润脏的作用。所有人都可以吃。高胆固醇、高血脂体质的人以及患有甲状腺肿大、支气管炎、胃病等疾病的人尤为适合。&lt;br /&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 18:12:52', null, '0');
INSERT INTO `wst_goods` VALUES ('27', '293874', 'KDT170心相印厨房纸巾70抽吸油去污 吸水锁水', 'Upload/goods/2015-05/55647ca720f9e.jpg', 'Upload/goods/2015-05/55647ca720f9e.jpg', null, '14', '23.0', '19.0', '123345', '0', '0', '0', '0', '提', '4提12包', '1', '1', '1', '1', '1', '1', '0', null, '48', '74', '262', '32', '39', '&lt;h1 style=&quot;color:#333333;text-indent:0px;font-family:微软雅黑;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	KDT170心相印厨房纸巾70抽吸油去污 吸水锁水抽纸4提套装\n&lt;/h1&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#E53333;&quot;&gt;测试商品，请勿下单&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526140202_57724.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 22:02:42', null, '0');
INSERT INTO `wst_goods` VALUES ('28', '3947829', '奥妙净蓝全效无磷洗衣粉500g/汰渍全效洗衣粉', 'Upload/goods/2015-05/556480e66c840.jpg', 'Upload/goods/2015-05/556480e66c840.jpg', null, '14', '15.0', '12.5', '9003', '0', '0', '0', '0', '包', '', '1', '1', '1', '1', '1', '1', '0', null, '48', '258', '329', '34', '41', '&lt;p&gt;\n	测试商品 请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526141901_86734.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 22:19:27', null, '0');
INSERT INTO `wst_goods` VALUES ('29', '3598', 'wstmall测试商品 汰渍 净白去渍无磷洗衣粉', 'Upload/goods/2015-05/5564818910da2.jpg', 'Upload/goods/2015-05/5564818910da2.jpg', null, '14', '25.0', '20.0', '123242', '0', '0', '0', '0', '包', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '258', '329', '34', '41', '&lt;p&gt;\n	wstmall测试商品\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526142311_19107.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 22:23:30', null, '0');
INSERT INTO `wst_goods` VALUES ('30', '347294', '奥妙洗衣粉净500g*3袋', 'Upload/goods/2015-05/55648222cc241.jpg', 'Upload/goods/2015-05/55648222cc241.jpg', null, '14', '30.0', '27.0', '239473', '0', '0', '0', '0', '组', '3袋为一组', '1', '1', '1', '1', '1', '1', '0', null, '48', '258', '329', '34', '41', '&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;&lt;span style=&quot;color:#E53333;font-size:16px;&quot;&gt;wstmall测试商品，请勿下单&lt;/span&gt;&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526142518_93795.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 22:25:42', null, '0');
INSERT INTO `wst_goods` VALUES ('31', '2347982', '洗衣氧颗粒浓缩型600g+多功能洗涤氧颗粒600g', 'Upload/goods/2015-05/556485b17d4cb.jpg', 'Upload/goods/2015-05/556485b17d4cb.jpg', null, '14', '24.0', '21.0', '24234', '0', '0', '0', '0', '组', '2包为一组', '1', '1', '1', '1', '1', '0', '0', null, '48', '258', '329', '34', '41', '&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;&lt;span style=&quot;color:#E53333;font-size:16px;&quot;&gt;wstmall测试商品，请勿下单&lt;/span&gt;&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526144047_49784.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 22:41:14', null, '0');
INSERT INTO `wst_goods` VALUES ('32', '345345', '得宝纸巾软抽餐巾纸组合套装4提抽纸共12包', 'Upload/goods/2015-05/55648d1d30566.jpg', 'Upload/goods/2015-05/55648d1d30566.jpg', null, '14', '88.0', '77.0', '234789', '0', '0', '0', '0', '组', '4提抽纸共12包', '1', '1', '1', '1', '1', '1', '0', null, '48', '74', '262', '32', '39', '&lt;p&gt;\n	4提抽纸共12包\n&lt;/p&gt;\n&lt;p&gt;\n	测试商品 请勿下单&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526151135_88373.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 23:11:37', null, '0');
INSERT INTO `wst_goods` VALUES ('33', '2347982', '维达卷纸3提蓝色经典卷筒纸家用大卷纸200g', 'Upload/goods/2015-05/55648dc7335f0.jpg', 'Upload/goods/2015-05/55648dc7335f0.jpg', null, '14', '220.0', '198.0', '234879', '0', '0', '0', '0', '箱', '整箱', '1', '1', '1', '1', '1', '0', '0', null, '48', '74', '262', '32', '39', '&lt;p&gt;\n	wstmall测试商品，卷纸\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	请勿下单\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 23:15:19', null, '0');
INSERT INTO `wst_goods` VALUES ('34', '294387', '维达卷筒纸蓝色经典卫生纸家庭装卷纸柔韧140g*3', 'Upload/goods/2015-05/55648f06c76e2.jpg', 'Upload/goods/2015-05/55648f06c76e2.jpg', null, '14', '98.0', '92.0', '234928', '0', '0', '0', '0', '组', '3提为一组', '1', '1', '1', '1', '1', '1', '0', null, '48', '74', '262', '32', '39', '&lt;p&gt;\n	&lt;span style=&quot;color:#E53333;font-size:16px;&quot;&gt;wstmall测试商品&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526152022_21285.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 23:20:45', null, '0');
INSERT INTO `wst_goods` VALUES ('35', '234979', '泉林本色纸巾 不漂白原浆面巾纸卫生纸 14*240', 'Upload/goods/2015-05/55649029417c3.jpg', 'Upload/goods/2015-05/55649029417c3.jpg', null, '14', '65.0', '58.9', '87689', '0', '0', '0', '0', '箱', '“买20卷加送四卷，加量不加价” 泉林本色是国内唯一食品级安全用纸 真正无添加 可以吃的纸', '1', '1', '1', '1', '1', '0', '0', null, '48', '74', '262', '32', '39', '&lt;p&gt;\n	&lt;span style=&quot;font-size:16px;&quot;&gt;测试商品 请勿下单&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526152551_15660.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-26 23:26:12', null, '0');
INSERT INTO `wst_goods` VALUES ('36', '329874', '维达蓝色经典140g卫生卷纸共20卷 卷筒卫生纸', 'Upload/goods/2015-05/55649c4137436.jpg', 'Upload/goods/2015-05/55649c4137436.jpg', null, '14', '89.0', '69.0', '3248', '0', '0', '0', '0', '组', '20卷为一组', '1', '1', '1', '1', '1', '1', '0', null, '48', '74', '262', '32', '39', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526161704_71372.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 00:17:21', null, '0');
INSERT INTO `wst_goods` VALUES ('37', '3749', '维达150抽家用纸巾餐巾纸 抽纸巾 加厚 15包', 'Upload/goods/2015-05/55649d4fc27fc.jpg', 'Upload/goods/2015-05/55649d4fc27fc.jpg', null, '14', '78.0', '69.0', '58943', '0', '0', '0', '0', '组', '15包一组', '1', '1', '1', '1', '1', '1', '0', null, '48', '74', '75', '32', '40', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526162119_90595.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 00:21:23', null, '0');
INSERT INTO `wst_goods` VALUES ('38', '34789', '心相印特柔纸巾三层140g卷筒卫生纸卷纸 五提/组', 'Upload/goods/2015-05/55649dcd962a0.jpg', 'Upload/goods/2015-05/55649dcd962a0.jpg', null, '14', '150.0', '138.0', '237489', '0', '0', '0', '0', '组', '五提/组', '1', '1', '1', '1', '1', '0', '0', null, '48', '74', '262', '32', '39', '&lt;p&gt;\n	&lt;span style=&quot;color:#E53333;&quot;&gt;wstmall测试商品，请勿下单&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#E53333;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#E53333;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526162331_10164.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 00:23:33', null, '0');
INSERT INTO `wst_goods` VALUES ('39', '23794', 'B1-0284超威洁厕精1+1洁厕500g2瓶', 'Upload/goods/2015-05/5564a125c1e50.jpg', 'Upload/goods/2015-05/5564a125c1e50.jpg', null, '14', '26.0', '19.0', '2348', '0', '0', '0', '0', '组', '2瓶一组', '1', '1', '1', '1', '1', '0', '0', null, '48', '258', '274', '31', '38', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526163005_26619.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 00:30:07', null, '0');
INSERT INTO `wst_goods` VALUES ('40', '237894', '迪可浓洁厕宝马桶自动清洁剂（2个装）2*50g', 'Upload/goods/2015-05/55649fe956459.jpg', 'Upload/goods/2015-05/55649fe956459.jpg', null, '14', '56.0', '47.0', '34923', '0', '0', '0', '0', '包', '2个为一包', '1', '1', '1', '1', '1', '1', '0', null, '48', '258', '274', '31', '38', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150526/20150526163229_89010.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 00:32:32', null, '0');
INSERT INTO `wst_goods` VALUES ('41', '3249', 'wstmall测试商品 洁厕灵', 'Upload/goods/2015-05/5564a40b42496.jpg', 'Upload/goods/2015-05/5564a40b42496.jpg', null, '14', '19.0', '15.0', '23422', '0', '0', '0', '0', '瓶', '', '1', '1', '1', '0', '1', '0', '0', null, '48', '258', '274', '31', '38', '&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&lt;span style=&quot;color:#666666;font-family:SimSun;font-size:16px;&quot;&gt;品名：加多洁洁厕灵&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&lt;span style=&quot;color:#666666;font-family:SimSun;font-size:16px;&quot;&gt;品牌：加多洁&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&lt;span style=&quot;color:#666666;font-family:SimSun;font-size:16px;&quot;&gt;产地：湖北&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&lt;span style=&quot;color:#666666;font-family:SimSun;font-size:16px;&quot;&gt;生产厂商：湖北铭高商贸有限公司&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&lt;span style=&quot;color:#666666;font-family:SimSun;font-size:16px;&quot;&gt;净含量： 500ml/瓶&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&lt;span style=&quot;color:#666666;font-family:SimSun;font-size:16px;&quot;&gt;生产日期：近期&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&lt;span style=&quot;color:#666666;font-family:SimSun;font-size:16px;&quot;&gt;保质期：3年&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&lt;br /&gt;\n&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&amp;nbsp;&lt;span style=&quot;color:#666666;font-family:SimSun;font-size:16px;&quot;&gt;强力去污：添加强力去垢因子，轻松去除尿渍、污渍等。&lt;br /&gt;\n快速除菌：高效杀菌成分，快速清除隐藏在厕盆内的细菌。&lt;br /&gt;\n清香辟味：气味清香，迅速辟味。&lt;br /&gt;\n压力喷嘴：方便将液体挤射到难以清洗的暗沟，清洁更轻松&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p align=&quot;left&quot; style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&lt;span style=&quot;color:#666666;font-family:SimSun;font-size:16px;&quot;&gt;将洁厕液挤射到厕盆内壁四周及边缘暗沟，10分钟后冲水即净，对顽固污渍可适当延长时间或用刷子轻刷。&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p align=&quot;left&quot; style=&quot;color:#666666;text-indent:0px;&quot;&gt;\n	&lt;span style=&quot;color:#666666;font-family:SimSun;font-size:16px;&quot;&gt;1、勿让儿童接触；&lt;br /&gt;\n2、勿与漂白剂等化学品混用；&lt;br /&gt;\n3、避免清洁液接触皮肤或眼部，触及后即用清水冲洗。&lt;br /&gt;\n4、勿用于金属表面和非陶瓷器具。&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 00:40:55', null, '0');
INSERT INTO `wst_goods` VALUES ('42', '237948', '威猛先生 强效洁厕液双包装 优惠套装 去污 500', 'Upload/goods/2015-05/5564a29f169b7.jpg', 'Upload/goods/2015-05/5564a29f169b7.jpg', null, '14', '234.0', '123.0', '234', '0', '0', '0', '0', '组', '2瓶一组', '1', '1', '1', '1', '1', '0', '0', null, '48', '258', '274', '31', '45', '&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	商品特色：\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	采用欧洲先进技术，彻底清洁，且不伤马桶表面，有效去除异味，用后留下清新气味。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	第一款会变色的洁厕液！洁厕液溶解污垢后，酸碱中和，洁厕液从绿变蓝。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	适用范围：\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	座式或者蹲式马桶。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	使用方法：\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	翻起厕盆盖。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	倾倒瓶身，使液体充满瓶颈。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	沿水位线轻刷厕盆，用水冲净。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	如需对付顽固污垢，轻刷厕盆后，可静待片刻再用水冲净。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	定期使用可保持您的厕盆清洁卫生，防止顽垢形成。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	注意事项：\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	请勿接触眼睛。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	请勿吞食。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	请放置在儿童和宠物不易接触的地方。\n&lt;/div&gt;\n&lt;div style=&quot;margin:0px;padding:0px;color:#404040;&quot;&gt;\n	切勿与漂白剂或者其他化学品一同使用，以免产生有害气体。\n&lt;/div&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 00:43:57', null, '0');
INSERT INTO `wst_goods` VALUES ('43', '4535', '七度香 清香型（消正） 铁观音 250g书型硬盒装', 'Upload/goods/2015-05/556529ba1430c.jpg', 'Upload/goods/2015-05/556529ba1430c.jpg', null, '18', '234.0', '114.0', '24235', '0', '0', '0', '0', '克', '采摘季节：春茶\n香型：清香型\n工艺：袋泡茶\n茶叶等级：二级\n产地：安溪祥华\n规格：7.8g*32泡\n保质期：18个月\n储藏方法：阴凉干燥', '1', '1', '1', '1', '1', '1', '0', null, '49', '80', '303', '52', '53', '&lt;p&gt;\n	wstmall 测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527022049_79636.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 10:21:10', null, '0');
INSERT INTO `wst_goods` VALUES ('44', '45335', '正品八马 安溪铁观音 浓香型 特级赛珍珠1000', 'Upload/goods/2015-05/55652b3d68f16.jpg', 'Upload/goods/2015-05/55652b3d68f16.jpg', null, '18', '344.0', '233.0', '24335', '0', '0', '0', '0', '包', '采摘季节：春茶\n香型：浓香型\n工艺：袋泡茶\n功效：消肉食，逐风痰，泄热，解毒，生津，止渴。\n茶叶等级：特级\n产地：福建安溪\n规格：8.35克/泡×15泡/盒×2盒 礼盒规格：32*32*8.5\n保质期：24个月\n储藏方法：防潮湿，防异味，避光直射', '1', '1', '1', '1', '1', '1', '0', null, '49', '80', '303', '52', '53', '&lt;p&gt;\n	WSTMALL测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527022710_93237.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 10:27:48', null, '0');
INSERT INTO `wst_goods` VALUES ('45', 'HS546464', '新疆哈密瓜', 'Upload/goods/2015-05/55652d139de45.jpg', 'Upload/goods/2015-05/55652d139de45.jpg', null, '4', '30.0', '20.0', '1000', '0', '0', '0', '0', 'Kg', '件', '0', '1', '1', '1', '1', '0', '0', null, '47', '61', '76', '7', '8', '商品描述', '0', '0', '0', '0', '1', null, '1', '2015-05-27 10:34:02', null, '0');
INSERT INTO `wst_goods` VALUES ('46', '3516354', '正品八马 安溪铁观音 清香型 特级韵香 250g', 'Upload/goods/2015-05/55652d25a41b7.jpg', 'Upload/goods/2015-05/55652d25a41b7.jpg', null, '18', '500.0', '250.0', '35436546', '0', '0', '0', '0', '盒', '采摘季节：春茶\n香型：清香型\n工艺：袋泡茶\n功效：提神消疲，降脂减肥，清热解暑，醒酒敌烟，抗衰老抗辐射\n茶叶等级：特级\n产地：福建安溪\n规格：8.35g*30泡 礼盒32cm*22cm*8.2cm\n保质期：18个月\n储藏方法：防潮湿，防异味，避光直射', '1', '1', '1', '1', '1', '1', '0', null, '49', '80', '303', '52', '53', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527023540_32730.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 10:35:47', null, '0');
INSERT INTO `wst_goods` VALUES ('47', '359783', '正宗安溪铁观音 清香型特级QGY1296-250g', 'Upload/goods/2015-05/55652db0d98c7.jpg', 'Upload/goods/2015-05/55652db0d98c7.jpg', null, '18', '633.0', '522.0', '537464', '0', '0', '0', '0', '盒', '配料：安溪铁观音\n采摘季节：春茶\n香型：清香型\n工艺：袋泡茶\n功效：消肉食，逐风痰，泄热，解毒，生津，止渴。\n茶叶等级：特级\n产地：福建省安溪县\n规格：33x11x6.5cm 7.8g/泡x32泡\n保质期：18个月', '1', '1', '1', '1', '1', '1', '0', null, '49', '80', '303', '52', '53', '&lt;p&gt;\n	测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527023942_44266.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 10:37:39', null, '0');
INSERT INTO `wst_goods` VALUES ('48', '23498723', '五十五年老茶师精制 最传统最地道的铁观音', 'Upload/goods/2015-05/55652e10dc119.jpg', 'Upload/goods/2015-05/55652e10dc119.jpg', null, '18', '345.0', '345.0', '24235255', '0', '0', '0', '0', '盒', '配料：安溪铁观音\n采摘季节：春茶\n香型：清香型\n工艺：袋泡茶\n功效：提神消疲，降脂减肥，生津止渴\n茶叶等级：特级', '1', '1', '1', '1', '1', '0', '0', null, '49', '80', '303', '52', '53', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527023924_65464.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 10:39:01', null, '0');
INSERT INTO `wst_goods` VALUES ('49', '234235', '正宗安溪铁观音 清香型特级469g 典藏礼盒', 'Upload/goods/2015-05/5565309d7b672.jpg', 'Upload/goods/2015-05/5565309d7b672.jpg', null, '18', '435.0', '345.0', '345456', '0', '0', '0', '0', '盒', '采摘季节：春茶\n香型：清香型\n工艺：袋泡茶\n茶叶等级：特级\n产地：福建省安溪感德\n规格：15泡/罐\n保质期：18个月', '1', '1', '1', '1', '1', '0', '0', null, '49', '80', '303', '52', '53', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527025006_15369.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 10:50:10', null, '0');
INSERT INTO `wst_goods` VALUES ('50', '534435', '世博第一名茶 八马力荐巅峰制作 商政礼品茶', 'Upload/goods/2015-05/55653369c81f3.jpg', 'Upload/goods/2015-05/55653369c81f3.jpg', null, '18', '566.0', '455.0', '235345', '0', '0', '0', '0', '盒', '采摘季节：春茶\n香型：浓香型\n工艺：袋泡茶\n功效：提神消疲，降脂减肥，清热解暑，醒酒敌烟，抗衰老抗辐射\n茶叶等级：特级\n食品生产许可证：闽卫食证字（2007）第350524008273号\n产地：福建安溪\n规格：125克/罐×2罐 礼盒规格：30cm×21cm\n保质期：18个月', '1', '1', '1', '1', '1', '0', '0', null, '49', '80', '303', '52', '53', '&lt;p&gt;\n	wstmall测试商品，请勿上架\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527030203_36573.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 11:02:06', null, '0');
INSERT INTO `wst_goods` VALUES ('51', '30945390', '安溪铁观音 韵香型（炭焙） 特级 234g 禅悦竹', 'Upload/goods/2015-05/55653554971db.jpg', 'Upload/goods/2015-05/55653554971db.jpg', null, '18', '455.0', '422.0', '375465', '0', '0', '0', '0', '盒', '采摘季节：秋茶\n香型：韵香型\n工艺：袋泡茶\n功效：提神消疲，降脂减肥，清热解暑，醒酒敌烟，抗衰老抗辐射\n茶叶等级：特级\n食品生产许可证：QS3502 1401 0650\n产地：安溪\n规格：7.8g/包*30包\n保质期：36个月', '1', '1', '1', '1', '1', '0', '0', null, '49', '80', '303', '52', '53', '&lt;p&gt;\n	wstmall 测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527031023_22804.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 11:10:28', null, '0');
INSERT INTO `wst_goods` VALUES ('52', '3536', '52°泸州老窖醇香2A 500ml*4', 'Upload/goods/2015-05/55653991385af.jpg', 'Upload/goods/2015-05/55653991385af.jpg', null, '19', '342.0', '234.0', '435345', '0', '0', '0', '0', '箱', '4瓶为一箱', '1', '1', '1', '1', '1', '0', '0', null, '49', '78', '293', '54', '61', '&lt;p&gt;\n	&lt;span style=&quot;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:12px;line-height:24px;background-color:#FFFFFF;&quot;&gt;根据新修订的《商标法》及国家工商总局最新文件要求，2014年5月1日之后不得将“驰名商标”字样用于商品宣传，wstmall依法对商品图片中含“驰名商标”字样做马赛克处理；同时，涉及厂家正在按照新规定逐步更换包装，在此期间，我们将对新旧包装货品随机发货，请以实际收到的货物为准。&lt;/span&gt; \n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:12px;line-height:24px;background-color:#FFFFFF;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt; \n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;font-size:12px;line-height:24px;background-color:#FFFFFF;&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527032840_33219.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/span&gt; \n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 11:28:43', null, '0');
INSERT INTO `wst_goods` VALUES ('53', '4646456', '爱洛依丝酒类联盟 阿根廷原瓶进口红酒 维特红葡萄酒', 'Upload/goods/2015-05/55653e240b326.jpg', 'Upload/goods/2015-05/55653e240b326.jpg', null, '19', '123.0', '89.0', '345345', '0', '0', '0', '0', '瓶', '瓶', '1', '1', '1', '1', '1', '0', '0', null, '49', '78', '294', '55', '62', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527034737_22137.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 11:47:40', null, '0');
INSERT INTO `wst_goods` VALUES ('54', '342535', '张裕干红酿酒师系列巴狄多奇美乐红酒葡萄酒整箱', 'Upload/goods/2015-05/55653f2249b3d.jpg', 'Upload/goods/2015-05/55653f2249b3d.jpg', null, '19', '566.0', '366.0', '3453563', '0', '0', '0', '0', '箱', '6瓶一箱', '1', '1', '1', '1', '1', '1', '0', null, '49', '78', '294', '55', '64', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527035247_51141.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 11:52:49', null, '0');
INSERT INTO `wst_goods` VALUES ('55', '345354', '拉菲传说波尔多AOC干红葡萄酒 瓶装红酒 法国原装', 'Upload/goods/2015-05/55653ff51c0a3.jpg', 'Upload/goods/2015-05/55653ff51c0a3.jpg', null, '19', '345.0', '234.0', '23425', '0', '0', '0', '0', '瓶', '', '1', '1', '1', '1', '1', '0', '0', null, '49', '78', '294', '55', '62', '&lt;p&gt;\n	wstmall测试商品 请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527035508_32510.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 11:55:10', null, '0');
INSERT INTO `wst_goods` VALUES ('56', '6846541', '长城葡萄酒 中粮长城黑标解百纳干红葡萄酒 长城解百', 'Upload/goods/2015-05/556540f9b9d83.jpg', 'Upload/goods/2015-05/556540f9b9d83.jpg', null, '19', '123.0', '89.0', '35325', '0', '0', '0', '0', '瓶', '储藏方法：避光卧放保质期：3650 天食品添加剂：焦亚硫酸钾品牌: Great Wall/长城系列: 长城黑标干红套装规格: 单支', '1', '1', '1', '1', '1', '1', '0', null, '49', '78', '294', '55', '64', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527035956_53077.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 12:00:08', null, '0');
INSERT INTO `wst_goods` VALUES ('57', '345234', '长城葡萄酒 中粮长城特制宝石解百纳干红 750ml', 'Upload/goods/2015-05/55654198066e7.jpg', 'Upload/goods/2015-05/55654198066e7.jpg', null, '19', '455.0', '432.0', '23435', '0', '0', '0', '0', '瓶', '保质期：3650 天食品添加剂：焦亚硫酸钾品牌: Great Wall/长城系列: 长城特制宝石解百纳套装规格: 单支', '1', '1', '1', '1', '1', '1', '0', null, '49', '78', '294', '55', '64', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527040229_68375.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 12:02:44', null, '0');
INSERT INTO `wst_goods` VALUES ('58', '684564', '长城干红葡萄酒 特酿三年解百纳红酒750ml*6支', 'Upload/goods/2015-05/556542738dc8f.jpg', 'Upload/goods/2015-05/556542738dc8f.jpg', null, '19', '566.0', '411.0', '85321', '0', '0', '0', '0', '箱', '储藏方法：避光、卧放保质期：3650 天食品添加剂：焦亚硫酸钾品牌: Great Wall/长城系列: 特酿3年解百纳干红套装规格: 整箱', '1', '1', '1', '1', '1', '0', '0', null, '49', '78', '294', '55', '64', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527040604_98645.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 12:06:06', null, '0');
INSERT INTO `wst_goods` VALUES ('59', '354654', '正品拉菲红酒 法国原瓶进口拉菲珍藏波尔多干红葡萄酒', 'Upload/goods/2015-05/5565431b14689.jpg', 'Upload/goods/2015-05/5565431b14689.jpg', null, '19', '233.0', '133.0', '5345345', '0', '0', '0', '0', '箱', '2瓶一箱', '1', '1', '1', '1', '1', '1', '0', null, '49', '78', '294', '55', '62', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527040848_71528.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 12:08:50', null, '0');
INSERT INTO `wst_goods` VALUES ('60', '234234', '楼兰蜜语新疆特产零食小吃大枣红枣和田枣500g玉枣', 'Upload/goods/2015-05/55656eaf4c368.jpg', 'Upload/goods/2015-05/55656eaf4c368.jpg', null, '22', '42.0', '38.0', '234224', '0', '0', '0', '0', '包', '500g', '1', '1', '1', '1', '1', '1', '0', null, '50', '219', '226', '76', '77', '&lt;p style=&quot;color:#3F3F3F;font-family:simsun;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	规格：500g/袋\n&lt;/p&gt;\n&lt;p style=&quot;color:#3F3F3F;font-family:simsun;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	产地：新疆维吾尔自治区和田地区&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527071518_35812.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#3F3F3F;font-family:simsun;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	功能：休闲零食&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#3F3F3F;font-family:simsun;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	食用方法：开袋即食\n&lt;/p&gt;\n&lt;p style=&quot;color:#3F3F3F;font-family:simsun;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	贮存方法：常温、密封保存\n&lt;/p&gt;\n&lt;p style=&quot;color:#3F3F3F;font-family:simsun;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	适用人群：老少、男女皆宜\n&lt;/p&gt;\n&lt;p style=&quot;color:#3F3F3F;font-family:simsun;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#3F3F3F;font-family:simsun;font-size:12px;background-color:#FFFFFF;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 15:15:35', null, '0');
INSERT INTO `wst_goods` VALUES ('61', '234234', '良品铺子 若羌灰枣415g 新疆一级正宗红枣 皮薄', 'Upload/goods/2015-05/556570158edfd.jpg', 'Upload/goods/2015-05/556570158edfd.jpg', null, '22', '35.0', '30.0', '345345', '0', '0', '0', '0', '包', '', '1', '1', '1', '1', '1', '0', '0', null, '50', '219', '226', '76', '77', '&lt;h1 style=&quot;font-size:16px;font-family:\'microsoft yahei\';background-color:#FFFFFF;&quot;&gt;\n	良品铺子 若羌灰枣415g 新疆一级正宗红枣 皮薄核小\n&lt;/h1&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527072039_39624.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 15:20:42', null, '0');
INSERT INTO `wst_goods` VALUES ('62', '235345', '西域良品 若羌灰枣特级红枣500g 新疆枣子干', 'Upload/goods/2015-05/556570f099cf0.jpg', 'Upload/goods/2015-05/556570f099cf0.jpg', null, '22', '56.0', '50.0', '235345', '0', '0', '0', '0', '包', '', '1', '1', '1', '1', '1', '1', '0', null, '50', '219', '226', '76', '77', '&lt;h1 style=&quot;font-size:16px;font-family:\'microsoft yahei\';background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp;西域良品 若羌灰枣特级红枣500g 新疆枣子 干果零食\n&lt;/h1&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527072501_44552.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 15:25:04', null, '0');
INSERT INTO `wst_goods` VALUES ('63', '34523', '双汇火腿肠Q趣孜然味火腿肠85g 特产零食品香肠', 'Upload/goods/2015-05/556572b570dcf.jpg', 'Upload/goods/2015-05/556572b570dcf.jpg', null, '22', '23.0', '18.0', '234252', '0', '0', '0', '0', '包', '规格：85g/支\n产地：河南\n保质期：90天', '1', '1', '1', '1', '1', '0', '0', null, '50', '223', '330', '75', '81', '&lt;h1 style=&quot;font-size:16px;font-family:\'microsoft yahei\';background-color:#FFFFFF;&quot;&gt;\n	双汇火腿肠Q趣孜然味火腿肠85g 特产零食品香肠 小吃\n&lt;/h1&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527073159_54890.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 15:32:05', null, '0');
INSERT INTO `wst_goods` VALUES ('64', '234234', '双汇火腿肠王中王骨香风味30g*9支肉类零食香肠小', 'Upload/goods/2015-05/55657483bf521.jpg', 'Upload/goods/2015-05/55657483bf521.jpg', null, '22', '23.0', '21.0', '234234', '0', '0', '0', '0', '袋', '规格：30g*9支/袋', '1', '1', '1', '1', '1', '1', '0', null, '50', '223', '330', '75', '81', '&lt;p style=&quot;color:#404040;font-family:tahoma, arial, 宋体, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\n	规格：30g*9支/袋\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:tahoma, arial, 宋体, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\n	产地：中国大陆\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:tahoma, arial, 宋体, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\n	保质期：180天\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:tahoma, arial, 宋体, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\n	新老包装随机发货\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:tahoma, arial, 宋体, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#404040;font-family:tahoma, arial, 宋体, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527073942_46153.png&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 15:39:58', null, '0');
INSERT INTO `wst_goods` VALUES ('65', '34535', '统一100 红烧牛肉面 103g*5包/袋 方便面', 'Upload/goods/2015-05/5565762b886fa.jpg', 'Upload/goods/2015-05/5565762b886fa.jpg', null, '22', '31.0', '23.0', '2345235', '0', '0', '0', '0', '包', '', '1', '1', '1', '1', '1', '1', '0', null, '50', '223', '232', '75', '81', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527074756_24930.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 15:47:59', null, '0');
INSERT INTO `wst_goods` VALUES ('66', '324234', '新加坡进口方便面 KOKA原味干捞快熟面85g*5', 'Upload/goods/2015-05/5565771503f78.jpg', 'Upload/goods/2015-05/5565771503f78.jpg', null, '22', '34.0', '23.0', '234234', '0', '0', '0', '0', '85g/袋*5小包', '规格：85g/袋*5小包\n\n产地：新加坡\n\n保质期：365天', '1', '1', '1', '1', '1', '1', '0', null, '50', '223', '232', '75', '82', '&lt;p&gt;\n	85g/袋*5小包\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527075122_11947.png&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 15:51:24', null, '0');
INSERT INTO `wst_goods` VALUES ('67', '2323423', '新加坡进口方便面 KOKA可口辣味星洲面85g*5', 'Upload/goods/2015-05/556579f34fbf9.jpg', 'Upload/goods/2015-05/556579f34fbf9.jpg', null, '22', '52.0', '45.0', '5622455', '0', '0', '0', '0', '包', '规格：85g/袋*5小包\n产地：新加坡\n保质期：365天', '1', '1', '1', '1', '1', '1', '0', null, '50', '223', '232', '75', '82', '&lt;table border=&quot;0&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot; width=&quot;750&quot; style=&quot;margin:0px;padding:0px;border-collapse:separate;color:#404040;font-family:tahoma, arial, 宋体, sans-serif;font-size:14px;background-color:#FFFFFF;&quot; class=&quot;ke-zeroborder&quot;&gt;\n	&lt;tbody&gt;\n		&lt;tr&gt;\n			&lt;td&gt;\n				&lt;p&gt;\n					规格：85g/袋*5小包\n				&lt;/p&gt;\n				&lt;p&gt;\n					产地：新加坡\n				&lt;/p&gt;\n				&lt;p&gt;\n					保质期：365天\n				&lt;/p&gt;\n				&lt;p&gt;\n					&amp;nbsp;&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527080310_10271.jpg&quot; alt=&quot;&quot; /&gt;\n				&lt;/p&gt;\n			&lt;/td&gt;\n		&lt;/tr&gt;\n	&lt;/tbody&gt;\n&lt;/table&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 16:03:12', null, '0');
INSERT INTO `wst_goods` VALUES ('68', '5465463', '幸运谷 团圆礼盒B款 干货礼盒 大枣 桂圆 核桃', 'Upload/goods/2015-05/55657baeb432b.jpg', 'Upload/goods/2015-05/55657baeb432b.jpg', null, '22', '234.0', '123.0', '124234', '0', '0', '0', '0', '盒', '食品保质期：12个月种类：桂圆国家：中国大陆进口/国产：国产净重(g)：2500', '1', '1', '1', '1', '1', '0', '0', null, '50', '219', '228', '76', '78', '&lt;p&gt;\n	食品保质期：12个月种类：桂圆国家：中国大陆进口/国产：国产净重(g)：2500\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527081053_15009.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 16:10:59', null, '0');
INSERT INTO `wst_goods` VALUES ('69', '2342', '闽龙达 大三元桂圆 500g/袋', 'Upload/goods/2015-05/556589e1c8fec.jpg', 'Upload/goods/2015-05/556589e1c8fec.jpg', null, '22', '45.0', '25.0', '5896221', '0', '0', '0', '0', '包', '规格参数\n食品保质期：365种类：桂圆国家：中国大陆进口/国产：国产净重(g)：500包装方式：袋装', '1', '1', '1', '1', '1', '1', '0', null, '50', '219', '225', '76', '79', '规格参数\n食品保质期：365种类：桂圆国家：中国大陆进口/国产：国产净重(g)：500包装方式：袋装', '0', '0', '0', '0', '1', null, '1', '2015-05-27 17:11:39', null, '0');
INSERT INTO `wst_goods` VALUES ('70', '535345', '豪雄 福建桂圆肉 350g/袋', 'Upload/goods/2015-05/55658aa5c47cf.jpg', 'Upload/goods/2015-05/55658aa5c47cf.jpg', null, '22', '23.0', '21.0', '123213123', '0', '0', '0', '0', '包', '食品保质期：270种类：桂圆肉国家：中国大陆进口/国产：国产净重(g)：350', '1', '1', '1', '1', '1', '0', '0', null, '50', '219', '225', '76', '79', '&lt;p&gt;\n	食品保质期：270种类：桂圆肉国家：中国大陆进口/国产：国产净重(g)：350\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527091402_35631.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 17:14:04', null, '0');
INSERT INTO `wst_goods` VALUES ('71', '23425235', '山珍礼盒 744g 黑木耳 香菇 银耳 猴头菇', 'Upload/goods/2015-05/55658bbe19e29.jpg', 'Upload/goods/2015-05/55658bbe19e29.jpg', null, '22', '34.0', '23.0', '42335', '0', '0', '0', '0', '盒', '食品保质期：12个月种类：猴头菇国家：中国大陆进口/国产：国产净重(g)：744包装方式：礼盒', '1', '1', '1', '1', '1', '1', '0', null, '50', '219', '225', '76', '79', '食品保质期：12个月种类：猴头菇国家：中国大陆进口/国产：国产净重(g)：744包装方式：礼盒', '0', '0', '0', '0', '1', null, '1', '2015-05-27 17:18:48', null, '0');
INSERT INTO `wst_goods` VALUES ('72', '234324', '百瑞源 宁夏枸杞500g', 'Upload/goods/2015-05/55658c7c032e7.jpg', 'Upload/goods/2015-05/55658c7c032e7.jpg', null, '22', '96.0', '52.0', '958658', '0', '0', '0', '0', '包', '净重(g)：500是否为有机食品：非有机国别：中国大陆食品保质期：365', '1', '1', '1', '1', '1', '1', '0', null, '50', '219', '224', '76', '79', '&lt;p&gt;\n	净重(g)：500是否为有机食品：非有机国别：中国大陆食品保质期：365\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150527/20150527092158_60276.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 17:22:03', null, '0');
INSERT INTO `wst_goods` VALUES ('73', '2347923', '韩束红石榴化妆品套装 春夏补水保湿控油爽肤水乳液美', 'Upload/goods/2015-05/5565bff6050d5.jpg', 'Upload/goods/2015-05/5565bff6050d5.jpg', null, '26', '235.0', '200.0', '23492384', '0', '0', '0', '0', '套', '上市时间: 2009年颜色分类: 基础护肤套组 眼部护肤套组 夏季护肤套组 红石榴六件套(滋润)功效: 补水 保湿 控油 收缩毛孔 抗氧化 滋润 清洁毛孔规格类型: 正常规格品牌: Kans/韩束面部护理套装: 红石榴完美套装适合肤质: 任何肤质产地: 中国保质期: 5年', '1', '1', '1', '1', '1', '1', '0', null, '51', '167', '331', '88', '96', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527130705_15748.gif&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 21:07:13', null, '0');
INSERT INTO `wst_goods` VALUES ('74', '23748927', '墨菊化妆品套装五件套 爽肤水乳液春夏补水保湿护肤化', 'Upload/goods/2015-05/5565c3ab246ef.png', 'Upload/goods/2015-05/5565c3ab246ef.png', null, '26', '245.0', '210.0', '234923', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '167', '331', '88', '97', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527131731_26353.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 21:17:34', null, '0');
INSERT INTO `wst_goods` VALUES ('75', '234324', '红石榴化妆品套装 夏季补水保湿控油爽肤水乳液士护肤', 'Upload/goods/2015-05/5565c4634bb60.jpg', 'Upload/goods/2015-05/5565c4634bb60.jpg', null, '26', '345.0', '324.0', '2132424', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '1', '0', null, '51', '167', '331', '88', '96', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527132014_53275.gif&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 21:20:42', null, '0');
INSERT INTO `wst_goods` VALUES ('76', '3324', '植美村bb霜化妆品套装正品玫瑰白皙去黄深层补水保湿', 'Upload/goods/2015-05/5565c52fbcdce.jpg', 'Upload/goods/2015-05/5565c52fbcdce.jpg', null, '26', '322.0', '233.0', '32423535', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '1', '0', null, '51', '167', '331', '88', '96', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527132335_39204.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 21:23:50', null, '0');
INSERT INTO `wst_goods` VALUES ('77', '2342432', '韩后化妆品套装正品雪玲珑套装美白祛黄补水保湿面部', 'Upload/goods/2015-05/5565c5f6e2fa2.jpg', 'Upload/goods/2015-05/5565c5f6e2fa2.jpg', null, '26', '300.0', '278.0', '232432', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '1', '0', null, '51', '167', '331', '88', '96', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527132749_77810.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 21:28:01', null, '0');
INSERT INTO `wst_goods` VALUES ('78', '3534534', '瑾泉化妆品正品套装护肤品套装女新活净白补水保湿白皙', 'Upload/goods/2015-05/5565c70e138da.jpg', 'Upload/goods/2015-05/5565c70e138da.jpg', null, '26', '456.0', '345.0', '2147483647', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '167', '331', '88', '96', '&lt;p&gt;\n	wstmall测试商品， 请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527133149_74789.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 21:31:52', null, '0');
INSERT INTO `wst_goods` VALUES ('79', '398473294', '美肤宝自然白套装化妆品护肤女士国货正品美白补水防晒', 'Upload/goods/2015-05/5565c7d90b5a5.jpg', 'Upload/goods/2015-05/5565c7d90b5a5.jpg', null, '26', '378.0', '299.0', '293482384', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '167', '331', '88', '96', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527133456_45282.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 21:35:12', null, '0');
INSERT INTO `wst_goods` VALUES ('80', '2374932', '兰可欣红石榴女士化妆品护肤套装 美白补水提亮保湿', 'Upload/goods/2015-05/5565c8a4ebde6.jpg', 'Upload/goods/2015-05/5565c8a4ebde6.jpg', null, '26', '234.0', '211.0', '324345', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '1', '0', null, '51', '167', '331', '88', '96', '&lt;p&gt;\n	wstmall测试商品 请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527133901_25801.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 21:39:04', null, '0');
INSERT INTO `wst_goods` VALUES ('81', '2384792', '丝蓓绮洗护套装奢耀柔艳洗发水护发素套装 补水资生堂', 'Upload/goods/2015-05/5565cbbebc44f.jpg', 'Upload/goods/2015-05/5565cbbebc44f.jpg', null, '26', '134.0', '119.0', '124234', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '1', '0', null, '51', '164', '184', '90', '93', '&lt;p&gt;\n	沐浴套装，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527135155_68823.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 21:52:38', null, '0');
INSERT INTO `wst_goods` VALUES ('82', '237498', 'COCO沐浴露洗发水护发素身体乳套装全身美白补水润', 'Upload/goods/2015-05/5565cca839a3b.jpg', 'Upload/goods/2015-05/5565cca839a3b.jpg', null, '26', '234.0', '213.0', '2423423', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '164', '184', '90', '93', '&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527135542_95827.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 21:56:01', null, '0');
INSERT INTO `wst_goods` VALUES ('83', '77979', '霸王女士防脱洗发水套装1200ml 防脱发掉发断发', 'Upload/goods/2015-05/5565ce1f1eb14.jpg', 'Upload/goods/2015-05/5565ce1f1eb14.jpg', null, '26', '134.0', '112.0', '4324234', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '164', '184', '90', '93', '&lt;p&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:24px;&quot;&gt;wstmall测试商品&lt;/span&gt;&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527140233_51127.jpg&quot; /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 22:03:05', null, '0');
INSERT INTO `wst_goods` VALUES ('84', '3522234', '韩国进口ks爱敬kerasys东洋顺滑洗发水护发素', 'Upload/goods/2015-05/5565cf60af461.jpg', 'Upload/goods/2015-05/5565cf60af461.jpg', null, '26', '324.0', '234.0', '0', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '164', '184', '90', '93', '&lt;h3&gt;\n	wstmall测试商品，请勿下单\n&lt;/h3&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527140726_62830.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 22:08:28', null, '0');
INSERT INTO `wst_goods` VALUES ('85', '35345', '洗发水护发素套装 正品 优妮 深层修复滋养洗发露', 'Upload/goods/2015-05/5565d037c631b.jpg', 'Upload/goods/2015-05/5565d037c631b.jpg', null, '26', '50.0', '45.0', '2344', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '164', '184', '90', '93', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527141208_30165.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 22:12:15', null, '0');
INSERT INTO `wst_goods` VALUES ('86', '234324', '洗发水护发素套装 深层修复原装正品共3瓶增250m', 'Upload/goods/2015-05/5565d106dc0ae.jpg', 'Upload/goods/2015-05/5565d106dc0ae.jpg', null, '26', '345.0', '245.0', '6878689', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '1', '0', null, '51', '164', '184', '90', '93', '&lt;p&gt;\n	&lt;span style=&quot;font-size:18px;&quot;&gt;wstmall洗浴套装，商品测试&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527141417_73978.jpg&quot; /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 22:14:41', null, '0');
INSERT INTO `wst_goods` VALUES ('87', '233454', '正品拉芳COCO香水洗发水+护发素+沐浴露 洗护套', 'Upload/goods/2015-05/5565d1e7a5082.jpg', 'Upload/goods/2015-05/5565d1e7a5082.jpg', null, '26', '87.0', '78.0', '324325', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '164', '184', '90', '93', '&lt;ul id=&quot;J_AttrUL&quot; style=&quot;color:#404040;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		功效:&amp;nbsp;柔软顺滑&amp;nbsp;去屑止痒&amp;nbsp;深层修复&amp;nbsp;深度清洁&amp;nbsp;滋润营养&amp;nbsp;脆弱开叉护理&amp;nbsp;丰盈蓬松&amp;nbsp;改善毛躁&amp;nbsp;改善头痒&amp;nbsp;强韧防断发&amp;nbsp;控油&amp;nbsp;头皮舒缓&amp;nbsp;滋润&amp;nbsp;补水\n	&lt;/li&gt;\n	&lt;li id=&quot;J_attrBrandName&quot; style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		品牌:&amp;nbsp;拉芳\n	&lt;/li&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		型号:&amp;nbsp;COCO香氛洗发水护发素沐浴露套装\n	&lt;/li&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		是否量贩装:&amp;nbsp;是\n	&lt;/li&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		净含量:&amp;nbsp;其他\n	&lt;/li&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		适用对象:&amp;nbsp;通用\n	&lt;/li&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		规格类型:&amp;nbsp;套装\n	&lt;/li&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		件数:&amp;nbsp;3件\n	&lt;/li&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		保质期:&amp;nbsp;3年\n	&lt;/li&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		产地:&amp;nbsp;中国大陆\n	&lt;/li&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		适用发质:&amp;nbsp;所有发质\n	&lt;/li&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n		是否进口:&amp;nbsp;国产\n	&lt;/li&gt;\n	&lt;li style=&quot;color:#666666;vertical-align:top;&quot;&gt;\n	&lt;/li&gt;\n&lt;/ul&gt;\n&lt;ul style=&quot;color:#404040;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n&lt;/ul&gt;\n&lt;ul style=&quot;color:#404040;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n&lt;/ul&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 22:18:14', null, '0');
INSERT INTO `wst_goods` VALUES ('88', '87687', '资生堂日本原装进口丝蓓绮奢华光艳洗发水220ml*', 'Upload/goods/2015-05/5565d2a7b6145.jpg', 'Upload/goods/2015-05/5565d2a7b6145.jpg', null, '26', '89.0', '76.0', '569008', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '1', '0', null, '51', '164', '184', '90', '93', '&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;font-size:18px;&quot;&gt;wstmall测试商品，请勿下单&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527142118_69570.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 22:21:34', null, '0');
INSERT INTO `wst_goods` VALUES ('89', '32253', '风味猪肉脯自然片200g 靖江特产 休闲零食', 'Upload/goods/2015-05/5565e0d8e9641.jpg', 'Upload/goods/2015-05/5565e0d8e9641.jpg', null, '30', '34.0', '23.0', '34235345', '0', '0', '0', '0', '包', '200克每包', '1', '1', '0', '1', '1', '1', '0', null, '52', '190', '205', '98', '106', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527152216_79172.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 23:22:19', null, '0');
INSERT INTO `wst_goods` VALUES ('90', '3579284', '百草味 白芝麻猪肉脯180g 靖江特产零食独立小包', 'Upload/goods/2015-05/5565e20c175b5.jpg', 'Upload/goods/2015-05/5565e20c175b5.jpg', null, '30', '34.0', '25.0', '243424', '0', '0', '0', '0', '包', '', '1', '1', '1', '1', '1', '1', '0', null, '52', '190', '205', '98', '106', '&lt;p&gt;\n	&lt;em&gt;&lt;span style=&quot;font-size:16px;&quot;&gt;wstmall测试商品，请勿下单&lt;/span&gt;&lt;/em&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;em&gt;&lt;span style=&quot;font-size:16px;&quot;&gt;&lt;/span&gt;&lt;/em&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;em&gt;&lt;span style=&quot;font-size:16px;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527152716_33571.jpg&quot; /&gt;&lt;/span&gt;&lt;/em&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;em&gt;&lt;/em&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;em&gt;&lt;/em&gt;&amp;nbsp;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 23:27:18', null, '0');
INSERT INTO `wst_goods` VALUES ('91', '354', '良品铺子 麻辣灯影牛肉丝250g重庆特产休闲零食', 'Upload/goods/2015-05/5565e2eca30d7.jpg', 'Upload/goods/2015-05/5565e2eca30d7.jpg', null, '30', '34.0', '24.0', '2435354', '0', '0', '0', '0', '包', '', '1', '1', '1', '1', '1', '1', '0', null, '52', '190', '205', '98', '106', '&lt;p&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:18px;&quot;&gt;wstmall测试商品&lt;/span&gt;&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527153117_59023.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 23:31:28', null, '0');
INSERT INTO `wst_goods` VALUES ('92', '354', '良品铺子 麻辣灯影牛肉丝250g重庆特产休闲零食', 'Upload/goods/2015-05/5565e2eca30d7.jpg', 'Upload/goods/2015-05/5565e2eca30d7.jpg', null, '30', '34.0', '24.0', '2435354', '0', '0', '0', '0', '包', '', '0', '1', '1', '1', '1', '0', '0', null, '52', '190', '205', '98', '106', '&lt;p&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:18px;&quot;&gt;wstmall测试商品&lt;/span&gt;&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527153117_59023.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 23:31:32', null, '0');
INSERT INTO `wst_goods` VALUES ('93', '354', '良品铺子 麻辣灯影牛肉丝250g重庆特产休闲零食', 'Upload/goods/2015-05/5565e2eca30d7.jpg', 'Upload/goods/2015-05/5565e2eca30d7.jpg', null, '30', '34.0', '24.0', '2435354', '0', '0', '0', '0', '包', '', '0', '1', '1', '1', '1', '1', '0', null, '52', '190', '205', '98', '106', '&lt;p&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:18px;&quot;&gt;wstmall测试商品&lt;/span&gt;&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527153117_59023.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 23:31:34', null, '0');
INSERT INTO `wst_goods` VALUES ('94', '86788', '姚太太 香辣鸭脖子200g 独立小包装卤味熟食鸭肉', 'Upload/goods/2015-05/5565e478a8ab7.jpg', 'Upload/goods/2015-05/5565e478a8ab7.jpg', '0', '30', '89.0', '67.0', '3424', '0', '0', '0', '0', '78', '', '1', '1', '1', '1', '1', '1', '0', null, '52', '190', '208', '98', '106', '&lt;p&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:18px;&quot;&gt;wstmall测试商品&lt;/span&gt;&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527154106_36152.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 23:42:00', null, '0');
INSERT INTO `wst_goods` VALUES ('95', '86898', '萨啦咪卤制 焗盐双翅66g 休闲零食温州特产美味', 'Upload/goods/2015-05/5565e680acb2f.jpg', 'Upload/goods/2015-05/5565e680acb2f.jpg', '0', '30', '65.0', '45.0', '8767856', '0', '0', '0', '0', '78', '', '1', '1', '1', '1', '1', '1', '0', null, '52', '190', '208', '98', '106', '&lt;p&gt;\n	测试商品 请勿下载\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527154646_57543.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 23:46:51', null, '0');
INSERT INTO `wst_goods` VALUES ('96', '8678', '香巴佬 香酥鸭腿35g/袋 鸭腿 乡巴佬 温州风味', 'Upload/goods/2015-05/5565e757750a7.jpg', 'Upload/goods/2015-05/5565e757750a7.jpg', '10', '30', '67.0', '56.0', '674675', '0', '0', '0', '0', '789', '', '1', '1', '1', '1', '1', '1', '0', null, '52', '190', '208', '98', '105', '&lt;p&gt;\n	wstmall 测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527154937_22172.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 23:49:59', null, '0');
INSERT INTO `wst_goods` VALUES ('97', '7565', '绿盛百卤坊酱鸭舌50g/袋 鸭舌 鸭舌头 原味鸭舌', 'Upload/goods/2015-05/5565e7f76cd33.jpg', 'Upload/goods/2015-05/5565e7f76cd33.jpg', '13', '30', '56.0', '45.0', '76565', '0', '0', '0', '0', '6', '', '1', '1', '1', '1', '1', '1', '0', null, '52', '190', '208', '98', '106', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527155242_52695.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 23:52:52', null, '0');
INSERT INTO `wst_goods` VALUES ('98', '75674', '黄胜记猪肉松150g 厦门特产肉干休闲美味小吃零食', 'Upload/goods/2015-05/5565e8bea28ad.jpg', 'Upload/goods/2015-05/5565e8bea28ad.jpg', '9', '30', '23.0', '12.0', '2324', '0', '0', '0', '0', '34', '', '1', '1', '1', '1', '1', '1', '0', null, '52', '190', '207', '98', '104', '&lt;p&gt;\n	测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527155532_43925.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 23:55:36', null, '0');
INSERT INTO `wst_goods` VALUES ('99', '32523', '徽记川辣子蚕豆202g麻辣味四川特产下酒菜休闲零食', 'Upload/goods/2015-05/5565e9a9b6768.jpg', 'Upload/goods/2015-05/5565e9a9b6768.jpg', '0', '30', '123.0', '67.0', '2342354', '0', '0', '0', '0', '23', '', '1', '1', '1', '1', '1', '1', '0', null, '52', '189', '199', '98', '104', '&lt;p&gt;\n	测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150527/20150527155939_97478.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-27 23:59:59', null, '0');
INSERT INTO `wst_goods` VALUES ('100', 'A001', '情侣对戒', 'Upload/goods/2015-05/5566ae4c3264c.jpg', 'Upload/goods/2015-05/5566ae4c3264c.jpg', '17', '10', '0.0', '0.0', '0', '0', '0', '0', '0', '阿萨德', '阿萨的', '0', '1', '1', '1', '1', '0', '0', null, '51', '166', '176', '107', '108', '阿萨德阿萨的', '0', '0', '0', '0', '1', null, '1', '2015-05-28 13:57:58', null, '0');
INSERT INTO `wst_goods` VALUES ('101', '23424', '马齿苋(长寿菜)', 'Upload/goods/2015-05/556ad57b1b3c2.jpg', 'Upload/goods/2015-05/556ad57b1b3c2.jpg', '0', '12', '5.0', '4.0', '1234', '0', '0', '0', '0', '千克', '包装规格：250g/盒', '1', '1', '1', '1', '1', '0', '0', null, '47', '62', '254', '112', '115', '&lt;h4 style=&quot;color:#666666;font-family:宋体, Verdana, Arial;&quot;&gt;\n	&lt;span style=&quot;font-size:small;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;color:#FF0000;&quot;&gt;有机马齿苋在生产种植过程中绝不适用农药、化肥、生产调节剂及有毒有害化学合成的物质，而是遵循自然规律和生态学原理；从而使人食用以后无有毒有害物质，在人体内的有毒有害物质的累加效应的产生，使人身体更健康、更快乐，这是普通马齿苋无法达到的作用。本商品是真正的有机蔬菜，由专业有机认证机构认证，可登陆“中国食品农产品认证信息系统”输入我们的证书号查询&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;\n&lt;/h4&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 17:35:33', null, '0');
INSERT INTO `wst_goods` VALUES ('102', '3535435', '有机莴笋500g', 'Upload/goods/2015-05/556ad7bf2ad0e.jpg', 'Upload/goods/2015-05/556ad7bf2ad0e.jpg', '20', '12', '20.0', '17.0', '12313', '0', '0', '0', '0', '千克', '包装规格：500g/袋', '1', '1', '1', '1', '1', '0', '0', null, '47', '62', '254', '112', '115', '&lt;p style=&quot;color:#666666;font-family:宋体, Verdana, Arial;&quot;&gt;\n	&lt;strong&gt;&amp;nbsp;&lt;span style=&quot;font-size:small;&quot;&gt;营养价值&lt;/span&gt;&lt;/strong&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;font-family:宋体, Verdana, Arial;&quot;&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:small;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt;&lt;/strong&gt;&lt;span style=&quot;font-size:small;&quot;&gt;1、开通疏利、消积下气：莴苣味道清新且略带苦味，可刺激消化酶分泌，增进食欲。其乳状浆液，可增强胃液、消化腺的分泌和胆汁的分泌，从而促进各消化器官的功能，对消化功能减弱、消化道中酸性降低和便秘的病人尤其有利；&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;font-family:宋体, Verdana, Arial;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;font-family:宋体, Verdana, Arial;&quot;&gt;\n	&lt;span style=&quot;font-size:small;&quot;&gt;2、利尿通乳：莴苣钾含量大大高于钠含量，有利于体内的水电解质平衡，促进排尿和&lt;/span&gt;&lt;span style=&quot;font-size:small;&quot;&gt;乳汁的分泌。对高血压、水肿、心脏病人有一定的食疗作用；&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;font-family:宋体, Verdana, Arial;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;font-family:宋体, Verdana, Arial;&quot;&gt;\n	&lt;span style=&quot;font-size:small;&quot;&gt;3、强壮机体、防癌抗癌：莴苣含有多种维生素和矿物质，具有调节神经系统功能的作用，其所含有机化含物中富含人体可吸收的铁元素，对有缺铁性贫血病人十分有利。莴苣的热水提取物对某些癌细胞有很高的抑制率，故又可用来防癌抗癌；&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;font-family:宋体, Verdana, Arial;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;font-family:宋体, Verdana, Arial;&quot;&gt;\n	&lt;span style=&quot;font-size:small;&quot;&gt;4、宽肠通便：莴苣含有大量植物纤维素，能促进肠壁蠕动，通利消化道，帮助大便排泄，可用于治疗各种便秘。&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 17:52:18', null, '0');
INSERT INTO `wst_goods` VALUES ('103', '384782', '黑冰有机无花果热销中（1斤装）', 'Upload/goods/2015-05/556ada2a6686f.jpg', 'Upload/goods/2015-05/556ada2a6686f.jpg', '19', '12', '60.0', '58.0', '24322', '0', '0', '0', '0', '千克', '1斤装 盒装', '1', '1', '1', '1', '1', '0', '0', null, '47', '62', '254', '112', '115', '商品详情：\n黑冰有机无花果\n规格：1斤装/盒\n价格：58元/斤\n特色：黑冰牌有机无花果属于有机食品，源自黑冰有机农场，无化学农药、无化肥，无添加剂，口感自然清香；\n功效：中医认为无花果性质平和，味甘，能够健胃，清肠，消肿解毒，可以用来治疗肠炎，痢疾，便秘，痔疮，喉痛及痈疮疥癣等。', '0', '0', '0', '0', '1', null, '1', '2015-05-31 17:54:32', null, '0');
INSERT INTO `wst_goods` VALUES ('104', '398472', '有机菠菜(250g/盒)', 'Upload/goods/2015-05/556adbbcd341d.jpg', 'Upload/goods/2015-05/556adbbcd341d.jpg', '20', '12', '24.0', '23.0', '53453', '0', '0', '0', '0', '盒', '250g/盒', '1', '1', '1', '1', '1', '0', '0', null, '47', '62', '254', '112', '115', '菠菜营养成分极其丰富，菠菜叶含锌56～68毫克/公斤(干重)，叶酸1.22微克/克，氨基酸和叶黄素、β-胡萝卜素、新-β-胡萝卜素B、新-β-胡萝卜;菠菜素U等类胡萝卜素、还含α-菠菜甾醇、胆甾醇以及甾醇酯和甾醇甙、万寿菊素、菠叶素，和一种青紫色萤光物质2-乙酰基-3-对羟基苯丙烯酰基内消旋酒石酸;根含菠菜皂甙A和B每100克含水分91.8克，蛋白质2.4克，脂肪0.5克，碳水化合物3.1克，粗纤维0.7克，灰分1.5克，胡萝卜素 3.87毫克，维生素B10.04毫克，维生素B20.13毫克，尼克酸0.6毫克，维生素C 39毫克，钙72毫克，磷53毫克，铁1.8毫克，钾502毫克，钠98.6毫克，镁34.3毫克，氯200毫克。热量 (24.00千卡) ·维生素B6 (0.30毫克) · ·脂肪 (0.30克) ·泛酸 (0.20毫克) · ·叶酸 (110.00微克) ·膳食纤维 (1.70克) ·维生素A (487.00微克) · ·硫胺素 (0.04毫克) ·核黄素 (0.11毫克) ·尼克酸 (0.60毫克) 维生素E (1.74毫克) ·锌 (0.85毫克) ·硒 (0.97微克) ·铜 (0.10毫克) ·锰 (0.66毫克) 钾 (311.00毫克)\n \n1、 通肠导便、防治痔疮：菠菜含有大量的植物粗纤维，具有促进肠道蠕动的作用，利于排便，且能促进胰腺分泌，帮助消化。对于痔疮、慢性胰腺炎、便秘、肛裂等病症有治疗作用 　　\n2、 促进生长发育、增强抗病能力：菠菜中所含的胡萝卜素，在人体内转变成维生素A，能维护正常视力和上皮细胞的健康，增加预防传染病的能力，促进儿童生长发育。\n3、保障营养、增进健康：菠菜中含有丰富的胡萝卜素、维生素C、钙、磷及一定量的铁、维生素E等有益成分，能供给人体多种营养物质；其所含铁质，对缺铁性贫血有较好的辅助治疗作用 　　\n4、促进人体新陈代谢：菠菜中所含微量元素物质，能促进人体新陈代谢，增进身体健康。大量食用菠菜，可降低中风的危险 　　\n5． 清洁皮肤、抗衰老：菠菜提取物具有促进培养细胞增殖的作用，既抗衰老又能增强青春活力。中国民间以菠菜捣烂取汁，每周洗脸数次，连续使用一段时间，可清洁皮肤毛孔，减少皱纹及色素斑，保持皮肤光洁。', '0', '0', '0', '0', '1', null, '1', '2015-05-31 18:01:01', null, '0');
INSERT INTO `wst_goods` VALUES ('105', '35345', '有机西兰花(400g/盒)', 'Upload/goods/2015-05/556adc06211b7.jpg', 'Upload/goods/2015-05/556adc06211b7.jpg', '20', '12', '23.0', '20.0', '234235', '0', '0', '0', '0', '盒', '400g/盒', '1', '1', '1', '1', '1', '0', '0', null, '47', '62', '254', '112', '115', '有机西兰花在生产种植过程中绝不适用农药、化肥、生产调节剂及有毒有害化学合成的物质，而是遵循自然规律和生态学原理；从而使人食用以后无有毒有害物质，在人体内的有毒有害物质的累加效应的产生，使人身体更健康、更快乐，这是普通西兰花无法达到的作用。本商品是真正的有机蔬菜，由专业有机认证机构认证，可登陆“中国食品农产品认证信息系统”输入我们的证书号查询', '0', '0', '0', '0', '1', null, '1', '2015-05-31 18:02:36', null, '0');
INSERT INTO `wst_goods` VALUES ('106', '34539', '一号农场 有机新鲜蔬菜套餐 蔬菜1.8KG单次卡', 'Upload/goods/2015-05/556add323cd84.jpg', 'Upload/goods/2015-05/556add323cd84.jpg', '21', '12', '100.0', '85.0', '353498', '0', '0', '0', '0', '千克', '', '1', '1', '1', '1', '1', '0', '0', null, '47', '62', '254', '112', '115', '&lt;p&gt;\n	友情提醒：因为是体验特惠套餐，每个ID，每个地址，每个手机限购1次哦！！\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531100916_97525.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 18:07:30', null, '0');
INSERT INTO `wst_goods` VALUES ('107', '33948739', '礼品卡 1088C套餐 现摘配送 全程冷链四点半前', 'Upload/goods/2015-05/556adeb90abba.jpg', 'Upload/goods/2015-05/556adeb90abba.jpg', '21', '12', '2000.0', '1088.0', '866767', '0', '0', '0', '0', '千克', '每次8份，一共6次', '1', '1', '1', '1', '1', '0', '0', null, '47', '62', '253', '112', '115', '&lt;p&gt;\n	201310161012234526\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531101358_99964.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 18:14:28', null, '0');
INSERT INTO `wst_goods` VALUES ('108', '374928', '家鲜 西兰花 凌晨采购 全程冷链', 'Upload/goods/2015-05/556adfc15c22b.jpg', 'Upload/goods/2015-05/556adfc15c22b.jpg', '22', '12', '234.0', '123.0', '242342', '0', '0', '0', '0', '克', '约500g/份', '1', '1', '1', '1', '1', '0', '0', null, '47', '62', '255', '112', '114', '&lt;p&gt;\n	&lt;a class=&quot;on li_gwSelect_b&quot;&gt;约500g/份&lt;/a&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;a class=&quot;on li_gwSelect_b&quot;&gt;&lt;br /&gt;\n&lt;/a&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;a class=&quot;on li_gwSelect_b&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531101838_76030.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/a&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 18:18:40', null, '0');
INSERT INTO `wst_goods` VALUES ('109', '453454', '私房菜现做现卖BCP-29 鱼香肉丝225g', 'Upload/goods/2015-05/556b086948b12.jpg', 'Upload/goods/2015-05/556b086948b12.jpg', '23', '12', '35.0', '31.0', '23422423', '0', '0', '0', '0', '包', '225克每包', '1', '1', '1', '1', '1', '0', '0', null, '47', '63', '318', '124', '125', '&lt;p&gt;\n	新雅食品\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531131231_29855.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 21:12:32', null, '0');
INSERT INTO `wst_goods` VALUES ('110', '325435', '可乐鸡中翅', 'Upload/goods/2015-05/556b09c99ee67.jpg', 'Upload/goods/2015-05/556b09c99ee67.jpg', '24', '12', '24.0', '20.0', '42334', '0', '0', '0', '0', '包', '200克每包', '1', '1', '1', '1', '1', '0', '0', null, '47', '63', '318', '124', '125', '测试商品，请勿下单', '0', '0', '0', '0', '1', null, '1', '2015-05-31 21:18:00', null, '0');
INSERT INTO `wst_goods` VALUES ('111', '345353', '新雅半成品BCP-34盐焗鸡翅225g/盒 无穷美', 'Upload/goods/2015-05/556b0a573e8a9.jpg', 'Upload/goods/2015-05/556b0a573e8a9.jpg', '23', '12', '34.0', '29.0', '3523423', '0', '0', '0', '0', '盒', '225g/盒', '1', '1', '1', '1', '1', '0', '0', null, '47', '63', '318', '124', '125', '&lt;p&gt;\n	测试商品 请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531132018_26169.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 21:20:34', null, '0');
INSERT INTO `wst_goods` VALUES ('112', '23324', 'BCP-28冷冻半成品菜家常豆腐225克/盒', 'Upload/goods/2015-05/556b0b0fbb724.jpg', 'Upload/goods/2015-05/556b0b0fbb724.jpg', '23', '12', '35.0', '32.0', '324234', '0', '0', '0', '0', '盒', '225克/盒', '1', '1', '1', '1', '1', '0', '0', null, '47', '63', '318', '124', '125', '新雅食品\n\n测试商品，请勿下单', '0', '0', '0', '0', '1', null, '1', '2015-05-31 21:24:16', null, '0');
INSERT INTO `wst_goods` VALUES ('113', '2234', '冷冻半成品菜BCP-12 蚝油牛肉 就餐必点招牌菜', 'Upload/goods/2015-05/556b0bf3850b6.jpg', 'Upload/goods/2015-05/556b0bf3850b6.jpg', '23', '12', '45.0', '42.0', '234234', '0', '0', '0', '0', '盒', '225g/盒', '1', '1', '1', '1', '1', '0', '0', null, '47', '63', '318', '124', '125', '&lt;p&gt;\n	新雅食品\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531132655_31464.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 21:27:12', null, '0');
INSERT INTO `wst_goods` VALUES ('114', '4535', '冷冻半成品BCP-08 黑椒牛排  225g/盒', 'Upload/goods/2015-05/556b0f081380a.jpg', 'Upload/goods/2015-05/556b0f081380a.jpg', '23', '12', '67.0', '45.0', '343453', '0', '0', '0', '0', '盒', ' 225g/盒', '1', '1', '1', '1', '1', '0', '0', null, '47', '63', '318', '124', '125', '&lt;p&gt;\n	测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531133911_50275.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 21:39:24', null, '0');
INSERT INTO `wst_goods` VALUES ('115', '32424', '粤菜馆 BCP-28冷冻半成品菜家常豆腐225g', 'Upload/goods/2015-05/556b0f55de11a.jpg', 'Upload/goods/2015-05/556b0f55de11a.jpg', '23', '12', '56.0', '45.0', '35345', '0', '0', '0', '0', '盒', '225g/盒', '1', '1', '1', '1', '1', '0', '0', null, '47', '63', '318', '124', '125', '&lt;p&gt;\n	新雅食品\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531134119_12727.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 21:41:21', null, '0');
INSERT INTO `wst_goods` VALUES ('116', '234223', '十头鲍鱼仔（每只配粉丝、蒜蓉次日12点发货外围不送', 'Upload/goods/2015-05/556b10c8c0b33.jpg', 'Upload/goods/2015-05/556b10c8c0b33.jpg', '21', '4', '36.0', '23.0', '32532342', '0', '0', '0', '0', '225克一盒', '', '1', '1', '1', '1', '1', '0', '0', null, '47', '65', '288', '28', '30', '&lt;p&gt;\n	测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531134818_53390.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 21:48:20', null, '0');
INSERT INTO `wst_goods` VALUES ('117', '35354', '北极贝拼三文鱼（超新鲜刺身三文鱼净肉150g', 'Upload/goods/2015-05/556b11d28f92f.jpg', 'Upload/goods/2015-05/556b11d28f92f.jpg', '24', '4', '657.0', '456.0', '34356', '0', '0', '0', '0', '盒', '190克/盒', '1', '1', '1', '1', '1', '0', '0', null, '47', '65', '288', '28', '29', '测试商品，请勿下单', '0', '0', '0', '0', '1', null, '1', '2015-05-31 21:53:49', null, '0');
INSERT INTO `wst_goods` VALUES ('118', '35353', 'FINE FOOD 烟熏三文鱼切片 150G/袋', 'Upload/goods/2015-05/556b13a826385.jpg', 'Upload/goods/2015-05/556b13a826385.jpg', '24', '13', '34.0', '23.0', '23353', '0', '0', '0', '0', '袋', '150G/袋', '1', '1', '1', '1', '1', '0', '0', null, '47', '66', '332', '127', '128', '&lt;p&gt;\n	测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531140018_93097.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:00:29', null, '0');
INSERT INTO `wst_goods` VALUES ('119', '86834', 'FINE FOOD 裹面包屑凤尾虾 460G', 'Upload/goods/2015-05/556b14281d098.jpg', 'Upload/goods/2015-05/556b14281d098.jpg', '19', '13', '34.0', '23.0', '325324', '0', '0', '0', '0', '盒', ' 460G/盒', '1', '1', '1', '1', '1', '0', '0', null, '47', '66', '332', '127', '128', '测试商品，请勿下单', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:01:51', null, '0');
INSERT INTO `wst_goods` VALUES ('120', '353545', 'SF定海针粒冻虾仁 200-300 250G/袋', 'Upload/goods/2015-05/556b14668ae61.jpg', 'Upload/goods/2015-05/556b14668ae61.jpg', '19', '13', '56.0', '45.0', '2342353', '0', '0', '0', '0', '袋', '250G/袋', '1', '1', '1', '1', '1', '0', '0', null, '47', '66', '332', '127', '128', '&lt;p&gt;\n	测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;SF定海针粒冻虾仁 200-300 250G/袋&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531140255_47878.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:02:57', null, '0');
INSERT INTO `wst_goods` VALUES ('121', '3535', '扇贝 8-9枚 375G/袋', 'Upload/goods/2015-05/556b1c2d47fe2.jpg', 'Upload/goods/2015-05/556b1c2d47fe2.jpg', '19', '13', '35.0', '27.0', '323235', '0', '0', '0', '0', '袋', '【品名】：扇贝 8-9枚 375G/袋\n【品牌】：新海宝\n【净含量】：375G\n【原产地】：福建福州\n【配料】：扇贝\n【生产日期】：见包装\n【保质期限】：≤-18℃18个月', '1', '1', '1', '1', '1', '0', '0', null, '47', '66', '332', '127', '128', '【品名】：扇贝 8-9枚 375G/袋\n【品牌】：新海宝\n【净含量】：375G\n【原产地】：福建福州\n【配料】：扇贝\n【生产日期】：见包装\n【保质期限】：≤-18℃18个月', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:37:35', null, '0');
INSERT INTO `wst_goods` VALUES ('122', '334534', 'SF东海大黄鱼200-300G 500G', 'Upload/goods/2015-05/556b1cca6fcc9.jpg', 'Upload/goods/2015-05/556b1cca6fcc9.jpg', '19', '13', '56.0', '53.0', '34535345', '0', '0', '0', '0', '袋', '', '1', '1', '1', '1', '1', '0', '0', null, '47', '66', '332', '127', '128', 'SF东海大黄鱼200-300G 500G', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:39:06', null, '0');
INSERT INTO `wst_goods` VALUES ('123', '23543534', 'SF 定海针水晶虾仁抽肠 70/100 750G', 'Upload/goods/2015-05/556b1d2981c09.jpg', 'Upload/goods/2015-05/556b1d2981c09.jpg', '19', '13', '67.0', '34.0', '23325435', '0', '0', '0', '0', '袋', '【品名】SF 定海针水晶虾仁抽肠 70/100 750G\n【品牌】定海针\n【配料】海洋捕捞虾、水、食品添加剂\n【贮存条件】冷藏\n【净含量】750G', '1', '1', '1', '1', '1', '0', '0', null, '47', '66', '332', '127', '128', '&lt;strong&gt;&lt;span&gt;【品名】SF 定海针水晶虾仁抽肠 70/100 750G&lt;br /&gt;\n【品牌】定海针&lt;br /&gt;\n【配料】海洋捕捞虾、水、食品添加剂&lt;br /&gt;\n【贮存条件】冷藏&lt;br /&gt;\n【净含量】750G&lt;/span&gt;&lt;/strong&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:40:37', null, '0');
INSERT INTO `wst_goods` VALUES ('124', '543346456', '新雅粤菜馆 冷冻半成品私房菜BCP-09 三鲜汤3', 'Upload/goods/2015-05/556b1d96836e7.jpg', 'Upload/goods/2015-05/556b1d96836e7.jpg', '19', '13', '45.0', '34.0', '65464', '0', '0', '0', '0', '袋', '', '1', '1', '1', '1', '1', '0', '0', null, '47', '71', '320', '127', '128', '新雅粤菜馆 冷冻半成品私房菜BCP-09 三鲜汤300g 当天16点之前提交的订单，当天发货', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:42:05', null, '0');
INSERT INTO `wst_goods` VALUES ('125', '45336', '新雅BCP-18酸汤肥牛225g 酒店半成品肉类私', 'Upload/goods/2015-05/556b1dd367c42.jpg', 'Upload/goods/2015-05/556b1dd367c42.jpg', '19', '13', '56.0', '34.0', '23425', '0', '0', '0', '0', '盘', '', '1', '1', '1', '1', '1', '0', '0', null, '47', '71', '320', '127', '128', '&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;新雅BCP-18酸汤肥牛225g 酒店半成品肉类私房菜 微波速食方便炒菜&lt;/span&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:42:56', null, '0');
INSERT INTO `wst_goods` VALUES ('126', '353543', '菜根香特制 八宝甜饭（真空袋装）450G', 'Upload/goods/2015-05/556b1f8ec2136.jpg', 'Upload/goods/2015-05/556b1f8ec2136.jpg', '19', '11', '56.0', '34.0', '5346', '0', '0', '0', '0', '袋', '450G', '1', '1', '1', '1', '1', '0', '0', null, '47', '71', '320', '18', '25', '&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;菜根香特制 八宝甜饭（真空袋装）450G&lt;/span&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:50:25', null, '0');
INSERT INTO `wst_goods` VALUES ('127', '64564', '常温熟食SS-02 香卤牛肉250g方便菜卤味', 'Upload/goods/2015-05/556b1fc88604e.jpg', 'Upload/goods/2015-05/556b1fc88604e.jpg', '19', '11', '34.0', '23.0', '24234', '0', '0', '0', '0', '盘', '', '1', '1', '1', '1', '1', '0', '0', null, '47', '71', '320', '18', '25', '常温熟食SS-02 香卤牛肉250g方便菜卤味', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:51:14', null, '0');
INSERT INTO `wst_goods` VALUES ('128', '453635', '新雅大厨YL-03 常温腊味广式腊肠特色私房菜42', 'Upload/goods/2015-05/556b200b476d6.jpg', 'Upload/goods/2015-05/556b200b476d6.jpg', '19', '11', '34.0', '30.0', '3453636', '0', '0', '0', '0', '千克', '', '1', '1', '1', '1', '1', '0', '0', null, '47', '71', '320', '18', '25', '新雅大厨YL-03 常温腊味广式腊肠特色私房菜425g ', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:52:28', null, '0');
INSERT INTO `wst_goods` VALUES ('129', '354664', '新雅大厨YL-04 常温腊味腊青鱼干250g 真空', 'Upload/goods/2015-05/556b2046d3c6d.jpg', 'Upload/goods/2015-05/556b2046d3c6d.jpg', '19', '11', '67.0', '45.0', '43634', '0', '0', '0', '0', '千克', '', '1', '1', '1', '1', '1', '0', '0', null, '47', '71', '320', '18', '25', '新雅大厨YL-04 常温腊味腊青鱼干250g 真空包装 方便菜 ', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:53:21', null, '0');
INSERT INTO `wst_goods` VALUES ('130', '45426546', '万家鲜 320g富贵人家鲜肉粽', 'Upload/goods/2015-05/556b207b3d959.jpg', 'Upload/goods/2015-05/556b207b3d959.jpg', '19', '11', '9.0', '8.0', '0', '0', '0', '0', '0', '个', '320g', '1', '1', '1', '1', '1', '0', '0', null, '47', '71', '320', '18', '25', '万家鲜 320g富贵人家鲜肉粽', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:54:17', null, '0');
INSERT INTO `wst_goods` VALUES ('131', '463554', '常温熟食SS-07 秘制酱鸭450g 真空卤味方便', 'Upload/goods/2015-05/556b20c74da42.jpg', 'Upload/goods/2015-05/556b20c74da42.jpg', '19', '11', '78.0', '65.0', '345264', '0', '0', '0', '0', '千克', '', '1', '1', '1', '1', '1', '0', '0', null, '47', '71', '320', '18', '25', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;常温熟食SS-07 秘制酱鸭450g 真空卤味方便菜&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150531/20150531145555_75374.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-05-31 22:55:57', null, '0');
INSERT INTO `wst_goods` VALUES ('132', '373924', '日本进口 昭和SHOWA 手套（M号绿色）', 'Upload/goods/2015-06/556baca5abd97.jpg', 'Upload/goods/2015-06/556baca5abd97.jpg', '0', '15', '45.0', '34.0', '234532', '0', '0', '0', '0', '双', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '259', '281', '130', '144', '日本进口 昭和SHOWA 手套（M号绿色）', '0', '0', '0', '0', '1', null, '1', '2015-06-01 08:52:38', null, '0');
INSERT INTO `wst_goods` VALUES ('133', '3534534', '日本进口 斯凯达 DBD5 立体垃圾桶5升', 'Upload/goods/2015-06/556bad657d757.jpg', 'Upload/goods/2015-06/556bad657d757.jpg', '0', '15', '56.0', '34.0', '23534534', '0', '0', '0', '0', '只', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '259', '281', '130', '145', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;日本进口 斯凯达 DBD5 立体垃圾桶5升 Hello Kitty－Basic 0181&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150601/20150601005532_19772.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 08:55:48', null, '0');
INSERT INTO `wst_goods` VALUES ('134', '53453', '日本COGIT 儿童款小熊/小兔竹炭鞋撑 从小识左', 'Upload/goods/2015-06/556badd5e0688.jpg', 'Upload/goods/2015-06/556badd5e0688.jpg', '0', '15', '56.0', '45.0', '2343253', '0', '0', '0', '0', '个', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '259', '280', '130', '144', '日本COGIT 儿童款小熊/小兔竹炭鞋撑 从小识左右', '0', '0', '0', '0', '1', null, '1', '2015-06-01 08:57:32', null, '0');
INSERT INTO `wst_goods` VALUES ('135', '3424434', '日本COGIT 血型竹炭除湿消臭靴撑（四款可选）', 'Upload/goods/2015-06/556bae1378d17.jpg', 'Upload/goods/2015-06/556bae1378d17.jpg', '0', '15', '45.0', '34.0', '453453', '0', '0', '0', '0', '个', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '259', '279', '130', '144', '　【商品名称】：日本COGIT 血型竹炭除湿消臭靴撑（四款可选）　　【品　　牌】：COGIT　　【商品编码】：7420053　　【货　　号】：46837卡通狮/46838卡通兔/46836卡通猴/46835长颈鹿　　【商品颜色】：粉色卡通兔(AB型)、橙色卡通狮(O型)、蓝色卡通猴(B型)、黄色长颈鹿(A型)　　【产　　地】：中国 　　日本专柜价：1260日元(约合人民币101元) ', '0', '0', '0', '0', '1', null, '1', '2015-06-01 08:58:28', null, '0');
INSERT INTO `wst_goods` VALUES ('136', '45345', '台湾正品热销 Bone 心形狗骨头 3.5mm情侣', 'Upload/goods/2015-06/556bb082eb7fc.jpg', 'Upload/goods/2015-06/556bb082eb7fc.jpg', '0', '15', '46.0', '34.0', '325343', '0', '0', '0', '0', '个', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '259', '279', '130', '146', '台湾正品热销 Bone 心形狗骨头 3.5mm情侣耳机分享器 分线器', '0', '0', '0', '0', '1', null, '1', '2015-06-01 09:09:10', null, '0');
INSERT INTO `wst_goods` VALUES ('137', '553534', '日本白元 一年冰箱冷冻室脱臭剂（可用1年）50g', 'Upload/goods/2015-06/556bb0f5e6236.jpg', 'Upload/goods/2015-06/556bb0f5e6236.jpg', '0', '15', '56.0', '54.0', '3345345', '0', '0', '0', '0', '盒', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '259', '280', '130', '144', '日本白元 一年冰箱冷冻室脱臭剂（可用1年）50g', '0', '0', '0', '0', '1', null, '1', '2015-06-01 09:10:28', null, '0');
INSERT INTO `wst_goods` VALUES ('138', '3535345', '妙管家固體芳香劑120g', 'Upload/goods/2015-06/556bb1152b173.jpg', 'Upload/goods/2015-06/556bb1152b173.jpg', '0', '15', '86.0', '56.0', '5345345', '0', '0', '0', '0', '盒', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '259', '281', '130', '144', '妙管家固體芳香劑120g', '0', '0', '0', '0', '1', null, '1', '2015-06-01 09:11:10', null, '0');
INSERT INTO `wst_goods` VALUES ('139', '345354', '日本白元 一年冰箱冷藏室脱臭剂（可用1年）80g', 'Upload/goods/2015-06/556bb15544f3c.jpg', 'Upload/goods/2015-06/556bb15544f3c.jpg', '0', '15', '3453.0', '3242.0', '343242', '0', '0', '0', '0', '盒', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '259', '279', '130', '146', '日本白元 一年冰箱冷藏室脱臭剂（可用1年）80g', '0', '0', '0', '0', '1', null, '1', '2015-06-01 09:12:22', null, '0');
INSERT INTO `wst_goods` VALUES ('140', '354353', '乐宜美加厚11丝真空压缩袋 11件套送手泵收纳袋', 'Upload/goods/2015-06/556bb41b13390.jpg', 'Upload/goods/2015-06/556bb41b13390.jpg', '25', '15', '67.0', '59.0', '2332', '0', '0', '0', '0', '盒', ' 11件套', '1', '1', '1', '1', '1', '0', '0', null, '48', '260', '287', '131', '139', '&lt;p&gt;\n	&amp;nbsp;11件套\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150601/20150601012427_58007.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 09:24:42', null, '0');
INSERT INTO `wst_goods` VALUES ('141', '3535435', '好雅 真空收纳袋压缩袋整理密封袋 7件套赠抽气泵', 'Upload/goods/2015-06/556bbd2085b1f.jpg', 'Upload/goods/2015-06/556bbd2085b1f.jpg', '26', '15', '45.0', '42.0', '42342', '0', '0', '0', '0', '盒', '规格： 特大号2个 大号2个 中号2个', '1', '1', '1', '1', '1', '0', '0', null, '48', '260', '284', '131', '141', '好雅 真空收纳袋压缩袋整理密封袋 7件套赠抽气泵', '0', '0', '0', '0', '1', null, '1', '2015-06-01 10:03:00', null, '0');
INSERT INTO `wst_goods` VALUES ('142', '35345', '太力抗菌真空压缩袋棉被衣物收纳袋彩盒装带双泵', 'Upload/goods/2015-06/556bbf15bbcb9.jpg', 'Upload/goods/2015-06/556bbf15bbcb9.jpg', '26', '15', '56.0', '45.0', '353453', '0', '0', '0', '0', '盒', '真空压缩袋彩盒装10件套(2大+2中+3小+2手卷+1手动双泵)', '1', '1', '1', '1', '1', '0', '0', null, '48', '260', '287', '131', '142', '真空压缩袋彩盒装10件套(2大+2中+3小+2手卷+1手动双泵)', '0', '0', '0', '0', '1', null, '1', '2015-06-01 10:11:23', null, '0');
INSERT INTO `wst_goods` VALUES ('143', '日5573495', '乐宜美大号真空压缩袋70*100cm 2只装', 'Upload/goods/2015-06/556bc612a2298.jpg', 'Upload/goods/2015-06/556bc612a2298.jpg', '25', '15', '67.0', '54.0', '32534', '0', '0', '0', '0', '只', ' 2只装', '1', '1', '1', '1', '1', '0', '0', null, '48', '260', '287', '131', '143', ' 2只装\n乐宜美大号真空压缩袋70*100cm 2只装', '0', '0', '0', '0', '1', null, '1', '2015-06-01 10:41:16', null, '0');
INSERT INTO `wst_goods` VALUES ('144', '435345', '太力真空压缩袋羽绒服衣物收纳袋2个装送小香包 中号', 'Upload/goods/2015-06/556bcb77ab0aa.jpg', 'Upload/goods/2015-06/556bcb77ab0aa.jpg', '25', '15', '56.0', '43.0', '25345', '0', '0', '0', '0', '个', '规格： 60*70㎝(2个)', '1', '1', '1', '1', '1', '0', '0', null, '48', '260', '287', '131', '139', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150601/20150601030346_54623.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:04:36', null, '0');
INSERT INTO `wst_goods` VALUES ('145', '53543', '飞达三和 多用储物盒收纳箱药箱多用杂物箱 颜色随机', 'Upload/goods/2015-06/556bcc1b10cf6.jpg', 'Upload/goods/2015-06/556bcc1b10cf6.jpg', '25', '15', '45.0', '42.0', '343', '0', '0', '0', '0', '个', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '260', '284', '131', '142', '飞达三和 多用储物盒收纳箱药箱多用杂物箱 颜色随机', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:06:33', null, '0');
INSERT INTO `wst_goods` VALUES ('146', '33453', '双艺家居 韩式盖式十五格分类收纳盒收纳箱 颜色随机', 'Upload/goods/2015-06/556bcc75af177.jpg', 'Upload/goods/2015-06/556bcc75af177.jpg', '25', '15', '45.0', '43.0', '34353', '0', '0', '0', '0', '个', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '260', '284', '131', '142', '双艺家居 韩式盖式十五格分类收纳盒收纳箱 颜色随机', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:08:10', null, '0');
INSERT INTO `wst_goods` VALUES ('147', '234534', '塑风尚梅花形密封塑料盘干零食盘糖果盒JL-5244', 'Upload/goods/2015-06/556bccdb42dd7.jpg', 'Upload/goods/2015-06/556bccdb42dd7.jpg', '25', '15', '67.0', '45.0', '344534', '0', '0', '0', '0', '个', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '260', '284', '131', '142', '塑风尚梅花形密封塑料盘干零食盘糖果盒JL-5244', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:09:53', null, '0');
INSERT INTO `wst_goods` VALUES ('148', '345345', '日本原装进口 山洋 大头棉棒110支 筒装', 'Upload/goods/2015-06/556bcdd4a7bff.jpg', 'Upload/goods/2015-06/556bcdd4a7bff.jpg', '25', '15', '4.0', '3.0', '2334', '0', '0', '0', '0', '盒', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '261', '270', '129', '135', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150601/20150601031422_31860.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:14:28', null, '0');
INSERT INTO `wst_goods` VALUES ('149', '34334', '日本山洋 国产良品 安心棉棒 200支 筒装', 'Upload/goods/2015-06/556bced541fe4.jpg', 'Upload/goods/2015-06/556bced541fe4.jpg', '25', '15', '5.0', '3.0', '3243', '0', '0', '0', '0', '筒', '200支/筒', '1', '1', '1', '1', '1', '0', '0', null, '48', '261', '271', '129', '135', '&lt;p&gt;\n	wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/product/wstmall/Upload/image/20150601/20150601031845_55725.jpg&quot; alt=&quot;&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:18:47', null, '0');
INSERT INTO `wst_goods` VALUES ('150', '4353', '日本山洋 湿性棉棒50支 独立包装', 'Upload/goods/2015-06/556bcf47b9c30.jpg', 'Upload/goods/2015-06/556bcf47b9c30.jpg', '25', '15', '8.0', '6.0', '53534', '0', '0', '0', '0', '包', '50支', '1', '1', '1', '1', '1', '0', '0', null, '48', '261', '271', '129', '135', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;日本山洋 湿性棉棒50支 独立包装&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150601/20150601032017_35235.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:20:18', null, '0');
INSERT INTO `wst_goods` VALUES ('151', '44535', '日本山洋 国产良品 挖耳勺棉棒100支 独立包装', 'Upload/goods/2015-06/556bcf9b074d1.jpg', 'Upload/goods/2015-06/556bcf9b074d1.jpg', '25', '15', '9.0', '7.0', '35345', '0', '0', '0', '0', '袋', '100支', '1', '1', '1', '1', '1', '0', '0', null, '48', '261', '271', '129', '135', '100支，测试商品，请勿下单', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:21:41', null, '0');
INSERT INTO `wst_goods` VALUES ('152', '53453', 'HS黑色垃圾袋80*100cm 10只*2卷', 'Upload/goods/2015-06/556bd01365c44.jpg', 'Upload/goods/2015-06/556bd01365c44.jpg', '27', '15', '12.0', '11.0', '12324', '0', '0', '0', '0', '卷', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '261', '268', '129', '137', 'HS黑色垃圾袋80*100cm 10只*2卷', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:23:31', null, '0');
INSERT INTO `wst_goods` VALUES ('153', '5345345', '新天力炫彩纸杯（柔版印刷）240ml （100只装', 'Upload/goods/2015-06/556bd088905cb.jpg', 'Upload/goods/2015-06/556bd088905cb.jpg', '28', '15', '21.0', '19.0', '235345', '0', '0', '0', '0', '袋', '100只装', '1', '1', '1', '1', '1', '0', '0', null, '48', '261', '270', '129', '136', '测试商品，请勿下单', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:25:44', null, '0');
INSERT INTO `wst_goods` VALUES ('154', '35335', '新天力晶莹航旅杯250ml （60只装）', 'Upload/goods/2015-06/556bd1007f005.jpg', 'Upload/goods/2015-06/556bd1007f005.jpg', '28', '15', '23.0', '21.0', '4234243', '0', '0', '0', '0', '袋', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '261', '269', '129', '136', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;新天力晶莹航旅杯250ml （60只装）&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;测试商品，请勿下单&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150601/20150601032649_54571.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:26:58', null, '0');
INSERT INTO `wst_goods` VALUES ('155', '34535', '龙士达鞋套', 'Upload/goods/2015-06/556bd12a99d94.jpg', 'Upload/goods/2015-06/556bd12a99d94.jpg', '28', '15', '34.0', '23.0', '2342', '0', '0', '0', '0', '袋', '', '1', '1', '1', '1', '1', '0', '0', null, '48', '261', '272', '129', '134', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;龙士达鞋套&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;龙士达鞋套&lt;/span&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;br /&gt;\n&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;font-family:Tahoma, \'microsoft yahei\';font-size:20px;font-weight:bold;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;img src=&quot;/product/wstmall/Upload/image/20150601/20150601032811_45474.gif&quot; alt=&quot;&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 11:28:13', null, '0');
INSERT INTO `wst_goods` VALUES ('156', '23424', '雀巢全家营养甜奶粉 300g', 'Upload/goods/2015-06/556be798974c1.jpg', 'Upload/goods/2015-06/556be798974c1.jpg', '29', '20', '25.0', '23.0', '23433', '0', '0', '0', '0', '包', '300g', '1', '1', '1', '1', '1', '0', '0', null, '49', '82', '300', '147', '148', '&lt;p&gt;\n	wstmall 测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601050426_96544.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 13:04:29', null, '0');
INSERT INTO `wst_goods` VALUES ('157', '2342234', '雀巢全脂奶粉400G', 'Upload/goods/2015-06/556be7fa1961d.jpg', 'Upload/goods/2015-06/556be7fa1961d.jpg', '29', '20', '35.0', '34.0', '3234', '0', '0', '0', '0', '包', '400g', '1', '1', '1', '1', '1', '0', '0', null, '49', '82', '301', '147', '148', '&lt;p&gt;\n	测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601050553_69087.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 13:05:55', null, '0');
INSERT INTO `wst_goods` VALUES ('158', '543455', '雀巢 全脂 奶粉 听装 900g', 'Upload/goods/2015-06/556bf94fb0d31.jpg', 'Upload/goods/2015-06/556bf94fb0d31.jpg', '29', '20', '564.0', '345.0', '293472984', '0', '0', '0', '0', '听', ' 900g/听', '1', '1', '1', '1', '1', '0', '0', null, '49', '82', '300', '147', '148', '&lt;p&gt;\n	雀巢咖啡，wstmall测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601062026_13361.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 14:20:28', null, '0');
INSERT INTO `wst_goods` VALUES ('159', '345324', '雀巢 中老年 奶粉 营养奶粉 850g/罐', 'Upload/goods/2015-06/556bf9fa39c55.jpg', 'Upload/goods/2015-06/556bf9fa39c55.jpg', '29', '20', '456.0', '342.0', '3453', '0', '0', '0', '0', '罐', '850g/罐', '1', '1', '1', '1', '1', '0', '0', null, '49', '82', '301', '147', '148', '&lt;p&gt;\n	wstmall测试商品请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601062209_84023.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 14:22:10', null, '0');
INSERT INTO `wst_goods` VALUES ('160', '23534', '雀巢健心中老年奶粉 900g', 'Upload/goods/2015-06/556c12e77f4d1.jpg', 'Upload/goods/2015-06/556c12e77f4d1.jpg', '29', '20', '234.0', '232.0', '235435', '0', '0', '0', '0', '罐', '900g', '1', '1', '1', '1', '1', '0', '0', null, '49', '82', '301', '155', '156', '&lt;p&gt;\n	雀巢奶粉 请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601080921_36087.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:09:34', null, '0');
INSERT INTO `wst_goods` VALUES ('161', '35345', '伊利 中老年 奶粉 900g', 'Upload/goods/2015-06/556c1478e6a92.jpg', 'Upload/goods/2015-06/556c1478e6a92.jpg', '30', '20', '67.0', '65.0', '543535', '0', '0', '0', '0', '罐', '900g', '1', '1', '1', '1', '1', '0', '0', null, '49', '82', '305', '155', '156', '&lt;p&gt;\n	伊利奶粉，伊利奶粉\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601081538_82704.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:15:39', null, '0');
INSERT INTO `wst_goods` VALUES ('162', '5345345', '伊利 女士 营养奶粉 (方便装) 400g', 'Upload/goods/2015-06/556c150e5366a.jpg', 'Upload/goods/2015-06/556c150e5366a.jpg', '30', '20', '46.0', '42.0', '435345', '0', '0', '0', '0', '袋', '400g', '1', '1', '1', '1', '1', '0', '0', null, '49', '82', '301', '155', '156', '&lt;p&gt;\n	伊利奶粉，伊利奶粉\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601081812_74948.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:18:14', null, '0');
INSERT INTO `wst_goods` VALUES ('163', '345646', '雀巢全家营养甜奶粉 300g', 'Upload/goods/2015-06/556c158dd3c75.jpg', 'Upload/goods/2015-06/556c158dd3c75.jpg', '30', '20', '234.0', '231.0', '24324', '0', '0', '0', '0', '袋', '300g', '1', '1', '1', '1', '1', '0', '0', null, '49', '82', '305', '155', '156', '&lt;p&gt;\n	伊利奶粉\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601082004_64071.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:20:13', null, '0');
INSERT INTO `wst_goods` VALUES ('164', '345345445', '红牛维生素功能饮料250ml', 'Upload/goods/2015-06/556c178551085.jpg', 'Upload/goods/2015-06/556c178551085.jpg', '31', '20', '6.0', '5.0', '3454354', '0', '0', '0', '0', '罐', '250ml', '1', '1', '1', '1', '1', '0', '0', null, '49', '81', '313', '151', '152', '&lt;p&gt;\n	红牛功能饮料\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601082833_25493.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:28:36', null, '0');
INSERT INTO `wst_goods` VALUES ('165', '324872', '佳得乐橙味运动饮料600ml', 'Upload/goods/2015-06/556c17c8a116a.jpg', 'Upload/goods/2015-06/556c17c8a116a.jpg', '32', '20', '7.0', '4.0', '34543', '0', '0', '0', '0', '瓶', '600ml', '1', '1', '1', '1', '1', '0', '0', null, '49', '81', '304', '151', '154', '&lt;p&gt;\n	测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601082948_66288.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:29:50', null, '0');
INSERT INTO `wst_goods` VALUES ('166', '9457395', '美年达橙味汽水330ml 罐装', 'Upload/goods/2015-06/556c184e97298.jpg', 'Upload/goods/2015-06/556c184e97298.jpg', '33', '20', '7.0', '4.0', '345345', '0', '0', '0', '0', '罐', '330ml', '1', '1', '1', '1', '1', '0', '0', null, '49', '81', '316', '151', '153', '&lt;p&gt;\n	么么哒。。。\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601083150_72034.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:31:54', null, '0');
INSERT INTO `wst_goods` VALUES ('167', '234924', '芬达橙味汽水330ml 罐装', 'Upload/goods/2015-06/556c18c22109e.jpg', 'Upload/goods/2015-06/556c18c22109e.jpg', '34', '20', '6.0', '4.0', '235345', '0', '0', '0', '0', '罐', '330ml', '1', '1', '1', '1', '1', '0', '0', null, '49', '81', '316', '151', '153', '&lt;p&gt;\n	芬达饮料\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601083337_41755.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:33:39', null, '0');
INSERT INTO `wst_goods` VALUES ('168', '34535', '康师傅掌中包冰红茶250ml', 'Upload/goods/2015-06/556c1956bd0cf.jpg', 'Upload/goods/2015-06/556c1956bd0cf.jpg', '35', '20', '5.0', '3.0', '3543523', '0', '0', '0', '0', '瓶', '250ml', '1', '1', '1', '1', '1', '0', '0', null, '49', '81', '304', '151', '154', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;康师傅掌中包冰红茶250ml&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;康师傅掌中包冰红茶250ml&lt;/span&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;康师傅掌中包冰红茶250ml&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601083622_87489.jpg&quot; /&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:36:31', null, '0');
INSERT INTO `wst_goods` VALUES ('169', '23435', '康师傅冰红茶1L', 'Upload/goods/2015-06/556c19ce46b97.jpg', 'Upload/goods/2015-06/556c19ce46b97.jpg', '35', '20', '12.0', '10.0', '353453', '0', '0', '0', '0', '瓶', '1L', '1', '1', '1', '1', '1', '0', '0', null, '49', '81', '304', '151', '154', '&lt;p&gt;\n	康师傅冰红茶\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601083823_40278.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:38:26', null, '0');
INSERT INTO `wst_goods` VALUES ('170', '234934', '康师傅冰红茶550ml', 'Upload/goods/2015-06/556c1a1362f29.jpg', 'Upload/goods/2015-06/556c1a1362f29.jpg', '35', '20', '10.0', '8.0', '4353', '0', '0', '0', '0', '瓶', '550ml', '1', '1', '1', '1', '1', '0', '0', null, '49', '81', '304', '151', '153', '&lt;p&gt;\n	康师傅冰红茶\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601083934_83959.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:39:36', null, '0');
INSERT INTO `wst_goods` VALUES ('171', '3534535', '美汁源果粒橙1.25L', 'Upload/goods/2015-06/556c1ab6e390b.jpg', 'Upload/goods/2015-06/556c1ab6e390b.jpg', '36', '20', '9.0', '5.0', '54435345', '0', '0', '0', '0', '瓶', '1.25L', '1', '1', '1', '1', '1', '0', '0', null, '49', '81', '304', '151', '153', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;美汁源果粒橙1.25L&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;美汁源果粒橙1.25L&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;美汁源果粒橙1.25L&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601084207_17671.jpg&quot; /&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:42:17', null, '0');
INSERT INTO `wst_goods` VALUES ('172', '3493845', '太古纯正方糖454G', 'Upload/goods/2015-06/556c1d20dc9bc.jpg', 'Upload/goods/2015-06/556c1d20dc9bc.jpg', '37', '20', '15.0', '13.0', '3242334', '0', '0', '0', '0', '盒', '454g', '1', '1', '1', '1', '1', '0', '0', null, '49', '79', '302', '147', '149', '&lt;p&gt;\n	太古咖啡伴侣。。。\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601085234_42255.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:52:36', null, '0');
INSERT INTO `wst_goods` VALUES ('173', '354345', '雀巢 1+2原味咖啡 15克x42条装 630克', 'Upload/goods/2015-06/556c1d680fc6b.jpg', 'Upload/goods/2015-06/556c1d680fc6b.jpg', '29', '20', '45.0', '35.0', '35345', '0', '0', '0', '0', '盒', '15克x42条', '1', '1', '1', '1', '1', '0', '0', null, '49', '79', '308', '147', '148', '&lt;p&gt;\n	雀巢速溶咖啡\n&lt;/p&gt;\n&lt;p&gt;\n	wstmall测试商品请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601085415_74720.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:54:18', null, '0');
INSERT INTO `wst_goods` VALUES ('174', '53535', '麦斯威尔 原味 咖啡 42条装', 'Upload/goods/2015-06/556c1e0d685c1.jpg', 'Upload/goods/2015-06/556c1e0d685c1.jpg', '38', '20', '53.0', '51.0', '23425', '0', '0', '0', '0', '盒', '42条装', '1', '1', '1', '1', '1', '0', '0', null, '49', '79', '299', '147', '148', '&lt;p&gt;\n	42条装 咖啡\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601085624_38336.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:56:32', null, '0');
INSERT INTO `wst_goods` VALUES ('175', '23252', '可比可拿铁咖啡24*21.25G', 'Upload/goods/2015-06/556c1ea35883d.jpg', 'Upload/goods/2015-06/556c1ea35883d.jpg', '39', '20', '56.0', '50.0', '353453', '0', '0', '0', '0', '盒', '24*21.25G', '1', '1', '1', '1', '1', '0', '0', null, '49', '79', '298', '147', '148', '&lt;p&gt;\n	24*21.25G 卡比克拿铁咖啡\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601085905_63047.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 16:59:15', null, '0');
INSERT INTO `wst_goods` VALUES ('176', '234242', '可比可摩卡咖啡24*24.25G', 'Upload/goods/2015-06/556c1f1c4faae.jpg', 'Upload/goods/2015-06/556c1f1c4faae.jpg', '39', '20', '67.0', '55.0', '234234', '0', '0', '0', '0', '盒', '24*24.25G', '1', '1', '1', '1', '1', '0', '0', null, '49', '79', '298', '147', '148', '&lt;p&gt;\n	24*24.25G24*24.25G\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601090052_63709.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:01:04', null, '0');
INSERT INTO `wst_goods` VALUES ('177', '5353453', '日本进口AGF maxim马克西姆速溶咖啡180g', 'Upload/goods/2015-06/556c1ff672852.jpg', 'Upload/goods/2015-06/556c1ff672852.jpg', '29', '20', '345.0', '234.0', '234234', '0', '0', '0', '0', '罐', '180g', '1', '1', '1', '1', '1', '0', '0', null, '49', '79', '298', '147', '148', '&lt;p&gt;\n	速溶咖啡\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601090510_20261.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:05:12', null, '0');
INSERT INTO `wst_goods` VALUES ('178', '353543', '摩卡家庭套装15G*42', 'Upload/goods/2015-06/556c20c39ed91.jpg', 'Upload/goods/2015-06/556c20c39ed91.jpg', '40', '20', '35.0', '34.0', '2342342', '0', '0', '0', '0', '盒', '15G*42', '1', '1', '1', '1', '1', '0', '0', null, '49', '79', '299', '147', '148', '&lt;p&gt;\n	摩卡咖啡\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601090759_17803.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:08:01', null, '0');
INSERT INTO `wst_goods` VALUES ('179', '354335', '雀巢咖啡1+2原味 100*15g', 'Upload/goods/2015-06/556c211be5457.jpg', 'Upload/goods/2015-06/556c211be5457.jpg', '29', '20', '35.0', '32.0', '35345', '0', '0', '0', '0', '盒', ' 100*15g', '1', '1', '1', '1', '1', '0', '0', null, '49', '79', '308', '147', '148', '&lt;p&gt;\n	雀巢咖啡\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601090910_64689.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:09:21', null, '0');
INSERT INTO `wst_goods` VALUES ('180', '335345', '金龙鱼黄金比例食用调和油5000ml', 'Upload/goods/2015-06/556c24e57b479.jpg', 'Upload/goods/2015-06/556c24e57b479.jpg', '44', '23', '65.0', '55.0', '3434535', '0', '0', '0', '0', '瓶', '5000ml', '1', '1', '1', '1', '1', '0', '0', null, '50', '220', '242', '157', '161', '&lt;p&gt;\n	5000ml金龙鱼油\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601092749_32142.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:27:50', null, '0');
INSERT INTO `wst_goods` VALUES ('181', '4535345', '金龙鱼精炼一级大豆油1800ml', 'Upload/goods/2015-06/556c25bb80825.jpg', 'Upload/goods/2015-06/556c25bb80825.jpg', '44', '23', '32.0', '23.0', '23423', '0', '0', '0', '0', '瓶', '1800ml', '1', '1', '1', '1', '1', '0', '0', null, '50', '220', '242', '157', '161', '&lt;p&gt;\n	金龙鱼油\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601092905_30335.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:29:08', null, '0');
INSERT INTO `wst_goods` VALUES ('182', '372494', '福临门非转基因纯正玉米油4L', 'Upload/goods/2015-06/556c26d6cc7c0.jpg', 'Upload/goods/2015-06/556c26d6cc7c0.jpg', '41', '23', '65.0', '54.0', '34535', '0', '0', '0', '0', '瓶', '4L', '1', '1', '1', '1', '1', '0', '0', null, '50', '220', '244', '157', '161', '&lt;p&gt;\n	福临门\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601093346_82182.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:33:54', null, '0');
INSERT INTO `wst_goods` VALUES ('183', '32432534', '鲁花5S压榨一级花生油5L（非转）送酱油', 'Upload/goods/2015-06/556c27b4d9fc0.jpg', 'Upload/goods/2015-06/556c27b4d9fc0.jpg', '42', '23', '150.0', '140.0', '34935', '0', '0', '0', '0', '瓶', '5L', '1', '1', '1', '1', '1', '0', '0', null, '50', '220', '245', '157', '162', '&lt;p&gt;\n	鲁花花生油\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601093754_85769.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:38:00', null, '0');
INSERT INTO `wst_goods` VALUES ('184', '35435345', '多力5珍宝葵花籽非转基因调和油5L', 'Upload/goods/2015-06/556c284f4565c.jpg', 'Upload/goods/2015-06/556c284f4565c.jpg', '43', '23', '65.0', '60.0', '3545', '0', '0', '0', '0', '瓶', '5L', '1', '1', '1', '1', '1', '0', '0', null, '50', '220', '242', '157', '161', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;多力5珍宝葵花籽非转基因调和油5L&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601094005_84674.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:40:07', null, '0');
INSERT INTO `wst_goods` VALUES ('185', '34534345', '多力mighty 橄榄葵花油2.5L 食用油 非转', 'Upload/goods/2015-06/556c28d145513.jpg', 'Upload/goods/2015-06/556c28d145513.jpg', '43', '23', '345.0', '232.0', '3244353', '0', '0', '0', '0', '瓶', '2.5L', '1', '1', '1', '1', '1', '0', '0', null, '50', '220', '242', '157', '161', '&lt;p&gt;\n	多力调和油\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601094224_81238.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:42:28', null, '0');
INSERT INTO `wst_goods` VALUES ('186', '353543', '福临门非转基因葵花籽油5L/桶+900ml/瓶', 'Upload/goods/2015-06/556c293daa031.jpg', 'Upload/goods/2015-06/556c293daa031.jpg', '41', '23', '234.0', '123.0', '2342', '0', '0', '0', '0', '瓶', '5L/桶+900ml/瓶', '1', '1', '1', '1', '1', '0', '0', null, '50', '220', '242', '157', '161', '&lt;p&gt;\n	福临门调和油\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601094414_98165.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:44:20', null, '0');
INSERT INTO `wst_goods` VALUES ('187', '343535', '金龙鱼深海调和油1800ml（非转）', 'Upload/goods/2015-06/556c2a1f246dc.jpg', 'Upload/goods/2015-06/556c2a1f246dc.jpg', '44', '23', '78.0', '56.0', '345345', '0', '0', '0', '0', '瓶', '1800ml', '1', '1', '1', '1', '1', '0', '0', null, '50', '220', '242', '157', '161', '&lt;p&gt;\n	金龙鱼花生油&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601094753_92295.jpg&quot; /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 17:47:56', null, '0');
INSERT INTO `wst_goods` VALUES ('188', '239427', '真真老老真传礼盒 1.28kg', 'Upload/goods/2015-06/556c2c2790f4d.jpg', 'Upload/goods/2015-06/556c2c2790f4d.jpg', '45', '23', '78.0', '68.0', '2532445', '0', '0', '0', '0', '盒', '1.28kg', '1', '1', '1', '1', '1', '0', '0', null, '50', '223', '333', '160', '168', '&lt;p&gt;\n	真真老老粽子\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601100028_65055.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 18:00:36', null, '0');
INSERT INTO `wst_goods` VALUES ('189', '3454', '五芳斋 丰年五芳礼盒粽子（100g*24）', 'Upload/goods/2015-06/556c2dd2d7f1f.jpg', 'Upload/goods/2015-06/556c2dd2d7f1f.jpg', '46', '23', '234.0', '190.0', '234324', '0', '0', '0', '0', '盒', '100g*24', '1', '1', '1', '1', '1', '0', '0', null, '50', '223', '333', '160', '169', '&lt;p&gt;\n	100g*24\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601100352_86451.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 18:03:53', null, '0');
INSERT INTO `wst_goods` VALUES ('190', '45345435', '银鹭 椰果 八宝粥 360g*8瓶/箱', 'Upload/goods/2015-06/556c2e7f4dac9.jpg', 'Upload/goods/2015-06/556c2e7f4dac9.jpg', '47', '23', '32.0', '28.0', '324234', '0', '0', '0', '0', '箱', '360g*8瓶/箱', '1', '1', '1', '1', '1', '0', '0', null, '50', '223', '235', '160', '169', '&lt;p&gt;\n	360g*8瓶/箱\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601100747_53448.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 18:08:44', null, '0');
INSERT INTO `wst_goods` VALUES ('191', '3423', '2014年新米 常金东北小粒王10kg', 'Upload/goods/2015-06/556c4699eb9c6.jpg', 'Upload/goods/2015-06/556c4699eb9c6.jpg', '44', '23', '78.0', '69.0', '534535', '0', '0', '0', '0', '包', '10kg', '1', '1', '1', '1', '1', '0', '0', null, '50', '221', '229', '158', '163', '&lt;p&gt;\n	2014年新米 常金东北小粒王10kg\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601114945_28374.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 19:49:47', null, '0');
INSERT INTO `wst_goods` VALUES ('192', '54345', '福临门赋香稻5KG', 'Upload/goods/2015-06/556c46fd65d9b.jpg', 'Upload/goods/2015-06/556c46fd65d9b.jpg', '41', '23', '67.0', '46.0', '23434', '0', '0', '0', '0', '包', '5kg', '1', '1', '1', '1', '1', '0', '0', null, '50', '221', '229', '158', '163', '&lt;p&gt;\n	福临门大米\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601115058_41429.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 19:51:01', null, '0');
INSERT INTO `wst_goods` VALUES ('193', '4535', '福兴米业富大院 五常一品稻花香大米 绿色食品500', 'Upload/goods/2015-06/556c473ede734.jpg', 'Upload/goods/2015-06/556c473ede734.jpg', '41', '23', '4.0', '3.0', '3453453', '0', '0', '0', '0', '斤', '500g', '1', '1', '1', '1', '1', '0', '0', null, '50', '221', '229', '158', '163', '&lt;p&gt;\n	大米\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601115207_99252.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 19:52:14', null, '0');
INSERT INTO `wst_goods` VALUES ('194', '354345', '福临门五常稻花香米 大米5kg', 'Upload/goods/2015-06/556c479108a32.jpg', 'Upload/goods/2015-06/556c479108a32.jpg', '41', '23', '46.0', '40.0', '345345', '0', '0', '0', '0', '包', '5kg', '1', '1', '1', '1', '1', '0', '0', null, '50', '221', '229', '158', '163', '&lt;p&gt;\n	福临门大米\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601115327_86552.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 19:53:41', null, '0');
INSERT INTO `wst_goods` VALUES ('195', '234234', '常金真的好 软玉粳米 10kg', 'Upload/goods/2015-06/556c47d7c191f.jpg', 'Upload/goods/2015-06/556c47d7c191f.jpg', '41', '23', '78.0', '76.0', '345435', '0', '0', '0', '0', '包', '10kg', '1', '1', '1', '1', '1', '0', '0', null, '50', '221', '229', '158', '163', '&lt;p&gt;\n	常金大米，真的好\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601115442_53816.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 19:54:45', null, '0');
INSERT INTO `wst_goods` VALUES ('196', '345345', '大山第一村 北纬30°神奇大米 米宝宝 老人小孩营', 'Upload/goods/2015-06/556c48551076a.jpg', 'Upload/goods/2015-06/556c48551076a.jpg', '41', '23', '45.0', '40.0', '35345', '0', '0', '0', '0', '包', '500g', '1', '1', '1', '1', '1', '0', '0', null, '50', '221', '229', '158', '163', '&lt;p&gt;\n	大米\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601115554_94353.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 19:56:06', null, '0');
INSERT INTO `wst_goods` VALUES ('197', '43544', 'wstmall测试商品 金龙鱼原香稻10KG', 'Upload/goods/2015-06/556c4876e8ef2.jpg', 'Upload/goods/2015-06/556c4876e8ef2.jpg', '44', '23', '89.0', '57.0', '345345', '0', '0', '0', '0', '包', '10kg', '1', '1', '1', '1', '1', '0', '0', null, '50', '221', '229', '158', '163', '&lt;p&gt;\n	金龙鱼大米\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601115717_28432.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 19:57:32', null, '0');
INSERT INTO `wst_goods` VALUES ('198', '3454365', 'wstmall测试商品 金龙鱼软香稻10KG', 'Upload/goods/2015-06/556c48c34bb35.jpg', 'Upload/goods/2015-06/556c48c34bb35.jpg', '44', '23', '56.0', '35.0', '234232', '0', '0', '0', '0', '袋', '10kg', '1', '1', '1', '1', '1', '0', '0', null, '50', '221', '229', '158', '163', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;金龙鱼软香稻10KG&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601115834_15355.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 19:58:35', null, '0');
INSERT INTO `wst_goods` VALUES ('199', '426546', 'wstmall 金龙鱼 敦化黄大豆 400g/袋', 'Upload/goods/2015-06/556c4967e6d9b.jpg', 'Upload/goods/2015-06/556c4967e6d9b.jpg', '44', '23', '8.0', '7.0', '343543', '0', '0', '0', '0', '袋', '400g/袋', '1', '1', '1', '1', '1', '0', '0', null, '50', '222', '240', '159', '164', '&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601120125_73555.jpg&quot; /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	金龙鱼杂粮\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:01:33', null, '0');
INSERT INTO `wst_goods` VALUES ('200', '35433', 'wstmall 金龙鱼 宝清红小豆 400g/袋', 'Upload/goods/2015-06/556c49be4f838.jpg', 'Upload/goods/2015-06/556c49be4f838.jpg', '44', '23', '32.0', '23.0', '23423', '0', '0', '0', '0', '袋', '400g', '1', '1', '1', '1', '1', '0', '0', null, '50', '222', '240', '159', '164', '&lt;p&gt;\n	金龙鱼杂粮\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601120251_42321.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:02:54', null, '0');
INSERT INTO `wst_goods` VALUES ('201', '3534535', '金龙鱼 九种杂粮精品礼盒3600克', 'Upload/goods/2015-06/556c4a0e0d504.jpg', 'Upload/goods/2015-06/556c4a0e0d504.jpg', '44', '23', '100.0', '90.0', '55443', '0', '0', '0', '0', '袋', '3600克', '1', '1', '1', '1', '1', '0', '0', null, '50', '222', '240', '159', '164', '&lt;p&gt;\n	杂粮\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601120406_25147.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:04:17', null, '0');
INSERT INTO `wst_goods` VALUES ('202', '453543', 'FF 五谷杂粮礼盒4KG', 'Upload/goods/2015-06/556c4a50146d6.jpg', 'Upload/goods/2015-06/556c4a50146d6.jpg', '44', '23', '100.0', '92.0', '0', '0', '0', '0', '0', '袋', '4000g', '1', '1', '1', '1', '1', '0', '0', null, '50', '222', '238', '159', '165', '&lt;p&gt;\n	五谷杂粮\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601120514_71597.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:05:16', null, '0');
INSERT INTO `wst_goods` VALUES ('203', '345436', 'wstmall 测试商品 巴马杂粮礼盒', 'Upload/goods/2015-06/556c4a97a6acb.jpg', 'Upload/goods/2015-06/556c4a97a6acb.jpg', '44', '23', '300.0', '275.0', '34242', '0', '0', '0', '0', '盒', '', '1', '1', '1', '1', '1', '0', '0', null, '50', '222', '241', '159', '166', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;巴马杂粮礼盒&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601120637_11708.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:06:39', null, '0');
INSERT INTO `wst_goods` VALUES ('204', '234323', 'wstmall 测试商品 FOOD 血糯米 1KG', 'Upload/goods/2015-06/556c4f8bc0843.jpg', 'Upload/goods/2015-06/556c4f8bc0843.jpg', '46', '23', '40.0', '35.0', '234234', '0', '0', '0', '0', '袋', '500g', '1', '1', '1', '1', '1', '0', '0', null, '50', '222', '238', '159', '164', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;FINE FOOD 血糯米 1KG&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601122753_46817.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:28:06', null, '0');
INSERT INTO `wst_goods` VALUES ('205', '34535345', 'wstmall测试商品 农家有机黄豆 500G', 'Upload/goods/2015-06/556c4ff97aefe.jpg', 'Upload/goods/2015-06/556c4ff97aefe.jpg', '46', '23', '10.0', '8.0', '34335', '0', '0', '0', '0', '袋', '500g', '1', '1', '1', '1', '1', '0', '0', null, '50', '222', '240', '159', '166', '&lt;p&gt;\n	测试商品\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601122933_38795.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:29:37', null, '0');
INSERT INTO `wst_goods` VALUES ('206', '23432543', '新货 有机黄小米 小米 有机五谷杂粮500G', 'Upload/goods/2015-06/556c506a901e2.jpg', 'Upload/goods/2015-06/556c506a901e2.jpg', '47', '23', '34.0', '32.0', '234324', '0', '0', '0', '0', '袋', '500g', '1', '1', '1', '1', '1', '0', '0', null, '50', '222', '237', '159', '164', '&lt;p&gt;\n	健康小米\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601123115_96184.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:31:17', null, '0');
INSERT INTO `wst_goods` VALUES ('207', '242342', 'Walch/威露士恩兔女性护理液200mlx2私处', 'Upload/goods/2015-06/556c526987406.jpg', 'Upload/goods/2015-06/556c526987406.jpg', '48', '27', '56.0', '45.0', '234243', '0', '0', '0', '0', '瓶', '200mlx2', '1', '1', '1', '1', '1', '0', '0', null, '51', '166', '178', '170', '171', '&lt;p&gt;\n	200mlx2\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601124013_10195.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:40:14', null, '0');
INSERT INTO `wst_goods` VALUES ('208', '3242423', '娇妍美白沐浴露220ml 滋润洁阴辟除异味 正品', 'Upload/goods/2015-06/556c536def0bc.jpg', 'Upload/goods/2015-06/556c536def0bc.jpg', '49', '27', '45.0', '34.0', '234234', '0', '0', '0', '0', '瓶', '220ml', '1', '1', '1', '1', '1', '0', '0', null, '51', '166', '178', '170', '171', '妍妍护理洗浴&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601124423_66532.jpg&quot; /&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:44:28', null, '0');
INSERT INTO `wst_goods` VALUES ('209', '324234', '女性私处护理产品 私处凝胶套盒 养巢护宫凝胶 滋阴', 'Upload/goods/2015-06/556c54628c075.jpg', 'Upload/goods/2015-06/556c54628c075.jpg', '50', '27', '456.0', '345.0', '234234', '0', '0', '0', '0', '瓶', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '166', '178', '170', '171', '&lt;p&gt;\n	巴黎小站\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601124819_17712.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:48:21', null, '0');
INSERT INTO `wst_goods` VALUES ('210', '34523453', '娇妍女性护理液220ml*迷迭香私处护理液200m', 'Upload/goods/2015-06/556c54f4676d5.jpg', 'Upload/goods/2015-06/556c54f4676d5.jpg', '49', '27', '89.0', '78.0', '24324', '0', '0', '0', '0', '瓶', '220ml', '1', '1', '1', '1', '1', '0', '0', null, '51', '166', '178', '170', '171', '&lt;p&gt;\n	妍妍护理\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601125057_54071.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:51:01', null, '0');
INSERT INTO `wst_goods` VALUES ('211', '3435', '施巴烫染修护洗发露400ml+施巴女性护理液200', 'Upload/goods/2015-06/556c56760116c.jpg', 'Upload/goods/2015-06/556c56760116c.jpg', '51', '27', '56.0', '45.0', '343', '0', '0', '0', '0', '瓶', '施巴烫染修护洗发露400ml+施巴女性护理液200', '1', '1', '1', '1', '1', '0', '0', null, '51', '166', '178', '170', '171', '&lt;p&gt;\n	施巴&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601125706_84547.jpg&quot; /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 20:57:09', null, '0');
INSERT INTO `wst_goods` VALUES ('212', '23424', '飞少女私处洗液止痒清爽泡沫护理液2瓶+卫生湿巾2包', 'Upload/goods/2015-06/556c572e8228b.jpg', 'Upload/goods/2015-06/556c572e8228b.jpg', '52', '27', '34.0', '23.0', '234242', '0', '0', '0', '0', '包', '清爽泡沫护理液2瓶+卫生湿巾2包', '1', '1', '1', '1', '1', '0', '0', null, '51', '166', '178', '170', '171', '&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601130010_80392.jpg&quot; /&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:00:28', null, '0');
INSERT INTO `wst_goods` VALUES ('213', '234324', '娇妍女性护理液pH4弱酸性220ml+女士私处美白', 'Upload/goods/2015-06/556c57dc28fd3.jpg', 'Upload/goods/2015-06/556c57dc28fd3.jpg', '49', '27', '54.0', '41.0', '4553453', '0', '0', '0', '0', '瓶', '女性护理液pH4弱酸性220ml+女士私处美白沐浴露', '1', '1', '1', '1', '1', '0', '0', null, '51', '166', '178', '170', '171', '妍妍\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	娇妍女性护理液pH4弱酸性220ml+女士私处美白沐浴露\n&lt;/h1&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601130306_49932.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:03:22', null, '0');
INSERT INTO `wst_goods` VALUES ('214', '345354', '西妮280ml女士私处护理液*女士专用湿巾1盒止痒', 'Upload/goods/2015-06/556c590d0877c.jpg', 'Upload/goods/2015-06/556c590d0877c.jpg', '53', '27', '56.0', '45.0', '34234234', '0', '0', '0', '0', '瓶', '280ml', '1', '1', '1', '1', '1', '0', '0', null, '51', '166', '178', '170', '171', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	西妮280ml女士私处护理液*女士专用湿巾1盒止痒杀菌抑菌除垢消炎\n&lt;/h1&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601130810_72056.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:08:12', null, '0');
INSERT INTO `wst_goods` VALUES ('215', '2423423', 'BEELY嫩红素乳晕嫩红霜下体嫩白淡化唇色纹粉嫩化', 'Upload/goods/2015-06/556c5d0988c78.jpg', 'Upload/goods/2015-06/556c5d0988c78.jpg', '54', '27', '134.0', '115.0', '343434', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '165', '172', '172', '173', '&lt;p&gt;\n	beely\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601132537_73630.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:25:38', null, '0');
INSERT INTO `wst_goods` VALUES ('216', '354355', 'Veet/薇婷香氛凝萃沐浴专用脱毛膏套装135ml', 'Upload/goods/2015-06/556c5dbfa8124.jpg', 'Upload/goods/2015-06/556c5dbfa8124.jpg', '55', '27', '342.0', '230.0', '43422424', '0', '0', '0', '0', '套', '香氛凝萃沐浴专用脱毛膏套装135ml+沐浴腋下专用100ml', '1', '1', '1', '1', '1', '0', '0', null, '51', '165', '172', '172', '173', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Veet/薇婷香氛凝萃沐浴专用脱毛膏套装135ml+沐浴腋下专用100ml\n&lt;/h1&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601132809_67752.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:28:21', null, '0');
INSERT INTO `wst_goods` VALUES ('217', '234235', 'Veet薇婷 滑丽 敏感肌 脱毛膏 套装 安全快速', 'Upload/goods/2015-06/556c5e3b90bd9.jpg', 'Upload/goods/2015-06/556c5e3b90bd9.jpg', '55', '27', '234.0', '231.0', '32423', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '165', '172', '172', '173', '&lt;p&gt;\n	进口美护\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601133018_17083.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:30:19', null, '0');
INSERT INTO `wst_goods` VALUES ('218', '43534', '嘉媚乐 玫瑰精华全身美白滋润保湿身体护理套装 淡香', 'Upload/goods/2015-06/556c5eadad3e3.jpg', 'Upload/goods/2015-06/556c5eadad3e3.jpg', '54', '27', '28.0', '23.0', '0', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '165', '172', '172', '173', '&lt;p&gt;\n	进口美护\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601133156_27308.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:32:06', null, '0');
INSERT INTO `wst_goods` VALUES ('219', '4234324', '番茄派足盐植物萃取泡脚足浴盐20袋套装', 'Upload/goods/2015-06/556c5f309c7d6.jpg', 'Upload/goods/2015-06/556c5f309c7d6.jpg', '56', '27', '342.0', '234.0', '234234', '0', '0', '0', '0', '套', '20袋', '1', '1', '1', '1', '1', '0', '0', null, '51', '165', '172', '172', '173', '&lt;p&gt;\n	番茄派\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	番茄派足盐植物萃取泡脚足浴盐20袋套装\n&lt;/h1&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601133422_84693.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:34:25', null, '0');
INSERT INTO `wst_goods` VALUES ('220', '345345', '欧丽丝纤体乳2件套 瘦腿霜瘦身霜减肥霜膏减肥贴燃脂', 'Upload/goods/2015-06/556c5ffaa793c.jpg', 'Upload/goods/2015-06/556c5ffaa793c.jpg', '57', '27', '45.0', '43.0', '42342', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '165', '172', '172', '173', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	欧丽丝纤体乳2件套 瘦腿霜瘦身霜减肥霜膏减肥贴燃脂肪产品\n&lt;/h1&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601133730_95635.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:37:32', null, '0');
INSERT INTO `wst_goods` VALUES ('221', '3435435', '玫瑰皙白清洁滋养三件套装 手工皂精油浴球沐浴膏', 'Upload/goods/2015-06/556c608dc79f9.jpg', 'Upload/goods/2015-06/556c608dc79f9.jpg', '58', '27', '90.0', '87.0', '678987', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '165', '172', '172', '173', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	玫瑰皙白清洁滋养三件套装 手工皂精油浴球沐浴膏\n&lt;/h1&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601134005_39682.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:40:07', null, '0');
INSERT INTO `wst_goods` VALUES ('222', '3453535', 'Rewiwax蕾沃斯正品腋窝手足部护理套装玫瑰脱毛', 'Upload/goods/2015-06/556c610bd789a.jpg', 'Upload/goods/2015-06/556c610bd789a.jpg', '59', '27', '45.0', '34.0', '3242342', '0', '0', '0', '0', '套', '', '1', '1', '1', '1', '1', '0', '0', null, '51', '165', '172', '172', '173', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Rewiwax蕾沃斯正品腋窝手足部护理套装玫瑰脱毛膏套装\n&lt;/h1&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601134203_85747.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:42:05', null, '0');
INSERT INTO `wst_goods` VALUES ('223', '234234', '天喔香脆腰果瓶装 565g', 'Upload/goods/2015-06/556c6516a0bf0.jpg', 'Upload/goods/2015-06/556c6516a0bf0.jpg', '0', '31', '100.0', '85.0', '353453', '0', '0', '0', '0', '罐', '565g', '1', '1', '1', '1', '1', '0', '0', null, '52', '189', '199', '174', '178', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;天喔香脆腰果瓶装 565g&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601135952_92968.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 21:59:54', null, '0');
INSERT INTO `wst_goods` VALUES ('224', '4345345', 'wstmall 测试商品 天喔小核桃仁纸罐200g', 'Upload/goods/2015-06/556c65863b5af.jpg', 'Upload/goods/2015-06/556c65863b5af.jpg', '0', '31', '90.0', '75.0', '34242', '0', '0', '0', '0', '罐', '200g', '1', '1', '1', '1', '1', '0', '0', null, '52', '189', '201', '174', '176', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;天喔小核桃仁纸罐 200g&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601140117_29835.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:01:28', null, '0');
INSERT INTO `wst_goods` VALUES ('225', '234523', 'wstmall 测试商品天喔自然开开心果 500g', 'Upload/goods/2015-06/556c65e44c216.jpg', 'Upload/goods/2015-06/556c65e44c216.jpg', '0', '31', '45.0', '34.0', '234234', '0', '0', '0', '0', '罐', '500g', '1', '1', '1', '1', '1', '0', '0', null, '52', '189', '199', '174', '175', '&lt;p&gt;\n	测试商品\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601140252_26130.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:03:05', null, '0');
INSERT INTO `wst_goods` VALUES ('226', '23425345', 'wstmall 测试商品 华味亨甘草西瓜子200g', 'Upload/goods/2015-06/556c663d5e8ef.jpg', 'Upload/goods/2015-06/556c663d5e8ef.jpg', '0', '31', '56.0', '45.0', '3453535', '0', '0', '0', '0', '袋', '200g', '1', '1', '1', '1', '1', '0', '0', null, '52', '190', '207', '174', '177', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;华味亨甘草西瓜子 200g&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601140438_70737.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:04:41', null, '0');
INSERT INTO `wst_goods` VALUES ('227', '234234', 'wstmall 测试商品 阿甘正馔巴旦木仁160g', 'Upload/goods/2015-06/556c6721093f2.jpg', 'Upload/goods/2015-06/556c6721093f2.jpg', '0', '31', '34.0', '32.0', '324243', '0', '0', '0', '0', '袋', '160g', '1', '1', '1', '1', '1', '0', '0', null, '52', '189', '199', '174', '175', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;阿甘正馔巴旦木仁 160g*1罐装&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601140812_89282.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:08:21', null, '0');
INSERT INTO `wst_goods` VALUES ('228', '342342', '百味林 坚果炒货零食扁桃仁 500g/散装', 'Upload/goods/2015-06/556c67678e5c8.jpg', 'Upload/goods/2015-06/556c67678e5c8.jpg', '0', '31', '50.0', '45.0', '578565', '0', '0', '0', '0', '袋', '500g', '1', '1', '1', '1', '1', '0', '0', null, '52', '189', '199', '174', '175', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;百味林 坚果炒货零食扁桃仁 500g/散装&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601140920_65423.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:09:23', null, '0');
INSERT INTO `wst_goods` VALUES ('229', '5345345', '百味林 休闲零食怪味花生 500g/散装', 'Upload/goods/2015-06/556c67a971f98.jpg', 'Upload/goods/2015-06/556c67a971f98.jpg', '0', '31', '45.0', '34.0', '232423', '0', '0', '0', '0', '袋', '500g', '1', '1', '1', '1', '1', '0', '0', null, '52', '189', '202', '174', '175', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;百味林 休闲零食怪味花生 500g/散装&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601141024_28613.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:10:25', null, '0');
INSERT INTO `wst_goods` VALUES ('230', '23425', 'wstmall 测试商品 华味亨开心果 180g', 'Upload/goods/2015-06/556c67f443e32.jpg', 'Upload/goods/2015-06/556c67f443e32.jpg', '0', '31', '23.0', '18.0', '3242423', '0', '0', '0', '0', '包', '180g', '1', '1', '1', '1', '1', '0', '0', null, '52', '189', '199', '174', '175', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;华味亨开心果 180g&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601141143_68881.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:11:51', null, '0');
INSERT INTO `wst_goods` VALUES ('231', '3223425', '瑞特斯波德德国进口巧克力 饼干牛奶巧克力 100g', 'Upload/goods/2015-06/556c692e6ff33.jpg', 'Upload/goods/2015-06/556c692e6ff33.jpg', '0', '31', '23.0', '21.0', '353442', '0', '0', '0', '0', '袋', '100g', '1', '1', '1', '1', '1', '0', '0', null, '52', '192', '218', '179', '180', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;瑞特斯波德德国进口巧克力 饼干夹心牛奶巧克力 100g/袋装&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601141656_34966.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:17:04', null, '0');
INSERT INTO `wst_goods` VALUES ('232', '23423534', '瑞特斯波德迷你七彩什锦巧克力 150g/袋装', 'Upload/goods/2015-06/556c697ab2cd6.jpg', 'Upload/goods/2015-06/556c697ab2cd6.jpg', '0', '31', '34.0', '32.0', '3242242', '0', '0', '0', '0', '袋', '150g', '1', '1', '1', '1', '1', '0', '0', null, '52', '192', '214', '179', '180', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;瑞特斯波德迷你七彩什锦巧克力 150g/袋装&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601141821_72649.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:18:36', null, '0');
INSERT INTO `wst_goods` VALUES ('233', '35345345', '瑞特斯波德全榛子黑巧克力100G', 'Upload/goods/2015-06/556c69dbef41f.jpg', 'Upload/goods/2015-06/556c69dbef41f.jpg', '0', '31', '45.0', '35.0', '23424', '0', '0', '0', '0', '袋', '100g', '1', '1', '1', '1', '1', '0', '0', null, '52', '192', '217', '179', '180', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;瑞特斯波德全榛子黑巧克力100G&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601141950_30343.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:19:58', null, '0');
INSERT INTO `wst_goods` VALUES ('234', '3294782', '瑞特斯波德全榛子白巧克力100G', 'Upload/goods/2015-06/556c6a3697d2e.jpg', 'Upload/goods/2015-06/556c6a3697d2e.jpg', '0', '31', '345.0', '234.0', '234325346', '0', '0', '0', '0', '袋', '100g', '1', '1', '1', '1', '1', '0', '0', null, '52', '192', '218', '179', '181', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;瑞特斯波德全榛子白巧克力100G&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601142144_78381.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:21:49', null, '0');
INSERT INTO `wst_goods` VALUES ('235', '35345', 'wstmall大山 原味脆皮花生 150G', 'Upload/goods/2015-06/556c6aa22f4be.jpg', 'Upload/goods/2015-06/556c6aa22f4be.jpg', '0', '31', '46.0', '34.0', '23425', '0', '0', '0', '0', '袋', '150g', '1', '1', '1', '1', '1', '0', '0', null, '52', '192', '214', '179', '181', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;大山 原味脆皮花生 150G&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601142301_43840.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:23:09', null, '0');
INSERT INTO `wst_goods` VALUES ('236', '2342565', 'wstmall测试商品费列罗钻石装巧克力礼盒 T2', 'Upload/goods/2015-06/556c6af924140.jpg', 'Upload/goods/2015-06/556c6af924140.jpg', '0', '31', '123.0', '100.0', '3243252', '0', '0', '0', '0', '盒', '24粒装 300g', '1', '1', '1', '1', '1', '0', '0', null, '52', '192', '216', '179', '180', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;24粒装 300g&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601142438_32409.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:25:44', null, '0');
INSERT INTO `wst_goods` VALUES ('237', '345345', '阿尔卑斯原味牛奶软糖138g袋装', 'Upload/goods/2015-06/556c6b829ea54.jpg', 'Upload/goods/2015-06/556c6b829ea54.jpg', '0', '31', '24.0', '20.0', '2342342', '0', '0', '0', '0', '包', '138g/袋', '1', '1', '1', '1', '1', '0', '0', null, '52', '192', '214', '179', '180', '&lt;p&gt;\n	阿尔卑斯原味牛奶软糖138g袋装\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601142706_90985.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:27:09', null, '0');
INSERT INTO `wst_goods` VALUES ('238', '23452455', 'wstmall 测试商品 都乐香蕉脆片90G', 'Upload/goods/2015-06/556c6bd8ca1e9.jpg', 'Upload/goods/2015-06/556c6bd8ca1e9.jpg', '0', '31', '255.0', '233.0', '24242', '0', '0', '0', '0', '包', '90g', '1', '1', '1', '1', '1', '0', '0', null, '52', '192', '214', '179', '181', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;都乐香蕉脆片90G&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601142825_72155.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:28:38', null, '0');
INSERT INTO `wst_goods` VALUES ('239', '3432235', 'wstmall 测试商品奥利奥金装香草慕斯味饼干', 'Upload/goods/2015-06/556c6c9bb54b4.jpg', 'Upload/goods/2015-06/556c6c9bb54b4.jpg', '0', '31', '68.0', '45.0', '2342524', '0', '0', '0', '0', '盒', '', '1', '1', '1', '1', '1', '0', '0', null, '52', '193', '197', '179', '182', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;奥利奥金装香草慕斯味饼干 318g&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601143202_31651.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:32:08', null, '0');
INSERT INTO `wst_goods` VALUES ('240', '423522', '新加坡进口 明治动物乐园饼干70g', 'Upload/goods/2015-06/556c6d1fda908.jpg', 'Upload/goods/2015-06/556c6d1fda908.jpg', '0', '31', '15.0', '13.0', '24324141', '0', '0', '0', '0', '盒', '70g', '1', '1', '1', '1', '1', '0', '0', null, '52', '193', '197', '179', '183', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;新加坡进口 明治动物乐园饼干70g&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601143340_77574.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:33:43', null, '0');
INSERT INTO `wst_goods` VALUES ('241', '3252352', 'wstmall 测试 韩国进口 乐天杰克饼300g', 'Upload/goods/2015-06/556c6d896b188.jpg', 'Upload/goods/2015-06/556c6d896b188.jpg', '0', '31', '34.0', '23.0', '2342414', '0', '0', '0', '0', '盒', '300g', '1', '1', '1', '1', '1', '0', '0', null, '52', '193', '197', '179', '183', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;韩国进口 乐天杰克饼干 300g&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601143528_46134.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:35:35', null, '0');
INSERT INTO `wst_goods` VALUES ('242', '22525', '马来西亚进口 滨司大嘴猴披萨酥巧克力豆味90g', 'Upload/goods/2015-06/556c6dccb83ef.jpg', 'Upload/goods/2015-06/556c6dccb83ef.jpg', '0', '31', '56.0', '45.0', '2424314', '0', '0', '0', '0', '盒', '90g', '1', '1', '1', '1', '1', '0', '0', null, '52', '193', '197', '179', '180', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;马来西亚进口 滨司大嘴猴披萨酥巧克力豆味90g&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601143639_99939.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:36:42', null, '0');
INSERT INTO `wst_goods` VALUES ('243', '324223', 'wstmall测试商品丹麦蓝罐曲奇礼盒 125G', 'Upload/goods/2015-06/556c6e1b7385a.jpg', 'Upload/goods/2015-06/556c6e1b7385a.jpg', '0', '31', '34.0', '23.0', '2147483647', '0', '0', '0', '0', '盒', '125g', '1', '1', '1', '1', '1', '0', '0', null, '52', '193', '197', '179', '183', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;丹麦蓝罐曲奇礼盒 125G&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601143758_73918.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:38:09', null, '0');
INSERT INTO `wst_goods` VALUES ('244', '32324', '露依饼干 120G 草莓果酱', 'Upload/goods/2015-06/556c6ee763052.jpg', 'Upload/goods/2015-06/556c6ee763052.jpg', '0', '31', '34.0', '32.0', '243322', '0', '0', '0', '0', '包', '120g', '1', '1', '1', '1', '1', '0', '0', null, '52', '193', '195', '179', '183', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;露依饼干 120G 草莓果酱&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;/span&gt;&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601144120_37498.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:41:25', null, '0');
INSERT INTO `wst_goods` VALUES ('245', '31312', 'wstmall测试商品 谷优优选饼干礼盒', 'Upload/goods/2015-06/556c6f571349d.jpg', 'Upload/goods/2015-06/556c6f571349d.jpg', '0', '31', '56.0', '45.0', '23423425', '0', '0', '0', '0', '盒', '', '1', '1', '1', '1', '1', '0', '0', null, '52', '193', '196', '179', '183', '&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;谷优优选饼干礼盒&lt;/span&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601144304_61067.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:43:20', null, '0');
INSERT INTO `wst_goods` VALUES ('246', '23543623', '日本 东京香蕉TOKYO BANANA长颈鹿麒麟香', 'Upload/goods/2015-06/556c6fa20a689.jpg', 'Upload/goods/2015-06/556c6fa20a689.jpg', '0', '31', '56.0', '34.0', '234233', '0', '0', '0', '0', '盒', '8枚', '1', '1', '1', '1', '1', '0', '0', null, '52', '193', '197', '179', '183', '&lt;p style=&quot;color:#666666;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	东京香蕉TOKYO BANANA长颈鹿麒麟香蕉蛋糕8枚&lt;br /&gt;\n【商品品牌】：日本东京香蕉TOKYO BANANA长颈鹿麒麟香蕉蛋糕8枚&lt;br /&gt;\n【保质期限】：保质期短7天务必注意&lt;br /&gt;\n【商品规格】：8枚/盒&lt;br /&gt;\n【商品产地】：日本&lt;br /&gt;\n【食用方法】：直接食用&lt;br /&gt;\n【保存方法】：请避免高温潮湿、直射日光，常温保存。\n&lt;/p&gt;\n&lt;p style=&quot;color:#666666;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	&lt;br /&gt;\n此食品赏味期限只有7天，较短，即食，不能接受者慎拍！\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:44:47', null, '0');
INSERT INTO `wst_goods` VALUES ('247', '234792', '养养 yumyum冬荫功面 酸辣虾味浓汤面 70g', 'Upload/goods/2015-06/556c72a1e9539.jpg', 'Upload/goods/2015-06/556c72a1e9539.jpg', '0', '31', '21.0', '18.0', '47866', '0', '0', '0', '0', '包', '70g', '1', '1', '1', '1', '1', '0', '0', null, '52', '191', '211', '179', '182', '&lt;h1 class=&quot;mh&quot; id=&quot;productMainName&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	养养 yumyum冬荫功面 酸辣虾味浓汤面 70g*5 泰国进口\n&lt;/h1&gt;\n&lt;p class=&quot;mh&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601145735_84163.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:57:39', null, '0');
INSERT INTO `wst_goods` VALUES ('248', '78576', 'KOKA可口牌 鸡汤面（非油炸拉面）85g*4 新', 'Upload/goods/2015-06/556c731d48b11.jpg', 'Upload/goods/2015-06/556c731d48b11.jpg', '0', '31', '34.0', '32.0', '23435345', '0', '0', '0', '0', '包', '85g*4 ', '1', '1', '1', '1', '1', '0', '0', null, '52', '191', '210', '179', '182', '&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	测试商品，请勿下单\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601145917_52118.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 22:59:19', null, '0');
INSERT INTO `wst_goods` VALUES ('249', '23479325', '可口 方便面 套餐多口味85g*10包 多口味泡面', 'Upload/goods/2015-06/556c736e4d85b.jpg', 'Upload/goods/2015-06/556c736e4d85b.jpg', '0', '31', '40.0', '37.0', '243242352', '0', '0', '0', '0', '袋', '10包', '1', '1', '1', '1', '1', '0', '0', null, '52', '191', '211', '179', '182', '&lt;h1 class=&quot;mh&quot; id=&quot;productMainName&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	可口 方便面 套餐多口味85g*10包 多口味泡面10包\n&lt;/h1&gt;\n&lt;p class=&quot;mh&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601150037_36130.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 23:00:38', null, '0');
INSERT INTO `wst_goods` VALUES ('250', '434543253', '可口 KOKA鸡汤味泡面 非油炸面条340g 新加', 'Upload/goods/2015-06/556c741432478.jpg', 'Upload/goods/2015-06/556c741432478.jpg', '0', '31', '45.0', '40.0', '242432', '0', '0', '0', '0', '包', '340g', '1', '1', '1', '1', '1', '0', '0', null, '52', '191', '210', '179', '182', '&lt;h1 class=&quot;mh&quot; id=&quot;productMainName&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	可口 KOKA鸡汤味泡面 非油炸面条340g 新加坡进口食品\n&lt;/h1&gt;\n&lt;p class=&quot;mh&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601150318_71844.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 23:03:28', null, '0');
INSERT INTO `wst_goods` VALUES ('251', '2345354', '可口 KOKA香辣芝麻汤味快熟面 非油炸4*85g', 'Upload/goods/2015-06/556c74750dc5b.jpg', 'Upload/goods/2015-06/556c74750dc5b.jpg', '0', '31', '45.0', '41.0', '3252352', '0', '0', '0', '0', '包', '4*85', '1', '1', '1', '1', '1', '0', '0', null, '52', '191', '211', '179', '182', '&lt;h1 class=&quot;mh&quot; id=&quot;productMainName&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	可口 KOKA香辣芝麻汤味快熟面 非油炸4*85g&lt;span class=&quot;Apple-converted-space&quot;&gt;&amp;nbsp;&lt;/span&gt;\n&lt;/h1&gt;\n&lt;h1 class=&quot;mh&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	&lt;span class=&quot;Apple-converted-space&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601150513_12812.jpg&quot; /&gt;&lt;/span&gt;\n&lt;/h1&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 23:05:21', null, '0');
INSERT INTO `wst_goods` VALUES ('252', '234928342', 'wstmall测试商品 东远 金枪鱼罐头 蔬菜味', 'Upload/goods/2015-06/556c74f22044b.jpg', 'Upload/goods/2015-06/556c74f22044b.jpg', '0', '31', '45.0', '40.0', '2342342', '0', '0', '0', '0', '罐', '100g', '1', '1', '1', '1', '1', '0', '0', null, '52', '191', '211', '179', '182', '&lt;h1 class=&quot;mh&quot; id=&quot;productMainName&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	东远 金枪鱼罐头 蔬菜味 100g 韩国进口\n&lt;/h1&gt;\n&lt;p class=&quot;mh&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601150700_65818.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 23:07:12', null, '0');
INSERT INTO `wst_goods` VALUES ('253', '3453636', '可口 KOKA 星洲叻沙 快熟面 油炸辣味 90g', 'Upload/goods/2015-06/556c758961ee6.jpg', 'Upload/goods/2015-06/556c758961ee6.jpg', '0', '31', '34.0', '23.0', '341241', '0', '0', '0', '0', '筒', '90g', '1', '1', '1', '1', '1', '0', '0', null, '52', '191', '211', '179', '182', '&lt;h1 class=&quot;mh&quot; id=&quot;productMainName&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	可口 KOKA 星洲叻沙 快熟面 油炸辣味 90g 新加坡进口\n&lt;/h1&gt;\n&lt;p class=&quot;mh&quot; style=&quot;color:#333333;text-indent:0px;font-family:&amp;quot;microsoft yahei&amp;quot;;font-size:16px;font-style:normal;background-color:#FFFFFF;&quot;&gt;\n	&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601150937_29220.jpg&quot; /&gt;\n&lt;/p&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 23:09:41', null, '0');
INSERT INTO `wst_goods` VALUES ('254', '23523', '可口 /KOKA 新加坡进口方便面 多口味12袋装', 'Upload/goods/2015-06/556c75d780e62.jpg', 'Upload/goods/2015-06/556c75d780e62.jpg', '0', '31', '45.0', '41.9', '5523423', '0', '0', '0', '0', '包', '12袋装', '1', '1', '1', '1', '1', '0', '0', null, '52', '191', '211', '179', '182', '&lt;table class=&quot;wst-form&quot;&gt;\n	&lt;tbody&gt;\n		&lt;tr&gt;\n			&lt;td&gt;\n				&lt;p&gt;\n					测试商品，请勿下单\n				&lt;/p&gt;\n				&lt;p&gt;\n					&amp;nbsp;\n				&lt;/p&gt;\n				&lt;p&gt;\n					&lt;img alt=&quot;&quot; src=&quot;/product/wstmall/Upload/image/20150601/20150601151136_36320.jpg&quot; /&gt;\n				&lt;/p&gt;\n			&lt;/td&gt;\n		&lt;/tr&gt;\n		&lt;tr&gt;\n			&lt;th width=&quot;120&quot;&gt;\n				&lt;span&gt;&lt;/span&gt;\n			&lt;/th&gt;\n			&lt;td&gt;\n				&lt;p&gt;\n					&amp;nbsp;\n				&lt;/p&gt;\n				&lt;p&gt;\n					&amp;nbsp;\n				&lt;/p&gt;\n				&lt;p&gt;\n					&amp;nbsp;\n				&lt;/p&gt;\n			&lt;/td&gt;\n		&lt;/tr&gt;\n	&lt;/tbody&gt;\n&lt;/table&gt;', '0', '0', '0', '0', '1', null, '1', '2015-06-01 23:11:40', null, '0');

-- ----------------------------
-- Table structure for `wst_friendlinks`
-- ----------------------------
DROP TABLE IF EXISTS `wst_friendlinks`;
CREATE TABLE `wst_friendlinks` (
  `friendlinkId` int(11) NOT NULL AUTO_INCREMENT,
  `friendlinkIco` varchar(150) DEFAULT NULL,
  `friendlinkName` varchar(50) DEFAULT NULL,
  `friendlinkUrl` varchar(150) DEFAULT NULL,
  `friendlinkSort` int(11) DEFAULT '0',
  PRIMARY KEY (`friendlinkId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_friendlinks
-- ----------------------------
INSERT INTO `wst_friendlinks` VALUES ('1', 'Apps/Home/View/default/images/logo.png', 'WSTMall', 'http://www.wstmall.com', '0');

-- ----------------------------
-- Table structure for `wst_feedbacks`
-- ----------------------------
DROP TABLE IF EXISTS `wst_feedbacks`;
CREATE TABLE `wst_feedbacks` (
  `feedbackId` int(11) NOT NULL AUTO_INCREMENT,
  `feedbackType` tinyint(4) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `userPhone` varchar(20) DEFAULT NULL,
  `createTime` datetime NOT NULL,
  `adminId` int(11) DEFAULT NULL,
  `adminReply` text,
  `replyTime` datetime DEFAULT NULL,
  PRIMARY KEY (`feedbackId`),
  KEY `feedbackType` (`feedbackType`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_feedbacks
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_communitys`
-- ----------------------------
DROP TABLE IF EXISTS `wst_communitys`;
CREATE TABLE `wst_communitys` (
  `communityId` int(11) NOT NULL AUTO_INCREMENT,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `areaId3` int(11) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `isService` tinyint(4) NOT NULL DEFAULT '0',
  `communityName` varchar(80) NOT NULL,
  `communitySort` int(11) NOT NULL DEFAULT '0',
  `communityKey` char(255) NOT NULL,
  `communityFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`communityId`),
  KEY `isShow` (`isShow`,`communityFlag`),
  KEY `areaId1` (`areaId1`) USING BTREE,
  KEY `areaId2` (`areaId2`),
  KEY `areaId3` (`areaId3`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_communitys
-- ----------------------------
INSERT INTO `wst_communitys` VALUES ('15', '440000', '440100', '440106', '1', '1', '五山岑村社区', '1', '', '1');
INSERT INTO `wst_communitys` VALUES ('16', '440000', '440100', '440106', '1', '1', '华南农业大学社区', '2', '', '1');
INSERT INTO `wst_communitys` VALUES ('17', '440000', '440100', '440106', '1', '1', '华南理工大学社区', '3', '', '1');
INSERT INTO `wst_communitys` VALUES ('18', '440000', '440100', '440106', '1', '1', '暨南大学社区', '4', '', '1');
INSERT INTO `wst_communitys` VALUES ('19', '440000', '440100', '440106', '1', '1', '华南师范大学社区', '5', '', '1');
INSERT INTO `wst_communitys` VALUES ('20', '440000', '440100', '440106', '1', '1', '石牌桥社区', '8', '', '1');
INSERT INTO `wst_communitys` VALUES ('21', '440000', '440100', '440106', '1', '1', '岗顶社区', '6', '', '1');
INSERT INTO `wst_communitys` VALUES ('22', '440000', '440100', '440106', '1', '1', '五羊新村', '6', '', '1');
INSERT INTO `wst_communitys` VALUES ('23', '440000', '440100', '440106', '1', '1', '天河体育中心', '7', '', '1');

-- ----------------------------
-- Table structure for `wst_brands`
-- ----------------------------
DROP TABLE IF EXISTS `wst_brands`;
CREATE TABLE `wst_brands` (
  `brandId` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) NOT NULL,
  `brandIco` varchar(150) NOT NULL,
  `brandDesc` text,
  `createTime` datetime NOT NULL,
  `brandFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`brandId`),
  KEY `brandFlag` (`brandFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_brands
-- ----------------------------
INSERT INTO `wst_brands` VALUES ('7', '大大', 'Upload/brands/2015-05/554c248588e1a_thumb.gif', '大大', '2015-05-08 10:50:51', '1');
INSERT INTO `wst_brands` VALUES ('8', '德芙', 'Upload/brands/2015-05/554c24a0efdb9_thumb.jpg', '德芙', '2015-05-08 10:51:18', '1');
INSERT INTO `wst_brands` VALUES ('9', '金帝', 'Upload/brands/2015-05/554c24beef656_thumb.jpg', '金帝', '2015-05-08 10:51:47', '1');
INSERT INTO `wst_brands` VALUES ('10', '乐天', 'Upload/brands/2015-05/554c24cfc96fa_thumb.gif', '乐天', '2015-05-08 10:52:07', '1');
INSERT INTO `wst_brands` VALUES ('11', '好丽友', 'Upload/brands/2015-05/554c24e361a8e_thumb.gif', '好丽友', '2015-05-08 10:52:27', '1');
INSERT INTO `wst_brands` VALUES ('12', '金莎', 'Upload/brands/2015-05/554c24fc5e3f8_thumb.jpg', '金莎', '2015-05-08 10:52:48', '1');
INSERT INTO `wst_brands` VALUES ('13', '苏果', 'Upload/brands/2015-05/554c25d2b3b6b_thumb.jpg', '苏果', '2015-05-08 10:56:21', '1');
INSERT INTO `wst_brands` VALUES ('14', '城市果篮', 'Upload/brands/2015-05/554c25eb1c3ac_thumb.jpg', '城市果篮', '2015-05-08 10:56:45', '1');
INSERT INTO `wst_brands` VALUES ('15', '花果子', 'Upload/brands/2015-05/554c25ff28841_thumb.jpg', '&lt;b&gt;花果子&lt;/b&gt;', '2015-05-08 10:57:09', '1');
INSERT INTO `wst_brands` VALUES ('16', '福果园', 'Upload/brands/2015-05/554c261f575b7_thumb.jpg', '福果园', '2015-05-08 10:57:46', '1');
INSERT INTO `wst_brands` VALUES ('17', '香芒山', 'Upload/brands/2015-05/554c266dcce62_thumb.jpg', '香芒山', '2015-05-08 10:58:56', '1');
INSERT INTO `wst_brands` VALUES ('18', 'berry', 'Upload/brands/2015-05/554c267f44c8a_thumb.jpg', 'berry', '2015-05-08 10:59:18', '1');
INSERT INTO `wst_brands` VALUES ('19', '吉农沃尔特', 'Upload/brands/2015-05/556ad93feae62_thumb.png', '&lt;span style=&quot;color:#637160;font-family:宋体;font-size:16px;line-height:22px;background-color:#E53333;&quot;&gt;田间超市不错，很吸引人的眼球。&lt;/span&gt;', '2015-05-31 17:51:28', '1');
INSERT INTO `wst_brands` VALUES ('20', '鑫明有机', 'Upload/brands/2015-05/556adab7189d1_thumb.png', '鑫明有机食物', '2015-05-31 17:56:24', '1');
INSERT INTO `wst_brands` VALUES ('21', '一号农场', 'Upload/brands/2015-05/556adcacbfb6b_thumb.png', '一号农场一号农场一号农场', '2015-05-31 18:04:32', '1');
INSERT INTO `wst_brands` VALUES ('22', '万家鲜', 'Upload/brands/2015-05/556adf780f49d_thumb.png', '万家鲜万家鲜万家鲜', '2015-05-31 18:16:28', '1');
INSERT INTO `wst_brands` VALUES ('23', '新雅食品', 'Upload/brands/2015-05/556b08187ff38_thumb.png', '新雅食品新雅食品新雅食品新雅食品', '2015-05-31 21:09:46', '1');
INSERT INTO `wst_brands` VALUES ('24', '乐多菜园', 'Upload/brands/2015-05/556b099de97fe_thumb.png', '乐多菜园乐多乐多菜园', '2015-05-31 21:16:18', '1');
INSERT INTO `wst_brands` VALUES ('25', '乐宜美', 'Upload/brands/2015-06/556bb2e72aae5_thumb.png', '乐宜美乐宜美乐宜美', '2015-06-01 09:18:35', '1');
INSERT INTO `wst_brands` VALUES ('26', '好雅', 'Upload/brands/2015-06/556bb59a21690_thumb.png', '&lt;h1 style=&quot;font-size:16px;font-family:\'microsoft yahei\';background-color:#FFFFFF;&quot;&gt;\n	好雅 专做真空收纳袋压缩袋整理密封袋\n&lt;/h1&gt;', '2015-06-01 09:30:04', '1');
INSERT INTO `wst_brands` VALUES ('27', '厨之选', 'Upload/brands/2015-06/556bcffbb51c6_thumb.png', '厨之选厨之选厨之选厨之选', '2015-06-01 11:22:40', '1');
INSERT INTO `wst_brands` VALUES ('28', '新天力', 'Upload/brands/2015-06/556bd070c5596_thumb.png', '新天力厨房品牌', '2015-06-01 11:24:41', '1');
INSERT INTO `wst_brands` VALUES ('29', '雀巢咖啡', 'Upload/brands/2015-06/556be76dc0ded_thumb.jpg', '雀巢咖啡雀巢咖啡雀巢咖啡', '2015-06-01 13:02:46', '1');
INSERT INTO `wst_brands` VALUES ('30', '伊利奶粉', 'Upload/brands/2015-06/556c13f105821_thumb.jpg', '&lt;p&gt;\n	伊利奶粉。。。\n&lt;/p&gt;', '2015-06-01 16:12:42', '1');
INSERT INTO `wst_brands` VALUES ('31', '红牛', 'Upload/brands/2015-06/556c16e6cb44a_thumb.jpg', '红牛功能饮料', '2015-06-01 16:25:16', '1');
INSERT INTO `wst_brands` VALUES ('32', '佳得乐', 'Upload/brands/2015-06/556c176b0e6b7_thumb.jpg', '佳得乐饮料品牌', '2015-06-01 16:27:30', '1');
INSERT INTO `wst_brands` VALUES ('33', '美年达', 'Upload/brands/2015-06/556c1839c8fd5_thumb.jpg', '美年达碳酸饮料', '2015-06-01 16:30:59', '1');
INSERT INTO `wst_brands` VALUES ('34', '芬达', 'Upload/brands/2015-06/556c18a77133d_thumb.jpg', '芬达碳酸饮料', '2015-06-01 16:32:49', '1');
INSERT INTO `wst_brands` VALUES ('35', '康师傅', 'Upload/brands/2015-06/556c19392c43e_thumb.jpg', '康师傅康师傅康师傅康师傅', '2015-06-01 16:35:09', '1');
INSERT INTO `wst_brands` VALUES ('36', '美汁源', 'Upload/brands/2015-06/556c1aa14e0a8_thumb.jpg', '&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;美汁源&lt;span style=&quot;color:#333333;line-height:28px;font-family:Tahoma, &amp;quot;microsoft yahei&amp;quot;;font-size:20px;font-style:normal;background-color:#FFFFFF;&quot;&gt;美汁源&lt;span style=&quot;color:#333333;line-height:28px;font-family:Tahoma, &amp;quot;microsoft yahei&amp;quot;;font-size:20px;font-style:normal;background-color:#FFFFFF;&quot;&gt;美汁源&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;美汁源&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;', '2015-06-01 16:41:09', '1');
INSERT INTO `wst_brands` VALUES ('37', '太古方糖', 'Upload/brands/2015-06/556c1cfe9f650_thumb.jpg', '&lt;p&gt;\n	太古方糖。。。\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;', '2015-06-01 16:51:19', '1');
INSERT INTO `wst_brands` VALUES ('38', '麦斯威尔咖啡', 'Upload/brands/2015-06/556c1ded1236d_thumb.jpg', '&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;麦斯威尔咖啡品牌&lt;/span&gt;', '2015-06-01 16:55:15', '1');
INSERT INTO `wst_brands` VALUES ('39', '可比可拿铁咖啡', 'Upload/brands/2015-06/556c1e8a688dd_thumb.jpg', '&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;可比可拿铁咖啡&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;可比可拿铁咖啡&lt;/span&gt;&lt;/span&gt;', '2015-06-01 16:57:51', '1');
INSERT INTO `wst_brands` VALUES ('40', '摩卡咖啡', 'Upload/brands/2015-06/556c2089222b5_thumb.jpg', '摩卡咖啡摩卡咖啡', '2015-06-01 17:06:19', '1');
INSERT INTO `wst_brands` VALUES ('41', '福临门', 'Upload/brands/2015-06/556c261fe8586_thumb.jpg', '福临门', '2015-06-01 17:30:10', '1');
INSERT INTO `wst_brands` VALUES ('42', '鲁花花生油', 'Upload/brands/2015-06/556c278226813_thumb.jpg', '鲁花花生油鲁花花生油鲁花花生油鲁花花生油', '2015-06-01 17:36:03', '1');
INSERT INTO `wst_brands` VALUES ('43', '多力5珍宝', 'Upload/brands/2015-06/556c281dc1f4f_thumb.jpg', '&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	多力5珍宝多力5珍宝\n&lt;/p&gt;', '2015-06-01 17:38:44', '1');
INSERT INTO `wst_brands` VALUES ('44', '金龙鱼', 'Upload/brands/2015-06/556c29f537cab_thumb.jpg', '金龙鱼金龙鱼金龙鱼', '2015-06-01 17:46:31', '1');
INSERT INTO `wst_brands` VALUES ('45', '真真老老粽子', 'Upload/brands/2015-06/556c2ce99cb6d_thumb.jpg', '真真老老粽子真真老老粽子真真老老粽子', '2015-06-01 17:59:12', '1');
INSERT INTO `wst_brands` VALUES ('46', '五芳斋', 'Upload/brands/2015-06/556c2d94bb27c_thumb.jpg', '五芳斋 粽子', '2015-06-01 18:02:04', '1');
INSERT INTO `wst_brands` VALUES ('47', '银鹭', 'Upload/brands/2015-06/556c2e693b534_thumb.png', '&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;银鹭 椰果 八宝粥 &lt;/span&gt;', '2015-06-01 18:05:36', '1');
INSERT INTO `wst_brands` VALUES ('48', 'Walch/威露士', 'Upload/brands/2015-06/556c51eb10b5f_thumb.png', 'Walch/威露士Walch/威露士Walch/威露士', '2015-06-01 20:37:02', '1');
INSERT INTO `wst_brands` VALUES ('49', '妍妍', 'Upload/brands/2015-06/556c52f9d84f3_thumb.png', '妍妍女性用品', '2015-06-01 20:41:31', '1');
INSERT INTO `wst_brands` VALUES ('50', '巴黎小站', 'Upload/brands/2015-06/556c541eca2cb_thumb.png', '&lt;p&gt;\n	巴黎小站\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;', '2015-06-01 20:46:51', '1');
INSERT INTO `wst_brands` VALUES ('51', '施巴', 'Upload/brands/2015-06/556c5611a70a8_thumb.png', '施巴施巴', '2015-06-01 20:54:46', '1');
INSERT INTO `wst_brands` VALUES ('52', 'Free', 'Upload/brands/2015-06/556c56c98fe30_thumb.png', '&amp;nbsp;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Free&amp;nbsp;\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Free\n&lt;/h1&gt;', '2015-06-01 20:57:53', '1');
INSERT INTO `wst_brands` VALUES ('53', '西尼', 'Upload/brands/2015-06/556c586531e87_thumb.png', '西尼西尼', '2015-06-01 21:04:50', '1');
INSERT INTO `wst_brands` VALUES ('54', 'beely', 'Upload/brands/2015-06/556c5ce375bad_thumb.png', 'beely&amp;nbsp; beely', '2015-06-01 21:23:53', '1');
INSERT INTO `wst_brands` VALUES ('55', 'Veet/薇婷', 'Upload/brands/2015-06/556c5d7ac1a74_thumb.png', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Veet/薇婷\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Veet/薇婷\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Veet/薇婷\n&lt;/h1&gt;', '2015-06-01 21:26:24', '1');
INSERT INTO `wst_brands` VALUES ('56', '番茄派', 'Upload/brands/2015-06/556c5f1996e13_thumb.png', '&lt;p&gt;\n	番茄派\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	番茄派\n&lt;/h1&gt;', '2015-06-01 21:33:22', '1');
INSERT INTO `wst_brands` VALUES ('57', '欧丽丝', 'Upload/brands/2015-06/556c5fdce2461_thumb.png', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	欧丽丝\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	欧丽丝\n&lt;/h1&gt;', '2015-06-01 21:36:30', '1');
INSERT INTO `wst_brands` VALUES ('58', 'STENDERS施丹兰', 'Upload/brands/2015-06/556c6040c9bd0_thumb.png', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	STENDERS施丹兰\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	STENDERS施丹兰\n&lt;/h1&gt;', '2015-06-01 21:38:12', '1');
INSERT INTO `wst_brands` VALUES ('59', 'Rewiwax蕾沃斯', 'Upload/brands/2015-06/556c60d90746b_thumb.png', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Rewiwax蕾沃斯\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Rewiwax蕾沃斯\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Rewiwax蕾沃斯\n&lt;/h1&gt;', '2015-06-01 21:40:44', '1');

-- ----------------------------
-- Table structure for `wst_banks`
-- ----------------------------
DROP TABLE IF EXISTS `wst_banks`;
CREATE TABLE `wst_banks` (
  `bankId` int(11) NOT NULL AUTO_INCREMENT,
  `bankName` varchar(50) DEFAULT NULL,
  `bankFlag` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`bankId`),
  KEY `bankFlag` (`bankFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_banks
-- ----------------------------
INSERT INTO `wst_banks` VALUES ('17', '中国工商银行', '1');
INSERT INTO `wst_banks` VALUES ('18', '中国农业银行', '1');
INSERT INTO `wst_banks` VALUES ('19', '中国人民银行', '1');
INSERT INTO `wst_banks` VALUES ('20', '招商银行', '1');
INSERT INTO `wst_banks` VALUES ('21', '中兴银行', '1');
INSERT INTO `wst_banks` VALUES ('22', '交通银行', '1');
INSERT INTO `wst_banks` VALUES ('23', '深圳发展银行', '1');
INSERT INTO `wst_banks` VALUES ('24', '中国光大银行', '1');

-- ----------------------------
-- Table structure for `wst_attributes`
-- ----------------------------
DROP TABLE IF EXISTS `wst_attributes`;
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

-- ----------------------------
-- Records of wst_attributes
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_attribute_cats`
-- ----------------------------
DROP TABLE IF EXISTS `wst_attribute_cats`;
CREATE TABLE `wst_attribute_cats` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL,
  `catFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`catId`),
  KEY `shopId` (`shopId`,`catFlag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_attribute_cats
-- ----------------------------

-- ----------------------------
-- Table structure for `wst_articles`
-- ----------------------------
DROP TABLE IF EXISTS `wst_articles`;
CREATE TABLE `wst_articles` (
  `articleId` int(11) NOT NULL AUTO_INCREMENT,
  `catId` int(11) NOT NULL,
  `articleTitle` varchar(200) NOT NULL,
  `articleImg` varchar(150) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `articleContent` text NOT NULL,
  `articleKey` varchar(255) DEFAULT NULL,
  `staffId` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`articleId`),
  KEY `catId` (`catId`,`isShow`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_articles
-- ----------------------------
INSERT INTO `wst_articles` VALUES ('1', '1', 'wstmall正式上线', '', '1', '热烈庆祝wstmall正式上线 &amp;nbsp;帐户自助服务', 'wstmall', '1', '2015-03-14 16:48:58');
INSERT INTO `wst_articles` VALUES ('2', '2', '帐户自助服务', '', '1', '&amp;nbsp;帐户自助服务&amp;nbsp;帐户自助服务', '帐户自助服务', '1', '2015-04-09 21:37:30');
INSERT INTO `wst_articles` VALUES ('3', '3', '支付方式', '', '1', '支付方式&amp;nbsp;支付方式&amp;nbsp;支付方式&lt;br /&gt;', '支付方式', '1', '2015-04-09 21:37:56');
INSERT INTO `wst_articles` VALUES ('4', '4', '运费说明', '', '1', '运费说明 这里是运费说明', '运费说明', '1', '2015-04-09 21:38:12');
INSERT INTO `wst_articles` VALUES ('5', '5', '退换货原则和流程', '', '1', '&lt;p&gt;\n	&amp;nbsp; &amp;nbsp; &amp;nbsp; 退换货原则和流程 &amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;退换货原则和流程\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp; &amp;nbsp; &amp;nbsp; 退换货原则和流程\n&lt;/p&gt;', '退换货原则和流程', '1', '2015-04-09 21:38:45');
INSERT INTO `wst_articles` VALUES ('6', '6', '帐号&amp;密码问题', '', '1', '&lt;u&gt;111111111111111&amp;nbsp;&lt;/u&gt;', '帐号&amp;密码问题', '1', '2015-04-09 21:39:06');

-- ----------------------------
-- Table structure for `wst_article_cats`
-- ----------------------------
DROP TABLE IF EXISTS `wst_article_cats`;
CREATE TABLE `wst_article_cats` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) NOT NULL,
  `catType` tinyint(4) NOT NULL DEFAULT '0',
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `catName` varchar(20) NOT NULL,
  `catSort` int(11) NOT NULL DEFAULT '0',
  `catFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catId`),
  KEY `isShow` (`catType`,`catFlag`,`isShow`) USING BTREE,
  KEY `parentId` (`catFlag`,`parentId`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_article_cats
-- ----------------------------
INSERT INTO `wst_article_cats` VALUES ('1', '0', '0', '0', '商城快讯', '0', '1');
INSERT INTO `wst_article_cats` VALUES ('2', '0', '1', '1', '新手上路', '0', '1');
INSERT INTO `wst_article_cats` VALUES ('3', '0', '1', '1', '如何付款', '0', '1');
INSERT INTO `wst_article_cats` VALUES ('4', '0', '1', '1', '配送说明', '0', '1');
INSERT INTO `wst_article_cats` VALUES ('5', '0', '1', '1', '售后服务', '0', '1');
INSERT INTO `wst_article_cats` VALUES ('6', '0', '1', '1', '常见问题', '0', '1');

-- ----------------------------
-- Table structure for `wst_areas`
-- ----------------------------
DROP TABLE IF EXISTS `wst_areas`;
CREATE TABLE `wst_areas` (
  `areaId` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) NOT NULL,
  `areaName` varchar(20) DEFAULT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `areaSort` int(11) NOT NULL DEFAULT '0',
  `areaKey` char(255) NOT NULL,
  `areaType` tinyint(4) NOT NULL DEFAULT '1',
  `areaFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`areaId`),
  KEY `isShow` (`isShow`,`areaFlag`),
  KEY `areaType` (`areaType`),
  KEY `parentId` (`parentId`)
) ENGINE=MyISAM AUTO_INCREMENT=820302 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_areas
-- ----------------------------
INSERT INTO `wst_areas` VALUES ('110000', '0', '北京市', '1', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('110100', '110000', '北京市', '1', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('110101', '110100', '东城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110102', '110100', '西城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110105', '110100', '朝阳区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110106', '110100', '丰台区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110107', '110100', '石景山区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110108', '110100', '海淀区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110109', '110100', '门头沟区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110111', '110100', '房山区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110112', '110100', '通州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110113', '110100', '顺义区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110114', '110100', '昌平区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110115', '110100', '大兴区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110116', '110100', '怀柔区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110117', '110100', '平谷区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('110228', '110200', '密云县', '1', '0', '', '2', '-1');
INSERT INTO `wst_areas` VALUES ('110229', '110200', '延庆县', '1', '0', '', '2', '-1');
INSERT INTO `wst_areas` VALUES ('120000', '0', '天津市', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('120101', '120100', '和平区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120102', '120100', '河东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120103', '120100', '河西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120104', '120100', '南开区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120105', '120100', '河北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120106', '120100', '红桥区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120110', '120100', '东丽区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120111', '120100', '西青区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120112', '120100', '津南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120113', '120100', '北辰区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120114', '120100', '武清区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120115', '120100', '宝坻区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120116', '120100', '滨海新区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120221', '120200', '宁河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120223', '120200', '静海县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('120225', '120200', '蓟县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130000', '0', '河北省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('130100', '130000', '石家庄市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('130102', '130100', '长安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130104', '130100', '桥西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130105', '130100', '新华区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130107', '130100', '井陉矿区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130108', '130100', '裕华区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130109', '130100', '藁城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130110', '130100', '鹿泉区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130111', '130100', '栾城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130121', '130100', '井陉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130123', '130100', '正定县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130125', '130100', '行唐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130126', '130100', '灵寿县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130127', '130100', '高邑县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130128', '130100', '深泽县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130129', '130100', '赞皇县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130130', '130100', '无极县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130131', '130100', '平山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130132', '130100', '元氏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130133', '130100', '赵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130181', '130100', '辛集市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130183', '130100', '晋州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130184', '130100', '新乐市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130200', '130000', '唐山市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('130202', '130200', '路南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130203', '130200', '路北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130204', '130200', '古冶区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130205', '130200', '开平区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130207', '130200', '丰南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130208', '130200', '丰润区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130209', '130200', '曹妃甸区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130223', '130200', '滦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130224', '130200', '滦南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130225', '130200', '乐亭县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130227', '130200', '迁西县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130229', '130200', '玉田县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130281', '130200', '遵化市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130283', '130200', '迁安市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130300', '130000', '秦皇岛市', '0', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('130302', '130300', '海港区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130303', '130300', '山海关区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130304', '130300', '北戴河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130321', '130300', '青龙满族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130322', '130300', '昌黎县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130323', '130300', '抚宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130324', '130300', '卢龙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130400', '130000', '邯郸市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('130402', '130400', '邯山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130403', '130400', '丛台区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130404', '130400', '复兴区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130406', '130400', '峰峰矿区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130421', '130400', '邯郸县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130423', '130400', '临漳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130424', '130400', '成安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130425', '130400', '大名县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130426', '130400', '涉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130427', '130400', '磁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130428', '130400', '肥乡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130429', '130400', '永年县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130430', '130400', '邱县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130431', '130400', '鸡泽县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130432', '130400', '广平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130433', '130400', '馆陶县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130434', '130400', '魏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130435', '130400', '曲周县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130481', '130400', '武安市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130500', '130000', '邢台市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('130502', '130500', '桥东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130503', '130500', '桥西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130521', '130500', '邢台县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130522', '130500', '临城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130523', '130500', '内丘县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130524', '130500', '柏乡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130525', '130500', '隆尧县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130526', '130500', '任县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130527', '130500', '南和县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130528', '130500', '宁晋县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130529', '130500', '巨鹿县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130530', '130500', '新河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130531', '130500', '广宗县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130532', '130500', '平乡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130533', '130500', '威县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130534', '130500', '清河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130535', '130500', '临西县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130581', '130500', '南宫市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130582', '130500', '沙河市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130600', '130000', '保定市', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('130602', '130600', '新市区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130603', '130600', '北市区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130604', '130600', '南市区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130621', '130600', '满城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130622', '130600', '清苑县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130623', '130600', '涞水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130624', '130600', '阜平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130625', '130600', '徐水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130626', '130600', '定兴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130627', '130600', '唐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130628', '130600', '高阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130629', '130600', '容城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130630', '130600', '涞源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130631', '130600', '望都县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130632', '130600', '安新县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130633', '130600', '易县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130634', '130600', '曲阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130635', '130600', '蠡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130636', '130600', '顺平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130637', '130600', '博野县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130638', '130600', '雄县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130681', '130600', '涿州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130682', '130600', '定州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130683', '130600', '安国市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130684', '130600', '高碑店市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130700', '130000', '张家口市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('130702', '130700', '桥东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130703', '130700', '桥西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130705', '130700', '宣化区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130706', '130700', '下花园区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130721', '130700', '宣化县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130722', '130700', '张北县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130723', '130700', '康保县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130724', '130700', '沽源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130725', '130700', '尚义县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130726', '130700', '蔚县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130727', '130700', '阳原县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130728', '130700', '怀安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130729', '130700', '万全县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130730', '130700', '怀来县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130731', '130700', '涿鹿县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130732', '130700', '赤城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130733', '130700', '崇礼县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130800', '130000', '承德市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('130802', '130800', '双桥区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130803', '130800', '双滦区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130804', '130800', '鹰手营子矿区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130821', '130800', '承德县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130822', '130800', '兴隆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130823', '130800', '平泉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130824', '130800', '滦平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130825', '130800', '隆化县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130826', '130800', '丰宁满族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130827', '130800', '宽城满族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130828', '130800', '围场满族蒙古族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130900', '130000', '沧州市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('130902', '130900', '新华区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130903', '130900', '运河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130921', '130900', '沧县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130922', '130900', '青县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130923', '130900', '东光县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130924', '130900', '海兴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130925', '130900', '盐山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130926', '130900', '肃宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130927', '130900', '南皮县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130928', '130900', '吴桥县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130929', '130900', '献县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130930', '130900', '孟村回族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130981', '130900', '泊头市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130982', '130900', '任丘市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130983', '130900', '黄骅市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('130984', '130900', '河间市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131000', '130000', '廊坊市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('131002', '131000', '安次区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131003', '131000', '广阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131022', '131000', '固安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131023', '131000', '永清县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131024', '131000', '香河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131025', '131000', '大城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131026', '131000', '文安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131028', '131000', '大厂回族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131081', '131000', '霸州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131082', '131000', '三河市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131100', '130000', '衡水市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('131102', '131100', '桃城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131121', '131100', '枣强县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131122', '131100', '武邑县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131123', '131100', '武强县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131124', '131100', '饶阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131125', '131100', '安平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131126', '131100', '故城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131127', '131100', '景县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131128', '131100', '阜城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131181', '131100', '冀州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('131182', '131100', '深州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140000', '0', '山西省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('140100', '140000', '太原市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('140105', '140100', '小店区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140106', '140100', '迎泽区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140107', '140100', '杏花岭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140108', '140100', '尖草坪区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140109', '140100', '万柏林区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140110', '140100', '晋源区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140121', '140100', '清徐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140122', '140100', '阳曲县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140123', '140100', '娄烦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140181', '140100', '古交市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140200', '140000', '大同市', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('140202', '140200', '城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140203', '140200', '矿区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140211', '140200', '南郊区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140212', '140200', '新荣区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140221', '140200', '阳高县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140222', '140200', '天镇县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140223', '140200', '广灵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140224', '140200', '灵丘县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140225', '140200', '浑源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140226', '140200', '左云县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140227', '140200', '大同县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140300', '140000', '阳泉市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('140302', '140300', '城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140303', '140300', '矿区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140311', '140300', '郊区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140321', '140300', '平定县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140322', '140300', '盂县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140400', '140000', '长治市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('140402', '140400', '城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140411', '140400', '郊区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140421', '140400', '长治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140423', '140400', '襄垣县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140424', '140400', '屯留县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140425', '140400', '平顺县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140426', '140400', '黎城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140427', '140400', '壶关县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140428', '140400', '长子县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140429', '140400', '武乡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140430', '140400', '沁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140431', '140400', '沁源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140481', '140400', '潞城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140500', '140000', '晋城市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('140502', '140500', '城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140521', '140500', '沁水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140522', '140500', '阳城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140524', '140500', '陵川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140525', '140500', '泽州县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140581', '140500', '高平市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140600', '140000', '朔州市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('140602', '140600', '朔城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140603', '140600', '平鲁区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140621', '140600', '山阴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140622', '140600', '应县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140623', '140600', '右玉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140624', '140600', '怀仁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140700', '140000', '晋中市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('140702', '140700', '榆次区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140721', '140700', '榆社县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140722', '140700', '左权县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140723', '140700', '和顺县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140724', '140700', '昔阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140725', '140700', '寿阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140726', '140700', '太谷县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140727', '140700', '祁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140728', '140700', '平遥县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140729', '140700', '灵石县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140781', '140700', '介休市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140800', '140000', '运城市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('140802', '140800', '盐湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140821', '140800', '临猗县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140822', '140800', '万荣县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140823', '140800', '闻喜县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140824', '140800', '稷山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140825', '140800', '新绛县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140826', '140800', '绛县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140827', '140800', '垣曲县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140828', '140800', '夏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140829', '140800', '平陆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140830', '140800', '芮城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140881', '140800', '永济市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140882', '140800', '河津市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140900', '140000', '忻州市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('140902', '140900', '忻府区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140921', '140900', '定襄县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140922', '140900', '五台县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140923', '140900', '代县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140924', '140900', '繁峙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140925', '140900', '宁武县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140926', '140900', '静乐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140927', '140900', '神池县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140928', '140900', '五寨县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140929', '140900', '岢岚县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140930', '140900', '河曲县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140931', '140900', '保德县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140932', '140900', '偏关县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('140981', '140900', '原平市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141000', '140000', '临汾市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('141002', '141000', '尧都区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141021', '141000', '曲沃县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141022', '141000', '翼城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141023', '141000', '襄汾县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141024', '141000', '洪洞县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141025', '141000', '古县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141026', '141000', '安泽县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141027', '141000', '浮山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141028', '141000', '吉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141029', '141000', '乡宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141030', '141000', '大宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141031', '141000', '隰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141032', '141000', '永和县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141033', '141000', '蒲县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141034', '141000', '汾西县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141081', '141000', '侯马市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141082', '141000', '霍州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141100', '140000', '吕梁市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('141102', '141100', '离石区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141121', '141100', '文水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141122', '141100', '交城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141123', '141100', '兴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141124', '141100', '临县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141125', '141100', '柳林县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141126', '141100', '石楼县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141127', '141100', '岚县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141128', '141100', '方山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141129', '141100', '中阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141130', '141100', '交口县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141181', '141100', '孝义市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('141182', '141100', '汾阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150000', '0', '内蒙古自治区', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('150100', '150000', '呼和浩特市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('150102', '150100', '新城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150103', '150100', '回民区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150104', '150100', '玉泉区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150105', '150100', '赛罕区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150121', '150100', '土默特左旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150122', '150100', '托克托县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150123', '150100', '和林格尔县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150124', '150100', '清水河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150125', '150100', '武川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150200', '150000', '包头市', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('150202', '150200', '东河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150203', '150200', '昆都仑区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150204', '150200', '青山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150205', '150200', '石拐区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150206', '150200', '白云鄂博矿区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150207', '150200', '九原区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150221', '150200', '土默特右旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150222', '150200', '固阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150223', '150200', '达尔罕茂明安联合旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150300', '150000', '乌海市', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('150302', '150300', '海勃湾区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150303', '150300', '海南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150304', '150300', '乌达区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150400', '150000', '赤峰市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('150402', '150400', '红山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150403', '150400', '元宝山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150404', '150400', '松山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150421', '150400', '阿鲁科尔沁旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150422', '150400', '巴林左旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150423', '150400', '巴林右旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150424', '150400', '林西县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150425', '150400', '克什克腾旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150426', '150400', '翁牛特旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150428', '150400', '喀喇沁旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150429', '150400', '宁城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150430', '150400', '敖汉旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150500', '150000', '通辽市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('150502', '150500', '科尔沁区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150521', '150500', '科尔沁左翼中旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150522', '150500', '科尔沁左翼后旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150523', '150500', '开鲁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150524', '150500', '库伦旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150525', '150500', '奈曼旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150526', '150500', '扎鲁特旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150581', '150500', '霍林郭勒市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150600', '150000', '鄂尔多斯市', '0', '0', 'E', '1', '1');
INSERT INTO `wst_areas` VALUES ('150602', '150600', '东胜区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150621', '150600', '达拉特旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150622', '150600', '准格尔旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150623', '150600', '鄂托克前旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150624', '150600', '鄂托克旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150625', '150600', '杭锦旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150626', '150600', '乌审旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150627', '150600', '伊金霍洛旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150700', '150000', '呼伦贝尔市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('150702', '150700', '海拉尔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150703', '150700', '扎赉诺尔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150721', '150700', '阿荣旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150722', '150700', '莫力达瓦达斡尔族自治旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150723', '150700', '鄂伦春自治旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150724', '150700', '鄂温克族自治旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150725', '150700', '陈巴尔虎旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150726', '150700', '新巴尔虎左旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150727', '150700', '新巴尔虎右旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150781', '150700', '满洲里市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150782', '150700', '牙克石市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150783', '150700', '扎兰屯市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150784', '150700', '额尔古纳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150785', '150700', '根河市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150800', '150000', '巴彦淖尔市', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('150802', '150800', '临河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150821', '150800', '五原县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150822', '150800', '磴口县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150823', '150800', '乌拉特前旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150824', '150800', '乌拉特中旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150825', '150800', '乌拉特后旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150826', '150800', '杭锦后旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150900', '150000', '乌兰察布市', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('150902', '150900', '集宁区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150921', '150900', '卓资县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150922', '150900', '化德县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150923', '150900', '商都县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150924', '150900', '兴和县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150925', '150900', '凉城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150926', '150900', '察哈尔右翼前旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150927', '150900', '察哈尔右翼中旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150928', '150900', '察哈尔右翼后旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150929', '150900', '四子王旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('150981', '150900', '丰镇市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152200', '150000', '兴安盟', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('152201', '152200', '乌兰浩特市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152202', '152200', '阿尔山市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152221', '152200', '科尔沁右翼前旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152222', '152200', '科尔沁右翼中旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152223', '152200', '扎赉特旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152224', '152200', '突泉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152500', '150000', '锡林郭勒盟', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('152501', '152500', '二连浩特市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152502', '152500', '锡林浩特市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152522', '152500', '阿巴嘎旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152523', '152500', '苏尼特左旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152524', '152500', '苏尼特右旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152525', '152500', '东乌珠穆沁旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152526', '152500', '西乌珠穆沁旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152527', '152500', '太仆寺旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152528', '152500', '镶黄旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152529', '152500', '正镶白旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152530', '152500', '正蓝旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152531', '152500', '多伦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152900', '150000', '阿拉善盟', '0', '0', 'A', '1', '1');
INSERT INTO `wst_areas` VALUES ('152921', '152900', '阿拉善左旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152922', '152900', '阿拉善右旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('152923', '152900', '额济纳旗', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210000', '0', '辽宁省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('210100', '210000', '沈阳市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('210102', '210100', '和平区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210103', '210100', '沈河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210104', '210100', '大东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210105', '210100', '皇姑区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210106', '210100', '铁西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210111', '210100', '苏家屯区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210112', '210100', '浑南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210113', '210100', '沈北新区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210114', '210100', '于洪区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210122', '210100', '辽中县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210123', '210100', '康平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210124', '210100', '法库县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210181', '210100', '新民市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210200', '210000', '大连市', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('210202', '210200', '中山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210203', '210200', '西岗区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210204', '210200', '沙河口区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210211', '210200', '甘井子区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210212', '210200', '旅顺口区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210213', '210200', '金州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210224', '210200', '长海县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210281', '210200', '瓦房店市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210282', '210200', '普兰店市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210283', '210200', '庄河市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210300', '210000', '鞍山市', '0', '0', 'A', '1', '1');
INSERT INTO `wst_areas` VALUES ('210302', '210300', '铁东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210303', '210300', '铁西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210304', '210300', '立山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210311', '210300', '千山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210321', '210300', '台安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210323', '210300', '岫岩满族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210381', '210300', '海城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210400', '210000', '抚顺市', '0', '0', 'F', '1', '1');
INSERT INTO `wst_areas` VALUES ('210402', '210400', '新抚区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210403', '210400', '东洲区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210404', '210400', '望花区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210411', '210400', '顺城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210421', '210400', '抚顺县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210422', '210400', '新宾满族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210423', '210400', '清原满族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210500', '210000', '本溪市', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('210502', '210500', '平山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210503', '210500', '溪湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210504', '210500', '明山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210505', '210500', '南芬区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210521', '210500', '本溪满族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210522', '210500', '桓仁满族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210600', '210000', '丹东市', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('210602', '210600', '元宝区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210603', '210600', '振兴区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210604', '210600', '振安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210624', '210600', '宽甸满族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210681', '210600', '东港市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210682', '210600', '凤城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210700', '210000', '锦州市', '0', '0', 'M', '1', '1');
INSERT INTO `wst_areas` VALUES ('210702', '210700', '古塔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210703', '210700', '凌河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210711', '210700', '太和区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210726', '210700', '黑山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210727', '210700', '义县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210781', '210700', '凌海市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210782', '210700', '北镇市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210800', '210000', '营口市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('210802', '210800', '站前区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210803', '210800', '西市区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210804', '210800', '鲅鱼圈区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210811', '210800', '老边区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210881', '210800', '盖州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210882', '210800', '大石桥市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210900', '210000', '阜新市', '0', '0', 'F', '1', '1');
INSERT INTO `wst_areas` VALUES ('210902', '210900', '海州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210903', '210900', '新邱区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210904', '210900', '太平区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210905', '210900', '清河门区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210911', '210900', '细河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210921', '210900', '阜新蒙古族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('210922', '210900', '彰武县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211000', '210000', '辽阳市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('211002', '211000', '白塔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211003', '211000', '文圣区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211004', '211000', '宏伟区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211005', '211000', '弓长岭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211011', '211000', '太子河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211021', '211000', '辽阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211081', '211000', '灯塔市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211100', '210000', '盘锦市', '0', '0', 'P', '1', '1');
INSERT INTO `wst_areas` VALUES ('211102', '211100', '双台子区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211103', '211100', '兴隆台区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211121', '211100', '大洼县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211122', '211100', '盘山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211200', '210000', '铁岭市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('211202', '211200', '银州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211204', '211200', '清河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211221', '211200', '铁岭县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211223', '211200', '西丰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211224', '211200', '昌图县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211281', '211200', '调兵山市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211282', '211200', '开原市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211300', '210000', '朝阳市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('211302', '211300', '双塔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211303', '211300', '龙城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211321', '211300', '朝阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211322', '211300', '建平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211324', '211300', '喀喇沁左翼蒙古族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211381', '211300', '北票市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211382', '211300', '凌源市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211400', '210000', '葫芦岛市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('211402', '211400', '连山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211403', '211400', '龙港区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211404', '211400', '南票区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211421', '211400', '绥中县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211422', '211400', '建昌县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('211481', '211400', '兴城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220000', '0', '吉林省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('220100', '220000', '长春市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('220102', '220100', '南关区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220103', '220100', '宽城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220104', '220100', '朝阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220105', '220100', '二道区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220106', '220100', '绿园区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220112', '220100', '双阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220113', '220100', '九台区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220122', '220100', '农安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220182', '220100', '榆树市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220183', '220100', '德惠市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220200', '220000', '吉林市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('220202', '220200', '昌邑区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220203', '220200', '龙潭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220204', '220200', '船营区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220211', '220200', '丰满区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220221', '220200', '永吉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220281', '220200', '蛟河市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220282', '220200', '桦甸市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220283', '220200', '舒兰市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220284', '220200', '磐石市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220300', '220000', '四平市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('220302', '220300', '铁西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220303', '220300', '铁东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220322', '220300', '梨树县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220323', '220300', '伊通满族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220381', '220300', '公主岭市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220382', '220300', '双辽市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220400', '220000', '辽源市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('220402', '220400', '龙山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220403', '220400', '西安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220421', '220400', '东丰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220422', '220400', '东辽县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220500', '220000', '通化市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('220502', '220500', '东昌区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220503', '220500', '二道江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220521', '220500', '通化县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220523', '220500', '辉南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220524', '220500', '柳河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220581', '220500', '梅河口市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220582', '220500', '集安市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220600', '220000', '白山市', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('220602', '220600', '浑江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220605', '220600', '江源区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220621', '220600', '抚松县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220622', '220600', '靖宇县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220623', '220600', '长白朝鲜族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220681', '220600', '临江市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220700', '220000', '松原市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('220702', '220700', '宁江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220721', '220700', '前郭尔罗斯蒙古族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220722', '220700', '长岭县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220723', '220700', '乾安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220781', '220700', '扶余市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220800', '220000', '白城市', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('220802', '220800', '洮北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220821', '220800', '镇赉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220822', '220800', '通榆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220881', '220800', '洮南市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('220882', '220800', '大安市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('222400', '220000', '延边朝鲜族自治州', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('222401', '222400', '延吉市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('222402', '222400', '图们市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('222403', '222400', '敦化市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('222404', '222400', '珲春市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('222405', '222400', '龙井市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('222406', '222400', '和龙市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('222424', '222400', '汪清县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('222426', '222400', '安图县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230000', '0', '黑龙江省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('230100', '230000', '哈尔滨市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('230102', '230100', '道里区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230103', '230100', '南岗区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230104', '230100', '道外区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230108', '230100', '平房区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230109', '230100', '松北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230110', '230100', '香坊区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230111', '230100', '呼兰区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230112', '230100', '阿城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230113', '230100', '双城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230123', '230100', '依兰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230124', '230100', '方正县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230125', '230100', '宾县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230126', '230100', '巴彦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230127', '230100', '木兰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230128', '230100', '通河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230129', '230100', '延寿县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230183', '230100', '尚志市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230184', '230100', '五常市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230200', '230000', '齐齐哈尔市', '0', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('230202', '230200', '龙沙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230203', '230200', '建华区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230204', '230200', '铁锋区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230205', '230200', '昂昂溪区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230206', '230200', '富拉尔基区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230207', '230200', '碾子山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230208', '230200', '梅里斯达斡尔族区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230221', '230200', '龙江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230223', '230200', '依安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230224', '230200', '泰来县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230225', '230200', '甘南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230227', '230200', '富裕县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230229', '230200', '克山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230230', '230200', '克东县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230231', '230200', '拜泉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230281', '230200', '讷河市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230300', '230000', '鸡西市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('230302', '230300', '鸡冠区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230303', '230300', '恒山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230304', '230300', '滴道区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230305', '230300', '梨树区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230306', '230300', '城子河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230307', '230300', '麻山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230321', '230300', '鸡东县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230381', '230300', '虎林市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230382', '230300', '密山市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230400', '230000', '鹤岗市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('230402', '230400', '向阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230403', '230400', '工农区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230404', '230400', '南山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230405', '230400', '兴安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230406', '230400', '东山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230407', '230400', '兴山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230421', '230400', '萝北县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230422', '230400', '绥滨县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230500', '230000', '双鸭山市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('230502', '230500', '尖山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230503', '230500', '岭东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230505', '230500', '四方台区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230506', '230500', '宝山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230521', '230500', '集贤县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230522', '230500', '友谊县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230523', '230500', '宝清县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230524', '230500', '饶河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230600', '230000', '大庆市', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('230602', '230600', '萨尔图区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230603', '230600', '龙凤区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230604', '230600', '让胡路区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230605', '230600', '红岗区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230606', '230600', '大同区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230621', '230600', '肇州县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230622', '230600', '肇源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230623', '230600', '林甸县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230624', '230600', '杜尔伯特蒙古族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230700', '230000', '伊春市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('230702', '230700', '伊春区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230703', '230700', '南岔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230704', '230700', '友好区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230705', '230700', '西林区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230706', '230700', '翠峦区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230707', '230700', '新青区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230708', '230700', '美溪区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230709', '230700', '金山屯区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230710', '230700', '五营区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230711', '230700', '乌马河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230712', '230700', '汤旺河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230713', '230700', '带岭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230714', '230700', '乌伊岭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230715', '230700', '红星区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230716', '230700', '上甘岭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230722', '230700', '嘉荫县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230781', '230700', '铁力市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230800', '230000', '佳木斯市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('230803', '230800', '向阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230804', '230800', '前进区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230805', '230800', '东风区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230811', '230800', '郊区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230822', '230800', '桦南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230826', '230800', '桦川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230828', '230800', '汤原县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230833', '230800', '抚远县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230881', '230800', '同江市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230882', '230800', '富锦市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230900', '230000', '七台河市', '0', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('230902', '230900', '新兴区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230903', '230900', '桃山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230904', '230900', '茄子河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('230921', '230900', '勃利县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231000', '230000', '牡丹江市', '0', '0', 'M', '1', '1');
INSERT INTO `wst_areas` VALUES ('231002', '231000', '东安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231003', '231000', '阳明区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231004', '231000', '爱民区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231005', '231000', '西安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231024', '231000', '东宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231025', '231000', '林口县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231081', '231000', '绥芬河市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231083', '231000', '海林市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231084', '231000', '宁安市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231085', '231000', '穆棱市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231100', '230000', '黑河市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('231102', '231100', '爱辉区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231121', '231100', '嫩江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231123', '231100', '逊克县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231124', '231100', '孙吴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231181', '231100', '北安市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231182', '231100', '五大连池市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231200', '230000', '绥化市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('231202', '231200', '北林区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231221', '231200', '望奎县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231222', '231200', '兰西县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231223', '231200', '青冈县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231224', '231200', '庆安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231225', '231200', '明水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231226', '231200', '绥棱县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231281', '231200', '安达市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231282', '231200', '肇东市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('231283', '231200', '海伦市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('232700', '230000', '大兴安岭地区', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('232721', '232700', '呼玛县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('232722', '232700', '塔河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('232723', '232700', '漠河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310000', '0', '上海市', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('310101', '310100', '黄浦区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310104', '310100', '徐汇区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310105', '310100', '长宁区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310106', '310100', '静安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310107', '310100', '普陀区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310108', '310100', '闸北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310109', '310100', '虹口区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310110', '310100', '杨浦区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310112', '310100', '闵行区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310113', '310100', '宝山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310114', '310100', '嘉定区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310115', '310100', '浦东新区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310116', '310100', '金山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310117', '310100', '松江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310118', '310100', '青浦区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310120', '310100', '奉贤区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('310230', '310200', '崇明县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320000', '0', '江苏省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('320100', '320000', '南京市', '0', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('320102', '320100', '玄武区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320104', '320100', '秦淮区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320105', '320100', '建邺区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320106', '320100', '鼓楼区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320111', '320100', '浦口区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320113', '320100', '栖霞区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320114', '320100', '雨花台区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320115', '320100', '江宁区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320116', '320100', '六合区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320117', '320100', '溧水区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320118', '320100', '高淳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320200', '320000', '无锡市', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('320202', '320200', '崇安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320203', '320200', '南长区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320204', '320200', '北塘区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320205', '320200', '锡山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320206', '320200', '惠山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320211', '320200', '滨湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320281', '320200', '江阴市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320282', '320200', '宜兴市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320300', '320000', '徐州市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('320302', '320300', '鼓楼区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320303', '320300', '云龙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320305', '320300', '贾汪区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320311', '320300', '泉山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320312', '320300', '铜山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320321', '320300', '丰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320322', '320300', '沛县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320324', '320300', '睢宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320381', '320300', '新沂市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320382', '320300', '邳州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320400', '320000', '常州市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('320402', '320400', '天宁区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320404', '320400', '钟楼区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320405', '320400', '戚墅堰区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320411', '320400', '新北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320412', '320400', '武进区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320481', '320400', '溧阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320482', '320400', '金坛市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320500', '320000', '苏州市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('320505', '320500', '虎丘区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320506', '320500', '吴中区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320507', '320500', '相城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320508', '320500', '姑苏区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320509', '320500', '吴江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320581', '320500', '常熟市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320582', '320500', '张家港市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320583', '320500', '昆山市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320585', '320500', '太仓市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320600', '320000', '南通市', '0', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('320602', '320600', '崇川区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320611', '320600', '港闸区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320612', '320600', '通州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320621', '320600', '海安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320623', '320600', '如东县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320681', '320600', '启东市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320682', '320600', '如皋市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320684', '320600', '海门市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320700', '320000', '连云港市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('320703', '320700', '连云区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320706', '320700', '海州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320707', '320700', '赣榆区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320722', '320700', '东海县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320723', '320700', '灌云县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320724', '320700', '灌南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320800', '320000', '淮安市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('320802', '320800', '清河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320803', '320800', '淮安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320804', '320800', '淮阴区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320811', '320800', '清浦区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320826', '320800', '涟水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320829', '320800', '洪泽县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320830', '320800', '盱眙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320831', '320800', '金湖县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320900', '320000', '盐城市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('320902', '320900', '亭湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320903', '320900', '盐都区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320921', '320900', '响水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320922', '320900', '滨海县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320923', '320900', '阜宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320924', '320900', '射阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320925', '320900', '建湖县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320981', '320900', '东台市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('320982', '320900', '大丰市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321000', '320000', '扬州市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('321002', '321000', '广陵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321003', '321000', '邗江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321012', '321000', '江都区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321023', '321000', '宝应县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321081', '321000', '仪征市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321084', '321000', '高邮市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321100', '320000', '镇江市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('321102', '321100', '京口区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321111', '321100', '润州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321112', '321100', '丹徒区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321181', '321100', '丹阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321182', '321100', '扬中市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321183', '321100', '句容市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321200', '320000', '泰州市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('321202', '321200', '海陵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321203', '321200', '高港区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321204', '321200', '姜堰区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321281', '321200', '兴化市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321282', '321200', '靖江市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321283', '321200', '泰兴市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321300', '320000', '宿迁市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('321302', '321300', '宿城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321311', '321300', '宿豫区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321322', '321300', '沭阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321323', '321300', '泗阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('321324', '321300', '泗洪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330000', '0', '浙江省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('330100', '330000', '杭州市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('330102', '330100', '上城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330103', '330100', '下城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330104', '330100', '江干区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330105', '330100', '拱墅区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330106', '330100', '西湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330108', '330100', '滨江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330109', '330100', '萧山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330110', '330100', '余杭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330111', '330100', '富阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330122', '330100', '桐庐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330127', '330100', '淳安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330182', '330100', '建德市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330185', '330100', '临安市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330200', '330000', '宁波市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('330203', '330200', '海曙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330204', '330200', '江东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330205', '330200', '江北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330206', '330200', '北仑区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330211', '330200', '镇海区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330212', '330200', '鄞州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330225', '330200', '象山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330226', '330200', '宁海县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330281', '330200', '余姚市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330282', '330200', '慈溪市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330283', '330200', '奉化市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330300', '330000', '温州市', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('330302', '330300', '鹿城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330303', '330300', '龙湾区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330304', '330300', '瓯海区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330322', '330300', '洞头县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330324', '330300', '永嘉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330326', '330300', '平阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330327', '330300', '苍南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330328', '330300', '文成县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330329', '330300', '泰顺县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330381', '330300', '瑞安市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330382', '330300', '乐清市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330400', '330000', '嘉兴市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('330402', '330400', '南湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330411', '330400', '秀洲区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330421', '330400', '嘉善县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330424', '330400', '海盐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330481', '330400', '海宁市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330482', '330400', '平湖市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330483', '330400', '桐乡市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330500', '330000', '湖州市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('330502', '330500', '吴兴区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330503', '330500', '南浔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330521', '330500', '德清县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330522', '330500', '长兴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330523', '330500', '安吉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330600', '330000', '绍兴市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('330602', '330600', '越城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330603', '330600', '柯桥区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330604', '330600', '上虞区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330624', '330600', '新昌县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330681', '330600', '诸暨市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330683', '330600', '嵊州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330700', '330000', '金华市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('330702', '330700', '婺城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330703', '330700', '金东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330723', '330700', '武义县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330726', '330700', '浦江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330727', '330700', '磐安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330781', '330700', '兰溪市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330782', '330700', '义乌市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330783', '330700', '东阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330784', '330700', '永康市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330800', '330000', '衢州市', '0', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('330802', '330800', '柯城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330803', '330800', '衢江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330822', '330800', '常山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330824', '330800', '开化县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330825', '330800', '龙游县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330881', '330800', '江山市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330900', '330000', '舟山市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('330902', '330900', '定海区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330903', '330900', '普陀区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330921', '330900', '岱山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('330922', '330900', '嵊泗县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331000', '330000', '台州市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('331002', '331000', '椒江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331003', '331000', '黄岩区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331004', '331000', '路桥区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331021', '331000', '玉环县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331022', '331000', '三门县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331023', '331000', '天台县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331024', '331000', '仙居县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331081', '331000', '温岭市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331082', '331000', '临海市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331100', '330000', '丽水市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('331102', '331100', '莲都区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331121', '331100', '青田县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331122', '331100', '缙云县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331123', '331100', '遂昌县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331124', '331100', '松阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331125', '331100', '云和县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331126', '331100', '庆元县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331127', '331100', '景宁畲族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('331181', '331100', '龙泉市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340000', '0', '安徽省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('340100', '340000', '合肥市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('340102', '340100', '瑶海区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340103', '340100', '庐阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340104', '340100', '蜀山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340111', '340100', '包河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340121', '340100', '长丰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340122', '340100', '肥东县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340123', '340100', '肥西县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340124', '340100', '庐江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340181', '340100', '巢湖市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340200', '340000', '芜湖市', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('340202', '340200', '镜湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340203', '340200', '弋江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340207', '340200', '鸠江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340208', '340200', '三山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340221', '340200', '芜湖县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340222', '340200', '繁昌县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340223', '340200', '南陵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340225', '340200', '无为县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340300', '340000', '蚌埠市', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('340302', '340300', '龙子湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340303', '340300', '蚌山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340304', '340300', '禹会区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340311', '340300', '淮上区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340321', '340300', '怀远县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340322', '340300', '五河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340323', '340300', '固镇县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340400', '340000', '淮南市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('340402', '340400', '大通区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340403', '340400', '田家庵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340404', '340400', '谢家集区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340405', '340400', '八公山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340406', '340400', '潘集区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340421', '340400', '凤台县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340500', '340000', '马鞍山市', '0', '0', 'M', '1', '1');
INSERT INTO `wst_areas` VALUES ('340503', '340500', '花山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340504', '340500', '雨山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340506', '340500', '博望区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340521', '340500', '当涂县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340522', '340500', '含山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340523', '340500', '和县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340600', '340000', '淮北市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('340602', '340600', '杜集区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340603', '340600', '相山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340604', '340600', '烈山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340621', '340600', '濉溪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340700', '340000', '铜陵市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('340702', '340700', '铜官山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340703', '340700', '狮子山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340711', '340700', '郊区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340721', '340700', '铜陵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340800', '340000', '安庆市', '0', '0', 'A', '1', '1');
INSERT INTO `wst_areas` VALUES ('340802', '340800', '迎江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340803', '340800', '大观区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340811', '340800', '宜秀区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340822', '340800', '怀宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340823', '340800', '枞阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340824', '340800', '潜山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340825', '340800', '太湖县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340826', '340800', '宿松县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340827', '340800', '望江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340828', '340800', '岳西县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('340881', '340800', '桐城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341000', '340000', '黄山市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('341002', '341000', '屯溪区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341003', '341000', '黄山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341004', '341000', '徽州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341021', '341000', '歙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341022', '341000', '休宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341023', '341000', '黟县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341024', '341000', '祁门县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341100', '340000', '滁州市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('341102', '341100', '琅琊区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341103', '341100', '南谯区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341122', '341100', '来安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341124', '341100', '全椒县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341125', '341100', '定远县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341126', '341100', '凤阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341181', '341100', '天长市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341182', '341100', '明光市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341200', '340000', '阜阳市', '0', '0', 'F', '1', '1');
INSERT INTO `wst_areas` VALUES ('341202', '341200', '颍州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341203', '341200', '颍东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341204', '341200', '颍泉区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341221', '341200', '临泉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341222', '341200', '太和县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341225', '341200', '阜南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341226', '341200', '颍上县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341282', '341200', '界首市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341300', '340000', '宿州市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('341302', '341300', '埇桥区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341321', '341300', '砀山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341322', '341300', '萧县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341323', '341300', '灵璧县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341324', '341300', '泗县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341500', '340000', '六安市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('341502', '341500', '金安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341503', '341500', '裕安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341521', '341500', '寿县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341522', '341500', '霍邱县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341523', '341500', '舒城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341524', '341500', '金寨县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341525', '341500', '霍山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341600', '340000', '亳州市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('341602', '341600', '谯城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341621', '341600', '涡阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341622', '341600', '蒙城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341623', '341600', '利辛县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341700', '340000', '池州市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('341702', '341700', '贵池区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341721', '341700', '东至县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341722', '341700', '石台县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341723', '341700', '青阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341800', '340000', '宣城市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('341802', '341800', '宣州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341821', '341800', '郎溪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341822', '341800', '广德县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341823', '341800', '泾县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341824', '341800', '绩溪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341825', '341800', '旌德县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('341881', '341800', '宁国市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350000', '0', '福建省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('350100', '350000', '福州市', '0', '0', 'F', '1', '1');
INSERT INTO `wst_areas` VALUES ('350102', '350100', '鼓楼区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350103', '350100', '台江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350104', '350100', '仓山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350105', '350100', '马尾区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350111', '350100', '晋安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350121', '350100', '闽侯县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350122', '350100', '连江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350123', '350100', '罗源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350124', '350100', '闽清县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350125', '350100', '永泰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350128', '350100', '平潭县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350181', '350100', '福清市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350182', '350100', '长乐市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350200', '350000', '厦门市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('350203', '350200', '思明区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350205', '350200', '海沧区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350206', '350200', '湖里区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350211', '350200', '集美区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350212', '350200', '同安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350213', '350200', '翔安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350300', '350000', '莆田市', '0', '0', 'P', '1', '1');
INSERT INTO `wst_areas` VALUES ('350302', '350300', '城厢区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350303', '350300', '涵江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350304', '350300', '荔城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350305', '350300', '秀屿区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350322', '350300', '仙游县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350400', '350000', '三明市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('350402', '350400', '梅列区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350403', '350400', '三元区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350421', '350400', '明溪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350423', '350400', '清流县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350424', '350400', '宁化县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350425', '350400', '大田县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350426', '350400', '尤溪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350427', '350400', '沙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350428', '350400', '将乐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350429', '350400', '泰宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350430', '350400', '建宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350481', '350400', '永安市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350500', '350000', '泉州市', '0', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('350502', '350500', '鲤城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350503', '350500', '丰泽区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350504', '350500', '洛江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350505', '350500', '泉港区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350521', '350500', '惠安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350524', '350500', '安溪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350525', '350500', '永春县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350526', '350500', '德化县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350527', '350500', '金门县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350581', '350500', '石狮市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350582', '350500', '晋江市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350583', '350500', '南安市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350600', '350000', '漳州市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('350602', '350600', '芗城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350603', '350600', '龙文区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350622', '350600', '云霄县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350623', '350600', '漳浦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350624', '350600', '诏安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350625', '350600', '长泰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350626', '350600', '东山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350627', '350600', '南靖县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350628', '350600', '平和县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350629', '350600', '华安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350681', '350600', '龙海市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350700', '350000', '南平市', '0', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('350702', '350700', '延平区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350703', '350700', '建阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350721', '350700', '顺昌县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350722', '350700', '浦城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350723', '350700', '光泽县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350724', '350700', '松溪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350725', '350700', '政和县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350781', '350700', '邵武市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350782', '350700', '武夷山市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350783', '350700', '建瓯市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350800', '350000', '龙岩市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('350802', '350800', '新罗区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350803', '350800', '永定区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350821', '350800', '长汀县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350823', '350800', '上杭县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350824', '350800', '武平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350825', '350800', '连城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350881', '350800', '漳平市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350900', '350000', '宁德市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('350902', '350900', '蕉城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350921', '350900', '霞浦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350922', '350900', '古田县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350923', '350900', '屏南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350924', '350900', '寿宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350925', '350900', '周宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350926', '350900', '柘荣县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350981', '350900', '福安市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('350982', '350900', '福鼎市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360000', '0', '江西省', '1', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('360100', '360000', '南昌市', '1', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('360102', '360100', '东湖区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360103', '360100', '西湖区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360104', '360100', '青云谱区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360105', '360100', '湾里区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360111', '360100', '青山湖区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360121', '360100', '南昌县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360122', '360100', '新建县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360123', '360100', '安义县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360124', '360100', '进贤县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360200', '360000', '景德镇市', '1', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('360202', '360200', '昌江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360203', '360200', '珠山区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360222', '360200', '浮梁县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360281', '360200', '乐平市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360300', '360000', '萍乡市', '1', '0', 'P', '1', '1');
INSERT INTO `wst_areas` VALUES ('360302', '360300', '安源区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360313', '360300', '湘东区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360321', '360300', '莲花县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360322', '360300', '上栗县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360323', '360300', '芦溪县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360400', '360000', '九江市', '1', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('360402', '360400', '庐山区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360403', '360400', '浔阳区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360421', '360400', '九江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360423', '360400', '武宁县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360424', '360400', '修水县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360425', '360400', '永修县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360426', '360400', '德安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360427', '360400', '星子县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360428', '360400', '都昌县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360429', '360400', '湖口县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360430', '360400', '彭泽县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360481', '360400', '瑞昌市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360482', '360400', '共青城市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360500', '360000', '新余市', '1', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('360502', '360500', '渝水区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360521', '360500', '分宜县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360600', '360000', '鹰潭市', '1', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('360602', '360600', '月湖区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360622', '360600', '余江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360681', '360600', '贵溪市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360700', '360000', '赣州市', '1', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('360702', '360700', '章贡区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360703', '360700', '南康区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360721', '360700', '赣县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360722', '360700', '信丰县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360723', '360700', '大余县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360724', '360700', '上犹县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360725', '360700', '崇义县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360726', '360700', '安远县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360727', '360700', '龙南县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360728', '360700', '定南县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360729', '360700', '全南县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360730', '360700', '宁都县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360731', '360700', '于都县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360732', '360700', '兴国县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360733', '360700', '会昌县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360734', '360700', '寻乌县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360735', '360700', '石城县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360781', '360700', '瑞金市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360800', '360000', '吉安市', '1', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('360802', '360800', '吉州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360803', '360800', '青原区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360821', '360800', '吉安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360822', '360800', '吉水县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360823', '360800', '峡江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360824', '360800', '新干县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360825', '360800', '永丰县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360826', '360800', '泰和县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360827', '360800', '遂川县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360828', '360800', '万安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360829', '360800', '安福县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360830', '360800', '永新县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360881', '360800', '井冈山市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360900', '360000', '宜春市', '1', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('360902', '360900', '袁州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360921', '360900', '奉新县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360922', '360900', '万载县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360923', '360900', '上高县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360924', '360900', '宜丰县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360925', '360900', '靖安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360926', '360900', '铜鼓县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360981', '360900', '丰城市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360982', '360900', '樟树市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('360983', '360900', '高安市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361000', '360000', '抚州市', '1', '0', 'F', '1', '1');
INSERT INTO `wst_areas` VALUES ('361002', '361000', '临川区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361021', '361000', '南城县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361022', '361000', '黎川县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361023', '361000', '南丰县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361024', '361000', '崇仁县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361025', '361000', '乐安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361026', '361000', '宜黄县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361027', '361000', '金溪县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361028', '361000', '资溪县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361029', '361000', '东乡县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361030', '361000', '广昌县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361100', '360000', '上饶市', '1', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('361102', '361100', '信州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361103', '361100', '广丰区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361121', '361100', '上饶县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361123', '361100', '玉山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361124', '361100', '铅山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361125', '361100', '横峰县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361126', '361100', '弋阳县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361127', '361100', '余干县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361128', '361100', '鄱阳县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361129', '361100', '万年县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361130', '361100', '婺源县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('361181', '361100', '德兴市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370000', '0', '山东省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('370100', '370000', '济南市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('370102', '370100', '历下区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370103', '370100', '市中区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370104', '370100', '槐荫区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370105', '370100', '天桥区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370112', '370100', '历城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370113', '370100', '长清区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370124', '370100', '平阴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370125', '370100', '济阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370126', '370100', '商河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370181', '370100', '章丘市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370200', '370000', '青岛市', '0', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('370202', '370200', '市南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370203', '370200', '市北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370211', '370200', '黄岛区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370212', '370200', '崂山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370213', '370200', '李沧区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370214', '370200', '城阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370281', '370200', '胶州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370282', '370200', '即墨市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370283', '370200', '平度市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370285', '370200', '莱西市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370300', '370000', '淄博市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('370302', '370300', '淄川区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370303', '370300', '张店区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370304', '370300', '博山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370305', '370300', '临淄区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370306', '370300', '周村区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370321', '370300', '桓台县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370322', '370300', '高青县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370323', '370300', '沂源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370400', '370000', '枣庄市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('370402', '370400', '市中区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370403', '370400', '薛城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370404', '370400', '峄城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370405', '370400', '台儿庄区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370406', '370400', '山亭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370481', '370400', '滕州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370500', '370000', '东营市', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('370502', '370500', '东营区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370503', '370500', '河口区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370521', '370500', '垦利县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370522', '370500', '利津县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370523', '370500', '广饶县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370600', '370000', '烟台市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('370602', '370600', '芝罘区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370611', '370600', '福山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370612', '370600', '牟平区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370613', '370600', '莱山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370634', '370600', '长岛县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370681', '370600', '龙口市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370682', '370600', '莱阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370683', '370600', '莱州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370684', '370600', '蓬莱市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370685', '370600', '招远市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370686', '370600', '栖霞市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370687', '370600', '海阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370700', '370000', '潍坊市', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('370702', '370700', '潍城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370703', '370700', '寒亭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370704', '370700', '坊子区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370705', '370700', '奎文区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370724', '370700', '临朐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370725', '370700', '昌乐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370781', '370700', '青州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370782', '370700', '诸城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370783', '370700', '寿光市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370784', '370700', '安丘市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370785', '370700', '高密市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370786', '370700', '昌邑市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370800', '370000', '济宁市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('370811', '370800', '任城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370812', '370800', '兖州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370826', '370800', '微山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370827', '370800', '鱼台县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370828', '370800', '金乡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370829', '370800', '嘉祥县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370830', '370800', '汶上县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370831', '370800', '泗水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370832', '370800', '梁山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370881', '370800', '曲阜市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370883', '370800', '邹城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370900', '370000', '泰安市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('370902', '370900', '泰山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370911', '370900', '岱岳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370921', '370900', '宁阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370923', '370900', '东平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370982', '370900', '新泰市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('370983', '370900', '肥城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371000', '370000', '威海市', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('371002', '371000', '环翠区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371081', '371000', '文登市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371082', '371000', '荣成市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371083', '371000', '乳山市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371100', '370000', '日照市', '0', '0', 'R', '1', '1');
INSERT INTO `wst_areas` VALUES ('371102', '371100', '东港区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371103', '371100', '岚山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371121', '371100', '五莲县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371122', '371100', '莒县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371200', '370000', '莱芜市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('371202', '371200', '莱城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371203', '371200', '钢城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371300', '370000', '临沂市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('371302', '371300', '兰山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371311', '371300', '罗庄区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371312', '371300', '河东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371321', '371300', '沂南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371322', '371300', '郯城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371323', '371300', '沂水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371324', '371300', '兰陵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371325', '371300', '费县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371326', '371300', '平邑县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371327', '371300', '莒南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371328', '371300', '蒙阴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371329', '371300', '临沭县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371400', '370000', '德州市', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('371402', '371400', '德城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371403', '371400', '陵城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371422', '371400', '宁津县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371423', '371400', '庆云县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371424', '371400', '临邑县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371425', '371400', '齐河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371426', '371400', '平原县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371427', '371400', '夏津县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371428', '371400', '武城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371481', '371400', '乐陵市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371482', '371400', '禹城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371500', '370000', '聊城市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('371502', '371500', '东昌府区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371521', '371500', '阳谷县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371522', '371500', '莘县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371523', '371500', '茌平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371524', '371500', '东阿县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371525', '371500', '冠县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371526', '371500', '高唐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371581', '371500', '临清市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371600', '370000', '滨州市', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('371602', '371600', '滨城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371603', '371600', '沾化区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371621', '371600', '惠民县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371622', '371600', '阳信县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371623', '371600', '无棣县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371625', '371600', '博兴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371626', '371600', '邹平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371700', '370000', '菏泽市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('371702', '371700', '牡丹区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371721', '371700', '曹县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371722', '371700', '单县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371723', '371700', '成武县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371724', '371700', '巨野县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371725', '371700', '郓城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371726', '371700', '鄄城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371727', '371700', '定陶县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('371728', '371700', '东明县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410000', '0', '河南省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('410100', '410000', '郑州市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('410102', '410100', '中原区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410103', '410100', '二七区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410104', '410100', '管城回族区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410105', '410100', '金水区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410106', '410100', '上街区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410108', '410100', '惠济区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410122', '410100', '中牟县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410181', '410100', '巩义市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410182', '410100', '荥阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410183', '410100', '新密市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410184', '410100', '新郑市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410185', '410100', '登封市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410200', '410000', '开封市', '0', '0', 'K', '1', '1');
INSERT INTO `wst_areas` VALUES ('410202', '410200', '龙亭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410203', '410200', '顺河回族区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410204', '410200', '鼓楼区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410205', '410200', '禹王台区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410212', '410200', '祥符区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410221', '410200', '杞县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410222', '410200', '通许县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410223', '410200', '尉氏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410225', '410200', '兰考县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410300', '410000', '洛阳市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('410302', '410300', '老城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410303', '410300', '西工区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410304', '410300', '瀍河回族区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410305', '410300', '涧西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410306', '410300', '吉利区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410311', '410300', '洛龙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410322', '410300', '孟津县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410323', '410300', '新安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410324', '410300', '栾川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410325', '410300', '嵩县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410326', '410300', '汝阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410327', '410300', '宜阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410328', '410300', '洛宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410329', '410300', '伊川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410381', '410300', '偃师市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410400', '410000', '平顶山市', '0', '0', 'P', '1', '1');
INSERT INTO `wst_areas` VALUES ('410402', '410400', '新华区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410403', '410400', '卫东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410404', '410400', '石龙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410411', '410400', '湛河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410421', '410400', '宝丰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410422', '410400', '叶县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410423', '410400', '鲁山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410425', '410400', '郏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410481', '410400', '舞钢市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410482', '410400', '汝州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410500', '410000', '安阳市', '0', '0', 'A', '1', '1');
INSERT INTO `wst_areas` VALUES ('410502', '410500', '文峰区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410503', '410500', '北关区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410505', '410500', '殷都区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410506', '410500', '龙安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410522', '410500', '安阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410523', '410500', '汤阴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410526', '410500', '滑县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410527', '410500', '内黄县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410581', '410500', '林州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410600', '410000', '鹤壁市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('410602', '410600', '鹤山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410603', '410600', '山城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410611', '410600', '淇滨区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410621', '410600', '浚县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410622', '410600', '淇县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410700', '410000', '新乡市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('410702', '410700', '红旗区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410703', '410700', '卫滨区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410704', '410700', '凤泉区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410711', '410700', '牧野区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410721', '410700', '新乡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410724', '410700', '获嘉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410725', '410700', '原阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410726', '410700', '延津县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410727', '410700', '封丘县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410728', '410700', '长垣县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410781', '410700', '卫辉市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410782', '410700', '辉县市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410800', '410000', '焦作市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('410802', '410800', '解放区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410803', '410800', '中站区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410804', '410800', '马村区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410811', '410800', '山阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410821', '410800', '修武县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410822', '410800', '博爱县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410823', '410800', '武陟县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410825', '410800', '温县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410882', '410800', '沁阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410883', '410800', '孟州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410900', '410000', '濮阳市', '0', '0', 'P', '1', '1');
INSERT INTO `wst_areas` VALUES ('410902', '410900', '华龙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410922', '410900', '清丰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410923', '410900', '南乐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410926', '410900', '范县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410927', '410900', '台前县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('410928', '410900', '濮阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411000', '410000', '许昌市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('411002', '411000', '魏都区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411023', '411000', '许昌县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411024', '411000', '鄢陵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411025', '411000', '襄城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411081', '411000', '禹州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411082', '411000', '长葛市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411100', '410000', '漯河市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('411102', '411100', '源汇区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411103', '411100', '郾城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411104', '411100', '召陵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411121', '411100', '舞阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411122', '411100', '临颍县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411200', '410000', '三门峡市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('411202', '411200', '湖滨区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411203', '411200', '陕州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411221', '411200', '渑池县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411224', '411200', '卢氏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411281', '411200', '义马市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411282', '411200', '灵宝市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411300', '410000', '南阳市', '0', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('411302', '411300', '宛城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411303', '411300', '卧龙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411321', '411300', '南召县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411322', '411300', '方城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411323', '411300', '西峡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411324', '411300', '镇平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411325', '411300', '内乡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411326', '411300', '淅川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411327', '411300', '社旗县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411328', '411300', '唐河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411329', '411300', '新野县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411330', '411300', '桐柏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411381', '411300', '邓州市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411400', '410000', '商丘市', '0', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('411402', '411400', '梁园区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411403', '411400', '睢阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411421', '411400', '民权县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411422', '411400', '睢县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411423', '411400', '宁陵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411424', '411400', '柘城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411425', '411400', '虞城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411426', '411400', '夏邑县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411481', '411400', '永城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411500', '410000', '信阳市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('411502', '411500', '浉河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411503', '411500', '平桥区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411521', '411500', '罗山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411522', '411500', '光山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411523', '411500', '新县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411524', '411500', '商城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411525', '411500', '固始县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411526', '411500', '潢川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411527', '411500', '淮滨县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411528', '411500', '息县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411600', '410000', '周口市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('411602', '411600', '川汇区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411621', '411600', '扶沟县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411622', '411600', '西华县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411623', '411600', '商水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411624', '411600', '沈丘县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411625', '411600', '郸城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411626', '411600', '淮阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411627', '411600', '太康县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411628', '411600', '鹿邑县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411681', '411600', '项城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411700', '410000', '驻马店市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('411702', '411700', '驿城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411721', '411700', '西平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411722', '411700', '上蔡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411723', '411700', '平舆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411724', '411700', '正阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411725', '411700', '确山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411726', '411700', '泌阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411727', '411700', '汝南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411728', '411700', '遂平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('411729', '411700', '新蔡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('419000', '410000', '省直辖县级行政区划', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('419001', '419000', '济源市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420000', '0', '湖北省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('420100', '420000', '武汉市', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('420102', '420100', '江岸区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420103', '420100', '江汉区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420104', '420100', '硚口区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420105', '420100', '汉阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420106', '420100', '武昌区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420107', '420100', '青山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420111', '420100', '洪山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420112', '420100', '东西湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420113', '420100', '汉南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420114', '420100', '蔡甸区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420115', '420100', '江夏区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420116', '420100', '黄陂区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420117', '420100', '新洲区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420200', '420000', '黄石市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('420202', '420200', '黄石港区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420203', '420200', '西塞山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420204', '420200', '下陆区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420205', '420200', '铁山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420222', '420200', '阳新县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420281', '420200', '大冶市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420300', '420000', '十堰市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('420302', '420300', '茅箭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420303', '420300', '张湾区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420304', '420300', '郧阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420322', '420300', '郧西县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420323', '420300', '竹山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420324', '420300', '竹溪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420325', '420300', '房县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420381', '420300', '丹江口市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420500', '420000', '宜昌市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('420502', '420500', '西陵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420503', '420500', '伍家岗区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420504', '420500', '点军区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420505', '420500', '猇亭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420506', '420500', '夷陵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420525', '420500', '远安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420526', '420500', '兴山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420527', '420500', '秭归县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420528', '420500', '长阳土家族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420529', '420500', '五峰土家族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420581', '420500', '宜都市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420582', '420500', '当阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420583', '420500', '枝江市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420600', '420000', '襄阳市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('420602', '420600', '襄城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420606', '420600', '樊城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420607', '420600', '襄州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420624', '420600', '南漳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420625', '420600', '谷城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420626', '420600', '保康县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420682', '420600', '老河口市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420683', '420600', '枣阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420684', '420600', '宜城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420700', '420000', '鄂州市', '0', '0', 'E', '1', '1');
INSERT INTO `wst_areas` VALUES ('420702', '420700', '梁子湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420703', '420700', '华容区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420704', '420700', '鄂城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420800', '420000', '荆门市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('420802', '420800', '东宝区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420804', '420800', '掇刀区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420821', '420800', '京山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420822', '420800', '沙洋县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420881', '420800', '钟祥市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420900', '420000', '孝感市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('420902', '420900', '孝南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420921', '420900', '孝昌县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420922', '420900', '大悟县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420923', '420900', '云梦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420981', '420900', '应城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420982', '420900', '安陆市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('420984', '420900', '汉川市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421000', '420000', '荆州市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('421002', '421000', '沙市区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421003', '421000', '荆州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421022', '421000', '公安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421023', '421000', '监利县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421024', '421000', '江陵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421081', '421000', '石首市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421083', '421000', '洪湖市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421087', '421000', '松滋市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421100', '420000', '黄冈市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('421102', '421100', '黄州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421121', '421100', '团风县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421122', '421100', '红安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421123', '421100', '罗田县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421124', '421100', '英山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421125', '421100', '浠水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421126', '421100', '蕲春县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421127', '421100', '黄梅县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421181', '421100', '麻城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421182', '421100', '武穴市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421200', '420000', '咸宁市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('421202', '421200', '咸安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421221', '421200', '嘉鱼县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421222', '421200', '通城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421223', '421200', '崇阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421224', '421200', '通山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421281', '421200', '赤壁市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421300', '420000', '随州市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('421303', '421300', '曾都区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421321', '421300', '随县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('421381', '421300', '广水市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('422800', '420000', '恩施土家族苗族自治州', '0', '0', 'E', '1', '1');
INSERT INTO `wst_areas` VALUES ('422801', '422800', '恩施市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('422802', '422800', '利川市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('422822', '422800', '建始县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('422823', '422800', '巴东县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('422825', '422800', '宣恩县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('422826', '422800', '咸丰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('422827', '422800', '来凤县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('422828', '422800', '鹤峰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('429000', '420000', '省直辖县级行政区划', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('429004', '429000', '仙桃市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('429005', '429000', '潜江市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('429006', '429000', '天门市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('429021', '429000', '神农架林区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430000', '0', '湖南省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('430100', '430000', '长沙市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('430102', '430100', '芙蓉区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430103', '430100', '天心区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430104', '430100', '岳麓区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430105', '430100', '开福区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430111', '430100', '雨花区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430112', '430100', '望城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430121', '430100', '长沙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430124', '430100', '宁乡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430181', '430100', '浏阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430200', '430000', '株洲市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('430202', '430200', '荷塘区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430203', '430200', '芦淞区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430204', '430200', '石峰区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430211', '430200', '天元区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430221', '430200', '株洲县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430223', '430200', '攸县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430224', '430200', '茶陵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430225', '430200', '炎陵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430281', '430200', '醴陵市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430300', '430000', '湘潭市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('430302', '430300', '雨湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430304', '430300', '岳塘区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430321', '430300', '湘潭县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430381', '430300', '湘乡市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430382', '430300', '韶山市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430400', '430000', '衡阳市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('430405', '430400', '珠晖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430406', '430400', '雁峰区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430407', '430400', '石鼓区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430408', '430400', '蒸湘区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430412', '430400', '南岳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430421', '430400', '衡阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430422', '430400', '衡南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430423', '430400', '衡山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430424', '430400', '衡东县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430426', '430400', '祁东县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430481', '430400', '耒阳市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430482', '430400', '常宁市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430500', '430000', '邵阳市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('430502', '430500', '双清区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430503', '430500', '大祥区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430511', '430500', '北塔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430521', '430500', '邵东县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430522', '430500', '新邵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430523', '430500', '邵阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430524', '430500', '隆回县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430525', '430500', '洞口县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430527', '430500', '绥宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430528', '430500', '新宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430529', '430500', '城步苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430581', '430500', '武冈市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430600', '430000', '岳阳市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('430602', '430600', '岳阳楼区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430603', '430600', '云溪区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430611', '430600', '君山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430621', '430600', '岳阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430623', '430600', '华容县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430624', '430600', '湘阴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430626', '430600', '平江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430681', '430600', '汨罗市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430682', '430600', '临湘市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430700', '430000', '常德市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('430702', '430700', '武陵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430703', '430700', '鼎城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430721', '430700', '安乡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430722', '430700', '汉寿县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430723', '430700', '澧县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430724', '430700', '临澧县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430725', '430700', '桃源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430726', '430700', '石门县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430781', '430700', '津市市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430800', '430000', '张家界市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('430802', '430800', '永定区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430811', '430800', '武陵源区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430821', '430800', '慈利县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430822', '430800', '桑植县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430900', '430000', '益阳市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('430902', '430900', '资阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430903', '430900', '赫山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430921', '430900', '南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430922', '430900', '桃江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430923', '430900', '安化县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('430981', '430900', '沅江市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431000', '430000', '郴州市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('431002', '431000', '北湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431003', '431000', '苏仙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431021', '431000', '桂阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431022', '431000', '宜章县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431023', '431000', '永兴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431024', '431000', '嘉禾县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431025', '431000', '临武县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431026', '431000', '汝城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431027', '431000', '桂东县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431028', '431000', '安仁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431081', '431000', '资兴市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431100', '430000', '永州市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('431102', '431100', '零陵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431103', '431100', '冷水滩区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431121', '431100', '祁阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431122', '431100', '东安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431123', '431100', '双牌县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431124', '431100', '道县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431125', '431100', '江永县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431126', '431100', '宁远县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431127', '431100', '蓝山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431128', '431100', '新田县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431129', '431100', '江华瑶族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431200', '430000', '怀化市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('431202', '431200', '鹤城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431221', '431200', '中方县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431222', '431200', '沅陵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431223', '431200', '辰溪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431224', '431200', '溆浦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431225', '431200', '会同县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431226', '431200', '麻阳苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431227', '431200', '新晃侗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431228', '431200', '芷江侗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431229', '431200', '靖州苗族侗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431230', '431200', '通道侗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431281', '431200', '洪江市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431300', '430000', '娄底市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('431302', '431300', '娄星区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431321', '431300', '双峰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431322', '431300', '新化县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431381', '431300', '冷水江市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('431382', '431300', '涟源市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('433100', '430000', '湘西土家族苗族自治州', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('433101', '433100', '吉首市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('433122', '433100', '泸溪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('433123', '433100', '凤凰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('433124', '433100', '花垣县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('433125', '433100', '保靖县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('433126', '433100', '古丈县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('433127', '433100', '永顺县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('433130', '433100', '龙山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440000', '0', '广东省', '1', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('440100', '440000', '广州市', '1', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('440103', '440100', '荔湾区', '1', '1', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440104', '440100', '越秀区', '1', '2', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440105', '440100', '海珠区', '1', '3', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440106', '440100', '天河区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440111', '440100', '白云区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440112', '440100', '黄埔区', '1', '4', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440113', '440100', '番禺区', '1', '5', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440114', '440100', '花都区', '1', '6', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440115', '440100', '南沙区', '1', '7', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440117', '440100', '从化区', '1', '8', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440118', '440100', '增城区', '1', '9', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440200', '440000', '韶关市', '1', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('440203', '440200', '武江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440204', '440200', '浈江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440205', '440200', '曲江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440222', '440200', '始兴县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440224', '440200', '仁化县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440229', '440200', '翁源县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440232', '440200', '乳源瑶族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440233', '440200', '新丰县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440281', '440200', '乐昌市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440282', '440200', '南雄市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440300', '440000', '深圳市', '1', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('440303', '440300', '罗湖区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440304', '440300', '福田区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440305', '440300', '南山区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440306', '440300', '宝安区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440307', '440300', '龙岗区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440308', '440300', '盐田区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440400', '440000', '珠海市', '1', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('440402', '440400', '香洲区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440403', '440400', '斗门区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440404', '440400', '金湾区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440500', '440000', '汕头市', '1', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('440507', '440500', '龙湖区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440511', '440500', '金平区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440512', '440500', '濠江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440513', '440500', '潮阳区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440514', '440500', '潮南区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440515', '440500', '澄海区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440523', '440500', '南澳县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440600', '440000', '佛山市', '1', '0', 'F', '1', '1');
INSERT INTO `wst_areas` VALUES ('440604', '440600', '禅城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440605', '440600', '南海区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440606', '440600', '顺德区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440607', '440600', '三水区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440608', '440600', '高明区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440700', '440000', '江门市', '1', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('440703', '440700', '蓬江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440704', '440700', '江海区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440705', '440700', '新会区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440781', '440700', '台山市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440783', '440700', '开平市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440784', '440700', '鹤山市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440785', '440700', '恩平市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440800', '440000', '湛江市', '1', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('440802', '440800', '赤坎区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440803', '440800', '霞山区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440804', '440800', '坡头区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440811', '440800', '麻章区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440823', '440800', '遂溪县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440825', '440800', '徐闻县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440881', '440800', '廉江市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440882', '440800', '雷州市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440883', '440800', '吴川市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440900', '440000', '茂名市', '1', '0', 'M', '1', '1');
INSERT INTO `wst_areas` VALUES ('440902', '440900', '茂南区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440904', '440900', '电白区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440981', '440900', '高州市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440982', '440900', '化州市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('440983', '440900', '信宜市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441200', '440000', '肇庆市', '1', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('441202', '441200', '端州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441203', '441200', '鼎湖区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441223', '441200', '广宁县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441224', '441200', '怀集县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441225', '441200', '封开县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441226', '441200', '德庆县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441283', '441200', '高要市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441284', '441200', '四会市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441300', '440000', '惠州市', '1', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('441302', '441300', '惠城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441303', '441300', '惠阳区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441322', '441300', '博罗县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441323', '441300', '惠东县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441324', '441300', '龙门县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441400', '440000', '梅州市', '1', '0', 'M', '1', '1');
INSERT INTO `wst_areas` VALUES ('441402', '441400', '梅江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441403', '441400', '梅县区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441422', '441400', '大埔县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441423', '441400', '丰顺县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441424', '441400', '五华县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441426', '441400', '平远县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441427', '441400', '蕉岭县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441481', '441400', '兴宁市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441500', '440000', '汕尾市', '1', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('441502', '441500', '城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441521', '441500', '海丰县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441523', '441500', '陆河县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441581', '441500', '陆丰市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441600', '440000', '河源市', '1', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('441602', '441600', '源城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441621', '441600', '紫金县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441622', '441600', '龙川县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441623', '441600', '连平县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441624', '441600', '和平县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441625', '441600', '东源县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441700', '440000', '阳江市', '1', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('441702', '441700', '江城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441704', '441700', '阳东区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441721', '441700', '阳西县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441781', '441700', '阳春市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441800', '440000', '清远市', '1', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('441802', '441800', '清城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441803', '441800', '清新区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441821', '441800', '佛冈县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441823', '441800', '阳山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441825', '441800', '连山壮族瑶族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441826', '441800', '连南瑶族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441881', '441800', '英德市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441882', '441800', '连州市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('441900', '440000', '东莞市', '1', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('442000', '440000', '中山市', '1', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('445100', '440000', '潮州市', '1', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('445102', '445100', '湘桥区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445103', '445100', '潮安区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445122', '445100', '饶平县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445200', '440000', '揭阳市', '1', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('445202', '445200', '榕城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445203', '445200', '揭东区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445222', '445200', '揭西县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445224', '445200', '惠来县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445281', '445200', '普宁市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445300', '440000', '云浮市', '1', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('445302', '445300', '云城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445303', '445300', '云安区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445321', '445300', '新兴县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445322', '445300', '郁南县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('445381', '445300', '罗定市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450000', '0', '广西壮族自治区', '1', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('450100', '450000', '南宁市', '1', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('450102', '450100', '兴宁区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450103', '450100', '青秀区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450105', '450100', '江南区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450107', '450100', '西乡塘区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450108', '450100', '良庆区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450109', '450100', '邕宁区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450110', '450100', '武鸣区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450123', '450100', '隆安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450124', '450100', '马山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450125', '450100', '上林县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450126', '450100', '宾阳县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450127', '450100', '横县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450200', '450000', '柳州市', '1', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('450202', '450200', '城中区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450203', '450200', '鱼峰区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450204', '450200', '柳南区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450205', '450200', '柳北区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450221', '450200', '柳江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450222', '450200', '柳城县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450223', '450200', '鹿寨县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450224', '450200', '融安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450225', '450200', '融水苗族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450226', '450200', '三江侗族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450300', '450000', '桂林市', '1', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('450302', '450300', '秀峰区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450303', '450300', '叠彩区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450304', '450300', '象山区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450305', '450300', '七星区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450311', '450300', '雁山区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450312', '450300', '临桂区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450321', '450300', '阳朔县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450323', '450300', '灵川县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450324', '450300', '全州县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450325', '450300', '兴安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450326', '450300', '永福县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450327', '450300', '灌阳县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450328', '450300', '龙胜各族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450329', '450300', '资源县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450330', '450300', '平乐县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450331', '450300', '荔浦县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450332', '450300', '恭城瑶族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450400', '450000', '梧州市', '1', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('450403', '450400', '万秀区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450405', '450400', '长洲区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450406', '450400', '龙圩区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450421', '450400', '苍梧县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450422', '450400', '藤县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450423', '450400', '蒙山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450481', '450400', '岑溪市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450500', '450000', '北海市', '1', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('450502', '450500', '海城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450503', '450500', '银海区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450512', '450500', '铁山港区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450521', '450500', '合浦县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450600', '450000', '防城港市', '1', '0', 'F', '1', '1');
INSERT INTO `wst_areas` VALUES ('450602', '450600', '港口区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450603', '450600', '防城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450621', '450600', '上思县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450681', '450600', '东兴市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450700', '450000', '钦州市', '1', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('450702', '450700', '钦南区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450703', '450700', '钦北区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450721', '450700', '灵山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450722', '450700', '浦北县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450800', '450000', '贵港市', '1', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('450802', '450800', '港北区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450803', '450800', '港南区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450804', '450800', '覃塘区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450821', '450800', '平南县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450881', '450800', '桂平市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450900', '450000', '玉林市', '1', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('450902', '450900', '玉州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450903', '450900', '福绵区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450921', '450900', '容县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450922', '450900', '陆川县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450923', '450900', '博白县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450924', '450900', '兴业县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('450981', '450900', '北流市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451000', '450000', '百色市', '1', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('451002', '451000', '右江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451021', '451000', '田阳县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451022', '451000', '田东县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451023', '451000', '平果县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451024', '451000', '德保县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451025', '451000', '靖西县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451026', '451000', '那坡县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451027', '451000', '凌云县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451028', '451000', '乐业县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451029', '451000', '田林县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451030', '451000', '西林县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451031', '451000', '隆林各族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451100', '450000', '贺州市', '1', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('451102', '451100', '八步区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451119', '451100', '平桂管理区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451121', '451100', '昭平县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451122', '451100', '钟山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451123', '451100', '富川瑶族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451200', '450000', '河池市', '1', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('451202', '451200', '金城江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451221', '451200', '南丹县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451222', '451200', '天峨县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451223', '451200', '凤山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451224', '451200', '东兰县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451225', '451200', '罗城仫佬族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451226', '451200', '环江毛南族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451227', '451200', '巴马瑶族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451228', '451200', '都安瑶族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451229', '451200', '大化瑶族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451281', '451200', '宜州市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451300', '450000', '来宾市', '1', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('451302', '451300', '兴宾区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451321', '451300', '忻城县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451322', '451300', '象州县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451323', '451300', '武宣县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451324', '451300', '金秀瑶族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451381', '451300', '合山市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451400', '450000', '崇左市', '1', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('451402', '451400', '江州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451421', '451400', '扶绥县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451422', '451400', '宁明县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451423', '451400', '龙州县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451424', '451400', '大新县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451425', '451400', '天等县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('451481', '451400', '凭祥市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('460000', '0', '海南省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('460100', '460000', '海口市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('460105', '460100', '秀英区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('460106', '460100', '龙华区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('460107', '460100', '琼山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('460108', '460100', '美兰区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('460200', '460000', '三亚市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('460202', '460200', '海棠区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('460203', '460200', '吉阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('460204', '460200', '天涯区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('460205', '460200', '崖州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('460300', '460000', '三沙市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('460400', '460000', '儋州市', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('469000', '460000', '省直辖县级行政区划', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('469001', '469000', '五指山市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469002', '469000', '琼海市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469005', '469000', '文昌市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469006', '469000', '万宁市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469007', '469000', '东方市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469021', '469000', '定安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469022', '469000', '屯昌县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469023', '469000', '澄迈县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469024', '469000', '临高县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469025', '469000', '白沙黎族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469026', '469000', '昌江黎族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469027', '469000', '乐东黎族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469028', '469000', '陵水黎族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469029', '469000', '保亭黎族苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('469030', '469000', '琼中黎族苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500000', '0', '重庆市', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('500101', '500100', '万州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500102', '500100', '涪陵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500103', '500100', '渝中区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500104', '500100', '大渡口区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500105', '500100', '江北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500106', '500100', '沙坪坝区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500107', '500100', '九龙坡区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500108', '500100', '南岸区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500109', '500100', '北碚区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500110', '500100', '綦江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500111', '500100', '大足区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500112', '500100', '渝北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500113', '500100', '巴南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500114', '500100', '黔江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500115', '500100', '长寿区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500116', '500100', '江津区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500117', '500100', '合川区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500118', '500100', '永川区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500119', '500100', '南川区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500120', '500100', '璧山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500151', '500100', '铜梁区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500223', '500200', '潼南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500226', '500200', '荣昌县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500228', '500200', '梁平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500229', '500200', '城口县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500230', '500200', '丰都县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500231', '500200', '垫江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500232', '500200', '武隆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500233', '500200', '忠县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500234', '500200', '开县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500235', '500200', '云阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500236', '500200', '奉节县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500237', '500200', '巫山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500238', '500200', '巫溪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500240', '500200', '石柱土家族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500241', '500200', '秀山土家族苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500242', '500200', '酉阳土家族苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('500243', '500200', '彭水苗族土家族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510000', '0', '四川省', '1', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('510100', '510000', '成都市', '1', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('510104', '510100', '锦江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510105', '510100', '青羊区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510106', '510100', '金牛区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510107', '510100', '武侯区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510108', '510100', '成华区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510112', '510100', '龙泉驿区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510113', '510100', '青白江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510114', '510100', '新都区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510115', '510100', '温江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510121', '510100', '金堂县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510122', '510100', '双流县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510124', '510100', '郫县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510129', '510100', '大邑县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510131', '510100', '蒲江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510132', '510100', '新津县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510181', '510100', '都江堰市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510182', '510100', '彭州市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510183', '510100', '邛崃市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510184', '510100', '崇州市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510300', '510000', '自贡市', '1', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('510302', '510300', '自流井区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510303', '510300', '贡井区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510304', '510300', '大安区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510311', '510300', '沿滩区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510321', '510300', '荣县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510322', '510300', '富顺县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510400', '510000', '攀枝花市', '1', '0', 'P', '1', '1');
INSERT INTO `wst_areas` VALUES ('510402', '510400', '东区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510403', '510400', '西区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510411', '510400', '仁和区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510421', '510400', '米易县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510422', '510400', '盐边县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510500', '510000', '泸州市', '1', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('510502', '510500', '江阳区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510503', '510500', '纳溪区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510504', '510500', '龙马潭区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510521', '510500', '泸县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510522', '510500', '合江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510524', '510500', '叙永县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510525', '510500', '古蔺县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510600', '510000', '德阳市', '1', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('510603', '510600', '旌阳区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510623', '510600', '中江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510626', '510600', '罗江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510681', '510600', '广汉市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510682', '510600', '什邡市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510683', '510600', '绵竹市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510700', '510000', '绵阳市', '1', '0', 'M', '1', '1');
INSERT INTO `wst_areas` VALUES ('510703', '510700', '涪城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510704', '510700', '游仙区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510722', '510700', '三台县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510723', '510700', '盐亭县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510724', '510700', '安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510725', '510700', '梓潼县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510726', '510700', '北川羌族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510727', '510700', '平武县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510781', '510700', '江油市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510800', '510000', '广元市', '1', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('510802', '510800', '利州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510811', '510800', '昭化区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510812', '510800', '朝天区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510821', '510800', '旺苍县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510822', '510800', '青川县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510823', '510800', '剑阁县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510824', '510800', '苍溪县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510900', '510000', '遂宁市', '1', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('510903', '510900', '船山区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510904', '510900', '安居区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510921', '510900', '蓬溪县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510922', '510900', '射洪县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('510923', '510900', '大英县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511000', '510000', '内江市', '1', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('511002', '511000', '市中区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511011', '511000', '东兴区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511024', '511000', '威远县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511025', '511000', '资中县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511028', '511000', '隆昌县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511100', '510000', '乐山市', '1', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('511102', '511100', '市中区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511111', '511100', '沙湾区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511112', '511100', '五通桥区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511113', '511100', '金口河区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511123', '511100', '犍为县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511124', '511100', '井研县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511126', '511100', '夹江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511129', '511100', '沐川县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511132', '511100', '峨边彝族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511133', '511100', '马边彝族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511181', '511100', '峨眉山市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511300', '510000', '南充市', '1', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('511302', '511300', '顺庆区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511303', '511300', '高坪区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511304', '511300', '嘉陵区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511321', '511300', '南部县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511322', '511300', '营山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511323', '511300', '蓬安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511324', '511300', '仪陇县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511325', '511300', '西充县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511381', '511300', '阆中市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511400', '510000', '眉山市', '1', '0', 'M', '1', '1');
INSERT INTO `wst_areas` VALUES ('511402', '511400', '东坡区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511403', '511400', '彭山区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511421', '511400', '仁寿县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511423', '511400', '洪雅县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511424', '511400', '丹棱县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511425', '511400', '青神县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511500', '510000', '宜宾市', '1', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('511502', '511500', '翠屏区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511503', '511500', '南溪区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511521', '511500', '宜宾县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511523', '511500', '江安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511524', '511500', '长宁县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511525', '511500', '高县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511526', '511500', '珙县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511527', '511500', '筠连县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511528', '511500', '兴文县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511529', '511500', '屏山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511600', '510000', '广安市', '1', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('511602', '511600', '广安区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511603', '511600', '前锋区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511621', '511600', '岳池县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511622', '511600', '武胜县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511623', '511600', '邻水县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511681', '511600', '华蓥市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511700', '510000', '达州市', '1', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('511702', '511700', '通川区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511703', '511700', '达川区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511722', '511700', '宣汉县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511723', '511700', '开江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511724', '511700', '大竹县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511725', '511700', '渠县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511781', '511700', '万源市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511800', '510000', '雅安市', '1', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('511802', '511800', '雨城区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511803', '511800', '名山区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511822', '511800', '荥经县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511823', '511800', '汉源县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511824', '511800', '石棉县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511825', '511800', '天全县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511826', '511800', '芦山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511827', '511800', '宝兴县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511900', '510000', '巴中市', '1', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('511902', '511900', '巴州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511903', '511900', '恩阳区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511921', '511900', '通江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511922', '511900', '南江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('511923', '511900', '平昌县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('512000', '510000', '资阳市', '1', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('512002', '512000', '雁江区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('512021', '512000', '安岳县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('512022', '512000', '乐至县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('512081', '512000', '简阳市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513200', '510000', '阿坝藏族羌族自治州', '1', '0', 'A', '1', '1');
INSERT INTO `wst_areas` VALUES ('513221', '513200', '汶川县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513222', '513200', '理县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513223', '513200', '茂县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513224', '513200', '松潘县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513225', '513200', '九寨沟县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513226', '513200', '金川县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513227', '513200', '小金县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513228', '513200', '黑水县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513229', '513200', '马尔康县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513230', '513200', '壤塘县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513231', '513200', '阿坝县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513232', '513200', '若尔盖县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513233', '513200', '红原县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513300', '510000', '甘孜藏族自治州', '1', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('513301', '513300', '康定市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513322', '513300', '泸定县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513323', '513300', '丹巴县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513324', '513300', '九龙县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513325', '513300', '雅江县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513326', '513300', '道孚县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513327', '513300', '炉霍县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513328', '513300', '甘孜县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513329', '513300', '新龙县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513330', '513300', '德格县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513331', '513300', '白玉县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513332', '513300', '石渠县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513333', '513300', '色达县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513334', '513300', '理塘县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513335', '513300', '巴塘县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513336', '513300', '乡城县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513337', '513300', '稻城县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513338', '513300', '得荣县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513400', '510000', '凉山彝族自治州', '1', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('513401', '513400', '西昌市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513422', '513400', '木里藏族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513423', '513400', '盐源县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513424', '513400', '德昌县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513425', '513400', '会理县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513426', '513400', '会东县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513427', '513400', '宁南县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513428', '513400', '普格县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513429', '513400', '布拖县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513430', '513400', '金阳县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513431', '513400', '昭觉县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513432', '513400', '喜德县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513433', '513400', '冕宁县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513434', '513400', '越西县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513435', '513400', '甘洛县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513436', '513400', '美姑县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('513437', '513400', '雷波县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520000', '0', '贵州省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('520100', '520000', '贵阳市', '0', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('520102', '520100', '南明区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520103', '520100', '云岩区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520111', '520100', '花溪区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520112', '520100', '乌当区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520113', '520100', '白云区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520115', '520100', '观山湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520121', '520100', '开阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520122', '520100', '息烽县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520123', '520100', '修文县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520181', '520100', '清镇市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520200', '520000', '六盘水市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('520201', '520200', '钟山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520203', '520200', '六枝特区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520221', '520200', '水城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520222', '520200', '盘县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520300', '520000', '遵义市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('520302', '520300', '红花岗区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520303', '520300', '汇川区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520321', '520300', '遵义县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520322', '520300', '桐梓县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520323', '520300', '绥阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520324', '520300', '正安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520325', '520300', '道真仡佬族苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520326', '520300', '务川仡佬族苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520327', '520300', '凤冈县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520328', '520300', '湄潭县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520329', '520300', '余庆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520330', '520300', '习水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520381', '520300', '赤水市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520382', '520300', '仁怀市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520400', '520000', '安顺市', '0', '0', 'A', '1', '1');
INSERT INTO `wst_areas` VALUES ('520402', '520400', '西秀区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520403', '520400', '平坝区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520422', '520400', '普定县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520423', '520400', '镇宁布依族苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520424', '520400', '关岭布依族苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520425', '520400', '紫云苗族布依族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520500', '520000', '毕节市', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('520502', '520500', '七星关区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520521', '520500', '大方县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520522', '520500', '黔西县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520523', '520500', '金沙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520524', '520500', '织金县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520525', '520500', '纳雍县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520526', '520500', '威宁彝族回族苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520527', '520500', '赫章县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520600', '520000', '铜仁市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('520602', '520600', '碧江区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520603', '520600', '万山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520621', '520600', '江口县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520622', '520600', '玉屏侗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520623', '520600', '石阡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520624', '520600', '思南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520625', '520600', '印江土家族苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520626', '520600', '德江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520627', '520600', '沿河土家族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('520628', '520600', '松桃苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522300', '520000', '黔西南布依族苗族自治州', '0', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('522301', '522300', '兴义市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522322', '522300', '兴仁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522323', '522300', '普安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522324', '522300', '晴隆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522325', '522300', '贞丰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522326', '522300', '望谟县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522327', '522300', '册亨县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522328', '522300', '安龙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522600', '520000', '黔东南苗族侗族自治州', '0', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('522601', '522600', '凯里市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522622', '522600', '黄平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522623', '522600', '施秉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522624', '522600', '三穗县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522625', '522600', '镇远县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522626', '522600', '岑巩县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522627', '522600', '天柱县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522628', '522600', '锦屏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522629', '522600', '剑河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522630', '522600', '台江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522631', '522600', '黎平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522632', '522600', '榕江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522633', '522600', '从江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522634', '522600', '雷山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522635', '522600', '麻江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522636', '522600', '丹寨县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522700', '520000', '黔南布依族苗族自治州', '0', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('522701', '522700', '都匀市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522702', '522700', '福泉市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522722', '522700', '荔波县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522723', '522700', '贵定县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522725', '522700', '瓮安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522726', '522700', '独山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522727', '522700', '平塘县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522728', '522700', '罗甸县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522729', '522700', '长顺县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522730', '522700', '龙里县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522731', '522700', '惠水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('522732', '522700', '三都水族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530000', '0', '云南省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('530100', '530000', '昆明市', '0', '0', 'K', '1', '1');
INSERT INTO `wst_areas` VALUES ('530102', '530100', '五华区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530103', '530100', '盘龙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530111', '530100', '官渡区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530112', '530100', '西山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530113', '530100', '东川区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530114', '530100', '呈贡区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530122', '530100', '晋宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530124', '530100', '富民县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530125', '530100', '宜良县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530126', '530100', '石林彝族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530127', '530100', '嵩明县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530128', '530100', '禄劝彝族苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530129', '530100', '寻甸回族彝族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530181', '530100', '安宁市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530300', '530000', '曲靖市', '0', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('530302', '530300', '麒麟区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530321', '530300', '马龙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530322', '530300', '陆良县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530323', '530300', '师宗县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530324', '530300', '罗平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530325', '530300', '富源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530326', '530300', '会泽县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530328', '530300', '沾益县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530381', '530300', '宣威市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530400', '530000', '玉溪市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('530402', '530400', '红塔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530421', '530400', '江川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530422', '530400', '澄江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530423', '530400', '通海县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530424', '530400', '华宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530425', '530400', '易门县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530426', '530400', '峨山彝族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530427', '530400', '新平彝族傣族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530428', '530400', '元江哈尼族彝族傣族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530500', '530000', '保山市', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('530502', '530500', '隆阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530521', '530500', '施甸县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530522', '530500', '腾冲县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530523', '530500', '龙陵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530524', '530500', '昌宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530600', '530000', '昭通市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('530602', '530600', '昭阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530621', '530600', '鲁甸县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530622', '530600', '巧家县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530623', '530600', '盐津县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530624', '530600', '大关县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530625', '530600', '永善县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530626', '530600', '绥江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530627', '530600', '镇雄县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530628', '530600', '彝良县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530629', '530600', '威信县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530630', '530600', '水富县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530700', '530000', '丽江市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('530702', '530700', '古城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530721', '530700', '玉龙纳西族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530722', '530700', '永胜县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530723', '530700', '华坪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530724', '530700', '宁蒗彝族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530800', '530000', '普洱市', '0', '0', 'P', '1', '1');
INSERT INTO `wst_areas` VALUES ('530802', '530800', '思茅区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530821', '530800', '宁洱哈尼族彝族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530822', '530800', '墨江哈尼族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530823', '530800', '景东彝族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530824', '530800', '景谷傣族彝族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530825', '530800', '镇沅彝族哈尼族拉祜族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530826', '530800', '江城哈尼族彝族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530827', '530800', '孟连傣族拉祜族佤族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530828', '530800', '澜沧拉祜族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530829', '530800', '西盟佤族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530900', '530000', '临沧市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('530902', '530900', '临翔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530921', '530900', '凤庆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530922', '530900', '云县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530923', '530900', '永德县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530924', '530900', '镇康县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530925', '530900', '双江拉祜族佤族布朗族傣族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530926', '530900', '耿马傣族佤族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('530927', '530900', '沧源佤族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532300', '530000', '楚雄彝族自治州', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('532301', '532300', '楚雄市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532322', '532300', '双柏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532323', '532300', '牟定县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532324', '532300', '南华县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532325', '532300', '姚安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532326', '532300', '大姚县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532327', '532300', '永仁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532328', '532300', '元谋县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532329', '532300', '武定县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532331', '532300', '禄丰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532500', '530000', '红河哈尼族彝族自治州', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('532501', '532500', '个旧市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532502', '532500', '开远市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532503', '532500', '蒙自市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532504', '532500', '弥勒市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532523', '532500', '屏边苗族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532524', '532500', '建水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532525', '532500', '石屏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532527', '532500', '泸西县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532528', '532500', '元阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532529', '532500', '红河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532530', '532500', '金平苗族瑶族傣族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532531', '532500', '绿春县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532532', '532500', '河口瑶族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532600', '530000', '文山壮族苗族自治州', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('532601', '532600', '文山市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532622', '532600', '砚山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532623', '532600', '西畴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532624', '532600', '麻栗坡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532625', '532600', '马关县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532626', '532600', '丘北县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532627', '532600', '广南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532628', '532600', '富宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532800', '530000', '西双版纳傣族自治州', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('532801', '532800', '景洪市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532822', '532800', '勐海县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532823', '532800', '勐腊县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532900', '530000', '大理白族自治州', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('532901', '532900', '大理市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532922', '532900', '漾濞彝族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532923', '532900', '祥云县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532924', '532900', '宾川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532925', '532900', '弥渡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532926', '532900', '南涧彝族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532927', '532900', '巍山彝族回族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532928', '532900', '永平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532929', '532900', '云龙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532930', '532900', '洱源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532931', '532900', '剑川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('532932', '532900', '鹤庆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533100', '530000', '德宏傣族景颇族自治州', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('533102', '533100', '瑞丽市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533103', '533100', '芒市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533122', '533100', '梁河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533123', '533100', '盈江县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533124', '533100', '陇川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533300', '530000', '怒江傈僳族自治州', '0', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('533321', '533300', '泸水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533323', '533300', '福贡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533324', '533300', '贡山独龙族怒族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533325', '533300', '兰坪白族普米族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533400', '530000', '迪庆藏族自治州', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('533401', '533400', '香格里拉市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533422', '533400', '德钦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('533423', '533400', '维西傈僳族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540000', '0', '西藏自治区', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('540100', '540000', '拉萨市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('540102', '540100', '城关区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540121', '540100', '林周县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540122', '540100', '当雄县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540123', '540100', '尼木县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540124', '540100', '曲水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540125', '540100', '堆龙德庆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540126', '540100', '达孜县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540127', '540100', '墨竹工卡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540200', '540000', '日喀则市', '0', '0', 'R', '1', '1');
INSERT INTO `wst_areas` VALUES ('540202', '540200', '桑珠孜区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540221', '540200', '南木林县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540222', '540200', '江孜县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540223', '540200', '定日县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540224', '540200', '萨迦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540225', '540200', '拉孜县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540226', '540200', '昂仁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540227', '540200', '谢通门县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540228', '540200', '白朗县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540229', '540200', '仁布县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540230', '540200', '康马县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540231', '540200', '定结县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540232', '540200', '仲巴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540233', '540200', '亚东县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540234', '540200', '吉隆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540235', '540200', '聂拉木县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540236', '540200', '萨嘎县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540237', '540200', '岗巴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540300', '540000', '昌都市', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('540302', '540300', '卡若区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540321', '540300', '江达县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540322', '540300', '贡觉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540323', '540300', '类乌齐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540324', '540300', '丁青县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540325', '540300', '察雅县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540326', '540300', '八宿县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540327', '540300', '左贡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540328', '540300', '芒康县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540329', '540300', '洛隆县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540330', '540300', '边坝县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540400', '540000', '林芝市', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('540402', '540400', '巴宜区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540421', '540400', '工布江达县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540422', '540400', '米林县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540423', '540400', '墨脱县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540424', '540400', '波密县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540425', '540400', '察隅县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('540426', '540400', '朗县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542200', '540000', '山南地区', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('542221', '542200', '乃东县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542222', '542200', '扎囊县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542223', '542200', '贡嘎县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542224', '542200', '桑日县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542225', '542200', '琼结县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542226', '542200', '曲松县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542227', '542200', '措美县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542228', '542200', '洛扎县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542229', '542200', '加查县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542231', '542200', '隆子县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542232', '542200', '错那县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542233', '542200', '浪卡子县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542400', '540000', '那曲地区', '0', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('542421', '542400', '那曲县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542422', '542400', '嘉黎县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542423', '542400', '比如县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542424', '542400', '聂荣县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542425', '542400', '安多县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542426', '542400', '申扎县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542427', '542400', '索县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542428', '542400', '班戈县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542429', '542400', '巴青县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542430', '542400', '尼玛县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542431', '542400', '双湖县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542500', '540000', '阿里地区', '0', '0', 'A', '1', '1');
INSERT INTO `wst_areas` VALUES ('542521', '542500', '普兰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542522', '542500', '札达县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542523', '542500', '噶尔县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542524', '542500', '日土县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542525', '542500', '革吉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542526', '542500', '改则县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('542527', '542500', '措勤县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610000', '0', '陕西省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('610100', '610000', '西安市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('610102', '610100', '新城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610103', '610100', '碑林区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610104', '610100', '莲湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610111', '610100', '灞桥区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610112', '610100', '未央区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610113', '610100', '雁塔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610114', '610100', '阎良区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610115', '610100', '临潼区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610116', '610100', '长安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610117', '610100', '高陵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610122', '610100', '蓝田县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610124', '610100', '周至县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610125', '610100', '户县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610200', '610000', '铜川市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('610202', '610200', '王益区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610203', '610200', '印台区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610204', '610200', '耀州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610222', '610200', '宜君县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610300', '610000', '宝鸡市', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('610302', '610300', '渭滨区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610303', '610300', '金台区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610304', '610300', '陈仓区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610322', '610300', '凤翔县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610323', '610300', '岐山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610324', '610300', '扶风县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610326', '610300', '眉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610327', '610300', '陇县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610328', '610300', '千阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610329', '610300', '麟游县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610330', '610300', '凤县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610331', '610300', '太白县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610400', '610000', '咸阳市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('610402', '610400', '秦都区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610403', '610400', '杨陵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610404', '610400', '渭城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610422', '610400', '三原县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610423', '610400', '泾阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610424', '610400', '乾县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610425', '610400', '礼泉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610426', '610400', '永寿县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610427', '610400', '彬县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610428', '610400', '长武县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610429', '610400', '旬邑县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610430', '610400', '淳化县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610431', '610400', '武功县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610481', '610400', '兴平市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610500', '610000', '渭南市', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('610502', '610500', '临渭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610521', '610500', '华县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610522', '610500', '潼关县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610523', '610500', '大荔县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610524', '610500', '合阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610525', '610500', '澄城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610526', '610500', '蒲城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610527', '610500', '白水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610528', '610500', '富平县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610581', '610500', '韩城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610582', '610500', '华阴市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610600', '610000', '延安市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('610602', '610600', '宝塔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610621', '610600', '延长县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610622', '610600', '延川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610623', '610600', '子长县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610624', '610600', '安塞县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610625', '610600', '志丹县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610626', '610600', '吴起县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610627', '610600', '甘泉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610628', '610600', '富县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610629', '610600', '洛川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610630', '610600', '宜川县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610631', '610600', '黄龙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610632', '610600', '黄陵县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610700', '610000', '汉中市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('610702', '610700', '汉台区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610721', '610700', '南郑县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610722', '610700', '城固县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610723', '610700', '洋县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610724', '610700', '西乡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610725', '610700', '勉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610726', '610700', '宁强县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610727', '610700', '略阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610728', '610700', '镇巴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610729', '610700', '留坝县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610730', '610700', '佛坪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610800', '610000', '榆林市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('610802', '610800', '榆阳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610821', '610800', '神木县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610822', '610800', '府谷县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610823', '610800', '横山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610824', '610800', '靖边县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610825', '610800', '定边县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610826', '610800', '绥德县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610827', '610800', '米脂县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610828', '610800', '佳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610829', '610800', '吴堡县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610830', '610800', '清涧县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610831', '610800', '子洲县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610900', '610000', '安康市', '0', '0', 'A', '1', '1');
INSERT INTO `wst_areas` VALUES ('610902', '610900', '汉滨区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610921', '610900', '汉阴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610922', '610900', '石泉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610923', '610900', '宁陕县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610924', '610900', '紫阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610925', '610900', '岚皋县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610926', '610900', '平利县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610927', '610900', '镇坪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610928', '610900', '旬阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('610929', '610900', '白河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('611000', '610000', '商洛市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('611002', '611000', '商州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('611021', '611000', '洛南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('611022', '611000', '丹凤县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('611023', '611000', '商南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('611024', '611000', '山阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('611025', '611000', '镇安县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('611026', '611000', '柞水县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620000', '0', '甘肃省', '1', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('620100', '620000', '兰州市', '1', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('620102', '620100', '城关区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620103', '620100', '七里河区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620104', '620100', '西固区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620105', '620100', '安宁区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620111', '620100', '红古区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620121', '620100', '永登县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620122', '620100', '皋兰县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620123', '620100', '榆中县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620200', '620000', '嘉峪关市', '1', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('620300', '620000', '金昌市', '1', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('620302', '620300', '金川区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620321', '620300', '永昌县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620400', '620000', '白银市', '1', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('620402', '620400', '白银区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620403', '620400', '平川区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620421', '620400', '靖远县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620422', '620400', '会宁县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620423', '620400', '景泰县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620500', '620000', '天水市', '1', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('620502', '620500', '秦州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620503', '620500', '麦积区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620521', '620500', '清水县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620522', '620500', '秦安县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620523', '620500', '甘谷县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620524', '620500', '武山县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620525', '620500', '张家川回族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620600', '620000', '武威市', '1', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('620602', '620600', '凉州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620621', '620600', '民勤县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620622', '620600', '古浪县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620623', '620600', '天祝藏族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620700', '620000', '张掖市', '1', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('620702', '620700', '甘州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620721', '620700', '肃南裕固族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620722', '620700', '民乐县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620723', '620700', '临泽县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620724', '620700', '高台县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620725', '620700', '山丹县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620800', '620000', '平凉市', '1', '0', 'P', '1', '1');
INSERT INTO `wst_areas` VALUES ('620802', '620800', '崆峒区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620821', '620800', '泾川县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620822', '620800', '灵台县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620823', '620800', '崇信县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620824', '620800', '华亭县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620825', '620800', '庄浪县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620826', '620800', '静宁县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620900', '620000', '酒泉市', '1', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('620902', '620900', '肃州区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620921', '620900', '金塔县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620922', '620900', '瓜州县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620923', '620900', '肃北蒙古族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620924', '620900', '阿克塞哈萨克族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620981', '620900', '玉门市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('620982', '620900', '敦煌市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621000', '620000', '庆阳市', '1', '0', 'Q', '1', '1');
INSERT INTO `wst_areas` VALUES ('621002', '621000', '西峰区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621021', '621000', '庆城县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621022', '621000', '环县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621023', '621000', '华池县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621024', '621000', '合水县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621025', '621000', '正宁县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621026', '621000', '宁县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621027', '621000', '镇原县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621100', '620000', '定西市', '1', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('621102', '621100', '安定区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621121', '621100', '通渭县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621122', '621100', '陇西县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621123', '621100', '渭源县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621124', '621100', '临洮县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621125', '621100', '漳县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621126', '621100', '岷县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621200', '620000', '陇南市', '1', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('621202', '621200', '武都区', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621221', '621200', '成县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621222', '621200', '文县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621223', '621200', '宕昌县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621224', '621200', '康县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621225', '621200', '西和县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621226', '621200', '礼县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621227', '621200', '徽县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('621228', '621200', '两当县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('622900', '620000', '临夏回族自治州', '1', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('622901', '622900', '临夏市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('622921', '622900', '临夏县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('622922', '622900', '康乐县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('622923', '622900', '永靖县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('622924', '622900', '广河县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('622925', '622900', '和政县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('622926', '622900', '东乡族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('622927', '622900', '积石山保安族东乡族撒拉族自治县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('623000', '620000', '甘南藏族自治州', '1', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('623001', '623000', '合作市', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('623021', '623000', '临潭县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('623022', '623000', '卓尼县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('623023', '623000', '舟曲县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('623024', '623000', '迭部县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('623025', '623000', '玛曲县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('623026', '623000', '碌曲县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('623027', '623000', '夏河县', '1', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630000', '0', '青海省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('630100', '630000', '西宁市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('630102', '630100', '城东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630103', '630100', '城中区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630104', '630100', '城西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630105', '630100', '城北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630121', '630100', '大通回族土族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630122', '630100', '湟中县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630123', '630100', '湟源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630200', '630000', '海东市', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('630202', '630200', '乐都区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630203', '630200', '平安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630222', '630200', '民和回族土族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630223', '630200', '互助土族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630224', '630200', '化隆回族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('630225', '630200', '循化撒拉族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632200', '630000', '海北藏族自治州', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('632221', '632200', '门源回族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632222', '632200', '祁连县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632223', '632200', '海晏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632224', '632200', '刚察县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632300', '630000', '黄南藏族自治州', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('632321', '632300', '同仁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632322', '632300', '尖扎县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632323', '632300', '泽库县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632324', '632300', '河南蒙古族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632500', '630000', '海南藏族自治州', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('632521', '632500', '共和县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632522', '632500', '同德县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632523', '632500', '贵德县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632524', '632500', '兴海县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632525', '632500', '贵南县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632600', '630000', '果洛藏族自治州', '0', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('632621', '632600', '玛沁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632622', '632600', '班玛县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632623', '632600', '甘德县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632624', '632600', '达日县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632625', '632600', '久治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632626', '632600', '玛多县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632700', '630000', '玉树藏族自治州', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('632701', '632700', '玉树市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632722', '632700', '杂多县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632723', '632700', '称多县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632724', '632700', '治多县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632725', '632700', '囊谦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632726', '632700', '曲麻莱县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632800', '630000', '海西蒙古族藏族自治州', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('632801', '632800', '格尔木市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632802', '632800', '德令哈市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632821', '632800', '乌兰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632822', '632800', '都兰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('632823', '632800', '天峻县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640000', '0', '宁夏回族自治区', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('640100', '640000', '银川市', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('640104', '640100', '兴庆区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640105', '640100', '西夏区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640106', '640100', '金凤区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640121', '640100', '永宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640122', '640100', '贺兰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640181', '640100', '灵武市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640200', '640000', '石嘴山市', '0', '0', 'S', '1', '1');
INSERT INTO `wst_areas` VALUES ('640202', '640200', '大武口区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640205', '640200', '惠农区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640221', '640200', '平罗县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640300', '640000', '吴忠市', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('640302', '640300', '利通区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640303', '640300', '红寺堡区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640323', '640300', '盐池县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640324', '640300', '同心县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640381', '640300', '青铜峡市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640400', '640000', '固原市', '0', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('640402', '640400', '原州区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640422', '640400', '西吉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640423', '640400', '隆德县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640424', '640400', '泾源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640425', '640400', '彭阳县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640500', '640000', '中卫市', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('640502', '640500', '沙坡头区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640521', '640500', '中宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('640522', '640500', '海原县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650000', '0', '新疆维吾尔自治区', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('650100', '650000', '乌鲁木齐市', '0', '0', 'W', '1', '1');
INSERT INTO `wst_areas` VALUES ('650102', '650100', '天山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650103', '650100', '沙依巴克区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650104', '650100', '新市区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650105', '650100', '水磨沟区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650106', '650100', '头屯河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650107', '650100', '达坂城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650109', '650100', '米东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650121', '650100', '乌鲁木齐县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650200', '650000', '克拉玛依市', '0', '0', 'K', '1', '1');
INSERT INTO `wst_areas` VALUES ('650202', '650200', '独山子区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650203', '650200', '克拉玛依区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650204', '650200', '白碱滩区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650205', '650200', '乌尔禾区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650400', '650000', '吐鲁番市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('650402', '650400', '高昌区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650421', '650400', '鄯善县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('650422', '650400', '托克逊县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652200', '650000', '哈密地区', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('652201', '652200', '哈密市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652222', '652200', '巴里坤哈萨克自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652223', '652200', '伊吾县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652300', '650000', '昌吉回族自治州', '0', '0', 'C', '1', '1');
INSERT INTO `wst_areas` VALUES ('652301', '652300', '昌吉市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652302', '652300', '阜康市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652323', '652300', '呼图壁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652324', '652300', '玛纳斯县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652325', '652300', '奇台县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652327', '652300', '吉木萨尔县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652328', '652300', '木垒哈萨克自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652700', '650000', '博尔塔拉蒙古自治州', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('652701', '652700', '博乐市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652702', '652700', '阿拉山口市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652722', '652700', '精河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652723', '652700', '温泉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652800', '650000', '巴音郭楞蒙古自治州', '0', '0', 'B', '1', '1');
INSERT INTO `wst_areas` VALUES ('652801', '652800', '库尔勒市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652822', '652800', '轮台县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652823', '652800', '尉犁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652824', '652800', '若羌县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652825', '652800', '且末县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652826', '652800', '焉耆回族自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652827', '652800', '和静县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652828', '652800', '和硕县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652829', '652800', '博湖县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652900', '650000', '阿克苏地区', '0', '0', 'A', '1', '1');
INSERT INTO `wst_areas` VALUES ('652901', '652900', '阿克苏市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652922', '652900', '温宿县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652923', '652900', '库车县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652924', '652900', '沙雅县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652925', '652900', '新和县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652926', '652900', '拜城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652927', '652900', '乌什县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652928', '652900', '阿瓦提县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('652929', '652900', '柯坪县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653000', '650000', '克孜勒苏柯尔克孜自治州', '0', '0', 'K', '1', '1');
INSERT INTO `wst_areas` VALUES ('653001', '653000', '阿图什市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653022', '653000', '阿克陶县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653023', '653000', '阿合奇县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653024', '653000', '乌恰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653100', '650000', '喀什地区', '0', '0', 'K', '1', '1');
INSERT INTO `wst_areas` VALUES ('653101', '653100', '喀什市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653121', '653100', '疏附县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653122', '653100', '疏勒县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653123', '653100', '英吉沙县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653124', '653100', '泽普县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653125', '653100', '莎车县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653126', '653100', '叶城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653127', '653100', '麦盖提县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653128', '653100', '岳普湖县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653129', '653100', '伽师县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653130', '653100', '巴楚县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653131', '653100', '塔什库尔干塔吉克自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653200', '650000', '和田地区', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('653201', '653200', '和田市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653221', '653200', '和田县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653222', '653200', '墨玉县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653223', '653200', '皮山县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653224', '653200', '洛浦县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653225', '653200', '策勒县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653226', '653200', '于田县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('653227', '653200', '民丰县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654000', '650000', '伊犁哈萨克自治州', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('654002', '654000', '伊宁市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654003', '654000', '奎屯市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654004', '654000', '霍尔果斯市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654005', '654000', '(新源市)', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654021', '654000', '伊宁县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654022', '654000', '察布查尔锡伯自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654023', '654000', '霍城县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654024', '654000', '巩留县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654025', '654000', '新源县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654026', '654000', '昭苏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654027', '654000', '特克斯县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654028', '654000', '尼勒克县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654200', '650000', '塔城地区', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('654201', '654200', '塔城市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654202', '654200', '乌苏市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654221', '654200', '额敏县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654223', '654200', '沙湾县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654224', '654200', '托里县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654225', '654200', '裕民县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654226', '654200', '和布克赛尔蒙古自治县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654300', '650000', '阿勒泰地区', '0', '0', 'A', '1', '1');
INSERT INTO `wst_areas` VALUES ('654301', '654300', '阿勒泰市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654321', '654300', '布尔津县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654322', '654300', '富蕴县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654323', '654300', '福海县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654324', '654300', '哈巴河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654325', '654300', '青河县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('654326', '654300', '吉木乃县', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('659000', '650000', '自治区直辖县级行政区划', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('659001', '659000', '石河子市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('659002', '659000', '阿拉尔市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('659003', '659000', '图木舒克市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('659004', '659000', '五家渠市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('659005', '659000', '北屯市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('659006', '659000', '铁门关市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('659007', '659000', '双河市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('659008', '659000', '可克达拉市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('659009', '659000', '(胡杨河市)', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710000', '0', '台湾省', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('710100', '710000', '台北市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('710101', '710100', '松山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710102', '710100', '信义区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710103', '710100', '大安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710104', '710100', '中山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710105', '710100', '中正区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710106', '710100', '大同区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710107', '710100', '万华区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710108', '710100', '文山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710109', '710100', '南港区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710110', '710100', '内湖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710111', '710100', '士林区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710112', '710100', '北投区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710200', '710000', '高雄市', '0', '0', 'G', '1', '1');
INSERT INTO `wst_areas` VALUES ('710201', '710200', '盐埕区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710202', '710200', '鼓山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710203', '710200', '左营区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710204', '710200', '楠梓区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710205', '710200', '三民区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710206', '710200', '新兴区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710207', '710200', '前金区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710208', '710200', '苓雅区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710209', '710200', '前镇区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710210', '710200', '旗津区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710211', '710200', '小港区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710212', '710200', '凤山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710213', '710200', '林园区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710214', '710200', '大寮区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710215', '710200', '大树区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710216', '710200', '大社区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710217', '710200', '仁武区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710218', '710200', '鸟松区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710219', '710200', '冈山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710220', '710200', '桥头区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710221', '710200', '燕巢区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710222', '710200', '田寮区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710223', '710200', '阿莲区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710224', '710200', '路竹区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710225', '710200', '湖内区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710226', '710200', '茄萣区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710227', '710200', '永安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710228', '710200', '弥陀区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710229', '710200', '梓官区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710230', '710200', '旗山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710231', '710200', '美浓区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710232', '710200', '六龟区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710233', '710200', '甲仙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710234', '710200', '杉林区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710235', '710200', '内门区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710236', '710200', '茂林区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710237', '710200', '桃源区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710238', '710200', '那玛夏区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710300', '710000', '基隆市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('710301', '710300', '中正区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710302', '710300', '七堵区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710303', '710300', '暖暖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710304', '710300', '仁爱区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710305', '710300', '中山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710306', '710300', '安乐区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710307', '710300', '信义区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710400', '710000', '台中市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('710401', '710400', '中区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710402', '710400', '东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710403', '710400', '南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710404', '710400', '西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710405', '710400', '北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710406', '710400', '西屯区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710407', '710400', '南屯区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710408', '710400', '北屯区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710409', '710400', '丰原区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710410', '710400', '东势区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710411', '710400', '大甲区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710412', '710400', '清水区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710413', '710400', '沙鹿区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710414', '710400', '梧栖区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710415', '710400', '后里区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710416', '710400', '神冈区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710417', '710400', '潭子区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710418', '710400', '大雅区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710419', '710400', '新社区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710420', '710400', '石冈区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710421', '710400', '外埔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710422', '710400', '大安区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710423', '710400', '乌日区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710424', '710400', '大肚区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710425', '710400', '龙井区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710426', '710400', '雾峰区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710427', '710400', '太平区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710428', '710400', '大里区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710429', '710400', '和平区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710500', '710000', '台南市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('710501', '710500', '东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710502', '710500', '南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710504', '710500', '北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710506', '710500', '安南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710507', '710500', '安平区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710508', '710500', '中西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710509', '710500', '新营区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710510', '710500', '盐水区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710511', '710500', '白河区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710512', '710500', '柳营区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710513', '710500', '后壁区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710514', '710500', '东山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710515', '710500', '麻豆区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710516', '710500', '下营区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710517', '710500', '六甲区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710518', '710500', '官田区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710519', '710500', '大内区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710520', '710500', '佳里区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710521', '710500', '学甲区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710522', '710500', '西港区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710523', '710500', '七股区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710524', '710500', '将军区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710525', '710500', '北门区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710526', '710500', '新化区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710527', '710500', '善化区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710528', '710500', '新市区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710529', '710500', '安定区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710530', '710500', '山上区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710531', '710500', '玉井区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710532', '710500', '楠西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710533', '710500', '南化区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710534', '710500', '左镇区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710535', '710500', '仁德区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710536', '710500', '归仁区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710537', '710500', '关庙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710538', '710500', '龙崎区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710539', '710500', '永康区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710600', '710000', '新竹市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('710601', '710600', '东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710602', '710600', '北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710603', '710600', '香山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710700', '710000', '嘉义市', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('710701', '710700', '东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710702', '710700', '西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710800', '710000', '新北市', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('710801', '710800', '板桥区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710802', '710800', '三重区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710803', '710800', '中和区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710804', '710800', '永和区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710805', '710800', '新庄区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710806', '710800', '新店区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710807', '710800', '树林区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710808', '710800', '莺歌区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710809', '710800', '三峡区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710810', '710800', '淡水区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710811', '710800', '汐止区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710812', '710800', '瑞芳区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710813', '710800', '土城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710814', '710800', '芦洲区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710815', '710800', '五股区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710816', '710800', '泰山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710817', '710800', '林口区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710818', '710800', '深坑区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710819', '710800', '石碇区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710820', '710800', '坪林区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710821', '710800', '三芝区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710822', '710800', '石门区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710823', '710800', '八里区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710824', '710800', '平溪区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710825', '710800', '双溪区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710826', '710800', '贡寮区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710827', '710800', '金山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710828', '710800', '万里区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710829', '710800', '乌来区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710900', '710000', '桃园市', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('710901', '710900', '桃园区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710902', '710900', '中坜区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710903', '710900', '平镇区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710904', '710900', '八德区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710905', '710900', '杨梅区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710906', '710900', '大溪区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710907', '710900', '芦竹区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710908', '710900', '大园区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710909', '710900', '龟山区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710910', '710900', '龙潭区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710911', '710900', '新屋区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710912', '710900', '观音区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('710913', '710900', '复兴区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712200', '710000', '宜兰县', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('712201', '712200', '宜兰市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712221', '712200', '罗东镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712222', '712200', '苏澳镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712223', '712200', '头城镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712224', '712200', '礁溪乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712225', '712200', '壮围乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712226', '712200', '员山乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712227', '712200', '冬山乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712228', '712200', '五结乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712229', '712200', '三星乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712230', '712200', '大同乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712231', '712200', '南澳乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712400', '710000', '新竹县', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('712401', '712400', '竹北市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712421', '712400', '竹东镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712422', '712400', '新埔镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712423', '712400', '关西镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712424', '712400', '湖口乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712425', '712400', '新丰乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712426', '712400', '芎林乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712427', '712400', '橫山乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712428', '712400', '北埔乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712429', '712400', '宝山乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712430', '712400', '峨眉乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712431', '712400', '尖石乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712432', '712400', '五峰乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712500', '710000', '苗栗县', '0', '0', 'M', '1', '1');
INSERT INTO `wst_areas` VALUES ('712501', '712500', '苗栗市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712521', '712500', '苑里镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712522', '712500', '通霄镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712523', '712500', '竹南镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712524', '712500', '头份镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712525', '712500', '后龙镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712526', '712500', '卓兰镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712527', '712500', '大湖乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712528', '712500', '公馆乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712529', '712500', '铜锣乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712530', '712500', '南庄乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712531', '712500', '头屋乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712532', '712500', '三义乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712533', '712500', '西湖乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712534', '712500', '造桥乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712535', '712500', '三湾乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712536', '712500', '狮潭乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712537', '712500', '泰安乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712700', '710000', '彰化县', '0', '0', 'Z', '1', '1');
INSERT INTO `wst_areas` VALUES ('712701', '712700', '彰化市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712721', '712700', '鹿港镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712722', '712700', '和美镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712723', '712700', '线西乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712724', '712700', '伸港乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712725', '712700', '福兴乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712726', '712700', '秀水乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712727', '712700', '花坛乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712728', '712700', '芬园乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712729', '712700', '员林镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712730', '712700', '溪湖镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712731', '712700', '田中镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712732', '712700', '大村乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712733', '712700', '埔盐乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712734', '712700', '埔心乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712735', '712700', '永靖乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712736', '712700', '社头乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712737', '712700', '二水乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712738', '712700', '北斗镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712739', '712700', '二林镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712740', '712700', '田尾乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712741', '712700', '埤头乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712742', '712700', '芳苑乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712743', '712700', '大城乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712744', '712700', '竹塘乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712745', '712700', '溪州乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712800', '710000', '南投县', '0', '0', 'N', '1', '1');
INSERT INTO `wst_areas` VALUES ('712801', '712800', '南投市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712821', '712800', '埔里镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712822', '712800', '草屯镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712823', '712800', '竹山镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712824', '712800', '集集镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712825', '712800', '名间乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712826', '712800', '鹿谷乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712827', '712800', '中寮乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712828', '712800', '鱼池乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712829', '712800', '国姓乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712830', '712800', '水里乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712831', '712800', '信义乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712832', '712800', '仁爱乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712900', '710000', '云林县', '0', '0', 'Y', '1', '1');
INSERT INTO `wst_areas` VALUES ('712901', '712900', '斗六市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712921', '712900', '斗南镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712922', '712900', '虎尾镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712923', '712900', '西螺镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712924', '712900', '土库镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712925', '712900', '北港镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712926', '712900', '古坑乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712927', '712900', '大埤乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712928', '712900', '莿桐乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712929', '712900', '林内乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712930', '712900', '二仑乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712931', '712900', '仑背乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712932', '712900', '麦寮乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712933', '712900', '东势乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712934', '712900', '褒忠乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712935', '712900', '台西乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712936', '712900', '元长乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712937', '712900', '四湖乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712938', '712900', '口湖乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('712939', '712900', '水林乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713000', '710000', '嘉义县', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('713001', '713000', '太保市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713002', '713000', '朴子市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713023', '713000', '布袋镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713024', '713000', '大林镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713025', '713000', '民雄乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713026', '713000', '溪口乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713027', '713000', '新港乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713028', '713000', '六脚乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713029', '713000', '东石乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713030', '713000', '义竹乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713031', '713000', '鹿草乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713032', '713000', '水上乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713033', '713000', '中埔乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713034', '713000', '竹崎乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713035', '713000', '梅山乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713036', '713000', '番路乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713037', '713000', '大埔乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713038', '713000', '阿里山乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713300', '710000', '屏东县', '0', '0', 'P', '1', '1');
INSERT INTO `wst_areas` VALUES ('713301', '713300', '屏东市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713321', '713300', '潮州镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713322', '713300', '东港镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713323', '713300', '恒春镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713324', '713300', '万丹乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713325', '713300', '长治乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713326', '713300', '麟洛乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713327', '713300', '九如乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713328', '713300', '里港乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713329', '713300', '盐埔乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713330', '713300', '高树乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713331', '713300', '万峦乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713332', '713300', '内埔乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713333', '713300', '竹田乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713334', '713300', '新埤乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713335', '713300', '枋寮乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713336', '713300', '新园乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713337', '713300', '崁顶乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713338', '713300', '林边乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713339', '713300', '南州乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713340', '713300', '佳冬乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713341', '713300', '琉球乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713342', '713300', '车城乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713343', '713300', '满州乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713344', '713300', '枋山乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713345', '713300', '三地门乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713346', '713300', '雾台乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713347', '713300', '玛家乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713348', '713300', '泰武乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713349', '713300', '来义乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713350', '713300', '春日乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713351', '713300', '狮子乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713352', '713300', '牡丹乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713400', '710000', '台东县', '0', '0', 'T', '1', '1');
INSERT INTO `wst_areas` VALUES ('713401', '713400', '台东市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713421', '713400', '成功镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713422', '713400', '关山镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713423', '713400', '卑南乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713424', '713400', '鹿野乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713425', '713400', '池上乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713426', '713400', '东河乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713427', '713400', '长滨乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713428', '713400', '太麻里乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713429', '713400', '大武乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713430', '713400', '绿岛乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713431', '713400', '海端乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713432', '713400', '延平乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713433', '713400', '金峰乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713434', '713400', '达仁乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713435', '713400', '兰屿乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713500', '710000', '花莲县', '0', '0', 'H', '1', '1');
INSERT INTO `wst_areas` VALUES ('713501', '713500', '花莲市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713521', '713500', '凤林镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713522', '713500', '玉里镇', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713523', '713500', '新城乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713524', '713500', '吉安乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713525', '713500', '寿丰乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713526', '713500', '光复乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713527', '713500', '丰滨乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713528', '713500', '瑞穗乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713529', '713500', '富里乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713530', '713500', '秀林乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713531', '713500', '万荣乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713532', '713500', '卓溪乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713600', '710000', '澎湖县', '0', '0', 'P', '1', '1');
INSERT INTO `wst_areas` VALUES ('713601', '713600', '马公市', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713621', '713600', '湖西乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713622', '713600', '白沙乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713623', '713600', '西屿乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713624', '713600', '望安乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('713625', '713600', '七美乡', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810000', '0', '香港特别行政区', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('810100', '810000', '香港岛', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('810101', '810100', '中西区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810102', '810100', '湾仔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810103', '810100', '东区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810104', '810100', '南区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810200', '810000', '九龙', '0', '0', 'J', '1', '1');
INSERT INTO `wst_areas` VALUES ('810201', '810200', '油尖旺区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810202', '810200', '深水埗区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810203', '810200', '九龙城区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810204', '810200', '黄大仙区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810205', '810200', '观塘区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810300', '810000', '新界', '0', '0', 'X', '1', '1');
INSERT INTO `wst_areas` VALUES ('810301', '810300', '荃湾区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810302', '810300', '屯门区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810303', '810300', '元朗区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810304', '810300', '北区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810305', '810300', '大埔区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810306', '810300', '西贡区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810307', '810300', '沙田区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810308', '810300', '葵青区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('810309', '810300', '离岛区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('820000', '0', '澳门特别行政区', '0', '0', '', '0', '1');
INSERT INTO `wst_areas` VALUES ('820100', '820000', '澳门半岛', '0', '0', 'A', '1', '1');
INSERT INTO `wst_areas` VALUES ('820101', '820100', '花地玛堂区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('820102', '820100', '圣安多尼堂区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('820103', '820100', '大堂区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('820104', '820100', '望德堂区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('820105', '820100', '风顺堂区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('820200', '820000', '氹仔岛', '0', '0', 'D', '1', '1');
INSERT INTO `wst_areas` VALUES ('820201', '820200', '嘉模堂区', '0', '0', '', '2', '1');
INSERT INTO `wst_areas` VALUES ('820300', '820000', '路环岛', '0', '0', 'L', '1', '1');
INSERT INTO `wst_areas` VALUES ('820301', '820300', '圣方济各堂区 ', '0', '0', '', '2', '1');

-- ----------------------------
-- Table structure for `wst_ads`
-- ----------------------------
DROP TABLE IF EXISTS `wst_ads`;
CREATE TABLE `wst_ads` (
  `adId` int(11) NOT NULL AUTO_INCREMENT,
  `adPositionId` int(11) DEFAULT NULL,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `adType` tinyint(4) NOT NULL DEFAULT '0',
  `adFile` varchar(150) NOT NULL,
  `adName` varchar(100) NOT NULL,
  `adURL` varchar(150) NOT NULL,
  `adStartDate` date NOT NULL,
  `adEndDate` date NOT NULL,
  `adSort` int(11) NOT NULL DEFAULT '0',
  `adClickNum` int(11) DEFAULT '0',
  PRIMARY KEY (`adId`),
  KEY `adPositionId` (`adPositionId`,`areaId1`,`areaId2`,`adStartDate`,`adEndDate`),
  KEY `adPositionId_2` (`adPositionId`,`areaId1`,`areaId2`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_ads
-- ----------------------------
INSERT INTO `wst_ads` VALUES ('11', '48', '0', '0', '0', 'Upload/ads/2015-05/554c1350baef2.png', '2f', '', '2015-05-08', '2016-09-02', '2', '0');
INSERT INTO `wst_ads` VALUES ('12', '47', '0', '0', '0', 'Upload/ads/2015-05/554c14217b5c6.png', '1f', '', '2015-05-08', '2016-11-16', '0', '0');
INSERT INTO `wst_ads` VALUES ('13', '49', '0', '0', '0', 'Upload/ads/2015-05/554c145e9e8bb.png', '3f', '', '2015-05-08', '2016-10-12', '0', '0');
INSERT INTO `wst_ads` VALUES ('14', '50', '0', '0', '0', 'Upload/ads/2015-05/554c14bd26cb0.png', '4f', '', '2015-05-08', '2016-09-08', '0', '0');
INSERT INTO `wst_ads` VALUES ('15', '51', '0', '0', '0', 'Upload/ads/2015-05/554c1501603bb.png', '5f', '', '2015-05-08', '2016-10-31', '0', '0');
INSERT INTO `wst_ads` VALUES ('16', '52', '0', '0', '0', 'Upload/ads/2015-05/554c15429d5ee.png', '6f', '', '2015-05-08', '2016-11-10', '0', '0');
INSERT INTO `wst_ads` VALUES ('17', '-1', '0', '0', '0', 'Upload/ads/2015-05/554c173b5c57e.jpg', '1', '', '2015-05-08', '2016-07-31', '1', '0');
INSERT INTO `wst_ads` VALUES ('18', '-1', '0', '0', '0', 'Upload/ads/2015-05/554c176b931e8.jpg', '2', '', '2015-05-08', '2016-07-31', '2', '0');
INSERT INTO `wst_ads` VALUES ('19', '-1', '0', '0', '0', 'Upload/ads/2015-05/554c1785e590c.jpg', '3', '', '2015-05-08', '2017-01-30', '3', '7');
INSERT INTO `wst_ads` VALUES ('20', '-1', '0', '0', '0', 'Upload/ads/2015-05/554c179b4a408.jpg', '4', '', '2015-05-08', '2017-01-04', '4', '0');
