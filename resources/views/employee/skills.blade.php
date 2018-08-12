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

                <router-link to="/" class="btn btn-default">@lang('Skill List')</router-link>
                <router-link to="/skill/add" class="btn btn-default">@lang('Add Skill')</router-link>

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
     <div class="panel panel-default">
             <div class="panel-heading">
                 Add Employee Skill
             </div>

             <div class="panel-body">

              <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="skill">Skill</label>
                    </div>
                    <div class="col-md-6">
                      <select v-model="skillData.skill_id" class="form-control">
                          <option v-for="aSkill in skill_list" :value="aSkill.id">@{{aSkill.name}}</option>
                      </select>
                    </div>
                </div>
              </div>

            <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="year_of_experiance">Year Of Experiance</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="year_of_experiance" name="year_of_experiance" v-model="skillData.year_of_experiance">
                    </div>
                </div>
            </div>

            <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="comments">Comments</label>
                    </div>
                    <div class="col-md-6">
                        <textarea rows="4" cols="50" class="form-control" id="comments" name="comments" v-model="skillData.comments">
                        </textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-4 emp_personnel_info">
                <button class="btn btn-info" @click.prevent="skillDataPost">Save</button>
            </div>

             </div>

         </div>`,
            data: function (){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    skill_list : {!! json_encode($skill_data) !!},
                    skillData: {
                        skill_id: '',
                        year_of_experiance: '',
                        comments: ''
                    },
                };
            },
            methods:
                {
                    skillDataPost()
                    {
                        let _that = this;
                        var employeeId = _that.employee_id;
                        var url = '{{ route("employeeSkillAddPost", ":id") }}';
                        url = url.replace(':id', _that.employee_id);

                        axios.post(url,this.skillData).then(function(response)
                        {
                            console.log(response.data.success==true);

                            if(response.data.success==true)
                            {
                                //router.push({ name: 'employeeSkillList'});

                                var url = '{{ route("employeeSkill", ":id") }}';
                                url = url.replace(':id',employeeId);
                                window.location.href=url;
                            }
                        })
                    },
                }
        }

        var listComponent = {
            template: `
        <div class="panel panel-default">
             <div class="panel-heading">
                 Employee Skill List
             </div>

             <div class="panel-body">
                <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Skill</th>
                                <th>Year Of Experiance</th>

                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="aSkill in skills">
                                <td><button @click="deleteSkill(aSkill.id)" class="btn btn-info">@lang('Delete')</button></td>
                                <td><router-link :to="{name:'editSkill',params:{id:aSkill.id}}" tag="button" class="btn btn-primary">@lang('Edit')</router-link></td>
                                <td>@{{aSkill.name}}</td>
                                <td>@{{aSkill.pivot.year_of_experiance}}</td>

                            </tr>
                     </tbody>

                </table>

             </div>
        </div>
   `,
            data: function(){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    skills :{!! json_encode($employee_skill_data) !!},
                };
            },
            methods:
                {
                    deleteSkill(id)
                    {
                        var _that = this;
                        var skill_id = id;
                        var url = '{{ route("employeeSkillDelete", ":id") }}';
                        url = url.replace(':id', skill_id);

                        axios.post(url, {employee_id: this.employee_id}).then(response=>{
                            _that.$router.go();
                            //console.log(response);
                        })
                    },
                },
            created(){
               console.log(this.skills);
            }
        }

        var editComponent={
            template:`
         <div class="panel panel-default">
             <div class="panel-heading">
                 Edit Employee Skill
             </div>

             <div class="panel-body">
               <div class="form-group">
                <div class="col-md-12">

                    <div class="col-md-2">
                        <label for="skill">Skill</label>
                    </div>
                    <div class="col-md-6">
                      <select v-model="skillData.skill_id" class="form-control">
                          <option v-for="aSkill in skill_list" :value="aSkill.id">@{{aSkill.name}}</option>
                      </select>
                    </div>

                </div>
            </div>

            <div class="form-group ">
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="year_of_experiance">Year Of Experiance</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="year_of_experiance" name="year_of_experiance" v-model="skillData.year_of_experiance">
                    </div>
                </div>
            </div>

            <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="comments">Comments</label>
                    </div>
                    <div class="col-md-6">
                        <textarea rows="4" cols="50" class="form-control" id="comments" name="comments" v-model="skillData.comments">
                        </textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-4 emp_personnel_info">
                <button class="btn btn-info" @click.prevent="editSkillPost">Save</button>
            </div>

           </div>

         </div> `,
            data: function (){
                return {
                    skill_list : {!! json_encode($skill_data) !!},
                    skillData: {
                        skill_id: '',
                        year_of_experiance: '',
                        comments: '',
                        employee_id: {!! json_encode($employee_id) !!},
                    },
                    id: this.$route.params.id,
                    employee_id: {!! json_encode($employee_id) !!},
                };
            },
            methods:
                {
                    editSkillPost() {
                        var _that = this;
                        var employeeId = _that.employee_id;

                        var url = '{{ route("employeeSkillEditPost", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.post(url, this.skillData).then(function (response) {
                            console.log(response);

                            if(response.data.success==true)
                            {
                                //router.push({ name: 'employeeSkillList'});

                                var url = '{{ route("employeeSkill", ":id") }}';
                                url = url.replace(':id',employeeId);
                                window.location.href=url;

                            }
                        })
                    },

                    getSkill()
                    {
                        var _that = this;
                        var url = '{{ route("employeeSkillData", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.post(url, {employee_id: this.employee_id}).then(function (response) {
                            _that.skillData = response.data;
                            //console.log(response.data)

                        })
                    },
                },

            created(){
                this.getSkill();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'employeeSkillList'
            },
            {
                path: '/skill/add',
                component: addComponent,
                name: 'skillAdd'
            },
            {
                path: '/skill/edit/:id',
                component: editComponent,
                name: 'editSkill'
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