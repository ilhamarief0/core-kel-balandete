    <!-- footer area start -->
    <footer class="footer-area footer-area-2 bg-gray mt-0 pd-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="widget widget_about">
                             <div class="logo-container d-flex align-items-center">
                            <a href="/" class="logo-link animated-logo">
                                <img src="{{ asset('storage/'. $websiteIcon) }}" alt="{{ $websiteName }} Icon" class="website-icon" style="width: 35px; height: 40px; margin-right: 10px;">
                                <span class="website-name">{{ $websiteName }}</span>
                            </a>
                        </div>
                        <div class="details">
                            <p>{{ $websiteDescription }}</p>
                            <div class="subscribe mt-4">
                                <input type="text" placeholder="E-mail">
                                <button><i class="fas fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 ps-xl-5">
                    <div class="widget widget_nav_menu">
                        <h4 class="widget-title">Our Service</h4>
                        <ul>
                          @foreach ($serviceList as $serviceLists)
                          <li><a href="{{ route('service.index', Str::slug($serviceLists->title)) }}"><i class="fas fa-chevron-right"></i> {{ $serviceLists->title }}</a></li>
                          @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 ps-xl-5">
                    <div class="widget widget_nav_menu">
                        <h4 class="widget-title">Latest News</h4>
                        <ul>
                          @foreach ($newsList as $newsLists)
                          <li><a href="{{ route('news.detail', Str::slug($newsLists->title)) }}"><i class="fas fa-chevron-right"></i>{{ $newsLists->title }}</a></li>
                          @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget widget-recent-post">
                        <h4 class="widget-title">Contact us</h4>
                        <div class="widget widget_contact">
                            <ul class="details">
                                <li><i class="fa fa-map-marker-alt"></i>{{ $websiteSetting->website_address  }}</li>
                                <li class="mt-3"><i class="fa fa-phone-alt"></i>{{ $websiteSetting->website_phone }}</li>
                                <li class="mt-2"><i class="fas fa-envelope"></i>{{ $websiteSetting->website_email }}</li>
                            </ul>
                            <ul class="social-media mt-4">
                              @if ($websiteSetting->website_facebook)
                              <li>
                                  <a href="{{ $websiteSetting->website_facebook }}">
                                      <i class="fab fa-facebook-f"></i>
                                  </a>
                              </li>
                              @endif
                              @if ($websiteSetting->website_x)
                              <li>
                                  <a href="{{ $websiteSetting->website_x }}">
                                       <i class="fab fa-x-twitter"></i>
                                  </a>
                              </li>
                              @endif
                              @if ($websiteSetting->website_instagram)
                              <li>
                                  <a href="{{ $websiteSetting->website_instagram }}">
                                      <i class="fab fa-instagram"></i>
                                  </a>
                              </li>
                              @endif
                              @if ($websiteSetting->website_youtube)
                              <li>
                                  <a href="{{ $websiteSetting->website_youtube }}">
                                      <i class="fab fa-youtube"></i>
                                  </a>
                              </li>
                              @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p>© {{ $websiteName }}  2025 | All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->
