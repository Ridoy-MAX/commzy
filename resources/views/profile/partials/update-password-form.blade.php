


            <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                <div class="bdrb1 pb15 mb25">
                  <h5 class="list-title">Change password</h5>
                  <p>Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <div class="col-lg-7">
                  <div class="row">
                    <form class="form-style1" method="post" action="{{ route('password.update') }}">
                            @csrf
                     @method('put')
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10">Current Password</label>
                            <input id="current_password" name="current_password" type="password"
                             class="form-control"  autocomplete="current-password" >
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />  
                        </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10">New Password</label>
                            <input id="password" name="password" class="form-control"  type="password" >
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10">Confirm New Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" >
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="text-start">
                            <button class="ud-btn btn-thm" >Change Password<i class="fal fa-arrow-right-long"></i></button>
                          </div>
                        </div>
                      </div>

                      @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </form>
                  </div>
                </div>
              </div>