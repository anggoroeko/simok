/*! Elastic Datatables - v0.0.1 - 2015-07-14
* https://github.com/pidupuis/elastic-datatables
* Copyright (c) 2015 pidupuis; Licensed MIT*/
(function($) {

	$.fn.dataTable.elastic_datatables = function ( opts ) {
	  // Configuration options
	  var conf = $.extend( {
		index: 'piltok',
		type: 'docs',
		client: undefined,
		body: {
					query: {
						match: {
							table: 'product'
						}
					}
				}
	  }, opts );
	  
	  return function ( sSource, aoData, fnCallback ) {
			var draw = $.grep(aoData, function( v, i ) { return v.name === 'draw'; })[0].value;
			var columns = $.grep(aoData, function( v, i ) { return v.name === 'columns'; })[0].value;
			var order = $.grep(aoData, function( v, i ) { return v.name === 'order'; })[0].value;
			var start = $.grep(aoData, function( v, i ) { return v.name === 'start'; })[0].value;
			var length = $.grep(aoData, function( v, i ) { return v.name === 'length'; })[0].value;
			var search = $.grep(aoData, function( v, i ) { return v.name === 'search'; })[0].value;
  
			conf.client.search({
				index: conf.index,
				type: conf.type
				// q: 'title:test'
			}, function (error, response) {
				var dataSet = []; console.log(response)
				response.hits.hits.forEach(function(hit) {
				var row = [];
				columns.forEach(function(col) {
					row.push(hit._source[col.name]);
				});
				dataSet.push(row);
				});
		
				fnCallback({
					'draw': draw,
					'recordsTotal': dataSet.length,
					'recordsFiltered': dataSet.length,
					'data': dataSet
				});
			});
	  };
	};
  
  }(jQuery));

  /*! Elastic Datatables - v0.0.1 - 2015-07-14
* https://github.com/pidupuis/elastic-datatables
* Copyright (c) 2015 pidupuis; Licensed MIT 
!function(a){a.fn.dataTable.elastic_datatables=function(b){var c=a.extend({index:"",type:"",client:void 0,query:""},b);return function(b,d,e){var f=a.grep(d,function(a,b){return"draw"===a.name})[0].value,g=a.grep(d,function(a,b){return"columns"===a.name})[0].value;a.grep(d,function(a,b){return"order"===a.name})[0].value,a.grep(d,function(a,b){return"start"===a.name})[0].value,a.grep(d,function(a,b){return"length"===a.name})[0].value,a.grep(d,function(a,b){return"search"===a.name})[0].value;c.client.search({index:c.index,type:c.type},function(a,b){var c=[];b.hits.hits.forEach(function(a){var b=[];g.forEach(function(c){b.push(a._source[c.name])}),c.push(b)}),e({draw:f,recordsTotal:c.length,recordsFiltered:c.length,data:c})})}}}(jQuery);
*/