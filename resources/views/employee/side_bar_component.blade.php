
 <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>BYTE LAB Employee</strong>
            </div>
            <div class="panel-body">
                <img src="{{ asset('images/profile.png') }}" height="170px" width="150px"  class="img-circle user-image" alt="User Image"
                     style="margin-left: 30px; margin-bottom: 30px;">
            </div>

        </div>
        <div class="panel panel-default">

            <div class="panel-body">
                <nav id="spy">
                    <ul class="sidebar-nav nav">

                        <li>
                            <a @click="editData('edit_personal_detail_form', employee_id)" href="javascript:void(0)" data-scroll><i style="color: black" class="showopacity glyphicon glyphicon-tags"></i> <strong style="color: black">Personnel Details</strong></a>
                        </li>

                        <li>
                            <a @click="editData('employee_contact', employee_id)" href="javascript:void(0)" data-scroll><i class="glyphicon glyphicon-hdd "></i><strong>Contact Details</strong></a>
                        </li>

                        <li>
                            <a @click="editData('emergency_contact', employee_id)" href="javascript:void(0)" data-scroll><i class="fa fa-clipboard" aria-hidden="true"></i><strong>Emergency Contacts</strong></a>
                        </li>

                        <li>
                            <a @click="editData('employee_dependent', employee_id)" href="javascript:void(0)" data-scroll><i class="fa fa-archive" aria-hidden="true"></i><strong>Dependents</strong></a>
                        </li>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i><strong>Qualifications</strong><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a @click="editData('employee_skill', employee_id)" href="javascript:void(0)">
                                        <i class="showopacity glyphicon glyphicon-tags" aria-hidden="true"></i>
                                        <span> Skill </span>
                                    </a>
                                </li>
                                <li>
                                    <a @click="editData('employee_education', employee_id)" href="javascript:void(0)" data-scroll>
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                        <span> Education </span>
                                    </a>
                                </li>
                                <li>
                                    <a @click="editData('work_experience', employee_id)" href="javascript:void(0)" data-scroll>
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        <span> Work Experience </span>
                                    </a>
                                </li>
                                <li>
                                    <a @click="editData('employee_certification', employee_id)"  href="javascript:void(0)" data-scroll>
                                        <i class="glyphicon glyphicon-hdd " aria-hidden="true"></i>
                                        <span> Certification </span>
                                    </a>
                                </li>
                                <li>
                                    <a @click="editData('employee_language', employee_id)"  href="javascript:void(0)" data-scroll>
                                        <i class="fa fa-list" aria-hidden="true"></i><span> Language </span>
                                    </a>
                                </li>
                                {{-- <li><a href="{{route('userCategoryList')}}"><i class="fa fa-list" aria-hidden="true"></i><span>@lang('User Category List') </span></a></li>--}}
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>





