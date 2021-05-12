<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand mr-4" href="/index.php">
            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" width="36">
                <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5"></path>
                <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5"></path>
            </svg>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/actions/hash.php">
                        Hash-Checker
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        File-checker
                    </a>
                </li> 
            </ul>

            <ul class="navbar-nav ml-auto align-items-baseline">
                <li class="nav-item dropdown">
                    <a id="settingsDropdown" class="nav-link" role="button" data-toggle="dropdown" aria-expanded="false">
                        Admin
                        <svg class="ml-2" width="18" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="settingsDropdown">
                        <a class="dropdown-item px-4" href="/actions/logout.php" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                        <form method="POST" id="logout-form" action="/actions/logout.php">
                            <input type="hidden" value="Logout" name="logout">
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>