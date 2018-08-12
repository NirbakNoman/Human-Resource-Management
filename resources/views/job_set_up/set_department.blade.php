@extends('layouts.master')

@section('additionalCSS')
    <style>
        .emp_personnel_info{
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="box box-primary">
            <div class = "row">
                <div class="col-md-12" id="app">
                    <div class="container">
                        <div class="col-md-10">
                            <router-link to="/education/add" class="btn btn-default pull-right">@lang('Add Department')</router-link>
                            <router-link to="/" class="btn btn-default pull-right" style="margin-right:5px;">@lang('Department List')</router-link>
                        </div>
                    </div>
                    <br>

                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('additionalJS')
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script>
        const addComponent = {
            template: `
     <div class="container">
        <div class="col-md-10">
         <div class="form-group alert alert-danger" v-if="errorsBack!='' && errorsBack!=undefined" style="padding-top: 20px">
                <ul>
                    <li v-for="error in errorsBack">@{{ error }}</li>
                </ul>
         </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Department
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label for="department">Department</label>
                            </div>
                            <div class="col-md-6">
                                <input  class="form-control input-sm" type="text" name="department" v-model="departmentData.department">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 emp_personnel_info">
                        <button class="btn btn-info" @click="departmentDataPost">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div> `,
            data: function (){
                return {

                    departmentData: {
                        department: ''
                    },
                    errorsBack: [],
                };
            },
            methods:
                {
                    departmentDataPost()
                    {
                        let _that = this;

                        axios.post('department_add',this.departmentData).then(function(response)
                        {
                            if(response.data.success==true)
                            {
                                var url = '{{ route("departmentList") }}';
                                window.location.href=url;
                            }
                            if(response.data.success==false)
                            {
                                _that.errorsBack = response.data.message;
                            }
                        })
                    },
                }
        }

        var listComponent = {
            template:
                `
   <div class="container">
     <div class="col-md-10">
         <div class="panel panel-default">
             <div class="panel-heading">
                 Department List
             </div>
             <div class="panel-body">
                 <table class="table table-hover table-striped">
                     <thead>
                     <tr>
                         <th>Delete</th>
                         <th>Edit</th>
                         <th>Department</th>
                     </tr>
                     </thead>
                       <tbody>
                         <tr v-for="aDepartment in departments">
                             <td><button @click="deleteDepartment(aDepartment.id)" class="btn btn-info">@lang('Delete')</button></td>
                             <td><router-link :to="{name:'editDepartment',params:{id:aDepartment.id}}" tag="button" class="btn btn-info">@lang('Edit')</router-link></td>
                             <td>@{{aDepartment.department}}</td>
                         </tr>
                       </tbody>
                     </table>
                </div>
            </div>
        </div>
    </div>`,
            data: function(){
                return {
            departments :{!! json_encode($department_data) !!},
                };
            },
            methods:
                {
                    deleteDepartment(id)
                    {
                        var _that = this;
                        axios.get('department_delete/'+id).then(response=>{
                            _that.$router.go();
                        })
                    },

                },
        }

        var editComponent={
            template:`
        <div class="container">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Department
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label for="department">Department</label>
                            </div>
                            <div class="col-md-6">
                                <input  class="form-control input-sm" type="text" name="department" v-model="departmentData.department">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 emp_personnel_info">
                        <button class="btn btn-info" @click="editDepartmentPost">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div> `,
            data: function (){
                return {
                    departmentData: {
                        department: ''
                    },
                    id: this.$route.params.id,
                };
            },
            methods:
                {
                    editDepartmentPost() {
                        var _that = this;
                        axios.post('department_edit_data_post/'+this.id, this.departmentData).then(function (response) {

                            if(response.data.success==true)
                            {
                                var url = '{{ route("departmentList") }}';
                                window.location.href=url;
                            }
                        })
                    },
                    getDepartment() {
                        var _that = this;

                        axios.get('department_edit_data/'+this.id).then(function (response) {
                            _that.departmentData = response.data;
                        })
                    }
                },

            created(){
                this.getDepartment();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'departmentList'
            },
            {
                path: '/education/add',
                component: addComponent,
                name: 'departmentAdd'
            },
            {
                path: '/education/edit/:id',
                component: editComponent,
                name: 'editDepartment'
            }
        ]


        const router = new VueRouter({
            routes // short for `routes: routes`
        })

        const app = new Vue({
            router
        }).$mount('#app')
    </script>
@endsection