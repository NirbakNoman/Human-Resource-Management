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
                            <router-link to="/language/add" class="btn btn-default pull-right">@lang('Add Language')</router-link>
                            <router-link to="/" class="btn btn-default pull-right" style="margin-right:5px;">@lang('Language List')</router-link>
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
                    Add Language
                </div>

                <div class="panel-body">

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-md-6">
                                <input  class="form-control input-sm" type="text" id="name" name="name" v-model="languageData.name">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 emp_personnel_info">
                        <button class="btn btn-info" @click="languageDataPost">Save</button>
                    </div>

                </div>

            </div>
        </div>

    </div>`,
            data: function (){
                return {

                    languageData: {
                        name: ''
                    },
                };
            },
            methods:
                {
                    languageDataPost()
                    {
                        let _that = this;

                        axios.post('language_add',this.languageData).then(function(response)
                        {

                            if(response.data.success==true)
                            {
                                //router.push({ name: 'languageList'});

                                var url = '{{ route("languageList") }}';

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
                    Language List
                </div>

                <div class="panel-body">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Delete</th>
                            <th>Edit</th>
                            <th>Language</th>

                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="aLanguage in languages">
                            <td><button @click="deleteLanguage(aLanguage.id)" class="btn btn-info">@lang('Delete')</button></td>
                            <td><router-link :to="{name:'editLanguage',params:{id:aLanguage.id}}" tag="button" class="btn btn-info">@lang('Edit')</router-link></td>
                            <td>@{{aLanguage.name}}</td>
                        </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>`,
            data: function(){
                return {
                    languages :{!! json_encode($language_data) !!},
                };
            },
            methods:
                {
                    deleteLanguage(id)
                    {
                        var _that = this;
                        axios.get('language_delete/'+id).then(response=>{
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
                    Edit Language
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-md-6">
                                <input  class="form-control input-sm" type="text" id="name" name="name" v-model="languageData.name">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 emp_personnel_info">
                        <button class="btn btn-info" @click="editLanguagePost">Save</button>
                    </div>
                </div>

            </div>
        </div>

    </div> `,
            data: function (){
                return {
                    languageData: {
                        name: '',
                    },
                    id: this.$route.params.id,

                };
            },
            methods:
                {
                    editLanguagePost() {
                        var _that = this;
                        axios.post('language_edit_post/'+this.id, this.languageData).then(function (response) {
                            console.log(response);

                            if(response.data.success==true)
                            {
                                //router.push({ name: 'languageList'});

                                var url = '{{ route("languageList") }}';

                                window.location.href=url;
                            }
                        })
                    },
                    getLanguage() {
                        var _that = this;

                        axios.get('language_edit_data/'+this.id).then(function (response) {
                            _that.languageData = response.data;
                            console.log(_that.languageData)
                        })
                    }
                },

            created(){
                this.getLanguage();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'languageList'
            },
            {
                path: '/language/add',
                component: addComponent,
                name: 'languageAdd'
            },
            {
                path: '/language/edit/:id',
                component: editComponent,
                name: 'editLanguage'
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