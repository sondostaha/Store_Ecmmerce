<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href=""><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

          


            <li class=" nav-item"><a href="#"><i class="la la-s"></i><span class="menu-title"
                                                                                    data-i18n="nav.templates.main">الاعدادات </span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">وسائل التوصيل</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('edit.shipping','free')}}"
                                   data-i18n="nav.templates.vert.classic_menu"> توصيل مجاني</a>
                            </li>
                            <li><a class="menu-item" href="{{route('edit.shipping','local')}}"> توصيل داخلي</a>
                            </li>
                            <li><a class="menu-item" href="{{route('edit.shipping','outer')}}"
                                   data-i18n="nav.templates.vert.compact_menu">توصيل خارجي </a>
                            </li>
                           
                        </ul>
                    </li>
                   
                </ul>
            </li>
            

            <li class=" nav-item"><a href="#"><i class="la la-navicon"></i><span class="menu-title"
                                                                                 data-i18n="nav.navbars.main">التصنيفات</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.categories') }}" data-i18n="nav.navbars.nav_light"> التصنيفات الرائسيه</a>
                    </li>
                    <li><a class="menu-item" href="{{ route('admin.subcategories') }}" data-i18n="nav.navbars.nav_dark"> التصنيفات الفرعيه</a>
                    </li>
                  
                 
                </ul>
            </li>
           
            <li class=" navigation-header">
                <span data-i18n="nav.category.pages">Pages</span><i class="la la-ellipsis-h ft-minus"
                                                                    data-toggle="tooltip"
                                                                    data-placement="right"
                                                                    data-original-title="Pages"></i>
            </li>
            <li class=" nav-item"><a href="email-application.html"><i class="la la-envelope"></i><span
                        class="menu-title" data-i18n="">Email Application</span></a>
            </li>
            <li class=" nav-item"><a href="chat-application.html"><i class="la la-comments"></i><span class="menu-title"
                                                                                                      data-i18n="">Chat Application</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-briefcase"></i><span class="menu-title"
                                                                                   data-i18n="nav.project.main">Project</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="project-summary.html" data-i18n="nav.project.project_summary">Project
                            Summary</a>
                    </li>
                    <li><a class="menu-item" href="project-tasks.html" data-i18n="nav.project.project_tasks">Project
                            Task</a>
                    </li>
                    <li><a class="menu-item" href="project-bugs.html" data-i18n="nav.project.project_bugs">Project
                            Bugs</a>
                    </li>
                </ul>
            </li>
 
            <li class=" navigation-header">
                <span data-i18n="nav.category.support">Support</span><i class="la la-ellipsis-h ft-minus"
                                                                        data-toggle="tooltip"
                                                                        data-placement="right"
                                                                        data-original-title="Support"></i>
            </li>
            <li class=" nav-item"><a href="http://support.pixinvent.com/"><i class="la la-support"></i><span
                        class="menu-title" data-i18n="nav.support_raise_support.main">Raise Support</span></a>
            </li>
            <li class=" nav-item">
                <a href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/documentation"><i
                        class="la la-text-height"></i>
                    <span class="menu-title" data-i18n="nav.support_documentation.main">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</div>
