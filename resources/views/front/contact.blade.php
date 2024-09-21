
<section id="contact" class="py-5">
    <div class="heading text-center">
      <h2><span class="fw-bold">تواصل معنا </span> </h2>
      <p class="text-muted mx-auto fw-bolder">يمكنك التواصل معنا من خلال أي من الوسائل الآتيه </p>
    </div>
    <div class="container">
      <div class="row text-center py-5">
        <div class="col-lg-4">
          <i class="fa-solid fa-mobile-screen fs-2"></i>
          <h3 class="my-3 "> رقم الهاتف</h3>
          <p>+2 010 60200036</p>
        </div>
        <div class="col-lg-4">
          <a href="https://mail.google.com/mail/u/0/#search/smartplast18%40gmail.com"><i class="fa-solid fa-envelope fs-2"></i></a>
          
          <h3 class="my-3">الإيميل الخاص  </h3>
          <p>smartplast18@gmail.com
          </p>
        </div>
        <div class="col-lg-4">
         
          <a class="text-decoration-none" href="https://www.facebook.com/people/Smart-Plast/100083557320981/"> 
            <i class="fa-brands fa-square-facebook fs-1"></i>
          </a>

           
          <h3 class="my-3">صفحة الفيسبوك</h3>
         <p>smart plast</p> 
              
        </div>
      </div>

    
   
      <form class="row g-3 text-end" method="POST" action="{{ route('contact.store') }}">
        @csrf
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" placeholder="الأسم" required>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="phone" placeholder="رقم الهاتف" required>
        </div>
        <div class="col-12">
            <input type="text" class="form-control" name="subject" placeholder="الموضوع" required>
        </div>
        <div class="col-12">
            <div class="form-floating">
                <textarea class="form-control" name="message" style="height: 100px" required></textarea>
                <label for="floatingTextarea2" class="text-muted">الرسالة</label>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="d-block ms-auto btn text-white px-4 py-2">إرسال</button>
        </div>
    </form>
    
    
    
    
    
    </div>
  </section>