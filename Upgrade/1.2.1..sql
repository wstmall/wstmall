update wst_payments set payCode='cod' where payCode='Cod';
update wst_payments set payCode='alipay' where payCode='Alipay';
alter table wst_orders modify column needPay float(11,1) DEFAULT 0.0;
update wst_roles set `grant`=CONCAT(`grant`,',dhgl_00,dhgl_01,dhgl_02,dhgl_03,zfgl_00,zfgl_01,zfgl_02,zfgl_03') where roleId=3;