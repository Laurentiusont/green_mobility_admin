@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row gy-4 text-center">
  <!-- Congratulations card -->
  <div class="col-md-12 col-lg-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">Hi [ name ]! 👋🏻</h4>
        <!-- <p class="pb-0">Best seller of the month🎉</p>
        <h4 class="text-primary mb-1">$42.8k</h4>
        <p class="mb-2 pb-1">78% of target 🚀</p>
        <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
      </div>
      <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
    </div>
  </div>
  <!--/ Congratulations card -->
  <div class="col-md-12 col-lg-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">Welcome to Green Mobility 🎉</h4>
        <!-- <p class="pb-0">Best seller of the month🎉</p>
        <h4 class="text-primary mb-1">$42.8k</h4>
        <p class="mb-2 pb-1">78% of target 🚀</p>
        <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
      </div>
      <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
    </div>
  </div>
  <div class="col-md-12 col-lg-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">Get to Know This App Better ✨</h4>
        <!-- <p class="pb-0">Best seller of the month🎉</p>
        <h4 class="text-primary mb-1">$42.8k</h4>
        <p class="mb-2 pb-1">78% of target 🚀</p>
        <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
      </div>
      <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
    </div>
  </div>
  
  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">Empowering Sustainable Urban Mobility</h4>
        <p class="pb-0">In the face of growing urban challenges, Green Mobility Hub emerges as a beacon of innovation and sustainability. We understand that modern cities need integrated solutions to tackle transportation inefficiencies and environmental concerns. Our platform brings together cutting-edge solutions to transform urban mobility, enhance the quality of life, and contribute to a greener planet.</p>
        <!-- <h4 class="text-primary mb-1">$42.8k</h4> -->
        <!-- <p class="mb-2 pb-1">78% of target 🚀</p> -->
        <!-- <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
      </div>
      <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
    </div>
  </div>

  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">Integrated Solutions for a Better Urban Experience</h4>
        <!-- <p class="pb-0">In the face of growing urban challenges, Green Mobility Hub emerges as a beacon of innovation and sustainability. We understand that modern cities need integrated solutions to tackle transportation inefficiencies and environmental concerns. Our platform brings together cutting-edge solutions to transform urban mobility, enhance the quality of life, and contribute to a greener planet.</p> -->
        <!-- <h4 class="text-primary mb-1">$42.8k</h4> -->
        <!-- <p class="mb-2 pb-1">78% of target 🚀</p> -->
        <!-- <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
      </div>
      <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
    </div>
  </div>

  <div class="col-md-12 col-lg-3">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">Green Transportation</h4>
        <p class="pb-0">Plan eco-friendly journeys with public transport and bike lanes. See carbon emission estimates for each route.
        Impact: Encourages a shift to greener transport, reducing carbon emissions and air pollution. Make informed decisions for a cleaner, healthier city.</p>
        <!-- <h4 class="text-primary mb-1">$42.8k</h4> -->
        <!-- <p class="mb-2 pb-1">78% of target 🚀</p> -->
        <!-- <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
      </div>
      <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
    </div>
  </div>

  <div class="col-md-12 col-lg-3">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">Smart Parking</h4>
        <p class="pb-0">Find and manage parking spaces effortlessly with our interactive map.
        Impact: Save time and reduce stress in finding parking, improve traffic flow, and optimize the use of existing parking spaces.</p>
        <!-- <h4 class="text-primary mb-1">$42.8k</h4> -->
        <!-- <p class="mb-2 pb-1">78% of target 🚀</p> -->
        <!-- <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
      </div>
      <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
    </div>
  </div>

  <div class="col-md-12 col-lg-3">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">Vehicle Emissions Monitoring</h4>
        <p class="pb-0">Track your vehicle's carbon emissions during trips. Enter kilometers traveled, and our system calculates estimated emissions.
        Impact: Raise awareness of your environmental impact and make sustainable transportation choices to reduce your carbon footprint.</p>
        <!-- <h4 class="text-primary mb-1">$42.8k</h4> -->
        <!-- <p class="mb-2 pb-1">78% of target 🚀</p> -->
        <!-- <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
      </div>
      <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
    </div>
  </div>

  <div class="col-md-12 col-lg-3">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">User Engagement through Sustainable Promotions</h4>
        <p class="pb-0">Earn rewards for using green transportation options like cycling, public transport, or electric vehicles.
        Impact: Promote sustainable transport choices, increase user engagement, and educate about the importance of reducing carbon emissions. Collaborate with business partners for mutual environmental and social benefits.</p>
        <!-- <h4 class="text-primary mb-1">$42.8k</h4> -->
        <!-- <p class="mb-2 pb-1">78% of target 🚀</p> -->
        <!-- <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
      </div>
      <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
    </div>
  </div>
  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">Join Us in Shaping a Sustainable Future</h4>
        <p class="pb-0">Green Mobility Hub is more than just a platform—it's a movement towards a smarter, greener, and more efficient urban environment. By integrating advanced solutions and fostering community engagement, we are paving the way for a more sustainable urban landscape. Together, we can reduce traffic congestion, improve air quality, and enhance the overall quality of life in our cities.</p>
        <!-- <h4 class="text-primary mb-1">$42.8k</h4> -->
        <!-- <p class="mb-2 pb-1">78% of target 🚀</p> -->
        <!-- <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
      </div>
      <!-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> -->
    </div>
  </div>

</div>
@endsection
