<div class="topbar">

    <!-- Left Side -->
    <div class="topbar-left">

        <button class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>

        <div class="search-box">

            <i class="fas fa-search"></i>

            <input type="text" placeholder="Search...">

        </div>

    </div>

    <!-- Right Side -->
    <div class="topbar-right">

        <div class="live-time">

            <i class="far fa-calendar-alt"></i>

            <span id="currentDate"></span>

        </div>

        <div class="notification">

            <i class="far fa-bell"></i>

            <span class="badge">3</span>

        </div>

        <div class="admin-profile">

            <div class="admin-avatar">

                <?php echo strtoupper(substr($_SESSION['admin_name'],0,1)); ?>

            </div>

            <div class="admin-info">

                <h4><?php echo $_SESSION['admin_name']; ?></h4>

                <span>Administrator</span>

            </div>

        </div>

    </div>

</div>