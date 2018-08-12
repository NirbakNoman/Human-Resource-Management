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

                    <router-link to="/" class="btn btn-info col-md-offset-3">@lang('Work Experience List')</router-link>
                    <router-link to="/work_experience/add" class="btn btn-default pull-right" style="margin-right:5px;">@lang('Add Work Experience')</router-link>
                    <br>
                    <br>

                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>--}}

    <div id="app">
        <div class="container">
            <div class="col-md-3" id="sidebar-wrapper" >
                @component('employee/side_bar_component')
                @endcomponent
            </div>
            <div class="col-md-9">

                <router-view></router-view>

                <router-link to="/" class="btn btn-default">@lang('Work Experience List')</router-link>
                <router-link to="/work_experience/add" class="btn btn-default" >@lang('Add Work Experience')</router-link>

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
                 Add Experience
             </div>

             <div class="panel-body">
                 <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="worked_company_name">Company</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="worked_company_name" v-model="workExperienceData.worked_company_name">
                    </div>
                </div>
            </div>

            <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="worked_job_title">Job Title</label>
                    </div>
                    <div class="col-md-6">
                       <input  class="form-control input-sm" type="text" id="worked_job_title"  v-model="workExperienceData.worked_job_title">
                    </div>
                </div>
            </div>

              <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="worked_from">From</label>
                    </div>
                    <div class="col-md-6">
                        <vuejs-datepicker v-model="workExperienceData.worked_from" name="worked_from" format="yyyy-MM-dd"></vuejs-datepicker>
                    </div>
                </div>
            </div>

            <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="worked_to">To</label>
                    </div>
                    <div class="col-md-6">
                        <vuejs-datepicker v-model="workExperienceData.worked_to" name="worked_to" format="yyyy-MM-dd"></vuejs-datepicker>
                    </div>
                </div>
            </div>

             <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="comments">Comment</label>
                    </div>
                    <div class="col-md-6">
                        <textarea class="form-control" name="comments" rows="5" v-model="workExperienceData.comments" ></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-4 emp_personnel_info">
                <button class="btn btn-info" @click="workExperiencePost">Save</button>
            </div>

             </div>

         </div>


 `,
            data: function (){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    workExperienceData: {
                        worked_company_name: '',
                        worked_job_title: '',
                        worked_from: '',
                        worked_to:'',
                        comments: ''
                    },
                };
            },
            methods:
                {
                    workExperiencePost()
                    {
                        let _that = this;
                        var employeeId = _that.employee_id;
                        var url = '{{ route("workExperienceAddPost", ":id") }}';
                        url = url.replace(':id', _that.employee_id);

                        axios.post(url,this.workExperienceData).then(function(response)
                        {
                            if(response.data.success==true)
                            {
                                //router.push({ name: 'workExperienceList'});

                                var url = '{{ route("workExperience", ":id") }}';
                                url = url.replace(':id',employeeId);
                                window.location.href=url;
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
            }
        }

        var listComponent = {
            template: `

         <div class="panel panel-default">
             <div class="panel-heading">
                 Experience List
             </div>

             <div class="panel-body">
                 <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Company Name</th>
                                <th>Job Title</th>
                                <th>Worked From</th>
                                <th>Worked to</th>
                            </tr>
                        </thead>

                       <tbody>
                            <tr v-for="aWorkExperience in all_work_experiences">
                                <td><button @click="deleteWorkExperience(aWorkExperience.id)" class="btn btn-info">@lang('Delete')</button></td>
                                <td><router-link :to="{name:'editWorkExperience',params:{id:aWorkExperience.id}}" tag="button" class="btn btn-primary">@lang('Edit')</router-link></td>
                                <td>@{{aWorkExperience.worked_company_name}}</td>
                                <td>@{{aWorkExperience.worked_job_title}}</td>
                                <td>@{{aWorkExperience.worked_from}}</td>
                                <td>@{{aWorkExperience.worked_to}}</td>
                            </tr>
                        </tbody>
                    </table>

             </div>

         </div>

 `,
            data: function(){
                return {

                    employee_id :{!! json_encode($employee_id) !!},
                    all_work_experiences :{!! json_encode($work_experience_data) !!},
                };
            },
            methods:
                {
                    deleteWorkExperience(id)
                    {
                        var _that = this;
                        var contact_id = id;
                        var url = '{{ route("workExperienceDelete", ":id") }}';
                        url = url.replace(':id', contact_id);

                        axios.get(url).then(response=>{
                            _that.$router.go();
                            //console.log(response);
                        })
                    },

                    editData(routeName, id) {
                        var url = '{{ \Illuminate\Support\Facades\URL::to('/') }}';
                        url+= ('/'+routeName+'/'+ id);
                        console.log(url);
                        window.location.href=url;
                    }
                },
            created(){
                console.log(this.all_dependents);
            }
        }

        var editComponent={
            template:`


         <div class="panel panel-default">
             <div class="panel-heading">
                 Edit Experience
             </div>

             <div class="panel-body">
               <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label for="worked_company_name">Company</label>
                        </div>
                        <div class="col-md-6">
                            <input  class="form-control input-sm" type="text" id="worked_company_name" v-model="workExperienceData.worked_company_name">
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="worked_job_title">Job Title</label>
                        </div>
                        <div class="col-md-6">
                           <input  class="form-control input-sm" type="text" id="worked_job_title"  v-model="workExperienceData.worked_job_title">
                        </div>
                    </div>
                </div>

                  <div class="form-group" >
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="worked_from">From</label>
                        </div>
                        <div class="col-md-6">
                            <vuejs-datepicker v-model="workExperienceData.worked_from" name="worked_from" format="yyyy-MM-dd"></vuejs-datepicker>
                        </div>
                    </div>
                </div>

                <div class="form-group" >
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="worked_to">To</label>
                        </div>
                        <div class="col-md-6">
                            <vuejs-datepicker v-model="workExperienceData.worked_to" name="worked_to" format="yyyy-MM-dd"></vuejs-datepicker>
                        </div>
                    </div>
                </div>

                 <div class="form-group" >
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="comments">Comment</label>
                        </div>
                        <div class="col-md-6">
                            <textarea class="form-control" name="comments" rows="5" v-model="workExperienceData.comments" ></textarea>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 emp_personnel_info">
                    <button class="btn btn-info" @click="editWorkExperiencePost">Save</button>
                </div>

             </div>

         </div>


 `,

            data: function (){
                return {
                    employee_id :{!! json_encode($employee_id) !!},

                    workExperienceData: {
                        employee_id: 0,
                        worked_company_name: '',
                        worked_job_title: '',
                        worked_from: '',
                        worked_to:'',
                        comments: ''
                    },
                    id: this.$route.params.id,
                };
            },
            methods:
                {
                    editWorkExperiencePost() {
                        var _that = this;
                        var employeeId = _that.employee_id;
                        var url = '{{ route("workExperienceEditPost", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.post(url, this.workExperienceData).then(function (response) {
                            console.log(response);

                            if(response.data.success==true)
                            {
                                //router.push({ name: 'workExperienceList'});
                                var url = '{{ route("workExperience", ":id") }}';
                                url = url.replace(':id',employeeId);
                                window.location.href=url;

                            }

                        })
                    },
                    getWorkExperienceData() {
                        var _that = this;
                        var url = '{{ route("workExperienceData", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.get(url).then(function (response) {
                            _that.workExperienceData = response.data;
                            console.log(_that.workExperienceData)
                        })
                    },

                },
            components: {
                vuejsDatepicker,
            },

            created(){
                this.getWorkExperienceData();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'workExperienceList'
            },
            {
                path: '/work_experience/add',
                component: addComponent,
                name: 'workExperienceAdd'
            },
            {
                path: '/work_experience/edit/:id',
                component: editComponent,
                name: 'editWorkExperience'
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