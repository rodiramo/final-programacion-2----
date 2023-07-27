<!--contact form-->
<section id="formHolder" class="container-form">
    <h1>CONTACT US</h1>
    <div class="row">

        <div class="col-sm-6 form">

            <div class="contact form-peice">
                <form class="contact-form" action="index.php?s=contact-post" method="post">
                    <div class="form-group">
                        <label for="name">Your Name*</label>
                        <input type="text" name="name" id="name" placeholder="Jane" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email Address*</label>
                        <input type="email" name="emailAdress" id="email" placeholder="Doe" class="email">
                        <span class="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message*</label>
                        <textarea id="message" name="message" placeholder="Leave your Message" required></textarea>
                    </div>

                    <div class="CTA">
                        <input class="button" type="submit" value="Contact">
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>