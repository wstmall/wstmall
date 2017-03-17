
function getTopSaleGoods(){
	var params = {};
		params.startDate = $("#startDate").val();
		params.endDate = $("#endDate").val();
	$.post(Think.U('Home/Reports/getTopSaleGoods'),params,function(data,textStatus){
		var json = WST.toJson(data);
		$("#wst-tbody").empty();
		var html = [];
		for(var i=0,k=json.data.length;i<k;i++){
			var goods = json.data[i];
			html.push("");
			html.push("<tr>");
				html.push("<td>"+(i+1)+"</td>");
				if(goods.goodsThums!=""){
					html.push("<td style='position:relative;' img='"+goods.goodsThums+"' class='imgPreview'>");
				}else{
					html.push("<td style='position:relative;'>");
				}
				html.push("<img class='glazyImg' data-original="+WST.ROOT+"/"+goods.goodsThums+" height='50' width='50'/>");
				html.push(  goods.goodsName );
				html.push("</td>");
				html.push("<td>"+goods.goodsSn+"</td>");
	            html.push("<td>"+goods.goodsNums+"</td>");
	        	html.push("<td>");
	               	html.push("<a href="+Think.U('Home/Goods/getGoodsDetails',{'goodsId':goods.goodsId})+" target='_blank' class='btn view' title='查看'></a>");
	        	html.push("</td>");
	    	html.push("</tr>");
		}
		$("#wst-tbody").html(html.join(""));
		$('.glazyImg').lazyload({ effect: "fadeIn",failurelimit : 10,skip_invisible : false,threshold: 200,placeholder:WST.ROOT+'/'+WST.GOODS_LOGO});
		$('.imgPreview').imagePreview();
	});
}

function statSales(){
		var style,option;
	var params = {};
		  
		params.payType = $('#payType').val();
		params.startDate = $('#startDate').val();
		params.endDate = $('#endDate').val();
	var myChart = echarts.init(document.getElementById('container')); 
		   
	$('#container').show();
	$('#mainTable').hide();
	$.post(Think.U('Home/Reports/getStatSales'),params,function(data,textStatus){
		var json = WST.toJson(data);
		myChart.clear();
		var option = {
			tooltip : { trigger: 'axis' },
			toolbox: {
				show : true,
				feature : {
					mark : {show: true},
					dataView : {show: false, readOnly: false},
					magicType : {show: true, type: ['line', 'bar']},
					restore : {show: true},
					saveAsImage : {show: true}
				}
			},
			calculable : true,
			xAxis : [{
				type : 'category',
				data : json.days
			}],
			yAxis : [{
				type : 'value'
			}],
			series : [{
				name:'销售额',
				type:'bar',
				data:json.dayVals
			}]
		};             
		myChart.setOption(option);	 
		var gettpl = document.getElementById('stat-tblist').innerHTML;
		laytpl(gettpl).render(json.list, function(html){
			$('#list-box').html(html);
			$('#mainTable').show();
		});
	});    
}

function statOrders(){
	var option;
	var params = {};
		params.startDate = $('#startDate').val();
		params.endDate = $('#endDate').val();
	var myChart = echarts.init(document.getElementById('container')); 
		   
	$('#container').show();
	$('#mainTable').hide();
	$.post(Think.U('Home/Reports/getStatOrders'),params,function(data,textStatus){
		var json = WST.toJson(data);
		myChart.clear();
		var option = {
			tooltip : { trigger: 'axis' },
			toolbox: {
				show : true,
			 	y: 'top',
			 	feature : {
			  		mark : {show: true},
			    	dataView : {show: false, readOnly: false},
			    	magicType : {show: true, type: ['line', 'bar', 'tiled']},
			   		restore : {show: true},
			      	saveAsImage : {show: true}
			 	}
			},
			calculable : true,
			legend: {
			 	data:['取消订单','退款订单','正常订单']
			},
			xAxis : [{
				type : 'category',
			 	splitLine : {show : false},
				data : json.days
			}],
			yAxis : [{
				type : 'value',
				position: 'right'
			}],
			series : [{
				name:'取消订单',
				type:'bar',
				tooltip : {trigger: 'item'},
			 	stack: '类型',
				data:json['-3']
			},
			{
				name:'退款订单',
				type:'bar',
			   	tooltip : {trigger: 'item'},
			 	stack: '类型',
			 	data:json['-1']
			},
			{
				name:'正常订单',
			  	type:'bar',
			 	tooltip : {trigger: 'item'},
				stack: '类型',
			 	data:json['1']
			},
			{
				name:'订单总数',
			  	type:'line',
				data:json.total
			},
			{
				name:'订单类型细分',
			  	type:'pie',
				tooltip : {
			     	trigger: 'item',
			     	formatter: '{a} <br/>{b} : {c} ({d}%)'
			  	},
				center: [160,130],
				radius : [0, 50],
				itemStyle :　{
			 		normal : {
			      		labelLine : {
			         		length : 20
			       		}
			 		}
				},
			 	data:[
			 		{value:json.map['-3'], name:'取消订单'},
			   		{value:json.map['-1'], name:'退款订单'},
			    	{value:json.map['1'], name:'正常订单'},
				]
			}]
		};            
		myChart.setOption(option);	 
		var gettpl = document.getElementById('stat-tblist').innerHTML;
		laytpl(gettpl).render(json.list, function(html){
			$('#list-box').html(html);
			$('#mainTable').show();
		});
	});    
}