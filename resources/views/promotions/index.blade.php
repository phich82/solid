<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Promotions</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h1>Promotions List</h1>
        <p>
            <a href="/promotions/create" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New Promotion</a>
        </p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Promotion Name</th>
                    <th>Plan Start Date</th>
                    <th>Amount</th>
                    <th>Mile Type</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Delete Flag</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($items))                    
                    @foreach($items as $k => $item)
                        <tr class="rowAtive">
                            <td>{{ $k + 1}}</td>
                            <td>{{ $item['promotionName'] }}</td>
                            <td>{{ $item['planStartDate'] }}</td>
                            <td>{{ $item['amount'] }}</td>
                            <td>{{ $item['mileType'] }}</td>
                            <td>{{ $item['created_at'] }}</td>
                            <td>{{ $item['updated_at'] }}</td>
                            <td>{{ $item['deleteFlag'] }}</td>
                            <td>
                                <a href="/promotions/{{ $item['id'] }}/edit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-pencil"></i></a>
                                <span onclick="remove({{ $item['id'] }}, this)" data-token="{{ csrf_token() }}" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></span>
                            </td>
                        </tr>
                    @endforeach 
                @else
                    <tr>
                        <td colspan="9" class="text-center">There are not currently any data in system.</td>
                    </tr>
                @endif                 
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        function remove(id, objThis) {
            if (confirm('Are you sure to delete this?')) {
                var token = $(objThis).data('token');
                $.ajax({
                    url: "{{ url('/promotions') }}" + "/" + id,
                    type: 'post',
                    data: {_method: 'DELETE', _token: token},
                    success: function (result) {
                        // remove this row from table
                        $(objThis).closest('tr').remove();
                        // reordering of table
                        reordering();
                    },
                    error: function( data ) {
                        if ( data.status === 422 ) {
                            toastr.error('Cannot delete the category');
                        }
                    }
                });
                return false;                
            }
        }
        // reordering of table
        function reordering() {
            var rowsActive = document.body.querySelectorAll('table tr.rowAtive');
            if (rowsActive.length > 0) {      
                rowsActive.forEach(function (ele, index) {
                    //$(ele).find('td').first().html(index + 1);
                    $(ele).children('td:first').html(index + 1);
                });
            } else { // show message for data empty
                var msgDataEmpty = '<tr><td colspan="9" class="text-center">There are not currently any data in system.</td></tr>';
                $('table tbody').html(msgDataEmpty);
            }
        }
    </script>
</body>
</html>