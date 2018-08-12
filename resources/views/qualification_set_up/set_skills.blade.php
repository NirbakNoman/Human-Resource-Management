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
                            <router-link to="/" class="btn btn-default pull-right">@lang('Skill List')</router-link>
                            <router-link to="/skill/add" class="btn btn-default pull-right" style="margin-right:5px;">@lang('Add Skill')</router-link>
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
        <div class="panel-heading" >
            Add Skill
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="name">Name</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control input-sm" type="text" id="name" name="name" v-model="skillData.name">
                    </div>
                </div>
            </div>


            <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="comments">Description</label>
                    </div>
                    <div class="col-md-6">
                        <textarea rows="4" cols="50" class="form-control" id="comments" name="comments" v-model="skillData.description">
                        </textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-4 emp_personnel_info">
                <button class="btn btn-default" @click="skillDataPost">Save</button>
            </div>
        </div>

    </div>
</div>

        </div>`,
            data: function (){
                return {

                    skillData: {
                        name: '',
                        description: ''
                    },
                };
            },
            methods:
                {
                    skillDataPost()
                    {
                        let _that = this;

                        axios.post('skill_add',this.skillData).then(function(response)
                        {
                            if(response.data.success==true)
                            {
                                //router.push({ name: 'educationList'});

                                var url = '{{ route("skillList") }}';

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
                Skill List
            </div>

            <div class="panel-body">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Delete</th>
                        <th>Edit</th>
                        <th>Skill</th>
                        <th>Description</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="aSkill in skills">
                        <td><button @click="deleteSkill(aSkill.id)" class="btn btn-info">@lang('Delete')</button></td>
                        <td><router-link :to="{name:'editSkill',params:{id:aSkill.id}}" tag="button" class="btn btn-info">@lang('Edit')</router-link></td>
                        <td>@{{aSkill.name}}</td>
                        <td>@{{aSkill.description}}</td>

                    </tr>
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>`,
            data: function(){
                return {
                    skills :{!! json_encode($skill_data) !!},
                };
            },
            methods:
                {
                    deleteSkill(id)
                    {
                        var _that = this;
                        axios.get('skill_delete/'+id).then(response=>{
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
                <div class="panel-heading" >
                    Edit Skill
                </div>

            <div class="panel-body">

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-md-6">
                            <input  class="form-control input-sm" type="text" id="name" name="name" v-model="skillData.name">
                        </div>
                    </div>
                </div>


                <div class="form-group" >
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="comments">Description</label>
                        </div>
                        <div class="col-md-6">
                        <textarea rows="4" cols="50" class="form-control" id="comments" name="comments" v-model="skillData.description">
                        </textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 emp_personnel_info">
                    <button class="btn btn-default" @click="editSkillPost">Save</button>
                </div>
            </div>
            </div>
        </div>
    </div> `,
            data: function (){
                return {
                    skillData: {
                        name: '',
                        description: ''
                    },
                    id: this.$route.params.id,
                };
            },
            methods:
                {
                    editSkillPost() {
                        var _that = this;
                        axios.post('skill_edit_post/'+this.id, this.skillData).then(function (response) {
                            //console.log(response);

                            if(response.data.success==true)
                            {

                                //router.push({ name: 'skillList'});

                                var url = '{{ route("skillList") }}';

                                window.location.href=url;
                            }
                        })
                    },
                    getSkill() {
                        var _that = this;

                        axios.get('skill_edit_data/'+this.id).then(function (response) {
                            _that.skillData = response.data;
                            console.log(_that.skillData)
                        })
                    }
                },

            created(){
                this.getSkill();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'skillList'
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
            router
        }).$mount('#app')
    </script>
@endsection