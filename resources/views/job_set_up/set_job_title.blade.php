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
                            <router-link to="/job_title/add" class="btn btn-default pull-right">@lang('Add JobTitle')</router-link>
                            <router-link to="/" class="btn btn-default pull-right" style="margin-right:5px;">@lang('JobTitle List')</router-link>
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
                    Add Job Title
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label for="job_title">Job Title</label>
                            </div>
                            <div class="col-md-6">
                                <input  class="form-control input-sm" type="text" name="job_title" v-model="jobTitleData.job_title">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 emp_personnel_info" >
                            <div class="col-md-2">
                                <label for="department_id">Department</label>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control input-sm" name="department_id" v-model="jobTitleData.department_id">
                                    <option v-for="aDepartment in departments" :value= aDepartment.id>@{{aDepartment.department}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 emp_personnel_info">
                            <div class="col-md-2">
                                <label for="job_title_code">Code</label>
                            </div>
                            <div class="col-md-6">
                                <input  class="form-control input-sm" type="text" name="job_title_code" v-model="jobTitleData.job_title_code">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 emp_personnel_info">
                            <div class="col-md-2">
                                <label for="description">Description</label>
                            </div>
                            <div class="col-md-6">
                               <textarea class="form-control input-sm"  rows="4" cols="50" v-model="jobTitleData.description">
                                    Description
                               </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 emp_personnel_info">
                        <button class="btn btn-info" @click="jobTitleDataPost">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div> `,
            data: function (){
                return {
                    departments : {!! json_encode($department_list) !!},
                    jobTitleData: {
                        job_title : '',
                        department_id : '',
                        job_title_code : '',
                        description : ''
                    },
                    errorsBack: [],
                };
            },
            methods:
                {
                    jobTitleDataPost()
                    {
                        let _that = this;
                        axios.post('job_title_add',this.jobTitleData).then(function(response)
                        {
                            if(response.data.success==true)
                            {
                                var url = '{{ route("jobTitleList") }}';
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
                         <th>Job Title</th>
                         <th>Code</th>
                     </tr>
                     </thead>
                       <tbody>
                         <tr v-for="ajobTitle in jobTitleList">
                             <td><button @click="deleteJobTitle(ajobTitle.id)" class="btn btn-info">@lang('Delete')</button></td>
                             <td><router-link :to="{name:'editJobTitle',params:{id:ajobTitle.id}}" tag="button" class="btn btn-info">@lang('Edit')</router-link></td>
                             <td>@{{ajobTitle.job_title}}</td>
                             <td>@{{ajobTitle.job_title_code}}</td>
                         </tr>
                       </tbody>
                     </table>
                </div>
            </div>
        </div>
    </div>`,
            data: function(){
                return {
                    jobTitleList :{!! json_encode($job_title_data) !!},
                };
            },
            methods:
                {
                    deleteJobTitle(id)
                    {
                        var _that = this;
                        axios.get('job_title_delete/'+id).then(response=>{
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
                    Add Job Title
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label for="job_title">Job Title</label>
                            </div>
                            <div class="col-md-6">
                                <input  class="form-control input-sm" type="text" name="job_title" v-model="jobTitleData.job_title">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 emp_personnel_info" >
                            <div class="col-md-2">
                                <label for="department_id">Department</label>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control input-sm" name="department_id" v-model="jobTitleData.department_id">
                                    <option v-for="aDepartment in departments" :value= aDepartment.id>@{{aDepartment.department}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 emp_personnel_info">
                            <div class="col-md-2">
                                <label for="job_title_code">Code</label>
                            </div>
                            <div class="col-md-6">
                                <input  class="form-control input-sm" type="text" name="job_title_code" v-model="jobTitleData.job_title_code">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 emp_personnel_info">
                            <div class="col-md-2">
                                <label for="description">Description</label>
                            </div>
                            <div class="col-md-6">
                               <textarea class="form-control input-sm"  rows="4" cols="50" v-model="jobTitleData.description">
                                    Description
                               </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 emp_personnel_info">
                        <button class="btn btn-info" @click="editJobTitlePost">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div> `,
            data: function (){
                return {
                    departments : {!! json_encode($department_list) !!},
                    jobTitleData: {
                        job_title : '',
                        department_id : '',
                        job_title_code : '',
                        description : ''
                    },
                    id: this.$route.params.id,
                };
            },
            methods:
                {
                    editJobTitlePost() {
                        var _that = this;
                        axios.post('job_title_edit_data_post/'+this.id, this.jobTitleData).then(function (response) {

                            if(response.data.success==true)
                            {
                                var url = '{{ route("jobTitleList") }}';
                                window.location.href=url;
                            }
                        })
                    },
                    getJobTitle() {
                        var _that = this;

                        axios.get('job_title_edit_data/'+this.id).then(function (response) {
                            _that.jobTitleData = response.data;
                        })
                    }
                },

            created(){
                this.getJobTitle();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'jobTitleList'
            },
            {
                path: '/job_title/add',
                component: addComponent,
                name: 'jobTitleAdd'
            },
            {
                path: '/job_title/edit/:id',
                component: editComponent,
                name: 'editJobTitle'
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