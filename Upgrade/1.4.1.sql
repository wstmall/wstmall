alter table wst_log_sms add smsIP varchar(20);
alter table wst_goods_appraises add goodsAttrId int default 0;
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,valueRangeTxt,valueRange,fieldValue,fieldTips,fieldSort) VALUES ('2', '开启短信发送验证码', 'smsVerfy', 'radio','是||否','1,0','1','',4);
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,valueRangeTxt,valueRange,fieldValue,fieldTips,fieldSort) VALUES ('2', '机构代码', 'smsOrg', 'text', null, null, '', null, '0');
