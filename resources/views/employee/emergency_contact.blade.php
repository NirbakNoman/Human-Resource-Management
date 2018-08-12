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

                <router-link to="/" class="btn btn-default ">@lang('Emergency Contact List')</router-link>
                <router-link to="/emergency_contact/add" class="btn btn-default" style="margin-right:5px;">@lang('Add Emergency Contact')</router-link>
                <br>
                <br>


                <router-view></router-view>

            </div>
        </div>
    </div>

{{--    <div class="container">
        <div class="box box-primary">
            <div class = "row">
                <div class="col-md-12" id="app">
                    <div class="container">
                        <div class="col-md-10">
                            <router-link to="/" class="btn btn-default pull-right">@lang('Emergency Contact List')</router-link>
                            <router-link to="/emergency_contact/add" class="btn btn-default pull-right" style="margin-right:5px;">@lang('Add Emergency Contact')</router-link>
                        </div>
                    </div>

                    <br>

                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>--}}



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
                 Add Emergency Contact
             </div>

             <div class="panel-body">
                 <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label for="contact_name">Contact Name</label>
                        </div>
                        <div class="col-md-6">
                            <input  class="form-control input-sm" type="text" id="contact_name" name="contact_name" v-model="contactData.contact_name">
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="contact_relation">Contact Relation</label>
                        </div>
                        <div class="col-md-6">
                            <input  class="form-control input-sm" type="text" id="contact_relation" name="contact_relation" v-model="contactData.contact_relation">
                        </div>
                    </div>
                </div>

                <div class="form-group" >
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="contact_home_telephone">Contact Home Telephone</label>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" type="text" id="contact_home_telephone" name="contact_home_telephone" v-model="contactData.contact_home_telephone">
                        </div>
                    </div>
                </div>

                <div class="form-group" >
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="contact_mobile">Contact Mobile</label>
                        </div>
                        <div class="col-md-6">
                            <input  class="form-control" type="text" id="contact_mobile" name="contact_mobile" v-model="contactData.contact_mobile">
                        </div>
                    </div>
                </div>

                <div class="col-md-4 emp_personnel_info">
                    <button class="btn btn-info" @click="emergencyContactPost">Save</button>
                </div>

             </div>

         </div>
      `,
            data: function (){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    contactData: {

                        contact_name: '',
                        contact_relation: '',
                        contact_home_telephone: '',
                        contact_mobile: ''
                    },
                };
            },
            methods:
                {
                    emergencyContactPost()
                    {

                        let _that = this;
                        var employeeId = _that.employee_id;
                        var url = '{{ route("emergencyContactAddPost", ":id") }}';
                        url = url.replace(':id', _that.employee_id);


                        axios.post(url,this.contactData).then(function(response)
                        {
                            if(response.data.success==true)
                            {
                                //router.push({ name: 'emergencyContactList'});

                                var url = '{{ route("emergencyContact", ":id") }}';
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
                 Emergency Contact List
             </div>

             <div class="panel-body">
                    <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Delete</th>
                        <th>Edit</th>
                        <th>Contact Name</th>
                        <th>Contact Relation</th>
                        <th>Contact Number</th>
                    </tr>
                    </thead>

                    <tbody>
                         <tr v-for="aContact in emergency_contacts">
                            <td><button @click="deleteEmergencyContact(aContact.id)" class="btn btn-info">@lang('Delete')</button></td>
                            <td><router-link :to="{name:'editEmergencyContact',params:{id:aContact.id}}" tag="button" class="btn btn-primary">@lang('Edit')</router-link></td>
                            <td>@{{aContact.contact_name}}</td>
                            <td>@{{aContact.contact_relation}}</td>
                            <td>@{{aContact.contact_mobile}}</td>
                         </tr>
                     </tbody>
				</table>

             </div>

         </div>`,
            data: function(){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    emergency_contacts :{!! json_encode($emergency_contact_data) !!},
                };
            },
            methods:
                {
                    deleteEmergencyContact(id)
                    {
                        var _that = this;
                        var contact_id = id;
                        var url = '{{ route("emergencyContactDelete", ":id") }}';
                        url = url.replace(':id', contact_id);

                        axios.get(url).then(response=>{
                            _that.$router.go();
                            //console.log(response);
                        })
                    },

                },
            created(){
                console.log(this.emergency_contacts);
            }
        }

        var editComponent={
            template:`
         <div class="panel panel-default">
             <div class="panel-heading">
                 Edit Emergency Contact
             </div>

             <div class="panel-body">
                 <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label for="contact_name">Contact Name</label>
                        </div>
                        <div class="col-md-6">
                            <input  class="form-control input-sm" type="text" id="contact_name" name="contact_name" v-model="contactData.contact_name">
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="contact_relation">Contact Relation</label>
                        </div>
                        <div class="col-md-6">
                            <input  class="form-control input-sm" type="text" id="contact_relation" name="contact_relation" v-model="contactData.contact_relation">
                        </div>
                    </div>
                </div>

                <div class="form-group" >
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="contact_home_telephone">Contact Home Telephone</label>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" type="text" id="contact_home_telephone" name="contact_home_telephone" v-model="contactData.contact_home_telephone">
                        </div>
                    </div>
                </div>

                <div class="form-group" >
                    <div class="col-md-12 emp_personnel_info">
                        <div class="col-md-2">
                            <label for="contact_mobile">Contact Mobile</label>
                        </div>
                        <div class="col-md-6">
                            <input  class="form-control" type="text" id="contact_mobile" name="contact_mobile" v-model="contactData.contact_mobile">
                        </div>
                    </div>
                </div>

                <div class="col-md-4 emp_personnel_info">
                    <button class="btn btn-info" @click="editEmergencyContactPost">Save</button>
                </div>

             </div>

         </div> `,
            data: function (){
                return {
                    employee_id :{!! json_encode($employee_id) !!},
                    contactData: {
                        employee_id: 0,
                        contact_name: '',
                        contact_relation: '',
                        contact_home_telephone: '',
                        contact_mobile: ''
                    },
                    id: this.$route.params.id,
                };
            },
            methods:
                {
                    editEmergencyContactPost() {
                        var _that = this;
                        var employeeId = _that.employee_id;
                        var url = '{{ route("emergencyContactEditPost", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.post(url, this.contactData).then(function (response) {
                            console.log(response.data.success);


                            if(response.data.success==true)
                            {
                                // router.push({ name: 'emergencyContactList'});

                                var url = '{{ route("emergencyContact", ":id") }}';
                                url = url.replace(':id',employeeId);
                                window.location.href=url;

                            }
                        })
                    },
                    getEmergencyContact() {
                        var _that = this;
                        var url = '{{ route("emergencyContactData", ":id") }}';
                        url = url.replace(':id', _that.id);

                        axios.get(url).then(function (response) {
                            _that.contactData = response.data;
                            console.log(_that.contactData)
                        })
                    },

                },

            created(){
                this.getEmergencyContact();
            }
        }

        const routes = [
            {
                path: '/',
                component: listComponent,
                name: 'emergencyContactList'
            },
            {
                path: '/emergency_contact/add',
                component: addComponent,
                name: 'emergencyContactAdd'
            },
            {
                path: '/emergency_contact/edit/:id',
                component: editComponent,
                name: 'editEmergencyContact'
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