@extends('layouts.dashboard')
@section('content')

<style>
.permission-lis{
    height: 600px;
   overscroll-behavior-y: scroll;
}
.permission-list::-webkit-scrollbar {
  width: 1em;
}
 
.permission-list::-webkit-scrollbar-track {
  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}
 
.permission-list::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}
</style>

        <div class="dashboard__content hover-bgc-color">
            <div class="row pb40">
                <div class="col-lg-12">
                @include('components.main_component.dashboard_navigation')
                </div>
            </div>
            <div class="row align-items-center justify-content-between ">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

           
                <div class="row align-items-center justify-content-between ">
                    <div class="col-lg-6">
                        <div class="dashboard_title_area">
                            <h2>Role List</h2>
    
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-lg-end">
                            <a href="" class="ud-btn  default-box-shadow2" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"  style="background-color: #E34A6F; color: white;">Create Role
                                <i class="fa-regular fa-square-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="ps-widget bgc-white bdrs4 p30 mb60 overflow-hidden position-relative">
                            <div class="packages_table table-responsive">
                                <table class="table-style3 table at-savesearch">
                                    <thead class="t-head">
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Role Name</th>
                                            <th scope="col">Permission</th>
                                            <th scope="col">Guard Name</th>
                                        
                                        
                                            <th scope="col">Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody class="t-body">
                                        
                                        @foreach ($roles as $key => $role)
                                        <tr>
                                            <th scope="row"> #{{ $key+1 }}</th>
                                            <td class="vam">{{ $role->name }}</td>
                                            <td class="vam">
                                             @foreach ($role->permissions as $permission)
                                                <span>{{ $permission->name }}</span>,
                                             @endforeach
                                            </td>
                                           
                                          
                                            
                                            <td class="vam">
                                                {{ $role->guard_name }}
                                            </td>
                                          
                                            <td class="vam ">


                                                <div class="d-flex">
                                                    @if($role->name != 'Super Admin' && $role->name != 'Users')
                                                    @csrf
                                                    @method('DELETE')
                                                  
                                                    <li> 
                                                        <a class="icon" href="" data-bs-toggle="modal" data-bs-target="#exampleModal1{{ $role->id }}" ><i
                                                                class="fa-regular fa-pen-to-square ms-2 me-2"></i>
                                                        </a>
                                                    </li>
    
                                                    <form action="{{ route('roles.delete', $role->id) }}" id="delete{{ $role->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <li class="float-end"> 
                                                            <a class="icon ms-2" href="" type="submit" onclick="event.preventDefault(); document.getElementById('delete{{ $role->id }}').submit();" class="remove">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </a>
                                                        </li>
                                                     </form>
    
    
                                                    @endif

                                                </div>
                                             
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="exampleModal1{{ $role->id }}" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Role</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                                           
                                                            <form class="form-style1" action="{{ route('roles.update', $role->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                        
                                                                    <div class="mb20">
                                                                        <label class="heading-color ff-heading fw500 mb10">Role Name</label>
                                                                        <input type="text" class="form-control"  name="role_name" id="text" value="{{ $role->name }}">
                                                                    </div>
                                                                    <label class="mb-2" for="textarea">Permission</label>
                                                                   

                                                                      @foreach ($permissions as $key=> $permission)
                                                                        <div class="mb-3">
                                                                            <div>
                                                                            <input class="checkbox" type="checkbox" name="permission[]" value="{{ $permission->name }}" @if ($role->hasPermissionTo($permission)) checked @endif id="check-{{ $key }}">
                                                                                <label for="check-{{ $key }}">
                                                                                    <span class="checkbox-text">
                                                                                        {{ $permission->name }}
                                                                                    </span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    
                                                                     
                                                              
                                        
                                                                 
                                                                   
                                                              
                                                                    
                                                                      <div class="col-md-12">
                                                                        <div class="text-start">
                                                                            <button type="submit" class="ud-btn btn-thm" href="page-contact.html">Update Role<i
                                                                                    class="fal fa-arrow-right-long"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                       
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mbp_pagination text-center mt30">
                                    <ul class="page_navigation">
                                        @for ($i = 1; $i <= $roles->lastPage(); $i++)
                                            <li class="page-item {{ ($roles->currentPage() == $i) ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $roles->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                    </ul>
                                    <p class="mt10 mb-0 pagination_page_count text-center">
                                        {{ $roles->firstItem() }} – {{ $roles->lastItem() }} of {{ $roles->total() }} records
                                    </p>
                                </div>
    
                            </div>
                        </div>
    
                    </div>
                </div>


          

            </div>
           
        </div>

        
         <!-- Modal for Viewing  Details -->


      
     
  <!-- user add  -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Role</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                   
                    <div class="col-xl">
                        <form class="form-style1"  action="{{ route('store.role') }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="mb20">
                                    <label class="heading-color ff-heading fw500 mb10">Role Name</label>
                                    <input type="text" class="form-control"  name="role_name" placeholder="">
                                </div>
                               
                                <label class="heading-color ff-heading fw500 mb10">Permission</label>

                                <div class="permission-list" >

                                    @foreach ($permissions as $key => $permission)
                                    <div class="checkbox-style1 d-block d-sm-flex align-items-center justify-content-between mb20 scroll">
                                        <label class="custom_checkbox fz14 ff-heading"> {{ $permission->name }}
                                            <input type="checkbox" name="permission[]" value="{{ $permission->name }}" id="check-{{ $key }}">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    @endforeach

                                </div>

                           
                            
                             
                          

                             
                               
                          
                                <div class="col-md-12">
                                    <div class="text-start">
                                        <button type="submit" class="ud-btn btn-thm" >
                                            Create Role
                                            <i  class="fal fa-arrow-right-long"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
<!-- role edit  -->





@endsection
@section('footer_script')


@endsection