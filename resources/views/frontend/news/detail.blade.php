@extends('frontend.layouts.app')
@section('content')
    <!-- page title start -->
    <div class="breadcrumb-area bg-cover" style="background-image: url('/assets/frontend/img/bg/7.png');">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="page-title">{{ $news->title }}</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <ul class="page-list">
                            <li><a href="index.html">Home</a></li>
                            <li>Blog Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title end -->

    <!-- blog area start -->
    <div class="blog-area pd-top-120 pd-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-page-content">
                        <div class="single-blog-inner">
                            <div class="thumb">
                                <img src="{{ asset('storage/'. $news->image ) }}" alt="img">
                            </div>
                            <div class="details">
                                <ul class="blog-meta">
                                    <li><i class="far fa-user"></i> By Admin</li>
                                    <li><i class="far fa-folder-open"></i> Category</li>
                                </ul>
                                {!! $news->content !!}
                                <div class="tag-and-share">
                                    <div class="tags d-inline-block">
                                        <strong>Tag : </strong>
                                        <a href="#">Agency</a>
                                        <a href="#">Marketing</a>
                                    </div>
                                </div>
                                <div class="prev-next-post">
                                    <div class="row">
                                        <div class="col-6 border-right-1">
                                            <a class="btn btn-base border-radius-5" href="#">
                                                <i class="fas fa-chevron-left"></i>
                                            </a>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a class="btn btn-base border-radius-5" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-admin media">
                            <div class="media-left pe-3">
                                <img class="avatar" alt="img" src="assets/img/about/8.png"/>
                            </div>
                            <div class="media-body align-self-center">
                                <h6>Admin</h6>
                                <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful</p>
                            </div>
                        </div>
                        <div class="blog-comment">
                            <h4 class="mb-2">Leave a Reply</h4>
                            <p>Your E-mail address not be published</p>
                            <ul class="comment-list mt-lg-4 pt-2 mt-4">
                                <li class="comment">
                                    <article class="comment-body">
                                        <footer class="comment-meta">
                                            <div class="comment-author vcard">
                                                <img class="avatar" alt="img" src="assets/img/about/7.png"/> <a href="" rel="external nofollow ugc" class="url">John Κώστας Doe Τάδε</a> <span class="says">says:</span>
                                            </div>
                                            <div class="comment-metadata">
                                                <a href="#">March 14, 2013 at 7:57 am</a>
                                                <span class="edit-link">
                                                    <a class="comment-edit-link" href="#">Edit</a>
                                                </span>
                                            </div>
                                        </footer>
                                        <div class="comment-content">
                                            <p>Comment Depth 01</p>
                                        </div>
                                        <div class="reply">
                                            <a rel="nofollow" class="comment-reply-link" href="#">Reply</a>
                                        </div>
                                    </article>
                                </li>
                                <li class="comment">
                                    <article class="comment-body">
                                        <footer class="comment-meta">
                                            <div class="comment-author vcard">
                                                <img class="avatar" alt="img" src="assets/img/about/7.png"/><a href="http://example.org/" rel="external nofollow ugc" class="url">John Κώστας Doe Τάδε</a> <span class="says">says:</span>
                                            </div>
                                            <div class="comment-metadata">
                                                <a href="#">March 14, 2013 at 7:57 am</a>
                                                <span class="edit-link">
                                                    <a class="comment-edit-link" href="#">Edit</a>
                                                </span>
                                            </div>
                                        </footer>
                                        <div class="comment-content">
                                            <p>Comment Depth 01</p>
                                        </div>
                                        <div class="reply">
                                            <a rel="nofollow" class="comment-reply-link" href="#">Reply</a>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                        </div>
                        <form class="blog-comment-form">
                            <div class="mb-3">
                                <h4>Leave a Reply</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="single-input-inner style-bg">
                                        <input type="text" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-input-inner style-bg">
                                        <input type="text" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input-inner style-bg">
                                        <textarea placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-base border-radius-5">Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="td-sidebar">
                        <div class="widget widget_author text-center">
                            <div class="thumb">
                                <img src="assets/img/about/7.png" alt="img">
                            </div>
                            <div class="details">
                                <h5>Leslie Alexander</h5>
                                <h6>(480) 555-0103</h6>
                                <ul class="social-media">
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget widget_search">
                            <form class="search-form">
                                <div class="form-group">
                                    <input type="text" placeholder="Key word">
                                </div>
                                <button class="submit-btn" type="submit"><i class="fas fa-chevron-right"></i></button>
                            </form>
                        </div>
                        <div class="widget widget-recent-post">
                            <h4 class="widget-title">Recent News</h4>
                            <ul>
                                <li>
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="assets/img/widget/1.png" alt="blog">
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="title"><a href="blog-details.html">Empowering future with solar.</a></h6>
                                            <div class="post-info"><i class="far fa-calendar-alt"></i><span>15 October</span></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="assets/img/widget/2.png" alt="blog">
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="title"><a href="blog-details.html">Marketing For Base market watch</a></h6>
                                            <div class="post-info"><i class="far fa-calendar-alt"></i><span>15 October</span></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="assets/img/widget/3.png" alt="blog">
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="title"><a href="blog-details.html">Condtum Integer urna at faucibus</a></h6>
                                            <div class="post-info"><i class="far fa-calendar-alt"></i><span>15 October</span></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="widget widget_catagory">
                            <h4 class="widget-title">Catagory</h4>
                            <ul class="catagory-items">
                                <li><a href="blog.html">Business <span>3</span></a></li>
                                <li><a href="blog.html">Finance <span>7</span></a></li>
                                <li><a href="blog.html">Web Design <span>2</span></a></li>
                                <li><a href="blog.html">Counsiling <span>3</span></a></li>
                                <li><a href="blog.html">IT Service <span>5</span></a></li>
                            </ul>
                        </div>
                        <div class="widget widget_tag_cloud mb-0">
                            <h4 class="widget-title">Tags</h4>
                            <div class="tagcloud">
                                <a href="#">Information</a>
                                <a href="#">Learn</a>
                                <a href="#">ICT</a>
                                <a href="#">Business</a>
                                <a href="#">Portfolio</a>
                                <a href="#">Project</a>
                                <a href="#">Personal</a>
                                <a href="#">Server</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
