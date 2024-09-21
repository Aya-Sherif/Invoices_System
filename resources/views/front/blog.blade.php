<section id="blog" class="bg-light py-5">
    <div class="heading text-center">
      <h2>منتجاتنا</h2>
      <p class="text-muted mx-auto">سمارت بلاست تتميز بجودة منتجاتها وابتكاراتها التقنية في مجال أنظمة المياه</p>
    </div>

    <div class="container py-4">
      <div class="row g-4">
        @foreach($products as $product)
        <div class="col-lg-4 col-md-6">
          <div class="card p-2 border-0 shadow product-card h-100">
            <img src="{{ asset('images/products/' . $product->image) }}" class="card-img-top product-img" alt="{{ $product->name }}">
            <div class="card-body">
              <h5 class="card-title text-end fw-bolder">{{ $product->name }}</h5>
              <p class="text-muted text-end fw-bolder">المنتج متوفر بمقاسات وأسعار مختلفة</p>

              <!-- Styled product details table -->
              <table class="table table-bordered text-center product-details-table">
                <thead class="table-primary">
                  <tr>
                    <th>المقاس</th>
                    <th>السعر</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($productDetails->where('product_id', $product->id) as $detail)
                  <tr>
                    <td>{{ $detail->size }} مم</td>
                    <td>{{ $detail->price }} جنيه</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
</section>
