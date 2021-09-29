<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Ajax Test</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/9.9.0/sweetalert2.min.css' integrity='sha512-j4Hef8VNJPw4xNs4B1174dJJBrUp6C9WJAhq28qGUldwhra/6SBZgCEVuhVclNuwsNikIszbTuVOSgnkT/7TDQ==' crossorigin='anonymous'/>
</head>
<body>
  
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-dark" id="datatable"> 
                    <tbody>
                        @foreach ($infos as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->department }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <form id="form">
                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <label for="">Name:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">ID:</label>
                            <input type="text" class="form-control" name="id">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Department:</label>
                            <input type="text" class="form-control" name="department">
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-lg float-right">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js' integrity='sha512-l7jogMOI6ZWZJEY7lREjFdQum46y2+kpp/mnbJx7O+izymO9eGjL6Y4o7cEJNBdouhVHpti2Wd79Q6aIjPwxtQ==' crossorigin='anonymous'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/9.9.0/sweetalert2.min.js' integrity='sha512-hTJubsPVa/+Zgugn4NbSNWwWk5M8/APxq1XK2ZAtmr+LuHOiDhNlyKJSjTwwTWoBeFBHOHKIPB8tO2JDvqu3/A==' crossorigin='anonymous'></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#form").submit(function (e) { 
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    type: "post",
                    url: "{{ route('student-info.store') }}",
                    data: data,
                    success: function (response) {
                        console.log(response)
                       $("#form").trigger("reset");
                       $("#datatable").prepend("<tr> <td>"+response.id+"</td> <td>"+response.name+"</td> <td>"+response.department+"</td> <td>"+moment(response.created_at).format("D MMMM YYYY")+"</td> <td>"+response.updated_at+"</td> </tr>");
                        Swal.fire({
                            icon: 'success',
                            title: 'Record added',
                            text: 'Student information addedd successfully'
                        })
                    }
                });
            });
        });
    </script>
</body>
</html>
