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

                <router-view></router-view>

                <router-link to="/" class="btn btn-default">@lang('Employee Education List')</router-link>
                <router-link to="/employee_education/add" class="btn btn-default">@lang('Add Employee Education')</router-link>

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
                 Add Employee Education
             </div>

             <div class="panel-body">

              <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="education_id">Education Level</label>
                    </div>
                    <div class="col-md-6">
                      <select v-model="educationData.education_id" class="form-control">
                          <option v-for="anEducation in education_list" :value="anEducation.id">@{{anEducation.education_level}}</option>
                      </select>
                    </div>
                </div>
              </div>

            <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="institution_name">Institution</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="institution_name" name="institution_name" v-model="educationData.institution_name">
                    </div>
                </div>
            </div>

               <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="major">Major</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="major" name="major" v-model="educationData.major">
                    </div>
                </div>
            </div>


            <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="start_date">Start Date</label>
                    </div>
                    <div class="col-md-6">
                        <vuejs-datepicker v-model="educationData.start_date" name="start_date" format="yyyy-MM-dd"></vuejs-datepicker>
                    </div>
                </div>
            </div>

             <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="dependent_date_of_birth">End Date</label>
                    </div>
                    <div class="col-md-6">
                        <vuejs-datepicker v-model="educationData.end_date" name="end_date" format="yyyy-MM-dd"></vuejs-datepicker>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="result">Result</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="result" name="result" v-model="educationData.result">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-4">
                        <button class="btn btn-default" @click.prevent="educationDataPost">Save</button>
                    </div>
                </div>
            </div>
       </div>

    </div>`,
            data: function (){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    education_list : {!! json_encode($education_data) !!},
                    educationData: {
                        education_id:'',
                        institution_name: '',
                        major: '',
                        start_date: '',
                        end_date:'',
                        result:''
                    },
                };
            },
            methods:
                {
                    educationDataPost()
                    {
                        let _that = this;
                        var employeeId = _that.employee_id;
                        var url = '{{ route("employeeEducationAddPost", ":id") }}';
                        url = url.replace(':id', _that.employee_id);

                        axios.post(url,this.educationData).then(function(response)
                        {
                            console.log(response.data.success==true);

                            if(response.data.success==true)
                            {
                                //router.push({ name: 'employeeSkillList'});

                                var url = '{{ route("employeeEducation", ":id") }}';
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
                 Employee Education List
             </div>

             <div class="panel-body">
                <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Level</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Result</th>

                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="anEducation in all_education">
                                <td><button @click="deleteEducation(anEducation.id)" class="btn btn-info">@lang('Delete')</button></td>
                                <td><router-link :to="{name:'editEmployeeEducation',params:{id:anEducation.id}}" tag="button" class="btn btn-primary">@lang('Edit')</router-link></td>
                                <td>@{{anEducation.education_level}}</td>
                                <td>@{{anEducation.pivot.start_date}}</td>
                                <td>@{{anEducation.pivot.end_date}}</td>
                                <td>@{{anEducation.pivot.result}}</td>

                            </tr>
                     </tbody>

                </table>

             </div>

         </div>
   `,
            data: function(){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    all_education :{!! json_encode($employee_education_data) !!},
                };
            },
            methods:
                {
                    deleteEducation(id)
                    {
                        var _that = this;
                        var education_id = id;
                        var url = '{{ route("employeeEducationDelete", ":id") }}';
                        url = url.replace(':id', education_id);

                        axios.post(url, {employee_id: this.employee_id}).then(response=>{
                            _that.$router.go();
                            //console.log(response);
                        })
                    },

                },
            components: {
                vuejsDatepicker,
            },
            created(){
                console.log(this.all_education);
            }
        }

        var editComponent={
            template:`
           <div class="panel panel-default">
             <div class="panel-heading">
                 Add Employee Education
             </div>

             <div class="panel-body">

              <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="education_id">Education Level</label>
                    </div>
                    <div class="col-md-6">
                      <select v-model="educationData.education_id" class="form-control">
                          <option v-for="anEducation in education_list" :value="anEducation.id">@{{anEducation.education_level}}</option>
                      </select>
                    </div>
                </div>
              </div>

            <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="institution_name">Institution</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="institution_name" name="institution_name" v-model="educationData.institution_name">
                    </div>
                </div>
            </div>

               <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="major">Major</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="major" name="major" v-model="educationData.major">
                    </div>
                </div>
            </div>


            <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="start_date">Start Date</label>
                    </div>
                    <div class="col-md-6">
                        <vuejs-datepicker v-model="educationData.start_date" name="start_date" format="yyyy-MM-dd"></vuejs-datepicker>
                    </div>
                </div>
            </div>

             <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="dependent_date_of_birth">End Date</label>
                    </div>
                    <div class="col-md-6">
                        <vuejs-datepicker v-model="educationData.end_date" name="end_date" format="yyyy-MM-dd"></vuejs-datepicker>
                    </div>
                </div>
            </div>

                <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="result">Result</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="result" name="year_of_experiance" v-model="educationData.result">
                    </div>
                </div>
            </div>

             <div class="form-group">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-4">
                        <button class="btn btn-default" @click.prevent="editEducationPost">Save</button>
                    </div>
                </div>
            </div>

        </div>
   </div> `,
            data: function (){
                return {
                    education_list : {!! json_encode($education_data) !!},
                    educationData: {
                        employee_id: 0,
                        education_id:'',
                        institution_name: '',
                        major: '',
                        start_date: '',
                        end_date:'',
                        result:''
                    },
                    id: this.$route.params.id,
                    employee_id: {!! json_encode($employee_id) !!},
                };
            },
            methods:
                {
                    editEducationPost() {
                        var _that = this;
                        var employeeId = _that.employee_id;

                        var url = '{{ route("employeeEducationEditPost", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.post(url, this.educationData).then(function (response) {
                            console.log(response);

                            if(response.data.success==true)
                            {
                                //router.push({ name: 'employeeSkillList'});

                                var url = '{{ route("employeeEducation", ":id") }}';
                                url = url.replace(':id',employeeId);
                                window.location.href=url;

                            }
                        })
                    },

                    getEducation()
                    {
                        var _that = this;
                        var url = '{{ route("employeeEducationData", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.post(url, {employee_id: this.employee_id}).then(function (response) {
                            _that.educationData = response.data;
                            //console.log(response.data)

                        })
                    },

                },
            components: {
                vuejsDatepicker,
            },

            created(){
                this.getEducation();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'employeeEducationList'
            },
            {
                path: '/employee_education/add',
                component: addComponent,
                name: 'employeeEducationAdd'
            },
            {
                path: '/employee_education/edit/:id',
                component: editComponent,
                name: 'editEmployeeEducation'
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
            router
        }).$mount('#app')
    </script>
@endsection