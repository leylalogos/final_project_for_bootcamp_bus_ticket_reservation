<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        
        table{
            background-color:rgb(45, 175, 95);border: 1px solid black;
        }
        td,th{
            border: 1px solid blue;
        }
    </style>
</head>
<body>
    <table >
        <tr>
            <th>Name</th>
            <th>price</th>
            <th>passenger_count</th>
            <th>origin</th>
            <th>destination</th>
            <th>departure_time</th>
            <th>company_name</th>
        </tr>
        <tr>
            <td>{{ $ticket['name'] }}</td>
            <td>{{ $ticket['price'] }}</td>
            <td>{{ $ticket['passenger_count'] }}</td>
            <td>{{ $ticket['origin'] }}</td>
            <td>{{ $ticket['destination'] }}</td>
            <td>{{ $ticket['departure_time'] }}</td>
            <td>{{ $ticket['bus_company_name'] }}</td>
        </tr>
    </table>

</body>

</html>
