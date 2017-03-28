var con = require('../db_config_updated.js');
var self = module.exports = {
    selectQuery: function (table, col, where, pageindex, pagecount) {

        //colunms
        var colnm = '';
        switch (col)
        {
            case 'all' :
                colnm = '*';
                break;
            case 'count':
                colnm = 'count(id)';
                break;
            default :
            for (var prop in col) {
                if (prop == 0)
                    colnm += col[prop];
                else
                    colnm += ',' + col[prop];
            }
        }
        if (col == 'count')
            var demo = 'SELECT ' + colnm + ' as total_items FROM ' + table;
        else
            var demo = 'SELECT ' + colnm + ' FROM ' + table;

        //where
        if (where) {
            demo += ' where ' + where;
        }

        //limit
        if (pageindex != undefined)
            demo += ' limit ' + pageindex + ' , ' + pagecount;


        //console.log(demo)
        return demo;
    },
    insertQuery: function (table, col, col_value) {

        //colunms
        //console.log(col_value)
        var colnm = '';
        var colnm_value = '';
        for (var prop in col) {
            if (prop == 0)
                colnm += col[prop];
            else
                colnm += ',' + col[prop];
        }
        for (var prop in col_value) {
            if (prop == 0)
                colnm_value += "'" + col_value[prop] + "'";
            else
                colnm_value += ",'" + col_value[prop] + "'";
        }
        var demo = 'INSERT INTO ' + table + '(' + colnm + ') VALUES (' + colnm_value + ')';
        //console.log(demo)
        return demo;
    },
    updateQuery: function (table, col, col_value, where, id) {

        if (id) {
            self.updation(table, id, col, col_value)
            //console.log('asdsadf')
        }

        //colunms
        var colnm = '';
        var flag = 0;
        for (var prop in col) {
            if (col_value[prop]) {
                if (flag == 0) {
                    colnm += col[prop] + "='" + col_value[prop] + "'";
                    flag = 1;
                } else
                    colnm += ',' + col[prop] + "='" + col_value[prop] + "'";
            }
        }

        var demo = 'UPDATE ' + table + ' SET ' + colnm;

        if (where) {
            demo += ' where ' + where;
        }
        //console.log(demo)
        return demo;
    },
    insertion: function (table, pid, col, col_value) {
        var date = JSON.stringify(new Date());
        date = date.replace('"', "");
        var querystr = self.insertQuery('updates', ['table_name', 'operation', 'patient_id', 'col', 'col_value', 'touch'], [table, 'insert', pid, col, col_value, date]);
        con.query(querystr, function (err, result) {
            if (err) {
                console.log({success: false, result: err});
                return
            } else {
                console.log({success: true, result: result});
                return
            }
        });
        ;
    },
    updation: function (table, pid, col, col_value) {
        var date = JSON.stringify(new Date());
        date = date.replace('"', "");
        var querystr = self.insertQuery('updates', ['table_name', 'operation', 'patient_id', 'col', 'col_value', 'touch'], [table, 'update', pid, col, col_value, date]);
        con.query(querystr, function (err, result) {
            if (err) {
                console.log({success: false, result: err});
                return
            } else {
                console.log({success: true, result: result});
                return
            }
        });
    }
}