    <!-- ic_student_menubar start -->
    <div class="ic_student_menubar ">
        <!-- ic_logo_details -->
        <div class="ic_logo_details">

            <div class="ic-logo-wrapper">
                <img class="img-fluid ic_logo" src="{{ asset('assets/admin/images/itclan.png') }}" alt="">
            </div>
        </div>

        <div class="ic-all-nav-list">

            <div class="ic-nav-list-wrapper">
                <h5 class="ic-nav-title">General</h5>
                <ul class="ic-nav-list">
                    <li class="ic-nav-item-wrapper ">
                        <a class="ic_menubar_item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <svg class="ic_icon" width="20" height="21" viewBox="0 0 20 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.3333 11.3325V17.1667C18.3333 17.6269 17.9602 18 17.5 18H10.8333V11.3325H18.3333ZM9.16663 11.3325V18H2.49996C2.03973 18 1.66663 17.6269 1.66663 17.1667V11.3325H9.16663ZM9.16663 3V9.66583H1.66663V3.83333C1.66663 3.3731 2.03973 3 2.49996 3H9.16663ZM17.5 3C17.9602 3 18.3333 3.3731 18.3333 3.83333V9.66583H10.8333V3H17.5Z"
                                    fill="#90ADD9" />
                            </svg>
                            <span class="links_name">Dashboard</span>
                        </a>
                    </li>

                    <li
                        class="ic-nav-item-wrapper has-dropdown dropdown-btn {{ Request::routeIs('admin.roles.index') || Request::routeIs('admin.roles.create') || Request::routeIs('admin.roles.edit') || Request::routeIs('admin.users.index') || Request::routeIs('admin.users.create') || Request::routeIs('admin.users.edit') || Request::routeIs('admin.users.show') || Request::routeIs('admin.new-admin.index') || Request::routeIs('admin.new-admin.create') || Request::routeIs('admin.new-admin.edit') || Request::routeIs('admin.new-admin.show') || Request::routeIs('admin.roles.create') || Request::routeIs('admin.roles.edit') ? 'icon-active' : ' ' }}">
                        <a class="ic_menubar_item {{ Request::routeIs('admin.roles.index') || Request::routeIs('admin.roles.create') || Request::routeIs('admin.roles.edit') || Request::routeIs('admin.users.index') || Request::routeIs('admin.users.create') || Request::routeIs('admin.users.edit') || Request::routeIs('admin.users.show') || Request::routeIs('admin.new-admin.index') || Request::routeIs('admin.new-admin.create') || Request::routeIs('admin.new-admin.edit') || Request::routeIs('admin.new-admin.show') || Request::routeIs('admin.roles.create') || Request::routeIs('admin.roles.edit') ? 'active' : ' ' }}"
                            href="javascript: void(0);">
                            <svg class="ic_icon" width="25" height="21" viewBox="0 0 20 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.33337 18.8333C3.33337 17.0652 4.03575 15.3695 5.286 14.1193C6.53624 12.869 8.23193 12.1667 10 12.1667C11.7682 12.1667 13.4638 12.869 14.7141 14.1193C15.9643 15.3695 16.6667 17.0652 16.6667 18.8333H15C15 17.5072 14.4733 16.2355 13.5356 15.2978C12.5979 14.3601 11.3261 13.8333 10 13.8333C8.67396 13.8333 7.40219 14.3601 6.46451 15.2978C5.52682 16.2355 5.00004 17.5072 5.00004 18.8333H3.33337ZM10 11.3333C7.23754 11.3333 5.00004 9.09583 5.00004 6.33333C5.00004 3.57083 7.23754 1.33333 10 1.33333C12.7625 1.33333 15 3.57083 15 6.33333C15 9.09583 12.7625 11.3333 10 11.3333ZM10 9.66667C11.8417 9.66667 13.3334 8.175 13.3334 6.33333C13.3334 4.49167 11.8417 3 10 3C8.15837 3 6.66671 4.49167 6.66671 6.33333C6.66671 8.175 8.15837 9.66667 10 9.66667Z"
                                    fill="#91ADD9" />
                            </svg>
                            <span class="links_name">Administration</span>
                        </a>

                        <ul class="ic-sub-menu"
                            style="{{ in_array(request()->route()->getName(), ['admin.roles.index', 'admin.roles.create', 'admin.roles.edit', 'admin.users.index', 'admin.users.create', 'admin.users.edit', 'admin.users.show', 'admin.new-admin.index', 'admin.new-admin.create', 'admin.new-admin.edit', 'admin.new-admin.show']) ? 'display:block;' : 'display:none;' }}">
                            @hasexactroles('Super-Admin')
                                @can(['All Roles', 'Create Role', 'Edit Role', 'Delete Role'])
                                    <li
                                        class="{{ Request::routeIs('admin.roles.index') || Request::routeIs('admin.roles.create') ? 'active' : '' }}">
                                        <a href="{{ route('admin.roles.index') }}" class="menu-item">Role List</a>
                                    </li>
                                @endcan

                                @can(['All Admins', 'Create Admin', 'Edit Admin', 'Delete Admin'])
                                    <li
                                        class="{{ Request::routeIs('admin.new-admin.index') || Request::routeIs('admin.new-admin.create') || Request::routeIs('admin.new-admin.edit') ? 'active' : '' }}">
                                        <a href="{{ route('admin.new-admin.index') }}" class="menu-item">Admin List</a>
                                    </li>
                                @endcan
                            @endhasexactroles
                            @can(['All Users', 'Create User', 'Edit User', 'Delete User'])
                                <li
                                    class="{{ Request::routeIs('admin.users.index') || Request::routeIs('admin.users.create') || Request::routeIs('admin.users.edit') ? 'active' : '' }}">
                                    <a href="{{ route('admin.users.index') }}" class="menu-item">Users List</a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                </ul>
            </div>

            <div class="ic-nav-list-wrapper">
                <h5 class="ic-nav-title">Support</h5>
                <ul class="ic-nav-list">
                    <li class="ic-nav-item-wrapper ">
                        <a class="ic_menubar_item {{ Request::routeIs('admin.application.settings') ? 'active' : '' }}"
                            href="{{ route('admin.application.settings') }}">
                            <svg class="ic_icon" width="25" height="21" viewBox="0 0 20 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.78338 14.6667C2.43111 14.0575 2.15727 13.4062 1.96838 12.7283C2.37947 12.5193 2.72471 12.2005 2.96591 11.8074C3.2071 11.4143 3.33485 10.9621 3.33503 10.5009C3.3352 10.0397 3.20779 9.58746 2.96689 9.19417C2.72598 8.80088 2.38098 8.4819 1.97005 8.2725C2.34675 6.91041 3.06399 5.66663 4.05422 4.65834C4.44096 4.90978 4.88973 5.04931 5.35087 5.06149C5.812 5.07367 6.26751 4.95803 6.66699 4.72737C7.06647 4.4967 7.39435 4.16 7.61432 3.75454C7.8343 3.34907 7.93781 2.89065 7.91338 2.43C9.28181 2.07636 10.7177 2.07693 12.0859 2.43167C12.0617 2.89231 12.1654 3.35066 12.3855 3.75601C12.6057 4.16136 12.9337 4.4979 13.3332 4.72839C13.7328 4.95888 14.1883 5.07433 14.6494 5.06196C15.1106 5.0496 15.5592 4.90991 15.9459 4.65834C16.4284 5.15 16.8567 5.70917 17.2167 6.33334C17.5775 6.95751 17.8476 7.60834 18.0317 8.27167C17.6206 8.48076 17.2754 8.79948 17.0342 9.19259C16.793 9.5857 16.6652 10.0379 16.6651 10.4991C16.6649 10.9603 16.7923 11.4125 17.0332 11.8058C17.2741 12.1991 17.6191 12.5181 18.0301 12.7275C17.6534 14.0896 16.9361 15.3334 15.9459 16.3417C15.5591 16.0902 15.1104 15.9507 14.6492 15.9385C14.1881 15.9263 13.7326 16.042 13.3331 16.2726C12.9336 16.5033 12.6058 16.84 12.3858 17.2455C12.1658 17.6509 12.0623 18.1094 12.0867 18.57C10.7183 18.9237 9.28236 18.9231 7.91422 18.5683C7.93842 18.1077 7.83471 17.6493 7.61457 17.244C7.39442 16.8386 7.06642 16.5021 6.66686 16.2716C6.2673 16.0411 5.81176 15.9257 5.35066 15.938C4.88955 15.9504 4.44085 16.0901 4.05422 16.3417C3.56171 15.8391 3.13471 15.2763 2.78338 14.6667ZM7.50005 14.83C8.38807 15.3422 9.05576 16.1642 9.37505 17.1383C9.79088 17.1775 10.2084 17.1783 10.6242 17.1392C10.9437 16.1649 11.6117 15.3429 12.5001 14.8308C13.3877 14.3172 14.4338 14.1496 15.4376 14.36C15.6792 14.02 15.8876 13.6575 16.0609 13.2783C15.3771 12.5145 14.9993 11.5252 15.0001 10.5C15.0001 9.45 15.3917 8.46917 16.0609 7.72167C15.8863 7.34263 15.6771 6.98053 15.4359 6.64001C14.4328 6.85026 13.3874 6.6829 12.5001 6.17C11.612 5.65781 10.9443 4.83582 10.6251 3.86167C10.2092 3.8225 9.79172 3.82167 9.37588 3.86084C9.05638 4.83513 8.38839 5.65714 7.50005 6.16917C6.61237 6.68277 5.56628 6.85044 4.56255 6.64001C4.32135 6.98024 4.11266 7.34239 3.93922 7.72167C4.62303 8.48547 5.00079 9.47483 5.00005 10.5C5.00005 11.55 4.60838 12.5308 3.93922 13.2783C4.11378 13.6574 4.323 14.0195 4.56422 14.36C5.56731 14.1497 6.61272 14.3171 7.50005 14.83ZM10.0001 13C9.33701 13 8.70112 12.7366 8.23228 12.2678C7.76344 11.7989 7.50005 11.163 7.50005 10.5C7.50005 9.83696 7.76344 9.20108 8.23228 8.73224C8.70112 8.2634 9.33701 8.00001 10.0001 8.00001C10.6631 8.00001 11.299 8.2634 11.7678 8.73224C12.2367 9.20108 12.5001 9.83696 12.5001 10.5C12.5001 11.163 12.2367 11.7989 11.7678 12.2678C11.299 12.7366 10.6631 13 10.0001 13ZM10.0001 11.3333C10.2211 11.3333 10.433 11.2455 10.5893 11.0893C10.7456 10.933 10.8334 10.721 10.8334 10.5C10.8334 10.279 10.7456 10.067 10.5893 9.91075C10.433 9.75447 10.2211 9.66667 10.0001 9.66667C9.77904 9.66667 9.56707 9.75447 9.41079 9.91075C9.25451 10.067 9.16672 10.279 9.16672 10.5C9.16672 10.721 9.25451 10.933 9.41079 11.0893C9.56707 11.2455 9.77904 11.3333 10.0001 11.3333Z"
                                    fill="#91ADD9" />
                            </svg>
                            <span class="links_name">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

    </div>
    <!-- ic_student_menubar end -->
