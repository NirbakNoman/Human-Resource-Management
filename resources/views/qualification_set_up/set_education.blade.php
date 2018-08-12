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
                            <router-link to="/education/add" class="btn btn-default pull-right">@lang('Add Education')</router-link>
                            <router-link to="/" class="btn btn-default pull-right" style="margin-right:5px;">@lang('Education Level List')</router-link>
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Education Level
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label for="education_level">Education Level</label>
                            </div>
                            <div class="col-md-6">
                                <input  class="form-control input-sm" type="text" id="education_level" name="education_level" v-model="educationData.education_level">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 emp_personnel_info">
                        <button class="btn btn-info" @click="educationDataPost">Save</button>
                    </div>
                </div>

            </div>

        </div>
    </div> `,
            data: function (){
                return {

                    educationData: {
                        education_level: ''
                    },
                };
            },
            methods:
                {
                    educationDataPost()
                    {
                        let _that = this;

                        axios.post('education_add',this.educationData).then(function(response)
                        {
                            if(response.data.success==true)
                            {
                                //router.push({ name: 'educationList'});

                                var url = '{{ route("educationList") }}';

                                window.location.href=url;
                            }
                        })

                    },
                }
        }

        var listComponent = {
            template: `
        <div class="container">
     <div class="col-md-10">
         <div class="panel panel-default">
             <div class="panel-heading">
                 Education Level List
             </div>
             <div class="panel-body">
                 <table class="table table-hover table-striped">
                     <thead>
                     <tr>
                         <th>Delete</th>
                         <th>Edit</th>
                         <th>Education Level</th>

                     </tr>
                     </thead>
                      <tbody>
                     <tr v-for="aData in education">
                         <td><button @click="deleteEducation(aData.id)" class="btn btn-info">@lang('Delete')</button></td>
                         <td><router-link :to="{name:'editEducation',params:{id:aData.id}}" tag="button" class="btn btn-info">@lang('Edit')</router-link></td>
                         <td>@{{aData.education_level}}</td>
                     </tr>
                     </tbody>

                 </table>
             </div>
         </div>
     </div>
 </div>`,
            data: function(){
                return {
                    education :{!! json_encode($education_data) !!},
                };
            },
            methods:
                {
                    deleteEducation(id)
                    {
                        var _that = this;
                        axios.get('education_delete/'+id).then(response=>{
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
                    Edit Education Level
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label for="education_level">Education Level</label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control input-sm" type="text" id="education_level" name="education_level" v-model="educationData.education_level">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 emp_personnel_info">
                        <button class="btn btn-info" @click="editEducationPost">Save</button>
                    </div>
                </div>

            </div>
        </div>

    </div> `,
            data: function (){
                return {
                    educationData: {
                        education_level: ''
                    },
                    id: this.$route.params.id,
                };
            },
            methods:
                {
                    editEducationPost() {
                        var _that = this;
                        axios.post('education_edit_post/'+this.id, this.educationData).then(function (response) {
                            //console.log(response);
                            //router.push({ name: 'educationList'});

                            if(response.data.success==true)
                            {
                                //router.push({ name: 'educationList'});

                                var url = '{{ route("educationList") }}';

                                window.location.href=url;
                            }
                        })
                    },
                    getEducation() {
                        var _that = this;

                        axios.get('education_edit_data/'+this.id).then(function (response) {
                            _that.educationData = response.data;
                            console.log(_that.educationData)
                        })
                    }
                },

            created(){
                this.getEducation();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'educationList'
            },
            {
                path: '/education/add',
                component: addComponent,
                name: 'educationAdd'
            },
            {
                path: '/education/edit/:id',
                component: editComponent,
                name: 'editEducation'
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