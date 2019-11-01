$(document).ready( function () {
    $('#myTable').DataTable({
    	dom: 'Bfrtip',
        buttons: [
            {
                extend:'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                    format: {
                        body: function(data, row, column, node){
                            return column === 7 ? 
                            data.replace( /^\s[<*!*-*\w*\s*\/*>*\-*\=*\"*\'*\#*\?*\$*\(*\)*\;*é*&*\[*\,*\]*\:*\{*\}*]{1,}/mgi, '') : 
                            data;
                        }
                    }                    
                },
                autoFilter: true
            }
        ]
    });
    $('#myCategorieTable').DataTable();
} );




