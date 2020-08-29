(function ($) {
    'use strict';
    const urls   = window.location.origin;

    $('#dataTable').DataTable( {
            "scrollX": true,                    
            "ajax": urls+'/web-cuti/Dashboard/ajax_list_leave',
            "serverSide" : true,
            "pageLength" : 5,
            "searching": false,
            "lengthChange": false,
            "fnDrawCallback": function () {
                $('.delete_data').click(function(){
                    removes($(this).data('id'));
                }),
                $('.detail_data').click(function(){
                    details($(this).data('id'));
                }),
                $('.edit_data').click(function(){
                    edits($(this).data('id'));
                })

            }
    });

    function edits(val){
        alert(val);
    }

    function removes(val){
        alert(val);
    }

    function details(val){
        $.ajax({
            url : urls+'/web-cuti/Dashboard/detail_data',
            method: 'GET',
            data : {id : val},
            dataType : 'JSON',
            success : function(respon) {
                if(respon.status == 'success'){
                    let datas = respon.message;
                    $('#detail_date_request').html('<p>'+GetFormattedDate(datas[0].date_request)+'</p>');
                    $('#detail_requester').html('<p>'+datas[0].name+'</p>');
                    $('#detail_desc').html('<p>'+datas[0].desc+'</p>');
                    let html = '';
                    for (let i = 0; i < datas.length; i++) {
                        html += '<tr>';
                        html += '<td>'+ GetFormattedDate(datas[i].start_date) + '</td>';
                        html += '<td>'+ GetFormattedDate(datas[i].end_date) + '</td>';
                        html += '<td>'+ datas[i].type + '</td>';
                    }
                    $('#table-detail').html(html);

                    $('.list-data').hide('slow');
                    $('.detail-data').show();
                }else{
                    alert(respon.message);
                }
            },error : function(respon){
                alert('Error');
                console.log(respon);
            }
        })
    }

    $('.filter_data').submit(function(e){
        e.preventDefault();
        $('#dataTable').DataTable().destroy();
        $('#dataTable tbody').empty();
        $('#dataTable').DataTable( {
            "scrollX": true,                    
            "ajax": urls+'/web-cuti/Dashboard/ajax_list_leave?'+$(this).serialize(),
            "serverSide" : true,
            "pageLength" : 5,
            "searching": false,
            "lengthChange": false,
            "fnDrawCallback": function () {
                $('.delete_data').click(function(){
                    removes($(this).data('id'));
                }),
                $('.detail_data').click(function(){
                    details($(this).data('id'));
                }),
                $('.edit_data').click(function(){
                    edits($(this).data('id'));
                })

            }
        });
    })

    ///



    ///

    $('#add-cuti').click(function(){
        $('.list-data').hide('slow');
        $('.add-data').show();
    })

    var data_parent = [];
    $('#form-add').submit(function(e){
        e.preventDefault();
        var daterequest_add = $('[name=daterequest_add]').val(),
            requester_add = $('[name=requester_add]').val(),
            desc_add = $('[name=desc_add]').val(),
            startdate_add = $('[name=startdate_add]').val(),
            enddate_add = $('[name=enddate_add]').val(),
            jenis_add = $('[name=jenis_add]').val(),
            requester_add = $('[name=requester_add]').val();

        var data_child = {
            daterequest_add : daterequest_add,
            requester_add : requester_add,
            desc_add : desc_add,
            startdate_add : startdate_add,
            enddate_add : enddate_add,
            jenis_add :jenis_add,
            requester_add : requester_add
        };

        var checkstartDate = search('startdate_add',startdate_add, requester_add, data_parent);
        var checkendDate = search('enddate_add',enddate_add, requester_add, data_parent);

        if((startdate_add <= daterequest_add) || (enddate_add <= daterequest_add) ){
            alert('Dari Tanggal dan Sampai Tanggal tidak boleh lebih kecil sama dengan dari Tanggal Request');
        }else if(startdate_add > enddate_add){
            alert('Dari Tanggal tidak boleh lebih besar Sampai Tanggal');
        }else if(checkstartDate){
            alert(checkstartDate.requester_add + ' Dari Tanggal sudah digunakan, silahkan pilih tanggal lain');
        }else if(checkendDate){
            alert(checkstartDate.requester_add + 'Sampai Tanggal sudah digunakan, silahkan pilih tanggal lain');
        }else{
            data_parent.push(data_child);
            renderTable();
            resetFormAdd();
        }
    });

    function renderTable(){
        if(data_parent.length > 0){
            let html = '';
            for (let i = 0; i < data_parent.length; i++) {
                    html += '<tr>';
                    html += '<td>'+ GetFormattedDate(data_parent[i].startdate_add) + '</td>';
                    html += '<td>'+ GetFormattedDate(data_parent[i].enddate_add) + '</td>';
                    html += '<td>'+ data_parent[i].jenis_add + '</td>';
                    html += '<td><i class="fas fa-times del_add" data-id="'+i+'"></i></td>';
            }
            $('#table-add').html(html);
            
            $('.del_add').click(function(e){
                var id = $(this).data('id');
                if (id > -1) {
                    data_parent.splice(id, 1);
                    renderTable();
                }
            })
        }else{
            $('#table-add').empty();
        }
    }

    function resetFormAdd(){
        var priv = $('[name=priviledge]').val();
        $('[name=daterequest_add]').val('');
        $('[name=desc_add]').val('');
        $('[name=startdate_add]').val('');
        $('[name=enddate_add]').val('');
        $('[name=jenis_add]').val('');
        if(priv == 0){
            $('[name=requester_add]').val('');
        }
    }

    function GetFormattedDate(val) {
        if(val){
            const d = new Date(val)
            const ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d)
            const mo = new Intl.DateTimeFormat('en', { month: 'long' }).format(d)
            const da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d)

            return `${da}-${mo}-${ye}`;
        }
    }

    function search(nameObj, nameKey, requester, myArray){
        if(nameObj == 'startdate_add'){
            for (var i=0; i < myArray.length; i++) {
                if ((myArray[i].startdate_add === nameKey)&&(myArray[i].requester_add === requester)) {
                    return myArray[i];
                }
            }
        }else if(nameObj == 'enddate_add'){
            for (var i=0; i < myArray.length; i++) {
                if ((myArray[i].enddate_add === nameKey)&&(myArray[i].requester_add === requester)) {
                    return myArray[i];
                }
            }
        }else{

        }
    }

    $('#save-add').click(function(e){
        e.preventDefault();
        if(data_parent.length>0){
            $.ajax({
                url: urls+"/web-cuti/Dashboard/saveLeave",
                method: "POST",
                data : {data_leave : JSON.stringify(data_parent)},
                dataType:"JSON",
                success : function(respon){
                    if(respon.status == 'success'){
                        alert(respon.message);
                        location.reload();
                        return;
                    }
                    alert(respon.message);
                },error : function(respon){
                    console.log(respon);
                    alert('Gagal menyimpan data');
                }
            })
        }else{
            alert('Gagal menyimpan data');
        }
    })

})(jQuery);