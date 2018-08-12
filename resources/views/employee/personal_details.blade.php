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

            <div class="col-md-3" id="sidebar-wrapper" >
                @component('employee/side_bar_component')
                @endcomponent
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Personnel Information
                    </div>

                    <div class="panel-body">

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
                                <div class="col-md-6"><input class="form-control" type="text" id="employee_code" name="employee_code" v-model="employee_code"></div>
                            </div>
                        </div>

                        <div class="form-group" >
                            <div class="col-md-12 emp_personnel_info">
                                <div class="col-md-2"><label for="national_id">National Id</label></div>
                                <div class="col-md-6"><input   class="form-control" type="text" id="national_id" name="national_id" v-model="national_id"></div>
                            </div>
                        </div>

                        <div class="form-group" >
                            <div class="col-md-12 emp_personnel_info">
                                <div class="col-md-2">
                                    <label for="date_of_birth">Date Of Birth</label>
                                </div>
                                <div class="col-md-6">
                                    <vuejs-datepicker input-class="form-control" v-model="date_of_birth" name="date_of_birth" format="yyyy-MM-dd"></vuejs-datepicker>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" >
                            <div class="col-md-12 emp_personnel_info">
                                <div class="col-md-2"><label for="gender">Gender</label></div>
                                <div class="col-md-6">
                                    <select class="form-control" name="gender" id="gender" v-model="gender">
                                        <option value="">Select One</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" >
                            <div class="col-md-12 emp_personnel_info">
                                <div class="col-md-2"><label for="marital_status">Maritial Status</label></div>

                                <div class="col-md-6">
                                    <select class="form-control" name=marital_status" id="marital_status" v-model="marital_status">
                                        <option value="">Select One</option>
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group" >
                            <div class="col-md-12 emp_personnel_info">
                                <div class="col-md-2">
                                    <label for="passport_number">Passport Number</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="passport_number" name="passport_number" v-model="passport_number">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" >
                            <div class="col-md-12 emp_personnel_info">
                                <div class="col-md-2"><label for="passport_expiry_date">Passport Expiry Date</label></div>
                                <div class="col-md-6">
                                    <vuejs-datepicker input-class="form-control" v-model="passport_expiry_date" name="passport_expiry_date" format="yyyy-MM-dd"></vuejs-datepicker>
                                </div>

                            </div>
                        </div>

                        <div class="form-group" >
                            <div class="col-md-12 emp_personnel_info">
                                <div class="col-md-2">
                                    <label for="driving_license_number">Driving License Number</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="driving_license_number" name="driving_license_number" v-model="driving_license_number">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" >
                            <div class="col-md-12 emp_personnel_info">
                                <div class="col-md-2"><label for="license_expiry_date">License Expiry Date</label></div>
                                <div class="col-md-6">
                                    <vuejs-datepicker input-class="form-control" v-model="license_expiry_date" name="license_expiry_date" format="yyyy-MM-dd"></vuejs-datepicker>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 emp_personnel_info">
                            <button class="btn btn-default" @click="personalInfoPost">Save</button>
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
              employee_id : "{{$employee_data->id}}",
              first_name: '{{$employee_data->first_name}}',
              middle_name: '{{$employee_data->middle_name}}',
              last_name: '{{$employee_data->last_name}}',
              employee_code: '{{$employee_data->employee_code}}',
              national_id: '{{$employee_data->national_id}}',
              date_of_birth:'{{$employee_data->date_of_birth}}',
              gender: '{{$employee_data->gender}}',
              marital_status: '{{$employee_data->marital_status}}',
              passport_number: '{{$employee_data->passport_number}}',
              passport_expiry_date: '{{$employee_data->passport_expiry_date}}',
              driving_license_number: '{{$employee_data->driving_license_number}}',
              license_expiry_date: '{{$employee_data->license_expiry_date}}'
          },
          methods:
              {
                  personalInfoPost()
                  {
                     let _that =this;
                     axios.post("{{ route("personalDetailPost") }}",this.$data).then(function(response)
                     {
                         if(response.data.success==true)
                         {
                             //console.log("i am in edit personal details");
                             location.reload(true);
                         }
                     })

                  },
                  editData(routeName, id) {
                      var url = '{{ \Illuminate\Support\Facades\URL::to('/') }}';
                      url+= ('/'+routeName+'/'+ id);
                      console.log(url);
                      window.location.href=url;
                  }
              },
          components: {
              vuejsDatepicker,
          },

      }
  );
    </script>
@endsection