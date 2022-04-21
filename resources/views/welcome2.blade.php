@include('layouts.welcomeapp')
<header class="bg-primary bg-gradient text-white">
    <div class="container px-2 text-center">
        <h1 class="fw-bolder py-3">Welcome to EasyMilk</h1>
        <p class="lead">For better Management</p><br>
    </div>
</header>
<br>
<section id="about">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>About this page</h2>
                <p class="lead">EasyMilk is an online website for Milk delivery service management where
                    customers don't need to bring hardcopy of milk card. Using this website customers can just add their
                    liters.</p>

            </div>
        </div>
    </div>
</section>
<br>
<section class="bg-light" id="services">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Services we offer</h2>
                <ul>
                    <li>Monthly online bill via E-mail</li>
                    <li>Providing notes for customers and milkmen</li>
                    <li>SMS services</li>
                    <li>Both side verification</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<br>
<section id="contact">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Contact us</h2>

                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-9 mb-md-0 mb-5">
                        <form id="contact-form" name="contact-form" action="/home" method="POST">
                                @csrf
                            <!--Grid row-->
                            <div class="row">

                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="name" name="name" class="form-control">
                                        <label for="name" class="">Your name</label>
                                    </div>
                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="email" name="email" class="form-control">
                                        <label for="email" class="">Your email</label>
                                    </div>
                                </div>
                                <!--Grid column-->

                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                        <input type="text" id="subject" name="subject" class="form-control">
                                        <label for="subject" class="">Subject</label>
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row">

                                <!--Grid column-->
                                <div class="col-md-12">

                                    <div class="md-form">
                                        <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                        <label for="message">Your message</label>
                                    </div>

                                </div>
                            </div>
                            <!--Grid row-->
                            <div class="text-center text-md-left">
                                <button type="submit" class="btn btn-primary">SEND</button>
                            </div>
                        </form>


                        <div class="status"></div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-3 text-center">
                        <ul class="list-unstyled mb-0">
                            <li><i class="fas fa-map-marker-alt fa-2x"></i>
                                <p>Rajkot</p>
                            </li>

                            <li><i class="fas fa-phone mt-4 fa-2x"></i>
                                <p>+ 01 234 567 89</p>
                            </li>

                            <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                                <p>pindariyaneeta@gmail.com</p>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                </div>
            </div>
        </div>
    </div>
</section>
<br>
<footer class="py-2 bg-dark">
    <div class="container px-4">
        <p class="m-0 text-center text-white">Copyright &copy; EasyMilk <span id="current-year"></span></p>
    </div>
</footer>
<script>
    document.getElementById("current-year").innerHTML = new Date().getFullYear();
</script>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
