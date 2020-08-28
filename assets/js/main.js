(function ($) {
    'use strict';
    const urls   = window.location.origin;

    $('#dataTable').DataTable();

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

        if((startdate_add < daterequest_add) || (enddate_add < daterequest_add) ){
            alert('Dari Tanggal dan Sampai Tanggal tidak boleh lebih kecil dari Tanggal Request');
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
                    console.log(respon);
                },error : function(respon){
                    console.log(respon);
                }
            })
        }else{
            alert('Gagal menyimpan data');
        }
    })

})(jQuery);