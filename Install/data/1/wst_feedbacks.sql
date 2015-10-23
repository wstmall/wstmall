SET FOREIGN_KEY_CHECKS=0;

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
