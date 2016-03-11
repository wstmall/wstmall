/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : wstmall

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-09-03 12:45:48
*/

SET FOREIGN_KEY_CHECKS=0;

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
  `attrPrice` decimal(11,2) DEFAULT '0.00',
  `attrStock` int(11) DEFAULT '0',
  `isRecomm` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shopId` (`shopId`),
  KEY `goodsId` (`goodsId`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_attributes
-- ----------------------------
