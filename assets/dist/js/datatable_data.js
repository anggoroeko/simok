
$(document).ready(function () {
    //table KB
    table_kb = $('#data_table_server_kb').DataTable({
        "bProcessing": true,
        "serverSide": true,
        //"responsive" : true,
        "ajax": {
            url: "" + base_url + "datakb/getData", // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            data: function (data) { //console.log(data.filter_year)
                data.filter_year = $('#filter_year').val();
            },
            error: function (data) {
                console.log("Error Data KB " + JSON.stringify(data));
            }
        },
        "aoColumns": [{
            //"sWidth": "1%",
            "mData": 0,
            "bSortable": false,
            "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return "<b>No. KB : </b>" + data['_source']['number_of_kb'] + "<br>" +
                    "<b>SPBBJ : </b>" + data['_source']['spbbj'] + "<br>" +
                    "<b>No. RAK : </b>" + data['_source']['number_of_rack']
            }
        }, {

            //"sWidth": "1%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return moment(data['_source']['contract_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "30%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return moment(data['_source']['start_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "30%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return moment(data['_source']['end_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "16%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return "<span>" +
                    "Name : <br><b>" + data['_source']['project_name_kb'] + "</b><br>" +
                    "Duration : <br><b>" + data['_source']['other_duration'] + "<br>" +
                    "</span>"
            }
        }, {

            //"sWidth": "16%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return numeral(data['_source']['project_value']).format('0,0').replace(/\,/g, '.')
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "render": function (data) {
                return data['_source']['segment']
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "render": function (data) {
                return data['_source']['client_contract']
            }
        }, {

            "sWidth": "10%",
            "mData": null,
            "render": function (data) {
                return data['_source']['partner_name']
            }
        }, {

            "sWidth": "10%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                if (typeof data['_source']['position_file'] != "undefined") {
                    return "<center><a target=_blank href=" + base_url + "datakb/download?url=" + data['_source']['position_file'] + "><img width=70% src = " + base_url + "assets/dist/img/documents-icon.png></a></center>"
                } else {
                    return ""
                }
            }
        }, {

            //"sWidth": "15%",
            "mData": null,
            "render": function (data) {
                return moment(data['_source']['date']).format('DD-MM-YYYY HH:mm:ss')
            }

        }, {

            //"sWidth": "15%",
            "mData": null,
            "bSortable": false,
            "mRender": function (data, type, full) {

                if (status_user != 1) {
                    return '<a style="margin: 5px;" class="btn btn-info" href=' + base_url + 'datakb/preview/' + data['_id'] + ' data-toggle="tooltip" data-placement="left" title="preview">' + '<i class="fa fa-eye"></i>' + '</a>'
                } else {
                    return '<a style="margin: 5px;" class="btn btn-success" href=' + base_url + 'datakb/edit/' + data['_id'] + ' data-toggle="tooltip" data-placement="left" title="edit">' + '<i class="fa fa-pencil"></i>' + '</a>' +
                        '<a href="' + base_url + 'datakb/delete/' + data['_id'] + '" style="margin: 5px;" class="btn btn-danger" onClick="deleteDatakb(\'' + data['_id'] + '\')" data-toggle="tooltip" data-placement="left" title="delete">' + '<i class="fa fa-trash"></i>' + '</a>' +
                        '<a style="margin: 5px;" class="btn btn-info" href=' + base_url + 'datakb/preview/' + data['_id'] + ' data-toggle="tooltip" data-placement="left" title="preview">' + '<i class="fa fa-eye"></i>' + '</a>'
                }
            }
        }],
        "order": [[11, "desc"]]
    });

    /*setInterval( function () {
        table.ajax.reload();
    }, 3000 );*/

    $('#btn-filter').click(function () { //button filter event click
        table_kb.ajax.reload();  //just reload table
    });

    $('#btn-reset').click(function () { //button reset event click
        $('#form-filter')[0].reset();
        table_kb.ajax.reload();  //just reload table
    });

    //table KL
    table_kl = $('#data_table_server_kl').DataTable({
        "bProcessing": true,
        "serverSide": true,
        //"responsive" : true,
        "ajax": {
            url: "" + base_url + "datakl/getData", // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            data: function (data) { //console.log(data.filter_year)
                data.filter_year = $('#filter_year').val();
            },
            error: function (data) {
                console.log("Error Data KL " + JSON.stringify(data));
            }
        },
        "aoColumns": [{
            //"sWidth": "1%",
            "mData": 0,
            "bSortable": false,
            "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return "<b>No. KL : </b>" + data['_source']['contract_number'] + "<br>" +
                    "<b>No. KB : </b>" + data['_source']['number_of_kb'] + "<br>" +
                    "<b>No. RAK : </b>" + data['_source']['number_of_rack']
            }
        }, {

            //"sWidth": "1%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return moment(data['_source']['contract_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "30%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return moment(data['_source']['start_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "30%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return moment(data['_source']['end_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "16%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return "<span>" +
                    "Name : <br><b>" + data['_source']['project_name_kb'] + "</b><br>" +
                    "Duration : <br><b>" + data['_source']['other_duration'] + "<br>" +
                    "</span>"
            }
        }, {

            //"sWidth": "16%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return numeral(data['_source']['project_value']).format('0,0').replace(/\,/g, '.')
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "render": function (data) {
                return data['_source']['segment']
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "render": function (data) {
                return data['_source']['client_contract']
            }
        }, {

            "sWidth": "10%",
            "mData": null,
            "render": function (data) {
                return data['_source']['partner_name']
            }
        }, {

            "sWidth": "10%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                if (typeof data['_source']['position_file'] != "undefined") {
                    return "<center><a target=_blank href=" + base_url + "datakl/download?url=" + data['_source']['position_file'] + "><img width=70% src = /assets/dist/img/documents-icon.png></a></center>"
                } else {
                    return ""
                }
            }
        }, {

            //"sWidth": "15%",
            "mData": null,
            "render": function (data) {
                return moment(data['_source']['date']).format('DD-MM-YYYY HH:mm:ss')
            }

        }, {

            //"sWidth": "15%",
            "mData": null,
            "bSortable": false,
            "mRender": function (data, type, full) {
                if (status_user != 1) {
                    return '<a style="margin: 5px;" class="btn btn-info" href=' + base_url + 'datakl/preview/' + data['_id'] + ' data-toggle="tooltip" data-placement="left" title="preview">' + '<i class="fa fa-eye"></i>' + '</a>'
                } else {
                    return '<a style="margin: 5px;" class="btn btn-success" href=' + base_url + 'datakl/edit/' + data['_id'] + ' data-toggle="tooltip" data-placement="left" title="edit">' + '<i class="fa fa-pencil"></i>' + '</a>' +
                        '<a href="' + base_url + 'datakl/delete/' + data['_id'] + '" style="margin: 5px;" class="btn btn-danger" onClick="deleteDatakl(\'' + data['_id'] + '\')" data-toggle="tooltip" data-placement="left" title="delete">' + '<i class="fa fa-trash"></i>' + '</a>' +
                        '<a style="margin: 5px;" class="btn btn-info" href=' + base_url + 'datakl/preview/' + data['_id'] + ' data-toggle="tooltip" data-placement="left" title="preview">' + '<i class="fa fa-eye"></i>' + '</a>'
                }
            }
        }],
        "order": [[11, "desc"]]
    });

    $('#btn-filter').click(function () { //button filter event click
        table_kl.ajax.reload();  //just reload table
    });

    $('#btn-reset').click(function () { //button reset event click
        $('#form-filter')[0].reset();
        table_kl.ajax.reload();  //just reload table
    });


    //preview KB
    $('#data_table_server_kl_on_kb').DataTable({
        "bProcessing": true,
        "serverSide": true,
        //"responsive" : true,
        "ajax": {
            url: "" + base_url + "/datakb/getDataKlonKb/", // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            data: { "no_kb": no_kb },
            error: function (data) {
                console.log("Error Data Preview KB " + JSON.stringify(data));
            }
        },
        "aoColumns": [{
            //"sWidth": "1%",
            "mData": 0,
            "bSortable": false,
            "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return "<b>No. KB : </b>" + data['_source']['number_of_kb'] + "<br>" +
                    "<b>No. RAK : </b>" + data['_source']['number_of_rack']
            }
        }, {

            //"sWidth": "1%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return moment(data['_source']['contract_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "30%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return moment(data['_source']['start_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "30%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return moment(data['_source']['end_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "16%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return "<span>" +
                    "Name : <br><b>" + data['_source']['project_name_kb'] + "</b><br>" +
                    "Duration : <br><b>" + data['_source']['other_duration'] + "<br>" +
                    "</span>"
            }
        }, {

            //"sWidth": "16%",
            "mData": null,
            "bSortable": true,
            "render": function (data) {
                return numeral(data['_source']['project_value']).format('0,0').replace(/\,/g, '.')
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "render": function (data) {
                return data['_source']['segment']
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "render": function (data) {
                return data['_source']['client_contract']
            }
        }, {

            "sWidth": "10%",
            "mData": null,
            "render": function (data) {
                return data['_source']['partner_name']
            }
        }, {

            "sWidth": "10%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                if (typeof data['_source']['position_file'] != "undefined") {
                    return "<center><a target=_blank href=" + base_url + "datakl/download?url=" + data['_source']['position_file'] + "><img width=70% src = /assets/dist/img/documents-icon.png></a></center>"
                } else {
                    return ""
                }
            }
        }, {

            //"sWidth": "15%",
            "mData": null,
            "render": function (data) {
                return moment(data['_source']['date']).format('DD-MM-YYYY HH:mm:ss')
            }

        }, {

            //"sWidth": "15%",
            "mData": null,
            "bSortable": false,
            "mRender": function (data, type, full) {
                return '<a style="margin: 5px;" class="btn btn-success" href=' + base_url + 'datakl/edit/' + data['_id'] + ' data-toggle="tooltip" data-placement="left" title="edit">' + '<i class="fa fa-pencil"></i>' + '</a>' +
                    '<a style="margin: 5px;" class="btn btn-danger" onClick="deleteDatakl(\'' + data['_id'] + '\')" data-toggle="tooltip" data-placement="left" title="delete">' + '<i class="fa fa-trash"></i>' + '</a>' +
                    '<a style="margin: 5px;" class="btn btn-info" href=' + base_url + 'datakl/preview/' + data['_id'] + ' data-toggle="tooltip" data-placement="left" title="preview">' + '<i class="fa fa-eye"></i>' + '</a>'
            }
        }],
        "order": [[11, "desc"]]
    });

    //preview KL
    $('#data_table_server_kb_on_kl').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "searching": false,
        "lengthChange": false,
        //"responsive" : true,
        "ajax": {
            url: "" + base_url + "/datakl/getDataKbonKl/", // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            data: { "no_kb": no_kb },
            error: function (data) {
                console.log("Error Data Preview KL " + JSON.stringify(data));
            }
        },
        "aoColumns": [{
            //"sWidth": "1%",
            "mData": 0,
            "bSortable": false,
            "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return "<b>No. KB : </b>" + data['_source']['number_of_kb'] + "<br>" +
                    "<b>SPBBJ : </b>" + data['_source']['spbbj'] + "<br>" +
                    "<b>No. RAK : </b>" + data['_source']['number_of_rack']
            }
        }, {

            //"sWidth": "1%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return moment(data['_source']['contract_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "30%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return moment(data['_source']['start_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "30%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return moment(data['_source']['end_date']).format('DD-MM-YYYY')
            }
        }, {

            //"sWidth": "16%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return "<span>" +
                    "Name : <br><b>" + data['_source']['project_name_kb'] + "</b><br>" +
                    "Duration : <br><b>" + data['_source']['other_duration'] + "<br>" +
                    "</span>"
            }
        }, {

            //"sWidth": "16%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return numeral(data['_source']['project_value']).format('0,0').replace(/\,/g, '.')
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return data['_source']['segment']
            }
        }, {

            //"sWidth": "10%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return data['_source']['client_contract']
            }
        }, {

            "sWidth": "10%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return data['_source']['partner_name']
            }
        }, {

            "sWidth": "10%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                if (typeof data['_source']['position_file'] != "undefined") {
                    return "<center><a target=_blank href=" + base_url + "datakb/download?url=" + data['_source']['position_file'] + "><img width=70% src = /assets/dist/img/documents-icon.png></a></center>"
                } else {
                    return ""
                }
            }
        }, {

            //"sWidth": "15%",
            "mData": null,
            "bSortable": false,
            "render": function (data) {
                return moment(data['_source']['date']).format('DD-MM-YYYY HH:mm:ss')
            }

        }, {

            //"sWidth": "15%",
            "mData": null,
            "bSortable": false,
            "mRender": function (data, type, full) {
                return '<a style="margin: 5px;" class="btn btn-success" href=' + base_url + 'datakb/edit/' + data['_id'] + ' data-toggle="tooltip" data-placement="left" title="edit">' + '<i class="fa fa-pencil"></i>' + '</a>' +
                    '<a style="margin: 5px;" class="btn btn-danger" onClick="deleteDatakb(\'' + data['_id'] + '\')" data-toggle="tooltip" data-placement="left" title="delete">' + '<i class="fa fa-trash"></i>' + '</a>' +
                    '<a style="margin: 5px;" class="btn btn-info" href=' + base_url + 'datakb/preview/' + data['_id'] + ' data-toggle="tooltip" data-placement="left" title="preview">' + '<i class="fa fa-eye"></i>' + '</a>'
            }
        }],
        "order": [[11, "desc"]]
    });
});

//data users
$('#data_table_server_user').DataTable({
    "bProcessing": true,
    "serverSide": true,
    //"responsive" : true,
    "ajax": {
        url: "" + base_url + "users/getData", // json datasource
        type: "post",  // type of method  ,GET/POST/DELETE
        error: function (data) {
            console.log("Error Data Users " + JSON.stringify(data));
        }
    },
    "aoColumns": [{
        //"sWidth": "1%",
        "mData": 0,
        "bSortable": false,
        "render": function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    }, {

        //"sWidth": "10%",
        "mData": null,
        "bSortable": true,
        "render": function (data) {
            return data._source.first_name
        }
    }, {

        //"sWidth": "1%",
        "mData": null,
        "bSortable": true,
        "render": function (data) {
            return data._source.last_name
        }
    }, {

        //"sWidth": "30%",
        "mData": null,
        "bSortable": true,
        "render": function (data) {
            return data._source.email
        }
    }, {

        //"sWidth": "30%",
        "mData": null,
        "bSortable": true,
        "render": function (data) {
            return moment(data['_source']['date']).format('DD-MM-YYYY HH:mm:ss')
        }
    }, {

        //"sWidth": "15%",
        "mData": null,
        "bSortable": false,
        "mRender": function (data, type, full) {
            return '<a style="margin: 5px;" class="btn btn-success" href=' + base_url + 'users/edit/' + data['_id'] + ' data-toggle="tooltip" data-placement="top" title="edit">' + '<i class="fa fa-pencil"></i>' + '</a>' +
                '<a style="margin: 5px;" class="btn btn-danger" onClick="deleteUsers(\'' + data['_id'] + '\')" data-toggle="tooltip" data-placement="top" title="delete">' + '<i class="fa fa-trash"></i>' + '</a>'
        }
    }],
    "order": [[4, "desc"]]
});
