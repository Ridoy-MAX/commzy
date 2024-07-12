


             <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                <div class="col-lg-7">
                  <div class="row">
                    <div class="bdrb1 pb15 mb25">
                      <h5 class="list-title">Close account</h5>
                      <p class="text">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                    </div>

                    <a class="ud-btn  default-box-shadow2" data-bs-toggle="modal" href=''
                            data-bs-target="#exampleModal" style="background-color: #E34A6F; color: white;">Close Account
                            <i class="fa-regular fa-square-plus"></i>
                    </a>

                

                  
                    
               
                  </div>
                </div>
              </div>








              <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Acccount</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                        
                            <div class="col-xl">
                            <form class="form-style1" method="post" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('delete')
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Enter Password</label>
                                        <input  
                                            id="password"
                                            name="password"
                                            type="password"
                                            class="form-control" 
                                            placeholder="********">
                                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                    </div>
                                    <div class="text-start">
                                    <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-secondary-button>

                                            <x-danger-button class="ml-3 ud-btn btn-thm">
                                                {{ __('Delete Account') }}
                                            </x-danger-button>
                                    </div>
                                                    
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
     