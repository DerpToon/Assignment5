
@extends('layout')
@section('title', 'Students')
@section('content')
<h2>Students</h2>
<!-- TODO: Add search bar here -->
<table class="table mt-3">
    <label for="search">Search for students</label> <br>
    <input type="search" name="search" id="search"></input>
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
        function fetch(val){
            $.ajax({
                type: "get",
                url: '{{ route ('students.index') }}',
                data: {search: val},
                success: function(data){
                    console.log(data)
                    $('#student-table').html(data);
                }
            })
        }
        $('#search').on('keyup',function(){
            var val = $(this).val();
            fetch(val)
        })

        fetch();
    })
</script>
@endsection

