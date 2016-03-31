update wst_payments set payCode='weixin' where payCode='Weixin';
alter table wst_orders add payFrom int DEFAULT 0;