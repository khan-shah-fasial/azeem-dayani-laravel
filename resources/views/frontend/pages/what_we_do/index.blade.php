@extends('frontend.layouts.app')

@section('page.title', 'Saagar')

@section('page.description', 'description')

@section('page.type', 'website')

@section('page.content')

<main class="what_we_do_page">
    <section class="banner" id="what_we_do_banner">
        <div class="container ">
            <div class="banner_heading_div text-center">
                <h2 class="text-light banner_heading_text">What We Do</h2>
                <ul class="list-group list-unstyled list-group-horizontal banner_heading_breadcrumb">
                    <li class="list-group-item"><a href=""><i class="fa fa-house text-light"></i></a></li>
                    <li class="list-group-item"><a href="{{route('index')}}">Home</a></li> >
                    <li class="list-group-item">
                        <p class="mb-0">What We Do</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="white_section  partnership py-md-5 py-3 pb-4">
        <div class="container ">
            <div class="row align-items-md-center">
                <div class="col-md-7 pe-md-3">
                    <h2 class="col-md-12 product_heading text-start pb-md-3 float-start"><span class="our">Multi</span> Brand Partnership</h2>
                    <p class="fs-14 lh-20">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                        accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                        inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                    </p>

                    <p class="fs-14 lh-20">
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                        quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                        quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam
                        quaerat voluptatem. Ut enim ad minima veniam
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="right_img what_we_do_img ps-md-3" src="/assets/frontend/images/what-we-do/what_we_do_img.png">
                </div>
            </div>
        </div>
    </section>

    <section class="blue_section  partnership py-md-5 py-3 pt-4">
        <div class="container ">
            <div class="d-flex flex-md-row-reverse align-items-md-center flex-column pb-3">
                <div class="col-md-7 ps-md-3">
                    <h2 class="col-md-12 product_heading text-start pb-md-3 float-start text-light"><span class="our">Supply Chain </span> Management</h2>
                    <p class="fs-14 lh-20 text-light">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                        accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                        inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                    </p>

                    <p class="fs-14 lh-20 text-light">
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                        quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                        quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam
                        quaerat voluptatem. Ut enim ad minima veniam
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="right_img what_we_do_img pe-md-3" src="/assets/frontend/images/what-we-do/what_we_do_img.png">
                </div>
            </div>
        </div>

        <div class="container py-md-5 pt-md-4 py-3">
            <div class="row align-items-md-center">
                <div class="col-md-7 pe-md-3">
                    <h2 class="col-md-12 product_heading text-start pb-md-3 float-start text-light"><span class="our">Contract Manufacturing </span> <br> of Customized Products </h2>
                    <p class="fs-14 lh-20 text-light">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                        accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                        inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                    </p>

                    <p class="fs-14 lh-20 text-light">
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                        quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                        quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam
                        quaerat voluptatem. Ut enim ad minima veniam
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="right_img what_we_do_img ps-md-3" src="/assets/frontend/images/what-we-do/what_we_do_img.png">
                </div>
            </div>
        </div>
    </section>

    <section class="white_section  partnership py-md-5 py-3 pb-4">
        <div class="container">
            <div class="row align-items-md-center">
                <div class="col-md-7 pe-md-3">
                    <h2 class="col-md-12 product_heading text-start pb-md-3 float-start"><span class="our">Value </span> Addition</h2>
                    <p class="fs-14 lh-20">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                        accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                        inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                    </p>

                    <p class="fs-14 lh-20">
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                        quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                        quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam
                        quaerat voluptatem. Ut enim ad minima veniam
                    </p>
                </div>
                <div class="col-md-5 pb-3">
                    <img class="right_img what_we_do_img ps-md-3" src="/assets/frontend/images/what-we-do/what_we_do_img.png">
                </div>
            </div>
        </div>

        <div class="container py-md-5 pt-md-4 pt-2">
            <div class="d-flex flex-md-row-reverse align-items-md-center flex-column">
                <div class="col-md-7 ps-md-3">
                    <h2 class="col-md-12 product_heading text-start pb-md-3 float-start"><span class="our">Logistic </span>Support</h2>
                    <p class="fs-14 lh-20">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                        accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                        inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                    </p>

                    <p class="fs-14 lh-20">
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                        quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                        quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam
                        quaerat voluptatem. Ut enim ad minima veniam
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="right_img what_we_do_img pe-md-3" src="/assets/frontend/images/what-we-do/what_we_do_img.png">
                </div>
            </div>
        </div>
    </section>

</main>


@endsection