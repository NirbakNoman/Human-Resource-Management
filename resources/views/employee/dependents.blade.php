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

            <router-link to="/" class="btn btn-default ">@lang('Dependent List')</router-link>
            <router-link to="/employee_dependent/add" class="btn btn-default">@lang('Add Dependent')</router-link>
            <br>
            <br>

            <router-view></router-view>

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
                 Add Dependent
             </div>

             <div class="panel-body">
                 <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="dependent_name">Dependent Name</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="dependent_name" name="dependent_name" v-model="dependentData.dependent_name">
                    </div>
                </div>
            </div>

            <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="relationship">Relationship </label>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" name="relationship_with_employee" id="relationship" v-model="dependentData.relationship_with_employee">
                            <option value="">Select One</option>
                            <option value="child">Child</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="dependent_date_of_birth">Date of Birth</label>
                    </div>
                    <div class="col-md-6">
                        <vuejs-datepicker v-model="dependentData.dependent_date_of_birth" name="dependent_date_of_birth" format="yyyy-MM-dd"></vuejs-datepicker>
                    </div>
                </div>
            </div>

            <div class="col-md-4 emp_personnel_info">
                <button class="btn btn-info" @click="dependentPost">Save</button>
            </div>

             </div>

         </div>
  `,
            data: function (){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    dependentData: {
                        dependent_name: '',
                        relationship_with_employee: '',
                        dependent_date_of_birth: '',
                    },
                };
            },
            methods:
                {
                    dependentPost()
                    {
                        let _that = this;
                        var employeeId = _that.employee_id;
                        var url = '{{ route("employeeDependentAddPost", ":id") }}';
                        url = url.replace(':id', _that.employee_id);

                        axios.post(url,this.dependentData).then(function(response)
                        {
                            console.log(response.data.success);

                            if(response.data.success==true)
                            {

                                var url = '{{ route("employeeDependent", ":id") }}';
                                url = url.replace(":id",employeeId);
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
                 Dependent List
             </div>

             <div class="panel-body">
                 <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Dependent Name</th>
                                <th>Relation</th>
                                <th>Date of Birth</th>
                            </tr>
                        </thead>

                       <tbody>
                            <tr v-for="aDependent in all_dependents">
                                <td><button @click="deleteDependent(aDependent.id)" class="btn btn-info">@lang('Delete')</button></td>
                                <td><router-link :to="{name:'editEmployeeDependent',params:{id:aDependent.id}}" tag="button" class="btn btn-primary">@lang('Edit')</router-link></td>
                                <td>@{{aDependent.dependent_name}}</td>
                                <td>@{{aDependent.relationship_with_employee}}</td>
                                <td>@{{aDependent.dependent_date_of_birth}}</td>
                            </tr>
                        </tbody>
                    </table>

             </div>

         </div>`,
            data: function(){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    all_dependents :{!! json_encode($dependent_data) !!},
                };
            },
            methods:
                {
                    deleteDependent(id)
                    {
                        var _that = this;
                        var contact_id = id;
                        var url = '{{ route("employeeDependentDelete", ":id") }}';
                        url = url.replace(':id', contact_id);

                        axios.get(url).then(response=>{
                            _that.$router.go();
                            //console.log(response);
                        })
                    },

                },
            created(){
                console.log(this.all_dependents);
            }
        }

        var editComponent={
            template:`

        <div class="panel panel-default">
             <div class="panel-heading">
                 Edit Employee Dependent
             </div>

             <div class="panel-body">
                 <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label for="dependent_name">Dependent Name</label>
                        </div>
                        <div class="col-md-6">
                            <input  class="form-control input-sm" type="text" id="dependent_name" name="dependent_name" v-model="dependentData.dependent_name">
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="relationship">Relationship </label>
                        </div>

                    <div class="col-md-6">
                        <select class ="form-control" name = "relationship_with_employee" id = "relationship" v-model="dependentData.relationship_with_employee">
                            <option value="">Select One</option>
                            <option value="child">Child</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                  </div>
                </div>

                <div class="form-group" >
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2"><label for="dependent_date_of_birth">Date of Birth</label></div>
                        <div class="col-md-6">
                            <vuejs-datepicker v-model="dependentData.dependent_date_of_birth" name="dependent_date_of_birth" format="yyyy-MM-dd"></vuejs-datepicker>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 emp_personnel_info">
                    <button class="btn btn-info" @click="editDependentPost">Save</button>
                </div>

             </div>

         </div>

  `,

            data: function (){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    dependentData: {
                        employee_id: 0,
                        dependent_name: '',
                        relationship_with_employee: '',
                        dependent_date_of_birth: '',
                    },
                    id: this.$route.params.id,
                };
            },
            methods:
                {
                    editDependentPost() {
                        var _that = this;
                        var employeeId = _that.employee_id;
                        var url = '{{ route("employeeDependentEditPost", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.post(url, this.dependentData).then(function (response) {
                            console.log(response.data.success);

                            if(response.data.success==true)
                            {
                                //router.push({ name: 'employeeDependentList'});


                              var url = '{{ route("employeeDependent", ":id") }}';
                              url = url.replace(':id',employeeId);
                              window.location.href=url;

                            }

                        })
                    },
                    getDependentData() {
                        var _that = this;
                        var url = '{{ route("employeeDependentData", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.get(url).then(function (response) {
                            _that.dependentData = response.data;
                            console.log(_that.dependentData)
                        })
                    },

                },
            components: {
                vuejsDatepicker,
            },

            created(){
                this.getDependentData();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'employeeDependentList'
            },
            {
                path: '/employee_dependent/add',
                component: addComponent,
                name: 'employeeDependentAdd'
            },
            {
                path: '/employee_dependent/edit/:id',
                component: editComponent,
                name: 'editEmployeeDependent'
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