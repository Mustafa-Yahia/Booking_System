<link rel="stylesheet" href="{{ asset('css/contactus.css') }}">

@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
  <section class="contact-section">
    <div class="contact-bg">
      <h3>Get in Touch with Us</h3>
      <h2>Contact Us</h2>
      <div class="line">
        <div></div>
        <div></div>
        <div></div>
      </div>
      <p class="text">We value your feedback and are always ready to assist you. Whether you have a question, need support, or just want to say hello, we’re here for you.</p>
    </div>

    <div class="contact-body">
      <div class="contact-info">
        <div>
          <span><i class="fas fa-mobile-alt"></i></span>
          <span>Phone No.</span>
          <span class="text">1-2392-23928-2</span>
        </div>
        <div>
          <span><i class="fas fa-envelope-open"></i></span>
          <span>E-mail</span>
          <span class="text">mail@company.com</span>
        </div>
        <div>
          <span><i class="fas fa-map-marker-alt"></i></span>
          <span>Address</span>
          <span class="text">Amman, Jordan</span>
        </div>
        <div>
          <span><i class="fas fa-clock"></i></span>
          <span>Opening Hours</span>
          <span class="text">Monday - Friday (9:00 AM to 5:00 PM)</span>
        </div>
      </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      <div class="contact-form" >
        <form method="POST" action="{{ route('contact.store') }}">
            @csrf
          <div>
            <input type="text" class="form-control" placeholder="First Name" name="first_name">
            <input type="text" class="form-control" placeholder="Last Name" name="last_name">
          </div>
          <div>
            <input type="email" class="form-control" placeholder="E-mail" name="email">
            <input type="number" class="form-control" placeholder="Phone must start with 078/079/077" name="phone">
          </div>
          <textarea name="message" rows="5" placeholder="Message" class="form-control"></textarea>
          <div class="form-text">Max 500 charachers</div>
          <input type="submit" class="send-btn" value="Send Message">

        </form>

        <div>
          <img src="{{ asset('storage/images/index/images123.jpg') }}" alt="About Image" style="width: 400px">
        </div>
      </div>
    </div>

    <div class="map">
      {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d223700.1490386933!2d-97.11558670486288!3d28.829485511234168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864266db2e2dac3b%3A0xeee20d566f63267d!2sVictoria%2C%20TX%2C%20USA!5e0!3m2!1sen!2snp!4v1604921178092!5m2!1sen!2snp" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> --}}
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1844.0521558338373!2d35.74389699944346!3d32.04201560717643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca2aa6c9505af%3A0xc1d8fa75aade030f!2sSalt%20Institute%20for%20careers%20traditional%20crafts!5e0!3m2!1sen!2sjo!4v1741034368298!5m2!1sen!2sjo" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

  </section>
@endsection
