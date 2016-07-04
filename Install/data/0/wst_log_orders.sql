SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_orders
-- ----------------------------
