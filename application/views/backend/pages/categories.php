<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Tables - Basic Tables | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

     <!-- Icons. Uncomment required icon fonts -->
     <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?=base_url();?>assets/admin/assets/vendor/js/helpers.js"></script>
    <script src="<?=base_url();?>assets/admin/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <?php 
          $sidebar_path = FCPATH . 'application/views/backend/pages/includes/sidebar.php';

          if (file_exists($sidebar_path)) {
            include($sidebar_path);
          } else {
              echo 'File not found';
          }
          ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <?php 
          $navbar_path = FCPATH . 'application/views/backend/pages/includes/navbar.php';

          if (file_exists($navbar_path)) {
            include($navbar_path);
          } else {
              echo 'File not found';
          }
          ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Category</th>
                        <th>Total Products</th>
                        <th>Total Earnings</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 category_list">
                      
                      
                    </tbody>
                  </table>

                  <div class="pagination">
                        
                    </div>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->

            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php
            $footer_path = FCPATH . 'application/views/backend/pages/includes/footer.php';
            if (file_exists($footer_path)) {
            include($footer_path);
            } else {
                echo 'File not found';
            }
            ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <?php
    $absolute_path = FCPATH . 'application/views/backend/pages/includes/script_bottom.php';
    if (file_exists($absolute_path)) {
      include($absolute_path);
    } else {
        echo 'File not found';
    }
    ?>

    

    <script>
        $(document).ready(function() {
            var currentPage = <?php echo $this->uri->segment(4); ?>;
            var itemsPerPage = 3;
            var offset = (currentPage - 1) * itemsPerPage;
            get_all_categories(offset, currentPage);





            $('.add-cart-button').click(function() {
              alert("hi");
            var product_id = $(this).attr('data-product-id');
            var quantity = 1; 
            
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('products/add_to_cart'); ?>',
                data: { product_id: product_id, quantity: quantity },
                success: function(response) {
                    if (response === 'success') {
                        alert('Product added to cart.');
                    } else {
                        alert('Failed to add the product to the cart.');
                    }
                }
            });
    });

        });


        function get_all_categories(offset , currentPage) {
            $.ajax({
                url: base_url + "backend/products/get_all_categories/"+ currentPage,
                type: 'POST',
                data: { pageno: offset },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('.category_list').html(data.categories);
                    $('.pagination').html(data.pagination);

                    // Remove any existing 'active' class from all pages
                    $('.pagination li').removeClass('active');
                    // Add 'active' class to the current page
                    $('.pagination li a').filter(function() {
                        return parseInt($(this).text()) === currentPage;
                    }).parent('li').addClass('active');
                }
            });
        }



        
    </script>
    
  </body>
</html>
