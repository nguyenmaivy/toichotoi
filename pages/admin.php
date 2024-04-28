<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <h1 class="m-0 display-5 font-weight-semi-bold">
          <span class="text-primary font-weight-bold border px-3 mr-1 " id="logo-tittle">B</span>Belleza
      </h1></div>
      <div class="navbar-menu-wrapper title-admin">
        Quản lý tài khoản
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link button-model">
                <span class="menu-title">Cấp quyền cho tài khoản</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="content-wrapper content-left">
          <div class="row">
            <div class="col-md-12 item-left">
            <form id="form-tim">
                <div class="modal_content-input-box form-group">
                    <label for="user1-register">Nhập tài khoản cần cấp quyền</label>
                    <input placeholder="Nhập số điện thoại" id="user1-register"
                        class="hide-number-spinner" name="user1_register">
                    <span class="form-message"></span>
                </div>
                <span class="error-login mb-2">Tài khoản không tồn tại</span>
                <div class="modal_content-btn-box">
                    <button type="submit" class="btn-login btn-form btn-default" id="btn-register"><span>Tìm kiếm</span></button>
                    <button type="reset" class="btn-form btn-closee">Làm mới</button>
                    <!-- <span><a href="index.php?chon=home"></a></span> -->
                </div>
            </form>
            </div>
          </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  
