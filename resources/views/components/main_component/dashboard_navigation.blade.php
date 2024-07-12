<div class="dashboard_navigationbar d-block d-lg-none">
                        <div class="dropdown">
                            <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i>
                                Dashboard Navigation</button>
                            <ul id="myDropdown" class="dropdown-content">
                                <div class="dashboard_sidebar_list">
                                    <p class="fz15 fw400 ff-heading pl30">Start</p>
                                    <div class="sidebar_list_item">
                                      <a href="{{ route('dashboard') }}" class="items-center {{ request()->routeIs('dashboard') ? '-is-active ' : '' }}"><i class="flaticon-home mr15"></i>Dashboard</a>
                                    </div>
                                    <div class="sidebar_list_item">
                                      <a href="{{ route('proposal')}}" class="items-center {{ request()->routeIs('proposal') ? '-is-active ' : '' }}"><i class="flaticon-document mr15"></i>My Proposals</a>
                                    </div>
                                    <div class="sidebar_list_item">
                                      <a href="{{ route('order')}}" class="items-center {{ request()->routeIs('order') ? '-is-active ' : '' }}">
                                        <i class="fa-solid fa-bars-staggered me-3"></i>My Orders</a>
                                    </div>
                          
                                  
                                    <div class="sidebar_list_item ">
                                      <a href="{{ route('message.inbox') }}" class="items-center"><i class="flaticon-chat mr15"></i>Message</a>
                                    </div>
                                    <div class="sidebar_list_item ">
                                      <a href="{{ route('reviews') }}" class="items-center {{ request()->routeIs('reviews') ? '-is-active ' : '' }}"><i class="flaticon-review-1 mr15"></i>Reviews</a>
                                    </div>
                                    <div class="sidebar_list_item">
                                      <a href="{{ route('invoice')}} " class="items-center {{ request()->routeIs('invoice') ? '-is-active ' : '' }}"><i class="flaticon-receipt mr15"></i>Invoice</a>
                                    </div>
                                    
                                    @canAny(['seller'])
                                    <div class="sidebar_list_item">
                                      <a href="{{ route('earning')}} " class="items-center {{ request()->routeIs('earning') ? '-is-active ' : '' }}"><i class="flaticon-web mr15"></i>Earnings</a>
                          
                                  
                                    </div>
                                    @endcan
                          
                               
                                    @canAny(['manage-service'])
                          
                          
                                    <div class="sidebar_list_item ">
                                      <a href="{{ route('service.view')}}" class="items-center {{ request()->routeIs('service') ? '-is-active ' : '' }}">
                                        <i class="flaticon-presentation mr15"></i>Manage Services</a>
                                    </div>
                                    <div class="sidebar_list_item ">
                                      <a href="{{ route('service.create')}}" class="items-center {{ request()->routeIs('service.create') ? '-is-active ' : '' }}">
                                        <i class="fa-brands fa-creative-commons-share me-3"></i>Create Services</a>
                                    </div>
                                    @endcan
                          
                                    <div class="sidebar_list_item">
                                      <a href="{{ route('support') }}" class="items-center {{ request()->routeIs('support') ? '-is-active ' : '' }}">
                                        <i class="fa-solid fa-headset me-3"></i>Support</a>
                                    </div>
                          
                                    @canAny(['role-permission'])
                                    <p class="fz15 fw400 ff-heading pl30 mt30">Role & Permission </p>
                                    <div class="sidebar_list_item">
                                      <a href="{{ route('role') }}" class="items-center {{ request()->routeIs('role') ? '-is-active ' : '' }}"><i class="fa-solid fa-capsules me-3"></i>Role</a>
                                    </div>
                          
                                    <div class="sidebar_list_item">
                                      <a href="{{ route('assign.role') }}" class="items-center {{ request()->routeIs('assign.role') ? '-is-active ' : '' }}"> <i class="fa-brands fa-gg-circle me-3"></i> Assign Role</a>
                                    </div>
                                    @endcan
                          
                                    @canAny(['create-users', 'edit-users', 'delete-users'])
                                      <p class="fz15 fw400 ff-heading pl30 mt30">Users </p>
                                      @can('create-users')
                                      <div class="sidebar_list_item">
                                        <a href="{{ route('userlist') }}" class="items-center {{ request()->routeIs('userlist') ? '-is-active ' : '' }}"><i class="fa-solid fa-user-group me-3"></i>Users List</a>
                                      </div>
                                      @endcan
                                      @can('block-users')
                                      <div class="sidebar_list_item">
                                        <a href="{{ route('blocklist') }}" class="items-center {{ request()->routeIs('blocklist') ? '-is-active ' : '' }}"> <i class="fa-solid fa-ban me-3"></i>  Block List</a>
                                      </div>
                                      @endcan
                                    @endcan
                          
                                    @canAny(['account-approval'])
                                    <p class="fz15 fw400 ff-heading pl30 mt30">Account approval</p>
                                    <div class="sidebar_list_item">
                                      <a href="{{ route('account.approval') }}" class="items-center {{ request()->routeIs('account.approval') ? '-is-active ' : '' }}">
                                        <i class="fa-solid fa-list me-3"></i>  Account approval List</a>
                                    </div>
                                    @endcan

                                    @canAny(['account-approval'])
                                    <p class="fz15 fw400 ff-heading pl30 mt30">Withdraw request </p>
                                    <div class="sidebar_list_item">
                                      <a href="{{ route('earning.request') }}" class="items-center {{ request()->routeIs('earning.request') ? '-is-active ' : '' }}">
                                        <i class="fa-solid fa-code-pull-request me-3"></i> Withdraw request List</a>
                                    </div>
                                    @endcan
                          
                          
                                    @canAny(['category-list'])
                                    <p class="fz15 fw400 ff-heading pl30 mt30">Category </p>
                                    <div class="sidebar_list_item">
                                      <a href="{{ route('category') }}" class="items-center {{ request()->routeIs('category') ? '-is-active ' : '' }}">
                                        <i class="fa-solid fa-list me-3"></i>  Category  List</a>
                                    </div>
                                    @endcan
                          
                          
                                    @canAny(['site-settings'])
                                      <p class="fz15 fw400 ff-heading pl30 mt30">Site setting</p>
                                      <div class="sidebar_list_item">
                                        <a href="{{ route('setting.privacy')}} " class="items-center {{ request()->routeIs('setting.privacy') ? '-is-active ' : '' }}"><i class="fa-solid fa-lock me-3"></i>Privacy policy</a>
                                      </div>
                                      <div class="sidebar_list_item">
                                        <a href="{{ route('setting.term')}} " class="items-center {{ request()->routeIs('setting.term') ? '-is-active ' : '' }}"><i class="fa-solid fa-server me-3"></i>Terms of Service</a>
                                      </div>
                                      <div class="sidebar_list_item">
                                        <a href="{{ route('setting.refund')}}" class="items-center {{ request()->routeIs('setting.refund') ? '-is-active ' : '' }}"><i class="fa-solid fa-rotate-left me-3"></i>Refund Policy</a>
                                      </div>
                                      <div class="sidebar_list_item">
                                        <a href="{{ route('setting.about')}}" class="items-center {{ request()->routeIs('setting.about') ? '-is-active ' : '' }}"><i class="fa-solid fa-circle-info me-3"></i>About Us</a>
                                      </div>
                                      <div class="sidebar_list_item">
                                        <a href="{{ route('setting.banner')}}" class="items-center {{ request()->routeIs('setting.banner') ? '-is-active ' : '' }}"><i class="fa-solid fa-vault me-3"></i>Banner Setting</a>
                                      </div>
                                      <div class="sidebar_list_item">
                                        <a href="{{ route('setting.general')}}" class="items-center {{ request()->routeIs('setting.general') ? '-is-active ' : '' }}"><i class="fa-solid fa-plus-minus me-3"></i>General Settings</a>
                                      </div>

                                      <div class="sidebar_list_item">
                                        <a href="{{ route('newsletter')}}" class="items-center {{ request()->routeIs('newsletter') ? '-is-active ' : '' }}">
                                          <i class="fa-solid fa-newspaper me-3"></i>News Letter</a>
                                      </div>
                                    @endcan
                                  </div>
                            </ul>
                        </div>
                    </div>