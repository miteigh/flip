<!-- carousel -->
<!-- <div class="row justify-content-center">
<div id="carouselExampleIndicators" class="carousel slide col-12" style="height: 300px; overflow: hidden;">
  <div class="carousel-indicators" >
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/image/blue_m.jpg" class="d-block w-50" alt="...">
    </div>
    <div class="carousel-item">
      <img src="" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div> -->
<!-- End carousel -->
<!-- <nav class="navbar navbar-expand-lg bg-body-tertiary justify-content-between "> -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid container-xxl bd-gutter flex-wrap flex-lg-nowrap">
    <a class="navbar-brand" href="index.php">My Project</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <!-- vertic line -->
        <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
          <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
          <hr class="d-lg-none my-2 text-white-50">
        </li>
        <!--  -->
        <li class="nav-item">
          <a class="nav-link" href="student_data.php">ข้อมูลนักศึกษา</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="editmajor.php">จัดการข้อมูลสาขาวิชาและคณะ</a>
        </li>

        <!-- <select id="themeSelector" class="form-select w-auto mx-auto">
          <option></option>
          <option value="auto">Auto</option>
          <option value="light">Light</option>
          <option value="dark">Dark</option>
        </select> -->

        <!-- Theme Dropdown -->
        <li class="nav-item dropdown col-lg-1 d-flex align-items-center" style="height: 44px;">
          <button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (dark)">
            <!-- The selected theme will be displayed here -->
            <svg class="bi my-1 theme-icon-active" width="100%" height="44px">
              <use id="theme-icon" href=""></use>
            </svg>
            <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text" width="45px">
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false" onclick="setTheme('light')">
                <svg class="bi me-2 opacity-50" width="10%" height="44px">
                  <use href="#sun-fill"></use>
                </svg>
                Light
                <svg class="bi ms-auto d-none">
                  <use href="#check2"></use>
                </svg>
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="dark" aria-pressed="true" onclick="setTheme('dark')">
                <svg class="bi me-2 opacity-50" width="10%" height="44px">
                  <use href="#moon-stars-fill"></use>
                </svg>
                Dark
                <svg class="bi ms-auto d-none">
                  <use href="#check2"></use>
                </svg>
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false" onclick="setTheme('auto')">
                <svg class="bi me-2 opacity-50" width="10%" height="44px">
                  <use href="#circle-half"></use>
                </svg>
                Auto
                <svg class="bi ms-auto d-none">
                  <use href="#check2"></use>
                </svg>
              </button>
            </li>
          </ul>
        </li>

        <!-- Hidden SVG symbols for icons -->
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
          <symbol id="sun-fill" viewBox="0 0 32 32">
            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
          </symbol>
          <symbol id="moon-stars-fill" viewBox="0 0 32 32">
            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
          </symbol>
          <symbol id="circle-half" viewBox="0 0 32 32">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
          </symbol>
        </svg>


        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Link
          </a>
          <ul class="dropdown-menu">
            <li class="dropdown-item">Action</a></li>
            <li class="dropdown-item">Another action</a></li>
            <li class="dropdown-item">Another action</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->

      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<script>
  // const themeSelector = document.getElementById('themeSelector');
  // const htmlElement = document.documentElement;

  // // Function to set the theme
  // const setTheme = (theme) => {
  //   if (theme === 'auto') {
  //     const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
  //     htmlElement.setAttribute('data-bs-theme', isDarkMode ? 'dark' : 'light');
  //   } else {
  //     htmlElement.setAttribute('data-bs-theme', theme);
  //   }
  // };

  // // Handle theme selection change
  // themeSelector.addEventListener('change', () => {
  //   const selectedTheme = themeSelector.value;
  //   setTheme(selectedTheme);

  //   // Save to localStorage
  //   localStorage.setItem('theme', selectedTheme);
  // });

  // // On page load, apply the saved theme or default to auto
  // const savedTheme = localStorage.getItem('theme') || 'auto';
  // themeSelector.value = savedTheme;
  // setTheme(savedTheme);

  // // Update the theme dynamically in auto mode when system preferences change
  // window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
  //   if (themeSelector.value === 'auto') {
  //     setTheme('auto');
  //   }
  // });
</script>