<!-- footer section start -->
<div class="footer_section layout_padding">
   <div class="container">
   <div class="input_btn_main">
    <!-- Step 1: Email Input -->
    <input type="email" id="footer_email" class="mail_text" placeholder="Enter your email" required>
    <div class="subscribe_bt" id="send_email_btn"><a href="#">Send Mail</a></div>

    <!-- Step 2: Message Form (hidden initially) -->
    <form id="footer_message_form" action="{{ route('send.footer.mail') }}" method="POST" style="display: none; margin-top: 10px;">
        @csrf
        <input type="hidden" name="email" id="hidden_email">
        <textarea name="message" class="mail_text" placeholder="Enter your message" rows="3" required></textarea>
        <button type="submit" class="subscribe_bt">Send</button>
    </form>
</div>

      <div class="location_main">
         <!-- Phone Section -->
         <div class="call_text">
            <img src="{{ asset('images/call-icon.png') }}" alt="Call Icon">
         </div>
         <div class="call_text">
            @auth
               <a href="tel:{{ Auth::user()->phone }}">Call {{ Auth::user()->phone }}</a>
            @else
               <a href="tel:+011234567890">Call +01 1234567890</a>
            @endauth
         </div>

         <!-- Email Section -->
         <div class="call_text">
            <img src="{{ asset('images/mail-icon.png') }}" alt="Mail Icon">
         </div>
         <div class="call_text">
            @auth
               <a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a>
            @else
               <a href="mailto:demo@gmail.com">demo@gmail.com</a>
            @endauth
         </div>
      </div>

      <!-- Social Icons -->
      <div class="social_icon">
         <ul>
            <li><a href="#"><img src="{{ asset('images/fb-icon.png') }}" alt="Facebook Icon"></a></li>
            <li><a href="#"><img src="{{ asset('images/twitter-icon.png') }}" alt="Twitter Icon"></a></li>
            <li><a href="#"><img src="{{ asset('images/linkedin-icon.png') }}" alt="LinkedIn Icon"></a></li>
            <li><a href="#"><img src="{{ asset('images/instagram-icon.png') }}" alt="Instagram Icon"></a></li>
         </ul>
      </div>
   </div>
</div>
<!-- footer section end -->

<!-- copyright section start -->
<div class="copyright_section">
   <div class="container">
      <p class="copyright_text">
         2020 All Rights Reserved. Design by 
         <a href="https://html.design" target="_blank">Free HTML Templates</a>
      </p>
   </div>
</div>
<!-- copyright section end -->

<!-- Javascript files-->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.0.0.min.js') }}"></script>
<script src="{{ asset('js/plugin.js') }}"></script>
<!-- sidebar -->
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<!-- javascript --> 
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<script>
document.getElementById('send_email_btn').addEventListener('click', function(e) {
    e.preventDefault();

    var emailInput = document.getElementById('footer_email').value.trim();

    if(emailInput === '') {
        alert('Please enter your email first!');
        return;
    }

    // Set the hidden input in the message form
    document.getElementById('hidden_email').value = emailInput;

    // Hide the email input/button
    document.getElementById('footer_email').style.display = 'none';
    document.getElementById('send_email_btn').style.display = 'none';

    // Show the message form
    document.getElementById('footer_message_form').style.display = 'block';
});
</script>
