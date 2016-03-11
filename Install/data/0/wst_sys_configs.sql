SET FOREIGN_KEY_CHECKS=0;

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
  `fieldValue` text,
  `fieldTips` varchar(255) DEFAULT NULL COMMENT '字段提示',
  `fieldSort` int(11) DEFAULT '0' COMMENT '字段排序',
  PRIMARY KEY (`configId`),
  KEY `parentId` (`parentId`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_sys_configs
-- ----------------------------
INSERT INTO `wst_sys_configs` VALUES ('1', '0', '商城名称', 'mallName', 'text', null, '', 'WSTMall开源商城', null, '1'),
('2', '0', '商城标题', 'mallTitle', 'text', null, null, 'WSTMall开源商城', null, '2'),
('3', '0', '商城描述', 'mallDesc', 'text', null, null, 'WSTMall开源商城,本地O2O商城,多商户,PHP多用户开源商城,O2O开源商城', null, '3'),
('4', '0', '商城关键字', 'mallKeywords', 'text', null, null, 'WSTMall开源商城,本地O2O商城,多商户,PHP多用户开源商城,O2O开源商城', '&nbsp;&nbsp;以，号分隔', '4'),
('6', '1', '验证码显示范围', 'captcha_model', 'hidden', '管理员登录||商家加盟||商家登录||新用户注册||用户登录||留言反馈', '0,1,2,3,4,5', '0,1,2,3,4,5', null, '0'),
('7', '1', '验证码个数', 'captcha_len', 'hidden', null, null, '4', null, '0'),
('8', '1', '验证码宽度', 'captcha_width', 'hidden', null, null, '85', null, '0'),
('9', '1', '验证码高度', 'captcha_height', 'hidden', null, null, '25', null, '0'),
('10', '1', '验证模式', 'captcha_show', 'hidden', '字母,数字,混合', '0,1,6', '0', null, '0'),
('13', '0', '商品是否需要审核', 'isGoodsVerify', 'radio', '是||否', '1,0', '0', null, '5'),
('14', '0', '访问统计', 'visitStatistics', 'textarea', null, null, '&lt;script language=&quot;javascript&quot; type=&quot;text/javascript&quot; src=&quot;http://js.users.51.la/18256266.js&quot;&gt;&lt;/script&gt;', null, '9'),
('15', '1', 'SMTP服务器', 'mailSmtp', 'text', null, null, 'smtp.163.com', null, '1'),
('16', '1', 'SMTP端口', 'mailPort', 'text', null, null, '25', null, '2'),
('17', '1', '是否验证SMTP', 'mailAuth', 'radio', '是||否', '1,0', '1', null, '3'),
('18', '1', 'SMTP发件人邮箱', 'mailAddress', 'text', null, null, 'xxxxx@163.com', null, '4'),
('19', '1', 'SMTP登录账号', 'mailUserName', 'text', null, null, 'username', null, '5'),
('20', '1', 'SMTP登录密码', 'mailPassword', 'text', null, null, 'password', null, '6'),
('21', '1', '发件人名称', 'mailSendTitle', 'text', null, null, 'WSTMall', null, '7'),
('22', '2', '短信账号', 'smsKey', 'text', null, null, 'WSTMall', null, '1'),
('23', '2', '短信密码', 'smsPass', 'text', null, null, 'WSTMall', null, '2'),
('24', '2', '号码每日发送数', 'smsLimit', 'text', null, null, '20', '避免恶意浪费短信的行为', '3'),
('26', '0', '授权码', 'mallLicense', 'hidden', null, null, null, null, '0'),
('27', '0', '商城Logo', 'mallLogo', 'upload', null, null, 'Apps/Home/View/default/images/logo.png', '(建议为240x132)<br/>', '6'),
('28', '0', '默认图片', 'goodsImg', 'upload', null, null, 'Apps/Home/View/default/images/item-pic.jpg', '', '7'),
('29', '0', '底部设置', 'mallFooter', 'textarea', null, null, 'CROPYRIGHT 2013-2015 广州商淘信息科技有限公司 版权所有  电话：020-29806661&lt;br/&gt;公司邮箱：wasonteam@163.com  客服QQ:707563272  粤ICP备13014375号&lt;br/&gt;我们愿与更多中小企业一起努力，一起成功 We Success together', null, '8'),
('30', '0', '联系电话', 'phoneNo', 'text', null, null, '020-29806661', null, '10'),
('31', '0', 'QQ', 'qqNo', 'text', null, null, '707563272', null, '11'),
('32', '0', '默认城市', 'defaultCity', 'other', null, null, '440100', null, '5'),
('33', '0', '热搜索词', 'hotSearchs', 'text', null, null, 'WSTMall，O2O开源商城', '以，号分隔', '12'),
('34', '2', '开启短信发送验证码', 'smsVerfy', 'radio', '是||否', '1,0', '1', '', '4'),
('36', '2', '开启手机验证', 'phoneVerfy', 'radio', '是||否', '1,0', '1', '', '5'),
('37', '0', '注册禁用关键字', 'limitAccountKeys', 'textarea', null, null, 'admin，system', null, '13');
