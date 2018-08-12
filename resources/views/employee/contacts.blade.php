@extends('layouts.master')

@section('additionalCSS')
    <style>
        .emp_personnel_info{
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="row" id="app">

        <div class="container">
            <div class="col-md-3" id="sidebar-wrapper" >
                @component('employee/side_bar_component')
                @endcomponent
            </div>

            <div class="col-md-9">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">Present Address</div>

                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <label for="present_address_street_one">Street 1</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input  class="form-control input-sm" type="text" id="present_address_street_one"
                                                name="present_address_street_one" v-model="present_address_street_one">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="present_address_street_two">Street 2</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input  class="form-control input-sm" type="text" id="present_address_street_two"
                                                name="present_address_street_two" v-model="present_address_street_two">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="present_address_district">District</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" id="present_address_district" name="present_address_district"
                                               v-model="present_address_district">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="present_address_state">State</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" id="present_address_state" name="present_address_state"
                                               v-model="present_address_state">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="present_address_zip">Zip</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" id="present_address_zip" name="present_address_zip"
                                               v-model="present_address_zip">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Permanent Address
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="permanent_address_street_one">Street 1</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input  class="form-control input-sm" type="text" id="permanent_address_street_one"
                                                name="permanent_address_street_one" v-model="permanent_address_street_one">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="permanent_address_street_two">Street 2</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input  class="form-control input-sm" type="text" id="permanent_address_street_two"
                                                name="permanent_address_street_two" v-model="permanent_address_street_two">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="permanent_address_district">District</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" id="permanent_address_district" name="permanent_address_district"
                                               v-model="permanent_address_district">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="permanent_address_state">State</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" id="permanent_address_state" name="permanent_address_state"
                                               v-model="permanent_address_state">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="permanent_address_zip">Zip</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" id="permanent_address_zip" name="permanent_address_zip"
                                               v-model="permanent_address_zip">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Other Information</div>
                        <div class="panel-body">
                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="home_telephone">Home Telephone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" id="home_telephone" name="home_telephone"
                                               v-model="home_telephone">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="work_telephone">Work Telephone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" id="work_telephone" name="work_telephone"
                                               v-model="work_telephone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="mobile">Mobile</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" id="mobile" name="mobile"
                                               v-model="mobile">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="work_mail">Work Mail</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" id="work_mail" name="work_mail"
                                               v-model="work_mail">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12 emp_personnel_info">
                                    <div class="col-md-2">
                                        <label for="other_mail">Other Mail</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" id="other_mail" name="other_mail"
                                               v-model="other_mail">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <button class="btn btn-default" @click="contactInfoPost">Save</button>
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
                    //is_null($contact_data) ? $employee_id  : $contact_data->employee_id
                    employee_id : "{{is_null($contact_data) ? $employee_id  : $contact_data->employee_id}}",
                    present_address_street_one : '{{is_null($contact_data) ? '' : $contact_data->present_address_street_one}}',
                    present_address_street_two : '{{is_null($contact_data) ? '' : $contact_data->present_address_street_two}}',
                    present_address_district : '{{is_null($contact_data) ? '' : $contact_data->present_address_district}}',
                    present_address_state : '{{is_null($contact_data) ? '' : $contact_data->present_address_state}}',
                    present_address_zip : '{{ is_null($contact_data) ? '' : $contact_data->present_address_zip}}',
                    permanent_address_street_one :'{{is_null($contact_data) ? '' : $contact_data->permanent_address_street_one}}',
                    permanent_address_street_two : '{{is_null($contact_data) ? '' : $contact_data->permanent_address_street_two}}',
                    permanent_address_district : '{{is_null($contact_data) ? '' : $contact_data->permanent_address_district}}',
                    permanent_address_state : '{{is_null($contact_data) ? '' : $contact_data->permanent_address_state}}',
                    permanent_address_zip : '{{is_null($contact_data) ? '' : $contact_data->permanent_address_zip}}',
                    home_telephone : '{{is_null($contact_data) ? '' : $contact_data->home_telephone}}',
                    work_telephone : '{{is_null($contact_data) ? '' : $contact_data->work_telephone}}',
                    mobile : '{{is_null($contact_data) ? '' : $contact_data->mobile}}',
                    work_mail : '{{is_null($contact_data) ? '' : $contact_data->work_mail}}',
                    other_mail : '{{is_null($contact_data) ? '' : $contact_data->other_mail}}',

                },
                methods:
                    {
                        contactInfoPost()
                        {
                            let _that =this;
                            axios.post("{{ route("employeeContactEditPost") }}",this.$data).then(function(response)
                            {
                                if(response.data.success==true)
                                {
                                    console.log("i am in edit contacts");
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