<!-- begin:: Aside Brand -->
<div class="k-aside__brand	k-grid__item " id="k_aside_brand">
    <div class="k-aside__brand-logo">
        <a href="index.html">
            <img alt="Logo" src="{{asset('assets/media/logos/logo-6.png')}}" />
        </a>
    </div>
    <div class="k-aside__brand-tools">
        <button class="k-aside__brand-aside-toggler k-aside__brand-aside-toggler--left" id="k_aside_toggler"><span></span></button>
    </div>
</div>

<!-- begin:: Aside Menu -->
<div class="k-aside-menu-wrapper	k-grid__item k-grid__item--fluid" id="k_aside_menu_wrapper">
    <div id="k_aside_menu" class="k-aside-menu " data-kmenu-vertical="1" data-kmenu-scroll="1" data-kmenu-dropdown-timeout="500">
        <ul class="k-menu__nav ">
            <li class="k-menu__item " aria-haspopup="true"><a target="_blank" href="{{ route('bo.web.dashboard')}}" class="k-menu__link "><i class="k-menu__link-icon flaticon2-graphic"></i><span class="k-menu__link-text">Dashboards</span></a></li>

            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-copy"></i><span class="k-menu__link-text"> Products </span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Categories</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="{{route('bo.web.category-groups.index')}}" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Category-groups</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="{{route('bo.web.categories.index')}}" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Categories</span></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-contract"></i><span class="k-menu__link-text"> Interface </span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item " aria-haspopup="true"><a href="{{route('bo.web.banners.index')}}" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Setting Banner</span></a></li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Menu Config<menu type="toolbar"></menu></span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Menu Group</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Sub Menu Group</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Menu</span></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

             <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon fas fa-user-shield"></i><span class="k-menu__link-text"> Administration </span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item " aria-haspopup="true"><a href="{{route('bo.web.admins.index')}}" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Administrator</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="{{route('bo.web.banners.index')}}" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Access rights</span></a></li>
                    </ul>
                </div>
            </li>



            <li class="k-menu__section ">
                <h4 class="k-menu__section-text">Components</h4>
                <i class="k-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-layers-1"></i><span class="k-menu__link-text">Base</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">Base</span></span></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_alert.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Alert</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_badge.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Badge</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_buttons.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Buttons</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_button-group.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Button Group</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_card.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Card</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_collapse.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Collapse</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_accordions.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Accordions</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_dropdown.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Dropdown</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_list-group.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">List Group</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_modal.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Modal</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_navs.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Navs</span></a></li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Tabs</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_base_tabs_line.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Line Tabs</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_base_tabs_button.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Button Tabs</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_pagination.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Pagination</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_popovers.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Popovers</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_tooltips.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Tooltips</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_progress.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Progress</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_breadcrumb.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Breadcrumb</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_base_table.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Table</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-rocket-travelling-space-transport"></i><span class="k-menu__link-text">Custom</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">Custom</span></span></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_custom_colors.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Colors</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_custom_typography.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Typography</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_custom_spinners.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Spinners</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_custom_lists.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Lists</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_custom_notifications.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Notifications</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_custom_timeline.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Timeline</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_custom_navs.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Navs</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_custom_head.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Head</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_custom_iconbox.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Iconbox</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-cube-1"></i><span class="k-menu__link-text">Extended</span><span class="k-menu__link-badge"><span class="k-badge k-badge--brand">2</span></span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">Extended</span><span class="k-menu__link-badge"><span class="k-badge k-badge--brand">2</span></span></span></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_extended_sticky-panels.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Sticky Panels</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_extended_blockui.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Block UI</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_extended_scroll.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Perfect Scroll</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_extended_toastr.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Toastr</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_extended_sweetalert2.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">SweetAlert2</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_extended_session-timeout.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Session Timeout</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_extended_idle-timer.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Idle Timer</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item " aria-haspopup="true"><a href="components_widgets.html" class="k-menu__link "><i class="k-menu__link-icon flaticon2-pie-chart-4"></i><span class="k-menu__link-text">Widgets</span></a></li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-laptop"></i><span class="k-menu__link-text">Keen Wizard</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">Keen Wizard</span></span></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-wizard_wizard-v1.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Wizard v1</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-wizard_wizard-v2.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Wizard v2</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-wizard_wizard-v3.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Wizard v3</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-wizard_wizard-v4.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Wizard v4</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-browser-2"></i><span class="k-menu__link-text">Keen Datatable</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">Keen Datatable</span></span></li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Base</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_base_data-local.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Local Data</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_base_data-json.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">JSON Data</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_base_data-ajax.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Ajax Data</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_base_html-table.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">HTML Table</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_base_local-sort.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Local Sort</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_base_translation.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Translation</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Advanced</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_advanced_record-selection.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Record Selection</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_advanced_row-details.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Row Details</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_advanced_modal.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Modal Examples</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_advanced_column-rendering.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Column Rendering</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_advanced_column-width.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Column Width</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Scrolling</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_scrolling_vertical.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Vertical Scrolling</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_scrolling_horizontal.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Horizontal Scrolling</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_scrolling_both.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Both Scrolling</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Locked Columns</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_locked_left.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Left Locked Columns</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_locked_right.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Right Locked Columns</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_locked_both.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Both Locked Columns</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_locked_html-table.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">HTML Table</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Child Datatables</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_child_data-local.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Local Data</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_child_data-ajax.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Remote Data</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">API</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_api_methods.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">API Methods</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_keen-datatable_api_events.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Events</span></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-list-3"></i><span class="k-menu__link-text">DataTables</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">DataTables</span></span></li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Basic</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_basic_basic.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Basic Tables</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_basic_scrollable.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Scrollable Tables</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_basic_headers.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Complex Headers</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_basic_paginations.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Pagination Options</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Advanced</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_advanced_column-rendering.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Column Rendering</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_advanced_multiple-controls.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Multiple Controls</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_advanced_column-visibility.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Column Visibility</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_advanced_row-callback.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Row Callback</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_advanced_row-grouping.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Row Grouping</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_advanced_footer-callback.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Footer Callback</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Data sources</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_data-sources_html.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">HTML</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_data-sources_javascript.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Javascript</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_data-sources_ajax-client-side.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Ajax Client-side</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_data-sources_ajax-server-side.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Ajax Server-side</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Search Options</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_search-options_column-search.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Column Search</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_search-options_advanced-search.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Advanced Search</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Extensions</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_extensions_buttons.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Buttons</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_extensions_colreorder.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">ColReorder</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_extensions_keytable.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">KeyTable</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_extensions_responsive.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Responsive</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_extensions_rowgroup.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">RowGroup</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_extensions_rowreorder.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">RowReorder</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_extensions_scroller.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Scroller</span></a></li>
                                    <li class="k-menu__item " aria-haspopup="true"><a href="components_datatables_extensions_select.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Select</span></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-gift-1"></i><span class="k-menu__link-text">Icons</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_icons_flaticon.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Flaticon</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_icons_fontawesome5.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Fontawesome 5</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_icons_lineawesome.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Lineawesome</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_icons_socicons.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Socicons</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-browser-1"></i><span class="k-menu__link-text">Portlets</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">Portlets</span></span></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_portlets_base.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Base</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_portlets_tools.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Tools</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_portlets_draggable.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Draggable</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_portlets_sticky.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Sticky</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-calendar-2"></i><span class="k-menu__link-text">Calendar</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">Calendar</span></span></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_calendar_basic.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Basic</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_calendar_list-view.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">List View</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_calendar_agenda-week.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Agenda Week View</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_calendar_google.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Google Calendar</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_calendar_external.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">External Events</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_calendar_rendering.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Event Rendering</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-graph-1"></i><span class="k-menu__link-text">Charts</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">Charts</span></span></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_charts_flotcharts.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Flot Charts</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_charts_google-charts.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Google Charts</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_charts_morris-charts.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Morris Charts</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="components_charts_chart-js.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Chart JS</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__section ">
                <h4 class="k-menu__section-text">Custom</h4>
                <i class="k-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-chat-1"></i><span class="k-menu__link-text">Blog</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">Blog</span></span></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_blog_grid.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Blog Grid</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_blog_grid-v2.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Blog Grid v2</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_blog_list.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Blog List</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_blog_post.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Blog Post</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-open-text-book"></i><span class="k-menu__link-text">Pricing</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">Pricing</span></span></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_pricing_pricing-v1.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Pricing v1</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_pricing_pricing-v2.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Pricing v2</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-bell-1"></i><span class="k-menu__link-text">Invoices</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">Invoices</span></span></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_invoices_invoice-v1.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Invoice v1</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_invoices_invoice-v2.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Invoice v2</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-information-circular-button-symbol"></i><span class="k-menu__link-text">FAQs</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item  k-menu__item--parent" aria-haspopup="true"><span class="k-menu__link"><span class="k-menu__link-text">FAQs</span></span></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_faq_faq-v1.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">FAQ v1</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_faq_faq-v2.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">FAQ v2</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_faq_faq-v3.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">FAQ v3</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_faq_faq-v4.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">FAQ v4</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-calendar-3"></i><span class="k-menu__link-text">User Pages</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_user_login-v1.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Login v1</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_user_login-v2.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Login v2</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_user_profile-v1.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">Profile v1</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover"><a href="javascript:;" class="k-menu__link k-menu__toggle"><i class="k-menu__link-icon flaticon2-attention-exclamation-triangular-signal"></i><span class="k-menu__link-text">Error Pages</span><i class="k-menu__ver-arrow la la-angle-right"></i></a>
                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_error_404-v1.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">404 - v1</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_error_404-v2.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">404 - v2</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_error_404-v3.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">404 - v3</span></a></li>
                        <li class="k-menu__item " aria-haspopup="true"><a href="custom_error_404-v4.html" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i><span class="k-menu__link-text">404 - v4</span></a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- begin:: Aside Footer -->
<div class="k-aside__footer		k-grid__item" id="k_aside_footer">
    <div class="k-aside__footer-nav">
        <div class="k-aside__footer-item">
            <a href="#" class="btn btn-icon"><i class="flaticon2-gear"></i></a>
        </div>
        <div class="k-aside__footer-item">
            <a href="#" class="btn btn-icon"><i class="flaticon2-cube"></i></a>
        </div>
        <div class="k-aside__footer-item">
            <a href="#" class="btn btn-icon"><i class="flaticon2-bell-alarm-symbol"></i></a>
        </div>
        <div class="k-aside__footer-item">
            <button type="button" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="flaticon2-add"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left">
                <ul class="k-nav">
                    <li class="k-nav__section k-nav__section--first">
                        <span class="k-nav__section-text">Export Tools</span>
                    </li>
                    <li class="k-nav__item">
                        <a href="#" class="k-nav__link">
                            <i class="k-nav__link-icon la la-print"></i>
                            <span class="k-nav__link-text">Print</span>
                        </a>
                    </li>
                    <li class="k-nav__item">
                        <a href="#" class="k-nav__link">
                            <i class="k-nav__link-icon la la-copy"></i>
                            <span class="k-nav__link-text">Copy</span>
                        </a>
                    </li>
                    <li class="k-nav__item">
                        <a href="#" class="k-nav__link">
                            <i class="k-nav__link-icon la la-file-excel-o"></i>
                            <span class="k-nav__link-text">Excel</span>
                        </a>
                    </li>
                    <li class="k-nav__item">
                        <a href="#" class="k-nav__link">
                            <i class="k-nav__link-icon la la-file-text-o"></i>
                            <span class="k-nav__link-text">CSV</span>
                        </a>
                    </li>
                    <li class="k-nav__item">
                        <a href="#" class="k-nav__link">
                            <i class="k-nav__link-icon la la-file-pdf-o"></i>
                            <span class="k-nav__link-text">PDF</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="k-aside__footer-item">
            <a href="#" class="btn btn-icon"><i class="flaticon2-calendar-2"></i></a>
        </div>
    </div>
</div>
