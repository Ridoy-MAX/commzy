@extends('layouts.dashboard')
@section('content')


        <div class="dashboard__content hover-bgc-color">
            <div class="row pb40">
                <div class="col-lg-12">
                @include('components.main_component.dashboard_navigation')
                </div>
            </div>
            <div class="row align-items-center justify-content-between ">

            @if(session('category'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('category') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('delete'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <x-input-error :messages="$errors->get('image')" class="mt-2 alert alert-danger" />


          
             
          
       
         

         <!-- Your user creation form goes here -->


          
                <div class="col-lg-3">
                    <div class="search_area dashboard-style m-2">
                        <h1>Category List</h1>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <div class="dashboard_title_area">
                     
                    </div>
                </div>
              
                <div class="col-lg-3">
                    <div class="text-lg-end">
                        <a class="ud-btn  default-box-shadow2" data-bs-toggle="modal" href=''
                            data-bs-target="#exampleModal" style="background-color: #E34A6F; color: white;">Create Category
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
                                        <th scope="col">Created By</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Category Image</th>
                                     
                                    
                                        <th scope="col">Created Date </th>
                                        <th scope="col">Actions </th>
                                    </tr>
                                </thead>
                                <tbody class="t-body">
                                @foreach($category as $key => $user)
                               

                                    <tr>
                                        <th scope="row"> #{{ $key + 1 }}</th>
                                        <td class="vam">
                                            {{ $user->rel_to_user->name }}
                                         
                                        </td>
                                        <td class="vam">{{ $user->name }}</td>
                                        <td class="vam">
                                            <img src="{{ asset( $user->image) }}" alt="Trust Image" style="width: 100px;  margin-right:10px;margin-top:10px;">
                                        </td>
                                     
                                   
                                        <td class="vam">
                                        {{ $user->created_at }}
                                        </td>

                                    <td class="vam ">
                                        <ul class="d-flex">
                                            <li> 
                                                <a href="#" class="view-user icon" data-bs-toggle="modal" data-bs-target="#exampleModal2{{ $key + 1 }}"
                                                    data-name="{{ $user->name }}" data-username="{{ $user->username }}" data-email="{{ $user->email }}">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>

                                                <div class="modal fade" id="exampleModal2{{ $key + 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">View Account</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="ps-widget bgc-white bdrs4 p30 overflow-hidden position-relative">
                                                                    <div class="col-xl">
                                                                        <form class="form-style1">
                                                                            <div class="row">
                                                                                <div class="mb20">
                                                                                    <label class="heading-color ff-heading fw500 mb10">Created By</label>
                                                                                    <p>   {{ $user->rel_to_user->name }}</p>
                                                                                </div>
                                                                                <div class="mb20">
                                                                                    <label class="heading-color ff-heading fw500 mb10">Category Name</label>
                                                                                    <p>{{ $user->name }}</p>
                                                                                </div>
                                                                                <div class="mb20">
                                                                                    <label class="heading-color ff-heading fw500 mb10">Title</label>
                                                                                    <p>{{ $user->title }}</p>
                                                                                </div>
                                                                                <div class="mb20">
                                                                                    <label class="heading-color ff-heading fw500 mb10">Description</label>
                                                                                    <p>{{ $user->descripton }}</p>
                                                                                </div>
                                                                                <div class="mb20">
                                                                                  
                                                                                    <img src="{{ asset( $user->image) }}" alt="Trust Image" style="width: 100px;  margin-right:10px;margin-top:10px;">
                                                                                </div>
                                                                             
                                                                             
                                                                                <div class="mb20">
                                                                                    <label class="heading-color ff-heading fw500 mb10">Created Date</label>
                                                                                    <p>{{ $user->created_at }} </p> 
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            
                                            </li>
                                            <li> 
                                                <a class="icon ms-2" href="" data-bs-toggle="modal" data-bs-target="#updateUserModal{{ $key + 1 }}" >
                                                    <i class="fa-regular fa-pen-to-square ms-2 me-2"></i>
                                                </a>

                                                   <!-- user edit  -->
                                              <!-- Update User Modal -->
                                                <div class="modal fade" id="updateUserModal{{ $key + 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update User</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="ps-widget bgc-white bdrs4 p30 overflow-hidden position-relative">
                                                                    <form class="form-style1" method="post" action="{{ route('category.update',['id' => $user->id]) }}"  enctype="multipart/form-data">
                                                                        @csrf
                                                                           <div class="row">
                                       
                                                                               <div class="mb20">
                                                                                   <label class="heading-color ff-heading fw500 mb10">Name</label>
                                                                                   <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="john">
                                                                                   <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                                               </div>

                                                                               <div class="mb20">
                                                                                <label class="heading-color ff-heading fw500 mb10">title</label>
                                                                                <input type="text" name="title" value="{{ $user->title }}" class="form-control" placeholder="">
                                                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                                            </div>

                                                                            <div class="mb20">
                                                                                <label class="heading-color ff-heading fw500 mb10">descripton</label>
                                                                                <input type="text" name="descripton" value="{{ $user->descripton }}" class="form-control" placeholder="">
                                                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                                            </div>
                                                                              
                                                                               <div class="mb20">
                                                                                   <label class="heading-color ff-heading fw500 mb10">Image</label>
                                                                                   <input type="file" name="image" class="form-control" >
                                                                                   <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                       
                                                                               </div>
                                                                             
                                                               
                                                                               <div class="col-md-12">
                                                                                   <div class="text-start">
                                                                                           <button class="ud-btn btn-thm" type="submit" >Update <i
                                                                                               class="fal fa-arrow-right-long"></i>
                                                                                           </button>
                                                                                   </div>
                                                                               </div>
                                                                           </div>
                                                                       </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            <li>
                                                 <a class="icon ms-2" ><i class="fa-regular fa-trash-can" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $key + 1 }}"></i></a>

                                                   <!-- Delete Button (Using Bootstrap Modal for Confirmation) -->
                                                   

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal{{ $key + 1 }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this category record?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="ud-btn" data-bs-dismiss="modal">Cancel</button>
                                                                <form method="post" action="{{ route('category.destroy', ['id' => $user->id]) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="ud-btn btn-thm" type="submit" >Delete<i
                                                                            class="fal fa-arrow-right-long"></i>
                                                                        </button>
                                                                
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                          
                                        </td>
                                    </tr>
                                @endforeach

                                  
                                 
                                </tbody>
                            </table>

                            <div class="mbp_pagination text-center mt30">
                             
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        
         <!-- Modal for Viewing User Details -->


        <!-- user add  -->
        <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                        
                            <div class="col-xl">
                                <form class="form-style1" method="post" action="{{ route('category.create') }}"  enctype="multipart/form-data">
                                 @csrf
                                    <div class="row">

                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="" required>
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Meta title</label>
                                            <input type="text" name="title" class="form-control" placeholder="" required>
                                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                        </div>
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Meta Description</label>
                                            <textarea type="text" name="descripton" class="form-control" placeholder="" required>
                                            </textarea>
                                            <x-input-error :messages="$errors->get('descripton')" class="mt-2" />
                                        </div>
                                       
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Image</label>
                                            <input type="file" name="image" class="form-control" required >
                                            <x-input-error :messages="$errors->get('image')" class="mt-2" />

                                        </div>
                                      
                        
                                        <div class="col-md-12">
                                            <div class="text-start">
                                                    <button class="ud-btn btn-thm" type="submit" >Create <i
                                                        class="fal fa-arrow-right-long"></i>
                                                    </button>
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
     





@endsection
@section('footer_script')


@endsection