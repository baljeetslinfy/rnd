var express = require('express');
var router = express.Router();
var paginate = require('express-paginate');
var con = require('../db_config_updated.js');
var querygen = require('../service/QueryGen')


router.get('/:id/:date', function(req, res, next) {
	  var count=0;
	  con.query(querygen.selectQuery('updates','count','patient_id='+-1 +' and touch >='+JSON.stringify(req.params.date)+' or patient_id='+req.params.id + ' and touch >='+JSON.stringify(req.params.date)), function(err, result) {
		        if(err){
			        res.status(500).json({
						success : false,
						result : err
					});
		        } 
		        else {
					count=result;		        	
		        }
		    });
	  		var date=JSON.stringify(new Date());
	 		date=date.replace('"',"");
	  		con.query(querygen.selectQuery('updates',['table_name','operation','col','col_value'],'patient_id='+-1 +' and touch >='+JSON.stringify(req.params.date)+' or patient_id='+req.params.id + ' and touch >='+JSON.stringify(req.params.date)), function(err, result) {
		        if(err){
			      	res.status(500).json({
						success : false,
						result : err
					});
		        } 
		        else {
		        	var obj={
		        			'success':true,
		        			'total_items': count[0].total_items,
		        			'result' : result
		        			}
		            res.json(obj);
		        }
		    });
	  console.log('Connection established');
});
module.exports = router;