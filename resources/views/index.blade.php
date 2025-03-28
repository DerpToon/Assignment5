
@extends('layout')
@section('title', 'Students')
@section('content')
<h2>Students</h2>
<!-- TODO: Add search bar here -->
<table class="table mt-3">
    <label for="search">Search for students</label> <br>
    <input type="search" name="search" id="search"></input> <br> <br>
    <label for="minAge">Enter minimum and maximum age.</label> <br>
    <input type="number" name="minAge" id="min-age" class=""></input>
    <input type="number" name="maxAge" id="max-age"></input>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
    </thead>
    <tbody id="student-table">
    
    </tbody>
</table>
<!-- TODO: Add jQuery AJAX logic -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<script>
     $(document).ready(function(){
        function fetch(){
            var searchVal = $('#search').val();
            var minAge = $('#min-age').val();
            var maxAge = $('#max-age').val();

            $.ajax({
                type: "get",
                url: '{{ route('students.index') }}',
                data: {
                    search: searchVal,
                    min_age: minAge,
                    max_age: maxAge
                },
                success: function(data){
                    console.log(data);
                    $('#student-table').html(data);
                }
            });
        }

        $('#search, #min-age, #max-age').on('keyup change', function(){
            fetch();
        });

        fetch(); 
    });
</script>
@endsection

