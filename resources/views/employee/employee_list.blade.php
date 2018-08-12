@extends('layouts.master')
@section('content')
    <div class="container">
        <button class="btn btn-info">
            <a href="{{route('employeeAddForm')}}">Add Employee</a>
        </button>
        <br>
        <br>
    <div id="app">
        <div class="panel panel-default">
            <div class="panel-heading">
                Employee List
            </div>
            <div class="panel-body">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Delete</th>
                        <th>Edit</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="anEmployee in employees">
                        <td><button @click="deleteEmployee(anEmployee.id)" class="btn btn-danger">Delete</button></td>
                        <td><a @click="editEmployee(anEmployee.id)" href="javascript:void(0)" class="btn btn-warning">Edit</a></td>
                        <td>@{{anEmployee.id}}</td>
                        <td>@{{anEmployee.first_name}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
    </div>



@endsection

@section('additionalJS')
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
    <script src="https://unpkg.com/vuejs-datepicker"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script>
        var app = new Vue(
            {
                el: '#app',
                data: {
                    employees:{!! json_encode($employee_data) !!},
                },
                methods:
                    {
                        deleteEmployee(id)
                        {
                            axios.get('employee_delete/'+id).then(response=>{

                                if(response.data.success == true)
                                {
                                    location.reload(true);
                                }
                                //console.log(response);
                            })

                        },
                        editEmployee(id)
                        {

                            var url = '{{ route("editPersonnelInfo", ":id") }}';
                            url = url.replace(':id', id);
                            //console.log(url);
                            window.location.href=url;
                        },
                    },
                components: {
                    vuejsDatepicker,
                },

            }
        );

        //route('editPersonnelInfo/',+(anEmployee.id))
    </script>
@endsection