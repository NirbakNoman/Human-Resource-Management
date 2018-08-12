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

                <router-link to="/" class="btn btn-default">@lang('Language List')</router-link>
                <router-link to="/language/add" class="btn btn-default">@lang('Add Language')</router-link>

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
                 Add Employee Language
             </div>

             <div class="panel-body">

              <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="language">Language</label>
                    </div>
                    <div class="col-md-6">
                      <select v-model="languageData.language_id" class="form-control">
                          <option v-for="aLanguage in language_list" :value="aLanguage.id">@{{aLanguage.name}}</option>
                      </select>
                    </div>
                </div>
              </div>
              <br>

              <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="language">Fluency</label>
                    </div>
                    <div class="col-md-6">
                        <select v-model="languageData.fluency_type" class="form-control">
                               <option value="">Select One</option>
                               <option value="1">writing</option>
                               <option value="2">speaking</option>
                               <option value="3">reading</option>
                        </select>
                    </div>
                </div>
              </div>
                 <br>

                  <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="competency">Competency</label>
                    </div>
                    <div class="col-md-6">
                        <select v-model="languageData.competency_type" class="form-control">
                           <option value="">Select One</option>
                           <option value="1">Poor</option>
                           <option value="2">Basic</option>
                           <option value="3">Good</option>
                           <option value="4">Mother Tongue</option>
                        </select>
                    </div>
                </div>
              </div>

              <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="comments">Comments</label>
                    </div>
                    <div class="col-md-6">
                        <textarea rows="4" cols="50" class="form-control" id="comments" name="comments" v-model="languageData.comments">
                        </textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-4 emp_personnel_info">
                <button class="btn btn-info" @click.prevent="languageDataPost">Save</button>
            </div>
         </div>
    </div>`,
            data: function (){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    language_list : {!! json_encode($language_data) !!},
                    languageData: {
                        language_id: '',
                        fluency_type: '',
                        competency_type: '',
                        comments: '',
                        employee_id: {!! json_encode($employee_id) !!},
                    },
                };
            },
            methods:
                {
                    languageDataPost()
                    {
                        let _that = this;
                        var employeeId = _that.employee_id;
                        var url = '{{ route("employeeLanguageAddPost", ":id") }}';
                        url = url.replace(':id', _that.employee_id);

                        axios.post(url,this.languageData).then(function(response)
                        {
                            //console.log(response.data.success==true);

                            if(response.data.success==true)
                            {
                                var url = '{{ route("employeeLanguage", ":id") }}';
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
                 Employee Language List
             </div>

             <div class="panel-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Delete</th>
                            <th>Edit</th>
                            <th>Language</th>
                            <th>Fluency</th>
                            <th>Competency</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="aLanguage in languages">
                            <td><button @click="deleteLanguage(aLanguage.id)" class="btn btn-info">@lang('Delete')</button></td>
                            <td><router-link :to="{name:'editEmployeeLanguage',params:{id:aLanguage.id}}" tag="button" class="btn btn-primary">@lang('Edit')</router-link></td>
                            <td>@{{aLanguage.name}}</td>
                            <td v-if="aLanguage.pivot.fluency_type == {{ \App\Enumeration\FluencyType::$WRITING }}">writing</td>
                            <td v-if="aLanguage.pivot.fluency_type == {{ \App\Enumeration\FluencyType::$SPEAKING }}">speaking</td>
                            <td v-if="aLanguage.pivot.fluency_type == {{ \App\Enumeration\FluencyType::$READING }}">reading</td>

                            <td v-if="aLanguage.pivot.competency_type == {{ \App\Enumeration\CompetencyType::$POOR }} ">Poor</td>
                            <td v-if="aLanguage.pivot.competency_type == {{ \App\Enumeration\CompetencyType::$BASIC }}">Basic</td>
                            <td v-if="aLanguage.pivot.competency_type == {{ \App\Enumeration\CompetencyType::$GOOD }}">Good</td>
                            <td v-if="aLanguage.pivot.competency_type == {{ \App\Enumeration\CompetencyType::$MOTHER_TONGE }}">Mother Tonge</td>

                        </tr>
                    </tbody>
                </table>
           </div>
        </div>`
            ,
            data: function(){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    languages :{!! json_encode($employee_language_data) !!},
                };
            },
            methods:
                {
                    deleteLanguage(id)
                    {
                        var _that = this;
                        var language_id = id;
                        var url = '{{ route("employeeLanguageDelete", ":id") }}';
                        url = url.replace(':id', language_id);

                        axios.post(url, {employee_id: this.employee_id}).then(response=>{
                            _that.$router.go();
                        })
                    },

                },
            created(){
                console.log(this.languages);
            }
        }

        var editComponent={
            template:`
        <div class="panel panel-default">
             <div class="panel-heading">
                 edit Employee Language
             </div>

             <div class="panel-body">

              <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="language">Language</label>
                    </div>
                    <div class="col-md-6">
                      <select v-model="languageData.language_id" class="form-control">
                          <option v-for="aLanguage in language_list" :value="aLanguage.id">@{{aLanguage.name}}</option>
                      </select>
                    </div>
                </div>
              </div>

              <br>
             <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="language">Fluency</label>
                    </div>
                    <div class="col-md-6">
                        <select v-model="languageData.fluency_type" class="form-control">
                               <option value="">Select One</option>
                               <option value="1">writing</option>
                               <option value="2">speaking</option>
                               <option value="3">reading</option>
                        </select>
                    </div>
                </div>
              </div>

              <br>

                  <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="competency">Competency</label>
                    </div>
                    <div class="col-md-6">
                        <select v-model="languageData.competency_type" class="form-control">
                           <option value="">Select One</option>
                           <option value="1">poor</option>
                           <option value="2">basic</option>
                           <option value="3">good</option>
                           <option value="4">Mother Tongue</option>
                        </select>
                    </div>
                </div>
              </div>

              <div class="form-group" >
                <div class="col-md-12 emp_personnel_info">
                    <div class="col-md-2">
                        <label for="comments">Comments</label>
                    </div>
                    <div class="col-md-6">
                        <textarea rows="4" cols="50" class="form-control" id="comments" name="comments" v-model="languageData.comments">
                        </textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-4 emp_personnel_info">
                <button class="btn btn-info" @click.prevent="editLanguagePost">Save</button>
            </div>
         </div>
    </div>`,
            data: function (){
                return {
                    language_list : {!! json_encode($language_data) !!},
                    languageData: {
                        language_id: '',
                        fluency_type: '',
                        competency_type: '',
                        comments: '',
                        employee_id: {!! json_encode($employee_id) !!},
                    },
                    id: this.$route.params.id,
                    employee_id: {!! json_encode($employee_id) !!},
                };
            },
            methods:
                {
                    editLanguagePost()
                    {
                        var _that = this;
                        var employeeId = _that.employee_id;

                        var url = '{{ route("employeeLanguageEditPost", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.post(url, this.languageData).then(function (response) {
                            console.log(response);

                            if(response.data.success==true)
                            {
                                var url = '{{ route("employeeLanguage", ":id") }}';
                                url = url.replace(':id',employeeId);
                                window.location.href=url;
                            }
                        })
                    },

                    getLanguage()
                    {
                        var _that = this;
                        var url = '{{ route("employeeLanguageData", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.post(url, {employee_id: this.employee_id}).then(function (response) {
                            _that.languageData = response.data;
                            //console.log(response.data)
                        })
                    },
                },

            created(){
                this.getLanguage();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'employeeLanguageList'
            },
            {
                path: '/language/add',
                component: addComponent,
                name: 'employeeLanguageAdd'
            },
            {
                path: '/language/edit/:id',
                component: editComponent,
                name: 'editEmployeeLanguage'
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