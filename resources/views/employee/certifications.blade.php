@extends('layouts.master')

@section('additionalCSS')
    <style>
        .emp_personnel_info{
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')

{{--    <div class="container">
        <div class="box box-primary">
            <div class = "row">
                <div class="col-md-12" id="app">
                    <router-link to="/" class="btn btn-info col-md-offset-3">@lang('Certification List')</router-link>

                    <router-link to="/employee_certification/add" class="btn btn-primary col-md-offset-1">@lang('Add Certification')</router-link>

                    <br>
                    <br>

                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>--}}



    <div class="container">
        <div id="app">

            <div class="col-md-12">
                <div class="col-md-3" id="sidebar-wrapper" >
                    @component('employee/side_bar_component')
                    @endcomponent
                </div>
                <div class="col-md-9">
                    <router-view></router-view>

                    <router-link to="/" class="btn btn-default">@lang('Certification List')</router-link>
                    <router-link to="/employee_certification/add" class="btn btn-default " style="margin-right:5px;">@lang('Add Certification')</router-link>

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
        const addComponent = {
            template: `


         <div class="panel panel-default">
             <div class="panel-heading">
                Certification Add
             </div>

             <div class="panel-body">

                 <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="dependent_name">Certification</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="name" name="certification" v-model="certificationData.certification">
                    </div>
                </div>
            </div>

            <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="relationship">Institute</label>
                    </div>
                    <div class="col-md-6">
                      <input  class="form-control input-sm" type="text" id="institute" name="institute" v-model="certificationData.institute">
                    </div>
                </div>
            </div>

            <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="dependent_date_of_birth">Granted On</label>
                    </div>
                    <div class="col-md-6">
                        <vuejs-datepicker v-model="certificationData.granted_on" name="granted_on" format="yyyy-MM-dd"></vuejs-datepicker>
                    </div>
                </div>
            </div>

             <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="dependent_date_of_birth">Valid Till</label>
                    </div>
                    <div class="col-md-6">
                        <vuejs-datepicker v-model="certificationData.valid_till" name="valid_till" format="yyyy-MM-dd"></vuejs-datepicker>
                    </div>
                </div>
            </div>

            <div class="col-md-4 emp_personnel_info">
                <button class="btn btn-info" @click="certificationPost">Save</button>
            </div>
             </div>

         </div>


  `,
            data: function (){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    certificationData: {
                        certification: '',
                        institute: '',
                        granted_on:'',
                        valid_till: '',
                    },
                };
            },
            methods:
                {
                    certificationPost()
                    {
                        let _that = this;
                        var employeeId = _that.employee_id;
                        var url = '{{ route("employeeCertificationAddPost", ":id") }}';
                        url = url.replace(':id', _that.employee_id);

                        axios.post(url,this.certificationData).then(function(response)
                        {
                            if(response.data.success==true)
                            {
                                //router.push({ name: 'employeeCertificationList'});

                                var url = '{{ route("employeeCertification", ":id") }}';
                                url = url.replace(':id',employeeId);
                                window.location.href=url;

                            }
                        })
                    },

                },
            components: {
                vuejsDatepicker,
            }
        }

        var listComponent = {
            template: `
              <div class="panel panel-default">
             <div class="panel-heading">
                 Certification List
             </div>

             <div class="panel-body">
                 <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Certification Name</th>
                                <th>Institute</th>
                                <th>Granted On</th>
                                <th>Valid Till</th>
                            </tr>
                        </thead>

                       <tbody>
                            <tr v-for="aCertification in all_certifications">
                                <td><button @click="deleteCertification(aCertification.id)" class="btn btn-info">@lang('Delete')</button></td>
                                <td><router-link :to="{name:'editEmployeeCertification',params:{id:aCertification.id}}" tag="button" class="btn btn-primary">@lang('Edit')</router-link></td>
                                <td>@{{aCertification.certification}}</td>
                                <td>@{{aCertification.institute}}</td>
                                <td>@{{aCertification.granted_on}}</td>
                                <td>@{{aCertification.valid_till}}</td>
                            </tr>
                        </tbody>
                    </table>

             </div>

         </div>
	`,
            data: function(){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    all_certifications :{!! json_encode($certification_data) !!},
                };
            },
            methods:
                {
                    deleteCertification(id)
                    {
                        var _that = this;
                        var certification_id = id;
                        var url = '{{ route("employeeCertificationDelete", ":id") }}';
                        url = url.replace(':id', certification_id);

                        axios.get(url).then(response=>{
                            _that.$router.go();
                            //console.log(response);
                        })
                    },

                },
            created(){
                console.log(this.all_certifications);
            }
        }

        var editComponent={
            template:`

         <div class="panel panel-default">
             <div class="panel-heading">
                 Edit Certification
             </div>

             <div class="panel-body">
                  <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="dependent_name">Certification</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="name" name="certification" v-model="certificationData.certification">
                    </div>
                </div>
            </div>

            <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="relationship">Institute</label>
                    </div>
                    <div class="col-md-6">
                      <input  class="form-control input-sm" type="text" id="institute" name="institute" v-model="certificationData.institute">
                    </div>
                </div>
            </div>

            <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="dependent_date_of_birth">Granted On</label>
                    </div>
                    <div class="col-md-6">
                        <vuejs-datepicker v-model="certificationData.granted_on" name="granted_on" format="yyyy-MM-dd"></vuejs-datepicker>
                    </div>
                </div>
            </div>

             <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="dependent_date_of_birth">Valid Till</label>
                    </div>
                    <div class="col-md-6">
                        <vuejs-datepicker v-model="certificationData.valid_till" name="valid_till" format="yyyy-MM-dd"></vuejs-datepicker>
                    </div>
                </div>
            </div>

            <div class="col-md-4 emp_personnel_info">
                <button class="btn btn-info" @click="editCertificationPost">Save</button>
            </div>


             </div>

         </div>
    `,

            data: function (){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    certificationData: {
                        employee_id: 0,
                        certification: '',
                        institute: '',
                        granted_on:'',
                        valid_till: '',
                    },
                    id: this.$route.params.id,
                };
            },
            methods:
                {
                    editCertificationPost() {
                        var _that = this;
                        var employeeId = _that.employee_id;
                        var url = '{{ route("employeeCertificationEditPost", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.post(url, this.certificationData).then(function (response) {
                            console.log(response);


                            if(response.data.success==true)
                            {
                                //router.push({ name: 'employeeCertificationList'});

                                var url = '{{ route("employeeCertification", ":id") }}';
                                url = url.replace(':id',employeeId);
                                window.location.href=url;

                            }
                        })
                    },
                    getCertificationData() {
                        var _that = this;
                        var url = '{{ route("employeeCertificationData", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.get(url).then(function (response) {
                            _that.certificationData = response.data;
                            console.log(_that.certificationData)
                        })
                    },


                },
            components: {
                vuejsDatepicker,
            },

            created(){
                this.getCertificationData();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'employeeCertificationList'
            },
            {
                path: '/employee_certification/add',
                component: addComponent,
                name: 'employeeCertificationAdd'
            },
            {
                path: '/employee_certification/edit/:id',
                component: editComponent,
                name: 'editEmployeeCertification'
            }
        ]


        const router = new VueRouter({
            routes // short for `routes: routes`
        })

        const app = new Vue({
            data: function (){
                return{
                    employee_id :{!! json_encode($employee_id) !!},
                }
            },
            methods:
                {
                    editData(routeName, id) {
                        var url = '{{ \Illuminate\Support\Facades\URL::to('/') }}';
                        url+= ('/'+routeName+'/'+ id);
                        console.log(url);
                        window.location.href=url;
                    }
                },
            router,

        }).$mount('#app')
    </script>
@endsection