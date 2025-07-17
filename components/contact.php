<section id="contact" class="contact">
  <div class="container">
    <h2>Contact Us</h2>
    <form id="contactForm" method="POST" action="form-handler.php">
      <div class="form-group">
        <input type="text" name="first_name" placeholder="First Name *" required />
        <input type="text" name="last_name" placeholder="Last Name *" required />
      </div>
      <div class="form-group">
        <input type="email" name="email" placeholder="Email *" required />
        <input type="tel" name="phone" placeholder="Phone Number" />
      </div>
      <div class="form-group">
        <textarea name="comments" placeholder="Comments *" required></textarea>
      </div>
      <button type="submit">Submit</button>
    </form>

    <!-- Google Maps Embed -->
    <div class="map">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.58112214217!2d79.7825049021328!3d6.931974408880202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259f37e9b5461%3A0x33c178c4387ac2e!2seBEYONDS!5e0!3m2!1sen!2slk!4v1691234567890"
        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
      </iframe>
    </div>
  </div>
</section>
