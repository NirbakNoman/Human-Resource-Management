@extends('layouts.master')

@section('additionalCSS')
    <style>
        .emp_personnel_info{
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')
    <div id="app">
        <div class="container">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add A Employee
                    </div>

                    <div class="panel-body">
                        <div class="container">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-2"><label for="first_name">First Name</label></div>
                                    <div class="col-md-6"><input  class="form-control input-sm" type="text" id="first_name" name="first_name" v-model="first_name"></div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2"><label for="middle_name">Middle Name</label></div>
                                    <div class="col-md-6"><input  class="form-control input-sm" type="text" id="middle_name" name="middle_name" v-model="middle_name"></div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2"><label for="last_name">Last Name</label></div>
                                    <div class="col-md-6"><input   class="form-control" type="text" id="last_name" name="last_name" v-model="last_name"></div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2"><label for="employee_code">Employee Code</label></div>
                                    <div class="col-md-6"><input   class="form-control" type="text" id="employee_code" name="employee_code" v-model="employee_code"></div>
                                </div>
                            </div>


                            <div class="col-md-4 emp_personnel_info">
                                <button class="btn btn-default" @click.prevent="addEmployeePost">Save</button>
                            </div>

                        </div>
                    </div>

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
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    employee_code: '',
                    national_id: '',
                    date_of_birth:'',
                    gender: '',
                    marital_status: '',
                    passport_number: '',
                    passport_expiry_date: '',
                    driving_license_number: '',
                    license_expiry_date: ''
                },
                methods:
                    {
                        addEmployeePost()
                        {
                            let _that =this;
                            axios.post('employee_add_post',this.$data).then(function(response)
                            {
                                if(response.data.success==true)
                                {
                                    var url = '{{ route("employeeList") }}';

                                    //console.log(url);
                                    window.location.href=url;
                                }
                            })

                        },
                    },
                components: {
                    vuejsDatepicker,
                },

            }
        );
    </script>
@endsection