<?php require_once "templates/adminNav.php"; ?>

<div class="container my-5">
  <h1>Add Product</h1>
  <form class="my-5 needs-validation" action="#" method="" enctype="multipart/form-data" novalidate>
    <div class="mb-3">
      <label for="productName" class="form-label">Product</label>
      <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" pattern="[A-Za-z][A-Za-z\s]*" title="Product name must start with a letter and not contain numbers" required>
      <div class="invalid-feedback">
        Please enter a valid product name.
      </div>
    </div>
    <div class="mb-3">
      <label for="productPrice" class="form-label">Price</label>
      <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" min="1" max="100" required>
      <div class="invalid-feedback">
        Please enter a valid price.
      </div>
    </div>
    <div class="mb-3">
      <label for="productCategory" class="form-label">Category</label>
      <div class="input-group">
        <select class="form-select" id="productCategory" name="productCategory" required>
          <option value="" selected disabled>Select category</option>
          <option value="Tea">Tea</option>
          <option value="Soda">Soda</option>
          <option value="Coffee">Coffee</option>
          <option value="Fruit Juices">Fruit Juices</option>
        </select>
        <button type="button" class="btn button" id="addCategoryBtn" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add New Category</button>
      </div>
      <div class="invalid-feedback">Please select a category.</div>
    </div>
    <div class="mb-3">
      <label for="productImage" class="form-label">Product Image</label>
      <input type="file" class="form-control" id="productImage" name="productImage" required>
      <div class="invalid-feedback">
        Please upload a product image.
      </div>
    </div>
    <div class="mb-3">
      <button type="submit" class="btn button">Save</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form>
</div>

<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="newCategoryName" class="form-label">Category Name</label>
          <input type="text" class="form-control" id="newCategoryName" placeholder="Enter category name" required>
          <div class="invalid-feedback">
            Enter a valid category name.
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn button" id="saveCategory">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  

<script>
  const forms = document.querySelectorAll('.needs-validation');

  Array.prototype.slice.call(forms)
    .forEach(function(form) {
      form.addEventListener('submit', function(event) {
        const productCategory = document.getElementById('productCategory');
        const productPrice = document.getElementById('productPrice');

        if (!form.checkValidity() || productCategory.value === '' || productPrice.value.startsWith('0')) {
          event.preventDefault();
          event.stopPropagation();

          if (productCategory.value === '') {
            productCategory.classList.add('is-invalid');
            document.querySelector("#productCategory + .invalid-feedback").style.display = "block"; // Displaying the invalid feedback message
          } else {
            productCategory.classList.remove('is-invalid');
            document.querySelector("#productCategory + .invalid-feedback").style.display = "none"; // Hiding the invalid feedback message
          }

          if (productPrice.value.startsWith('0')) {
            productPrice.classList.add('is-invalid');
          } else {
            productPrice.classList.remove('is-invalid');
          }
        } else {
          productCategory.classList.remove('is-invalid');
          productPrice.classList.remove('is-invalid');
        }

        form.classList.add('was-validated');
      }, false);

      const resetBtn = form.querySelector('[type="reset"]');
      if (resetBtn) {
        resetBtn.addEventListener('click', function() {
          form.classList.remove('was-validated');
          const productCategory = document.getElementById('productCategory');
          const newCategoryName = document.getElementById('newCategoryName');
          const productPrice = document.getElementById('productPrice');

          productCategory.classList.remove('is-invalid');
          newCategoryName.classList.remove('is-invalid');
          productPrice.classList.remove('is-invalid');

          document.querySelector("#productCategory + .invalid-feedback").style.display = "none"; // Hiding the invalid feedback message
        });
      }
    });

  document.getElementById('saveCategory').addEventListener('click', function() {
    const categoryNameInput = document.getElementById('newCategoryName');
    const categoryName = categoryNameInput.value.trim();

    if (!/^[A-Za-z][A-Za-z\s]*$/.test(categoryName)) {
      categoryNameInput.classList.add('is-invalid');
    } else {
      categoryNameInput.classList.remove('is-invalid');
    }
  });
</script>