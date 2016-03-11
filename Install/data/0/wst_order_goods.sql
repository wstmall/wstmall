/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : wstmall

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-09-03 12:46:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_order_goods`
-- ----------------------------
DROP TABLE IF EXISTS `wst_order_goods`;
CREATE TABLE `wst_order_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `goodsId` int(11) NOT NULL,
  `goodsNums` int(11) NOT NULL DEFAULT '0',
  `goodsPrice` decimal(11,2) NOT NULL DEFAULT '0.00',
  `goodsAttrId` int(11) DEFAULT '0',
  `goodsAttrName` varchar(255) DEFAULT '',
  `goodsName` varchar(50) DEFAULT NULL,
  `goodsThums` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goodsId` (`goodsId`),
  KEY `orderId` (`orderId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_order_goods
-- ----------------------------
