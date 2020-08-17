<aside class="main-sidebar sidebar-light-primary elevation-4">
  <a href="home.php" class="brand-link">
    <img src="images/logo/onlyLogo.png" alt="SKDBL Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SKDBL Inventory</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">

          <!-- HOME -->
          <a href="home.php" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- PRODUCT ENTRY -->
        <li class="nav-item">
          <a href="productentry.php" class="nav-link">
            <i class="nav-icon fas fa-plus"></i>
            <p>
              Product Entry
            </p>
          </a>
        </li>

        <!-- PRODUCTS -->
        <li class="nav-item has-treeview">
          <a href="products.php" class="nav-link">
            <i class="nav-icon fas fa-th-list"></i>
            <p>Inventory
              <!-- <i class="fas fa-angle-left right"></i> -->
            </p>
          </a>
        </li>

        <!-- ALLOCATION -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-arrows-alt"></i>
            <p>Allocation<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="allocation.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Allocated Items</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="branchproducts.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Branch</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="departmentproducts.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Department</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- VENDOR -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-shopping-bag"></i>
            <p>Vendor<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
              <a href="addvendor.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Vendor</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="vendor.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Vendor Details</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="itemsvendor.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Items from Vendors</p>
              </a>
            </li>
          </ul>
        </li>
        <br><br>
        <!-- BRANCH & DEPARTMENT -->
        <li class="nav-item has-treeview">
          <a href="branch.php" class="nav-link">
            <i class="nav-icon fas fa-building"></i>
            <p>Branch
              <!-- <i class="fas fa-angle-left right"></i> -->
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="department.php" class="nav-link">
            <i class="nav-icon fas fa-code-branch"></i>
            <p>Department
              <!-- <i class="fas fa-angle-left right"></i> -->
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
