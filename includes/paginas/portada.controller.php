<?php

    class PortadaController {
        static function pintar() {

            return "
                <!-- Masthead-->
            <header class=\"masthead bg-primary text-white text-center\">
                <div class=\"container d-flex align-items-center flex-column\">
                    <!-- Masthead Avatar Image-->
                    <img class=\"masthead-avatar mb-5\" src=\"".BASE_URL."/assets/plantilla/assets/img/avataaars.svg\" alt=\"...\" />
                    <!-- Masthead Heading-->
                    <h1 class=\"masthead-heading text-uppercase mb-0\">Start Bootstrap</h1>
                    <!-- Icon Divider-->
                    <div class=\"divider-custom divider-light\">
                        <div class=\"divider-custom-line\"></div>
                        <div class=\"divider-custom-icon\"><i class=\"fas fa-star\"></i></div>
                        <div class=\"divider-custom-line\"></div>
                    </div>
                    <!-- Masthead Subheading-->
                    <p class=\"masthead-subheading font-weight-light mb-0\">Graphic Artist - Web Designer - Illustrator</p>
                </div>
            </header>

            <!-- Portfolio Section-->
            <section class=\"page-section portfolio\" id=\"portfolio\">
                <div class=\"container\">
                    <h2 class=\"page-section-heading text-center text-uppercase text-secondary mb-0\">Portfolio</h2>

                    <div class=\"divider-custom\">
                        <div class=\"divider-custom-line\"></div>
                        <div class=\"divider-custom-icon\"><i class=\"fas fa-star\"></i></div>
                        <div class=\"divider-custom-line\"></div>
                    </div>

                    <div class=\"row justify-content-center\">

                        <div class=\"col-md-6 col-lg-4 mb-5\">
                            <div class=\"portfolio-item mx-auto\" data-bs-toggle=\"modal\" data-bs-target=\"#portfolioModal1\">
                                <div class=\"portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100\">
                                    <div class=\"portfolio-item-caption-content text-center text-white\"><i class=\"fas fa-plus fa-3x\"></i></div>
                                </div>
                                <img class=\"img-fluid\" src=\"".BASE_URL."/assets/plantilla/assets/img/portfolio/cabin.png\" alt=\"...\" />
                            </div>
                        </div>

                        <div class=\"col-md-6 col-lg-4 mb-5\">
                            <div class=\"portfolio-item mx-auto\" data-bs-toggle=\"modal\" data-bs-target=\"#portfolioModal2\">
                                <div class=\"portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100\">
                                    <div class=\"portfolio-item-caption-content text-center text-white\"><i class=\"fas fa-plus fa-3x\"></i></div>
                                </div>
                                <img class=\"img-fluid\" src=\"".BASE_URL."/assets/plantilla/assets/img/portfolio/cake.png\" alt=\"...\" />
                            </div>
                        </div>

                        <div class=\"col-md-6 col-lg-4 mb-5\">
                            <div class=\"portfolio-item mx-auto\" data-bs-toggle=\"modal\" data-bs-target=\"#portfolioModal3\">
                                <div class=\"portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100\">
                                    <div class=\"portfolio-item-caption-content text-center text-white\"><i class=\"fas fa-plus fa-3x\"></i></div>
                                </div>
                                <img class=\"img-fluid\" src=\"".BASE_URL."/assets/plantilla/assets/img/portfolio/circus.png\" alt=\"...\" />
                            </div>
                        </div>

                        <div class=\"col-md-6 col-lg-4 mb-5 mb-lg-0\">
                            <div class=\"portfolio-item mx-auto\" data-bs-toggle=\"modal\" data-bs-target=\"#portfolioModal4\">
                                <div class=\"portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100\">
                                    <div class=\"portfolio-item-caption-content text-center text-white\"><i class=\"fas fa-plus fa-3x\"></i></div>
                                </div>
                                <img class=\"img-fluid\" src=\"".BASE_URL."/assets/plantilla/assets/img/portfolio/game.png\" alt=\"...\" />
                            </div>
                        </div>

                        <div class=\"col-md-6 col-lg-4 mb-5 mb-md-0\">
                            <div class=\"portfolio-item mx-auto\" data-bs-toggle=\"modal\" data-bs-target=\"#portfolioModal5\">
                                <div class=\"portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100\">
                                    <div class=\"portfolio-item-caption-content text-center text-white\"><i class=\"fas fa-plus fa-3x\"></i></div>
                                </div>
                                <img class=\"img-fluid\" src=\"".BASE_URL."/assets/plantilla/assets/img/portfolio/safe.png\" alt=\"...\" />
                            </div>
                        </div>

                        <div class=\"col-md-6 col-lg-4\">
                            <div class=\"portfolio-item mx-auto\" data-bs-toggle=\"modal\" data-bs-target=\"#portfolioModal6\">
                                <div class=\"portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100\">
                                    <div class=\"portfolio-item-caption-content text-center text-white\"><i class=\"fas fa-plus fa-3x\"></i></div>
                                </div>
                                <img class=\"img-fluid\" src=\"".BASE_URL."/assets/plantilla/assets/img/portfolio/submarine.png\" alt=\"...\" />
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- About Section-->
            <section class=\"page-section bg-primary text-white mb-0\" id=\"about\">
                <div class=\"container\">
                    <h2 class=\"page-section-heading text-center text-uppercase text-white\">About</h2>

                    <div class=\"divider-custom divider-light\">
                        <div class=\"divider-custom-line\"></div>
                        <div class=\"divider-custom-icon\"><i class=\"fas fa-star\"></i></div>
                        <div class=\"divider-custom-line\"></div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col-lg-4 ms-auto\"><p class=\"lead\">Freelancer is a free bootstrap theme created by Start Bootstrap...</p></div>
                        <div class=\"col-lg-4 me-auto\"><p class=\"lead\">You can create your own custom avatar...</p></div>
                    </div>

                    <div class=\"text-center mt-4\">
                        <a class=\"btn btn-xl btn-outline-light\" href=\"https://startbootstrap.com/theme/freelancer/\">
                            <i class=\"fas fa-download me-2\"></i>
                            Free Download!
                        </a>
                    </div>
                </div>
            </section>

            <!-- Contact Section-->
            <section class=\"page-section\" id=\"contact\">
                <div class=\"container\">
                    <h2 class=\"page-section-heading text-center text-uppercase text-secondary mb-0\">Contact Me</h2>

                    <div class=\"divider-custom\">
                        <div class=\"divider-custom-line\"></div>
                        <div class=\"divider-custom-icon\"><i class=\"fas fa-star\"></i></div>
                        <div class=\"divider-custom-line\"></div>
                    </div>

                    <div class=\"row justify-content-center\">
                        <div class=\"col-lg-8 col-xl-7\">

                            <form id=\"contactForm\" data-sb-form-api-token=\"API_TOKEN\">
                                <div class=\"form-floating mb-3\">
                                    <input class=\"form-control\" id=\"name\" type=\"text\" placeholder=\"Enter your name...\" data-sb-validations=\"required\" />
                                    <label for=\"name\">Full name</label>
                                    <div class=\"invalid-feedback\" data-sb-feedback=\"name:required\">A name is required.</div>
                                </div>

                                <div class=\"form-floating mb-3\">
                                    <input class=\"form-control\" id=\"email\" type=\"email\" placeholder=\"name@example.com\" data-sb-validations=\"required,email\" />
                                    <label for=\"email\">Email address</label>
                                    <div class=\"invalid-feedback\" data-sb-feedback=\"email:required\">An email is required.</div>
                                    <div class=\"invalid-feedback\" data-sb-feedback=\"email:email\">Email is not valid.</div>
                                </div>

                                <div class=\"form-floating mb-3\">
                                    <input class=\"form-control\" id=\"phone\" type=\"tel\" placeholder=\"(123) 456-7890\" data-sb-validations=\"required\" />
                                    <label for=\"phone\">Phone number</label>
                                    <div class=\"invalid-feedback\" data-sb-feedback=\"phone:required\">A phone number is required.</div>
                                </div>

                                <div class=\"form-floating mb-3\">
                                    <textarea class=\"form-control\" id=\"message\" placeholder=\"Enter your message here...\" style=\"height: 10rem\" data-sb-validations=\"required\"></textarea>
                                    <label for=\"message\">Message</label>
                                    <div class=\"invalid-feedback\" data-sb-feedback=\"message:required\">A message is required.</div>
                                </div>

                                <div class=\"d-none\" id=\"submitSuccessMessage\">
                                    <div class=\"text-center mb-3\">
                                        <div class=\"fw-bolder\">Form submission successful!</div>
                                        To activate this form, sign up at
                                        <br />
                                        <a href=\"https://startbootstrap.com/solution/contact-forms\">https://startbootstrap.com/solution/contact-forms</a>
                                    </div>
                                </div>

                                <div class=\"d-none\" id=\"submitErrorMessage\">
                                    <div class=\"text-center text-danger mb-3\">Error sending message!</div>
                                </div>

                                <button class=\"btn btn-primary btn-xl disabled\" id=\"submitButton\" type=\"submit\">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            ";
        }
    }