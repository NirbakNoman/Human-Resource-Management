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

        <div class="col-md-2" id="sidebar-wrapper" >
            <img src="" height="200px" width="180px"  style="margin-left: 15px"/>
            <nav id="spy">
                <ul class="sidebar-nav nav">

                    <li>
                        <a @click="editData('edit_personal_detail_form',employee_id)" href="javascript:void(0)" data-scroll><span>Employee Personnel Details</span></a>
                    </li>

                    <li>
                        <a href="#" data-scroll><span>Contact Details</span></a>
                    </li>

                    <li>
                        <a href="#" data-scroll><span>Emergency Contacts</span></a>
                    </li>

                    <li>
                        <a href="#"><span>Dependents</span></a>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Qualifications<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-product-hunt" aria-hidden="true"></i><span> Skills </span></a></li>
                            <li><a href="#"><i class="fa fa-list" aria-hidden="true"></i><span> Education Background </span></a></li>
                            <li><a href="#"><i class="fa fa-list" aria-hidden="true"></i><span> Work Experiance </span></a></li>
                            {{-- <li><a href="{{route('userCategoryList')}}"><i class="fa fa-list" aria-hidden="true"></i><span>@lang('User Category List') </span></a></li>--}}
                        </ul>
                    </li>


                </ul>
            </nav>
        </div>


        <div class="container col-md-10">

            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="contact_name">Contact Name</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="contact_name" name="contact_name" v-model="contact_name">
                    </div>
                </div>
            </div>

            <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="contact_relation">Contact Relation</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="contact_relation" name="contact_relation" v-model="contact_relation">
                    </div>
                </div>
            </div>

            <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="contact_home_telephone">Contact Home Telephone</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" id="contact_home_telephone" name="contact_home_telephone" v-model="contact_home_telephone">
                    </div>
                </div>
            </div>

            <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="contact_mobile">Contact Mobile</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control" type="text" id="contact_mobile" name="contact_mobile" v-model="contact_mobile">
                    </div>
                </div>
            </div>

            <div class="col-md-4 emp_personnel_info">
                <button class="btn btn-info" @click="emergencyContactPost">Save</button>
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
                    employee_id : "{{is_null($contact_data) ? $employee_id  : $contact_data->employee_id}}",
                    contact_name: '{{is_null($contact_data) ? '' : $contact_data->contact_name}}',
                    contact_relation: '{{is_null($contact_data) ? '' : $contact_data->contact_relation}}',
                    contact_home_telephone: '{{is_null($contact_data) ? '' : $contact_data->contact_home_telephone}}',
                    contact_mobile: '{{is_null($contact_data) ? '' : $contact_data->contact_mobile}}',
                },
                methods:
                    {
                        emergencyContactPost()
                        {
                            let _that =this;
                            axios.post("{{ route("emergencyContactPost") }}",this.$data).then(function(response)
                            {
                                if(response.data.success==true)
                                {
                                   // console.log("i am in edit personal details");
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