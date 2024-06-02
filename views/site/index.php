
<html lang="en">

<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="page-bg-image-lg header-fixed header-tablet-and-mobile-fixed">

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                <!--begin::Container-->
                <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start">
                    <!--begin::Post-->
                    <div class="content flex-row-fluid" id="kt_content">
                        <!--begin::Hero-->
                        <div class="bgi-no-repeat bgi-position-center bgi-size-cover d-flex flex-column h-400px h-lg-500px">
                            <div id="kt_carousel_1_carousel" class="carousel carousel-custom slide" data-bs-ride="carousel" data-bs-interval="8000">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <!--begin::Label-->
                                    <span class="fs-4 fw-bold pe-2">Title</span>
                                    <!--end::Label-->

                                    <!--begin::Carousel Indicators-->
                                    <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                                        <li data-bs-target="#kt_carousel_1_carousel" data-bs-slide-to="0" class="ms-1 active"></li>
                                        <li data-bs-target="#kt_carousel_1_carousel" data-bs-slide-to="1" class="ms-1"></li>
                                        <li data-bs-target="#kt_carousel_1_carousel" data-bs-slide-to="2" class="ms-1"></li>
                                    </ol>
                                    <!--end::Carousel Indicators-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Carousel-->
                                <div class="carousel-inner pt-8">
                                    <!--begin::Item-->
                                    <div class="carousel-item active">
                                        <?php
                                        $data = Yii::$app->activiteClass->listeActivites()['0'];
                                        // die(var_dump($data));
                                        echo'
                                          <img  src="' . yii::$app->request->baseUrl . '/web/assets/media/uploads/photo/' . $data['photo'] . '"">
                                       ';
                                       ?>
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="carousel-item">
                                        ...
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="carousel-item">
                                        ...
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Carousel-->
                            </div>

                        </div>
                        <!--end::Hero-->
                        <!--begin::Svg-->
                        <div class="mt-n15 text-page-bg">
                            <svg width="100%" height="56px" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" class="">
                                <path d="M0,0 C16.6666667,66 33.3333333,99 50,99 C66.6666667,99 83.3333333,66 100,0 L100,100 L0,100 L0,0 Z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <!--end::Svg-->
                        <!--begin::Container navigationnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn-->
                        <div class="container">
                            <!--begin::Card-->
                            <div class="card translate-middle-y mt-n10 mt-lg-n10">
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <!--begin::Nav-->
                                    <ul class="nav mx-auto flex-shrink-0 flex-center flex-wrap border-transparent fs-6 fw-bold">

                                        <!--begin::Nav item-->
                                        <li class="nav-item my-3">
                                            <a class="btn btn-active-light-primary fw-bolder nav-link btn-color-gray-700 px-3 px-lg-8 mx-1 text-uppercase active" href="../../demo2/dist/apps/support-center/tutorials/list.html">Accueil</a>
                                        </li>
                                        <!--end::Nav item-->
                                        <!--begin::Nav item-->
                                        <li class="nav-item my-3">
                                            <a class="btn btn-active-light-primary fw-bolder nav-link btn-color-gray-700 px-3 px-lg-8 mx-1 text-uppercase" href="../../demo2/dist/apps/support-center/faq.html">Activites</a>
                                        </li>
                                        <!--end::Nav item-->
                                        <!--begin::Nav item-->
                                        <li class="nav-item my-3">
                                            <a class="btn btn-active-light-primary fw-bolder nav-link btn-color-gray-700 px-3 px-lg-8 mx-1 text-uppercase" href="../../demo2/dist/apps/support-center/licenses.html">Membre</a>
                                        </li>
                                        <!--end::Nav item-->
                                        <!--begin::Nav item-->
                                        <li class="nav-item my-3">
                                            <a class="btn btn-active-light-primary fw-bolder nav-link btn-color-gray-700 px-3 px-lg-8 mx-1 text-uppercase" href="../../demo2/dist/apps/support-center/contact.html">Contactez-nous</a>
                                        </li>
                                        <!--end::Nav item-->
                                    </ul>
                                    <!--end::Nav-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Container-->
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Home card-->
                            <div class="card">
                                <!--begin::Body-->
                                <div class="card-body p-10 p-lg-15">

                                    <!--begin::Section-->
                                    <div class="mb-17">
                                        <!--begin::Content-->
                                        <div class="d-flex flex-stack mb-5">
                                            <!--begin::Title-->
                                            <h3 class="text-dark">Activités Recéntes</h3>


                                            <!--end::Link-->
                                        </div>
                                        <!--end::Content-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed mb-9"></div>
                                        <!--end::Separator-->
                                        <!--begin::Row-->
                                        <div class="row g-10">
                                            <!--begin::Col-->
                                            <div class="col-md-4">
                                                <!--begin::Feature post-->
                                                <div class="card-xl-stretch me-md-6">
                                                    <!--begin::Image-->
                                                    <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5" style="background-image:url('assets/media/stock/600x400/img-73.jpg')" data-fslightbox="lightbox-video-tutorials" href="https://www.youtube.com/embed/btornGtLwIo">
                                                        <img src="assets/media/svg/misc/video-play.svg" class="position-absolute top-50 start-50 translate-middle" alt="" />
                                                    </a>
                                                    <!--end::Image-->
                                                    <!--begin::Body-->
                                                    <div class="m-0">
                                                        <!--begin::Title-->
                                                        <a href="../../demo2/dist/pages/user-profile/overview.html" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">Admin Panel - How To Started the Dashboard Tutorial</a>
                                                        <!--end::Title-->
                                                        <!--begin::Text-->
                                                        <div class="fw-semibold fs-5 text-gray-600 text-dark my-4">We’ve been focused on making a the from also not been afraid to and step away been focused create eye</div>
                                                        <!--end::Text-->
                                                        <!--begin::Content-->
                                                        <div class="fs-6 fw-bold">
                                                            <!--begin::Author-->
                                                            <a href="../../demo2/dist/pages/user-profile/overview.html" class="text-gray-700 text-hover-primary">Jane Miller</a>
                                                            <!--end::Author-->
                                                            <!--begin::Date-->
                                                            <span class="text-muted">on Mar 21 2021</span>
                                                            <!--end::Date-->
                                                        </div>
                                                        <!--end::Content-->
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Feature post-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-4">
                                                <!--begin::Feature post-->
                                                <div class="card-xl-stretch mx-md-3">
                                                    <!--begin::Image-->
                                                    <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5" style="background-image:url('assets/media/stock/600x400/img-74.jpg')" data-fslightbox="lightbox-video-tutorials" href="https://www.youtube.com/embed/btornGtLwIo">
                                                        <img src="assets/media/svg/misc/video-play.svg" class="position-absolute top-50 start-50 translate-middle" alt="" />
                                                    </a>
                                                    <!--end::Image-->
                                                    <!--begin::Body-->
                                                    <div class="m-0">
                                                        <!--begin::Title-->
                                                        <a href="../../demo2/dist/pages/user-profile/overview.html" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">Admin Panel - How To Started the Dashboard Tutorial</a>
                                                        <!--end::Title-->
                                                        <!--begin::Text-->
                                                        <div class="fw-semibold fs-5 text-gray-600 text-dark my-4">We’ve been focused on making the from v4 to v5 but we have also not been afraid to step away been focused</div>
                                                        <!--end::Text-->
                                                        <!--begin::Content-->
                                                        <div class="fs-6 fw-bold">
                                                            <!--begin::Author-->
                                                            <a href="../../demo2/dist/pages/user-profile/overview.html" class="text-gray-700 text-hover-primary">Cris Morgan</a>
                                                            <!--end::Author-->
                                                            <!--begin::Date-->
                                                            <span class="text-muted">on Apr 14 2021</span>
                                                            <!--end::Date-->
                                                        </div>
                                                        <!--end::Content-->
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Feature post-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-4">
                                                <!--begin::Feature post-->
                                                <div class="card-xl-stretch ms-md-6">
                                                    <!--begin::Image-->
                                                    <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5" style="background-image:url('assets/media/stock/600x400/img-47.jpg')" data-fslightbox="lightbox-video-tutorials" href="https://www.youtube.com/embed/TWdDZYNqlg4">
                                                        <img src="assets/media/svg/misc/video-play.svg" class="position-absolute top-50 start-50 translate-middle" alt="" />
                                                    </a>
                                                    <!--end::Image-->
                                                    <!--begin::Body-->
                                                    <div class="m-0">
                                                        <!--begin::Title-->
                                                        <a href="../../demo2/dist/pages/user-profile/overview.html" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">Admin Panel - How To Started the Dashboard Tutorial</a>
                                                        <!--end::Title-->
                                                        <!--begin::Text-->
                                                        <div class="fw-semibold fs-5 text-gray-600 text-dark my-4">We’ve been focused on making the from v4 to v5 but we’ve also not been afraid to step away been focused</div>
                                                        <!--end::Text-->
                                                        <!--begin::Content-->
                                                        <div class="fs-6 fw-bold">
                                                            <!--begin::Author-->
                                                            <a href="../../demo2/dist/pages/user-profile/overview.html" class="text-gray-700 text-hover-primary">Carles Nilson</a>
                                                            <!--end::Author-->
                                                            <!--begin::Date-->
                                                            <span class="text-muted">on May 14 2021</span>
                                                            <!--end::Date-->
                                                        </div>
                                                        <!--end::Content-->
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Feature post-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Section-->
                                    <div class="mb-17">
                                        <!--begin::Content-->
                                        <div class="d-flex flex-stack mb-5">
                                            <!--begin::Title-->
                                            <h3 class="text-dark">QUELQUES MEMBRES</h3>
                                            <!--end::Title-->
                                            <!--begin::Link-->
                                            <a href="#" class="fs-6 fw-semibold link-primary">View All Offers</a>
                                            <!--end::Link-->
                                        </div>
                                        <!--end::Content-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed mb-9"></div>
                                        <!--end::Separator-->
                                        <!--begin::Row-->
                                        <div class="row g-10">
                                            <!--begin::Col-->
                                            <div class="col-md-4">
                                                <!--begin::Hot sales post-->
                                                <div class="card-xl-stretch me-md-6">
                                                    <!--begin::Overlay-->
                                                    <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/600x400/img-23.jpg">
                                                        <!--begin::Image-->
                                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/600x400/img-23.jpg')"></div>
                                                        <!--end::Image-->
                                                        <!--begin::Action-->
                                                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                            <i class="bi bi-eye-fill fs-2x text-white"></i>
                                                        </div>
                                                        <!--end::Action-->
                                                    </a>
                                                    <!--end::Overlay-->
                                                    <!--begin::Body-->
                                                    <div class="mt-5">
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">25 Products Mega Bundle with 50% off discount amazing</a>
                                                        <!--end::Title-->
                                                        <!--begin::Text-->
                                                        <div class="fw-semibold fs-5 text-gray-600 text-dark mt-3">We’ve been focused on making a the from also not been eye</div>
                                                        <!--end::Text-->
                                                        <!--begin::Text-->
                                                        <div class="fs-6 fw-bold mt-5 d-flex flex-stack">
                                                            <!--begin::Label-->
                                                            <span class="badge border border-dashed fs-2 fw-bold text-dark p-2">
                                                                <span class="fs-6 fw-semibold text-gray-400">$</span>28</span>
                                                            <!--end::Label-->
                                                            <!--begin::Action-->
                                                            <a href="#" class="btn btn-sm btn-primary">Purchase</a>
                                                            <!--end::Action-->
                                                        </div>
                                                        <!--end::Text-->
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Hot sales post-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-4">
                                                <!--begin::Hot sales post-->
                                                <div class="card-xl-stretch mx-md-3">
                                                    <!--begin::Overlay-->
                                                    <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/600x600/img-14.jpg">
                                                        <!--begin::Image-->
                                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/600x600/img-14.jpg')"></div>
                                                        <!--end::Image-->
                                                        <!--begin::Action-->
                                                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                            <i class="bi bi-eye-fill fs-2x text-white"></i>
                                                        </div>
                                                        <!--end::Action-->
                                                    </a>
                                                    <!--end::Overlay-->
                                                    <!--begin::Body-->
                                                    <div class="mt-5">
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">25 Products Mega Bundle with 50% off discount amazing</a>
                                                        <!--end::Title-->
                                                        <!--begin::Text-->
                                                        <div class="fw-semibold fs-5 text-gray-600 text-dark mt-3">We’ve been focused on making a the from also not been eye</div>
                                                        <!--end::Text-->
                                                        <!--begin::Text-->
                                                        <div class="fs-6 fw-bold mt-5 d-flex flex-stack">
                                                            <!--begin::Label-->
                                                            <span class="badge border border-dashed fs-2 fw-bold text-dark p-2">
                                                                <span class="fs-6 fw-semibold text-gray-400">$</span>27</span>
                                                            <!--end::Label-->
                                                            <!--begin::Action-->
                                                            <a href="#" class="btn btn-sm btn-primary">Purchase</a>
                                                            <!--end::Action-->
                                                        </div>
                                                        <!--end::Text-->
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Hot sales post-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-4">
                                                <!--begin::Hot sales post-->
                                                <div class="card-xl-stretch ms-md-6">
                                                    <!--begin::Overlay-->
                                                    <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/600x400/img-71.jpg">
                                                        <!--begin::Image-->
                                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/600x400/img-71.jpg')"></div>
                                                        <!--end::Image-->
                                                        <!--begin::Action-->
                                                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                            <i class="bi bi-eye-fill fs-2x text-white"></i>
                                                        </div>
                                                        <!--end::Action-->
                                                    </a>
                                                    <!--end::Overlay-->
                                                    <!--begin::Body-->
                                                    <div class="mt-5">
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">25 Products Mega Bundle with 50% off discount amazing</a>
                                                        <!--end::Title-->
                                                        <!--begin::Text-->
                                                        <div class="fw-semibold fs-5 text-gray-600 text-dark mt-3">We’ve been focused on making a the from also not been eye</div>
                                                        <!--end::Text-->
                                                        <!--begin::Text-->
                                                        <div class="fs-6 fw-bold mt-5 d-flex flex-stack">
                                                            <!--begin::Label-->
                                                            <span class="badge border border-dashed fs-2 fw-bold text-dark p-2">
                                                                <span class="fs-6 fw-semibold text-gray-400">$</span>25</span>
                                                            <!--end::Label-->
                                                            <!--begin::Action-->
                                                            <a href="#" class="btn btn-sm btn-primary">Purchase</a>
                                                            <!--end::Action-->
                                                        </div>
                                                        <!--end::Text-->
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Hot sales post-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::latest instagram-->
                                    <div class="">
                                        <!--begin::Section-->
                                        <div class="m-0">
                                            <!--begin::Content-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::Title-->
                                                <h3 class="text-dark">AUTRES IMAGES</h3>
                                                <!--end::Title-->
                                                <!--begin::Link-->
                                                <a href="#" class="fs-6 fw-semibold link-primary">View Instagram</a>
                                                <!--end::Link-->
                                            </div>
                                            <!--end::Content-->
                                            <!--begin::Separator-->
                                            <div class="separator separator-dashed border-gray-300 mb-9 mt-5"></div>
                                            <!--end::Separator-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Row-->
                                        <div class="row g-10 row-cols-2 row-cols-lg-5">
                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Overlay-->
                                                <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/900x600/16.jpg">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/900x600/16.jpg')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="bi bi-eye-fill fs-2x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Overlay-->
                                                <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/900x600/13.jpg">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/900x600/13.jpg')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="bi bi-eye-fill fs-2x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Overlay-->
                                                <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/900x600/19.jpg">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/900x600/19.jpg')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="bi bi-eye-fill fs-2x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Overlay-->
                                                <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/900x600/15.jpg">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/900x600/15.jpg')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="bi bi-eye-fill fs-2x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Overlay-->
                                                <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/900x600/12.jpg">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/900x600/12.jpg')"></div>
                                                    <!--end::Image-->
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="bi bi-eye-fill fs-2x text-white"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--begin::Row-->
                                    </div>
                                    <!--end::latest instagram-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Home card-->
                        </div>
                        <!--end::Container-->

                        <!--end::Modal - Support Center - Create Ticket-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Container-->
                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2022&copy;</span>
                            <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                            <li class="menu-item">
                                <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->



</body>
<!--end::Body-->

</html>