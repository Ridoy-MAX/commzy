<div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                <div class="bdrb1 pb15 mb30 d-sm-flex justify-content-between">
                  <h5 class="list-title">Awards</h5>
                  <a href="#" class="add-more-btn text-thm" data-bs-toggle="modal" href=''
                            data-bs-target="#awardModal"><i class="icon far fa-plus mr10"></i>Add Award</a>
                </div>

                @if(session('Awards'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('Awards') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="position-relative">
                  <div class="educational-quality">
                    @php
                         $awards = App\Models\Award::where('user_id', Auth::id())->get();
                        @endphp    
                    @foreach($awards as $award)     
                    <div class="m-circle text-thm">M</div>
                    <div class="wrapper mb40 position-relative">
                      <div class="del-edit">
                        <div class="d-flex">

                              <!-- edit education -->
                          <a href="#" type="button" class="icon me-2" data-bs-toggle="modal" data-bs-target="#awardedit{{ $award->id }}"  >
                            <span class="flaticon-pencil"></span>
                         </a>
                          <!-- edit modal -->
                          <div class="modal fade" id="awardedit{{ $award->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Award  edit</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                            
                                                <div class="col-xl">
                                                    <form class="form-style1" method="post" action="{{ route('award.update', $award->id) }}" >
                                                    @csrf
                                                        <div class="row">

                                                        <div class="mb20">
                                                            <label class="heading-color ff-heading fw500 mb10">Award Title</label>
                                                            <input type="text" name="award" class="form-control" placeholder="" value="{{ $award->award }}" required>
                                                        </div>
                                                        <div class="mb20">
                                                            <label class="heading-color ff-heading fw500 mb10">Institute Name</label>
                                                            <input type="text" name="institute" class="form-control" placeholder="" value="{{ $award->institute }}" required>
                                                        </div>
                                                        <div class="mb20">
                                                            <label class="heading-color ff-heading fw500 mb10">Description</label>
                                                            <textarea name="description" class="form-control" placeholder="Description" required>
                                                            {{ $award->description }}
                                                            </textarea>
                                                        </div>
                                                        <div class="mb20">
                                                            <label class="heading-color ff-heading fw500 mb10">Start Year</label>
                                                            <input type="number" name="start_year" class="form-control" placeholder="" 
                                                            value="{{ $award->start_year }}"  required>
                                                        </div>
                                                        <div class="mb20">
                                                            <label class="heading-color ff-heading fw500 mb10">End Year</label>
                                                            <input type="number" name="end_year" class="form-control" placeholder="" 
                                                            value="{{ $award->end_year }}"
                                                            required>
                                                        </div>
                                                            <div class="col-md-12">
                                                                <div class="text-start">
                                                                    <button class="ud-btn btn-thm" type="submit" >Save<i
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

                            <!-- Delete Button (Using Bootstrap Modal for Confirmation) -->
                            <a href="#" class="icon" data-bs-toggle="modal" data-bs-target="#awarddelete{{ $award->id }}">
                                <span class="flaticon-delete"></span>
                            </a>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="awarddelete{{ $award->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this experience record?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="ud-btn" data-bs-dismiss="modal">Cancel</button>
                                            <form method="post" action="{{ route('award.destroy', $award->id) }}">
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



                        </div>
                      </div>
                      <span class="tag">{{ $award->start_year }} - {{ $award->end_year }}</span>
                      <h5 class="mt15">{{ $award->award }}</h5>
                      <h6 class="text-thm">{{ $award->institute }}</h6>
                      <p>{{ $award->description }}</p>
                    </div>
                   
                    @endforeach
                  </div>
                 
                </div>
              </div>









              
                <!-- add  -->
                <div class="modal fade" id="awardModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Awards</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                
                                    <div class="col-xl">
                                        <form class="form-style1" method="post" action="{{ route('award.store') }}" >
                                        @csrf
                                            <div class="row">

                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw500 mb10">Award Title</label>
                                                <input type="text" name="award" class="form-control" placeholder="" required>
                                            </div>
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw500 mb10">Institute Name</label>
                                                <input type="text" name="institute" class="form-control" placeholder="" required>
                                            </div>
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw500 mb10">Description</label>
                                                <textarea name="description" class="form-control" placeholder="Description" required></textarea>
                                            </div>
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw500 mb10">Start Year</label>
                                                <input type="number" name="start_year" class="form-control" placeholder="" required>
                                            </div>
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw500 mb10">End Year</label>
                                                <input type="number" name="end_year" class="form-control" placeholder="" required>
                                            </div>
                                                <div class="col-md-12">
                                                    <div class="text-start">
                                                        <button class="ud-btn btn-thm" type="submit" >Save<i
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

