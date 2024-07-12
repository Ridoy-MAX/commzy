@extends('layouts.dashboard')
@section('content')
<div class="dashboard__content hover-bgc-color">
  <div class="row pb40">
    <div class="col-lg-12">
    @include('components.main_component.dashboard_navigation')
    </div>
</div>
    <div class="row pb40">
      <div class="col-lg-12">
        <div class="dashboard_title_area">
          <h2>Messages</h2>
          <p class="text">Communicate with your team.</p>
        </div>
      </div>
    </div>
    <div class="row mb40">
      <div class="col-lg-6 col-xl-5 col-xxl-4">
        <div class="message_container">
          <div class="inbox_user_list">
            <div class="iu_heading pr35">
              <div class="chat_user_search">
                <form class="d-flex align-items-center">
                  <button class="btn" type="submit"><span class="far fa-magnifying-glass"></span></button>
                  <input class="form-control" type="search" placeholder="Serach" aria-label="Search">
                </form>
              </div>
            </div>
            <div class="chat-member-list pr20" style="">
             @foreach ($users as $item)
                <div class="list-item">
                    <a href="{{ route('open.conversation', $item->username) }}">
                        <div class="d-flex align-items-center position-relative">
                            <img class="img-fluid float-start rounded-circle mr10" style="border-radius: 50%; height: 50px" width="40px" src="{{ asset($item->profile_pic) }}" alt="ms3.png">
                            <div class="d-sm-flex">
                                <div class="d-inline-block">
                                    <div class="fz15 fw500 dark-color ff-heading mb-0">{{ $item->name }}</div>
                                    <p class="preview">
                                        @if (isset($item->display_name))
                                            {{ $item->display_name }}
                                        @else
                                            {{ $item->username }}
                                        @endif
                                    </p>
                                </div>
                                <div class="iul_notific">
                                <small>35 mins</small>
                                <div class="m_notif online">2</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
             @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-xl-7 col-xxl-8">
        <div class="message_container mt30-md">
            <div class="m-4">
                <h3>Start A Conversation</h3>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
